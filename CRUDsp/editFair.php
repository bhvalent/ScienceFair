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
		 	<a class="navbar-brand" href="SFindex.php">MSEF Region 7 Science and Engineering Fairs at the University of Mississippi</a>
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
 ?>

<?php

	if (isset($_POST['submit'])) {
		if ((isset($_POST["fairName"]) && $_POST["fairName"] !== "") && (isset($_POST["year"]) && $_POST["year"] !== "")) {
			
			$ID = $_GET['id'];
			$query = "Update Fair set FairName = '".$_POST['fairName']."', Year = ".$_POST['year']." where FairID = ".$ID;

			$result = $mysqli->query($query);
			if ($result) {

				$_SESSION["message"] = $_POST["fairName"]." ".$_POST["year"]." has been updated";
                header("Location: SFindex.php");
                exit;

			} else {

				$_SESSION["message"] = "Error! Could not add ".$_POST["fairName"]." ".$_POST["year"];
                header("Location: SFindex.php");
                exit;

			}

		} else {
			$_SESSION["message"] = "Unable to edit Fair. Fill in all information!";
            header("Location: SFindex.php");
            exit;
		}
	} else {
		if ((isset($_GET['id']) && $_GET['id'] != "")) {
			$ID = $_GET['id'];

			$query = "Select * from Fair where FairID = ".$ID;
			$result = $mysqli->query($query);

			if ($result && $result->num_rows > 0) {
				$row = $result->fetch_assoc();

				echo "<br /><br />";
				echo "<div class='row justify-content-center'";
				echo "<head>";
				echo "<h3>Add Fair:</h3>";
				echo "</head>";
				echo "</div>";
				echo "<br /><br />";

				echo "<div class='container'>";
				echo "<form method='POST' action='editFair.php?id=".$ID."'>";

				echo "<div class='form-row'>";
  				echo "<div class='form-group col'>";
  	 			echo "<label>Fair Name:</label>";
    			echo "<input type='text' class='form-control' id='fairName' name='fairName' value='".$row['FairName']."'>";
    			echo "</div>";
    			echo "<div class='form-group col'>";
				echo "<label>Year:</label>";
    			echo "<input type='number' class='form-control' id='year' name='year' value='".$row['Year']."'>";
    			echo "</div>";
  				echo "</div>";

  				echo "<br />";
  				echo "<button type='submit' name='submit' class='btn btn-primary btn-block'>Submit</button>";
				echo "</form>";
				echo "</div>";
			} else {
				$_SESSION["message"] = "Error! Could not find Fair.";
          		header("Location: SFindex.php");
          		exit;
			}
		} else {
			$_SESSION["message"] = "Error! Variables not set";
          	header("Location: SFindex.php");
          	exit;
		}

		

	}

?>


	<!-- Bootstrap4 scripts (jquery and popper are CDN because not downloaded) -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>

	<script src="js/bootstrap.min.js"></script>
	</body>

 </html>