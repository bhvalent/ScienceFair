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
	    if ( (isset($_POST["fname"]) && $_POST["fname"] !== "") && (isset($_POST["lname"]) && $_POST["lname"] !== "") && (isset($_POST["age"]) && $_POST["age"] !== "") && (isset($_POST["genderRadioOptions"]) && $_POST["genderRadioOptions"] !== "") && (isset($_POST["city"]) && $_POST["city"] !== "") && (isset($_POST["state"]) && $_POST["state"] !== "") && (isset($_POST["zip"]) && $_POST["zip"] !== "") && (isset($_POST["class"]) && $_POST["class"] !== "") && (isset($_GET["tmid"]) && $_GET["tmid"] !== "") && (isset($_POST["continuation"]) && $_POST["continuation"] !== "") && (isset($_POST["work"]) && $_POST["work"] !== "") && (isset($_POST["wheelchair"]) && $_POST["wheelchair"] !== "")) {

            $ID = $_GET['id'];
            $TMID = $_GET['tmid'];


            $query = "Update TeamMembers set ";
            $query .= "FName = '".$_POST['fname']."', ";
            $query .= "LName = '".$_POST['lname']."', ";
            $query .= "Age = ".$_POST['age'].", ";
            $query .= "Gender = '".$_POST['genderRadioOptions']."', ";
            $query .= "City = '".$_POST['city']."', ";
            $query .= "State = '".$_POST['state']."', ";
            $query .= "Zip = ".$_POST['zip'].", ";
            $query .= "Continuation = '".$_POST['continuation']."', ";
            $query .= "NumYears = ".$_POST['work'].", ";
            $query .= "WheelchairAccess = '".$_POST['wheelchair']."', ";
            $query .= "FKClassID = ".$_POST['class']." ";
            $query .= "where TeamMemberID = ".$TMID;


            $result = $mysqli->query($query);

            if($result) {

                $_SESSION["message"] = $_POST["fname"]." ".$_POST["lname"]." has been updated";
                header("Location: FairHome.php?id=".$ID);
                exit;

            } else {

                $_SESSION["message"] = "Error! Could not update ".$_POST["fname"]." ".$_POST["lname"];
                header("Location: FairHome.php?id=".$ID);
                exit;
            }

        } else {
            $_SESSION["message"] = "Unable to update student. Fill in all information!";
            header("Location: addTeamMember.php?id=".$ID);
            exit;
        }

  
	} else {
        if ((isset($_GET['id']) && $_GET['id'] != "") && (isset($_GET['tmid']) && $_GET['tmid'] != "")) {
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
                echo "<h3 class='d-none d-md-block'>Edit Student: <i>".$fairNameYear."</i></h3>";
                echo "<h5 class='d-md-none'>Edit Student: <i>".$fairNameYear."</i></h5>";

                echo "<script type='text/javascript'>";

                //echo "function formValidation() { var title = document.addForm.projTitle;if (title == '') {window.alert( 'Please provide Project Title!' );projTitle.focus();return false;}}";

                echo "</script>";

                echo "</head>";
                echo "</div>";
                echo "<br /><br />";
                echo "<div class='container'>";



                $query = "Select * from TeamMembers where TeamMemberID = ".$_GET['tmid'];
                $result = $mysqli->query($query);
                if ($result) {
                    $row = $result->fetch_assoc();

                    // onsubmit='return formValidation();'
                    echo "<form name='addform' method='POST' action='editTeamMember.php?id=".$ID."&tmid=".$_GET['tmid']."'>";
            
                    

                    // first and last name
                    echo "<div class='form-row'>";
                    echo "<div class='form-group col'>";
                    echo "<label>First Name:</label>";
                    echo "<input type='text' class='form-control' id='fname' name='fname' value='".$row['FName']."'>";
                    echo "</div>";
                    echo "<div class='form-group col'>";
                    echo "<label>Last Name:</label>";
                    echo "<input type='text' class='form-control' id='lname' name='lname' value='".$row['LName']."'>";
                    echo "</div>";
                    echo "</div>";

                    // Age and Gender
                    echo "<div class='form-row'>";
                    echo "<div class='form-group col-6'";
                    echo "<label>Age:</label>";
                    echo "<input type='number' class='form-control' value='".$row['Age']."' id='age' name='age'>";
                    echo "</div>";
                    if ($row['Gender'] === "Male") {
                        echo "<div class='form-check form-check-inline'>";
                        echo "<input class='form-check-input' type='radio' checked='checked' name='genderRadioOptions' id='inlineRadio1' value='Male'>";
                        echo "<label class='form-check-label' for='inlineRadio1'>Male</label>";
                        echo "</div>";
                        echo "<div class='form-check form-check-inline'>";
                        echo "<input class='form-check-input' type='radio' name='genderRadioOptions' id='inlineRadio2' value='Female'>";
                        echo "<label class='form-check-label' for='inlineRadio2'>Female</label>";
                        echo "</div>";
                    } else {
                        echo "<div class='form-check form-check-inline'>";
                        echo "<input class='form-check-input' type='radio' name='genderRadioOptions' id='inlineRadio1' value='Male'>";
                        echo "<label class='form-check-label active' for='inlineRadio1'>Male</label>";
                        echo "</div>";
                        echo "<div class='form-check form-check-inline'>";
                        echo "<input class='form-check-input' type='radio' checked='checked' name='genderRadioOptions' id='inlineRadio2' value='Female'>";
                        echo "<label class='form-check-label' for='inlineRadio2'>Female</label>";
                        echo "</div>";
                    }
                    echo "</div>";

                    // city, state, and zip code
                    echo "<div class='form-row'>";
                    echo "<div class='form-group col'>";
                    echo "<label>City:</label>";
                    echo "<input type='text' class='form-control' id='city' name='city' value='".$row['City']."'>";
                    echo "</div>";
                    echo "<div class='form-group col'>";
                    echo "<label>State Abbreviation (e.g. MS):</label>";
                    echo "<input type='text' class='form-control' id='state' name='state' value='".$row['State']."'>";
                    echo "</div>";
                    echo "<div class='form-group col'>";
                    echo "<label>Zip Code:</label>";
                    echo "<input type='number' class='form-control' id='zip' name='zip' value='".$row['Zip']."'>";
                    echo "</div>";
                    echo "</div>";

                   
            
                    // Continuation, number of years, wheelchair access
                    echo "<div class='form-row'>";
                    if ($row['Continuation'] === 'Yes') {
                        echo "<div class='form-group col-2'";
                        echo "<label>Continuation: </label>";
                        echo "<br />";
                        echo "<div class='form-check form-check-inline'>";
                        echo "<input class='form-check-input' type='radio' checked='checked' name='continuation' id='cRadio1' value='Yes'>";
                        echo "<label class='form-check-label' for='cRadio1'>Yes</label>";
                        echo "</div>";
                        echo "<div class='form-check form-check-inline'>";
                        echo "<input class='form-check-input' type='radio' name='continuation' id='cRadio2' value='Yes'>";
                        echo "<label class='form-check-label' for='cRadio2'>No</label>";
                        echo "</div>";
                    } else {
                        echo "<div class='form-group col-2'";
                        echo "<label>Continuation: </label>";
                        echo "<br />";
                        echo "<div class='form-check form-check-inline'>";
                        echo "<input class='form-check-input' type='radio' name='continuation' id='cRadio1' value='Yes'>";
                        echo "<label class='form-check-label' for='cRadio1'>Yes</label>";
                        echo "</div>";
                        echo "<div class='form-check form-check-inline'>";
                        echo "<input class='form-check-input' type='radio' checked='checked' name='continuation' id='cRadio2' value='Yes'>";
                        echo "<label class='form-check-label' for='cRadio2'>No</label>";
                        echo "</div>";
                    }
                    echo "</div>";

                    echo "<div class='form-group col-4'";
                    echo "<label>Years of Work: </label>";
                    echo "<input type='number' class='form-control' value='".$row['NumYears']."' id='work' name='work'>";
                    echo "</div>";

                    echo "<div class='form-group col-3'";
                    if ($row['WheelchairAccess'] === 'Yes') {
                        echo "<label>Wheelchair Access Needed: </label>";
                        echo "<br />";
                        echo "<div class='form-check form-check-inline'>";
                        echo "<input class='form-check-input' type='radio' checked='checked' name='wheelchair' id='wRadio1' value='Yes'>";
                        echo "<label class='form-check-label' for='wRadio1'>Yes</label>";
                        echo "</div>";
                        echo "<div class='form-check form-check-inline'>";
                        echo "<input class='form-check-input' type='radio' name='wheelchair' id='wRadio2' value='Yes'>";
                        echo "<label class='form-check-label' for='wRadio2'>No</label>";
                        echo "</div>";
                    } else {
                        echo "<label>Wheelchair Access Needed: </label>";
                        echo "<br />";
                        echo "<div class='form-check form-check-inline'>";
                        echo "<input class='form-check-input' type='radio' name='wheelchair' id='wRadio1' value='Yes'>";
                        echo "<label class='form-check-label' for='wRadio1'>Yes</label>";
                        echo "</div>";
                        echo "<div class='form-check form-check-inline'>";
                        echo "<input class='form-check-input' type='radio' checked='checked' name='wheelchair' id='wRadio2' value='Yes'>";
                        echo "<label class='form-check-label' for='wRadio2'>No</label>";
                        echo "</div>";
                    }
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
                        while ($row2 = $result->fetch_assoc()) {
                            if ($row2['ClassID'] === $row['FKClassID']) {
                                echo "<option value='".$row2['ClassID']."'>Class ".$row2['Class'].", Grade ".$row2['Grade']." (Current Class and Grade)</option>";
                            } else {
                                echo "<option value='".$row2['ClassID']."'>Class ".$row2['Class'].", Grade ".$row2['Grade']."</option>";
                            }
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
                }



                
                
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
