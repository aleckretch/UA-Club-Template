<?php
require_once "./database.php";
require_once "./session.php";
function handleUpload( $key )
{
	if ( !isset($_FILES[ $key ]['error']) || $_FILES[ $key ]['error'] !== UPLOAD_ERR_OK )
	{
		Database::logError( "File missing" , false );
		return "";
	}

	//if the file uploaded is larger then 3mb don't allow the upload to continue into database
	if ( $_FILES[ $key ]['size'] > 3000000) 
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

	$ext = Database::getExtensionFromMIME( $mime );
	$fileName = "./uploads/${name}.${ext}";	
	$result = true;
	//if the uploads folder does not exist, create it
	if ( !file_exists( "./uploads" ) )
	{
		$result = mkdir( "./uploads" );
	}
	
	//if the upload has been created in the past at some point
	if ( $result === true )
	{
		if ( file_exists( $fileName ) )
		{
			Database::logError( "File already exists" , false );
			return "";		
		}
	
		//move the uploaded file to the uploads folder under the name of its id
		move_uploaded_file( $_FILES[ $key ]['tmp_name'] , $fileName  );

		//change the permissions on the uploaded file in the uploads folder to RW-R--R--
		chmod( $dir, 0644 );	
		return $fileName;
	}

	Database::logError( "Upload folder not created" , false );
	return "";
}

if ( !Session::userLoggedIn() )
{
	header( "Location: login.php" );
	exit();
}

//TODO: NOT HERE, will probably need some kind of startup script
//		should get at least the netid for one editor
//		should setup the database
//TODO: Should probably have an error page similar to the lecture notes site

if ( isset( $_GET['editor'] ) )
{
	//if a parameter is missing then stop
	if ( !isset( $_POST['user'] ) || !isset( $_POST['token'] ) )
	{
		echo "Missing user or token";
		exit();
	}

	//if the token provided does not match then stop
	if ( !Session::verifyToken( $_POST['token'] ) )
	{
		echo "Failed verification of token";
		exit();
	}

	//if the editor to be added already exists then stop
	if ( Database::doesEditorExist( $_POST['user'] ) )
	{
		echo "Cannot add user as editor, user is already an editor";
		exit();
	}

	//create the editor and redirect to the admin panel
	Database::createEditor( $_POST['user'] );
	header( "Location: admin.html" );
	exit();

}
else if ( isset( $_GET['social'] ) )
{
	//if a parameter is missing then stop
	if ( !isset( $_POST['token'] ) )
	{
		echo "Missing token";
		exit();
	}

	//if the token provided does not match then stop
	if ( !Session::verifyToken( $_POST['token'] ) )
	{
		echo "Failed verification of token";
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

	header( "Location: admin.html" );
	exit();
}
else if ( isset( $_GET['link'] ) && ( $_GET['link'] === "top" || $_GET['link'] === "bottom" ) )
{
	//if a parameter is missing then stop
	if ( !isset( $_POST['token'] ) )
	{
		echo "Missing token";
		exit();
	}

	//if the token provided does not match then stop
	if ( !Session::verifyToken( $_POST['token'] ) )
	{
		echo "Failed verification of token";
		exit();
	}

	if ( !isset( $_POST['title'] ) || !isset( $_POST['href'] ) )
	{
		echo "Missing required parameter";
		exit();		
	}
	Database::createLink( $_POST['title'] , $_POST['href'] , $_GET['link'] );
	header( "Location: admin.html" );
	exit();
}
else if ( isset( $_GET['logo'] ) )
{
	//TODO:
	//NEED TO VERIFY token
	//NEED TO VERIFY logo is an image
	//NEED TO VERIFY file size...
}
else if ( isset( $_GET['about'] ) )
{
	//TODO:
}
else if ( isset( $_GET['featured' ] ) )
{
	//TODO:
	//NEED TO VERIFY token
	//NEED TO VERIFY uploaded file is an image
	//NEED TO VERIFY file size...
}
else if ( isset( $_GET['article'] ) )
{
	//if error code is not set on file upload array then do not allow upload to continue into database
	if ( !isset( $_POST['token'] ) || !Session::verifyToken( $_POST['token'] ) )
	{
		echo "Failed verification of token";
		exit();
	}

	$needed = array( "author" , "title" , "text" );
	foreach( $needed as $param )
	{
		if ( !isset( $_POST[ $param ] ) )
		{
			echo "Missing parameter ${param}";
			exit();
		}
	}

	$filePath = handleUpload( "file" );
	Database::createArticle( $_POST['title'] , $_POST['author'] , $_POST['text'] , $filePath );
	header( "Location: admin.html" );
	exit();
}
else
{
	header( "Location: admin.html" );
	exit();
}

