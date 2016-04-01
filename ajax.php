<?php
require_once "./database.php";
require_once "./session.php";

if ( isset( $_GET['admin'] ) )
{
	if ( !Session::userLoggedIn() )
	{
		echo "You do not have permission to view this form. <a href='login.php'>Login</a><br>";
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
	else if ( $admin === "top" || $admin === "bottom" )
	{
		//link form to add links to header
		//TODO: NEED TO HANDLE FORM PROCESSING IN form.php
	?>
	<h1>
		Add Link To <?php echo ucfirst( $admin );?>
	</h1>
	<form method='post' action='form.php?link=<?php echo $admin;?>'>
		Link Title:<br><input type='text' name='title' required><br>
		Link URL:<br><input type='text' name='href' required><br>
		<input type='hidden' name='token' value='<?php echo $token;?>'>
		<input type='submit' value='Add'>
	</form>
	<?php
	}
	else if ( $admin === "social" )
	{
		$links = Database::getSocialLinks();
	?>
	<h1>
		Social Media Links
	</h1>
	<h5>
		Please use the URL of your profile.
	</h5>
	<form method='post' action='form.php?social=yes'>
	<?php
		foreach( $links as $key=>$value )
		{
			echo ucfirst( $key ) . "<br><input type='text' name='${key}' value='${value}'><br>";
		}
	?>
		<input type='hidden' name='token' value='<?php echo $token;?>'>
		<input type='submit' value='Save'>
	</form>
	<?php
	}
	else if ( $admin === "logo" )
	{
		//upload form for adding a logo, overwrites current logo when uploaded
		//TODO: NEED TO HANDLE FORM PROCESSING IN form.php
	?>
	<h1>
		Change Logo Image
	</h1>
	<h5>
		Uploading a new image will overwrite the old logo.
	</h5>
	<form method='post' enctype='multipart/form-data' action='form.php?link=logo'>
		<img src='images/logo.png' alt='Club Logo' width=100 height=100><br>
		Logo Image:<br><input type='file' name='logo' required><br>
		<input type='hidden' name='token' value='<?php echo $token;?>'>
		<input type='submit' value='Change'>
	</form>
	<?php
	}
	else if ( $admin === "about" )
	{
		// a WYSIWYG text editor and a save button. This will be the about text on the home page.
		//TODO: NEED TO HANDLE FORM PROCESSING IN form.php
	}
	else if ( $admin === "featured" )
	{
		//three spots to enter a link and upload an image. This will be for the home page featured section.
		//TODO: NEED TO HANDLE FORM PROCESSING IN form.php
	?>
	<h1>
		Change Featured Images
	</h1>
	<h5>
		Uploading a new image will overwrite the old image.
	</h5>
	<form method='post' enctype='multipart/form-data' action='form.php?link=logo'>
	<?php
	$featured = Database::getFeatured();
	foreach ( $featured as $key=>$row )
	{
		$i = $key + 1;
		echo "<br><img src='images/${row['title']}' alt='Featured Image ${i}' width=50 height=50/><br>";
		echo "Featured ${i} Image:<br><input type='file' name='f${i}Image'><br>";
		echo "Featured ${i} Link:<br><input type='text' name='f${i}Text' value='${row['link']}'><br>";
	}
	?>
		<input type='hidden' name='token' value='<?php echo $token;?>'>
		<input type='submit' value='Change'>
	</form>
	<?php
	}
	else if ( $admin === "article" )
	{
		// a WYSIWYG text editor paragraph for article, and regular for title and author, and a save button and an optional image upload.
		//TODO: NEED TO HANDLE FORM PROCESSING IN form.php
	}
	else if ( $admin === "articles" )
	{
		// a list of all articles from most recently posted at top to older at bottom and an x button to delete an article. Should give a warning before deleting.
		//TODO: NEED TO HANDLE FORM PROCESSING IN form.php
	}
	else
	{
		echo "Not a request";
	}
	exit();
}
