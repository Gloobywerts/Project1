<?php
class recipe_section {

	var $id;
	var $parent_id;
	var $title;

	
	function setvar($varname,$value) {
        $this->$varname=$value;
	}
 
	function display_list (){
		echo "<br />".$this->parent_id.".".$this->id."&nbsp;".$this->title;
	}
	
	function displaySelf () {
		echo $this->id."&nbsp;".$this->title;
	}
	function set_recipe_section($section_id, $parent_id)
	{		
	$database = mysqli_connect("localhost","cometapp_user","Imatejam16","cometapp_live") or die(mysql_error()); 
 	$query =  "SELECT * FROM section WHERE section.id = $section_id AND section.parent_id = $parent_id";
 	$data = mysqli_query($database, $query);
	$row = mysqli_fetch_array($data, MYSQLI_ASSOC);

	$this->id = $row["id"];
	$this->parent_id = $row["parent_id"];
	$this->title =$row["title"];
	
}

	}

?>