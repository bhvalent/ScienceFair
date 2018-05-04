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

	<?php 
		require_once("included_functions.php");
		$mysqli = db_connection();
		if (($output = message()) !== null) {
			echo $output;
		}
		
 	?>	

	<!-- content goes here -->
	<nav class="navbar navbar-light" role="navigation">
		 <div class="container-fluid">
		 <div class="navbar-header">
		
		 	<a class="navbar-brand" href="SFindex.php">UM Pre College Programs</a>

		 	<!-- Science and Engineering Fairs at the University of Mississippi -->
		
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

	<!-- Bootstrap4 scripts (jquery and popper are CDN because not downloaded) -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>

	<script src="js/bootstrap.min.js"></script>
	</body>



<?php 

	echo "<div class='container'>";
	echo "<head><h2>&nbsp</h2></head>";
	echo "<div class='row justify-content-center'";
	
	echo "<head>";
	echo "<h2>Fairs</h2>";
	echo "</head>";
	echo "</div>";

	$query = "Select * from Fair order by Year DESC";
	$result = $mysqli->query($query);
	if ($result && $result->num_rows > 0) {
		

		echo "<br /><br />";
		echo "<div class='row justify-content-center'>";
		echo "<div class='col-xs-12 col-sm-10 col-md-8 col-lg-6'>";
		echo "<div class='table-responsive'>";
		echo "<table class='table table-bordered table-hover'>";
		echo "<thead class='thead-dark text-center'>";
		echo "<tr>";
		echo "<th scope='col'>Name</th>";
		echo "<th scope='col'>Year</th>";
		echo "<th scope='col'></th>";
		echo "<th scope='col'></th>";
		echo "</tr>";
		echo "</thead>";
		echo "<tbody>";
		while ($row = $result->fetch_assoc()) {
			echo "<tr>";
			echo "<td class='text-center'><a href='FairHome.php?id=".urlencode($row['FairID'])."'>".$row['FairName']."</a></td>";
			echo "<td class='text-center'>".$row['Year']."</td>";
			echo "<td class='text-center'><a href='editFair.php?id=".$row['FairID']."' class='btn btn-outline-warning'>Edit</a></td>";
			echo "<td class='text-center'><a href='deleteFair.php?id=".$row['FairID']."' class='btn btn-outline-danger'>Delete</a></td>";
			echo "</tr>";
		}
		echo "</tbody>";
		echo "</table>";
		echo "</div>";
		echo "</div>";
		echo "</div>";
		
		
		
		
	}
	echo "</div>";

	echo "<div class='container'>";
	echo "<br /><br />";
	echo "<div class='row justify-content-center'>";
	echo "<a href='addFair.php' class='btn btn-primary'>Add Fair</a>";
	echo "</div>";
	echo "</div>";

?>

<br /><br /><br />

 </html>