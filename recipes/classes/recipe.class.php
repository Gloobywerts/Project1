<?php
class recipe {

	var $id;
	var $title;
	var $tablecount = 1;
	
	function newRow($table){
		echo   '<form action="updaterecipe.php" method="get">
				<p>
				<input type="button" value="Add" onclick="addRowToTable(\''.$this->tablecount.'\');" />
				</p>
  				<tr>
    			<td><input type="text" name="txtRow1" id="txtRow1" size="50" value="Enter new '.$table.'" onFocus="if (value == \'Enter new '.$table.'\') {value=\'\'}" onBlur="if (value== \'\') {value=\'Enter new '.$table.'\'} oninput="if (value== \'\') {addRowToTable(\''.$this->tablecount.'\')}"/></td>
  				</tr>
				</form>';
		$this->tablecount ++;
	}

	function newInstruction($tableid){
		echo   '<form action="updaterecipe.php" method="get">
				<tr><td>
				<input type="text" name="txtRow1" id="txtRow1" size="50" value="Enter new instruction" onFocus="if (value == \'Enter new instruction\') {value=\'\'}" onBlur="if (value== \'\') {value=\'Enter new instruction\'}" onclick="if (value== \'\') {addInstructionToTable(\''.$tableid.'\')}"/></td><td>';
				$this->tablecount ++;
				echo "<TABLE BORDER='1' id = '".$this->tablecount."'>";    			
    			echo "<TR><TD>";
				$this->newIngredient();
				echo "</TD></TR>";
				echo "</TABLE>";
  				echo '</td><td><input type="text" name="txtRow1" id="txtRow1" size="50" value="Enter new comment"/></td></tr>
				</form>';

	}

	function newIngredient(){
		echo   '<form action="updaterecipe.php" method="get">
				<p>
				<input type="button" value="Add" onclick="addIngredientToTable(\''.$this->tablecount.'\');" />
				</p>
<input type="text" name="ingredientRow1" id="ingredientRow1" size="50" value="Enter new ingredient" onFocus="if (value == \'Enter new ingredient\') {value=\'\'}" onBlur="if (value== \'\') {value=\'Enter new ingredient\'}"/></td>
    			<td><br /><input type="text" name="quantityRow1" id="quantityRow1" size="50" value="Enter new quantity" onFocus="if (value == \'Enter new quantity\') {value=\'\'}" onBlur="if (value== \'\') {value=\'Enter new quantity\'}" flag = "0" oninput=" if (flag == 0) {addIngredientToTable(\''.$this->tablecount.'\') flag = \'1\'}" /></td>
				</form>';
		$this->tablecount ++;
	}
	
	function setvar($varname,$value) {
        $this->$varname=$value;
	}
	
	function display_list($edit){	
 		$database = mysqli_connect("localhost","cometapp_user","Imatejam16","cometapp_live") or die(mysql_error()); 
 		$data = mysqli_query($database, "SELECT * FROM recipes ORDER BY `title` ASC");
		if ($data){
    		while($row = mysqli_fetch_array($data, MYSQLI_ASSOC)){    				
				echo '<a href = index.php?task=viewrecipe&id='.$row['id'].'>'.$row['title']."&nbsp;</a>";
				if ($edit){
					echo 	"<form action = delete.php method = 'POST'>
  					<input type='hidden' value = ".$row['id']." name='id'>
  					<input type='hidden' value = ".$row['title']." name='title'>
  					<input type='Submit' value ='Delete'>
					</form>";
				}
				else echo "<br />";
			}}
	}
	
	function displaySelf () {
		$database = mysqli_connect("localhost","cometapp_user","Imatejam16","cometapp_live") or die(mysql_error()); 
		$this->displayFirstStages($database);
		$this->displaySections($database);
	}

	function displaySections($database){
 		$section = mysqli_query($database, "SELECT * FROM section WHERE parent_id = ".$this->id." ORDER BY `sequence` ASC");
		if ($section){
    		while($section_row = mysqli_fetch_array($section, MYSQLI_ASSOC)){
    			echo "<TABLE BORDER='1'><TD>";	    				
    			echo $section_row["title"];
				echo "</TD>";
				$this->displayStages($database, $section_row["id"]);
			}}
	}

	function displayStages($database, $section){
	 		$Stage = mysqli_query($database, "SELECT * FROM Stage WHERE parent_id = ".$this->id." AND section_id = ".$section." ORDER BY `sequence` ASC");
		if ($Stage){
			echo "<TABLE BORDER='1' width='100%'><TD>";	
			while($Stage_row = mysqli_fetch_array($Stage, MYSQLI_ASSOC)){	
				$this->displayInstructions($database, $Stage_row['id']);	
			}
		echo "</TD></TABLE>";
		}
	
	}

	function displayFirstStages($database){
	 		$Stage = mysqli_query($database, "SELECT * FROM Stage WHERE parent_id = ".$this->id." AND section_id = 0 ORDER BY `sequence` ASC");
		if ($Stage){	
			echo "<TABLE BORDER='1' width='100%'><TD>";
			while($Stage_row = mysqli_fetch_array($Stage, MYSQLI_ASSOC)){	
				$this->displayInstructions($database, $Stage_row['id']);	
			}
		echo "</TD></TABLE>";
		}
	
	}

	function displayInstructions($database, $id){
		$instruction = mysqli_query($database, "SELECT * FROM instruction WHERE parent_id = ".$id." ORDER BY `sequence` ASC");
		if ($instruction){
			echo "<TABLE BORDER='1' width='100%'>";
			while($instruction_row = mysqli_fetch_array($instruction, MYSQLI_ASSOC)){
				echo "<TR><TD width='30%'>";	
				echo $instruction_row["instruction"];
				echo "</TD><TD width='30%'>";
				$this->displayIngredients($database, $instruction_row['id']);
				echo "</TD><TD width='40%'>";
				$this->displayComments($database, $instruction_row['id']);
				echo "</TD></TR>";
			}		
		echo "</TABLE>";
		}
	
	}	

	function displayIngredients($database, $id){
		$ingredient = mysqli_query($database, "SELECT * FROM ingredient WHERE parent_id = ".$id);
		if ($ingredient){
			echo "<TABLE BORDER='1' width='100%'>";
			while($ingredient_row = mysqli_fetch_array($ingredient, MYSQLI_ASSOC)){
				echo "<TR><TD width='70%'>";	
				echo $ingredient_row["ingredient"];
				echo "</TD><TD width='30%'>";
				echo $ingredient_row["quantity"];
				echo "</TD></TR>";
			}
		echo "</TABLE>";
		}	
	}
	
	function displayComments($database, $id){
				$comment = mysqli_query($database, "SELECT * FROM comment WHERE parent_id = ".$id);
		if ($comment){
			while($comment_row = mysqli_fetch_array($comment, MYSQLI_ASSOC)){
				echo $comment_row["comment"];
			}}					
	}		
	
	function set_recipe($recipe_id){
			
		$database = mysqli_connect("localhost","cometapp_user","Imatejam16","cometapp_live") or die(mysql_error()); 
 		$data = mysqli_query($database, "SELECT * FROM recipes WHERE id =".$recipe_id);
		$row = mysqli_fetch_array($data, MYSQLI_ASSOC);

		$this->id = $row["id"];
		$this->title=$row["title"];
	
	}

	function addNewRecipe($title){
			$database = mysqli_connect("localhost","cometapp_user","Imatejam16","cometapp_live") or die(mysql_error()); 						
			mysqli_query($database, "INSERT INTO `recipes` (`title`) VALUES ('".$title."')");	
		}
	
	function deleteRecipe($id){
			$database = mysqli_connect("localhost","cometapp_user","Imatejam16","cometapp_live") or 			die(mysql_error()); 						
			mysqli_query($database, "DELETE FROM `recipes` WHERE id = ".$id);	
		}
	
	function editSelf () {
		$database = mysqli_connect("localhost","cometapp_user","Imatejam16","cometapp_live") or die(mysql_error()); 
		$this->editFirstStages($database);
		//$this->editSections($database);
	}

	function editSections($database){
 		$section = mysqli_query($database, "SELECT * FROM section WHERE parent_id = ".$this->id." ORDER BY `sequence` ASC");
		if ($section){
    		while($section_row = mysqli_fetch_array($section, MYSQLI_ASSOC)){
    			echo "<TABLE BORDER='1' width='100%'><TD>";	    				
    			echo "<input class = 'signup_box' size = '100%' type='text'  value='".$section_row["title"]."'/>";
				echo "</TD>";
				$this->editStages($database, $section_row["id"]);
				$this->newRow('section');
			}}
	}

	function editStages($database, $section){
	 		$Stage = mysqli_query($database, "SELECT * FROM Stage WHERE parent_id = ".$this->id." AND section_id = ".$section." ORDER BY `sequence` ASC");
		if ($Stage){	
			echo "<TABLE BORDER='1' width='100%'>";
			while($Stage_row = mysqli_fetch_array($Stage, MYSQLI_ASSOC)){
				echo "<TR>";	
				echo "</TR>";
				echo "<TR>";	
				echo "</TR>";
				echo "<TR>";	
				echo "</TR>";
				$this->editInstructions($database, $Stage_row['id']);
				echo "<TD>";
				$this->newRow('instruction');
				echo "</TD>";
				echo "<TD><TABLE BORDER='1' width='100%'><TD><input class = 'signup_box' type='text'  value='Enter new ingredient' onFocus='if (value == \"Enter new ingredient\") {value=\"\"}' onBlur='if (value== \"\") {value=\"Enter new ingredient\"}'/></TD><TD><input class = 'signup_box' type='text'  value='Quantity' onFocus='if (value == \"Quantity\") {value=\"\"}' onBlur='if (value== \"\") {value=\"Quantity\"}'/></TD></TABLE>";
				echo "<TD><input class = 'signup_box' type='text'  value='Enter new comment' onFocus='if (value == \"Enter new comment\") {value=\"\"}' onBlur='if (value== \"\") {value=\"Enter new comment\"}'/></TD>";	
			}
		echo "</TABLE>";
		}
		echo "<input type='button' value='Enter new stage'/>";
	}

	function editFirstStages($database){
	 		$Stage = mysqli_query($database, "SELECT * FROM Stage WHERE parent_id = ".$this->id." AND section_id = 0 ORDER BY `sequence` ASC");
		if ($Stage){	
			while($Stage_row = mysqli_fetch_array($Stage, MYSQLI_ASSOC)){
				echo "<TABLE BORDER='1' id = '".$this->tablecount."' width='100%'>";	
				echo "<TR>";	
				echo "</TR>";
				echo "<TR>";	
				echo "</TR>";
				echo "<TR>";	
				echo "</TR>";
				$tableid = $this->tablecount;
				$this->tablecount ++;
				$this->editInstructions($database, $Stage_row['id']);
				echo "<TD>";
				$this->newInstruction($tableid);
				echo "</TD>";
			}
		echo "</TABLE>";
		}
		echo "<input type='button' value='Enter new stage'/>";
	}

	function editInstructions($database, $id){
		$instruction = mysqli_query($database, "SELECT * FROM instruction WHERE parent_id = ".$id." ORDER BY `sequence` ASC");
		if ($instruction){
			while($instruction_row = mysqli_fetch_array($instruction, MYSQLI_ASSOC)){
				echo "<TR><TD>";	
    			echo "<input class = 'signup_box' type='text' size = '50' value='".$instruction_row["instruction"]."'/>";
				echo "</TD><TD>";
				$this->editIngredients($database, $instruction_row['id']);
				echo "</TD>";
				echo "<TD>";
				$this->editComments($database, $instruction_row['id']);
				echo "</TD></TR>";
			}		
		}
	}	

	function editIngredients($database, $id){
		$ingredient = mysqli_query($database, "SELECT * FROM ingredient WHERE parent_id = ".$id);
		if ($ingredient){
			echo "<TABLE BORDER='1' id = '".$this->tablecount."' width='100%'>";
			while($ingredient_row = mysqli_fetch_array($ingredient, MYSQLI_ASSOC)){
				echo "<TR><TD>";	
    			echo "<input class = 'signup_box' type='text' size = '50'  value='".$ingredient_row["ingredient"]."'/>";
				echo "</TD><TD>";
    			echo "<input class = 'signup_box' type='text' size = '50'  value='".$ingredient_row["quantity"]."'/>";
				echo "</TD></TR>";
			}
		echo "<TR><TD>";
		$this->newIngredient();
		echo "</TD></TR>";
		echo "</TABLE>";
		}	
	}
	
	function editComments($database, $id){
				$comment = mysqli_query($database, "SELECT * FROM comment WHERE parent_id = ".$id);
		if ($comment)
				while ($comment_row = mysqli_fetch_array($comment, MYSQLI_ASSOC)){
				$co = $comment_row["comment"];
    			echo "<input class = 'signup_box' type='text'  value='".$comment_row["comment"]."'/>";
			}if (!$co) echo "<input class = 'signup_box' type='text' value='Enter new Comment'/>";
	}			
	
}
	
?>