<?php
session_start();

if ($_POST["next"] == "Group"){
  //if "edit" option is group,
  //proceed to group editing
	$_SESSION["advisor"] = $_POST["next"];
	header('Location: AdminEditGroup.php');
}
elseif ($_POST["next"] == "Individual"){
  //if edit option is individual
  //proceed to individual editing
	header('Location: AdminEditInd.php');
}

?>