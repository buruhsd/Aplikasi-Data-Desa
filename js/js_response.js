<script language="javascript">
// JavaScript Document
var xmlHttp;
//-------------membuat objek xmlHttpRequest
function GetXmlHttpObject()
{
try
	{
	// ngecek buat browser firefox, opera 8.0+, safari
	xmlHttp=new XMLHttpRequest();
	}
	catch (e)
		{
		// browser Internet Explorer
		try
			{
			// IE 6.0+
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
			}
			catch (e)
				{
				// IE 5.0
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
				}
		}			
return xmlHttp;
}

function bukawindow(str)
{
	xmlHttp=GetXmlHttpObject()
	if (xmlHttp==null)
	{
		alert ("Browser tidak support HTTP Request");
	}
	var url="menu/cari_response.php?cmd=bukawindow";
	var url=url+"&str="+str
	xmlHttp.onreadystatechange=function()
	{
		if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	    {
			document.getElementById("open").innerHTML=xmlHttp.responseText;
	    }
	}
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
}

function tutupwindow()
{
	xmlHttp=GetXmlHttpObject()
	if (xmlHttp==null)
	{
		alert ("Browser tidak support HTTP Request");
	}
	var url="menu/cari_response.php?cmd=tutupwindow";
	
	xmlHttp.onreadystatechange=function()
	{
		if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	    {
			document.getElementById("open").innerHTML=xmlHttp.responseText;
	    }
	}
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
}
</script>
