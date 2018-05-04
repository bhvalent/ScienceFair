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
	if (isset($_GET['id']) && $_GET['id'] != "" && isset($_GET['type']) && $_GET['type'] != "") {
		$ID = $_GET['id'];
		$type = $_GET['type'];
		$query1 = "Select * from Fair where FairID = ".$ID;

		$result = $mysqli->query($query1);
		if ($result && $result->num_rows > 0) {
			$row = $result->fetch_assoc();
			new_header($row['FairName']." ".$row['Year'], $ID);

			if ($type === "1") {

				$query = "Select JudgeID, SetJudgeID, LName, FName, Email, Description as `Category` from ";
				$query .= "Judge inner join SetJudge on FKJudgeID = JudgeID ";
				$query .= "inner join Category on FKCategoryID = CategoryID ";
				$query .= "inner join Fair on FKFairID = FairID ";
				$query .= "where FairID = ".$ID." ";
				$query .= "order by LName";

				$result = $mysqli->query($query);
				if ($result && $result->num_rows > 0) {
					

					echo "<div class='container-fluid'>";
					echo "<br><br>";
					echo "<div class='row justify-content-center'";
					echo "<head>";
					//echo "<h3>Students</h3>";
					echo "<h3 class='d-none d-md-block'>Judges</h3>";
        			echo "<h5 class='d-md-none'>Judges</h5>";
					echo "</head>";
					echo "</div>";

					echo "<div class='row justify-content-center'>";
					echo "<div class='col-xs-12 col-sm-12 col-md-10 col-lg-8'>";
					echo "<div class='table-responsive'>";
					echo "<table class='table table-bordered table-hover'>";
					echo "<thead class='thead-dark text-center'>";
					echo "<tr>";
					echo "<th scope='col'>Last</th>";
					echo "<th scope='col'>First</th>";
					echo "<th scope='col'>Email</th>";
					echo "<th scope='col'>Category</th>";
					echo "<th scope='col'></th>";
					echo "<th scope='col'></th>";
					echo "</tr>";
					echo "</thead>";
					echo "<tbody>";
					while ($row = $result->fetch_assoc()) {
						echo "<tr>";
						echo "<td class='text-center'>".$row['LName']."</td>";
						echo "<td class='text-center'>".$row['FName']."</td>";
						echo "<td class='text-center'>".$row['Email']."</td>";
						echo "<td class='text-center'>".$row['Category']."</td>";
						echo "<td class='text-center'><a href='editJudge.php?id=".urlencode($ID)."&sjid=".urlencode($row['SetJudgeID'])."' class='btn btn-outline-warning'>Edit</a></td>";
						echo "<td class='text-center'><a href='deleteJudge.php?id=".urlencode($ID)."&sjid=".urlencode($row['SetJudgeID'])."' class='btn btn-outline-danger'>Delete</a></td>";
						echo "</tr>";
					}		
					echo "</tbody>";
					echo "</table>";
					echo "</div>";
					echo "</div>";
					echo "</div>";

					// Export button
					echo "<br /><br />";
					echo "<div class='row justify-content-center' align='center'>";
					echo "<div class='col-xs-12 col-sm-12 col-md-9 col-lg-6'>";
					echo "<p><b>Export Judge Data</b></p>";
					echo "<p></p>";
					echo "<a href='exportJudgesName.php?id=".$ID."' class='btn btn-success btn-block'>Export</a>";
					echo "</div>";
					echo "</div>";
					echo "<br /><br /><br /><br /><br /><br />";

			
					echo "</div>";
				} else {
					$_SESSION["message"] = "Unable to view Judges";
           			header("Location: FairHome.php?id=".$ID);
           			exit;
				}
			} elseif ($type === "2") {

				$query = "Select Description from Category order by Description";
				$result = $mysqli->query($query);
				$array = array();
				if ($result && $result->num_rows > 0) {
					while ($row = $result->fetch_assoc()) {
						array_push($array, $row['Description']);
					}
					
					echo "<div class='container-fluid'";
					for ($i = 0; $i < count($array); $i++) {

						$query = "Select JudgeID, SetJudgeID, LName, FName, Email, Description as `Category` from ";
						$query .= "Judge inner join SetJudge on FKJudgeID = JudgeID ";
						$query .= "inner join Category on FKCategoryID = CategoryID ";
						$query .= "inner join Fair on FKFairID = FairID ";
						$query .= "where FairID = ".$ID." and Description = '".$array[$i]."' ";
						$query .= "order by LName";
						$result = $mysqli->query($query);
						if ($result && $result->num_rows > 0) {

							echo "<br><br>";
							echo "<div class='row justify-content-center'>";
							echo "<head>";
							//echo "<h3>".$array[$i]."</h3>";
							echo "<h3 class='d-none d-md-block'>".$array[$i]."</h3>";
        					echo "<h5 class='d-md-none'>".$array[$i]."</h5>";
							echo "</head>";
							echo "</div>";

							echo "<div class='row justify-content-center'>";
							echo "<div class='col-xs-12 col-sm-12 col-md-10 col-lg-8'>";
							echo "<div class='table-responsive'>";
							echo "<table class='table table-bordered table-hover'>";
							echo "<thead class='thead-dark text-center'>";
							echo "<tr>";
							echo "<th scope='col'>Last</th>";
							echo "<th scope='col'>First</th>";
							echo "<th scope='col'>Email</th>";
							echo "<th scope='col'>Category</th>";
							echo "<th scope='col'></th>";
							echo "<th scope='col'></th>";
							echo "</tr>";
							echo "</thead>";
							echo "<tbody>";
							while ($row = $result->fetch_assoc()) {
								echo "<tr>";
								echo "<td class='text-center'>".$row['LName']."</td>";
								echo "<td class='text-center'>".$row['FName']."</td>";
								echo "<td class='text-center'>".$row['Email']."</td>";
								echo "<td class='text-center'>".$row['Category']."</td>";
								echo "<td class='text-center'><a href='editJudge.php?id=".urlencode($ID)."&sjid=".urlencode($row['SetJudgeID'])."' class='btn btn-outline-warning'>Edit</a></td>";
								echo "<td class='text-center'><a href='deleteJudge.php?id=".urlencode($ID)."&sjid=".urlencode($row['SetJudgeID'])."' class='btn btn-outline-danger'>Delete</a></td>";
								echo "</tr>";
							}
							echo "</tbody>";
							echo "</table>";
							echo "</div>";
							echo "</div>";
							echo "</div>";


							
						}
						

					}
					echo "</div>";


					// Export button
					echo "<br /><br />";
					echo "<div class='row justify-content-center' align='center'>";
					echo "<div class='col-xs-12 col-sm-12 col-md-9 col-lg-6'>";
					echo "<p><b>Export Judge Data</b></p>";
					echo "<p></p>";
					echo "<a href='exportJudgesCategory.php?id=".$ID."' class='btn btn-success btn-block'>Export</a>";
					echo "</div>";
					echo "</div>";
					echo "<br /><br /><br /><br /><br /><br />";

				} else {
					$_SESSION["message"] = "Unable to view Judges";
           			header("Location: FairHome.php?id=".$ID);
           			exit;
				}

			} else {
				$_SESSION["message"] = "Oops something went wrong";
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