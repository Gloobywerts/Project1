<?php

ini_set('display_errors',1); 
error_reporting(E_ALL);

include("classes/recipe.class.php");

$title = $_POST['title'];
$id = $_POST['id'];

$recipe = new recipe();
$recipe->deleteRecipe($id);
include('editList.php');

?>