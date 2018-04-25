<?php
	
	require_once("included_functions.php");
	require_once("session.php");
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
		header( "Content-disposition: attachment; filename=JudgesByName".$name.".xls" );






		$query = "Select JudgeID, SetJudgeID, LName, FName, Email, Description as `Category` from ";
		$query .= "Judge inner join SetJudge on FKJudgeID = JudgeID ";
		$query .= "inner join Category on FKCategoryID = CategoryID ";
		$query .= "inner join Fair on FKFairID = FairID ";
		$query .= "where FairID = ".$ID." ";
		$query .= "order by LName";

		$result = $mysqli->query($query);
		if ($result && $result->num_rows > 0) {
			

			// columns
			$columns = 'Last Name' . "\t" . 'First Name' . "\t" . 'Email' . "\t" . 'Category' . "\n";

			echo $columns;
			
			while ($row = $result->fetch_assoc()) {


				$data = $row['LName'] . "\t" . $row['FName'] . "\t" . $row['Email'] . "\t" . $row['Category'] . "\n";

				echo $data;

				
			}		
			
		} else {
			$_SESSION["message"] = "Unable to view Judges";
   			header("Location: FairHome.php?id=".$ID);
   			exit;
		}








	} else {
		$_SESSION["message"] = "Error! Variables not set";
        header("Location: SFindex.php");
        exit;
	}



?>