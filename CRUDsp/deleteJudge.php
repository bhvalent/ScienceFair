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
	if ((isset($_GET['id']) && $_GET['id'] != "") && (($_GET['sjid']) && $_GET['sjid'] != "") && (isset($_GET['del']) && $_GET['del'] != "")) {
		$ID = $_GET['id'];
		$SJID = $_GET['sjid'];
		if ($_GET['del'] === "1") {

			$query = "select FKJudgeID from SetJudge where SetJudgeID = ".$SJID;
			$result = $mysqli->query($query);
			if ($result && $result->num_rows > 0) {
				$row = $result->fetch_assoc();
				$JID = $row['FKJudgeID'];

				$query = "Delete from JudgeRegistrant where FKSetJudgeID = ".$SJID;
				$result = $mysqli->query($query);
				

				$query = "Delete from SetJudge where SetJudgeID = ".$SJID;
				$result = $mysqli->query($query);
				if ($mysqli->affected_rows < 1) {
					$_SESSION["message"] = "Judge was not deleted";
					header("Location: FairHome.php?id=".$ID);
					exit;
				}
				$query = "Select FKJudgeID from SetJudge";
				$result = $mysqli->query($query);
				$totalJ = array();
				if ($result && $result->num_rows > 0) {
					while ($row = $result->fetch_assoc()) {
						array_push($totalJ, $row['FKJudgeID']);
					}
					
						if (!(in_array($JID, $totalJ))) {
							$query = "Delete from Judge where JudgeID = ".$JID;
							$result = $mysqli->query($query);
							if ($mysqli->affected_rows < 1) {
								$_SESSION["message"] = "Fair was not deleted JudgeInfo";
								header("Location: SFindex.php");
								exit;
							} else {
								$_SESSION["message"] = "Judge was deleted!";
								header("Location: FairHome.php?id=".$ID);
								exit;
							}

						} else {
							$_SESSION["message"] = "Judge was deleted!";
							header("Location: FairHome.php?id=".$ID);
							exit;
						}
					
				
				}

			} else {
				$_SESSION["message"] = "Judge was not deleted";
				header("Location: FairHome.php?id=".$ID);
				exit;
			}

			



		} else {
			$_SESSION["message"] = "Judge was not deleted";
			header("Location: FairHome.php?id=".$ID);
			exit;
		}





	} elseif ((isset($_GET['id']) && $_GET['id'] != "") && (($_GET['sjid']) && $_GET['sjid'] != "")) {
		$ID = $_GET['id'];
		$SJID = $_GET['sjid'];
		$query = "Select * from Fair where FairID = ".$ID;

		$result = $mysqli->query($query);
		if ($result && $result->num_rows > 0) {
			$row = $result->fetch_assoc();
			new_header($row['FairName']." ".$row['Year'], $ID);
			$FairName = $row['FairName']." ".$row['Year'];

			$query = "select * from SetJudge inner join Judge on FKJudgeID = JudgeID where SetJudgeID = ".$SJID;

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

 						
 				echo "<a href='deleteJudge.php?id=".urldecode($ID)."&sjid=".$_GET['sjid']."&del=1' class='btn btn-outline-danger btn-block'>Yes</a>";
 				echo "<br /><br />";
 				echo "<a href='deleteJudge.php?id=".urldecode($ID)."&sjid=".$_GET['sjid']."&del=0' class='btn btn-primary btn-block'>No</a>";
 				
 				
 				echo "</div>";
 				echo "</div>";
 				echo "</div>";
 				echo "</div>";
 				echo "</div>";

			} else {
				$_SESSION["message"] = "Error! Judge cannot be found.";
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