DROP DATABASE IF EXISTS CLUB;
CREATE DATABASE CLUB   
DEFAULT CHARACTER SET utf8
DEFAULT COLLATE utf8_general_ci;
USE CLUB;

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
	This holds the top menu items for the club page.

	id: 	a unique key particular to each menu item
	title: 	the title for the menu item
	link:	the link the menu item redirects to
*/
DROP TABLE IF EXISTS Top;
CREATE TABLE Top
(
	id		int NOT NULL auto_increment primary key,
	title	varchar(100) NOT NULL,
	link	varchar(255) NOT NULL
);

/*
	This holds the bottom menu items for the club page.

	id: 	a unique key particular to each menu item
	title: 	the title for the menu item
	link:	the link the menu item redirects to
*/
DROP TABLE IF EXISTS Bottom;
CREATE TABLE Bottom
(
	id		int NOT NULL auto_increment primary key,
	title	varchar(100) NOT NULL,
	link	varchar(255) NOT NULL
);

/*
	This holds the featured items for the club page.

	id: 	a unique key particular to each featured item
	link:	the link the featured item redirects to
	image:	the filename of the image to be displayed
*/
DROP TABLE IF EXISTS Featured;
CREATE TABLE Featured
(
	id		int NOT NULL auto_increment primary key,
	link	varchar(255) NOT NULL,
	image	varchar(255) NOT NULL
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
	title	varchar(255) NOT NULL,
	author  varchar(100) NOT NULL,
	body	text NOT NULL,
	uploadDate	date NOT NULL,
	image	varchar(255)
);