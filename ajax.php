<?php
require_once "./database.php";
require_once "./session.php";

//TODO: Need to add links for other admin forms into the HTML in admin.php
//TODO: Need to add form.php and form processing
if ( isset( $_GET['admin'] ) )
{
	if ( !Session::userLoggedIn() )
	{
		echo "";
		exit();
	}

	$admin = $_GET['admin'];
	$token = Session::token();
	if ( $admin === "editor" )
	{
?>
	<h1>
		Add Editor
	</h1>
	<form method='post' action='form.php?editor=yes'>
		Editor NetID:<br><input type='text' name='user' required><br>
		<input type='hidden' name='token' value='<?php echo $token;?>'>
		<input type='submit' value='Add'>
	</form>
<?php
	}
	else if ( $admin === "top" )
	{
		//link form to add links to header
	}
	else if ( $admin === "bottom" )
	{
		//link form to add links to footer
	}
	else if ( $admin === "social" )
	{
		//TODO: show current values in DB for each link
		//four inputs for links, Instagram, Twitter, Facebook, and Youtube.
?>
	<h1>
		Social Media
	</h1>
	<form method='post' action='form.php?social=yes'>
		Facebook:<br><input type='text' name='facebook'><br>
		Instagram:<br><input type='text' name='instagram'><br>
		Twitter:<br><input type='text' name='twitter'><br>
		Youtube:<br><input type='text' name='youtube'><br>
		<input type='hidden' name='token' value='<?php echo $token;?>'>
		<input type='submit' value='Save'>
	</form>
<?php
	}
	else if ( $admin === "logo" )
	{
		//upload form for adding a logo, overwrites current logo when uploaded
	}
	else if ( $admin === "about" )
	{
		// a WYSIWYG text editor and a save button. This will be the about text on the home page.
	}
	else if ( $admin === "featured" )
	{
		//three spots to enter a link and upload an image. This will be for the home page featured section.
	}
	else if ( $admin === "article" )
	{
		// a WYSIWYG text editor paragraph for article, and regular for title and author, and a save button and an optional image upload.
	}
	else if ( $admin === "articles" )
	{
		// a list of all articles from most recently posted at top to older at bottom and an x button to delete an article. Should give a warning before deleting.
	}
	else
	{
		echo "Not a request";
	}
	exit();
}
