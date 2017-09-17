<?php
session_start();

$_SESSION["GroupApp"] = $_POST["GroupApp"];
$_SESSION["Delete"] = false;

if ($_POST["next"] == "Delete Appointment"){
  //if user desire to delete appointment,
	$_SESSION["Delete"] = true;
	$_SESSION["advisor"] = $_POST["next"];
	header('Location: AdminConfirmEditGroup.php');
}
elseif ($_POST["next"] == "Edit Appointment"){
  //if user desire to edit appointment instead,
	header('Location: AdminProceedEditGroup.php');
}

?>