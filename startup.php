<?php
/*
	This script should automate the process of setting everything up for the database.
	It will write the config.php file by scratch.
	What it needs to get from user input:
		Name of the database.
			User has to setup on uits cpanel for the server
		Username for the database. 
			User has to setup on uits cpanel for the server
		Password for the database. 
			User has to setup on uits cpanel for the server
		The netid of the very first editor so that other editors can be added through admin panel.
		The login banner for the site, which shows up when trying to login via netid to the admin panel.
			Might also use this as the title for every page on the site
		Get the url for the club site, i.e http://cs.arizona.edu
			Should add in the login.php to the end for netid login redirect
	All of these inputs should be spat out into the config.php file that will be generated/overwritten
	The script will then setup the database, creating the tables and inserting default values for the various content
*/

/*
This function returns true if this script is being run from the command line or false otherwise.
*/
function fromCommandLine()
{
	return (php_sapi_name() === 'cli' OR defined('STDIN'));
}

//if this is not being run from the command line, then exit
if ( !fromCommandLine() )
{
	exit();
}

//Reads a line from standard in, trimming the ending newline
function readValue( $prompt = '' )
{
    echo $prompt;
    return addslashes( rtrim( fgets( STDIN ), "\n" ) );
}

echo "Hello, welcome to the club setup script\n";
$configExists = file_exists( "./config.php" );
$sameConstant = "-same";
if ( $configExists )
{
	require_once "./config.php";
	echo "Config file found, to keep existing value for any prompt: type '${sameConstant}'.\n";
}

$name = readValue( "What is the name of the database setup from the cpanel?\n" );
if ( $configExists && $name === $sameConstant )
{
	$name = Config::$DB_NAME;	
}
$user = readValue( "What is the username of the database setup from the cpanel?\n" );
if ( $configExists && $user === $sameConstant )
{
	$user = Config::$DB_USER;	
}
$pass = readValue( "What is the password of this username setup from the cpanel?\n" );
if ( $configExists && $pass === $sameConstant )
{
	$pass = Config::$DB_PASS;	
}
echo "A netid of someone who will be able to login to the site's admin panel is needed.\n";
$netid = readValue( "The netid for that person is?\n" );
$banner = readValue( "What will the title for the site be?\n" );
if ( $configExists && $banner === $sameConstant )
{
	$banner = Config::$NET_LOGIN_BANNER;	
}
$url = readValue( "What will the url for the site be?\n" );
if ( $configExists && $url === $sameConstant )
{
	$url = Config::$NET_LOGIN_URL;	
}
else
{
	if ( strpos( $url , "http://" ) === false )
	{
		$url = "http://${url}";
	}

	if ( $url[ strlen( $url ) - 1 ] === "/" )
	{
		$url .= "login.php";
	}
	else
	{
		$url .= "/login.php";
	}
}
//For each placeholder in copyConfig.txt, replace placeholder with the actual text
$str = file_get_contents( "./copyConfig.php" );
$replace = array(
	"#NAME#" => $name,
	"#USER#" => $user,
	"#PASS#" => $pass,
	"#TITLE#" => $banner,
	"#URL#" => $url
);

foreach( $replace as $key=>$value )
{
	$str = str_replace( $key, $value, $str );
}
//put the newly generated php code for config into config.php, creating it if it does not exist
file_put_contents( "./config.php" , $str );

//Now the database can be setup
require_once "./database.php";
Database::setup();
//Finally create account in admin panel for the first editor given above
Database::createEditor( $netid );


