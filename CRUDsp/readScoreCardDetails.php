<?php 
	require_once("session.php");
?>

<DOCTYPE! html>
<html lang="en">

<?php 
	require_once("included_functions.php");
	$mysqli = db_connection();
	if (($output = message()) !== null) {
		echo $output;
	}


	// adjust this and query after database is adjusted

	if ((isset($_GET['id']) && $_GET['id'] != "") && (isset($_GET['sjid']) && $_GET['sjid'] != "") && (isset($_GET['snum']) && $_GET['snum'] != "")) {
		$ID = $_GET['id'];
		$SJID = $_GET['sjid'];
		$SNUM = $_GET['snum'];
		$query1 = "Select * from Fair where FairID = ".$ID;

		$result = $mysqli->query($query1);
		if ($result && $result->num_rows > 0) {
			$row = $result->fetch_assoc();
			new_header($row['FairName']." ".$row['Year'], $ID);


			$query = "Select CategoryID, Description, CONCAT(Judge.FName, ' ', Judge.LName) as `JudgeName`, SetNumber ";
			$query .= "from JudgeRegistrant ";
			$query .= "inner join SetJudge on FKSetJudgeID = SetJudgeID ";
			$query .= "inner join Judge on FKJudgeID = JudgeID ";
			$query .= "inner join Category on FKCategoryID = CategoryID ";
			$query .= "inner join Fair on FKFairID = FairID ";
			$query .= "where FKSetJudgeID = ".$SJID." ";
			$query .= "and SetNumber = ".$SNUM." ";
			$query .= "and SetJudge.FKFairID = ".$ID;
			

			$result = $mysqli->query($query);
			if ($result && $result->num_rows > 0) {
				
				$row = $result->fetch_assoc();
				echo "<div class='container-fluid'>";
				echo "<br><br>";
				echo "<div class='row justify-content-center'";
				echo "<head>";
				//echo "<h3>Students</h3>";
				echo "<h3 class='d-none d-md-block'>Judge's Score Card</h3>";
    			echo "<h5 class='d-md-none'>Judge's Score Card</h5>";
				echo "</head>";
				echo "</div>";
				echo "<br />";

				echo "<div class='row justify-content-center'>";
				echo "<p><b>Name: </b>&emsp;".$row['JudgeName']."</p>";
    			echo "</div>";

				echo "<div class='row justify-content-center'>";
				echo "<p><b>Set Number: </b>&emsp;".$row['SetNumber']."</p>";
    			echo "</div>";

				echo "<div class='row justify-content-center'>";
				echo "<p><b>Category: </b>&emsp;".$row['CategoryID']."</p>";
    			echo "</div>";

    			echo "<div class='row justify-content-center'>";
				echo "<p><b>Description: </b>&emsp;".$row['Description']."</p>";
    			echo "</div>";

				


				$query2 = "Select Class, RegistrationID, CONCAT(Registration.FName, ' ', Registration.LName) as `StudentName`, ProjTitle, Score1, Score2, Total ";
				$query2 .= "from JudgeRegistrant ";
				$query2 .= "inner join Registration on FKRegistrationID = RegistrationID ";
				$query2 .= "inner join Class on FKClassID = ClassID ";
				$query2 .= "where FKSetJudgeID = ".$SJID." ";
				$query2 .= "and SetNumber = ".$SNUM;

				$result2 = $mysqli->query($query2);
				if ($result2 && $result2->num_rows > 0) {
					echo "<div class='row justify-content-center'>";
					echo "<div class='col-xs-12 col-sm-12 col-md-12 col-lg-11'>";
					echo "<div class='table-responsive'>";
					echo "<table class='table table-bordered table-hover'>";
					echo "<thead class='thead-dark text-center'>";
					echo "<tr>";
					echo "<th scope='col'>Class</th>";
					echo "<th scope='col'>Project Number</th>";
					echo "<th scope='col'>Name</th>";
					echo "<th scope='col'>Project Title</th>";
					echo "<th scope='col'>Score 1</th>";
					echo "<th scope='col'></th>";
					echo "<th scope='col'>Score 2</th>";
					echo "<th scope='col'></th>";
					echo "<th scope='col'>Total</th>";
					echo "<th scope='col'></th>";
					echo "</tr>";
					echo "</thead>";
					echo "<tbody>";
					while ($row2 = $result2->fetch_assoc()) {
						echo "<tr>";
						echo "<td class='text-center'>".$row2['Class']."</td>";
						echo "<td class='text-center'>".$row2['RegistrationID']."</td>";
						echo "<td class='text-center'>".$row2['StudentName']."</td>";
						echo "<td class='text-center'>".$row2['ProjTitle']."</td>";
						echo "<td class='text-center'>".$row2['Score1']."</td>";
						echo "<td class='text-center'><a href='editScore.php?id=".$ID."&rid=".$row2 ['RegistrationID']."&sjid=".$SJID."&snum=".$SNUM."&type=1' class='btn btn-outline-warning'>Edit</a></td>";
						echo "<td class='text-center'>".$row2['Score2']."</td>";
						echo "<td class='text-center'><a href='editScore.php?id=".$ID."&rid=".$row2 ['RegistrationID']."&sjid=".$SJID."&snum=".$SNUM."&type=2' class='btn btn-outline-warning'>Edit</a></td>";
						echo "<td class='text-center'>".$row2['Total']."</td>";
						echo "<td class='text-center'><a href='addScore.php?id=".$ID."&rid=".$row2 ['RegistrationID']."&sjid=".$SJID."&snum=".$SNUM."' class='btn btn-outline-primary'>Add Score</a></td>";
						echo "</tr>";
					}		
					echo "</tbody>";
					echo "</table>";
					echo "</div>";
					echo "</div>";
					echo "</div>";

					echo "<div class='row justify-content-center'>";
					echo "<a href='readScoreCards.php?id=".urlencode($ID)."' class='btn btn-primary'>Back</a>";
					echo "</div>";
					
					echo "</div>";
				} else {
					$_SESSION["message"] = "Unable to view Score Card Details";
       				header("Location: FairHome.php?id=".$ID);
       				exit;
				}

				

		
				
			} else {
				$_SESSION["message"] = "Unable to view Score Card";
       			header("Location: FairHome.php?id=".$ID);
       			exit;
			}
			 

		} else {
			$_SESSION["message"] = "Error! Fair could not be found.";
            header("Location: SFindex.php");
            exit;
		}

		

	} else {
		$_SESSION["message"] = "Error! Variables not set";
        header("Location: SFindex.php");
        exit;
	}

 ?>
<br /><br /><br />
 </html>