<DOCTYPE! html>
<html lang="en">

<?php 
	require_once("included_functions.php");
	$mysqli = db_connection();
	//new_header("Home")	
 ?>
 	
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

	$query = "Select * from Fair order by Year DESC";
	$result = $mysqli->query($query);
	if ($result && $result->num_rows > 0) {
		echo "<div class='container'>";
		echo "<head><h2>&nbsp</h2></head>";
		echo "<div class='row justify-content-center'";
		//echo "<center>";
		echo "<head>";
		echo "<h3>Fairs</h3>";
		echo "</head>";
		echo "</div>";

		//echo "<div class='table-responsive'";
		echo "<table class='table table-bordered table-hover'>";
		echo "<thead class='thead-dark'>";
		echo "<tr><th scope='col'>Name</th><th scope='col'>Year</th></tr>";
		echo "</thead>";
		echo "<tbody>";
		while ($row = $result->fetch_assoc()) {
			echo "<tr>";
			echo "<td class='text-center'><a href='#'>".$row['FairName']."</a></td>";
			//echo "<td class='text-center'>".$row['FairName']."</td>";
			echo "<td class='text-center'>".$row['Year']."</td>";
			echo "</tr>";
		}
		echo "</tbody>";
		echo "</table>";
		//echo "</div>";

		//echo "</center>";
		
		echo "</div>";
	}

?>

	<!-- Bootstrap4 scripts (jquery and popper are CDN because not downloaded) -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>

	<script src="js/bootstrap.min.js"></script>
	</body>

 </html>