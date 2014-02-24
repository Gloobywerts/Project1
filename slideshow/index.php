<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Slideshow</title><!-- -->

<script src="scripts/jquery-1.7.2.min.js" type="text/javascript"></script>
<script src="scripts/jquery.cycle.lite.js" type="text/javascript"></script>

<script src="/javascript/image_resize.js" type="text/javascript"></script>

<script type="text/javascript">

var windowWidth              = getWindowSize().width-20;
var windowHeight              = getWindowSize().height-20;

$(document).ready(function(){
	$('#myslides').cycle({
		fit: 1, pause: 0, timeout: 4000,  width: windowWidth, height: windowHeight, containerResize: 1, slideResize: 1
	});
});
</script>
<link rel="stylesheet" href="styles/dynamicslides.css" type="text/css" media="screen" />
</head>
<body>
<?php
$directory = 'images/slideshow'; 	
try {    	
	// Styling for images		
	echo '<div id="myslides">';	
	foreach ( new DirectoryIterator($directory) as $item ) {			
		if ($item->isFile()) {
			$path = $directory . '/' . $item;	
			echo '<img src="' . $path . '"/>';
		}
	}	
	echo '</div>';
}	
catch(Exception $e) {
	echo 'No images found for this slideshow.<br />';	
}
?>
</body>
</html>