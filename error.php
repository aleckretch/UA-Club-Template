<?php
require_once './banner.php';
$error = "";
if ( isset( $_GET[ 'error'] ) )
{
	$error = $_GET['error'];
}
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Arizona Notes</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/fonts.css">
	<script src="js/jquery-2.1.4.min.js"></script>
	<script src="js/main.js"></script>
	<script src="js/title.js"></script>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<script src="./js/jquery.wysibb.js"></script>
	<link rel="stylesheet" href="./css/default/wbbtheme.css" />

</head>
<body>

<div class="header theme-red">
	<div class="ua_header  clearfix">
		<div class="pull-left">
			<img src="images/svg+xml.svg">
		</div>
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
<?php outputHeaderLinks();?>
</div>
<div class="main_content" style='min-height: 10em;'>
	<div id="mainContent">
		<?php echo Database::sanitizeData( $error );?>
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

