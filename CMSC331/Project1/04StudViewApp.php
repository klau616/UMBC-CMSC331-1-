<?php
session_start();
$debug = false;
include('../CommonMethods.php');
$COMMON = new Common($debug);

$studID = $_SESSION["studID"];
?>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>View Appointment</title> <!-- reference to css files for styling-->
	<link rel='stylesheet' type='text/css' href='../css/standard.css'/>
  </head>
  <body>
    <div id="login">
      <div id="form">
        <div class="top">
		<h1>View Appointment</h1>
	    <div class="field">
	    <?php
  $sql = "select * from Proj2Appointments where `EnrolledID` like '%$studID%'";  //access to appointments database
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
// if for some reason there really isn't a match, (something got messed up, tell them there really isn't one there)
$num_rows = mysql_num_rows($rs);

if($num_rows > 0)
  {
    $row = mysql_fetch_row($rs); // get legit data
    $advisorID = $row[2];
    $datephp = strtotime($row[1]);
    
    if($advisorID != 0){
      $sql2 = "select * from Proj2Advisors where `id` = '$advisorID'"; //access advisors information
      $rs2 = $COMMON->executeQuery($sql2, $_SERVER["SCRIPT_NAME"]);
      $row2 = mysql_fetch_row($rs2);
      $advisorName = $row2[1] . " " . $row2[2];
      $office = $row2[5];
    }
    else{$advisorName = "Group";}
    
    echo "<label for='info'>";
    echo "Advisor: ", $advisorName, "<br>";
    echo "Appointment: ", date('l, F d, Y g:i A', $datephp), "</label>";
    //****************** klau4 10/20/2015
    //added advisor office
    echo "<B>". "Office: ", $office, "</b>";
  }
else // something is up, and there DB table needs to be fixed
  {//if no data does not match, sends the user to invalid page
    echo("No appointment was detected. It may have been cancelled. Please make another appointment.");
    $sql = "update `Proj2Students` set `Status` = 'N' where `StudentID` = '$studID'";
    $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
  }


?>
        </div>
	<div class="finishButton">
  <button onclick="location.href = '02StudHome.php'" class="button large go" >Return to Home</button>
  </div>
  </div>
  </form>
  </body>
  </html>