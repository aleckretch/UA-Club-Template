<?php
    require_once './banner.php';
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
	<link rel="stylesheet" type="text/css" href="css/xbbcode.css">
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<script src="./js/title.js"></script>
	<script src="js/xbbcode.js"></script>
	<script src="./js/main.js"></script>

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
					<input class="search_input" type="text"/>
				</a>
			</div>
		</div>



	</div>
	<div class="logo">
		<img src="images/Layer-8.png" />

	</div>

	
	
	<div class="nav row">
		<?php outputHeaderLinks();?>
	</div>

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
					<h1><a href="article.php?id=<?php echo $article['id'];?>"><?php echo $article['title'];?></a></h1>
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
	
	

	<div class="footer">
		<div class="row">
			<div class="col col-sm-8  text-center">
				<?php outputFooterLinks(); ?>
			</div>
			<div class="col col-sm-4 text-center" >
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
