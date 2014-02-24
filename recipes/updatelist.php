<?php

ini_set('display_errors',1); 
error_reporting(E_ALL);

include("classes/recipe.class.php");

$title = $_POST['title'];

echo $title." has been added <br />";
$recipe = new recipe();
$recipe->addNewRecipe($title);
include('editList.php');

?>