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
	if (isset($_POST["submit"])) {
   
	    if ((isset($_POST["schoolName"]) && $_POST["schoolName"] !== "") && (isset($_POST["keyTeacher"]) && $_POST["keyTeacher"] !== "") && (isset($_POST["city"]) && $_POST["city"] !== "") && (isset($_POST["type"]) && $_POST["type"] !== "")) {

      		$ID = $_GET['id'];

      		$query = "Insert into School (SName, KeyTeacher, City, Type) ";
      		$query .= "values(";
      		$query .= "'".$_POST['schoolName']."', ";
      		$query .= "'".$_POST['keyTeacher']."', ";
      		$query .= "'".$_POST['city']."', ";
      		$query .= "'".$_POST['type']."'";
      		$query .= ")";

      		$result = $mysqli->query($query);
      		if ($result) {
      			$_SESSION["message"] = $_POST["schoolName"]." has been added";
                header("Location: FairHome.php?id=".$ID);
                exit;
      		} else {
      			$_SESSION["message"] = "Error! Could not add ".$_POST["schoolName"];
                header("Location: FairHome.php?id=".$ID);
                exit;
      		}



      	} else {
      		$_SESSION["message"] = "Unable to add School. Fill in all information!";
        	header("Location: FairHome.php?id=".$ID);
        	exit;	
      	}
    } else {

    	if (isset($_GET['id']) && $_GET['id'] != "") {
    		$ID = $_GET['id'];

    		$query = "Select * from Fair where FairID = ".$ID;

            $result = $mysqli->query($query);
            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                new_header($row['FairName']." ".$row['Year'], $ID);
                $fairNameYear = $row['FairName']." ".$row['Year'];

	            echo "<br /><br />";
				echo "<div class='row justify-content-center'";
				echo "<head>";
				echo "<h3>Add School:</h3>";
				echo "</head>";
				echo "</div>";
				echo "<br /><br />";

				echo "<div class='container'>";
				echo "<form method='POST' action='addSchool.php?id=".$ID."'>";

				echo "<div class='form-row'>";
		  		echo "<div class='form-group col'>";
		  	 	echo "<label>School Name:</label>";
		    	echo "<input type='text' class='form-control' id='schoolName' name='schoolName' placeholder='School Name'>";
		    	echo "</div>";
		    	echo "<div class='form-group col'>";
				echo "<label>Key Teacher:</label>";
		    	echo "<input type='text' class='form-control' id='keyTeacher' name='keyTeacher' placeholder='Name'>";
		    	echo "</div>";
		  		echo "</div>";

		  		echo "<div class='form-row'>";
		  		echo "<div class='form-group col'>";
		  		echo "<label>City:</label>";
		    	echo "<input type='text' class='form-control' id='city' name='city' placeholder='City'>";
		  		echo "</div>";
		  		echo "<div class='form-group col'>";
		  		echo "<label>School:</label>";
	  			echo "<select class='form-control' id='type' name='type'>";
	  			
	  			echo "<option value='Public'>Public</option>";
	  			echo "<option value='Private'>Private</option>";
	  			echo "<option value='Homeschool'>Homeschool</option>";
	  			
	  			echo "</select>";
		  		echo "</div>";
		  		echo "</div>";


		  		echo "<br />";
		  		echo "<button type='submit' name='submit' class='btn btn-primary btn-block'>Submit</button>";
				echo "</form>";
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

    	

    }