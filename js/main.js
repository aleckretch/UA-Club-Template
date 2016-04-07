$( document ).on( "ready" , function()
{	
	console.log( "Entered" );
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
});
