<?php
require_once './database.php';

/*
	Outputs the header links dynamically.
*/
function outputHeaderLinks()
{
	$topLinks = Database::getLinksByPlacement("top");     
	$len = count($topLinks);
	$index = 0;
	
	foreach($topLinks as $topLink) 
	{
		$index = $index+1;
		$smallSize="col-xs-6";
		if ($index === $len && $index%2 ===1){
			$smallSize = "col-xs-12";
		}
		echo "<div class='nav_cel col-sm-". ceil(12/$len)." ".$smallSize." '><a href='${topLink['link']}'>${topLink["title"]}</a></div>";
	}     
}

//Outputs the footer links dynamically
function outputFooterLinks()
{
	$bottomLinks = Database::getLinksByPlacement("bottom");
	foreach($bottomLinks as $key=>$bottomLink) 
	{
		// if last item in the array, do not add  ' - ' to end else include it
		if ($key === count($bottomLinks) - 1) 
		{
			echo '<a href="' . $bottomLink["link"] . '">' . $bottomLink["title"] . '</a>';
		} 
		else 
		{
			echo '<a href="' . $bottomLink["link"] . '">' . $bottomLink["title"] . '</a> - ';
		}
	}
}

//Outputs the social media links dynamically
function outputSocialLinks()
{
	$links = Database::getSocialLinks();
	$facebookLink = $links['facebook'];
	$twitterLink = $links['twitter'];
	$instagramLink = $links['instagram'];
	$youtubeLink = $links['youtube'];
	if($facebookLink !== "") 
	{
		echo '<a href="' . $facebookLink . '" style="color:black"><i class="fa fa-facebook-official"></i></a>';
	}

	if($instagramLink !== "") 
	{
		echo '<a href="' . $instagramLink . '" style="color:black"><i class="fa fa-instagram"></i></a>';
	}

	if($youtubeLink !== "") 
	{
		echo '<a href="' . $youtubeLink . '" style="color:black"><i class="fa fa-youtube-play"></i></a>';
	}

	if($twitterLink !== "") 
	{
		echo '<a href="' . $twitterLink . '" style="color:black"><i class="fa fa-twitter-square"></i></a>';
	}
}

function outputArticleText( $articles, $index )
{
	if(isset($articles[ $index ])) 
	{
		$articleBody = $articles[$index ]['body'];

		if(strlen($articleBody) > 356) 
		{
			$articleBody = substr($articleBody, 0 ,355);
		}

		echo '<div class="">
		<div class="text_box col-xs-12 newsTextJS">';
		echo "<a href='article.php?id=" . $articles[ $index ]['id'] . 
		"'><p class='title'>" . $articles[ $index ]['title'] . "</p></a>";
		echo "<p class='articleBodyJS'>" . $articleBody . "</p>";
		echo '</div></div>';
	}
}

