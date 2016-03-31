<?php
require_once "./database.php";
require_once "./session.php";
if ( !Session::userLoggedIn() )
{
	header( "Location: login.php" );
	exit();
}

//TODO: NOT HERE, will probably need some kind of startup script
//		should get at least the netid for one editor
//		should setup the database

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
	if ( Database::doesUserExist( $_POST['user'] ) )
	{
		echo "Cannot add user as editor, user is already an editor";
		exit();
	}

	//create the editor and redirect to the admin panel
	Database::createEditor( $_POST['user'] );
	header( "Location: admin.php" );
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

	header( "Location: admin.php" );
	exit();
}
else
{
	header( "Location: admin.php" );
	exit();
}

