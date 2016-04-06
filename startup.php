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
		Maybe get the host for the database, see config.php of server for senate website.
		The netid of the very first editor so that other editors can be added through admin panel.
		The login banner for the site, which shows up when trying to login via netid to the admin panel.
			Might also use this as the title for every page on the site
		Get the url for the club site, i.e http://cs.arizona.edu
			Should add in the login.php to the end for netid login redirect
	All of these inputs should be spat out into the config.php file that will be generated/overwritten
	The script will then setup the database, creating the tables and inserting default values for the various content
*/
