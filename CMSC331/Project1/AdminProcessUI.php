<?php
session_start();

if($_POST["next"] == 'Schedule appointments'){
  //If schedule appoint is selected
	header('Location: AdminScheduleApp.php');
}
elseif($_POST["next"] == 'Print schedule for a day'){
  //If Print was selected,
	header('Location: AdminPrintSchedule.php');
}
elseif($_POST["next"] == 'Edit appointments'){
  //if edit appointment was selected
	header('Location: AdminEditApp.php');
}
elseif($_POST["next"] == 'Search for an appointment'){
  //if search appointment was selected
	header('Location: AdminSearchApp.php');
}
elseif($_POST["next"] == 'Create new Admin Account'){
  //if create new admin was selected
	header('Location: AdminCreateNewAdv.php');
}

?>