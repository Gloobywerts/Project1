<a href = 'index.php'>Back<br /></a>

<link rel="stylesheet" type="text/css" href="css/recipe_theme.css">

<?php
ini_set('display_errors',1); 
error_reporting(E_ALL);

$recipe_id = $_GET['id'];
echo "<a href = 'editrecipe.php?id=".$recipe_id."'>Edit<br /></a>";
$recipe = new recipe();
$recipe->set_recipe($recipe_id);
echo "<div id = 'title'>".$recipe->title."</div>";
echo "<br />";
echo "<TABLE BORDER='3' CELLPADDING='10' CELLSPACING='10' width='100%'>
<TD>";
$recipe->displaySelf();
echo "</TD></TABLE>";
?>