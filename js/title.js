$( document ).on( "ready" , function()
{
	$.get( "ajax.php" , {  "title" : "yes" } ).done(function(data)
	{
		$( "title" ).html( data );
	});
});
