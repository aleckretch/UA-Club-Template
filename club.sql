/*
DROP DATABASE IF EXISTS CLUB;
CREATE DATABASE CLUB   
DEFAULT CHARACTER SET utf8
DEFAULT COLLATE utf8_general_ci;
USE CLUB;
*/
/*
COMMENT OUT ABOVE THIS LINE WHEN IN PRODUCTION
UITS w6 hosting only allows database creation from cpanel
*/
/*
	This holds the netid for the editors of the club page.
	The username has to be unique.

	id: 		a unique key particular to each editor
	username:	the netid for a particular editor, also unique
*/
DROP TABLE IF EXISTS Editors;
CREATE TABLE Editors
(
	id		int NOT NULL auto_increment primary key,
	username	varchar(100) NOT NULL,
	UNIQUE( username )
);

/*
	This holds the different links that will be on the club page.

	id: 		a unique key particular to each menu item
	title: 		the title for the menu item
	link:		the link the menu item redirects to
	placement:	The position of the link on the page
			i.e:  top,bottom,facebook,twitter...
*/
DROP TABLE IF EXISTS Links;
CREATE TABLE Links
(
	id		int NOT NULL auto_increment primary key,
	title		varchar(100) NOT NULL,
	link		varchar(255) NOT NULL,
	placement	varchar( 20 ) NOT NULL
);

/*
	This holds the articles for the club page.

	id: 	a unique key particular to each article
	title:	the title of the article
	author:	the author of the article
	body:	the main text of the article (max of 65,535 characters)
	uploadDate: the date the article was written. By default, it is the current date.
	image:	the filename of the image to be displayed for the article. Optional for each article.

*/
DROP TABLE IF EXISTS Articles;
CREATE TABLE Articles
(
	id		int NOT NULL auto_increment primary key,
	title		varchar(255) NOT NULL,
	author  	varchar(100) NOT NULL,
	body		text NOT NULL,
	uploadDate	date NOT NULL,
	image		varchar(255)
);

/*
	Holds the text for the about container on the club page.
	id: 	a unique key particular to each about text
	body:	the main text of the about container on the club page (max of 65,535 characters)
*/
DROP TABLE IF EXISTS About;
CREATE TABLE About
(
	id		int NOT NULL auto_increment primary key,
	body		text NOT NULL
);

/*
	Insert blank links for all 4 social media buttons by default so that they are known to exist
*/
INSERT INTO Links( title, link, placement ) VALUES( 'facebook' , '' , 'social' );
INSERT INTO Links( title, link, placement ) VALUES( 'twitter' , '' , 'social' );
INSERT INTO Links( title, link, placement ) VALUES( 'youtube' , '' , 'social' );
INSERT INTO Links( title, link, placement ) VALUES( 'instagram' , '' , 'social' );

/*
	Insert blank links for all 3 featured images by default.
*/
INSERT INTO Links( title, link, placement ) VALUES( '' , '' , 'featured' );
INSERT INTO Links( title, link, placement ) VALUES( '' , '' , 'featured' );
INSERT INTO Links( title, link, placement ) VALUES( '' , '' , 'featured' );

/*
	Insert a blank about body for the club page to have empty about by default.
*/
INSERT INTO About( id , body ) VALUES( 1 , '' );

/*
	Insert a home link for the header.
	Insert a events link for the news feed.
	Insert a link to the admin panel to the footer.
*/
INSERT INTO Links( title, link, placement ) VALUES( 'Home' , 'index.php' , 'top' );
INSERT INTO Links( title, link, placement ) VALUES( 'Events' , 'newsfeed.php' , 'top' );
INSERT INTO Links( title, link, placement ) VALUES( 'Admin' , 'admin.php' , 'bottom' );

/*
==========================================================================
REMOVE EVERYTHING PAST HERE WHEN IN PRODUCTION, BELOW IS FOR TESTING
==========================================================================
*/
/*
INSERT INTO Editors( id, username ) VALUES( 1 , 'djenkins1' );
INSERT INTO Articles( title, author, body, uploadDate, image ) VALUES( 'Spring Fling Director Applications Out' , 'Dilan' , 'After 42 years there’s still nothing else like it! Associated Students of the University of Arizona’s Spring Fling is back again! Starting back in 1974, Spring Fling has become an iconic figure by providing carnival rides, games, food booths, and entertainment to both the University of Arizona and Tucson communities.' , CURDATE(), 'images/A.png' );
INSERT INTO Articles( title, author, body, uploadDate, image ) VALUES( 'Street Team Apps Due Thursday' , 'Dilan' , 'After 42 years there’s still nothing else like it! Associated Students of the University of Arizona’s Spring Fling is back again! Starting back in 1974, Spring Fling has become an iconic figure by providing carnival rides, games, food booths, and entertainment to both the University of Arizona and Tucson communities.After 42 years there’s still nothing else like it! Associated Students of the University of Arizona’s Spring Fling is back again! Starting back in 1974, Spring Fling has become an iconic figure by providing carnival rides, games, food booths, and entertainment to both the University of Arizona and Tucson communities.' , CURDATE(), 'images/A.png' );
INSERT INTO Articles( title, author, body, uploadDate, image ) VALUES( 'Testing' , 'Dilan' , 'Testing body 3' , CURDATE(), 'images/A.png' );
INSERT INTO Articles( title, author, body, uploadDate, image ) VALUES( 'Testing' , 'Dilan' , 'Testing body 4' , CURDATE(), 'images/A.png' );
INSERT INTO Articles( title, author, body, uploadDate, image ) VALUES( 'Testing' , 'Dilan' , 'Testing body 5' , CURDATE(), 'images/A.png' );
INSERT INTO Articles( title, author, body, uploadDate, image ) VALUES( 'Testing' , 'Dilan' , 'Testing body 6' , CURDATE(), 'images/A.png' );
INSERT INTO Articles( title, author, body, uploadDate, image ) VALUES( 'Testing' , 'Dilan' , 'Testing body 7' , CURDATE(), 'images/A.png' );
INSERT INTO Articles( title, author, body, uploadDate, image ) VALUES( 'Testing' , 'Dilan' , 'Testing body 8' , CURDATE(), 'images/A.png' );
INSERT INTO Articles( title, author, body, uploadDate, image ) VALUES( 'Testing' , 'Dilan' , 'Testing body 9' , CURDATE(), 'images/A.png' );
INSERT INTO Articles( title, author, body, uploadDate, image ) VALUES( 'Testing' , 'Dilan' , 'Testing body 10' , CURDATE(), 'images/A.png' );
INSERT INTO Articles( title, author, body, uploadDate, image ) VALUES( 'Testing' , 'Dilan' , 'Testing body 11' , CURDATE(), 'images/A.png' );
INSERT INTO Articles( title, author, body, uploadDate, image ) VALUES( 'Testing' , 'Dilan' , 'Testing body 12' , CURDATE(), 'images/A.png' );
INSERT INTO Articles( title, author, body, uploadDate, image ) VALUES( 'Testing' , 'Dilan' , 'Testing body 13' , CURDATE(), 'images/A.png' );
INSERT INTO Links( title, link, placement ) VALUES( 'About' , '#' , 'top' );
INSERT INTO Links( title, link, placement ) VALUES( 'Contact Us' , '#' , 'top' );
INSERT INTO Links( title, link, placement ) VALUES( 'About' , '#' , 'bottom' );
INSERT INTO Links( title, link, placement ) VALUES( 'Contact' , '#' , 'bottom' );
INSERT INTO Links( title, link, placement ) VALUES( 'Hours' , '#' , 'bottom' );
INSERT INTO Links( title, link, placement ) VALUES( 'Resource' , '#' , 'bottom' );
INSERT INTO Links( title, link, placement ) VALUES( 'Application' , '#' , 'bottom' );
*/



