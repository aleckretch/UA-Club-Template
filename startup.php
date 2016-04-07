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
function readValue( $prompt = '' )
{
    echo $prompt;
    return rtrim( fgets( STDIN ), "\n" );
}
echo "Hello, welcome to the club setup script\n";
$name = readValue( "What is the name of the database setup from the cpanel?\n" );
$user = readValue( "What is the username of the database setup from the cpanel?\n" );
$pass = readValue( "What is the password of this username setup from the cpanel?\n" );
echo "A netid of someone who will be able to login to the site's admin panel is needed.\n";
$netid = readValue( "The netid for that person is?\n" );
$banner = readValue( "What will the title be for the site?\n" );
$url = readValue( "What will the url for the site be?\n" );
if ( strpos( $url , "http://" ) === false )
{
	$url = "http://${url}";
}
$url .= "/login.php";

$str = file_get_contents( "./config2.php" );
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
file_put_contents( "./config.php" , $str );
exit();
Config::init();
