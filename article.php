<?php
    require_once './banner.php';
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
	<script src="js/main.js"></script>
	<script src="js/article.js"></script>
	<script src="js/xbbcode.js"></script>
	<script src="./js/title.js"></script>
	<link rel="stylesheet" type="text/css" href="css/xbbcode.css">

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
		<img src="images/Layer-8.png" />

	</div>

	
	
	<div class="nav row">
		<?php outputHeaderLinks();?>
	</div>

<div class="main_content">
	<div class="jumbotron_area">
		<img id="articleIMG" src="images/140728-eng-rooftop-0037-x3.jpg" alt="Article Image"/>
	</div>

	<div class="contentpage">
		<div class="about">
			<h1 id="aboutTitle" style="color:#AC0820; font-size: 35px;font-family: MiloOT-Bold;">Spring Fling Applications Out</h1>
			<h2 id="aboutDate" style="color:grey; font-size: 15px; font-family:MiloOT-Thin;">March 3rd, 2016</h2>
			<div id="aboutText" class="">
			    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed erat velit, ultrices ut est in, ultricies rutrum magna. Curabitur facilisis sem ac magna maximus vulputate. Nunc ut tellus lacinia, iaculis dui et, tincidunt lorem. Integer porttitor dapibus quam. Sed fermentum a massa quis faucibus. Nullam hendrerit ex luctus sem interdum aliquet. Integer leo orci, sodales et consequat eu, egestas mattis eros. Praesent sed lobortis nibh. Pellentesque ac risus lectus. Donec elementum fringilla dui id blandit. Aenean gravida luctus tellus sed lobortis. Sed vitae vestibulum orci. Donec sed porta nisi, sed ullamcorper mauris. Aliquam scelerisque, dolor non interdum tincidunt, nulla nisi feugiat dui, feugiat consectetur dolor lectus ut erat.</p>

                <p>Aliquam sit amet magna ut tellus hendrerit porttitor vitae sed sapien. In lacinia sem vitae metus eleifend, ut scelerisque nisl vehicula. Donec in purus sit amet magna hendrerit pellentesque vitae vitae ante. Ut id sem nec ligula maximus fringilla in quis nibh. Aenean ultricies metus eget fringilla aliquam. Ut tempor erat nec imperdiet venenatis. Mauris laoreet mauris id felis molestie gravida. Pellentesque viverra est sit amet eros condimentum, vel tincidunt augue molestie. Sed ultricies elementum est, et molestie mi eleifend at.</p>

                <p>Donec sed lacinia justo. Nam nec eleifend velit. Proin est diam, ullamcorper a metus at, pulvinar varius velit. Sed eu eros felis. In hac habitasse platea dictumst. Proin massa massa, mollis a nunc et, mattis scelerisque massa. Praesent accumsan erat non eros semper, non ultrices nibh elementum. Donec ac consectetur magna. Praesent lacinia ipsum at turpis viverra, eget convallis enim molestie.<p/>

                <p>Suspendisse vitae metus vehicula, dapibus orci eget, mollis augue. Ut porta ut tortor ut pulvinar. Praesent vestibulum convallis leo, ac vehicula orci commodo a. Proin scelerisque ipsum lectus, non cursus eros tincidunt vel. Nullam accumsan feugiat dolor non dapibus. Fusce fringilla nisl at neque tristique, sit amet tincidunt ipsum varius. Nunc et iaculis magna. In hac habitasse platea dictumst. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Morbi dapibus lacus leo, non lobortis ante finibus vitae. Suspendisse potenti. Mauris in enim viverra, ornare orci et, vestibulum purus. Duis lobortis turpis libero. Vivamus elementum elementum odio vitae scelerisque. Maecenas cursus risus mauris, nec blandit mauris ultrices faucibus. In hac habitasse platea dictumst.</p>

                <p>Sed varius odio quis neque venenatis condimentum. Vivamus tristique in lacus eget dignissim. Fusce et magna ac lorem mattis vehicula. Ut libero justo, pellentesque ut orci id, finibus convallis sem. Ut ultricies turpis ac facilisis gravida. Proin vel augue mauris. Nunc tincidunt risus ante. Maecenas consequat, enim ac faucibus feugiat, augue magna consequat lacus, sit amet venenatis tortor nisl in lacus. Aenean venenatis lorem libero, quis consectetur mauris ultrices at.</p>
				</div>
				</div>
			</div>
		<div>
	
	        <img class="bg_img" src="images/Layer-1.png" />
	
	    </div>
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

<script>
	$(document).ready(function(){
		$('#search_input').keypress(function(e) {
			if(e.which == 13){
				var keywords = $('#search_input').val();
				if (keywords == ""){
					return;
				}
				window.location.href = "newsfeed.php?search=" + keywords;
			}
				
		});
	});
</script>
</html>
