<?php
echo "
<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\">
<html>
<head>
<title>Table Add Row - new window</title>
<script language=\"JavaScript\">
<!--
function printToPage()
{
	var pos;
	var searchStr = window.location.search;
	var searchArray = searchStr.substring(1,searchStr.length).split('&');
	var htmlOutput = '';
	for (var i=0; i<searchArray.length; i++) {
		htmlOutput += searchArray[i] + '<br />';
	}
	return(htmlOutput);
}
//-->
</script>
</head>

<body>
<b>MREDKJ's Table Add Row</b>
<br />
Below should be the name/value pairs that were submitted:
<p>
<script language=\"JavaScript\">
<!--
document.write(printToPage());
//-->
</script>
</p>
</body>
</html>";
?>