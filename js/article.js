$( document ).on( "ready" , function()
{
	var queryDict = {};
	location.search.substr(1).split("&").forEach(function(item) {queryDict[item.split("=")[0]] = item.split("=")[1]});

	var id = "recent";
	if ( queryDict.id )
	{
		id = queryDict.id;
	}
	
	$.get( "ajax.php" , { "articlePage" : id } ).done(function(data)
	{
		var obj = JSON.parse(data);
		if ( obj != undefined && obj.title != undefined && obj.uploadDate != undefined )
		{
			$( "#aboutTitle" ).html( obj.title );
			$( "#aboutDate" ).html( obj.uploadDate );
			$( "#articleIMG" ).attr( "src" , obj.image );
			var content = XBBCODE.process({
			    text: obj.body,
			    removeMisalignedTags: true,
			    addInLineBreaks: true
			});
			$( "#aboutText" ).html( content.html );
		}
		else
		{
			$( "#aboutTitle" ).text( "" );
			$( "#aboutDate" ).text( "" );
			$( "#aboutText" ).html( "There does not seem to be anything here!" );
		}
	});
});
