<?php
session_start();
$debug = false;

if(isset($_POST["advisor"])){
  $_SESSION["advisor"] = $_POST["advisor"];
}

$localAdvisor = $_SESSION["advisor"];
$localMaj = $_SESSION["major"];

if($localMaj == "Engineering Undecided")
  {
    $localMaj = "ENGR";
  }
else if($localMaj == "Mechanical Engineering")
  {
    $localMaj = "MENG";
  }
else if($localMaj == "Chemical Engineering")
  {
    $localMaj = "CENG";
  }
else if($localMaj =="Computer Engineering")
  {
    $localMaj = "CMPE";
  }
else if($localMaj == "Computer Science")
  {
    $localMaj = "CMSC";
  }

include('../CommonMethods.php');
$COMMON = new Common($debug);

$max = 5;
$min = 2;
$randAdvisor = rand($min, $max);

$sql = "select * from Proj2Advisors where `id` = '$randAdvisor'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$row = mysql_fetch_row($rs);
$advisorName = $row[1]." ".$row[2];
$office = $row[5];
?>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Appointment Time</title>
  <link rel='stylesheet' type='text/css' href='../css/standard.css'/>

  </head>
  <body>
    <div id="login">
      <div id="form">
        <div class="top">
  <h1>Appointment Time</h1>
      <div class="field">
  <form action = "StudProcessSch.php" method = "post" name = "TimeConfirm">
      <?php

  // http://php.net/manual/en/function.time.php fpr SQL statements below
  // Comparing timestamps, could not remember. 

  $curtime = time();

$sql = "select * from Proj2Appointments where  `Time` > '".date('Y-m-d H:i:s')."'  order by `Time` ASC limit 30";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
echo "<h2>Individual Advising</h2><br>";


$row = mysql_fetch_row($rs);
$datephp = strtotime($row[1]);
echo "<label for='prompt'>The earliest available time would be :</label><br>";
  echo "<label for='",$row[0],"'>";
echo"";
echo "<input id='",$row[0],"' type='hidden' name='appTime' required value='", $row[1], "'>", date('l, F d, Y g:i A', $datephp) ,"</label><br>\n";
echo"<label>It would be with :\n";
echo"$advisorName<br>";
echo"Located at: ";
echo"$office";

?>
        </div>
		    <div class="nextButton">
  <input type="submit" name="next" class="button large go" value="Next">
      </div>
  </form>
  <div>
  <form method="link" action="02StudHome.php">
  <input type="submit" name="home" class="button large" value="Cancel">
  </form>
  </div>
  <div class="bottom">
  <p>Note: Appointments are maximum 30 minutes long.</p>
  </div>
  </body>
</html>