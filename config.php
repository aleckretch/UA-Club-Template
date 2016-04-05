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

	public static $SOCIAL_TAGS;

	public static $ALLOWED_TYPES;

	static function init()
	{
		self::$DB_NAME = "CLUB";

		self::$DB_USER = "root";

		self::$DB_PASS = "";

		self::$DB_HOST = "localhost";

		self::$NET_LOGIN_BANNER = "Club Website";

		self::$NET_LOGIN_URL = "http://localhost/UA-Club-Template/login.php";

		self::$SOCIAL_TAGS = array( "facebook" , "instagram" , "twitter" , "youtube" );

		self::$ALLOWED_TYPES = array(
			"image/png" => "png",
			"image/tiff" => "tiff",
			"image/x-tiff" => "tiff",
			"image/bmp" => "bmp",
			"image/x-windows-bmp" => "bmp",
			"image/gif" => "gif",
			"image/x-icon" => "ico",
			"image/jpeg" => "jpg",
			"image/pjpeg" => "jpg"
		);
	}
}
Config::init();
