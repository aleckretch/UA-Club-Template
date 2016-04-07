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
});
