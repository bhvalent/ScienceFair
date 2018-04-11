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

			
			

			$query = "Select CategoryID, Description from Category";
			$result = $mysqli->query($query);
			$array = array();
			$array2 = array();
			if ($result && $result->num_rows > 0) {
				while ($row = $result->fetch_assoc()) {
					array_push($array, $row['Description']);
					array_push($array2, $row['CategoryID']);
				}
				
				echo "<div class='container-fluid'";
				for ($i = 0; $i < count($array); $i++) {


					$query = "select distinct SetNumber, Description from JudgeRegistrant inner join SetJudge on FKSetJudgeID = SetJudgeID inner join Category on FKCategoryID = CategoryID inner join Fair on FKFairID = FairID where Description = '".$array[$i]."' and FairID = 1";

					$result = $mysqli->query($query);

					echo "<br><br>";

						
					echo "<div class='row justify-content-center'>";
					echo "<head>";
					echo "<h3 class='d-none d-md-block'>".$array[$i]."</h3>";
					echo "<h5 class='d-md-none'>".$array[$i]."</h5>";
					echo "</head>";
					echo "</div>";

					if ($result && $result->num_rows > 0) {

							


						echo "<div class='row justify-content-center'>";
						echo "<div class='col-xs-12 col-sm-12 col-md-8 col-lg-6'>";
						echo "<div class='table-responsive'>";
						echo "<table class='table table-bordered table-hover'>";
						echo "<thead class='thead-dark text-center'>";
						echo "<tr>";
						echo "<th scope='col'>Set Number</th>";
						echo "<th scope='col'></th>";
						echo "</tr>";
						echo "</thead>";
						echo "<tbody>";
						while ($row = $result->fetch_assoc()) {
							echo "<tr>";
							echo "<td class='text-center'>".$row['SetNumber']."</td>";
							echo "<td class='text-center'><a href='readSets.php?id=".urlencode($ID)."&snum=".urlencode($row['SetNumber'])."' class='btn btn-primary'>View Set</a></td>";
							echo "</tr>";
						}
						echo "</tbody>";
						echo "</table>";
						echo "</div>";
						echo "</div>";
						echo "</div>";
					} 
						
					echo "<div class='container'>";
					echo "<br /><br />";
					//echo "<span class='border-bottom border-danger'>";
					echo "<div class='row justify-content-center'>";
					echo "<a href='addSets.php?id=".urlencode($ID)."&cid=".$array2[$i]."' class='btn btn-primary'>Add Category</a>";
					echo "</div>";
					//echo "</span>";
					echo "</div>";
					//echo "<hr>";
					
					echo "<br /><br />";
					echo "<hr style='width: 100%; color: black; height: 1px; background-color:black;' />";
					echo "<br /><br /><br /><br /><br />";
					echo "<hr style='width: 100%; color: black; height: 1px; background-color:black;' />";
				}
				echo "</div>";

			} else {
				$_SESSION["message"] = "Unable to view Categories";
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