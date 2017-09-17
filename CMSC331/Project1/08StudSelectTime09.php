<?php
session_start();
$debug = false;


$localMaj = $_SESSION["major"];

if($localMaj == "Engineering Undecided")
  {
    $localMaj = "ENGR";
  }
else if($localMaj == "Mechanicall Engineering")
  {
    $localMaj = "MENG";
  }
else if($locaMaj == "Chemical Engineering")
  {
    $localMaj = "CENG";
  }
else if($localMaj == "Computer Engineering")
  {
    $localMaj = "CMPE";
  }
else if($locaMaj == "Computer Science")
  {
    $locaMaj = "CMSC";
  }


include('../CommonMethods.php');
$COMMON = new Common($debug);




?>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Select Appointment</title>
  <link rel='stylesheet' type='text/css' href='../css/standard.css'/>

  </head>
  <body>
    <div id="login">
      <div id="form">
        <div class="top">
  <h1>Appointment Time</h1>
      <div class="field">
  <form action = "10StudConfirmSch.php" method = "post" name = "SelectTime">
      <?php

  // http://php.net/manual/en/function.time.php fpr SQL statements below
  // Comparing timestamps, could not remember. 

  $sql = "select * from Proj2Appointments where `Max` > 1 and `Time` > '".date('Y-m-d H:i:s')."' order by `Time` ASC limit 30";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$row=mysql_fetch_row($rs);
echo"<h2>Group Advising</h2><br>";
echo"<label for 'prompt'> The earliest available time would be :</label><br>";
  $datephp = strtotime($row[1]);
  echo "<label for='",$row[0],"'>";
echo "<input id='",$row[0],"' type='hidden' name='appTime' required value='", $row[1], "'>", date('l, F d, Y g:i A', $datephp) ,"</label><br>\n";
echo "</label>";


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
