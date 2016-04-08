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
	echo "<script>PHP_TOKEN = \"${token}\";</script>";
	if ( $admin === "editor" )
	{
	?>
	<h1>
		Add Editor
	</h1>
	<div>
	<div style='float: left;'>
	<form method='post' action='form.php?editor=yes'>
		Editor NetID:<br><input type='text' name='user' required><br>
		<input type='hidden' name='token' value='<?php echo $token;?>'>
		<input type='submit' value='Add'>
	</form>
	</div>
	<div style='float: right;'>
	<?php
		//TODO: Clean up the styling of this, add a background...
		$editors = Database::getAllEditors();
		foreach( $editors as $editor )
		{
			//TODO: Add onclick to send ajax request
			echo "<span>${editor['username']} - <a href='#' title='Remove'>X</a></span>";
		}
	?>
	</div>
	<div style='clear: both;'>
	</div>
	</div>
	<?php
	}
	else if ( $admin === "top" || $admin === "bottom" )
	{
		//link form to add links to header
		//TODO: Wait until styling for showing/removing editors is done then use here
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
	?>
	<h1>
		Change Logo Image
	</h1>
	<h5>
		Uploading a new image will overwrite the old logo.
	</h5>
	<form method='post' enctype='multipart/form-data' action='form.php?logo=yes'>
		<img src='images/logo.png' alt='Club Logo' height=100><br>
		Logo Image:<br><input type='file' name='file' required><br>
		<input type='hidden' name='token' value='<?php echo $token;?>'>
		<input type='submit' value='Change'>
	</form>
	<?php
	}
	else if ( $admin === "about" )
	{
		// a WYSIWYG text editor and a save button. This will be the about text on the home page.
		$about = Database::getAbout();
	?>
	<h1>
		Edit About
	</h1>
	<form method='post' action='form.php?about=yes'>
		<input type='hidden' name='token' value='<?php echo $token;?>'>
		<span class='text'>About Text:</span><br>
		<textarea id='text' name='text' rows='10'><?php echo Database::unsanitizeData( $about[ "body" ] );?></textarea><br>
		<input type='submit' value='Change'><br><br><br>
		<script>
			$('#text').wysibb();
		</script>
	</form>
	<?php
	}
	else if ( $admin === "featured" )
	{
		//three spots to enter a link and upload an image. This will be for the home page featured section.
	?>
	<h1>
		Change Featured Images
	</h1>
	<h5>
		Uploading a new image will overwrite the old image.
	</h5>
	<form method='post' enctype='multipart/form-data' action='form.php?featured=yes'>
	<?php
	$featured = Database::getFeatured();
	foreach ( $featured as $key=>$row )
	{
		$i = $key + 1;
		echo "<br><img src='${row['title']}' alt='Featured Image ${i}' height=50/><br>";
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
	?>
	<h1>
		Add Article
	</h1>
	<form method='post' enctype='multipart/form-data' action='form.php?article=yes'>
		<input type='hidden' name='token' value='<?php echo $token;?>'>
		<span class='text'>Author:</span><br>
		<input type='text' name='author' size='30' required><br>
		<span class='text'>Title:</span><br>
		<input type='text' name='title' size='30' required><br>
		<span class='text'>Post:</span><br>
		<textarea id='text' name='text' rows='10'></textarea><br>
		Article Image(Optional):<br><input type='file' name='file'><br>
		<input type='submit' value='Create'>
		<script>
			$('#text').wysibb();
		</script>
	</form>
	<?php
	}
	else if ( $admin === "articles" )
	{
		// a list of all articles from most recently posted at top to older at bottom and an x button to delete an article. Should give a warning before deleting.
		$articles = Database::getAllArticles();
		foreach ( $articles as $article )
		{
	?>
		<div id="article<?php echo $article['id'];?>">
			<img src="<?php echo $article['image'];?>" alt="Article Image" height=50>
			<span><?php echo $article[ 'uploadDate' ];?> - </span>			
			<span><?php echo $article[ 'title' ];?> - </span>
			<button type='button' onclick="removeArticle( <?php echo $article['id'];?> );">Remove</button>
		</div>
	<?php
		}
	}
	else
	{
		echo "Not a request";
	}
	exit();
}
else if ( isset( $_GET['removed'] ) && $_GET['removed'] === "article" )
{
	if ( !Session::userLoggedIn() )
	{
		echo "Not logged in";
		exit();
	}

	if ( !isset( $_POST['token'] ) || !Session::verifyToken( $_POST['token'] ) )
	{
		echo "Missing token or invalid token";
		exit();
	}

	if ( !isset( $_POST[ 'remove'] ) )
	{
		echo "Missing article id";
		exit();
	}

	Database::removeArticle( $_POST[ 'remove'] );
	echo "true";
	exit();
}
else if ( isset( $_GET['articlePage' ] ) )
{
	if ( $_GET['articlePage'] === "recent" )
	{
		$results = Database::getMostRecentArticle();
		echo json_encode( $results );
	}
	else
	{
		$results = Database::getArticleByID( $_GET['articlePage'] );
		echo json_encode( $results );
	}
	exit();
}
else if ( isset( $_GET['title'] ) )
{
	echo Database::sanitizeData( Config::$NET_LOGIN_BANNER );
	exit();
}
