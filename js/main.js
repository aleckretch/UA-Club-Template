function convertBB( index, element ) 
{
	console.log( "HERE" );
	var content = XBBCODE.process({
		    text: $( element ).html(),
		    removeMisalignedTags: true,
		    addInLineBreaks: true
		});
	$( element ).html( content.html );
}	

$( document ).on( "ready" , function()
{	
	if ( $( "#aboutTextContent" ).length )
	{
		var content = XBBCODE.process({
		    text: $( "#aboutTextContent" ).html(),
		    removeMisalignedTags: true,
		    addInLineBreaks: true
		});					
		$( "#aboutTextContent" ).html( content.html );
	}

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

	setInterval(nextImg,5000);

	//Go through all the article previews on the newsfeed and convert BBCode to HTML for each
	$( "div.newsbox p" ).each( convertBB );

	$( "p.articleBodyJS" ).each( convertBB );
});
