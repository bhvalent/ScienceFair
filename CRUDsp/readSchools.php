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
		$type = $_GET['type'];
		$query1 = "Select * from Fair where FairID = ".$ID;

		$result = $mysqli->query($query1);
		if ($result && $result->num_rows > 0) {
			$row = $result->fetch_assoc();
			new_header($row['FairName']." ".$row['Year'], $ID);


			$query = "select * from School";
			$result = $mysqli->query($query);
			if ($result && $result->num_rows > 0) {

				echo "<div class='container-fluid'>";
				echo "<br><br>";
				echo "<div class='row justify-content-center'";
				echo "<head>";
				echo "<h3>Schools</h3>";
				echo "</head>";
				echo "</div>";

				echo "<div class='table-responsive'>";
				echo "<table class='table table-bordered table-hover'>";
				echo "<thead class='thead-dark'>";
				echo "<tr>";
				echo "<th scope='col'>Name</th>";
				echo "<th scope='col'>Key Teacher</th>";
				echo "<th scope='col'>City</th>";
				echo "<th scope='col'>Type</th>";
				echo "<th scope='col'></th>";
				echo "</tr>";
				echo "</thead>";
				echo "<tbody>";

				while ($row = $result->fetch_assoc()) {
					echo "<tr>";
					echo "<td class='text-center'>".$row['SName']."</td>";
					echo "<td class='text-center'>".$row['KeyTeacher']."</td>";
					echo "<td class='text-center'>".$row['City']."</td>";
					echo "<td class='text-center'>".$row['Type']."</td>";
					echo "<td class='text-center'><a href='editSchool.php?sid=".urlencode($_GET['SchoolID'])."' class='btn btn-outline-warning'>Edit</a></td>";
					echo "</tr>";
				}

				echo "</tbody>";
				echo "</table>";
				echo "</div>";


			} else {
				$_SESSION["message"] = "Error! Schools were not found.";
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
</html>