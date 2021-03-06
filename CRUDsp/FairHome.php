<?php 
	require_once("session.php");
?>

<DOCTYPE! html>
<html lang="en">

<?php 
	verifyLogIn();
	require_once("included_functions.php");
	$mysqli = db_connection();
	if (($output = message()) !== null) {
		echo $output;
	}
	if (isset($_GET['id']) && $_GET['id'] != "") {
		$ID = $_GET['id'];
		$query = "Select * from Fair where FairID = ".$ID;

		$result = $mysqli->query($query);
		if ($result && $result->num_rows > 0) {
			$row = $result->fetch_assoc();
			new_header($row['FairName']." ".$row['Year'], $ID);
			$fair_name = $row['FairName'];
			$fair_year = $row['Year'];
		}
	} 
 ?>

 <body>

 	<div class='container'>
 		<br>
 		<div class='row justify-content-center'>
 			<div class='col-xs-12 col-sm-12 col-md-9 col-lg-8'>
 				<div class='card text-center'>
 					<div class='card-body'>
 						<h3 class='card-title'>Projects</h3>
 						<p class='card-text'>View Projects by Student, School, Category, or Class</p>

 						<?php
 						echo "<a href='readProjectsName.php?id=".$ID."' class='btn btn-primary'>By Name</a>";
 						echo " ";
 						echo "<a href='readProjectsSchool.php?id=".urlencode($ID)."' class='btn btn-primary'>By School</a>";
 						echo " ";
 						echo "<a href='readProjectsCategory.php?id=".urlencode($ID)."' class='btn btn-primary'>By Category</a>";
 						echo " ";
 						echo "<a href='readProjectsClass.php?id=".urlencode($ID)."' class='btn btn-primary'>By Class</a>";
 						?>

 						
						<?php 
						echo "<p class='card-text'></p>";
 						echo "<p class='card-text'>Add Project into ".$fair_name." ".$fair_year." </p>";
 						echo "<a href='addStudent.php?id=".urlencode($ID)."' class='btn btn-primary'>Add Project</a>";
 						?>

 					</div>
 				</div>
 			</div>
 		</div>
 		<br />
 		<div class='row justify-content-center'>
 			<div class='col-xs-12 col-sm-12 col-md-9 col-lg-8'>
 				<div class='card text-center'>
 					<div class='card-body'>
 						<h3 class='card-title'>Judges</h3>
 						<p class='card-text'>View Judges by Name or Category</p>
 						<?php 
 						echo "<a href='readJudges.php?id=".urlencode($ID)."&type=1' class='btn btn-primary'>By Name</a>";
 						echo " ";
 						echo "<a href='readJudges.php?id=".urlencode($ID)."&type=2' class='btn btn-primary'>By Category</a>";

 						echo "<p class='card-text'></p>";
 						echo "<p class='card-text'>Add Judge into ".$fair_name." ".$fair_year." </p>";
 						echo "<a href='addJudge.php?id=".urlencode($ID)."' class='btn btn-primary'>Add Judge</a>";
 						echo "<p class='card-text'></p>";
 						echo "<p class='card-text'>View Sets by Category</p>";
 						echo "<a href='readCategorySets.php?id=".urlencode($ID)."' class='btn btn-primary'>View Sets</a>";
 						?>
 					</div>
 				</div>
 			</div>
 		</div>
 		<br />
 		<!-- Need to edit to fit with judges -->
 		
 		<div class='row justify-content-center'>
 			<div class='col-xs-12 col-sm-12 col-md-9 col-lg-8'>
 				<div class='card text-center'>
 					<div class='card-body'>
 						<h3 class='card-title'>Scores</h3>
 						<p class='card-text'>View Scores by Category or Class</p>
 						<?php 
 						echo "<a href='readScores.php?id=".$ID."&type=1' class='btn btn-primary'>By Category</a>";
 						echo " ";
 						echo "<a href='readScores.php?id=".$ID."&type=2' class='btn btn-primary'>By Class</a>";

 						echo "<p class='card-text'></p>";
 						echo "<p class='card-text'>Add and Edit scores on Score Cards</p>";
 						echo "<a href='readScoreCards.php?id=".$ID."' class='btn btn-primary'>View Score Cards</a>";
 						echo "<p class='card-text'></p>";
 						?>
 					</div>
 				</div>
 			</div>
 		</div>
 		<br />
 		<div class='row justify-content-center'>
 			<div class='col-xs-12 col-sm-12 col-md-9 col-lg-8'>
 				<div class='card text-center'>
 					<div class='card-body'>
 						<h3 class='card-title'>Other</h3>
 						<?php
 						echo "<a href='readSchools.php?id=".$ID."' class='btn btn-primary'>View Schools</a>";
 						echo " ";
 						echo "<a href='readCategories.php?id=".$ID."' class='btn btn-primary'>View Categories</a>";
 						?>
 					</div>
 				</div>
 			</div>
 		</div>
 		
 	</div>	
 	<br /><br /><br />
 </body>

 </html>