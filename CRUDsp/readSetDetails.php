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
	if ((isset($_GET['id']) && $_GET['id'] != "") && (isset($_GET['snum']) && $_GET['snum'] != "") && (isset($_GET['cid']) && $_GET['cid'] != "")) {
		$ID = $_GET['id'];
		$CID = $_GET['cid'];
		$SNUM = $_GET['snum'];
		
		$query1 = "Select * from Fair where FairID = ".$ID;

		$result = $mysqli->query($query1);
		if ($result && $result->num_rows > 0) {
			$row = $result->fetch_assoc();
			new_header($row['FairName']." ".$row['Year'], $ID);

			
			

			$query = "Select distinct SetJudgeID, LName, FName, FKCategoryID, Description, SetNumber ";
			$query .= "from JudgeRegistrant ";
			$query .= "inner join SetJudge on FKSetJudgeID = SetJudgeID ";
			$query .= "inner join Judge on FKJudgeID = JudgeID ";
			$query .= "inner join Fair on FKFairID = FairID ";
			$query .= "inner join Category on FKCategoryID = CategoryID ";
			$query .= "where FairID = ".$ID." and FKCategoryID = ".$CID." and SetNumber = ".$SNUM;
			$query .= " order by LName";
			$result = $mysqli->query($query);
			$name = array();
			$des = array();
			$sjid = array();
			if ($result && $result->num_rows > 0) {
				while ($row = $result->fetch_assoc()) {
					array_push($name, $row['FName']." ".$row['LName']);
					array_push($des, $row['Description']);
					array_push($sjid, $row['SetJudgeID']);
				}
				//echo $name[0]." ".$sjid[0]." ".$des[0];
				echo "<div class='container-fluid'>";
				echo "<div class='row'>";
				for ($i = 0; $i < count($name); $i++) {


					$query = "Select Class, RegistrationID, LName, FName, ProjTitle ";
					$query .= "from JudgeRegistrant ";
					$query .= "inner join Registration on FKRegistrationID = RegistrationID ";
					$query .= "inner join Class on FKClassID = ClassID ";
					$query .= "inner join Fair on FKFairID = FairID ";
					$query .= "where FairID = ".$ID." and FKSetJudgeID = ".$sjid[$i];
					$query .= " order by LName";
					
					$result = $mysqli->query($query);

					echo "<br /><br />";

						
					// echo "<div class='row justify-content-center'>";
					// echo "<head>";
					// echo "<h3 class='d-none d-md-block'>".$name[$i]."</h3>";
					// echo "<h5 class='d-md-none'>".$name[$i]."</h5>";
					// echo "</head>";
					// echo "</div>";
					
					if ($result && $result->num_rows > 0) {

							
						

						//echo "<div class='row justify-content-center'>";
						echo "<div class='col-xs-12 col-sm-12 col-md-8 col-lg-6'>";

						echo "<head>";
						echo "<h3 class='text-center d-none d-md-block'>".$name[$i]."</h3>";
						echo "<h4 class='text-center d-none d-md-block'>Category: ".$CID."</h4>";
						echo "<h4 class='text-center d-none d-md-block'>Description: ".$des[$i]."</h4>";
						echo "<h4 class='text-center d-none d-md-block'>Judge Set Number: ".$SNUM."</h4>";
						echo "<h5 class='text-center d-md-none'>".$name[$i]."</h5>";
						echo "<h6 class='text-center d-md-none'>Category: ".$CID."</h6>";
						echo "<h6 class='text-center d-md-none'>Description: ".$des[$i]."</h6>";
						echo "<h6 class='text-center d-md-none'>Judge Set Number: ".$SNUM."</h6>";
						echo "</head>";

						echo "<div class='table-responsive'>";
						echo "<table class='table table-bordered table-hover'>";
						echo "<thead class='thead-dark text-center'>";
						echo "<tr>";
						echo "<th scope='col'>Class</th>";
						echo "<th scope='col'>Project Number</th>";
						echo "<th scope='col'>Name</th>";
						echo "<th scope='col'>Project Title</th>";
						echo "<th scope='col'></th>";
						echo "<th scope='col'></th>";
						echo "</tr>";
						echo "</thead>";
						echo "<tbody>";
						while ($row = $result->fetch_assoc()) {
							echo "<tr>";
							echo "<td class='text-center'>".$row['Class']."</td>";
							echo "<td class='text-center'>".$row['RegistrationID']."</td>";
							echo "<td class='text-center'>".$row['FName']." ".$row['LName']."</td>";
							echo "<td class='text-center'>".$row['ProjTitle']."</td>";
							echo "<td class='text-center'><a href='editSetInfo.php?id=".urlencode($ID)."&snum=".urlencode($row['SetNumber'])."&cid=".$CID."&sjid=".$sjid[$i]."' class='btn btn-outline-warning'>Edit</a></td>";
							echo "<td class='text-center'><a href='deleteSetInfo.php?id=".urlencode($ID)."&snum=".urlencode($row['SetNumber'])."&cid=".$CID."&sjid=".$sjid[$i]."' class='btn btn-outline-danger'>Delete</a></td>";
							echo "</tr>";
						}
						echo "</tbody>";
						echo "</table>";
						echo "</div>";
						echo "</div>";
						//echo "</div>";
					} else {
						echo "<head><h2>Could not get info</h2></head>";
					}	
					// echo "<div class='container'>";
					// echo "<br /><br />";
					
					// echo "<div class='row justify-content-center'>";
					// echo "<a href='addSets.php?id=".urlencode($ID)."&cid=".$array2[$i]."' class='btn btn-primary'>Add Category</a>";
					// echo "</div>";
					
					// echo "</div>";
					
					
					// echo "<br /><br />";
					// echo "<hr style='width: 100%; color: black; height: 1px; background-color:black;' />";
					// echo "<br /><br /><br /><br /><br />";
					// echo "<hr style='width: 100%; color: black; height: 1px; background-color:black;' />";
					
				}
				echo "</div>";
				echo "</div>";

			} else {
				$_SESSION["message"] = "Unable to view Set Info";
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