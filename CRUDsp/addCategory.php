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
     
  	    if ((isset($_POST["description"]) && $_POST["description"] !== "") && (isset($_POST["cid"]) && $_POST["cid"] !== "")) {

        		$ID = $_GET['id'];

        		$query = "Insert into Category (CategoryID, Description) ";
        		$query .= "values(";
            $query .= $_POST['cid'].", ";
        		$query .= "'".$_POST['description']."'";
        		$query .= ")";

        		$result = $mysqli->query($query);
        		if ($result) {
        			$_SESSION["message"] = $_POST["description"]." has been added";
                  header("Location: FairHome.php?id=".$ID);
                  exit;
        		} else {
        			$_SESSION["message"] = "Error! Could not add ".$_POST["description"];
                  header("Location: FairHome.php?id=".$ID);
                  exit;
        		}



        } else {
        		$_SESSION["message"] = "Unable to add Category. Fill in all information!";
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
  				      //echo "<h3>Add Category:</h3>";
                echo "<h3 class='d-none d-md-block'>Add Category:</h3>";
                echo "<h5 class='d-md-none'>Add Category:</h5>";
  				      echo "</head>";
  				      echo "</div>";
  				      echo "<br /><br />";

  				      echo "<div class='container'>";
  				      echo "<form method='POST' action='addCategory.php?id=".$ID."'>";

  				      echo "<div class='form-row'>";
                echo "<div class='form-group col'>";
                echo "<label>Category ID:</label>";
                echo "<input type='number' class='form-control' id='cid' name='cid' placeholder='100'>";
                echo "<small id='cidHelp' class=form-text text-muted'>Make sure ID is unique compared to the other ID's</small>";
                echo "</div>";
                echo "<div class='form-group col'>";
                echo "<label>Category Description:</label>";
                echo "<input type='text' class='form-control' id='description' name='description' placeholder='Description'>";
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
?>
<br /><br /><br />
</html>
