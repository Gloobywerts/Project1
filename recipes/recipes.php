<a href = '/index.php'>Home<br /></a>

<?php

ini_set('display_errors',1); 
error_reporting(E_ALL);

echo '<a href = index.php?task=editList>New Recipe<br /></a>';

$recipe = new recipe();
$recipe->display_list(0);

?>