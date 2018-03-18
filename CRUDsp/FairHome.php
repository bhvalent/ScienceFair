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
	if (isset($_GET['id']) && $_GET['id'] != "") {
		$ID = $_GET['id'];
		$query = "Select * from Fair where FairID = ".$ID;

		$result = $mysqli->query($query);
		if ($result && $result->num_rows > 0) {
			$row = $result->fetch_assoc();
			new_header($row['FairName']." ".$row['Year']);
		}
	} 
 ?>

 <body>

 	<div class='container'>
 		<br>
 		<div class='row justify-content-center'>
 			<div class='col-6'>
 				<div class='card text-center'>
 					<div class='card-body'>
 						<h3 class='card-title'>Students</h3>
 						<p class='card-text'>View Students by Name, School, Category, or Class</p>

 						<?php
 						echo "<a href='readStudents.php?id=".urldecode($ID)."&type=1' class='btn btn-primary'>By Name</a>";
 						echo " ";
 						echo "<a href='readStudents.php?id=".urldecode($ID)."&type=2' class='btn btn-primary'>By School</a>";
 						echo " ";
 						echo "<a href='readStudents.php?id=".urldecode($ID)."&type=3' class='btn btn-primary'>By Category</a>";
 						echo " ";
 						echo "<a href='readStudents.php?id=".urldecode($ID)."&type=4' class='btn btn-primary'>By Class</a>";
 						?>

 					</div>
 				</div>
 			</div>
 		</div>
 		<br>
 		<!-- Need to edit to fit with judges -->
 		<div class='row justify-content-center'>
 			<div class='col-6'>
 				<div class='card text-center'>
 					<div class='card-body'>
 						<h3 class='card-title'>Judges</h3>
 						<p class='card-text'>View Judges by Name, School, or Category</p>
 						<a href='#' class='btn btn-primary'>By Name</a>
 						<a href='#' class='btn btn-primary'>By Category</a>
 					</div>
 				</div>
 			</div>
 		</div>
 	</div>
 </body>

 </html>