function showForm( options )
{
	$.get("ajax.php", options).done(
	function(data)
	{
		$( "#changedContent" ).html( data );
	});
}

function removeLink( id, removedTitle, elementRemoved )
{
	if ( confirm( "Do you really wish to remove this " + removedTitle + "?" ) )
	{
		$.post( "ajax.php?removed=" + removedTitle , { "remove" : id, "token" : PHP_TOKEN } ).done(
		function( data )
		{
			if ( data == "true" )
			{
				$( elementRemoved ).remove();	
			}
			else
			{
				alert( data );
			}
		});
	}
}

function removeArticle( id )
{
	removeLink( id, "article" , "#article" + id );
	/*
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
	*/
}

$( document ).ready( function() {
	var queryDict = {};
	location.search.substr(1).split("&").forEach(function(item) {queryDict[item.split("=")[0]] = item.split("=")[1]});

	var current = "editor";
	if ( queryDict.current )
	{
		current = queryDict.current;
	}
	showForm( { admin: current} );
	$( "#changer" ).val( current );

	$( "#changer" ).change( function() 
	{
		showForm( { admin: $( "#changer" ).val() } );
	});
});
