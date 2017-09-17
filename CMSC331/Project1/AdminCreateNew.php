<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Create New Admin</title>
    <script type="text/javascript">
    function saveValue(target){
	var stepVal = document.getElementById(target).value;
	alert("Value: " + stepVal);
    }
    </script>
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
		<h2>New Advisor has been created:</h2>

		<?php
			$first = $_SESSION["AdvF"];
			$last = $_SESSION["AdvL"];
$office = $_SESSION["AdvO"]; //added office variable for office location
			$user = $_SESSION["AdvUN"];
			$pass = $_SESSION["AdvPW"];

			include('../CommonMethods.php');
			$debug = false;
			$Common = new Common($debug);

      $sql = "SELECT * FROM `Proj2Advisors` WHERE `Username` = '$user' AND `FirstName` = '$first' AND  `LastName` = '$last' AND `Office` = '$office'";
      $rs = $Common->executeQuery($sql, "Advising Appointments");
      $row = mysql_fetch_row($rs);
      
      if($row){
	//check if new admin exist in the database
        echo("<h3>Advisor $first $last already exists</h3>");
      }
      else{
	//insert new advisor's information into the data base "Proj2Advisors"
  			$sql = "INSERT INTO `Proj2Advisors`(`FirstName`, `LastName`, `Username`, `Password`, `Office`) 
  			VALUES ('$first', '$last', '$user', '$pass', '$office')";
        echo ("<h3>$first $last<h3>");

        $rs = $Common->executeQuery($sql, "Advising Appointments");
      }
		?>
		<form method="link" action="AdminUI.php">
			<input type="submit" name="next" class="button large go" value="Return to Home">
		</form>
	</div>
	</div>
	</div>
	</form>
  </body>
  
</html>
