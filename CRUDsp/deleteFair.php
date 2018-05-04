<?php 
	require_once("session.php");
?>

<DOCTYPE! html>
<html lang="en">


 	
 	 <head>
		 <meta charset="utf-8">
		 <meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- metalink for bootstrap4 -->
		 <link rel="stylesheet" href="css/bootstrap.css"/>
		 <link rel="stylesheet" href="css/bootstrap-grid.css"/>
		
	</head>
	<body>



	<!-- content goes here -->
	<nav class="navbar navbar-light" role="navigation">
		 <div class="container-fluid">
		 <div class="navbar-header">
		 	<a class="navbar-brand" href="SFindex.php">UM Pre College Programs</a>
		 </div>
    	
		 </div>
	</nav>
		
	<nav class="navbar navbar-dark" style="background-color: #003366">
		 <div class="container-fluid">
		 <div class="navbar-header">
		 	<span class="navbar-brand mb-0 h1">Home</span>
		 </div>
				
		 </div>
	</nav>



<?php
	require_once("included_functions.php");
	$mysqli = db_connection();
	if (($output = message()) !== null) {
		echo $output;
	}
	if ((isset($_GET['id']) && $_GET['id'] != "") && (isset($_GET['del']) && $_GET['del'] != "")) {
		$ID = $_GET['id'];
		
		if ($_GET['del'] === "1") {

			

			$query = "Select RegistrationID from Registration where FKFairID = ".$ID;
			$result = $mysqli->query($query);
			$rid = array();
			if ($result && $result->num_rows > 0) {
				while ($row = $result->fetch_assoc()) {
					array_push($rid, $row['RegistrationID']);
				}

				$query = "Select distinct FKRegistrationID from TeamMembers";
				$result1 = $mysqli->query($query);
				$tm = array();
				if ($result1 && $result1->num_rows > 0) {
					while ($row1 = $result1->fetch_assoc()) {
						array_push($tm, $row1['FKRegistrationID']);
					}

					for ($i = 0; $i < count($tm); $i++) {
						if (in_array($tm[$i], $rid)) {
							$query = "Delete from TeamMembers where FKRegistrationID = ".$tm[$i];
							$result = $mysqli->query($query);
							if ($mysqli->affected_rows < 1) {
								$_SESSION["message"] = "Fair was not deleted TeamMembers";
								header("Location: SFindex.php");
								exit;
							} 
						}
					}
				}
			} 
				
				

			$query = "Select SetJudgeID, FKJudgeID from SetJudge where FKFairID = ".$ID;
			$result = $mysqli->query($query);
			$sjid = array();
			$jid = array();
			if ($result && $result->num_rows > 0) {
				while ($row = $result->fetch_assoc()) {
					array_push($sjid, $row['SetJudgeID']);
					array_push($jid, $row['FKJudgeID']);
				}

				for ($i = 0; $i < count($sjid); $i++) {
					if (count($rid) > 0) {
						for ($j = 0; $j < count($rid); $j++) {
							$query = "Delete from JudgeRegistrant where FKSetJudgeID = ".$sjid[$i]." and FKRegistrationID = ".$rid[$j];
							$result = $mysqli->query($query);
						}
					}
					
					$query = "Delete from SetJudge where SetJudgeID = ".$sjid[$i];
					$result = $mysqli->query($query);
					if ($mysqli->affected_rows < 1) {
						$_SESSION["message"] = "Fair was not deleted SetJudge";
						header("Location: SFindex.php");
						exit;
					}
					$query = "Select FKJudgeID from SetJudge";
					$result = $mysqli->query($query);
					$totalJ = array();
					if ($result && $result->num_rows > 0) {
						while ($row = $result->fetch_assoc()) {
							array_push($totalJ, $row['FKJudgeID']);
						}
						
							if (!(in_array($jid[$i], $totalJ))) {
								$query = "Delete from Judge where JudgeID = ".$jid[$i];
								$result = $mysqli->query($query);
								if ($mysqli->affected_rows < 1) {
									$_SESSION["message"] = "Fair was not deleted JudgeInfo";
									header("Location: SFindex.php");
									exit;
								}
							}
						
					
					}

					
				}
			} 

			if (count($rid) > 0) {
				for ($i = 0; $i < count($rid); $i++) {
					$query = "Delete from Registration where RegistrationID = ".$rid[$i];
					$result = $mysqli->query($query);
					if (!$result || $mysqli->affected_rows < 1) {
						$_SESSION["message"] = "Fair was not deleted Registration";
						header("Location: SFindex.php");
						exit;
					}
				}
			}

			$query1 = "Delete from Fair where FairID = ".$ID;
			$result1 = $mysqli->query($query1);
			if ($result1 && $mysqli->affected_rows === 1) {
				$_SESSION["message"] = "Fair was deleted";
				header("Location: SFindex.php");
				exit;	
			}
			$_SESSION["message"] = "Fair was not deleted Fair";
			header("Location: SFindex.php");
			exit;
						

		} else {
			$_SESSION["message"] = "Fair was not deleted";
			header("Location: SFindex.php");
			exit;
		}





	} elseif ((isset($_GET['id']) && $_GET['id'] != "")) {
		$ID = $_GET['id'];
		$query = "Select * from Fair where FairID = ".$ID;

		$result = $mysqli->query($query);
		if ($result && $result->num_rows > 0) {
			$row = $result->fetch_assoc();
			
			$FairName = $row['FairName']." ".$row['Year'];

			$row = $result->fetch_assoc();

			echo "<div class='container'>";
			echo "<br /><br />";
			echo "<div class='row justify-content-center'>";
			echo "<div class='col-xs-12 col-sm-12 col-md-9 col-lg-6'>";
			echo "<div class='card text-center'>";
			echo "<div class='card-body'>";
			echo "<h3 class='card-title'><b>WARNING</b></h3>";
			echo "<p class='card-text'>Are you sure you want to delete ".$FairName."?</p>";
			echo "<br />";

					
			echo "<a href='deleteFair.php?id=".urldecode($ID)."&del=1' class='btn btn-outline-danger btn-block'>Yes</a>";
			echo "<br /><br />";
			echo "<a href='deleteFair.php?id=".urldecode($ID)."&del=0' class='btn btn-primary btn-block'>No</a>";
			
			
			echo "</div>";
			echo "</div>";
			echo "</div>";
			echo "</div>";
			echo "</div>";


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