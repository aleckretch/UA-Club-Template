<?
/*
	This class holds configuration values that are constant. Namely the database credentials.
*/
class Config
{
	public static $DB_NAME;
	
	public static $DB_USER;

	public static $DB_PASS;

	public static $DB_HOST;

	public static $NET_LOGIN_BANNER;

	public static $NET_LOGIN_URL;

	static function init()
	{
		self::$DB_NAME = "CLUB";

		self::$DB_USER = "root";

		self::$DB_PASS = "";

		self::$DB_HOST = "localhost";

		self::$NET_LOGIN_BANNER = "Club Website";

		self::$NET_LOGIN_URL = "http://localhost/UA-Club-Template/login.php";
	}
}
Config::init();
