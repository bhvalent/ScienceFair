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
	    if ( (isset($_POST["fname"]) && $_POST["fname"] !== "") && (isset($_POST["lname"]) && $_POST["lname"] !== "") && (isset($_POST["age"]) && $_POST["age"] !== "") && (isset($_POST["genderRadioOptions"]) && $_POST["genderRadioOptions"] !== "") && (isset($_POST["city"]) && $_POST["city"] !== "") && (isset($_POST["state"]) && $_POST["state"] !== "") && (isset($_POST["zip"]) && $_POST["zip"] !== "") && (isset($_POST["class"]) && $_POST["class"] !== "") && (isset($_GET["rid"]) && $_GET[""] !== "") && (isset($_POST["continuation"]) && $_POST["continuation"] !== "") && (isset($_POST["work"]) && $_POST["work"] !== "") && (isset($_POST["wheelchair"]) && $_POST["wheelchair"] !== "") ) {

            $ID = $_GET['id'];
            $RID = $_GET['rid'];

            //echo "<h2>Recieved all the information</h2>";
            $query = "Insert into TeamMembers ";
            $query .= "(LName, FName, Age, Gender, City, State, Zip, Continuation, NumYears, WheelchairAccess, FKClassID, FKRegistrationID) ";
            $query .= "VALUES(";
            $query .= "'".$_POST['lname']."', ";
            $query .= "'".$_POST['fname']."', ";
            $query .= $_POST['age'].", ";
            $query .= "'".$_POST['genderRadioOptions']."', ";
            $query .= "'".$_POST['city']."', ";
            $query .= "'".$_POST['state']."', ";
            $query .= $_POST['zip'].", ";
            $query .= "'".$_POST['continuation']."', ";
            $query .= $_POST['work'].", ";
            $query .= "'".$_POST['wheelchair']."', ";
            $query .= $_POST['class'].", ";
            $query .= $RID.")";

            $result = $mysqli->query($query);

            if($result) {

                $_SESSION["message"] = $_POST["fname"]." ".$_POST["lname"]." has been added";
                header("Location: addMoreTM.php?id=".$ID."&rid=".$RID);
                exit;

            } else {

                $_SESSION["message"] = "Error! Could not add ".$_POST["fname"]." ".$_POST["lname"];
                header("Location: FairHome.php?id=".$ID);
                exit;
            }

        } else {
            $_SESSION["message"] = "Unable to add student. Fill in all information!";
            header("Location: addTeamMember.php?id=".$ID);
            exit;
        }

  
	} else {
        if ((isset($_GET['id']) && $_GET['id'] != "") && (isset($_GET['rid']) && $_GET['rid'] != "")) {
            $ID = $_GET['id'];
            $query = "Select * from Fair where FairID = ".$ID;

            $result = $mysqli->query($query);
            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                new_header($row['FairName']." ".$row['Year'], $ID);
                $fairNameYear = $row['FairName']." ".$row['Year'];

                $query = "select ProjTitle from Registration where RegistrationID = ".$_GET['rid'];
                $result = $mysqli->query($query);
                if ($result) {
                    $row = $result->fetch_assoc();

                    echo "<br /><br />";
                    echo "<div class='row justify-content-center'";
                    echo "<head>";
                    echo "<h3 class='d-none d-md-block'>Add Team Member to: <i>".$row['ProjTitle']."</i></h3>";
                    echo "<h5 class='d-md-none'>Add Team Member to: <i>".$row['ProjTitle']."</i></h5>";

                    echo "<script type='text/javascript'>";

                    //echo "function formValidation() { var title = document.addForm.projTitle;if (title == '') {window.alert( 'Please provide Project Title!' );projTitle.focus();return false;}}";

                    echo "</script>";

                    echo "</head>";
                    echo "</div>";
                    echo "<br /><br />";
                    echo "<div class='container'>";
                    
                    // onsubmit='return formValidation();'
                    echo "<form name='addform' method='POST' action='addTeamMember.php?id=".$ID."&rid=".$_GET['rid']."'>";
            
                    

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

                    // Continuation, number of years, wheelchair access
                    echo "<div class='form-row'>";

                    echo "<div class='form-group col-2'";
                    echo "<label>Continuation: </label>";
                    echo "<br />";
                    echo "<div class='form-check form-check-inline'>";
                    echo "<input class='form-check-input' type='radio' name='continuation' id='cRadio1' value='Yes'>";
                    echo "<label class='form-check-label' for='cRadio1'>Yes</label>";
                    echo "</div>";
                    echo "<div class='form-check form-check-inline'>";
                    echo "<input class='form-check-input' type='radio' name='continuation' id='cRadio2' value='Yes'>";
                    echo "<label class='form-check-label' for='cRadio2'>No</label>";
                    echo "</div>";
                    echo "</div>";

                    echo "<div class='form-group col-4'";
                    echo "<label>Years of Work: </label>";
                    echo "<input type='number' class='form-control' value='0' id='work' name='work'>";
                    echo "</div>";

                    echo "<div class='form-group col-3'";
                    echo "<label>Wheelchair Access Needed: </label>";
                    echo "<br />";
                    echo "<div class='form-check form-check-inline'>";
                    echo "<input class='form-check-input' type='radio' name='wheelchair' id='wRadio1' value='Yes'>";
                    echo "<label class='form-check-label' for='wRadio1'>Yes</label>";
                    echo "</div>";
                    echo "<div class='form-check form-check-inline'>";
                    echo "<input class='form-check-input' type='radio' name='wheelchair' id='wRadio2' value='Yes'>";
                    echo "<label class='form-check-label' for='wRadio2'>No</label>";
                    echo "</div>";
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

                   
            
                    

                    

                    // grade and class
                    $query = "Select * from Class";
                    $result = $mysqli->query($query);
                    if ($result && $result->num_rows > 0) {

                        echo "<div class='form-row'>";
                        echo "<div class='form-group col'>";
                        echo "<label>Class and Grade:</label>";
                        echo "<select class='form-control' id='class' name='class'>";
                        echo "<option>Choose Option</option>";
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
                    $_SESSION["message"] = "Error! Student could not be found.";
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
