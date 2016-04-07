function showForm( options )
{
	$.get("ajax.php", options).done(
	function(data)
	{
		$( "#changedContent" ).html( data );
	});
}

function removeArticle( id )
{
	if ( confirm( "Do you really wish to remove this article?" ) )
	{
		$.post( "ajax.php?removed=article" , { "remove" : id, "token" : PHP_TOKEN } ).done(
		function( data )
		{
			if ( data == "true" )
			{
				$( "#article" + id ).remove();	
			}
			else
			{
				alert( data );
			}
		});
	}
}

$( document ).ready( function() {
	showForm( { admin: "editor"} );

	$( "#changer" ).change( function() 
	{
		showForm( { admin: $( "#changer" ).val() } );
	});
});
