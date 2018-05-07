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
	if ((isset($_GET['id']) && $_GET['id'] != "") && (($_GET['rid']) && $_GET['rid'] != "")) {
		$ID = $_GET['id'];
		$query = "Select * from Fair where FairID = ".$ID;

		$result = $mysqli->query($query);
		if ($result && $result->num_rows > 0) {
			$row = $result->fetch_assoc();
			new_header($row['FairName']." ".$row['Year'], $ID);
			$FairName = $row['FairName']." ".$row['Year'];

			$query = "select * from Registration where RegistrationID = ".$_GET['rid'];

			$result = $mysqli->query($query);
			if ($result && $result->num_rows > 0) {
				$row = $result->fetch_assoc();

				echo "<div class='container'>";
 				echo "<br /><br />";
 				echo "<div class='row justify-content-center'>";
 				echo "<div class='col-xs-12 col-sm-12 col-md-9 col-lg-6'>";
 				echo "<div class='card text-center'>";
 				echo "<div class='card-body'>";
 				//echo "<h3 class='card-title'><b>WARNING</b></h3>";
 				echo "<p class='card-text'><b>Do you want to add a Team Member to ".$row['ProjTitle']."?</b></p>";

 						
 				echo "<a href='addTeamMember.php?id=".urldecode($ID)."&rid=".$_GET['rid']."' class='btn btn-outline-success btn-block'>Yes</a>";
 				echo "<br /><br />";
 				echo "<a href='FairHome.php?id=".urldecode($ID)."' class='btn btn-primary btn-block'>No</a>";
 				
 				
 				echo "</div>";
 				echo "</div>";
 				echo "</div>";
 				echo "</div>";
 				echo "</div>";

			} else {
				$_SESSION["message"] = "Error! Student cannot be found.";
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