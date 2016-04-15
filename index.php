<?php
require_once './banner.php';

    // Vars for connecting About section

    $aboutArray = Database::getAbout();
    $aboutText = $aboutArray['body'];

    $articles = Database::getAllArticles();

    // Vars for connecting Featured items

    $featuredItems = Database::getLinksByPlacement("featured");

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
	<script src="./js/title.js"></script>
	<!-- dont remove nav content css, if do so, the style will changes, I dont know why it happens, I will double check how to move them to css file, but as for now, keep them -->
	<style>
		
	.nav {    
	width: 90%;
	margin: 0 auto;
	margin-bottom: 10px;
}
.content {
	margin: 0 auto;
	width: 90%;
	text-align: center;
}

	</style>
</head>

<body>
	
	<div class="header theme-red">
		<div class="ua_header  clearfix">
			<div class="left">
				<img src="images/svg+xml.svg">
			</div>
			<div class="pull-right">
				<a href="#">
					
					<span class="glyphicon glyphicon-search"></span>
					<input class="search_input" id="search_input" type="text"/>
				</a>
			</div>
		</div>



	</div>
	<div class="logo">
		<img src="images/logo.png" />

	</div>

	
	
	<div class="nav row " >
		<?php outputHeaderLinks();?>
	</div>

<div class="main_content">
	<div class="jumbotron_area">
           
        <?php 
        
            foreach($featuredItems as $feature) {
                echo '<div class="jumb_image">' .
                    '<a href="' . $feature["link"] . '">' .
                    '<img src="' . $feature["title"] . '"/>' .
                    '</a>' .
                    '</div>';
            }
        
        ?>	

		
		
	</div>
	<div class="bullets">
			<a class="bullet"></a>
			<a class="bullet"></a>
			<a class="bullet"></a>
		</div>
	
	<div class="contentpage">
	<div class="content row" style="padding-bottom:80px" >
		<div class="about col col-xs-12 col-sm-6">
			<h1>About</h1>
			<div class="">
				<div class="col-xs-12 text_box">
					<div id="aboutTextContent" class=""><?php if($aboutText === "") { echo "There is currently no About section."; } else { echo $aboutText; } ?></div>
				</div>
			</div>



		</div>

		<div class="upcoming col col-xs-12 col-sm-6">
		<h1>Latest News</h1>
		<?php outputArticleText( $articles, 0 ); ?>
            	<?php outputArticleText( $articles, 1 ); ?>
		</div>
	</div>
	</div>
	
	
	<div class="sub_logo">
		
	</div>

	<img class="sub_logo_img" src="images/Layer-9.png">
	

	
	<img class="bg_img" src="images/Layer-1.png" />
	
	<div class="space">
	</div>
	</div>
	
	<div class="footer">
		<div class="row">
			<div class="col col-sm-8  text-center links">
				<?php outputFooterLinks(); ?>
			</div>
			<div class="col col-sm-4 text-center social-icon"  >
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
