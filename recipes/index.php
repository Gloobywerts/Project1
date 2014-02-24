<?php

include("classes/recipe.class.php");

$task = $_GET['task'];

switch ($task) {
	case 'viewrecipe':
	include_once('viewrecipe.php');
	break;
	
	case 'editList':
	include_once('editList.php');
	break;
	
	case 'delete':
	include_once('delete.php');
	break;
	
	default:
	include_once('recipes.php');
	break;
}

?>