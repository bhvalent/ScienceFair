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
		header( "Content-disposition: attachment; filename=ScoresByCategory".$name.".xls" );
















		$query = "Select Description from Category order by Description";
		$result = $mysqli->query($query);
		$catArray = array();
		if ($result && $result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				array_push($catArray, $row['Description']);
			}

			
			
			
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


					// category header
					echo $catArray[$i] . "\n";

					for ($j = 0; $j < count($classArray); $j++) {


						$query = "Select distinct TeamMembers.FKRegistrationID from TeamMembers ";
		    			$query .= "inner join Registration on TeamMembers.FKRegistrationID = RegistrationID ";
		    			$query .= "inner join Class on TeamMembers.FKClassID = ClassID ";
		    			$query .= "inner join Category on FKCategoryID = CategoryID ";
		    			$query .= "where Description = '".$catArray[$i]."' and Class = ".$classArray[$j];

		    			$onTeam = array();
		    			$tMems = array();
		    			$result = $mysqli->query($query);
		    			if ($result && $result->num_rows > 0) {
		    				while ($row = $result->fetch_assoc()) {
		    					array_push($onTeam, $row['FKRegistrationID']);
		    				}

		    				for ($k = 0; $k < count($onTeam); $k++) {
		    					$query1 = "select concat(FName, ' ', LName) as `Name` ";
		    					$query1 .= "from TeamMembers where FKRegistrationID = ".$onTeam[$k];

		    					$result = $mysqli->query($query1);
		    					if ($result && $result->num_rows > 0) {
		    						while ($row = $result->fetch_assoc()) {
		    							if (count($tMems) <= $k) {
		    								array_push($tMems, $row['Name']);
		    							} else {
		    								$tMems[$k] .= ", ".$row['Name']; 
		    							}
		    						}
		    					}
		    				}


		    			}



						$query = "Select RegistrationID, concat(FName, ' ', LName) as `Name`, ProjTitle, Continuation, ";
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

							

							// class header
							echo "\n";
							echo 'Class: ' . $classArray[$j] . "\n";



							// columns 
							$columns = 'Rank' . "\t" . 'Project Number' . "\t" . 'Name' . "\t" . 'Project Title' . "\t";
							$columns .= 'Continuation' . "\t" . 'Years of Work' . "\t" . 'Age' . "\t" . 'Gender' . "\t";
							$columns .= 'Adult Sponsor' . "\t" . 'Grade' . "\t" . 'School' . "\t";
							$columns .= 'Score 1' . "\t" . 'Score 2' . "\t" . 'Total' . "\n";

							echo $columns;
							
							
							
							
							while ($row = $result->fetch_assoc()) {

								if ( !(in_array($row['RegistrationID'], $onTeam)) ) {
									

									// data
									$data = $row['Rank'] . "\t" . $row['RegistrationID'] . "\t" . $row['Name'] . "\t";
									$data .= $row['ProjTitle'] . "\t" . $row['Continuation'] . "\t" . $row['Years of Work'] . "\t";
									$data .= $row['Age'] . "\t" . $row['Gender'] . "\t" . $row['AdultSponsor'] . "\t" . $row['Grade'] . "\t";
									$data .= $row['SName'] . "\t" . $row['Score1'] . "\t" . $row['Score2'] . "\t" . $row['Total'] . "\n";

									echo $data;


									
								} else {



									// data
									$data = $row['Rank'] . "\t" . $row['RegistrationID'] . "\t";
									$data .= $row['Name'] . ", " . $tMems[array_search($row['RegistrationID'], $onTeam)] . "\t";
									$data .= $row['ProjTitle'] . "\t" . $row['Continuation'] . "\t" . $row['Years of Work'] . "\t";
									$data .= $row['Age'] . "\t" . $row['Gender'] . "\t" . $row['AdultSponsor'] . "\t" . $row['Grade'] . "\t";
									$data .= $row['SName'] . "\t" . $row['Score1'] . "\t" . $row['Score2'] . "\t" . $row['Total'] . "\n";

									echo $data;


								}
							}
							
						} else {
							$_SESSION["message"] = "Error! Unable to view Scores";
		           			header("Location: FairHome.php?id=".$ID);
		           			exit;
						}
					}
					
					echo "\n";
					echo "\n";
					echo "\n";

					
				} 

			}
			

		} else {
			$_SESSION["message"] = "Error! Unable to view Categories";
   			header("Location: FairHome.php?id=".$ID);
   			exit;
		}




















	} else {
		$_SESSION["message"] = "Error! Variables not set";
        header("Location: SFindex.php");
        exit;
	}



?>