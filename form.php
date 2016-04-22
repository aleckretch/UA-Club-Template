<?php
require_once "./database.php";
require_once "./session.php";
function handleUpload( $key, $pathToParent, $canOverwrite, $givenName = NULL )
{
	if ( !isset($_FILES[ $key ]['error']) || $_FILES[ $key ]['error'] !== UPLOAD_ERR_OK )
	{
		Database::logError( "File missing" , false );
		return "";
	}

	//if the file uploaded is larger then 10mb don't allow the upload to continue into database
	if ( $_FILES[ $key ]['size'] > 10000000) 
	{
		Database::logError( "File size too large" , false );
		return "";
	}

	//open resource to get actual mime type from the file
	$finfo = finfo_open(FILEINFO_MIME_TYPE);
	//get the mime type from the file information on the server( doesn't use info sent by client)
	$mime = finfo_file( $finfo, $_FILES[ $key ]['tmp_name'] );
	$name = Database::sanitizeFileName( $_FILES[ $key ][ 'name' ] );

	if ( !Database::isAllowedMIME( $mime ) )
	{
		Database::logError( "File is not allowed type of ${mime}" , false );
		return "";
	}

	if ( $givenName === NULL )
	{
		$ext = Database::getExtensionFromMIME( $mime );
		$fileName = "${pathToParent}/${name}.${ext}";	
	}
	else
	{
		$fileName = "${pathToParent}/${givenName}";
	}

	$result = true;
	//if the uploads folder does not exist, create it
	if ( !file_exists( $pathToParent ) )
	{
		$result = mkdir( $pathToParent );
	}
	
	//if the upload has been created in the past at some point
	if ( $result === true )
	{
		if ( !$canOverwrite && file_exists( $fileName ) )
		{
			Database::logError( "File already exists" , false );
			return $fileName;		
		}
	
		//move the uploaded file to the uploads folder under the name of its id
		move_uploaded_file( $_FILES[ $key ]['tmp_name'] , $fileName  );

		//change the permissions on the uploaded file in the uploads folder to RW-R--R--
		chmod( $fileName, 0644 );	
		return $fileName;
	}

	Database::logError( "Path to folder ${pathToParent} not created" , false );
	return "";
}

if ( !Session::userLoggedIn() )
{
	header( "Location: login.php" );
	exit();
}

if ( isset( $_GET['editor'] ) )
{
	//if a parameter is missing then stop
	if ( !isset( $_POST['user'] ) || !isset( $_POST['token'] ) )
	{
		$message = urlencode( "Missing user or token" );
		header( "Location: error.php?error=${message}" );
		exit();
	}

	//if the token provided does not match then stop
	if ( !Session::verifyToken( $_POST['token'] ) )
	{
		$message = urlencode( "Failed verification of token" );
		header( "Location: error.php?error=${message}" );
		exit();
	}

	//if the editor to be added already exists then stop
	if ( Database::doesEditorExist( $_POST['user'] ) )
	{
		$message = urlencode( "Cannot add user as editor, user is already an editor" );
		header( "Location: error.php?error=${message}" );
		exit();
	}

	//create the editor and redirect to the admin panel
	Database::createEditor( $_POST['user'] );
	header( "Location: admin.php?current=editor" );
	exit();

}
else if ( isset( $_GET['social'] ) )
{
	//if a parameter is missing then stop
	if ( !isset( $_POST['token'] ) || !Session::verifyToken( $_POST['token'] ) )
	{
		$message = urlencode( "Failed verification of token" );
		header( "Location: error.php?error=${message}" );
		exit();
	}

	//for each of the social media tags, update DB with the ones that were provided to the values provided
	$wants = Config::$SOCIAL_TAGS;
	foreach( $wants as $key )
	{
		if ( !isset( $_POST[ $key ] ) )
		{
			continue;
		}

		Database::updateSocialLink( $key, $_POST[ $key ] );
	}

	header( "Location: admin.php?current=social" );
	exit();
}
else if ( isset( $_GET['link'] ) && ( $_GET['link'] === "top" || $_GET['link'] === "bottom" ) )
{
	if ( !isset( $_POST['token'] ) || !Session::verifyToken( $_POST['token'] ) )
	{
		$message = urlencode( "Failed verification of token" );
		header( "Location: error.php?error=${message}" );
		exit();
	}

	if ( !isset( $_POST['title'] ) || !isset( $_POST['href'] ) )
	{
		$message = urlencode( "Missing required parameter" );
		header( "Location: error.php?error=${message}" );
		exit();	
	}
	Database::createLink( $_POST['title'] , $_POST['href'] , $_GET['link'] );
	header( "Location: admin.php?current=${_GET['link']}" );
	exit();
}
else if ( isset( $_GET['logo'] ) )
{
	if ( !isset( $_POST['token'] ) || !Session::verifyToken( $_POST['token'] ) )
	{
		$message = urlencode( "Failed verification of token" );
		header( "Location: error.php?error=${message}" );
		exit();
	}

	$filePath = handleUpload( "file" , "./images" , true, "logo.png" );
	if ( $filePath === "" )
	{
		Database::logError( "Logo file not overwritten" , false );
	}

	header( "Location: admin.php?current=logo" );
	exit();
}
else if ( isset( $_GET['about'] ) )
{
	if ( !isset( $_POST['token'] ) || !Session::verifyToken( $_POST['token'] ) )
	{
		$message = urlencode( "Failed verification of token" );
		header( "Location: error.php?error=${message}" );
		exit();
	}

	if ( !isset( $_POST['text'] ) )
	{
		$message = urlencode( "Missing text parameter for about paragraph" );
		header( "Location: error.php?error=${message}" );
		exit();
	}	

	Database::createAbout( $_POST['text'] );
	header( "Location: admin.php?current=about" );
	exit();
}
else if ( isset( $_GET['featured' ] ) )
{
	if ( !isset( $_POST['token'] ) || !Session::verifyToken( $_POST['token'] ) )
	{
		$message = urlencode( "Failed verification of token" );
		header( "Location: error.php?error=${message}" );
		exit();
	}

	$featured = Database::getFeatured();
	foreach( $featured as $key=>$row )
	{
		$i = $key + 1;
		if ( isset( $_POST[ "f${i}Text" ] ) )
		{
			$filePath = handleUpload( "f${i}Image" , "./uploads" , false );
			//if the filePath is empty from handleUpload, then use the old file that was already in the database
			$filePath = ( $filePath === "" ? $row[ "title" ] : $filePath );
			Database::updateFeatured( $row[ "id" ] , $filePath, $_POST[ "f${i}Text" ] );
		}
	}

	header( "Location: admin.php?current=featured" );
	exit();
}
else if ( isset( $_GET['article'] ) )
{
	//if error code is not set on file upload array then do not allow upload to continue into database
	if ( !isset( $_POST['token'] ) || !Session::verifyToken( $_POST['token'] ) )
	{
		$message = urlencode( "Failed verification of token" );
		header( "Location: error.php?error=${message}" );
		exit();
	}

	$needed = array( "author" , "title" , "text" );
	foreach( $needed as $param )
	{
		if ( !isset( $_POST[ $param ] ) )
		{
			$message = urlencode( "Missing ${param} parameter" );
			header( "Location: error.php?error=${message}" );
			exit();
		}
	}

	$filePath = handleUpload( "file" , "./uploads" , false );
	Database::createArticle( $_POST['title'] , $_POST['author'] , $_POST['text'] , $filePath );
	header( "Location: admin.php?current=articles" );
	exit();
}
else
{
	header( "Location: admin.php" );
	exit();
}

