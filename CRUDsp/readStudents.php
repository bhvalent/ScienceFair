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

			$query = "Select distinct FKRegistrationID from TeamMembers";
			$result = $mysqli->query($query);
			$tmArray = array();
			if ($result) {
				while ($row = $result->fetch_assoc()) {
					array_push($tmArray, $row['FKRegistrationID']);
				}
			}

			if ($type === "1") {
				$query = "Select RegistrationID, LName, FName, ProjTitle, Continuation, NumYears as `Years of Work`, Category.Description as `Category`, Age, Gender, Registration.City as `RCity`, State, Zip, AdultSponsor, WheelchairAccess, Class, Grade, SName, KeyTeacher, School.City as `SCity`, Type from ";
				$query .= "Fair inner join Registration on FairID = FKFairID ";
				$query .= "inner join Class on FKClassID = ClassID ";
				$query .= "inner join School on FKSchoolID = SchoolID ";
				$query .= "inner join Category on FKCategoryID = CategoryID ";
				$query .= "where FairID = ".$ID;
				$query .= " order by LName";

				$result = $mysqli->query($query);
				if ($result && $result->num_rows > 0) {
					

					echo "<div class='container-fluid'>";
					echo "<br><br>";
					echo "<div class='row justify-content-center'";
					echo "<head>";
					//echo "<h3>Students</h3>";
					echo "<h3 class='d-none d-md-block'>Students</h3>";
        			echo "<h5 class='d-md-none'>Students</h5>";
					echo "</head>";
					echo "</div>";

					echo "<div class='table-responsive'>";
					echo "<table class='table table-bordered table-hover'>";
					echo "<thead class='thead-dark text-center'>";
					echo "<tr>";
					echo "<th scope='col'>Last</th>";
					echo "<th scope='col'>First</th>";
					echo "<th scope='col'>Project Title</th>";
					echo "<th scope='col'>Continuation</th>";
					echo "<th scope='col'>Years of Work</th>";
					echo "<th scope='col'>Category</th>";
					echo "<th scope='col'>Age</th>";
					echo "<th scope='col'>Gender</th>";
					echo "<th scope='col'>City</th>";
					echo "<th scope='col'>State</th>";
					echo "<th scope='col'>Zip</th>";
					echo "<th scope='col'>Adult Sponsor</th>";
					echo "<th scope='col'>Wheelchair Access</th>";
					echo "<th scope='col'>Class</th>";
					echo "<th scope='col'>Grade</th>";
					echo "<th scope='col'>School</th>";
					echo "<th scope='col'>KeyTeacher</th>";
					echo "<th scope='col'>School City</th>";
					echo "<th scope='col'>Type</th>";
					echo "<th scope='col'></th>";
					echo "<th scope='col'></th>";
					echo "</tr>";
					echo "</thead>";
					echo "<tbody>";

					$partOfTeam = array();
					while ($row = $result->fetch_assoc()) {

						
						if (!(in_array($row['RegistrationID'], $tmArray))) {
							
							echo "<tr>";
							echo "<td class='text-center'>".$row['LName']."</td>";
							echo "<td class='text-center'>".$row['FName']."</td>";
							echo "<td class='text-center'>".$row['ProjTitle']."</td>";
							echo "<td class='text-center'>".$row['Continuation']."</td>";
							echo "<td class='text-center'>".$row['Years of Work']."</td>";
							echo "<td class='text-center'>".$row['Category']."</td>";
							echo "<td class='text-center'>".$row['Age']."</td>";
							echo "<td class='text-center'>".$row['Gender']."</td>";
							echo "<td class='text-center'>".$row['RCity']."</td>";
							echo "<td class='text-center'>".$row['State']."</td>";
							echo "<td class='text-center'>".$row['Zip']."</td>";
							echo "<td class='text-center'>".$row['AdultSponsor']."</td>";
							echo "<td class='text-center'>".$row['WheelchairAccess']."</td>";
							echo "<td class='text-center'>".$row['Class']."</td>";
							echo "<td class='text-center'>".$row['Grade']."</td>";
							echo "<td class='text-center'>".$row['SName']."</td>";
							echo "<td class='text-center'>".$row['KeyTeacher']."</td>";
							echo "<td class='text-center'>".$row['SCity']."</td>";
							echo "<td class='text-center'>".$row['Type']."</td>";
							echo "<td class='text-center'><a href='editStudent.php?id=".urlencode($ID)."&sid=".urlencode($row['RegistrationID'])."' class='btn btn-outline-warning'>Edit</a></td>";
							echo "<td class='text-center'><a href='deleteStudent.php?id=".urlencode($ID)."&sid=".urlencode($row['RegistrationID'])."' class='btn btn-outline-danger'>Delete</a></td>";
							echo "</tr>";
						}
						
						
					}		
					echo "</tbody>";
					echo "</table>";
					echo "</div>";



					echo "<br /><br />";
					echo "<div class='row justify-content-center'";
					echo "<head>";
					echo "<h3 class='d-none d-md-block'>Students on Teams</h3>";
        			echo "<h5 class='d-md-none'>Students on Teams</h5>";
					echo "</head>";
					echo "</div>";

					for ($i = 0; $i < count($tmArray); $i++) {
						$query = "Select RegistrationID, LName, FName, ProjTitle, Continuation, NumYears as `Years of Work`, Category.Description as `Category`, Age, Gender, Registration.City as `RCity`, State, Zip, AdultSponsor, WheelchairAccess, Class, Grade, SName, KeyTeacher, School.City as `SCity`, Type from ";
						$query .= "Fair inner join Registration on FairID = FKFairID ";
						$query .= "inner join Class on FKClassID = ClassID ";
						$query .= "inner join School on FKSchoolID = SchoolID ";
						$query .= "inner join Category on FKCategoryID = CategoryID ";
						$query .= "where FairID = ".$ID." and RegistrationID = ".$tmArray[$i];
						$query .= " order by LName";

						$result = $mysqli->query($query);
						if ($result) {
							echo "<div class='table-responsive'>";
							echo "<table class='table table-bordered table-hover'>";
							echo "<thead class='thead-dark text-center'>";
							echo "<tr>";
							echo "<th scope='col'>Last</th>";
							echo "<th scope='col'>First</th>";
							echo "<th scope='col'>Project Title</th>";
							echo "<th scope='col'>Continuation</th>";
							echo "<th scope='col'>Years of Work</th>";
							echo "<th scope='col'>Category</th>";
							echo "<th scope='col'>Age</th>";
							echo "<th scope='col'>Gender</th>";
							echo "<th scope='col'>City</th>";
							echo "<th scope='col'>State</th>";
							echo "<th scope='col'>Zip</th>";
							echo "<th scope='col'>Adult Sponsor</th>";
							echo "<th scope='col'>Wheelchair Access</th>";
							echo "<th scope='col'>Class</th>";
							echo "<th scope='col'>Grade</th>";
							echo "<th scope='col'>School</th>";
							echo "<th scope='col'>KeyTeacher</th>";
							echo "<th scope='col'>School City</th>";
							echo "<th scope='col'>Type</th>";
							echo "<th scope='col'></th>";
							echo "<th scope='col'></th>";
							echo "</tr>";
							echo "</thead>";
							echo "<tbody>";

							while ($row = $result->fetch_assoc()) {
								echo "<tr>";
								echo "<td class='text-center'>".$row['LName']."</td>";
								echo "<td class='text-center'>".$row['FName']."</td>";
								echo "<td class='text-center'>".$row['ProjTitle']."</td>";
								echo "<td class='text-center'>".$row['Continuation']."</td>";
								echo "<td class='text-center'>".$row['Years of Work']."</td>";
								echo "<td class='text-center'>".$row['Category']."</td>";
								echo "<td class='text-center'>".$row['Age']."</td>";
								echo "<td class='text-center'>".$row['Gender']."</td>";
								echo "<td class='text-center'>".$row['RCity']."</td>";
								echo "<td class='text-center'>".$row['State']."</td>";
								echo "<td class='text-center'>".$row['Zip']."</td>";
								echo "<td class='text-center'>".$row['AdultSponsor']."</td>";
								echo "<td class='text-center'>".$row['WheelchairAccess']."</td>";
								echo "<td class='text-center'>".$row['Class']."</td>";
								echo "<td class='text-center'>".$row['Grade']."</td>";
								echo "<td class='text-center'>".$row['SName']."</td>";
								echo "<td class='text-center'>".$row['KeyTeacher']."</td>";
								echo "<td class='text-center'>".$row['SCity']."</td>";
								echo "<td class='text-center'>".$row['Type']."</td>";
								echo "<td class='text-center'><a href='editStudent.php?id=".urlencode($ID)."&sid=".urlencode($row['RegistrationID'])."' class='btn btn-outline-warning'>Edit</a></td>";
								echo "<td class='text-center'><a href='deleteStudent.php?id=".urlencode($ID)."&sid=".urlencode($row['RegistrationID'])."' class='btn btn-outline-danger'>Delete</a></td>";
								echo "</tr>";
							
							$ProjTitle = $row['ProjTitle'];
							$Cate = $row['Category'];
							$AS = $row['AdultSponsor'];
							$Class = $row['Class'];
							$School = $row['SName'];
							$KeyTeacher = $row['KeyTeacher'];
							$SCity = $row['SCity'];
							$Type = $row['Type'];

							}


							$query = "Select LName, FName, Continuation, NumYears as `Years of Work`, ";
							$query .= "Age, Gender, City, State, Zip, WheelchairAccess, Grade ";
							$query .= "from TeamMembers ";
							$query .= "inner join Class on FKClassID = ClassID ";
							$query .= "where FKRegistrationID = ".$tmArray[$i];

							$result = $mysqli->query($query);
							if ($result){
								while ($row = $result->fetch_assoc()) {
									echo "<tr>";
									echo "<td class='text-center'>".$row['LName']."</td>";
									echo "<td class='text-center'>".$row['FName']."</td>";
									echo "<td class='text-center'>".$ProjTitle."</td>";
									echo "<td class='text-center'>".$row['Continuation']."</td>";
									echo "<td class='text-center'>".$row['Years of Work']."</td>";
									echo "<td class='text-center'>".$Cate."</td>";
									echo "<td class='text-center'>".$row['Age']."</td>";
									echo "<td class='text-center'>".$row['Gender']."</td>";
									echo "<td class='text-center'>".$row['City']."</td>";
									echo "<td class='text-center'>".$row['State']."</td>";
									echo "<td class='text-center'>".$row['Zip']."</td>";
									echo "<td class='text-center'>".$AS."</td>";
									echo "<td class='text-center'>".$row['WheelchairAccess']."</td>";
									echo "<td class='text-center'>".$Class."</td>";
									echo "<td class='text-center'>".$row['Grade']."</td>";
									echo "<td class='text-center'>".$School."</td>";
									echo "<td class='text-center'>".$KeyTeacher."</td>";
									echo "<td class='text-center'>".$SCity."</td>";
									echo "<td class='text-center'>".$Type."</td>";
									echo "<td class='text-center'><a href='editStudent.php?id=".urlencode($ID)."&sid=".urlencode($row['RegistrationID'])."' class='btn btn-outline-warning'>Edit</a></td>";
									echo "<td class='text-center'><a href='deleteStudent.php?id=".urlencode($ID)."&sid=".urlencode($row['RegistrationID'])."' class='btn btn-outline-danger'>Delete</a></td>";
									echo "</tr>";
								}
							} else {
								$_SESSION["message"] = "Unable to view Team Members";
			           			header("Location: FairHome.php?id=".$ID);
			           			exit;
							}

						} else {
							$_SESSION["message"] = "Unable to view Teams";
		           			header("Location: FairHome.php?id=".$ID);
		           			exit;
						}
					}


			
					echo "</div>";
				} else {
					$_SESSION["message"] = "Unable to view Students";
           			header("Location: FairHome.php?id=".$ID);
           			exit;
				}
			} elseif ($type === "2") {

				$query = "Select SName from School";
				$result = $mysqli->query($query);
				$array = array();
				if ($result && $result->num_rows > 0) {
					while ($row = $result->fetch_assoc()) {
						array_push($array, $row['SName']);
					}

					
					
					echo "<div class='container-fluid'";
					for ($i = 0; $i < count($array); $i++) {
						$query = "Select distinct FKRegistrationID from TeamMembers ";
						$query .= "inner join Registration on FKRegistrationID = RegistrationID ";
						$query .= "inner join School on FKSchoolID = SchoolID ";
						$query .= "where FKFairID = ".$ID." and SchoolID = ".$array[$i];

						$result = $mysqli->query($query);


						$stmArray = array();
						if ($result) {
							while ($row = $result->fetch_assoc()) {
								array_push($stmArray, $row['FKRegistrationID']);
							}
							$query = "Select RegistrationID, LName, FName, ProjTitle, Continuation, NumYears as `Years of Work`, Category.Description as `Category`, Age, Gender, Registration.City as `RCity`, State, Zip, AdultSponsor, WheelchairAccess, Class, Grade, SName, KeyTeacher, School.City as `SCity`, Type from ";
							$query .= "Fair inner join Registration on FairID = FKFairID ";
							$query .= "inner join Class on FKClassID = ClassID ";
							$query .= "inner join School on FKSchoolID = SchoolID ";
							$query .= "inner join Category on FKCategoryID = CategoryID ";
							$query .= "where FairID = ".$ID." and SName = '".$array[$i]."'";
							$query .= " order by LName";
							$result = $mysqli->query($query);
							if ($result && $result->num_rows > 0) {

								echo "<br><br>";
								echo "<div class='row justify-content-center'";
								echo "<head>";
								//echo "<h3>".$array[$i]."</h3>";
								echo "<h3 class='d-none d-md-block'>".$array[$i]."</h3>";
	        					echo "<h5 class='d-md-none'>".$array[$i]."</h5>";
								echo "</head>";
								echo "</div>";

								echo "<div class='table-responsive'>";
								echo "<table class='table table-bordered table-hover'>";
								echo "<thead class='thead-dark text-center'>";
								echo "<tr>";
								echo "<th scope='col'>Last</th>";
								echo "<th scope='col'>First</th>";
								echo "<th scope='col'>Project Title</th>";
								echo "<th scope='col'>Continuation</th>";
								echo "<th scope='col'>Years of Work</th>";
								echo "<th scope='col'>Category</th>";
								echo "<th scope='col'>Age</th>";
								echo "<th scope='col'>Gender</th>";
								echo "<th scope='col'>City</th>";
								echo "<th scope='col'>State</th>";
								echo "<th scope='col'>Zip</th>";
								echo "<th scope='col'>Adult Sponsor</th>";
								echo "<th scope='col'>Wheelchair Access</th>";
								echo "<th scope='col'>Class</th>";
								echo "<th scope='col'>Grade</th>";
								echo "<th scope='col'>School</th>";
								echo "<th scope='col'>KeyTeacher</th>";
								echo "<th scope='col'>School City</th>";
								echo "<th scope='col'>Type</th>";
								echo "<th scope='col'></th>";
								echo "<th scope='col'></th>";
								echo "</tr>";
								echo "</thead>";
								echo "<tbody>";

								$partOfTeam = array();
								while ($row = $result->fetch_assoc()) {
									
									
									if (!(in_array($row['RegistrationID'], $stmArray))) {
									
										echo "<tr>";
										echo "<td class='text-center'>".$row['LName']."</td>";
										echo "<td class='text-center'>".$row['FName']."</td>";
										echo "<td class='text-center'>".$row['ProjTitle']."</td>";
										echo "<td class='text-center'>".$row['Continuation']."</td>";
										echo "<td class='text-center'>".$row['Years of Work']."</td>";
										echo "<td class='text-center'>".$row['Category']."</td>";
										echo "<td class='text-center'>".$row['Age']."</td>";
										echo "<td class='text-center'>".$row['Gender']."</td>";
										echo "<td class='text-center'>".$row['RCity']."</td>";
										echo "<td class='text-center'>".$row['State']."</td>";
										echo "<td class='text-center'>".$row['Zip']."</td>";
										echo "<td class='text-center'>".$row['AdultSponsor']."</td>";
										echo "<td class='text-center'>".$row['WheelchairAccess']."</td>";
										echo "<td class='text-center'>".$row['Class']."</td>";
										echo "<td class='text-center'>".$row['Grade']."</td>";
										echo "<td class='text-center'>".$row['SName']."</td>";
										echo "<td class='text-center'>".$row['KeyTeacher']."</td>";
										echo "<td class='text-center'>".$row['SCity']."</td>";
										echo "<td class='text-center'>".$row['Type']."</td>";
										echo "<td class='text-center'><a href='editStudent.php?id=".urlencode($ID)."&sid=".urlencode($row['RegistrationID'])."' class='btn btn-outline-warning'>Edit</a></td>";
										echo "<td class='text-center'><a href='deleteStudent.php?id=".urlencode($ID)."&sid=".urlencode($row['RegistrationID'])."' class='btn btn-outline-danger'>Delete</a></td>";
										echo "</tr>";
									}
									
								}
								echo "</tbody>";
								echo "</table>";
								echo "</div>";

								// if statement to check if school has any teams

								echo "<br /><br />";
								echo "<div class='row justify-content-center'";
								echo "<head>";
								echo "<h3 class='d-none d-md-block'>Students on Teams</h3>";
			        			echo "<h5 class='d-md-none'>Students on Teams</h5>";
								echo "</head>";
								echo "</div>";

								for ($i = 0; $i < count($stmArray); $i++) {
									$query = "Select RegistrationID, LName, FName, ProjTitle, Continuation, NumYears as `Years of Work`, Category.Description as `Category`, Age, Gender, Registration.City as `RCity`, State, Zip, AdultSponsor, WheelchairAccess, Class, Grade, SName, KeyTeacher, School.City as `SCity`, Type from ";
									$query .= "Fair inner join Registration on FairID = FKFairID ";
									$query .= "inner join Class on FKClassID = ClassID ";
									$query .= "inner join School on FKSchoolID = SchoolID ";
									$query .= "inner join Category on FKCategoryID = CategoryID ";
									$query .= "where FairID = ".$ID." and RegistrationID = ".$tmArray[$i];
									$query .= " order by LName";

									$result = $mysqli->query($query);
									if ($result) {
										echo "<div class='table-responsive'>";
										echo "<table class='table table-bordered table-hover'>";
										echo "<thead class='thead-dark text-center'>";
										echo "<tr>";
										echo "<th scope='col'>Last</th>";
										echo "<th scope='col'>First</th>";
										echo "<th scope='col'>Project Title</th>";
										echo "<th scope='col'>Continuation</th>";
										echo "<th scope='col'>Years of Work</th>";
										echo "<th scope='col'>Category</th>";
										echo "<th scope='col'>Age</th>";
										echo "<th scope='col'>Gender</th>";
										echo "<th scope='col'>City</th>";
										echo "<th scope='col'>State</th>";
										echo "<th scope='col'>Zip</th>";
										echo "<th scope='col'>Adult Sponsor</th>";
										echo "<th scope='col'>Wheelchair Access</th>";
										echo "<th scope='col'>Class</th>";
										echo "<th scope='col'>Grade</th>";
										echo "<th scope='col'>School</th>";
										echo "<th scope='col'>KeyTeacher</th>";
										echo "<th scope='col'>School City</th>";
										echo "<th scope='col'>Type</th>";
										echo "<th scope='col'></th>";
										echo "<th scope='col'></th>";
										echo "</tr>";
										echo "</thead>";
										echo "<tbody>";

										while ($row = $result->fetch_assoc()) {
											echo "<tr>";
											echo "<td class='text-center'>".$row['LName']."</td>";
											echo "<td class='text-center'>".$row['FName']."</td>";
											echo "<td class='text-center'>".$row['ProjTitle']."</td>";
											echo "<td class='text-center'>".$row['Continuation']."</td>";
											echo "<td class='text-center'>".$row['Years of Work']."</td>";
											echo "<td class='text-center'>".$row['Category']."</td>";
											echo "<td class='text-center'>".$row['Age']."</td>";
											echo "<td class='text-center'>".$row['Gender']."</td>";
											echo "<td class='text-center'>".$row['RCity']."</td>";
											echo "<td class='text-center'>".$row['State']."</td>";
											echo "<td class='text-center'>".$row['Zip']."</td>";
											echo "<td class='text-center'>".$row['AdultSponsor']."</td>";
											echo "<td class='text-center'>".$row['WheelchairAccess']."</td>";
											echo "<td class='text-center'>".$row['Class']."</td>";
											echo "<td class='text-center'>".$row['Grade']."</td>";
											echo "<td class='text-center'>".$row['SName']."</td>";
											echo "<td class='text-center'>".$row['KeyTeacher']."</td>";
											echo "<td class='text-center'>".$row['SCity']."</td>";
											echo "<td class='text-center'>".$row['Type']."</td>";
											echo "<td class='text-center'><a href='editStudent.php?id=".urlencode($ID)."&sid=".urlencode($row['RegistrationID'])."' class='btn btn-outline-warning'>Edit</a></td>";
											echo "<td class='text-center'><a href='deleteStudent.php?id=".urlencode($ID)."&sid=".urlencode($row['RegistrationID'])."' class='btn btn-outline-danger'>Delete</a></td>";
											echo "</tr>";
										
											$ProjTitle = $row['ProjTitle'];
											$Cate = $row['Category'];
											$AS = $row['AdultSponsor'];
											$Class = $row['Class'];
											$School = $row['SName'];
											$KeyTeacher = $row['KeyTeacher'];
											$SCity = $row['SCity'];
											$Type = $row['Type'];

										}


										$query = "Select LName, FName, Continuation, NumYears as `Years of Work`, ";
										$query .= "Age, Gender, City, State, Zip, WheelchairAccess, Grade ";
										$query .= "from TeamMembers ";
										$query .= "inner join Class on FKClassID = ClassID ";
										$query .= "where FKRegistrationID = ".$tmArray[$i];

										$result = $mysqli->query($query);
										if ($result){
											while ($row = $result->fetch_assoc()) {
												echo "<tr>";
												echo "<td class='text-center'>".$row['LName']."</td>";
												echo "<td class='text-center'>".$row['FName']."</td>";
												echo "<td class='text-center'>".$ProjTitle."</td>";
												echo "<td class='text-center'>".$row['Continuation']."</td>";
												echo "<td class='text-center'>".$row['Years of Work']."</td>";
												echo "<td class='text-center'>".$Cate."</td>";
												echo "<td class='text-center'>".$row['Age']."</td>";
												echo "<td class='text-center'>".$row['Gender']."</td>";
												echo "<td class='text-center'>".$row['City']."</td>";
												echo "<td class='text-center'>".$row['State']."</td>";
												echo "<td class='text-center'>".$row['Zip']."</td>";
												echo "<td class='text-center'>".$AS."</td>";
												echo "<td class='text-center'>".$row['WheelchairAccess']."</td>";
												echo "<td class='text-center'>".$Class."</td>";
												echo "<td class='text-center'>".$row['Grade']."</td>";
												echo "<td class='text-center'>".$School."</td>";
												echo "<td class='text-center'>".$KeyTeacher."</td>";
												echo "<td class='text-center'>".$SCity."</td>";
												echo "<td class='text-center'>".$Type."</td>";
												echo "<td class='text-center'><a href='editStudent.php?id=".urlencode($ID)."&sid=".urlencode($row['RegistrationID'])."' class='btn btn-outline-warning'>Edit</a></td>";
												echo "<td class='text-center'><a href='deleteStudent.php?id=".urlencode($ID)."&sid=".urlencode($row['RegistrationID'])."' class='btn btn-outline-danger'>Delete</a></td>";
												echo "</tr>";
											}
										} else {
											$_SESSION["message"] = "Unable to view Team Members";
						           			header("Location: FairHome.php?id=".$ID);
						           			exit;
										}

									} else {
										$_SESSION["message"] = "Unable to view Teams";
					           			header("Location: FairHome.php?id=".$ID);
					           			exit;
									}
								}


							} else {
								$_SESSION["message"] = "Unable to view Students";
			           			header("Location: FairHome.php?id=".$ID);
			           			exit;
							}

						} else {
							$query = "Select RegistrationID, LName, FName, ProjTitle, Continuation, NumYears as `Years of Work`, Category.Description as `Category`, Age, Gender, Registration.City as `RCity`, State, Zip, AdultSponsor, WheelchairAccess, Class, Grade, SName, KeyTeacher, School.City as `SCity`, Type from ";
							$query .= "Fair inner join Registration on FairID = FKFairID ";
							$query .= "inner join Class on FKClassID = ClassID ";
							$query .= "inner join School on FKSchoolID = SchoolID ";
							$query .= "inner join Category on FKCategoryID = CategoryID ";
							$query .= "where FairID = ".$ID." and SName = '".$array[$i]."'";
							$query .= " order by LName";
							$result = $mysqli->query($query);
							if ($result && $result->num_rows > 0) {

								echo "<br><br>";
								echo "<div class='row justify-content-center'";
								echo "<head>";
								//echo "<h3>".$array[$i]."</h3>";
								echo "<h3 class='d-none d-md-block'>".$array[$i]."</h3>";
	        					echo "<h5 class='d-md-none'>".$array[$i]."</h5>";
								echo "</head>";
								echo "</div>";

								echo "<div class='table-responsive'>";
								echo "<table class='table table-bordered table-hover'>";
								echo "<thead class='thead-dark text-center'>";
								echo "<tr>";
								echo "<th scope='col'>Last</th>";
								echo "<th scope='col'>First</th>";
								echo "<th scope='col'>Project Title</th>";
								echo "<th scope='col'>Continuation</th>";
								echo "<th scope='col'>Years of Work</th>";
								echo "<th scope='col'>Category</th>";
								echo "<th scope='col'>Age</th>";
								echo "<th scope='col'>Gender</th>";
								echo "<th scope='col'>City</th>";
								echo "<th scope='col'>State</th>";
								echo "<th scope='col'>Zip</th>";
								echo "<th scope='col'>Adult Sponsor</th>";
								echo "<th scope='col'>Wheelchair Access</th>";
								echo "<th scope='col'>Class</th>";
								echo "<th scope='col'>Grade</th>";
								echo "<th scope='col'>School</th>";
								echo "<th scope='col'>KeyTeacher</th>";
								echo "<th scope='col'>School City</th>";
								echo "<th scope='col'>Type</th>";
								echo "<th scope='col'></th>";
								echo "<th scope='col'></th>";
								echo "</tr>";
								echo "</thead>";
								echo "<tbody>";

								$partOfTeam = array();
								while ($row = $result->fetch_assoc()) {
									
									echo "<tr>";
									echo "<td class='text-center'>".$row['LName']."</td>";
									echo "<td class='text-center'>".$row['FName']."</td>";
									echo "<td class='text-center'>".$row['ProjTitle']."</td>";
									echo "<td class='text-center'>".$row['Continuation']."</td>";
									echo "<td class='text-center'>".$row['Years of Work']."</td>";
									echo "<td class='text-center'>".$row['Category']."</td>";
									echo "<td class='text-center'>".$row['Age']."</td>";
									echo "<td class='text-center'>".$row['Gender']."</td>";
									echo "<td class='text-center'>".$row['RCity']."</td>";
									echo "<td class='text-center'>".$row['State']."</td>";
									echo "<td class='text-center'>".$row['Zip']."</td>";
									echo "<td class='text-center'>".$row['AdultSponsor']."</td>";
									echo "<td class='text-center'>".$row['WheelchairAccess']."</td>";
									echo "<td class='text-center'>".$row['Class']."</td>";
									echo "<td class='text-center'>".$row['Grade']."</td>";
									echo "<td class='text-center'>".$row['SName']."</td>";
									echo "<td class='text-center'>".$row['KeyTeacher']."</td>";
									echo "<td class='text-center'>".$row['SCity']."</td>";
									echo "<td class='text-center'>".$row['Type']."</td>";
									echo "<td class='text-center'><a href='editStudent.php?id=".urlencode($ID)."&sid=".urlencode($row['RegistrationID'])."' class='btn btn-outline-warning'>Edit</a></td>";
									echo "<td class='text-center'><a href='deleteStudent.php?id=".urlencode($ID)."&sid=".urlencode($row['RegistrationID'])."' class='btn btn-outline-danger'>Delete</a></td>";
									echo "</tr>";
									
									
								}
								echo "</tbody>";
								echo "</table>";
								echo "</div>";
						}

							
						

					}
					echo "</div>";

				} else {
					$_SESSION["message"] = "Unable to view Students";
           			header("Location: FairHome.php?id=".$ID);
           			exit;
				}

			} elseif ($type === "3") {

				$query = "Select Description as `Category` from Category";
				$result = $mysqli->query($query);
				$array = array();
				if ($result && $result->num_rows > 0) {
					while ($row = $result->fetch_assoc()) {
						array_push($array, $row['Category']);
					}
					
					echo "<div class='container-fluid'";
					for ($i = 0; $i < count($array); $i++) {
						$query = "Select RegistrationID, LName, FName, ProjTitle, Continuation, NumYears as `Years of Work`, Category.Description as `Category`, Age, Gender, Registration.City as `RCity`, State, Zip, AdultSponsor, WheelchairAccess, Class, Grade, SName, KeyTeacher, School.City as `SCity`, Type from ";
						$query .= "Fair inner join Registration on FairID = FKFairID ";
						$query .= "inner join Class on FKClassID = ClassID ";
						$query .= "inner join School on FKSchoolID = SchoolID ";
						$query .= "inner join Category on FKCategoryID = CategoryID ";
						$query .= "where FairID = ".$ID." and Description = '".$array[$i]."'";
						$query .= " order by LName";
						$result = $mysqli->query($query);
						if ($result && $result->num_rows > 0) {

							echo "<br><br>";
							echo "<div class='row justify-content-center'";
							echo "<head>";
							//echo "<h3>".$array[$i]."</h3>";
							echo "<h3 class='d-none d-md-block'>".$array[$i]."</h3>";
        					echo "<h5 class='d-md-none'>".$array[$i]."</h5>";
							echo "</head>";
							echo "</div>";

							echo "<div class='table-responsive'>";
							echo "<table class='table table-bordered table-hover'>";
							echo "<thead class='thead-dark text-center'>";
							echo "<tr>";
							echo "<th scope='col'>Last</th>";
							echo "<th scope='col'>First</th>";
							echo "<th scope='col'>Project Title</th>";
							echo "<th scope='col'>Continuation</th>";
							echo "<th scope='col'>Years of Work</th>";
							echo "<th scope='col'>Category</th>";
							echo "<th scope='col'>Age</th>";
							echo "<th scope='col'>Gender</th>";
							echo "<th scope='col'>City</th>";
							echo "<th scope='col'>State</th>";
							echo "<th scope='col'>Zip</th>";
							echo "<th scope='col'>Adult Sponsor</th>";
							echo "<th scope='col'>Wheelchair Access</th>";
							echo "<th scope='col'>Class</th>";
							echo "<th scope='col'>Grade</th>";
							echo "<th scope='col'>School</th>";
							echo "<th scope='col'>KeyTeacher</th>";
							echo "<th scope='col'>School City</th>";
							echo "<th scope='col'>Type</th>";
							echo "<th scope='col'></th>";
							echo "<th scope='col'></th>";
							echo "</tr>";
							echo "</thead>";
							echo "<tbody>";
							while ($row = $result->fetch_assoc()) {
								echo "<tr>";
								echo "<td class='text-center'>".$row['LName']."</td>";
								echo "<td class='text-center'>".$row['FName']."</td>";
								echo "<td class='text-center'>".$row['ProjTitle']."</td>";
								echo "<td class='text-center'>".$row['Continuation']."</td>";
								echo "<td class='text-center'>".$row['Years of Work']."</td>";
								echo "<td class='text-center'>".$row['Category']."</td>";
								echo "<td class='text-center'>".$row['Age']."</td>";
								echo "<td class='text-center'>".$row['Gender']."</td>";
								echo "<td class='text-center'>".$row['RCity']."</td>";
								echo "<td class='text-center'>".$row['State']."</td>";
								echo "<td class='text-center'>".$row['Zip']."</td>";
								echo "<td class='text-center'>".$row['AdultSponsor']."</td>";
								echo "<td class='text-center'>".$row['WheelchairAccess']."</td>";
								echo "<td class='text-center'>".$row['Class']."</td>";
								echo "<td class='text-center'>".$row['Grade']."</td>";
								echo "<td class='text-center'>".$row['SName']."</td>";
								echo "<td class='text-center'>".$row['KeyTeacher']."</td>";
								echo "<td class='text-center'>".$row['SCity']."</td>";
								echo "<td class='text-center'>".$row['Type']."</td>";
								echo "<td class='text-center'><a href='editStudent.php?id=".urlencode($ID)."&sid=".urlencode($row['RegistrationID'])."' class='btn btn-outline-warning'>Edit</a></td>";
								echo "<td class='text-center'><a href='deleteStudent.php?id=".urlencode($ID)."&sid=".urlencode($row['RegistrationID'])."' class='btn btn-outline-danger'>Delete</a></td>";
								echo "</tr>";
							}
							echo "</tbody>";
							echo "</table>";
							echo "</div>";
						}
						

					}
					echo "</div>";

				} else {
					$_SESSION["message"] = "Unable to view Students";
           			header("Location: FairHome.php?id=".$ID);
           			exit;
				}
				
			} elseif ($type === "4") {

				$query = "Select distinct Class from Class";
				$result = $mysqli->query($query);
				$array = array();
				if ($result && $result->num_rows > 0) {
					while ($row = $result->fetch_assoc()) {
						array_push($array, $row['Class']);
					}
					
					echo "<div class='container-fluid'";
					for ($i = 0; $i < count($array); $i++) {
						$query = "Select RegistrationID, LName, FName, ProjTitle, Continuation, NumYears as `Years of Work`, Category.Description as `Category`, Age, Gender, Registration.City as `RCity`, State, Zip, AdultSponsor, WheelchairAccess, Class, Grade, SName, KeyTeacher, School.City as `SCity`, Type from ";
						$query .= "Fair inner join Registration on FairID = FKFairID ";
						$query .= "inner join Class on FKClassID = ClassID ";
						$query .= "inner join School on FKSchoolID = SchoolID ";
						$query .= "inner join Category on FKCategoryID = CategoryID ";
						$query .= "where FairID = ".$ID." and Class = ".$array[$i];
						$query .= " order by LName";
						$result = $mysqli->query($query);
						if ($result && $result->num_rows > 0) {

							echo "<br><br>";
							echo "<div class='row justify-content-center'";
							echo "<head>";
							//echo "<h3>Class ".$array[$i]."</h3>";
							echo "<h3 class='d-none d-md-block'>Class ".$array[$i]."</h3>";
        					echo "<h5 class='d-md-none'>Class ".$array[$i]."</h5>";
							echo "</head>";
							echo "</div>";

							echo "<div class='table-responsive'>";
							echo "<table class='table table-bordered table-hover'>";
							echo "<thead class='thead-dark text-center'>";
							echo "<tr>";
							echo "<th scope='col'>Last</th>";
							echo "<th scope='col'>First</th>";
							echo "<th scope='col'>Project Title</th>";
							echo "<th scope='col'>Continuation</th>";
							echo "<th scope='col'>Years of Work</th>";
							echo "<th scope='col'>Category</th>";
							echo "<th scope='col'>Age</th>";
							echo "<th scope='col'>Gender</th>";
							echo "<th scope='col'>City</th>";
							echo "<th scope='col'>State</th>";
							echo "<th scope='col'>Zip</th>";
							echo "<th scope='col'>Adult Sponsor</th>";
							echo "<th scope='col'>Wheelchair Access</th>";
							echo "<th scope='col'>Class</th>";
							echo "<th scope='col'>Grade</th>";
							echo "<th scope='col'>School</th>";
							echo "<th scope='col'>KeyTeacher</th>";
							echo "<th scope='col'>School City</th>";
							echo "<th scope='col'>Type</th>";
							echo "<th scope='col'></th>";
							echo "<th scope='col'></th>";
							echo "</tr>";
							echo "</thead>";
							echo "<tbody>";
							while ($row = $result->fetch_assoc()) {
								echo "<tr>";
								echo "<td class='text-center'>".$row['LName']."</td>";
								echo "<td class='text-center'>".$row['FName']."</td>";
								echo "<td class='text-center'>".$row['ProjTitle']."</td>";
								echo "<td class='text-center'>".$row['Continuation']."</td>";
								echo "<td class='text-center'>".$row['Years of Work']."</td>";
								echo "<td class='text-center'>".$row['Category']."</td>";
								echo "<td class='text-center'>".$row['Age']."</td>";
								echo "<td class='text-center'>".$row['Gender']."</td>";
								echo "<td class='text-center'>".$row['RCity']."</td>";
								echo "<td class='text-center'>".$row['State']."</td>";
								echo "<td class='text-center'>".$row['Zip']."</td>";
								echo "<td class='text-center'>".$row['AdultSponsor']."</td>";
								echo "<td class='text-center'>".$row['WheelchairAccess']."</td>";
								echo "<td class='text-center'>".$row['Class']."</td>";
								echo "<td class='text-center'>".$row['Grade']."</td>";
								echo "<td class='text-center'>".$row['SName']."</td>";
								echo "<td class='text-center'>".$row['KeyTeacher']."</td>";
								echo "<td class='text-center'>".$row['SCity']."</td>";
								echo "<td class='text-center'>".$row['Type']."</td>";
								echo "<td class='text-center'><a href='editStudent.php?id=".urlencode($ID)."&sid=".urlencode($row['RegistrationID'])."' class='btn btn-outline-warning'>Edit</a></td>";
								echo "<td class='text-center'><a href='deleteStudent.php?id=".urlencode($ID)."&sid=".urlencode($row['RegistrationID'])."' class='btn btn-outline-danger'>Delete</a></td>";
								echo "</tr>";
							}
							echo "</tbody>";
							echo "</table>";
							echo "</div>";
						}
						

					}
					echo "</div>";

				} else {
					$_SESSION["message"] = "Unable to view Students";
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
<!-- <br /><br /><br /><br /> -->
 </html>