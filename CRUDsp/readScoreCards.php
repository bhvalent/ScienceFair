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
	if (isset($_GET['id']) && $_GET['id'] != "") {
		$ID = $_GET['id'];
		$query1 = "Select * from Fair where FairID = ".$ID;

		$result = $mysqli->query($query1);
		if ($result && $result->num_rows > 0) {
			$row = $result->fetch_assoc();
			new_header($row['FairName']." ".$row['Year'], $ID);


			$query = "Select distinct SetJudgeID, LName, FName, CategoryID, Description, SetNumber from JudgeRegistrant ";
			$query .= "inner join SetJudge on FKSetJudgeID = SetJudgeID ";
			$query .= "inner join Judge on FKJudgeID = JudgeID ";
			$query .= "inner join Category on FKCategoryID = CategoryID ";
			$query .= "inner join Fair on FKFairID = FairID ";
			$query .= "where FKFairID = ".$ID." order by LName";
			

			$result = $mysqli->query($query);
			if ($result && $result->num_rows > 0) {
				

				echo "<div class='container-fluid'>";
				echo "<br><br>";
				echo "<div class='row justify-content-center'";
				echo "<head>";
				//echo "<h3>Students</h3>";
				echo "<h3 class='d-none d-md-block'>Score Cards</h3>";
    			echo "<h5 class='d-md-none'>Score Cards</h5>";
				echo "</head>";
				echo "</div>";

				echo "<div class='row justify-content-center'>";
				echo "<div class='col-xs-12 col-sm-12 col-md-11 col-lg-8'>";
				echo "<div class='table-responsive'>";
				echo "<table class='table table-bordered table-hover'>";
				echo "<thead class='thead-dark text-center'>";
				echo "<tr>";
				echo "<th scope='col'>Last</th>";
				echo "<th scope='col'>First</th>";
				echo "<th scope='col'>Category</th>";
				echo "<th scope='col'>Description</th>";
				echo "<th scope='col'>Set Number</th>";
				echo "<th scope='col'></th>";
				echo "</tr>";
				echo "</thead>";
				echo "<tbody>";
				while ($row = $result->fetch_assoc()) {
					echo "<tr>";
					echo "<td class='text-center'>".$row['LName']."</td>";
					echo "<td class='text-center'>".$row['FName']."</td>";
					echo "<td class='text-center'>".$row['CategoryID']."</td>";
					echo "<td class='text-center'>".$row['Description']."</td>";
					echo "<td class='text-center'>".$row['SetNumber']."</td>";
					echo "<td class='text-center'><a href='readScoreCardDetails.php?id=".$ID."&sjid=".$row['SetJudgeID']."&snum=".$row['SetNumber']."' class='btn btn-outline-primary'>View</a></td>";
					echo "</tr>";
				}		
				echo "</tbody>";
				echo "</table>";
				echo "</div>";
				echo "</div>";
				echo "</div>";

		
				echo "</div>";
			} else {
				$_SESSION["message"] = "Unable to view Score Cards";
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