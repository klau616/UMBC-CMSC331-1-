<?php
session_start();
//creates new variable for new admin in the database
$_SESSION["AdvF"] = $_POST["firstN"];
$_SESSION["AdvL"] = $_POST["lastN"];
$_SESSION["AdvO"] = $_POST["Office"];
$_SESSION["AdvUN"] = $_POST["UserN"];
$_SESSION["AdvPW"] = $_POST["PassW"];
$_SESSION["PassCon"] = false;

if($_POST["PassW"] == $_POST["ConfP"]){
  //if confirm password is the same as password,
	header('Location: AdminCreateNew.php');
}
elseif($_POST["PassW"] != $_POST["ConfP"]){
  //if password and confirm password does not match, 
  //returns back to AdminCreateNewAdv.php since password was incorrect
	$_SESSION["PassCon"] = true;
	header('Location: AdminCreateNewAdv.php');
}

?>