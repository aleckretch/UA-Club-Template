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
	<title>UA Club Template</title>

	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/fonts.css">
	<script src="js/jquery-2.1.4.min.js"></script>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<script src="./js/title.js"></script>

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
			width:auto;
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
		
		.content {
			margin: 0 auto;
			width: 90%;
			text-align: center;
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
			<div class="nav_cel col-sm-3 col-xs-6"><a href="newsfeed.php">Events</a></div>
			<div class="nav_cel col-sm-3 col-xs-6"><a href="default.asp">Contact Us</a></div>
			<div class="nav_cel col-sm-3 col-xs-6"><a href="default.asp">About</a></div>
		
			
		</div>
<style>
	.main_content{
		position: relative;
	}
	.contentpage{
	    background-color: rgba(255, 255, 255, 0.0);

 	    margin: 0 5%;

 	    max-height: 1000px;

 	    padding: 1%;
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
    .about h1{
        font-size: 75px;
        color: rgba(229, 229, 229, 0.8);
        text-align: center;
        font-family: MiloOT-Thin;
        font-weight: bold;
    }
    .newsbox{
        max-height:200px;
        background-color: rgba(229, 229, 229, 0.6);
        padding-bottom: 5px;
    }
    .newsbox h1, h2, p{
        padding-left: 5px;
    }
    .newsbox h1 a{
        padding-top: 5px;
        line-height:-8px;
        font-size: 25px;
        font-family: MiloOT-Medi;
        color: #AC0820;
    }
    .newsbox h2{
        line-height:1px;
        font-size: 15px;
        font-family: MiloOT-Thin;
        color: grey;
    }
    .newsbox p{
        font-family: MiloOT-Thin;
        font-weight: bold;
    }
    #pageindicator ul {
        margin: 0;
        padding: 30px;
        list-style-type: none;
        text-align:center;
    }

    #pageindicator li { margin: 0 0 .2em 0; display: inline; padding: 2px;} 
    #pageindicator a {
        display: inline;
        color: #CC665E;
        background-color: rgba(229, 229, 229, 0.6);
        padding: .2em .5em;
        text-decoration: none;
        font-size: 30px;
        font-family: MiloOT-Bold;
    }

    #pageindicator a:hover {
        background-color: #0C234B;
        color: #FFF;
    }

    #active a {
        display: inline;
        color: #FFF;
        background-color: #AB0520;
        padding: .2em .5em;
        text-decoration: none;
    }
	}
	
</style>
<div class="main_content">
	<div class="jumbotron_area">
		<img src="images/140728-eng-rooftop-0037-x3.jpg" />
	</div>

	<div class="contentpage">
		<div class="about">
			<h1> News & Events</h1>
		</div>
  			
			<?php 
			$article_count = 0;
			$article_limit = 6;
			if (empty($articles)) {
				echo "No articles found.";
			} else {
			
				$article_count = count($articles);
				if ( isset($_GET['page'])) 
				{
					$page = $_GET['page'];
					$offset = $article_limit * ($page - 1);
				} 
				else 
				{
					$page = 1;
					$offset = 0;
				}
				
				$current_articles = Database::getArticlesForNewsfeed($offset, $article_limit);
				if ( empty( $current_articles ) )
				{
					echo "No articles found for this page.";
				}
				foreach ($current_articles as $article) {
				?>
				<div class="newsbox">
					<h1><a href="article.html?id=<?php echo $article['id'];?>"><?php echo $article['title'];?></a></h1>
					<h2> Posted: <?php echo $article['uploadDate'];?> </h2>
					<p> <?php  $articleBody = $article['body'];
					if(strlen($articleBody) > 356) {
                        $articleBody = substr($articleBody, 0 ,355);
                    }
                    echo $articleBody; ?></p>
				</div>
				<?php } 
				} ?>
		
		<div id="pageindicator">
            <ul>
            	<?php
            	for ($i = 1; $i <= ceil($article_count / $article_limit); $i++) {
            		?> <li <?php
            		if ($i == $page) { echo 'id="active"';}?>>
            		<a href="newsfeed.php?page=<?php echo $i;?>" > <?php echo $i;?></a>
            		</li>
            	<?php } ?>
            </ul>
        </div>
	</div>

    	<div>
	
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
				<a href="newsfeed.php">Contact</a> - 
				<a href="#">Hours</a> -
				<a href="#">Resource</a> -
				<a href="#">Application</a>
				
			</div>
			<div class="col col-sm-4 text-center" >
				<a href="" style="color:black"><i class="fa fa-facebook-official"></i></a>
				<a href="" style="color:black"><i class="fa fa-instagram"></i></a>
				<a href="" style="color:black"><i class="fa fa-youtube-play"></i></a>
				<a href="" style="color:black"><i class="fa fa-twitter-square"></i></a>
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
<script>
	$('.ua_header .pull-right').on('click',function(){
		$('.pull-right').toggleClass('expand');
		$('.search_input').focus();
	})
	
	var index = 0;    //jumbtorm slide image index 
	
	$('.bullet').on('click',function(){
			var selected_index = $(this).index();
			var diff =  selected_index - index  ;
			$('.jumbotron_area .jumb_image').animate({
				left: '-='+100.5*diff +'%',
				
			})
			index = selected_index
		
	})
	
	function nextImg(){
		var diff = 1;
		console.log($('.jumbotron_area .jumb_image').length)
		if (index >= $('.jumbotron_area .jumb_image').length -1 )
			{
			diff = -1 * ($('.jumbotron_area .jumb_image').length-1);
			index = 0;	
			}
		else{
				index+=1;
		}
		$('.jumbotron_area .jumb_image').animate({
				left: '-='+100.5*diff +'%',	
			})
	}
	
	setInterval(nextImg,5000)
	
	
</script>
</html>
