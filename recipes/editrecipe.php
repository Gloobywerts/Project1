<a href = 'index.php'>Back<br /></a>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>Edit Recipe</title>

<link rel="stylesheet" type="text/css" href="css/recipe_theme.css">

<script language="JavaScript" type="text/javascript">

function addRowToTable($tableid)
{
  var tbl = document.getElementById($tableid);
  var lastRow = tbl.rows.length;

  var iteration = lastRow;
  var row = tbl.insertRow(lastRow);
  
  var cell = row.insertCell(0);
  var el = document.createElement('input');
  el.type = 'text';
  el.name = 'txtRow' + iteration;
  el.id = 'txtRow' + iteration;
  el.value = "Enter new " + $tableid ;
  el.onFocus = 'if (value == \'Enter new section\') {value=\'\'}';
  el.onBlur = 'if (value == \'\') {value=\'Enter new section\'}';
  
  cell.appendChild(el);
  
}

function addIngredientToTable($tableid)
{
  var tbl = document.getElementById($tableid);
  var lastRow = tbl.rows.length;

  var iteration = lastRow;
  var row = tbl.insertRow(lastRow);
  
  var leftcell = row.insertCell(0);
  var el = document.createElement('input');
  el.type = 'text';
  el.name = 'txtRow' + iteration;
  el.id = 'txtRow' + iteration;
  el.value = "Enter new ingredient";

  leftcell.appendChild(el);
  
  var rightcell = row.insertCell(1);
  var el = document.createElement('input');
  el.type = 'text';
  el.name = 'txtRow' + iteration;
  el.id = 'txtRow' + iteration;
  el.value = "Quantity";
  
  rightcell.appendChild(el);
  
}


function addInstructionToTable($tableid)
{
  var tbl = document.getElementById($tableid);
  var lastRow = tbl.rows.length;

  var iteration = lastRow;
  var row = tbl.insertRow(lastRow);
  
  var leftcell = row.insertCell(0);
  var el = document.createElement('input');
  el.type = 'text';
  el.name = 'txtRow' + iteration;
  el.id = 'txtRow' + iteration;
  el.value = "Enter new instruction";

  leftcell.appendChild(el);
  
  var centercell = row.insertCell(1);
  var cellid = 9 + $tableid + iteration;
  centercell.innerHTML = '<table id = "' + cellid + '"><td><button onclick = "addIngredientToTable(' + cellid + ')">Add</button></td></table>';

  var rightcell = row.insertCell(2);
  var el = document.createElement('input');
  el.type = 'text';
  el.name = 'txtRow' + iteration;
  el.id = 'txtRow' + iteration;
  el.value = "Comment";

  rightcell.appendChild(el);

}


function removeRowFromTable($tableid)
{
  var tbl = document.getElementById($tableid);
  var lastRow = tbl.rows.length;
  if (lastRow > 2) tbl.deleteRow(lastRow - 1);
}
function openInNewWindow(frm)
{
  // open a blank window
  var aWindow = window.open('', 'TableAddRowNewWindow',
   'scrollbars=yes,menubar=yes,resizable=yes,toolbar=no,width=400,height=400');
   
  // set the target to the blank window
  frm.target = 'TableAddRowNewWindow';
  
  // submit
  frm.submit();
}
function validateRow(frm)
{
  var chkb = document.getElementById('chkValidate');
  if (chkb.checked) {
    var tbl = document.getElementById('tblSample');
    var lastRow = tbl.rows.length - 1;
    var i;
    for (i=1; i<=lastRow; i++) {
      var aRow = document.getElementById('txtRow' + i);
      if (aRow.value.length <= 0) {
        alert('Row ' + i + ' is empty');
        return;
      }
    }
  }
  openInNewWindow(frm);
}

</script>
</head>
<body>

<?php

include("classes/recipe.class.php");

$recipe_id = $_GET['id'];
$recipe = new recipe();
$recipe->set_recipe($recipe_id);
echo "<div id = 'title'>".$recipe->title."</div>";
echo "<br />";
//$recipe->display_sections();
echo "<TABLE BORDER='3' CELLPADDING='10' CELLSPACING='10'  width='100%'>
<TD>";
$recipe->editSelf();
echo "</TD></TABLE>";
?>
</body>
</html>