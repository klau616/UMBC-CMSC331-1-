<?php
session_start();
?>

<html lang="en">
    <head>
    <meta charset="UTF-8" />
    <title>Select Advising Type</title>
    <link rel='stylesheet' type='text/css' href='../css/standard.css'/>
    </head>
    <body>
    <div id="login">
    <div id="form">
    <div class="top">
    <h1>Schedule Appointment</h1>
    <h2>What kind of advising appointment would you like?</h2><br>
    <form action="StudProcessType.php" method="post" name="SelectType">
    <div class="nextButton">  <!--allow the user to select either group advising or individual-->
    <input type="submit" name="type" class="button large go" value="Individual">
    <input type="submit" name="type" class="button large go" value="Group" style="float: right;"><br>
    <input type="submit" name="type" class="button large go" value="Next Individual Available">
    <input type="submit" name="type" class="button large go" value="Next Group Available"style="float: right;">
	    </div>
		</div>
		</form>


<br>
<br>
		<div>
    <form method="link" action="02StudHome.php"> <!--links back to home page-->
		<input type="submit" name="home" class="button large" value="Cancel">
		</form>
		</div>
  </body>
</html>