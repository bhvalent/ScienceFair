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
	//isset($_GET['id']) && $_GET['id'] !== "" 
	
	if (isset($_GET['id']) && $_GET['id'] !== "") {
		
		$ID = $_GET['id'];

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

					for ($j = 0; $j < count($classArray); $j++) {

						//$query = "Select RegistrationID, concat(LName, ', ', FName) as `Name`, ProjTitle, Continuation, ";
						//$query .= "NumYears, Age, Gender, AdultSponsor, Grade, SName, Score1, Score2, Total, Rank ";
						$query = "Select RegistrationID, Total ";
						$query .= "from Registration ";
						$query .= "inner join Fair on FKFairID = FairID ";
						$query .= "inner join School on FKSchoolID = SchoolID ";
						$query .= "inner join Category on FKCategoryID = CategoryID ";
						$query .= "inner join Class on FKClassID = ClassID ";
						$query .= "where FKFairID = ".$ID." and Description = '".$catArray[$i]."' and Class = ".$classArray[$j]." ";
						$query .= "order by Total DESC, Rank ASC";

						$result = $mysqli->query($query);
						$totalArray = array();
						$ridArray = array();
						if ($result && $result->num_rows > 0) {
							while ($row = $result->fetch_assoc()) {
								array_push($totalArray, $row['Total']);
								array_push($ridArray, $row['RegistrationID']);
							}

							$rank = 0;
							$tempScore = 10000000;
							
							for ($k = 0; $k < count($totalArray); $k++) {
								
								if ($totalArray[$k] < $tempScore) {

									$rank++;
									$queryRank = "Update Registration set Rank = ".$rank." where RegistrationID = ".$ridArray[$k];
									$rankResult = $mysqli->query($queryRank);
									if (!$rankResult) {
										$_SESSION["message"] = "Error! Unable to Rank.".$k.$ridArray[$k];
					           			header("Location: FairHome.php?id=".$ID);
					           			exit;
									}
									$tempScore = $totalArray[$k];

								} elseif ($totalArray[$k] === $tempScore) {

									$queryRank = "Update Registration set Rank = ".$rank." where RegistrationID = ".$ridArray[$k];
									$rankResult = $mysqli->query($queryRank);
									if (!$rankResult) {
										$_SESSION["message"] = "Error! Unable to Rank";
					           			header("Location: FairHome.php?id=".$ID);
					           			exit;
									}

								} else {
									$_SESSION["message"] = "Error! Scores out of order or Invalid Score";
				           			header("Location: FairHome.php?id=".$ID);
				           			exit;
								}

							}
							
						} else {
							$_SESSION["message"] = "Error! Unable to view Scores";
		           			header("Location: FairHome.php?id=".$ID);
		           			exit;
						}
					}
					

					
				} 

			}
			$_SESSION["message"] = "Scores Ranked";
   			header("Location: readScores.php?id=".$ID."&type=1");
   			exit;
			

		} else {
			$_SESSION["message"] = "Error! Unable to view Categories";
   			header("Location: FairHome.php?id=".$ID);
   			exit;
		}

		

	} else {
		$_SESSION["message"] = "Error! Variables not set".$_GET['id'];
        header("Location: SFindex.php");
        exit;
	}

 ?>

</html>