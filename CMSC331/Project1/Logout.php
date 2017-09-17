<?php
session_start();
$flag = false;

if(isset($_SESSION['studID'])) { $flag = true; }

//remove all the current data that is being store
session_unset();
session_destroy();


if($flag) { header("Location: 01StudSignIn.html"); }
else { header("Location: StudentAdminSignIn.html"); }

?>