<?php
    require_once './banner.php';
?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Arizona Notes</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/fonts.css">
	<link rel="stylesheet" type="text/css" href="css/xbbcode.css">
	<script src="js/jquery-2.1.4.min.js"></script>
	<script src="./js/main.js"></script>
	<script src="js/admin.js"></script>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<script src="./js/jquery.wysibb.js"></script>
	<script src="./js/title.js"></script>
	<link rel="stylesheet" href="./css/default/wbbtheme.css" />
</head>
<body>
<div class="header theme-red">
	<div class="ua_header  clearfix">
			<a href="http://www.arizona.edu/">
			<div class="left">
				<img src="images/svg+xml.svg">
			</div>
				</a>
		<div class="pull-right">
			<a href="#">
				
				<span class="glyphicon glyphicon-search"></span>
				<input class="search_input" type="text"/>
			</a>
		</div>
	</div>



</div>
<div class="logo">
	<img src="images/logo.png" />

</div>



<div class="nav row">
		<?php outputHeaderLinks(); ?>	
</div>
<br>
<div class="main_content" style='min-height: 10em;'>
	<div id="mainContent" class='contentpage' style='margin-left: 10%;'>
		<div>
			<select id='changer'>
				<option value='editor' selected>Change Editors</option>
				<option value='social'>Social Media</option>
				<option value='top'>Header Links</option>
				<option value='bottom'>Footer Links</option>
				<option value='logo'>Change Logo</option>
				<option value='about'>Change About</option>
				<option value='featured'>Change Featured</option>
				<option value='article'>Add Article</option>
				<option value='articles'>Edit Articles</option>
			</select>
			-
			<a href='login.php?logout=yes'>Login / Logout</a>
		</div>
		<div id="changedContent">

		</div>
	</div>
	<div class="sub_logo">
		
	</div>
	<img class="sub_logo_img" src="images/ua_stack_rgb_red.png">
	
	<img class="bg_img" src="images/Layer-1.png" />
	
</div>

<div class="footer">
	<div class="row">
		<div class="col col-sm-8  text-center">
			<?php outputFooterLinks(); ?>
		</div>
		<div class="col col-sm-4 text-center social-icon" >
			<?php outputSocialLinks(); ?>
		</div>
	</div>
	<br>
	<div class="row" style="font-size:0.8em; text-align:center;  font-weight: 900" >
	<p > All contents of this site are the property of the Associated Students of The University of Arizona. &copy; 2015 Arizona Board of Regents</p>
	</div>
</div>
<footer>

</footer>
</body>

</html>

