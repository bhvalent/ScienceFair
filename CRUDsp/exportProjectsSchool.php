<?php
	
	require_once("included_functions.php");
	require_once("session.php");
	verifyLogIn();
	$mysqli = db_connection_noMessage();

	if (isset($_GET['id']) && $_GET['id'] != "") {
		$ID = $_GET['id'];
		$query1 = "Select * from Fair where FairID = ".$ID;

		$result = $mysqli->query($query1);
		$name = "";
		if ($result && $result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$name = $row['FairName'].$row['Year'];
		}

		$name = str_replace(" ", "", $name);

		header( "Content-Type: application/vnd.ms-excel" );
		header( "Content-disposition: attachment; filename=projectsBySchool".$name.".xls" );








		$query = "Select SName from School order by SName";
		$result = $mysqli->query($query);
		$array = array();
		if ($result && $result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				array_push($array, $row['SName']);
			}

			
			
			
			for ($i = 0; $i < count($array); $i++) {
				$query = "Select distinct FKRegistrationID from TeamMembers ";
				$query .= "inner join Registration on FKRegistrationID = RegistrationID ";
				$query .= "inner join School on FKSchoolID = SchoolID ";
				$query .= "where FKFairID = ".$ID." and SName = '".$array[$i]."'";

				$result = $mysqli->query($query);


				$stmArray = array();
				if ($result && $result->num_rows > 0) {
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


						// school header
						echo "$array[$i]" . "\n";
						
						
						

						// Columns
						$columns = 'Last Name' . "\t" . 'First Name' . "\t" . 'Project Title' . "\t";
						$columns .= 'Continuation' . "\t" . 'Years of Work' . "\t" . 'Category' . "\t";
						$columns .= 'Age' . "\t" . 'Gender' . "\t" . 'City' . "\t";
						$columns .= 'State' . "\t" . 'Zip' . "\t" . 'Adult Sponsor' . "\t";
						$columns .= 'Wheelchair Access' . "\t" . 'Class' . "\t" . 'Grade' . "\t";
						$columns .= 'School' . "\t" . 'Key Teacher' . "\t" . 'School City' . "\t" . 'Type' . "\n";

						echo $columns;

						
						while ($row = $result->fetch_assoc()) {
							
							
							if (!(in_array($row['RegistrationID'], $stmArray))) {
							
								// data
								$data = $row['LName'] . "\t" . $row['FName'] . "\t" . $row['ProjTitle'] . "\t";
								$data .= $row['Continuation'] . "\t" . $row['Years of Work'] . "\t" . $row['Category'] . "\t";
								$data .= $row['Age'] . "\t" . $row['Gender'] . "\t" . $row['RCity'] . "\t";
								$data .= $row['State'] . "\t" . $row['Zip'] . "\t" . $row['AdultSponsor'] . "\t";
								$data .= $row['WheelchairAccess'] . "\t" . $row['Class'] . "\t" . $row['Grade'] . "\t";
								$data .= $row['SName'] . "\t" . $row['KeyTeacher'] . "\t" . $row['SCity'] . "\t" . $row['Type'] . "\n";	
									
								echo $data;	 

							}
							
						}
						

						

						

						for ($j = 0; $j < count($stmArray); $j++) {
							$query2 = "Select RegistrationID, LName, FName, ProjTitle, Continuation, NumYears as `Years of Work`, Category.Description as `Category`, Age, Gender, Registration.City as `RCity`, State, Zip, AdultSponsor, WheelchairAccess, Class, Grade, SName, KeyTeacher, School.City as `SCity`, Type from ";
							$query2 .= "Fair inner join Registration on FairID = FKFairID ";
							$query2 .= "inner join Class on FKClassID = ClassID ";
							$query2 .= "inner join School on FKSchoolID = SchoolID ";
							$query2 .= "inner join Category on FKCategoryID = CategoryID ";
							$query2 .= "where FairID = ".$ID." and RegistrationID = ".$stmArray[$j];
							$query2 .= " order by LName";

							$result2 = $mysqli->query($query2);
							if ($result2) {
								

								// empty line separating indvudual and team
								echo "\n";

								// columns
								$columns = 'Last Name' . "\t" . 'First Name' . "\t" . 'Project Title' . "\t";
								$columns .= 'Continuation' . "\t" . 'Years of Work' . "\t" . 'Category' . "\t";
								$columns .= 'Age' . "\t" . 'Gender' . "\t" . 'City' . "\t";
								$columns .= 'State' . "\t" . 'Zip' . "\t" . 'Adult Sponsor' . "\t";
								$columns .= 'Wheelchair Access' . "\t" . 'Class' . "\t" . 'Grade' . "\t";
								$columns .= 'School' . "\t" . 'Key Teacher' . "\t" . 'School City' . "\t" . 'Type' . "\n";

								echo $columns;



								while ($row = $result2->fetch_assoc()) {
									



									// data
									$data = $row['LName'] . "\t" . $row['FName'] . "\t" . $row['ProjTitle'] . "\t";
									$data .= $row['Continuation'] . "\t" . $row['Years of Work'] . "\t" . $row['Category'] . "\t";
									$data .= $row['Age'] . "\t" . $row['Gender'] . "\t" . $row['RCity'] . "\t";
									$data .= $row['State'] . "\t" . $row['Zip'] . "\t" . $row['AdultSponsor'] . "\t";
									$data .= $row['WheelchairAccess'] . "\t" . $row['Class'] . "\t" . $row['Grade'] . "\t";
									$data .= $row['SName'] . "\t" . $row['KeyTeacher'] . "\t" . $row['SCity'] . "\t" . $row['Type'] . "\n";	
										
									echo $data;	 



								
									$ProjTitle = $row['ProjTitle'];
									$Cate = $row['Category'];
									$AS = $row['AdultSponsor'];
									$Class = $row['Class'];
									$School = $row['SName'];
									$KeyTeacher = $row['KeyTeacher'];
									$SCity = $row['SCity'];
									$Type = $row['Type'];

								}


								$query1 = "Select TeamMemberID, LName, FName, Continuation, NumYears as `Years of Work`, ";
								$query1 .= "Age, Gender, City, State, Zip, WheelchairAccess, Grade ";
								$query1 .= "from TeamMembers ";
								$query1 .= "inner join Class on FKClassID = ClassID ";
								$query1 .= "where FKRegistrationID = ".$stmArray[$j];

								$result1 = $mysqli->query($query1);
								if ($result1){
									while ($row = $result1->fetch_assoc()) {
										



										// data with variables
										$data = $row['LName'] . "\t" . $row['FName'] . "\t" . $ProjTitle . "\t";
										$data .= $row['Continuation'] . "\t" . $row['Years of Work'] . "\t" . $Cate . "\t";
										$data .= $row['Age'] . "\t" . $row['Gender'] . "\t" . $row['RCity'] . "\t";
										$data .= $row['State'] . "\t" . $row['Zip'] . "\t" . $AS . "\t";
										$data .= $row['WheelchairAccess'] . "\t" . $Class . "\t" . $row['Grade'] . "\t";
										$data .= $School . "\t" . $KeyTeacher . "\t" . $SCity . "\t" . $Type . "\n";	
											
										echo $data;



									}

									echo "\n";	
									echo "\n";
									echo "\n";
									
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

						

						// school header
						echo "$array[$i]" . "\n";
						
						
						// columns
						$columns = 'Last Name' . "\t" . 'First Name' . "\t" . 'Project Title' . "\t";
						$columns .= 'Continuation' . "\t" . 'Years of Work' . "\t" . 'Category' . "\t";
						$columns .= 'Age' . "\t" . 'Gender' . "\t" . 'City' . "\t";
						$columns .= 'State' . "\t" . 'Zip' . "\t" . 'Adult Sponsor' . "\t";
						$columns .= 'Wheelchair Access' . "\t" . 'Class' . "\t" . 'Grade' . "\t";
						$columns .= 'School' . "\t" . 'Key Teacher' . "\t" . 'School City' . "\t" . 'Type' . "\n";

						echo $columns;

						$partOfTeam = array();
						while ($row = $result->fetch_assoc()) {
							
							// data
							$data = $row['LName'] . "\t" . $row['FName'] . "\t" . $row['ProjTitle'] . "\t";
							$data .= $row['Continuation'] . "\t" . $row['Years of Work'] . "\t" . $row['Category'] . "\t";
							$data .= $row['Age'] . "\t" . $row['Gender'] . "\t" . $row['RCity'] . "\t";
							$data .= $row['State'] . "\t" . $row['Zip'] . "\t" . $row['AdultSponsor'] . "\t";
							$data .= $row['WheelchairAccess'] . "\t" . $row['Class'] . "\t" . $row['Grade'] . "\t";
							$data .= $row['SName'] . "\t" . $row['KeyTeacher'] . "\t" . $row['SCity'] . "\t" . $row['Type'] . "\n";	
								
							echo $data;	 
							
							
						}


						echo "\n";	
						echo "\n";
						echo "\n";
						
					}


					
				}

				

			}
			

		} else {
			$_SESSION["message"] = "Unable to view Students";
   			header("Location: FairHome.php?id=".$ID);
   			exit;
		}











	} else {
		$_SESSION["message"] = "Error! Variables not set";
        header("Location: SFindex.php");
        exit;
	}



?>