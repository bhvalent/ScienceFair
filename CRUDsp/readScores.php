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

				$query = "Select Description from Category order by Description";
				$result = $mysqli->query($query);
				$catArray = array();
				if ($result && $result->num_rows > 0) {
					while ($row = $result->fetch_assoc()) {
						array_push($catArray, $row['Description']);
					}

					
					
					echo "<div class='container-fluid'";
					for ($i = 0; $i < count($catArray); $i++) {
						
						$query = "Select distinct Class from Registration ";
						$query .= "inner join Fair on FKFairID = FairID ";
						$query .= "inner join Category on FKCategoryID = CategoryID ";
						$query .= "inner join Class on FKClassID = ClassID ";
						$query .= "where FairID = ".$ID." and Description = '".$catArray[$i]."'";

						$result = $mysqli->query($query);
						$classArray = array();
						if ($result && $result->num_rows > 0) {
							while ($row = $result->fetch_assoc()) {
								array_push($classArray, $row['Class']);
							}

							// add Category Header
							echo "<br><br>";
							echo "<div class='row justify-content-center'>";
							echo "<head>";
							echo "<h3 class='d-none d-md-block'><b>".$catArray[$i]."</b></h4>";
        					echo "<h5 class='d-md-none'><b>".$catArray[$i]."</b></h6>";
							echo "</head>";
							echo "</div>";

							for ($j = 0; $j < count($classArray); $j++) {

								$query = "Select RegistrationID, concat(LName, ', ', FName) as `Name`, ProjTitle, Continuation, ";
								$query .= "NumYears, Age, Gender, AdultSponsor, Grade, SName, Score1, Score2, Total, Rank ";
								$query .= "from Registration ";
								$query .= "inner join Fair on FKFairID = FairID ";
								$query .= "inner join School on FKSchoolID = SchoolID ";
								$query .= "inner join Category on FKCategoryID = CategoryID ";
								$query .= "inner join Class on FKClassID = ClassID ";
								$query .= "where FKFairID = ".$ID." and Description = '".$catArray[$i]."' and Class = ".$classArray[$j]." ";
								$query .= "order by Total DESC, Rank ASC";

								$result = $mysqli->query($query);
								if ($result && $result->num_rows > 0) {

									echo "<br><br>";
									echo "<div class='row justify-content-center'>";
									echo "<head>";
									echo "<h3 class='d-none d-md-block'>Class: ".$classArray[$j]."</h3>";
		        					echo "<h5 class='d-md-none'>Class: ".$classArray[$j]."</h5>";
									echo "</head>";
									echo "</div>";

									echo "<div class='table-responsive'>";
									echo "<table class='table table-bordered table-hover'>";
									echo "<thead class='thead-dark text-center'>";
									echo "<tr>";
									echo "<th scope='col'>Rank</th>";
									echo "<th scope='col'>Project Number</th>";
									echo "<th scope='col'>Name</th>";
									echo "<th scope='col'>Project Title</th>";
									echo "<th scope='col'>Continuation</th>";
									echo "<th scope='col'>Years of Work</th>";
									echo "<th scope='col'>Age</th>";
									echo "<th scope='col'>Gender</th>";
									echo "<th scope='col'>Adult Sponsor</th>";
									echo "<th scope='col'>Grade</th>";
									echo "<th scope='col'>School</th>";
									echo "<th scope='col'>Score 1</th>";
									echo "<th scope='col'>Score 2</th>";
									echo "<th scope='col'>Total</th>";
									echo "</tr>";
									echo "</thead>";
									echo "<tbody>";
									while ($row = $result->fetch_assoc()) {
										echo "<tr>";
										echo "<td class='text-center'>".$row['Rank']."</td>";
										echo "<td class='text-center'>".$row['RegistrationID']."</td>";
										echo "<td class='text-center'>".$row['Name']."</td>";
										echo "<td class='text-center'>".$row['ProjTitle']."</td>";
										echo "<td class='text-center'>".$row['Continuation']."</td>";
										echo "<td class='text-center'>".$row['Years of Work']."</td>";
										echo "<td class='text-center'>".$row['Age']."</td>";
										echo "<td class='text-center'>".$row['Gender']."</td>";
										echo "<td class='text-center'>".$row['AdultSponsor']."</td>";
										echo "<td class='text-center'>".$row['Grade']."</td>";
										echo "<td class='text-center'>".$row['SName']."</td>";
										echo "<td class='text-center'>".$row['Score1']."</td>";
										echo "<td class='text-center'>".$row['Score2']."</td>";
										echo "<td class='text-center'>".$row['Total']."</td>";
										echo "</tr>";
									}
									echo "</tbody>";
									echo "</table>";
									echo "</div>";
								} else {
									$_SESSION["message"] = "Error! Unable to view Scores";
				           			header("Location: FairHome.php?id=".$ID);
				           			exit;
								}
							}
							echo "<br /><br /><br />";

							
						} 

					}
					echo "</div>";

				} else {
					$_SESSION["message"] = "Error! Unable to view Categories";
           			header("Location: FairHome.php?id=".$ID);
           			exit;
				}

			} elseif ($type === "2") {

				$query = "Select distinct Class from Class order by Class";
				$result = $mysqli->query($query);
				$classArray = array();
				if ($result && $result->num_rows > 0) {
					while ($row = $result->fetch_assoc()) {
						array_push($classArray, $row['Class']);
					}

					
					
					echo "<div class='container-fluid'";
					for ($i = 0; $i < count($classArray); $i++) {
						
						$query = "Select distinct Description from Registration ";
						$query .= "inner join Fair on FKFairID = FairID ";
						$query .= "inner join Category on FKCategoryID = CategoryID ";
						$query .= "inner join Class on FKClassID = ClassID ";
						$query .= "where FairID = ".$ID." and Class = '".$classArray[$i]."'";

						$result = $mysqli->query($query);
						$catArray = array();
						if ($result && $result->num_rows > 0) {
							while ($row = $result->fetch_assoc()) {
								array_push($catArray, $row['Description']);
							}

							// add Class Header
							echo "<br><br>";
							echo "<div class='row justify-content-center'>";
							echo "<head>";
							echo "<h3 class='d-none d-md-block'><b>Class: ".$classArray[$i]."</b></h4>";
        					echo "<h5 class='d-md-none'><b>Class: ".$classArray[$i]."</b></h6>";
							echo "</head>";
							echo "</div>";

							for ($j = 0; $j < count($catArray); $j++) {

								$query = "Select RegistrationID, concat(LName, ', ', FName) as `Name`, ProjTitle, Continuation, ";
								$query .= "NumYears, Age, Gender, AdultSponsor, Grade, SName, Score1, Score2, Total, Rank ";
								$query .= "from Registration ";
								$query .= "inner join Fair on FKFairID = FairID ";
								$query .= "inner join School on FKSchoolID = SchoolID ";
								$query .= "inner join Category on FKCategoryID = CategoryID ";
								$query .= "inner join Class on FKClassID = ClassID ";
								$query .= "where FKFairID = ".$ID." and Description = '".$catArray[$j]."' and Class = ".$classArray[$i]." ";
								$query .= "order by Total DESC, Rank ASC";

								$result = $mysqli->query($query);
								if ($result && $result->num_rows > 0) {

									echo "<br><br>";
									echo "<div class='row justify-content-center'>";
									echo "<head>";
									echo "<h3 class='d-none d-md-block'>".$catArray[$j]."</h3>";
		        					echo "<h5 class='d-md-none'>".$catArray[$j]."</h5>";
									echo "</head>";
									echo "</div>";

									echo "<div class='table-responsive'>";
									echo "<table class='table table-bordered table-hover'>";
									echo "<thead class='thead-dark text-center'>";
									echo "<tr>";
									echo "<th scope='col'>Rank</th>";
									echo "<th scope='col'>Project Number</th>";
									echo "<th scope='col'>Name</th>";
									echo "<th scope='col'>Project Title</th>";
									echo "<th scope='col'>Continuation</th>";
									echo "<th scope='col'>Years of Work</th>";
									echo "<th scope='col'>Age</th>";
									echo "<th scope='col'>Gender</th>";
									echo "<th scope='col'>Adult Sponsor</th>";
									echo "<th scope='col'>Grade</th>";
									echo "<th scope='col'>School</th>";
									echo "<th scope='col'>Score 1</th>";
									echo "<th scope='col'>Score 2</th>";
									echo "<th scope='col'>Total</th>";
									echo "</tr>";
									echo "</thead>";
									echo "<tbody>";
									while ($row = $result->fetch_assoc()) {
										echo "<tr>";
										echo "<td class='text-center'>".$row['Rank']."</td>";
										echo "<td class='text-center'>".$row['RegistrationID']."</td>";
										echo "<td class='text-center'>".$row['Name']."</td>";
										echo "<td class='text-center'>".$row['ProjTitle']."</td>";
										echo "<td class='text-center'>".$row['Continuation']."</td>";
										echo "<td class='text-center'>".$row['Years of Work']."</td>";
										echo "<td class='text-center'>".$row['Age']."</td>";
										echo "<td class='text-center'>".$row['Gender']."</td>";
										echo "<td class='text-center'>".$row['AdultSponsor']."</td>";
										echo "<td class='text-center'>".$row['Grade']."</td>";
										echo "<td class='text-center'>".$row['SName']."</td>";
										echo "<td class='text-center'>".$row['Score1']."</td>";
										echo "<td class='text-center'>".$row['Score2']."</td>";
										echo "<td class='text-center'>".$row['Total']."</td>";
										echo "</tr>";
									}
									echo "</tbody>";
									echo "</table>";
									echo "</div>";
								} else {
									$_SESSION["message"] = "Error! Unable to view Scores";
				           			header("Location: FairHome.php?id=".$ID);
				           			exit;
								}
							}
							echo "<br /><br /><br />";

							
						} 

					}
					echo "</div>";

				} else {
					$_SESSION["message"] = "Error! Unable to view Classes";
           			header("Location: FairHome.php?id=".$ID);
           			exit;
				}

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
<br /><br /><br /><br /><br /><br />
 </html>