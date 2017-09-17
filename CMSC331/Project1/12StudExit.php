<?php
session_start();
?>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Exit Message</title> <!--styling purpose for the page-->
    <link rel='stylesheet' type='text/css' href='../css/standard.css'/>
    <style type="text/css">
    //********************** klau4 10/21/2015
    // link style back to css files. Saved addition spaces
    
    </style>
  </head>
  <body>
    <div id="login">
      <div id="form">
        <div class="top">
	    <div class="statusMessage">
	    <?php
			$_SESSION["resch"] = false;			
			if($_SESSION["status"] == "complete"){
			  //if scheudling is complete, it will prompt user the following message
				echo "You have completed your sign-up for an advising appointment.";
			}
			elseif($_SESSION["status"] == "none"){
			  //if scheduling was not setup
				echo "You did not sign up for an advising appointment.";
			}
			if($_SESSION["status"] == "cancel"){
			  //if scheduling was cancelled
				echo "You have cancelled your advising appointment.";
			}
			if($_SESSION["status"] == "resch"){
			  //if scheudling was changed
				echo "You have changed your advising appointment.";
			}
			if($_SESSION["status"] == "keep"){
			  //if no changes were made  
				echo "No changes have been made to your advising appointment.";
			}
		?>
        </div>
		<form action="02StudHome.php" method="post" name="complete">
	    <div class="returnButton"> <!--returns to the homepage for the student-->
			<input type="submit" name="return" class="button large go" value="Return to Home">
	    </div>
		</div>
		</form>
  </body>
</html>