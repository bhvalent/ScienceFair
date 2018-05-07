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
	if ((isset($_GET['id']) && $_GET['id'] != "") && (($_GET['sid']) && $_GET['sid'] != "") && (isset($_GET['del']) && $_GET['del'] != "")) {
		$ID = $_GET['id'];
		
		if ($_GET['del'] === "1") {

			$query = "select TeamMemberID from TeamMembers where FKRegistrationID = ".$_GET['sid'];
			$result = $mysqli->query($query);
			if ($result && $result->num_rows > 0) {
				while ($row = $result->fetch_assoc()) {
					$query = "Delete from TeamMembers where TeamMemberID = ".$row['TeamMemberID'];
					$result2 = $mysqli->query($query);
					if (!$result2) {
						$_SESSION["message"] = "Student could not be deleted";
						header("Location: FairHome.php?id=".$ID);
						exit;
					}
				}
			} 

			$query = "Delete from Registration where RegistrationID = ".$_GET['sid'];
			$result = $mysqli->query($query);
			if ($result && $mysqli->affected_rows === 1) {
				$_SESSION["message"] = "Student was successfully deleted";
				header("Location: FairHome.php?id=".$ID);
				exit;
			} else {
				$num = $mysqli->affected_rows;
				$_SESSION["message"] = $num." rows were deleted.";
				header("Location: FairHome.php?id=".$ID);
				exit;
			}

		} else {
			$_SESSION["message"] = "Student was not deleted";
			header("Location: FairHome.php?id=".$ID);
			exit;
		}





	} elseif ((isset($_GET['id']) && $_GET['id'] != "") && (($_GET['sid']) && $_GET['sid'] != "")) {
		$ID = $_GET['id'];
		$query = "Select * from Fair where FairID = ".$ID;

		$result = $mysqli->query($query);
		if ($result && $result->num_rows > 0) {
			$row = $result->fetch_assoc();
			new_header($row['FairName']." ".$row['Year'], $ID);
			$FairName = $row['FairName']." ".$row['Year'];

			$query = "select * from Registration where RegistrationID = ".$_GET['sid'];

			$result = $mysqli->query($query);
			if ($result && $result->num_rows > 0) {
				$row = $result->fetch_assoc();

				echo "<div class='container'>";
 				echo "<br /><br />";
 				echo "<div class='row justify-content-center'>";
 				echo "<div class='col-xs-12 col-sm-12 col-md-9 col-lg-6'>";
 				echo "<div class='card text-center'>";
 				echo "<div class='card-body'>";
 				echo "<h3 class='card-title'><b>WARNING</b></h3>";
 				echo "<p class='card-text'>Are you sure you want to delete ".$row['FName']." ".$row['LName']." from ".$FairName."?</p>";
 				echo "<br />";

 				$query = "Select * from TeamMembers where FKRegistrationID = ".$_GET['sid'];
 				$result1 = $mysqli->query($query);
 				if ($result1 && $result1->num_rows > 0) {
 					$rowCount = $result1->num_rows;
 					echo "<p class='card-text'>You will also delete ".$rowCount." Team Member(s) if you choose to.</p>";
 				}
 				echo "<br />";
 						
 				echo "<a href='deleteStudent.php?id=".urldecode($ID)."&sid=".$_GET['sid']."&del=1' class='btn btn-outline-danger btn-block'>Yes</a>";
 				echo "<br /><br />";
 				echo "<a href='deleteStudent.php?id=".urldecode($ID)."&sid=".$_GET['sid']."&del=0' class='btn btn-primary btn-block'>No</a>";
 				
 				
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