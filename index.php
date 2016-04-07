<?php
    require_once './database.php';

    $aboutArray = Database::getAbout();
    $aboutText = $aboutArray['body'];

    $links = Database::getSocialLinks();
    $facebookLink = $links['facebook'];
    $twitterLink = $links['twitter'];
    $instagramLink = $links['instagram'];
    $youtubeLink = $links['youtube'];

    $articles = Database::getAllArticles();
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
	<script src="js/xbbcode.js"></script>
	<script src="js/main.js"></script>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>


	<style>
		body {
			width:100%;
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
			
			white-space: nowrap;
			text-align: center;
			overflow: hidden;
		}
		.jumbotron_area img {
			width: 90%;
			
		}
		.jumb_image{
			position: relative;
			width: 100%;
			display: inline-block;
			
		
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
		.ua_header .left{
			position: absolute;
				top:5px;
		}
		.ua_header img {
			margin-left: 3px;
			height: 60px;
		}
		.pull-right{
			float: none;
			right:0px;
				height: 60px;
			
		}
		.pull-right .glyphicon-search {
			line-height: 60px;
			font-size: 2.5em;
		
			color: white;
			padding-right: 10px;
			transition:  all .3s ;
		}
		.search_input{
			right:10px;
			height: 40px;
		
			width:0px;
			padding: 0;
			margin: 0;
			border: 0;
			border: none;
			font-family:MiloOT-Thin;
			transition:  all .3s ;
			  
		}
		.search_input:focus{
			 outline-width: 0;
		}
		.pull-right.expand .search_input{
			border-left: 30px white solid;
			
			font-size: 2em;
			width:150px;
			 transition:  all .3s ; 
			
		}
		.pull-right.expand .glyphicon-search{
			transition:  all .5s ; 
			font-size: 1em;
			color:#AC0820;
			right:-40px;
			font-size: 1.6em;
		}
	</style>
	<div class="header theme-red">
		<div class="ua_header  clearfix">
			<div class="left">
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
	
	
	
</style>
<div class="main_content">
	<div class="jumbotron_area">
		<div class="jumb_image">
			<img src="images/Layer-10.png" />
		</div>
		<div class="jumb_image">
			<img src="http://mosaic.arizona.edu/sites/mosaic.arizona.edu/themes/mosaic/images/banner_image01.jpg" />
		</div>
		<div class="jumb_image">
			<img src="http://www.greatvaluecolleges.net/wp-content/uploads/2014/07/university-of-arizona.jpg" />
		</div>
		
		
		
		
	</div>
	<div class="bullets">
			<a class="bullet"></a>
			<a class="bullet"></a>
			<a class="bullet"></a>
		</div>

	<div class="content row" style="padding-bottom:80px" >
		<div class="about col col-xs-12 col-sm-6">
			<h1>About</h1>
			<div class="">
				<div class="col-xs-12 text_box">
					<div id="aboutTextContent" class="">
						<?php if($aboutText === "") { echo "There is currently no About section."; } else { echo $aboutText; } ?>
					</div>
				</div>
			</div>



		</div>

		<div class="upcoming col col-xs-12 col-sm-6">
					<h1>Latest News</h1>
            
            <div class="">
                <div class=" text_box col-xs-12">
            <?php 
                $articleBody = $articles['0']['body'];
                    
                if(empty($articles)) {
                    echo "<p> There are no news to display";
                } else {
                    if(strlen($articleBody) > 356) {
                        $articleBody = substr($articleBody, 0 ,355);
                    }
                    echo "<p class='title'>" . $articles['0']['title'];
                    echo "<p>" . $articleBody;
                }
            
            ?>
                </div>
            </div>
            
            
            <?php 
                
                if(isset($articles[1])) {
                    $articleBody = $articles['1']['body'];
                    
                    if(strlen($articleBody) > 356) {
                        $articleBody = substr($articleBody, 0 ,355);
                    }
                    
                    echo '<div class="">
                <div class=" text_box col-xs-12">';
                    echo "<p class='title'>" . $articles['1']['title'];
                    echo "<p>" . $articleBody;
                    echo '</div>
            </div>';
                }
            
            ?>

		</div>
	</div>
	
	
	
	
	<div class="sub_logo">
		
	</div>

	<img class="sub_logo_img" src="images/Layer-9.png">
	

	
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
		.footer .links a{
			color:#b1aeab;
		}
		.footer .nav{
			margin: 0 auto;
			
		}
		
	</style>

	<div class="footer">
		<div class="row ">
			<div class="col col-sm-8  text-center links">
				<a href="#">About</a> - 
				<a href="#">Contact</a> - 
				<a href="#">Hours</a> -
				<a href="#">Resource</a> -
				<a href="#">Application</a>
				
			</div>
			<div class="col col-sm-4 text-center" >

		<?php
                
                    if($facebookLink !== "") {
                        echo '<a href="' . $facebookLink . '" style="color:black"><i class="fa fa-facebook-official"></i></a>';
                    }
                    if($instagramLink !== "") {
                        echo '<a href="' . $instagramLink . '" style="color:black"><i class="fa fa-instagram"></i></a>';
                    }
                    if($youtubeLink !== "") {
                        echo '<a href="' . $youtubeLink . '" style="color:black"><i class="fa fa-youtube-play"></i></a>';
                    }
                    if($twitterLink !== "") {
                        echo '<a href="' . $twitterLink . '" style="color:black"><i class="fa fa-twitter-square"></i></a>';
                    }
                
                ?>
                
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