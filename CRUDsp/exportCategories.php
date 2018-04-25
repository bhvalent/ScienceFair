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
		header( "Content-disposition: attachment; filename=Categories".$name.".xls" );









		$query = "select * from Category order by CategoryID";
		$result = $mysqli->query($query);
		if ($result && $result->num_rows > 0) {

			

			echo 'Category ID' . "\t" . 'Description' . "\n";

			while ($row = $result->fetch_assoc()) {
				
				
				
				echo $row['CategoryID'] . "\t" . $row['Description'] . "\n";
			}

			


		} else {
			$_SESSION["message"] = "Error! Categories were not found.";
        	header("Location: FairHome.php?id=".$ID);
        	exit;
		}












	} else {
		$_SESSION["message"] = "Error! Variables not set";
        header("Location: SFindex.php");
        exit;
	}



?>