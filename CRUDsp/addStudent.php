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
        //echo "<h2>Got the submit</h2>";
		    if ( (isset($_POST["projTitle"]) && $_POST["projTitle"] !== "") && (isset($_POST["fname"]) && $_POST["fname"] !== "") && (isset($_POST["lname"]) && $_POST["lname"] !== "") && (isset($_POST["age"]) && $_POST["age"] !== "") && (isset($_POST["genderRadioOptions"]) && $_POST["genderRadioOptions"] !== "") && (isset($_POST["city"]) && $_POST["city"] !== "") && (isset($_POST["state"]) && $_POST["state"] !== "") && (isset($_POST["zip"]) && $_POST["zip"] !== "") && (isset($_POST["school"]) && $_POST["school"] !== "") && (isset($_POST["adultSponsor"]) && $_POST["adultSponsor"] !== "") ) {

          $ID = $_GET['id'];

            //echo "<h2>Recieved all the information</h2>";
            $query = "Insert into Registration ";
            $query .= "(LName, FName, ProjTitle, Age, Gender, City, State, Zip, AdultSponsor, FKFairID, FKSchoolID, FKCategoryID, FKClassID) ";
            $query .= "VALUES(";
            $query .= "'".$_POST['lname']."', ";
            $query .= "'".$_POST['fname']."', ";
            $query .= "'".$_POST['projTitle']."', ";
            $query .= $_POST['age'].", ";
            $query .= "'".$_POST['genderRadioOptions']."', ";
            $query .= "'".$_POST['city']."', ";
            $query .= "'".$_POST['state']."', ";
            $query .= $_POST['zip'].", ";
            $query .= "'".$_POST['adultSponsor']."', ";
            $query .= $ID.", ";
            $query .= $_POST['school'].", ";
            $query .= $_POST['category'].", ";
            $query .= $_POST['class'].")";

            $result = $mysqli->query($query);

            if($result) {

                $_SESSION["message"] = $_POST["fname"]." ".$_POST["lname"]." has been added";
                header("Location: FairHome.php?id=".$ID);
                exit;

            } else {

                $_SESSION["message"] = "Error! Could not add ".$_POST["fname"]." ".$_POST["lname"];
                header("Location: FairHome.php?id=".$ID);
                exit;
            }

        } else {
            $_SESSION["message"] = "Unable to add student. Fill in all information!";
            header("Location: addStudent.php?id=".$ID);
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
			          echo "<h3 class='d-none d-md-block'>Add Student: <i>".$fairNameYear."</i></h3>";
                echo "<h5 class='d-md-none'>Add Student: <i>".$fairNameYear."</i></h5>";
			          echo "</head>";
			          echo "</div>";
			          echo "<br /><br />";
			          echo "<div class='container'>";
      
			          echo "<form method='POST' action='addStudent.php?id=".$ID."'>";
		
			          // Project title
			          echo "<div class='form-row'>";
			          echo "<div class='form-group col'>";
			          echo "<label>Project Title</label>";
			          echo "<input type='text' class='form-control' id='projTitle' name='projTitle' placeholder='Project Title'>";
			          echo "</div>";
			          echo "</div>";

			          // first and last name
  			        echo "<div class='form-row'>";
  			        echo "<div class='form-group col'>";
  	 		        echo "<label>First Name:</label>";
    		        echo "<input type='text' class='form-control' id='fname' name='fname' placeholder='First name'>";
    		        echo "</div>";
    		        echo "<div class='form-group col'>";
			          echo "<label>Last Name:</label>";
    		        echo "<input type='text' class='form-control' id='lname' name='lname' placeholder='Last name'>";
    		        echo "</div>";
  			        echo "</div>";

  			        // Age and Gender
  			        echo "<div class='form-row'>";
  			        echo "<div class='form-group col-6'";
  			        echo "<label>Age:</label>";
  			        echo "<input type='number' class='form-control' value='12' id='age' name='age'>";
  			        echo "</div>";
  			        echo "<div class='form-check form-check-inline'>";
  			        echo "<input class='form-check-input' type='radio' name='genderRadioOptions' id='inlineRadio1' value='Male'>";
  			        echo "<label class='form-check-label' for='inlineRadio1'>Male</label>";
  			        echo "</div>";
  			        echo "<div class='form-check form-check-inline'>";
  			        echo "<input class='form-check-input' type='radio' name='genderRadioOptions' id='inlineRadio2' value='Female'>";
  			        echo "<label class='form-check-label' for='inlineRadio2'>Female</label>";
  			        echo "</div>";
  			        echo "</div>";

  			        // city, state, and zip code
  			        echo "<div class='form-row'>";
  			        echo "<div class='form-group col'>";
  			        echo "<label>City:</label>";
  			        echo "<input type='text' class='form-control' id='city' name='city' placeholder='City'>";
  			        echo "</div>";
  			        echo "<div class='form-group col'>";
  			        echo "<label>State Abbreviation (e.g. MS):</label>";
  			        echo "<input type='text' class='form-control' id='state' name='state' placeholder='State'>";
  			        echo "</div>";
  			        echo "<div class='form-group col'>";
  			        echo "<label>Zip Code:</label>";
  			        echo "<input type='number' class='form-control' id='zip' name='zip' placeholder='12345'>";
  			        echo "</div>";
  			        echo "</div>";

                // Adult Sponsor
                echo "<div class='form-row'>";
                echo "<div class='form-group col'>";
                echo "<label>Adult Sponsor Name</label>";
                echo "<input type='text' class='form-control' id='adultSponsor' name='adultSponsor' placeholder='Name'>";
                echo "</div>";
                echo "</div>";
		
  			        // select school
  			        $query = "Select * from School order by SName";
  			        //echo "<h2>GOT HERE</h2>";
  			        $result = $mysqli->query($query);
  			        if ($result && $result->num_rows > 0) {

  				          echo "<div class='form-row'>";
  				          echo "<div class='form-group col'>";
  				          echo "<label>School:</label>";
  				          echo "<select class='form-control' id='school' name='school'>";
  				          while ($row = $result->fetch_assoc()) {
  					            echo "<option value='".$row['SchoolID']."'>".$row['SName']."</option>";
  				          }
  				          echo "</select>";
  				          echo "</div>";
  				          echo "</div>";

  			        } else {
  				          echo "<h2>Schools not Available</h2>";
  			        }

                // category
                $query = "Select * from Category";
                $result = $mysqli->query($query);
                if ($result && $result->num_rows > 0) {

                    echo "<div class='form-row'>";
                    echo "<div class='form-group col'>";
                    echo "<label>Category:</label>";
                    echo "<select class='form-control' id='category' name='category'>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='".$row['CategoryID']."'>".$row['Description']."</option>";
                    }
                    echo "</select>";
                    echo "</div>";
                    echo "</div>";

                } else {
                    echo "<h2>Class not Available</h2>";
                }

                // grade and class
                $query = "Select * from Class";
                $result = $mysqli->query($query);
                if ($result && $result->num_rows > 0) {

                    echo "<div class='form-row'>";
                    echo "<div class='form-group col'>";
                    echo "<label>Class and Grade:</label>";
                    echo "<select class='form-control' id='class' name='class'>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='".$row['ClassID']."'>Class ".$row['Class'].", Grade ".$row['Grade']."</option>";
                    }
                    echo "</select>";
                    echo "</div>";
                    echo "</div>";

                } else {
                    echo "<h2>Class not Available</h2>";
                }

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
