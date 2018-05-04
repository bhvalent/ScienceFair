<?php
	
	require_once("included_functions.php");
	require_once("session.php");
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
		header( "Content-disposition: attachment; filename=projectsByName".$name.".xls" );

		$query = "Select distinct FKRegistrationID from TeamMembers";
		$result = $mysqli->query($query);
		$tmArray = array();
		if ($result && $result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				array_push($tmArray, $row['FKRegistrationID']);
			}
			$query = "Select RegistrationID, LName, FName, ProjTitle, Continuation, NumYears as `Years of Work`, Category.Description as `Category`, Age, Gender, Registration.City as `RCity`, State, Zip, AdultSponsor, WheelchairAccess, Class, Grade, SName, KeyTeacher, School.City as `SCity`, Type from ";
			$query .= "Fair inner join Registration on FairID = FKFairID ";
			$query .= "inner join Class on FKClassID = ClassID ";
			$query .= "inner join School on FKSchoolID = SchoolID ";
			$query .= "inner join Category on FKCategoryID = CategoryID ";
			$query .= "where FairID = ".$ID;
			$query .= " order by LName";

			$result = $mysqli->query($query);
			if ($result && $result->num_rows > 0) {
				
				// columns
				$columns = 'Last Name' . "\t" . 'First Name' . "\t" . 'Project Title' . "\t";
				$columns .= 'Continuation' . "\t" . 'Years of Work' . "\t" . 'Category' . "\t";
				$columns .= 'Age' . "\t" . 'Gender' . "\t" . 'City' . "\t";
				$columns .= 'State' . "\t" . 'Zip' . "\t" . 'Adult Sponsor' . "\t";
				$columns .= 'Wheelchair Access' . "\t" . 'Class' . "\t" . 'Grade' . "\t";
				$columns .= 'School' . "\t" . 'Key Teacher' . "\t" . 'School City' . "\t" . 'Type' . "\n";

				echo $columns;
				

				
				while ($row = $result->fetch_assoc()) {

					
					if (!(in_array($row['RegistrationID'], $tmArray))) {
						
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
				

				for ($i = 0; $i < count($tmArray); $i++) {
					$query = "Select RegistrationID, LName, FName, ProjTitle, Continuation, NumYears as `Years of Work`, Category.Description as `Category`, Age, Gender, Registration.City as `RCity`, State, Zip, AdultSponsor, WheelchairAccess, Class, Grade, SName, KeyTeacher, School.City as `SCity`, Type from ";
					$query .= "Fair inner join Registration on FairID = FKFairID ";
					$query .= "inner join Class on FKClassID = ClassID ";
					$query .= "inner join School on FKSchoolID = SchoolID ";
					$query .= "inner join Category on FKCategoryID = CategoryID ";
					$query .= "where FairID = ".$ID." and RegistrationID = ".$tmArray[$i];
					$query .= " order by LName";

					$result = $mysqli->query($query);
					if ($result && $result->num_rows > 0) {

						// line to separate individual from teams
						echo "\n";


						
						$columns = 'Last Name' . "\t" . 'First Name' . "\t" . 'Project Title' . "\t";
						$columns .= 'Continuation' . "\t" . 'Years of Work' . "\t" . 'Category' . "\t";
						$columns .= 'Age' . "\t" . 'Gender' . "\t" . 'City' . "\t";
						$columns .= 'State' . "\t" . 'Zip' . "\t" . 'Adult Sponsor' . "\t";
						$columns .= 'Wheelchair Access' . "\t" . 'Class' . "\t" . 'Grade' . "\t";
						$columns .= 'School' . "\t" . 'Key Teacher' . "\t" . 'School City' . "\t" . 'Type' . "\n";

						echo $columns;

						while ($row = $result->fetch_assoc()) {
							
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


						$query = "Select TeamMemberID, LName, FName, Continuation, NumYears as `Years of Work`, ";
						$query .= "Age, Gender, City, State, Zip, WheelchairAccess, Grade ";
						$query .= "from TeamMembers ";
						$query .= "inner join Class on FKClassID = ClassID ";
						$query .= "where FKRegistrationID = ".$tmArray[$i];

						$result = $mysqli->query($query);
						if ($result){
							while ($row = $result->fetch_assoc()) {
								

								// data
								$data = $row['LName'] . "\t" . $row['FName'] . "\t" . $ProjTitle . "\t";
								$data .= $row['Continuation'] . "\t" . $row['Years of Work'] . "\t" . $Cate . "\t";
								$data .= $row['Age'] . "\t" . $row['Gender'] . "\t" . $row['RCity'] . "\t";
								$data .= $row['State'] . "\t" . $row['Zip'] . "\t" . $AS . "\t";
								$data .= $row['WheelchairAccess'] . "\t" . $Class . "\t" . $row['Grade'] . "\t";
								$data .= $School . "\t" . $KeyTeacher . "\t" . $SCity . "\t" . $Type . "\n";	
									
								echo $data;	 

								 
							}
							

						} else {
							$_SESSION["message"] = "Unable to view Team Members";
		           			header("Location: FairHome.php?id=".$ID);
		           			exit;
						}

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
			$query .= "where FairID = ".$ID;
			$query .= " order by LName";

			$result = $mysqli->query($query);
			if ($result && $result->num_rows > 0) {
				
				// put columns
				// echo 'Last Name' . "\t" . 'First Name' . "\t" . 'Project Title' . "\t" . 'Continuation' . "\t" . 'Years of Work' . "\t" . 'Category' . "\t" . 'Age' . "\t" . 'Gender' . "\t" . 'City' . "\t" . 'State' . "\t" . 'Zip' . "\t" . 'Adult Sponsor' . "\t" . 'Wheelchair Access' . "\t" . 'Class' . "\t" . 'Grade' . "\t" . 'School' . "\t" . 'Key Teacher' . "\t" . 'School City' . "\t" . 'Type' . "\n";

				$columns = 'Last Name' . "\t" . 'First Name' . "\t" . 'Project Title' . "\t";
				$columns .= 'Continuation' . "\t" . 'Years of Work' . "\t" . 'Category' . "\t";
				$columns .= 'Age' . "\t" . 'Gender' . "\t" . 'City' . "\t";
				$columns .= 'State' . "\t" . 'Zip' . "\t" . 'Adult Sponsor' . "\t";
				$columns .= 'Wheelchair Access' . "\t" . 'Class' . "\t" . 'Grade' . "\t";
				$columns .= 'School' . "\t" . 'Key Teacher' . "\t" . 'School City' . "\t" . 'Type' . "\n";

				echo $columns;


				
				while ($row = $result->fetch_assoc()) {

					// echo $row['LName'] . "\t" . $row['FName'] . "\t" . $row['ProjTitle'] . "\t" . $row['Continuation'] . "\t" . $row['Years of Work'] . "\t" . $row['Category'] . "\t" . $row['Age'] . "\t" . $row['Gender'] . "\t" . $row['RCity'] . "\t" . $row['State'] . "\t" . $row['Zip'] . "\t" . $row['AdultSponsor'] . "\t" . $row['WheelchairAccess'] . "\t" . $row['Class'] . "\t" . $row['Grade'] . "\t" . $row['SName'] . "\t" . $row['KeyTeacher'] . "\t" . $row['SCity'] . "\t" . $row['Type'] . "\n";
					
				
					$data = $row['LName'] . "\t" . $row['FName'] . "\t" . $row['ProjTitle'] . "\t";
					$data .= $row['Continuation'] . "\t" . $row['Years of Work'] . "\t" . $row['Category'] . "\t";
					$data .= $row['Age'] . "\t" . $row['Gender'] . "\t" . $row['RCity'] . "\t";
					$data .= $row['State'] . "\t" . $row['Zip'] . "\t" . $row['AdultSponsor'] . "\t";
					$data .= $row['WheelchairAccess'] . "\t" . $row['Class'] . "\t" . $row['Grade'] . "\t";
					$data .= $row['SName'] . "\t" . $row['KeyTeacher'] . "\t" . $row['SCity'] . "\t" . $row['Type'] . "\n";	
						
					echo $data;	 
					
					
					
				}		
				
			}
		
			
		}



	} else {
		$_SESSION["message"] = "Error! Variables not set";
        header("Location: SFindex.php");
        exit;
	}



?>