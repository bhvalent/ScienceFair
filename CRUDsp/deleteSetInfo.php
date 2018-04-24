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
	if ((isset($_GET['sjid']) && $_GET['sjid'] != "") && (($_GET['rid']) && $_GET['rid'] != "") && (isset($_GET['snum']) && $_GET['snum'] != "") && (isset($_GET['id']) && $_GET['id'] != "") && (isset($_GET['cid']) && $_GET['cid'] != "") && (isset($_GET['del']) && $_GET['del'] !== "")) {
		
		$ID = $_GET['id'];
		$CID = $_GET['cid'];
		
		if ($_GET['del'] === "1") {

			$query = "Delete from JudgeRegistrant where FKSetJudgeID = ".$_GET['sjid'];
			$query .= " and FKRegistrationID = ".$_GET['rid']." and SetNumber = ".$_GET['snum'];
			$result = $mysqli->query($query);
			if ($result && $mysqli->affected_rows === 1) {
				$_SESSION["message"] = "Student was successfully deleted";
				header("Location: readSetDetails.php?id=".$ID."&cid=".$CID."&snum=".$_GET['snum']);
				exit;
			} else {
				$num = $mysqli->affected_rows;
				$_SESSION["message"] = $num." rows were deleted.";
				header("Location: readSetDetails.php?id=".$ID."&cid=".$CID."&snum=".$_GET['snum']);
				exit;
			}

		} else {
			$_SESSION["message"] = "Student was not deleted";
			header("Location: readSetDetails.php?id=".$ID."&cid=".$CID."&snum=".$_GET['snum']);
			exit;
		}





	} elseif ((isset($_GET['id']) && $_GET['id'] != "") && (isset($_GET['rid']) && $_GET['rid'] != "") && (isset($_GET['snum']) && $_GET['snum'] != "")  && (isset($_GET['sjid']) && $_GET['sjid'] != "") && (isset($_GET['cid']) && $_GET['cid'] != "")) {
		$ID = $_GET['id'];
		$CID = $_GET['cid'];
		$query = "Select * from Fair where FairID = ".$ID;

		$result = $mysqli->query($query);
		if ($result && $result->num_rows > 0) {
			$row = $result->fetch_assoc();
			new_header($row['FairName']." ".$row['Year'], $ID);
			$FairName = $row['FairName']." ".$row['Year'];


			$query = "Select CONCAT(FName, ' ', LName) as `Name` from TeamMembers where FKRegistrationID = ".$_GET['rid'];

            $result = $mysqli->query($query);
            $tMems = "";
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    if ($tMems === "") {
                        $tMems = $row['Name'];
                    } else {
                        $tMems .= ", ".$row['Name']; 
                    }
                }
            }




			$query = "select concat(Judge.FName, ' ', Judge.LName) as `JudgeName`, ";
			$query .= "FKSetJudgeID, concat(Registration.FName, ' ', Registration.LName) as `StudentName`, ";
			$query .= "FKRegistrationID, SetNumber from JudgeRegistrant ";
			$query .= "inner join Registration on FKRegistrationID = RegistrationID ";
			$query .= "inner join SetJudge on FKSetJudgeID = SetJudgeID ";
			$query .= "inner join Judge on FKJudgeID = JudgeID ";
			$query .= "inner join Fair on SetJudge.FKFairID = FairID ";
			$query .= "where FKSetJudgeID = ".$_GET['sjid']." and FKRegistrationID = ".$_GET['rid']." and SetNumber = ".$_GET['snum'];

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
 				if ($tMems !== "") {
 					echo "<p class='card-text'>Are you sure you want to delete ".$row['StudentName'].", ".$tMems." from ".$row['JudgeName']."'s set?</p>";
 				} else {
 					echo "<p class='card-text'>Are you sure you want to delete ".$row['StudentName']." from ".$row['JudgeName']."'s set?</p>";
 				}
 						
 				echo "<a href='deleteSetInfo.php?sjid=".urldecode($_GET['sjid'])."&rid=".$_GET['rid']."&id=".$ID."&cid=".$CID."&snum=".$_GET['snum']."&del=1' class='btn btn-outline-danger btn-block'>Yes</a>";
 				echo "<br /><br />";
 				echo "<a href='deleteSetInfo.php?sjid=".urldecode($_GET['sjid'])."&rid=".$_GET['rid']."&id=".$ID."&cid=".$CID."&snum=".$_GET['snum']."&del=2' class='btn btn-primary btn-block'>No</a>";
 				
 				
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