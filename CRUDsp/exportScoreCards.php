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
		header( "Content-disposition: attachment; filename=ScoreCards".$name.".xls" );











		$query = "Select distinct SetJudgeID, LName, FName, CategoryID, Description, SetNumber from JudgeRegistrant ";
		$query .= "inner join SetJudge on FKSetJudgeID = SetJudgeID ";
		$query .= "inner join Judge on FKJudgeID = JudgeID ";
		$query .= "inner join Category on FKCategoryID = CategoryID ";
		$query .= "inner join Fair on FKFairID = FairID ";
		$query .= "where FKFairID = ".$ID." order by LName";
		

		$result = $mysqli->query($query);
		if ($result && $result->num_rows > 0) {
			


			// header
			echo 'Score Cards' . "\n";
			echo "\n";

			
			
			
			

			$sj = array();
			$sn = array();

			while ($row = $result->fetch_assoc()) {

				array_push($sj, $row['SetJudgeID']);
				array_push($sn, $row['SetNumber']);

			}	





			for ($i = 0; $i < count($sj); $i++) {

				$query = "Select CategoryID, Description, Judge.FName as `fname`, Judge.LName as `lname`, SetNumber ";
				$query .= "from JudgeRegistrant ";
				$query .= "inner join SetJudge on FKSetJudgeID = SetJudgeID ";
				$query .= "inner join Judge on FKJudgeID = JudgeID ";
				$query .= "inner join Category on FKCategoryID = CategoryID ";
				$query .= "inner join Fair on FKFairID = FairID ";
				$query .= "where FKSetJudgeID = ".$sj[$i]." ";
				$query .= "and SetNumber = ".$sn[$i]." ";
				$query .= "and SetJudge.FKFairID = ".$ID;
				

				$result = $mysqli->query($query);
				if ($result && $result->num_rows > 0) {
					
					$row = $result->fetch_assoc();
					

					// judge columns
					echo 'Last Name' . "\t" . 'First Name' . "\t" . 'Category' . "\t" . 'Description' . "\t" . 'Set Number' . "\n";

					// judge data
					$data = $row['lname'] . "\t" . $row['fname'] . "\t" . $row['CategoryID'] . "\t";
					$data .= $row['Description'] . "\t" . $row['SetNumber'] . "\n";

					echo $data;


	    			
					// added here ////////////
	    			$query = "Select distinct TeamMembers.FKRegistrationID from TeamMembers ";
	    			$query .= "inner join Registration on TeamMembers.FKRegistrationID = RegistrationID ";
	    			$query .= "inner join JudgeRegistrant on JudgeRegistrant.FKRegistrationID = RegistrationID ";
	    			$query .= "inner join SetJudge on FKSetJudgeID = SetJudgeID ";
	    			$query .= "where FKSetJudgeID = ".$sj[$i]." and SetNumber = ".$sn[$i];

	    			$onTeam = array();
	    			$tMems = array();
	    			$result = $mysqli->query($query);
	    			if ($result && $result->num_rows > 0) {
	    				while ($row = $result->fetch_assoc()) {
	    					array_push($onTeam, $row['FKRegistrationID']);
	    				}

	    				for ($j = 0; $j < count($onTeam); $j++) {
	    					$query1 = "select concat(FName, ' ', LName) as `Name` ";
	    					$query1 .= "from TeamMembers where FKRegistrationID = ".$onTeam[$j];

	    					$result = $mysqli->query($query1);
	    					if ($result && $result->num_rows > 0) {
	    						while ($row = $result->fetch_assoc()) {
	    							if (count($tMems) <= $j) {
	    								array_push($tMems, $row['Name']);
	    							} else {
	    								$tMems[$j] .= ", ".$row['Name']; 
	    							}
	    						}
	    					}
	    				}


	    			}
	    			///////////////////////

					$query2 = "Select Class, RegistrationID, CONCAT(Registration.FName, ' ', Registration.LName) as `StudentName`, ProjTitle, Score1, Score2, Total ";
					$query2 .= "from JudgeRegistrant ";
					$query2 .= "inner join Registration on FKRegistrationID = RegistrationID ";
					$query2 .= "inner join Class on FKClassID = ClassID ";
					$query2 .= "where FKSetJudgeID = ".$sj[$i]." ";
					$query2 .= "and SetNumber = ".$sn[$i];

					$result2 = $mysqli->query($query2);
					if ($result2 && $result2->num_rows > 0) {
						

						echo "\n";
						// columns for score card
						$col = 'Class' . "\t" . 'Project Number' . "\t" . 'Name' . "\t" . 'Project Title' . "\t";
						$col .= 'Score 1' . "\t" . 'Score 2' . "\t" . 'Total' . "\n";

						echo $col;


						
						while ($row2 = $result2->fetch_assoc()) {

							if ( !(in_array($row2['RegistrationID'], $onTeam)) ) {


								// data 
								$data = $row2['Class'] . "\t" . $row2['RegistrationID'] . "\t";
								$data .= $row2['StudentName'] . "\t";
								$data .= $row2['ProjTitle'] . "\t";
								$data .= $row2['Score1'] . "\t" . $row2['Score2'] . "\t" . $row2['Total'] . "\n";

								echo $data;
								
								

							} else {


								$data = $row2['Class'] . "\t" . $row2['RegistrationID'] . "\t";
								$data .= $row2['StudentName'] . ", " . $tMems[array_search($row2['RegistrationID'], $onTeam)] . "\t";
								$data .= $row2['ProjTitle'] . "\t";
								$data .= $row2['Score1'] . "\t" . $row2['Score2'] . "\t" . $row2['Total'] . "\n";

								echo $data;
								
							}
							
						}	

						echo "\n";	
						echo "\n";
						echo "\n";
						

						
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

			}








			










			

	
			
		} else {
			$_SESSION["message"] = "Unable to view Score Cards";
   			header("Location: FairHome.php?id=".$ID);
   			exit;
		}






	} else {
		$_SESSION["message"] = "Error! Variables not set";
        header("Location: SFindex.php");
        exit;
	}



?>