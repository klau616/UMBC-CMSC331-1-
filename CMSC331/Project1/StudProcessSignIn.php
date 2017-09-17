<?php
session_start();
//added common method
$debug = false;
include('../CommonMethods.php');
$COMMON = new Common($debug);

$_SESSION["firstN"] = strtoupper($_POST["firstN"]);
$_SESSION["lastN"] = strtoupper($_POST["lastN"]);
$_SESSION["studID"] = strtoupper($_POST["studID"]);
$_SESSION["email"] = $_POST["email"];
$_SESSION["major"] = $_POST["major"];


//***** klau4 10/20/2015
//if person is not in db, it should prompt user to re-enter their information

$_SESSION["flag"] = false;

$firstn = $_SESSION["firstN"];
$lastn = $_SESSION["lastN"];
$studid = $_SESSION["studID"];
$major = $_SESSION["major"];
$email = $_SESSION["email"];



  if( personExist($firstn, $lastn, $studid, $major, $email))
    {
      //student validation
      $_SESSION["flag"] = true;
      header('Location: 02StudHome.php');
    }
  else
    {
      header('Location: 01StudSignIn01.html');
    }

function personExist($firstn, $lastn, $studid, $major, $email)
{
  global $debug; global $COMMON;
  $sql = "select * from Proj2Students where `FirstName` = '$firstn' and `LastName` = '$lastn' and `StudentID` = '$studid' and `Major` = '$major' and `Email` = '$email'";
  $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
  $row = mysql_fetch_row($rs);
  if($row) //if the student exist, it will return true to if statement
    {
      return true;     
    }
  else //if not, it will return to sign in page
    {
      return false;
    }
}
?>