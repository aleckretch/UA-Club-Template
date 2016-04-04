function showForm( options )
{
	$.get("ajax.php", options).done(
	function(data)
	{
		$( "#changedContent" ).html( data );
	});
}

$( document ).ready( function() {
	showForm( { admin: "editor"} );

	$( "#changer" ).change( function() 
	{
		showForm( { admin: $( "#changer" ).val() } );
	});
});
