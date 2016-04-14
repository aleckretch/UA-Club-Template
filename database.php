<?php
/*
Holds functions pertaining to the database
*/
require_once "./config.php";

class Database
{
	/*
		Creates a connection to the database if it does not already exist
		If a connection exists then return that connection
	*/
	public static function connect()
	{
		//$conn holds the connection to the database if it has been opened already
		//otherwise, a connection is created and $conn points to that connection
		static $conn;

		//If there is already an existing connection, return that connection
		if ( $conn )
			return $conn;

		$dbName = Config::$DB_NAME;
		$dbUser = Config::$DB_USER;
		$dbPass = Config::$DB_PASS;
		$dbHost = Config::$DB_HOST;
		$dataSrc = "mysql:host={$dbHost};dbname={$dbName}";
		try 
		{
			//create the connection with the parameters given
			$conn = new PDO( $dataSrc, $dbUser , $dbPass );
			//make associative arrays the default so that $stmt->fetch() doesn't need PDO::FETCH_ASSOC every time
			$conn->setAttribute( PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC );
		} 
		catch ( PDOException $e ) 
		{
			self::logError( "Error establishing Connection\n{$e->getMessage()}\n" );
			exit();
		}

		return $conn;
	}

	/*
		Setups the database, should only be run from startup.php
	*/
	public static function setup()
	{
		$conn = self::connect();
		$sql = file_get_contents( "club.sql" );
		$conn->exec( $sql );
	}

	/*
		Writes the message provided to the error log.
		If fail is true(by default), also stops more code from running.
		If the config constant LOG_TO_FILE is false then the message is displayed to the page as html(sanitized).
	*/
	public static function logError( $message, $fail = TRUE )
	{
		error_log( $message );
		if ( $fail )
		{
			exit();
		}
	}

	/*
		Generates a random token for CSRF prevention.
		Length is the number of bytes that will be generated.
		Returns the hexadecimal representation of the generated bytes as a string.
	*/
	public static function randomToken( $length = 32 )
	{
		$strong = false;
		$bytes = openssl_random_pseudo_bytes( $length, $strong );
		//if strong is false, then the bytes were not generated with a cryptographically strong algorithm
		//	if that is the case, then error out
		if ( $strong !== true )
		{
			self::logError( "Could not generate secure token\n" );
			exit();			
		}

		return bin2hex( $bytes );
	}

	/*
		Sanitizes the input given to prevent XSS.
	*/
	public static function sanitizeData( $str )
	{
		return htmlspecialchars( $str, ENT_QUOTES, 'UTF-8', false);		
	}

	/*
		Reverts the input given back to its original form, meaning any HTML tags will be there.
	*/
	public static function unsanitizeData( $str )
	{
		return ( htmlspecialchars_decode( $str, ENT_QUOTES ) );
	}

	/*
		Returns the hashed value of the token provided.
	*/
	public static function hashToken( $token )
	{
		return hash( "sha512" , $token, FALSE );
	}

	/*
		Returns true if the token matches the hashed provided or false otherwise.
	*/
	public static function hashVerify( $hashed, $token )
	{
		return ( self::hashToken( $token ) === $hashed );
	}

	/*
		Inserts a user into the editors table in the database.
		Uses the netID provided as the username.
		Returns the id of the user that was inserted.
	*/
	public static function createEditor( $netID )
	{
		$username = Database::sanitizeData( strtolower( $netID ) );
		$conn = self::connect();
		$stmt = $conn->prepare( "INSERT INTO Editors( username ) values( :username )" );
		$stmt->bindParam( "username" , $username );
		$stmt->execute();	
		return $conn->lastInsertId();	
	}

	/*
		Returns true if the user with the username provided exists in the Editors table, or false otherwise.
	*/
	public static function doesEditorExist( $username )
	{
		$username = self::sanitizeData( strtolower( $username ) );
		$conn = self::connect();
		$stmt = $conn->prepare( "SELECT id FROM Editors WHERE username=:username" );
		$stmt->bindParam( "username" , $username ); 
		$stmt->execute();
		$row = $stmt->fetch();
		return isset( $row[ "id" ] );
	}

	/*
		Returns an array of all the editors for the club site.
	*/
	public static function getAllEditors()
	{
		$conn = self::connect();
		$stmt = $conn->prepare( "SELECT * FROM Editors" );
		$stmt->execute();
		return $stmt->fetchAll();
	}

	/*
		Removes the editor with the database id provided.
	*/
	public static function removeEditor( $id )
	{
		$args = array( $id );
		$conn = self::connect();
		$stmt = $conn->prepare( "DELETE FROM Editors WHERE id=?" );
		$stmt->execute( $args );
		return $stmt->errorCode();
	}

	/*
		Returns the editor row for the database id provided if it exists.
	*/
	public static function getEditorByID( $id )
	{
		$args = array( $id );
		$conn = self::connect();
		$stmt = $conn->prepare( "SELECT * FROM Editors WHERE id=?" );
		$stmt->execute( $args );
		return $stmt->fetch();
	}

	/*
		Removes the link with the database id provided.
	*/
	public static function removeLink( $id )
	{
		$args = array( $id );
		$conn = self::connect();
		$stmt = $conn->prepare( "DELETE FROM Links WHERE id=?" );
		$stmt->execute( $args );
		return $stmt->errorCode();
	}

	/*
		Creates a link with the parameters specified.
	*/
	public static function createLink( $title, $href, $placement )
	{
		$title = self::sanitizeData( trim( $title ) );
		$args = array( $title, $href, $placement );
		$conn = self::connect();
		$stmt = $conn->prepare( "INSERT INTO Links( title, link, placement ) VALUES( ? , ? , ? )" );
		$stmt->execute( $args );		
		return $conn->lastInsertId();	
	}

	/*
		Returns all links that have placement value of provided.
		So for example, to get all social media links: Database::getLinksByPlacement( "social" );
		Or, to get all the links for the bottom of the club page: Database::getLinksByPlacement( "bottom" ); 
	*/
	public static function getLinksByPlacement( $placement )
	{
		$placement = strtolower( $placement );
		$args = array( $placement );
		$conn = self::connect();
		$stmt = $conn->prepare( "SELECT * FROM Links WHERE placement=?" );
		$stmt->execute( $args );
		return $stmt->fetchAll();
	}

	/*
		Returns an array of key value pairs.
		Keys are the social media sites, i.e facebook,twitter...
		Values are the links to the club profiles on these sites
	*/
	public static function getSocialLinks()
	{
		$toReturn = array();
		$links = Database::getLinksByPlacement( "social" );
		foreach( $links as $row )
		{
			$key = $row[ "title" ];
			$toReturn[ $key ] = $row[ "link" ];
		}
		return $toReturn;
	}

	/*
		Updates the social media link with the title provided to the link provided.
	*/
	public static function updateSocialLink( $title, $link )
	{
		$placement = "social";
		$title = strtolower( $title );
		$args = array( $link, $placement, $title );
		$conn = self::connect();
		$stmt = $conn->prepare( "UPDATE Links SET link=? WHERE placement=? AND title=?" );
		$stmt->execute( $args );
		return TRUE;
	}

	/*
		Updates the featured item with the id provided to the parameters given as title and link.
		Title should be the image name for the featured item.
		Link should be the link that user goes to when clicking on the image.
	*/
	public static function updateFeatured( $id, $title, $link )
	{
		$placement = "featured";
		$title = Database::sanitizeData( trim( $title ) );
		$args = array( $link, $title, $placement, $id );
		$conn = self::connect();
		$stmt = $conn->prepare( "UPDATE Links SET link=?,title=? WHERE placement=? AND id=?" );
		$stmt->execute( $args );
		return TRUE;
	}

	/*
		Returns a list of articles that have the search term provided in their title or body.
		Returns an empty array if there are no articles with the search term provided.
	*/
	public static function searchArticles( $searchTerm )
	{
		$searchTerm = Database::sanitizeData( $searchTerm );
		$args = array( $searchTerm . "%" , "%" . $searchTerm . "%");
		$conn = self::connect();
		$stmt = $conn->prepare( "SELECT * FROM Articles WHERE title LIKE ? OR body LIKE ? ORDER BY uploadDate DESC,id DESC" ); 
		$stmt->execute( $args );
		return $stmt->fetchAll();
	}

	/*
		Returns an array of the featured links for the club page.
	*/
	public static function getFeatured()
	{	
		return Database::getLinksByPlacement( "featured" );
	}

	/*
		Creates an article with the parameters specified.
		imageURL should be a url to allow flexibility for using images on other sites, not just uploaded ones.
	*/
	public static function createArticle( $title, $author, $body, $imageURL )
	{
		$title = self::sanitizeData( trim( $title ) );
		$author = self::sanitizeData( trim( $author ) );
		$body = self::sanitizeData( trim( $body ) );
		$args = array( $title, $author, $body, $imageURL );
		$conn = self::connect();
		$stmt = $conn->prepare( "INSERT INTO Articles( title, author, body, uploadDate, image) VALUES( ? , ?, ? , CURDATE(), ? )" );
		$stmt->execute( $args );		
		return $conn->lastInsertId();	
	}

	/*
		Gets the information for a specific article with the id supplied.
	*/
	public static function getArticleByID( $id )
	{
		$conn = self::connect();
		$args = array( $id );
		$stmt = $conn->prepare( "SELECT * FROM Articles WHERE id=?" );
		$stmt->execute( $args );
		return $stmt->fetch();
	}

	/*
		Returns the contents of the most recent article.
	*/
	public static function getMostRecentArticle()
	{
		$conn = self::connect();
		$stmt = $conn->prepare( "SELECT * FROM Articles ORDER BY uploadDate DESC,id DESC LIMIT 1" );
		$stmt->execute();
		return $stmt->fetch();
	}

	/*
		Gets an array of all the articles, sorted by most recent first.
	*/
	public static function getAllArticles()
	{
		$conn = self::connect();
		$stmt = $conn->prepare( "SELECT * FROM Articles ORDER BY id DESC" );
		$stmt->execute();
		return $stmt->fetchAll();
	}

	/*
		Gets an array of the articles for the certain page(offset) in the newsfeed, sorted by most recent first.
	*/
	public static function getArticlesForNewsfeed($offset, $article_limit)
	{
		$article_limit = intval( $article_limit );
		$offset = intval( $offset );
		$conn = self::connect();
		$stmt = $conn->prepare( "SELECT * FROM Articles ORDER BY uploadDate DESC,id DESC LIMIT $offset, $article_limit");
		$stmt->execute();
		return $stmt->fetchAll();
	}

	/*
		Gets an array of the articles for the certain page(offset) in the search page, sorted by most recent first.
	*/
	public static function getArticlesForSearch($offset, $article_limit, $searchTerm)
	{
		$article_limit = intval( $article_limit );
		$offset = intval( $offset );
		$searchTerm = Database::sanitizeData( $searchTerm );
		$args = array( $searchTerm . "%" , "%" . $searchTerm . "%");
		$conn = self::connect();
		$stmt = $conn->prepare( "SELECT * FROM Articles WHERE title LIKE ? OR body LIKE ? ORDER BY uploadDate DESC,id DESC LIMIT $offset, $article_limit" ); 
		$stmt->execute( $args );
		return $stmt->fetchAll();
	}
	/*
		Deletes the article with the id provided.
		Returns the error code that occured, 00000 if ok.
	*/
	public static function removeArticle( $id )
	{
		$args = array( $id );
		$conn = self::connect();
		$stmt = $conn->prepare( "DELETE FROM Articles WHERE id=?" );
		$stmt->execute( $args );
		return $stmt->errorCode();
	}

	/*
		Creates about text in the database with the parameters provided.
	*/
	public static function createAbout( $body )
	{
		$conn = self::connect();
		$body = self::sanitizeData( trim( $body ) );
		$args = array( $body );
		$stmt = $conn->prepare( "INSERT INTO About( body ) VALUES( ? )" );
		$stmt->execute( $args );		
		return $conn->lastInsertId();	
	}

	/*
		Returns an array containing the text for the about container on the club page.
		Uses the most recent about text entered into the database.
	*/
	public static function getAbout()
	{
		$conn = self::connect();
		$stmt = $conn->prepare( "SELECT * FROM About ORDER BY id DESC LIMIT 1" );
		$stmt->execute();
		return $stmt->fetch();
	}

	/*
		Returns true if the mime type provided is an allowed type or false otherwise.
		See Config.php ALLOWED_TYPES constant for complete list of allowed types
	*/
	public static function isAllowedMIME( $type )
	{
		return ( isset( Config::$ALLOWED_TYPES[ $type ] ) );
	} 

	/*
		Returns the file extension for the mime type provided.
		Returns null if the mime type provided is not allowed
			See Config.php ALLOWED_TYPES constant for complete list of allowed types
	*/
	public static function getExtensionFromMIME( $type )
	{
		if ( self::isAllowedMIME( $type ) )
		{
			return Config::$ALLOWED_TYPES[ $type ];
		}
		return NULL;
	}

	/*
		Returns the basename of the fileName provided, excluding the extension.
		Replaces any non-alphanumeric characters with underscores, examples . .. /
		If the fileName does not have an extension then this will still work.
	*/
	public static function sanitizeFileName( $fileName )
	{
		$fileParts = explode( ".", basename( $fileName ) );
		if ( count( $fileParts ) > 1 )
		{
			array_pop( $fileParts );
			$fileName = end( $fileParts );
		}
		return preg_replace('/[^A-Za-z0-9_\-]/', '_', $fileName );
	}


}
?>
