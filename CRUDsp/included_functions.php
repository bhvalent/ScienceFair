<?php	
	function new_header($name="Default", $urlLink="") {
		echo '<head>';
		echo '<meta charset="utf-8">';
		echo '<meta name="viewport" content="width=device-width, initial-scale=1">';

		//<!-- metalink for bootstrap4 -->
		echo '<link rel="stylesheet" href="css/bootstrap.css"/>';
		echo '<link rel="stylesheet" href="css/bootstrap-grid.css"/>';
		
		echo '</head>';
		echo '<body>';

		//<!-- content goes here -->
		echo '<nav class="navbar navbar-light" role="navigation">';
		echo '<div class="container-fluid">';
		echo '<div class="navbar-header">';
		echo '<a class="navbar-brand" href="SFindex.php">MSEF Region 7 Science and Engineering Fairs at the University of Mississippi</a>';
		echo '</div>';
			
		//<!--<div class="btn-toolbar">-->
					
					
		echo '<div class="btn-group">';
		echo '<button type="button" class="btn btn-outline-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Students
				</button>';
		echo '<div class="dropdown-menu">';
		echo '<a class="dropdown-item" href="#">Action</a>';
    	echo '<a class="dropdown-item" href="#">Another action</a>';
    	echo '<a class="dropdown-item" href="#">Something else here</a>';
    	echo '</div>';
		echo '</div>';
					

		
					
		echo '<div class="btn-group">';
		echo '<button type="button" class="btn btn-outline-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Judges
				</button>';
		echo '<div class="dropdown-menu">';
		echo '<a class="dropdown-item" href="#">Action</a>';
    	echo '<a class="dropdown-item" href="#">Another action</a>';
    	echo '<a class="dropdown-item" href="#">Something else here</a>';
    	echo '</div>';
		echo '</div>';
					

    				
		echo '<div class="btn-group">';
		echo '<button type="button" class="btn btn-outline-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Categories
				</button>';
		echo '<div class="dropdown-menu">';
		echo '<a class="dropdown-item" href="#">Action</a>';
    	echo '<a class="dropdown-item" href="#">Another action</a>';
    	echo '<a class="dropdown-item" href="#">Something else here</a>';
    	echo '</div>';
		echo '</div>';
					

    				
		echo '<div class="btn-group">';
		echo '<button type="button" class="btn btn-outline-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Scores
				</button>';
		echo '<div class="dropdown-menu">';
		echo '<a class="dropdown-item" href="#">Action</a>';
    	echo '<a class="dropdown-item" href="#">Another action</a>';
    	echo '<a class="dropdown-item" href="#">Something else here</a>';
    	echo '</div>';
		echo '</div>';
					
    	//<!--</div>-->
		echo '</div>';
		echo '</nav>';
		
		echo '<nav class="navbar navbar-dark" style="background-color: #003366">';
		echo '<div class="container-fluid">';
		echo '<div class="navbar-header">';
		echo '<span class="navbar-brand mb-0 h1">'.$name.'</span>';
		echo '</div>';
				
		echo '</div>';
		echo '</nav>';



		//<!-- Bootstrap4 scripts (jquery and popper are CDN because not downloaded) -->
		echo '<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>';

		echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>';

		echo '<script src="js/bootstrap.min.js"></script>';
		echo '</body>';

	}

	function db_connection() {
		require_once("../../DBScienceFair.php");

		$mysqli = new mysqli(DBHOST, USERNAME, PASSWORD, DBNAME);

		if($mysqli->maxdb_connect_errno) {
			die("Could not connect to server".DBHOST."<br />");
		} else {
			echo "Successful connection to ".USERNAME." database <br />";
		}

		return $mysqli;
	}

// style="background-color: #00264d;"	
?>