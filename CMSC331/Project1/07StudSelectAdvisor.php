<?php
session_start();
$debug = false;
include('../CommonMethods.php'); //access database from commonMeothod.php
$COMMON = new Common($debug);
?>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Select Advisor</title> <!--access page styling from css/standard.css-->
	<link rel='stylesheet' type='text/css' href='../css/standard.css'/>
  </head>
  <body>
    <div id="login">
      <div id="form">
        <div class="top">
		<h1>Individual Advising</h1>
		<h2>Select Advisor</h2>
	    <div class="field">
		<form action="08StudSelectTime.php" method="post" name="SelectAdvisor">
	    <?php
  $sql = "select * from Proj2Advisors"; //access advisor database
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
//add radio button for advisors only


while($row = mysql_fetch_row($rs)){
			  echo "<label for='",$row[0],"'><input id='",$row[0],"' type='radio' name='advisor' required value='", $row[0],"'>", $row[1]," ", $row[2],"</label><br>";
		
			  }
?>
        </div>
	<div class="nextButton">
  <input type="submit" name="next" class="button large go" value="Next">
      </div>

		</div>
		</form>
		<div>
		<form method="link" action="02StudHome.php"> <!--links back to homepage for student-->
		<input type="submit" name="home" class="button large" value="Cancel">
		</form>
		</div>
  </body>
</html>