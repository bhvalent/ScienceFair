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
  	  	if ( (isset($_POST["schoolName"]) && $_POST["schoolName"] !== "") && (isset($_POST["keyTeacher"]) && $_POST["keyTeacher"] !== "") && (isset($_POST["city"]) && $_POST["city"] !== "") && (isset($_POST["type"]) && $_POST["type"] !== "") ) {

    	  		$ID = $_GET['id'];
            $SID = $_GET['sid'];
  	  		


          	$query = "Update School set ";
          	$query .= "SName = '".$_POST['schoolName']."', ";
          	$query .= "KeyTeacher = '".$_POST['keyTeacher']."', ";
          	$query .= "City = '".$_POST['city']."', ";
          	$query .= "Type = '".$_POST['type']."' ";
          	$query .= "where SchoolID = ".$SID;

          	$result = $mysqli->query($query);

          	if($result && $mysqli->affected_rows === 1) {

            		$_SESSION["message"] = $_POST["schoolName"]." has been updated";
            		header("Location: FairHome.php?id=".$ID);
            		exit;

          	} else {

            		$_SESSION["message"] = "Error! Could not update ".$_POST["schoolName"];
            		header("Location: FairHome.php?id=".$ID);
            		exit;
          	}

        } else {
          	$_SESSION["message"] = "Unable to edit school. Fill in all information!";
          	header("Location: editSchool.php?id=".$ID."&sid=".$SID);
          	exit;
        }
    } else {
        if ((isset($_GET['id']) && $_GET['id'] != "") && (($_GET['sid']) && $_GET['sid'] != "")) {
      			$ID = $_GET['id'];
      			$SID = $_GET['sid'];
      			$query = "Select * from Fair where FairID = ".$ID;

      			$result = $mysqli->query($query);
      			if ($result && $result->num_rows > 0) {
        				$row = $result->fetch_assoc();
        				new_header($row['FairName']." ".$row['Year'], $ID);
        				$fairNameYear = $row['FairName']." ".$row['Year'];
        			
              	echo "<br /><br />";
        				echo "<div class='row justify-content-center'";
        				echo "<head>";
        				//echo "<h3>Edit School:</h3>";
                echo "<h3 class='d-none d-md-block'>Edit School:</h3>";
                echo "<h5 class='d-md-none'>Edit School:</h5>";
        				echo "</head>";
        				echo "</div>";
        				echo "<br /><br />";
        				echo "<div class='container'>";

        				$query = "Select SName, KeyTeacher, City, Type ";
        				$query .= "from School where SchoolID = ".$SID;

        				$result = $mysqli->query($query);
        				if ($result && $result->num_rows > 0) {
            				$row = $result->fetch_assoc();
            		
                  
            				echo "<form method='POST' action='editSchool.php?id=".$ID."&sid=".$SID."'>";
            		
                    echo "<div class='form-row'>";
                    echo "<div class='form-group col'>";
                    echo "<label>School Name:</label>";
                    echo "<input type='text' class='form-control' id='schoolName' name='schoolName' value='".$row['SName']."'>";
                    echo "</div>";
                    echo "<div class='form-group col'>";
                    echo "<label>Key Teacher:</label>";
                    echo "<input type='text' class='form-control' id='keyTeacher' name='keyTeacher' value='".$row['KeyTeacher']."'>";
                    echo "</div>";
                    echo "</div>";

                    echo "<div class='form-row'>";
                    echo "<div class='form-group col'>";
                    echo "<label>City:</label>";
                    echo "<input type='text' class='form-control' id='city' name='city' value='".$row['City']."'>";
                    echo "</div>";
                    echo "<div class='form-group col'>";
                    echo "<label>School:</label>";
                    echo "<select class='form-control' id='type' name='type'>";
                    
                    if ($row['Type'] === "Public") {
                        echo "<option value='Public'>Public (Current Type)</option>";
                        echo "<option value='Private'>Private</option>";
                        echo "<option value='Homeschool'>Homeschool</option>";
                    } elseif ($row['Type'] === "Private") {
                        echo "<option value='Public'>Public</option>";
                        echo "<option value='Private'>Private (Current Type)</option>";
                        echo "<option value='Homeschool'>Homeschool</option>";
                    } else {
                        echo "<option value='Public'>Public</option>";
                        echo "<option value='Private'>Private</option>";
                        echo "<option value='Homeschool'>Homeschool (Current Type)</option>";
                    }
                    
                    
                    echo "</select>";
                    echo "</div>";
                    echo "</div>";


                    echo "<br />";
                    echo "<button type='submit' name='submit' class='btn btn-primary btn-block'>Submit</button>";
            					
            				echo "</form>";
            				echo "</div>";
          			} else {
          					  $_SESSION["message"] = "Error! Could not find School.";
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

  	} 
?>
<br /><br /><br />
</html>