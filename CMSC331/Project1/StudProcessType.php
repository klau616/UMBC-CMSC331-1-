<?php
session_start();
if ($_POST["type"] == "Group")
  {
	$_SESSION["advisor"] = $_POST["type"];
	header('Location: 08StudSelectTime.php');
  }

elseif ($_POST["type"] == "Individual")
  {
	header('Location: 07StudSelectAdvisor.php');
  }

elseif ($_POST["type"] == "Next Individual Available")
  {
    //If student selected next available time
    header('Location: 08StudSelectTime08.php');
  }

elseif($_POST["type"] == "Next Group Available")
  {
    //if student selected next GROUP available
    $_SESSION["advisor"] = "Group";
    header('Location:08StudSelectTime09.php');
  }

?>