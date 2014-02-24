<a href = '/index.php'>Home<br /></a>

<?php

echo '<a href = index.php?task=recipes>Done<br /></a>';

$recipe = new recipe();
$recipe->display_list(1);

echo 	"<form action = updatelist.php method = 'POST'>
  		<input id = 'title' type='text' name='title'><br>
		</form>";

?>