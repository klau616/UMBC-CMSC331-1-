<?php
session_start();

if ($_POST["next"] == "Group"){
  //if option is selected for group,
	$_SESSION["advisor"] = $_POST["next"];
	header('Location: AdminScheduleGroup.php');
}
elseif ($_POST["next"] == "Individual"){
  //if option is selected for individual,
	header('Location: AdminScheduleInd.php');
}

?>