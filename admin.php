<?php
	require_once "./database.php";
	require_once "./session.php";
	if ( !Session::userLoggedIn() )
	{
		header( "Location: login.php" );
		exit();
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
	<script src="js/admin.js"></script>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>


	<style>
		body {
			min-height: 1000px;
			position: relative;
		}
		a{
			text-decoration: none !important;
			
		}
		.theme-red {
			background: #AC0820;
		}
		
		
		.logo {
			height: 200px;
			display: flex;
			align-items: center;
			justify-content: center;
		}
		.logo img {
			margin: 10px;
			height: 60%;
		}
		.nav {
			width: 90%;
			margin: 0 auto;
			margin-bottom: 10px;
		}
		.nav_cel {
			height:50px;
			list-style-type: none;
			margin: 0;
			//padding: 5px;
			overflow: hidden;
			background-color: #e3dada;
			text-align: center;
			line-height: 50px;
		}
		 

		.nav_cel a {
			font-family: MiloOT-Bold;
			font-size: 1.5em;
			color: white;
			text-align: center;
			padding: 6px 8px;
			border-radius: 5px;
			color: #AC0820;
			text-decoration: none;
		}
		
		.nav_cel a:hover {
			background-color: #AC0820;
			color: white;
			text-decoration: none;
		}
		.jumbotron_area {
			width: 90%;
			margin: 0 auto;
		}
		.jumbotron_area img {
			width: 100%;
		}
		.bullets {
			margin: 0 auto;
			text-align: center;
			margin-top:10px;
		}
		
		.content {
			margin: 0 auto;
			width: 90%;
			text-align: center;
		}
		.row .text_box {
			margin-bottom: 10px;
		}
		.content .text_box {
			padding: 10px;
			padding-left: 7px;
			padding-right: 7px;
			background: rgba(221, 203, 193, 0.6);
			min-height: 100px;
			width: 100%;
		}
		.text_box {
			font-family: MiloOT-Thin;
			font-size: 1.5em;
		}
		.text_box .title {
			font-family: MiloOT-Medi;
			color: #AC0820;
		}
		.about .text_box {
			min-height: 250px;
		}
		.upcoming .text_box {
			min-height: 120px;
		}
		.upcoming h1,
		.about h1 {
			font-family: MiloOT-Medi;
			font-size: 3em;
			color: rgb(165, 164, 172);
		}
	</style>

</head>

<body>
	<style>
		.header {
			height: 80px;
			//border: 1px solid black;
			width: 100%;
		}
		.ua_header {
			height: 60px;
			padding: 10px;
		}
		.ua_header img {
			margin-left: 3px;
			height: 60px;
		}
		.pull-right .glyphicon-search {
			line-height: 60px;
			font-size: 2.5em;
			height: 60px;
			color: white;
			padding-right: 10px;
		}
	</style>
	<div class="header theme-red">
		<div class="ua_header  clearfix">
			<div class="pull-left">
				<img src="images/svg+xml.svg">
			</div>
			<div class="pull-right">
				<a href="#">
					<span class="glyphicon glyphicon-search"></span>
				</a>
			</div>
		</div>



	</div>
	<div class="logo">
		<img src="images/Layer-8.png" />

	</div>

	
	
	<div class="nav row">
			<div class="nav_cel col-sm-3 col-xs-6"><a href="default.asp">Home</a></div>
			<div class="nav_cel col-sm-3 col-xs-6"><a href="default.asp">Events</a></div>
			<div class="nav_cel col-sm-3 col-xs-6"><a href="default.asp">Contract Us</a></div>
			<div class="nav_cel col-sm-3 col-xs-6"><a href="default.asp">About</a></div>
		
			
		</div>
<style>
	.main_content{
		position: relative;
	}
	.bg_img {
		position: absolute;
		width:100%;
		 bottom: 0px;
    	z-index: -1;
	}
	.main_content .sub_logo{
		position: absolute;
		bottom: 0px;
		margin: 0 auto;
		width:0px;
		left:0;
		right:0;
		
		border-top:transparent 80px solid;
		border-right:transparent 70px solid;
		border-left:transparent 70px solid;
		border-bottom:#e3e3e3 80px solid;
	}
	
	.main_content  .sub_logo_img{
		position: absolute;
		width: 70px;
		bottom: -10px;
		margin: 0 auto;
		left:0;
		right:0;
		
		
	}
	
	.bullet{
		display: inline-block;
		width:20px;
		height:20px;
		border-radius:20px;
		background: #EBC4CA;
	}
	.bullet:hover{
		background:#AC0820;
	}

	#mainContent
	{
		margin-left: 20%;
	}
	
</style>
<div class="main_content">
	<div class="jumbotron_area">
		<img src="images/Layer-10.png" />
		
		<div class="bullets">
			<a class="bullet"></a>
			<a class="bullet"></a>
			<a class="bullet"></a>
		</div>
	</div>

	<div id="mainContent">

	</div>
	<div class="sub_logo">
		
	</div>
	<img class="sub_logo_img" src="images/ua_stack_rgb_red.png">
	
	<img class="bg_img" src="images/Layer-1.png" />
	
	</div>


	
	
	<style>
		.footer{
			//height:100px;
			background: #e2e2e2;
			padding:30px;
			font-family:MiloOT-Thin;
			font-size: 1.5em;
			
		}
		.footer a{color:#b1aeab;}
		.footer .nav{
			margin: 0 auto;
			
		}
		
	</style>

	<div class="footer">
		<div class="row">
			<div class="col col-sm-8  text-center">
				<a href="#">About</a> - 
				<a href="#">Contact</a> - 
				<a href="#">Hours</a> -
				<a href="#">Resource</a> -
				<a href="#">Application</a>
				
			</div>
			<div class="col col-sm-4 text-center">
				<img src="images/social-icons.png" style="height:1.5em;">
				
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

