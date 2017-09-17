<?php
session_start();
$debug = false;
include('../CommonMethods.php');
$COMMON = new Common($debug); 
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Search Appointments</title>
    <script type="text/javascript">
    function saveValue(target){
	var stepVal = document.getElementById(target).value;
	alert("Value: " + stepVal);
    }
    </script>
	<link rel='stylesheet' type='text/css' href='../css/standard.css'/>
  </head>
  <body>
    <div id="login">
      <div id="form">
        <div class="top">
			<h1>Search results</h1>
			<div class="field">
			<p>Showing results for: </p>
			<?php
				$date = $_POST["date"];
				$times = $_POST["time"];
				$advisor = $_POST["advisor"];
				$studID = $_POST["studID"];
				$studLN = $_POST["studLN"];
				$filter = $_POST["filter"];
				$results = array();

                              // This section is obtain from user
                              // user enter desire date and time to view current appointments

				if($date == ''){ echo "Date: All"; }
				else{ 
					echo "Date: ",$date;
					$date = date('Y-m-d', strtotime($date));
				}
				echo "<br>";
				if(empty($times)){ echo "Time: All"; }
				else{
					$i = 0;
					echo "Time: ";
					foreach($times as $t){
						echo ++$i, ") ", date('g:i A', strtotime($t)), " ";
					}
				}
				echo "<br>";
				if($advisor == ''){ echo "Advisor: All appointments"; }
				elseif($advisor == 'I'){ echo "Advisor: All individual appointments"; }
				elseif($advisor == '0'){ echo "Advisor: All group appointments"; }
				else{
					$sql = "select * from Proj2Advisors where `id` = '$advisor'";
					$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
					while($row = mysql_fetch_row($rs)){
						echo "Advisor: ", $row[1], " ", $row[2];
					}
				}
				echo "<br>";
if($studID == '' && $studLN == ''){	echo "Student: All"; } //if user is search with no specific username, it will display all the student that falls into that category
				else{
					$studLN = strtoupper($studLN);
					$studID = strtoupper($studID);
					$sql = "select `LastName`, `StudentID` from Proj2Students where `StudentID` = '$studID' or `LastName` = '$studLN'";
					$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
					$row = mysql_fetch_row($rs);
					$studLN = $row[0];
					$studID = $row[1];
					echo "Student: ", $studID, " ", $studLN;
				}
				echo "<br>";
				if($filter == ''){ echo "Filter: All appointments"; }
				elseif($filter == 0){ echo "Filter: Open appointments"; }
				elseif($filter == 1){ echo "Filter: Closed appointments"; }
				?>
				<br><br><label>
				<?php
				if(empty($times)){
				  //If time was not selected, 
					if($advisor == 'I'){
					  //if this is a invdividual advisor appointment
						if($filter == 1){
						  //if appointment is closed, aka status(filter) = 1
							$sql = "select * from Proj2Appointments where `Time` like '%$date%' and 
								`AdvisorID` != 0 and 
								`EnrolledID` like '%$studID%' and 
								`EnrolledNum` >= 1 order by `Time` ASC";
						}
						else{
						  //if appointment is open, aka status (filter) = 0
							$sql = "select * from Proj2Appointments where `Time` like '%$date%' and 
								`AdvisorID` != 0 and 
								`EnrolledID` like '%$studID%' and 
								`EnrolledNum` like '%$filter%' order by `Time` ASC";
						}
					}
					else{
					  //if it is a group advising appointment instead,
						if($filter == 1){
						  //if appointment is clsoed
							$sql = "select * from Proj2Appointments where `Time` like '%$date%' and 
								`AdvisorID` like '%$advisor%' and 
								`EnrolledID` like '%$studID%' and 
								`EnrolledNum` >= 1 order by `Time` ASC";
						}
						else{
						  //if appointment is still open, 
							$sql = "select * from Proj2Appointments where `Time` like '%$date%' and 
								`AdvisorID` like '%$advisor%' and 
								`EnrolledID` like '%$studID%' and 
								`EnrolledNum` like '%$filter%' order by `Time` ASC";
						}
					}
					$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
					$row = mysql_fetch_row($rs);
					$rsA = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
					if($row){
						while($row = mysql_fetch_row($rsA)){
							if($row[2] == 0){
							  //if the present appointment at date = 0, meaning the "advisor" is a group advising
								$advName = "Group";
							}
							else{
							  //if it is not a group advising appointment
							  //it will grab the advisor's name
								$sql2 = "select * from Proj2Advisors where `id` = '$row[2]'";
								$rs2 = $COMMON->executeQuery($sql2, $_SERVER["SCRIPT_NAME"]);
								$row2 = mysql_fetch_row($rs2);
								$advName = $row2[1] ." ". $row2[2];
							}
							//prints out the information about the appointment and the date
							$found = "Time: ". date('l, F d, Y g:i A', strtotime($row[1])). 
									"<br>Advisor: ". $advName. 
									"<br>Major: ". $row[3]. 
									"<br>Enrolled Students: ". $row[4]. 
									"<br>Number of enrolled student(s): ". $row[5]. 
									"<br>Maximum number of students allowed: ". $row[6]. "<br><br>";
							array_push($results, $found);
						}
					}
				}
				else{
					if($advisor == 'I'){
						foreach($times as $t){
							if($filter == 1){
								$sql = "select * from Proj2Appointments where `Time` like '%$date%' and `Time` like '%$t%' and 
									`AdvisorID` != 0 and 
									`EnrolledID` like '%$studID%' and
									`EnrolledNum` >= 1 order by `Time` ASC";
							}
							else{
								$sql = "select * from Proj2Appointments where `Time` like '%$date%' and `Time` like '%$t%' and 
									`AdvisorID` != 0 and 
									`EnrolledID` like '%$studID%' and
									`EnrolledNum` like '%$filter%' order by `Time` ASC";
							}
							$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
							$row = mysql_fetch_row($rs);
							$rsA = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
							if($row){
								while($row = mysql_fetch_row($rsA)){
									if($row[2] == 0){
										$advName = "Group";
									}
									else{
										$sql2 = "select * from Proj2Advisors where `id` = '$row[2]'";
										$rs2 = $COMMON->executeQuery($sql2, $_SERVER["SCRIPT_NAME"]);
										$row2 = mysql_fetch_row($rs2);
										$advName = $row2[1] ." ". $row2[2];
									}
									$found = "Time: ". date('l, F d, Y g:i A', strtotime($row[1])). 
											"<br>Advisor: ". $advName. 
											"<br>Major: ". $row[3]. 
											"<br>Enrolled Students: ". $row[4]. 
											"<br>Number of enrolled student(s): ". $row[5]. 
											"<br>Maximum number of students allowed: ". $row[6]. "<br><br>";
									array_push($results, $found);
								}
							}
						}
					}
					else{
					  //if time was selected for timeframe search,
					  foreach($times as $t){
							if ($filter == 1){
							  //prints out completed appointment
								$sql = "select * from Proj2Appointments where `Time` like '%$date%' and `Time` like '%$t%' and 
									`AdvisorID` like '%$advisor%' and 
									`EnrolledID` like '%$studID%' and 
									`EnrolledNum` >= 1 order by `Time` ASC";
							}
							else{
							  //returns incomplete/ongoing appointment
								$sql = "select * from Proj2Appointments where `Time` like '%$date%' and `Time` like '%$t%' and 
									`AdvisorID` like '%$advisor%' and 
									`EnrolledID` like '%$studID%' and 
									`EnrolledNum` like '%$filter%' order by `Time` ASC";
							}
							$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
							$row = mysql_fetch_row($rs);
							$rsA = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
							if($row){
								while($row = mysql_fetch_row($rsA)){
									if($row[2] == 0){
										$advName = "Group";
									}
									else{
									  //again, if it is not group advising, it will grab advisor's name
										$sql2 = "select * from Proj2Advisors where `id` = '$row[2]'";
										$rs2 = $COMMON->executeQuery($sql2, $_SERVER["SCRIPT_NAME"]);
										$row2 = mysql_fetch_row($rs2);
										$advName = $row2[1] ." ". $row2[2];
									}
									$found = "Time: ". date('l, F d, Y g:i A', strtotime($row[1])). 
											"<br>Advisor: ". $advName. 
											"<br>Major: ". $row[3]. 
											"<br>Enrolled Students: ". $row[4]. 
											"<br>Number of enrolled student(s): ". $row[5]. 
											"<br>Maximum number of students allowed: ". $row[6]. "<br><br>";
									array_push($results, $found);
								}
							}
						}
					}
				}
				if(empty($results)){
				  //if no data/appointment was within the given timeframe/date
					echo "No results found.<br><br>";
				}
				else{
				  //display the data that was appended in the list call "array"
					foreach($results as $r){
					echo $r;
					}
				}
				?>
				</label>
		<form method="link" action="AdminUI.php" name="home">
			<input type="submit" name="next" class="button large go" value="Return to Home">
		</form>
	</div>
	</div>
	</div>
	<div class="bottom">
		<p>If the Major category is followed by a blank, then it is open for all majors.</p>
	</div>
	<?php include('./workOrder/workButton.php'); ?>

	</div>
	</form>
  </body>
  
</html>
