//#mainContent
function showForm( options )
{
	$.get("ajax.php", options).done(
	function(data)
	{
		$( "#mainContent" ).html( data );
	});
}

$( document ).ready( function() {
	showForm( { admin: "editor"} );
});
