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

		$query = "Select distinct Description from Registration inner join Category on FKCategoryID = CategoryID inner join Fair on FKFairID = FairID where FKFairID = ".$ID." order by Description";
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

						
						$query = "Select AVG(Score1) as `Average1`, AVG(Score2) as `Average2`, STDDEV(Score1) as `SD1`, STDDEV(Score2) as `SD2` ";
						$query .= "from Registration ";
						$query .= "inner join Fair on FKFairID = FairID ";
						$query .= "inner join School on FKSchoolID = SchoolID ";
						$query .= "inner join Category on FKCategoryID = CategoryID ";
						$query .= "inner join Class on FKClassID = ClassID ";
						$query .= "where FKFairID = ".$ID." and Description = '".$catArray[$i]."' and Class = ".$classArray[$j];


						$result = $mysqli->query($query);
						if ($result) {
							$row = $result->fetch_assoc();
							$Average1 = $row['Average1'];
							$Average2 = $row['Average2'];
							$SD1 = $row['SD1'];
							$SD2 = $row['SD2'];


							$query = "Select RegistrationID, Score1, Score2 ";
							$query .= "from Registration ";
							$query .= "inner join Fair on FKFairID = FairID ";
							$query .= "inner join School on FKSchoolID = SchoolID ";
							$query .= "inner join Category on FKCategoryID = CategoryID ";
							$query .= "inner join Class on FKClassID = ClassID ";
							$query .= "where FKFairID = ".$ID." and Description = '".$catArray[$i]."' and Class = ".$classArray[$j];
							

							$result = $mysqli->query($query);
							$score1Array = array();
							$score2Array = array();
							$ridArray = array();
							if ($result && $result->num_rows > 0) {
								while ($row = $result->fetch_assoc()) {
									array_push($score1Array, $row['Score1']);
									array_push($score2Array, $row['Score2']);
									array_push($ridArray, $row['RegistrationID']);
								}

								for ($k = 0; $k < count($ridArray); $k++) {

									
										
									$ZScore1 = (($score1Array[$k] - $Average1) / $SD1);
									$ZScore2 = (($score2Array[$k] - $Average2) / $SD2);

									if (($ZScore1 === NULL || $ZScore1 === "" || $ZScore1 == 0) && ($ZScore2 === NULL || $ZScore2 === "" || $ZScore2 == 0)) {

										$ZScore1 = 0.0;
										$ZScore2 = 0.0;

										$AverageZ = (($ZScore1 + $ZScore2) / 2.0);

										$query = "Update Registration set ";
										$query .= "ZScore1 = ".$ZScore1.",";
										$query .= "ZScore2 = ".$ZScore2.",";
										$query .= "AverageZ = ".$AverageZ." ";
										$query .= "where RegistrationID = ".$ridArray[$k];

										$result = $mysqli->query($query);
										if (!$result) {
											$_SESSION["message"] = "Error! ".mysqli_errno($mysqli)." - ".mysqli_error($mysqli);
						           			header("Location: FairHome.php?id=".$ID);
						           			exit;
										}
										
									} elseif ($ZScore1 === NULL || $ZScore1 === '' || $ZScore1 == 0) {
										$ZScore1 = 0.0;

										$AverageZ = (($ZScore1 + $ZScore2) / 2.0);

										$query = "Update Registration set ";
										$query .= "ZScore1 = ".$ZScore1.",";
										$query .= "ZScore2 = ".$ZScore2.",";
										$query .= "AverageZ = ".$AverageZ." ";
										$query .= "where RegistrationID = ".$ridArray[$k];

										$result = $mysqli->query($query);
										if (!$result) {
											$_SESSION["message"] = "Error! ".mysqli_errno($mysqli)." - ".mysqli_error($mysqli);
						           			header("Location: FairHome.php?id=".$ID);
						           			exit;
										}

									} elseif ($ZScore2 === NULL || $ZScore2 === "" || $ZScore2 == 0) {
										$ZScore2 = 0.0;

										$AverageZ = (($ZScore1 + $ZScore2) / 2.0);

										$query = "Update Registration set ";
										$query .= "ZScore1 = ".$ZScore1.",";
										$query .= "ZScore2 = ".$ZScore2.",";
										$query .= "AverageZ = ".$AverageZ." ";
										$query .= "where RegistrationID = ".$ridArray[$k];	

										$result = $mysqli->query($query);
										if (!$result) {
											$_SESSION["message"] = "Error! ".mysqli_errno($mysqli)." - ".mysqli_error($mysqli);
						           			header("Location: FairHome.php?id=".$ID);
						           			exit;
										}

									} else {
										$AverageZ = (($ZScore1 + $ZScore2) / 2.0);

										$query = "Update Registration set ";
										$query .= "ZScore1 = ".$ZScore1.",";
										$query .= "ZScore2 = ".$ZScore2.",";
										$query .= "AverageZ = ".$AverageZ." ";
										$query .= "where RegistrationID = ".$ridArray[$k];

										$result = $mysqli->query($query);
										if (!$result) {
											$_SESSION["message"] = "Error! ".mysqli_errno($mysqli)." - ".mysqli_error($mysqli);
						           			header("Location: FairHome.php?id=".$ID);
						           			exit;
										}

									}

										

										
									
									
									

								}


								$query = "Select RegistrationID, AverageZ ";
								$query .= "from Registration ";
								$query .= "inner join Fair on FKFairID = FairID ";
								$query .= "inner join School on FKSchoolID = SchoolID ";
								$query .= "inner join Category on FKCategoryID = CategoryID ";
								$query .= "inner join Class on FKClassID = ClassID ";
								$query .= "where FKFairID = ".$ID." and Description = '".$catArray[$i]."' and Class = ".$classArray[$j];
								$query .= " order by AverageZ DESC";


								$result = $mysqli->query($query);
								$AZ = array();
								$ridArray2 = array();
								if ($result) {
									while ($row = $result->fetch_assoc()) {
										array_push($AZ, $row['AverageZ']);
										array_push($ridArray2, $row['RegistrationID']);
									}



									$rank = 0;
									$tempScore = 10000000;
									
									for ($k = 0; $k < count($ridArray2); $k++) {
										
										if ($AZ[$k] < $tempScore) {

											$rank++;
											$queryRank = "Update Registration set Rank = ".$rank." where RegistrationID = ".$ridArray2[$k];
											$rankResult = $mysqli->query($queryRank);
											if (!$rankResult) {
												$_SESSION["message"] = "Error! Unable to Rank.";
							           			header("Location: FairHome.php?id=".$ID);
							           			exit;
											}
											$tempScore = $AZ[$k];

										} elseif ($AZ[$k] === $tempScore) {

											$queryRank = "Update Registration set Rank = ".$rank." where RegistrationID = ".$ridArray2[$k];
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



								
								
							} else {
								$_SESSION["message"] = "Error! Unable to view Scores";
			           			header("Location: FairHome.php?id=".$ID);
			           			exit;
							}



						} else {
							$_SESSION["message"] = "Error! Unable to view Scores";
		           			header("Location: FairHome.php?id=".$ID);
		           			exit;
						}




						
					}
					

					
				} else {
					$_SESSION["message"] = "Error! Unable to view Classes".mysqli_error($mysqli);;
		   			header("Location: FairHome.php?id=".$ID);
		   			exit;
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