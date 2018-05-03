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
	  	if ( (isset($_POST["projTitle"]) && $_POST["projTitle"] !== "") && (isset($_POST["fname"]) && $_POST["fname"] !== "") && (isset($_POST["lname"]) && $_POST["lname"] !== "") && (isset($_POST["age"]) && $_POST["age"] !== "") && (isset($_POST["genderRadioOptions"]) && $_POST["genderRadioOptions"] !== "") && (isset($_POST["city"]) && $_POST["city"] !== "") && (isset($_POST["state"]) && $_POST["state"] !== "") && (isset($_POST["zip"]) && $_POST["zip"] !== "") && (isset($_POST["school"]) && $_POST["school"] !== "") && (isset($_POST["adultSponsor"]) && $_POST["adultSponsor"] !== "") && (isset($_POST["continuation"]) && $_POST["continuation"] !== "") && (isset($_POST["work"]) && $_POST["work"] !== "") && (isset($_POST["wheelchair"]) && $_POST["wheelchair"] !== "") ) {

	  		$ID = $_GET['id'];
	  		$SID = $_GET['sid'];


        	$query = "Update Registration set ";
        	$query .= "LName = '".$_POST['lname']."', ";
        	$query .= "FName = '".$_POST['fname']."', ";
        	$query .= "ProjTitle = '".$_POST['projTitle']."', ";
        	$query .= "Age = ".$_POST['age'].", ";
        	$query .= "Gender = '".$_POST['genderRadioOptions']."', ";
            $query .= "Continuation = '".$_POST['continuation']."', ";
            $query .= "NumYears = ".$_POST['work'].", ";
            $query .= "WheelchairAccess = '".$_POST['wheelchair']."', ";
        	$query .= "City = '".$_POST['city']."', ";
        	$query .= "State = '".$_POST['state']."', ";
        	$query .= "Zip = ".$_POST['zip'].", ";
        	$query .= "AdultSponsor = '".$_POST['adultSponsor']."', ";
        	$query .= "FKSchoolID = ".$_POST['school'].", ";
        	$query .= "FKCategoryID = ".$_POST['category'].", ";
        	$query .= "FKClassID = ".$_POST['class']." ";
        	$query .= "where RegistrationID = ".$SID;

        	$result = $mysqli->query($query);

        	if($result && $mysqli->affected_rows === 1) {

          		$_SESSION["message"] = $_POST["fname"]." ".$_POST["lname"]." has been updated".mysql_errno($mysqli).mysql_error($mysqli);
          		header("Location: FairHome.php?id=".$ID);
          		exit;

        	} else {

          		$_SESSION["message"] = "Error! Could not update ".$_POST["fname"]." ".$_POST["lname"];
          		header("Location: FairHome.php?id=".$ID);
          		exit;
        	}

      	} else {
        	$_SESSION["message"] = "Unable to edit student. Fill in all information!";
        	header("Location: editStudent.php?id=".$ID."&sid=".$SID);
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
				echo "<h3 class='d-none d-md-block'>Edit Student: <i>".$fairNameYear."</i></h3>";
                echo "<h5 class='d-md-none'>Edit Student: <i>".$fairNameYear."</i></h5>";
                echo "</head>";
				echo "</div>";
        

				echo "<br /><br />";
				echo "<div class='container'>";

				$query = "Select LName, FName, ProjTitle, Age, Gender, City, State, Zip, AdultSponsor, FKFairID, FKSchoolID, FKCategoryID, FKClassID ";
				$query .= "from Registration where RegistrationID = ".$SID;

				$result = $mysqli->query($query);
				if ($result && $result->num_rows > 0) {
					$row = $result->fetch_assoc();
		
      
					echo "<form method='POST' name='editForm' class='needs-validation' action='editStudent.php?id=".$ID."&sid=".$SID."' novalidate>";
		
					// Project title
					echo "<div class='form-row'>";
					echo "<div class='form-group col'>";
					echo "<label>Project Title</label>";
					echo "<input type='text' class='form-control' id='projTitle' name='projTitle' value='".$row['ProjTitle']."' required>";
                    echo "<div class='invalid-feedback'>Put Project Title!</div>";
					echo "</div>";
					echo "</div>";

					// first and last name
  					echo "<div class='form-row'>";
  					echo "<div class='form-group col'>";
  	 				echo "<label>First Name:</label>";
    				echo "<input type='text' class='form-control' id='fname' name='fname' value='".$row['FName']."' required>";
                    echo "<div class='invalid-feedback'>Put First Name!</div>";
    				echo "</div>";
    				echo "<div class='form-group col'>";
					echo "<label>Last Name:</label>";
    				echo "<input type='text' class='form-control' id='lname' name='lname' value='".$row['LName']."' required>";
                    echo "<div class='invalid-feedback'>Put First Name!</div>";
    				echo "</div>";
  					echo "</div>";

  					// Age and Gender
  					echo "<div class='form-row'>";
  					echo "<div class='form-group col-6'";
  					echo "<label>Age:</label>";
  					echo "<input type='number' class='form-control' value='".$row['Age']."' id='age' name='age' required>";
                    echo "<div class='invalid-feedback'>Put Age!</div>";
  					echo "</div>";
  					if ($row['Gender'] === "Male") {
  						echo "<div class='form-check form-check-inline'>";
  						echo "<input class='form-check-input' type='radio' checked='checked' name='genderRadioOptions' id='inlineRadio1' value='Male' required>";
  						echo "<label class='form-check-label' for='inlineRadio1'>Male</label>";
                        echo "<div class='invalid-feedback'>&nbsp;Choose Option!</div>";
  						echo "</div>";
  						echo "<div class='form-check form-check-inline'>";
  						echo "<input class='form-check-input' type='radio' name='genderRadioOptions' id='inlineRadio2' value='Female' required>";
  						echo "<label class='form-check-label' for='inlineRadio2'>Female</label>";
                        echo "<div class='invalid-feedback'>&nbsp;Choose Option!</div>";
  						echo "</div>";
  					} else {
  						echo "<div class='form-check form-check-inline'>";
  						echo "<input class='form-check-input' type='radio' name='genderRadioOptions' id='inlineRadio1' value='Male' required>";
  						echo "<label class='form-check-label active' for='inlineRadio1'>Male</label>";
                        echo "<div class='invalid-feedback'>&nbsp;Choose Option!</div>";
  						echo "</div>";
  						echo "<div class='form-check form-check-inline'>";
  						echo "<input class='form-check-input' type='radio' checked='checked' name='genderRadioOptions' id='inlineRadio2' value='Female' required>";
  						echo "<label class='form-check-label' for='inlineRadio2'>Female</label>";
                        echo "<div class='invalid-feedback'>&nbsp;Choose Option!</div>";
  						echo "</div>";
  					}
  			
  					echo "</div>";

                    // Continuation, number of years, wheelchair access
                    echo "<div class='form-row'>";
                    if ($row['Continuation'] === 'Yes') {
                        echo "<div class='form-group col-2'";
                        echo "<label>Continuation: </label>";
                        echo "<br />";
                        echo "<div class='form-check form-check-inline'>";
                        echo "<input class='form-check-input' type='radio' checked='checked' name='continuation' id='cRadio1' value='Yes' required>";
                        echo "<label class='form-check-label' for='cRadio1'>Yes</label>";
                        echo "<div class='invalid-feedback'>&nbsp;Choose Option!</div>";
                        echo "</div>";
                        echo "<div class='form-check form-check-inline'>";
                        echo "<input class='form-check-input' type='radio' name='continuation' id='cRadio2' value='No' required>";
                        echo "<label class='form-check-label' for='cRadio2'>No</label>";
                        echo "<div class='invalid-feedback'>&nbsp;Choose Option!</div>";
                        echo "</div>";
                    } else {
                        echo "<div class='form-group col-2'";
                        echo "<label>Continuation: </label>";
                        echo "<br />";
                        echo "<div class='form-check form-check-inline'>";
                        echo "<input class='form-check-input' type='radio' name='continuation' id='cRadio1' value='Yes' required>";
                        echo "<label class='form-check-label' for='cRadio1'>Yes</label>";
                        echo "<div class='invalid-feedback'>&nbsp;Choose Option!</div>";
                        echo "</div>";
                        echo "<div class='form-check form-check-inline'>";
                        echo "<input class='form-check-input' type='radio' checked='checked' name='continuation' id='cRadio2' value='No' required>";
                        echo "<label class='form-check-label' for='cRadio2'>No</label>";
                        echo "<div class='invalid-feedback'>&nbsp;Choose Option!</div>";
                        echo "</div>";
                    }
                    echo "</div>";

                    echo "<div class='form-group col-4'";
                    echo "<label>Years of Work: </label>";
                    echo "<input type='number' class='form-control' value='".$row['NumYears']."' id='work' name='work' required>";
                    echo "<div class='invalid-feedback'>Put Number of Years!</div>";
                    echo "</div>";

                    echo "<div class='form-group col-3'";
                    if ($row['WheelchairAccess'] === 'Yes') {
                        echo "<label>Wheelchair Access Needed: </label>";
                        echo "<br />";
                        echo "<div class='form-check form-check-inline'>";
                        echo "<input class='form-check-input' type='radio' checked='checked' name='wheelchair' id='wRadio1' value='Yes' required>";
                        echo "<label class='form-check-label' for='wRadio1'>Yes</label>";
                        echo "<div class='invalid-feedback'>&nbsp;Choose Option!</div>";
                        echo "</div>";
                        echo "<div class='form-check form-check-inline'>";
                        echo "<input class='form-check-input' type='radio' name='wheelchair' id='wRadio2' value='No' required>";
                        echo "<label class='form-check-label' for='wRadio2'>No</label>";
                        echo "<div class='invalid-feedback'>&nbsp;Choose Option!</div>";
                        echo "</div>";
                    } else {
                        echo "<label>Wheelchair Access Needed: </label>";
                        echo "<br />";
                        echo "<div class='form-check form-check-inline'>";
                        echo "<input class='form-check-input' type='radio' name='wheelchair' id='wRadio1' value='Yes' required>";
                        echo "<label class='form-check-label' for='wRadio1'>Yes</label>";
                        echo "<div class='invalid-feedback'>&nbsp;Choose Opiton!</div>";
                        echo "</div>";
                        echo "<div class='form-check form-check-inline'>";
                        echo "<input class='form-check-input' type='radio' checked='checked' name='wheelchair' id='wRadio2' value='No' required>";
                        echo "<label class='form-check-label' for='wRadio2'>No</label>";
                        echo "<div class='invalid-feedback'>&nbsp;Choose Option!</div>";
                        echo "</div>";
                    }
                    echo "</div>";

                    echo "</div>";

  					// city, state, and zip code
  					echo "<div class='form-row'>";
  					echo "<div class='form-group col'>";
  					echo "<label>City:</label>";
  					echo "<input type='text' class='form-control' id='city' name='city' value='".$row['City']."' required>";
                    echo "<div class='invalid-feedback'>Put City!</div>";
  					echo "</div>";
  					echo "<div class='form-group col'>";
  					echo "<label>State Abbreviation (e.g. MS):</label>";
  					echo "<input type='text' class='form-control' id='state' name='state' value='".$row['State']."' required>";
                    echo "<div class='invalid-feedback'>Put State!</div>";
  					echo "</div>";
  					echo "<div class='form-group col'>";
  					echo "<label>Zip Code:</label>";
  					echo "<input type='number' class='form-control' id='zip' name='zip' value='".$row['Zip']."' required>";
                    echo "<div class='invalid-feedback'>Put Zip!</div>";
  					echo "</div>";
  					echo "</div>";

        			// Adult Sponsor
        			echo "<div class='form-row'>";
        			echo "<div class='form-group col'>";
        			echo "<label>Adult Sponsor Name</label>";
        			echo "<input type='text' class='form-control' id='adultSponsor' name='adultSponsor' value='".$row['AdultSponsor']."' required>";
                    echo "<div class='invalid-feedback'>Put Sponsor Name!</div>";
        			echo "</div>";
        			echo "</div>";
		
  					// select school
  					$query2 = "Select * from School order by SName";
  					$result2 = $mysqli->query($query2);
  					if ($result2 && $result2->num_rows > 0) {

  						echo "<div class='form-row'>";
  						echo "<div class='form-group col'>";
  						echo "<label>School:</label>";
  						echo "<select class='form-control' id='school' name='school' required>";
                        echo "<option value=''>Choose Option</option>";
  						while ($row2 = $result2->fetch_assoc()) {
  							if ($row2['SchoolID'] === $row['FKSchoolID']) {
  								echo "<option value='".$row2['SchoolID']."'>".$row2['SName']." (Current School)</option>";
  							} else {
  								echo "<option value='".$row2['SchoolID']."'>".$row2['SName']."</option>";
  							}
  						
  						}
  						echo "</select>";
  						echo "</div>";
  						echo "</div>";

  					} else {
  						echo "<h2>Schools not Available</h2>";
  					}

        			// category
        			$query2 = "Select * from Category";
        			$result2 = $mysqli->query($query2);
        			if ($result2 && $result2->num_rows > 0) {

          				echo "<div class='form-row'>";
          				echo "<div class='form-group col'>";
          				echo "<label>Category:</label>";
          				echo "<select class='form-control' id='category' name='category' required>";
                        echo "<option value=''>Choose Option</option>";
          				while ($row2 = $result2->fetch_assoc()) {
          					if ($row2['CategoryID'] === $row['FKCategoryID']) {
          						echo "<option value='".$row2['CategoryID']."'>".$row2['Description']." (Current Category)</option>";
          					} else {
          						echo "<option value='".$row2['CategoryID']."'>".$row2['Description']."</option>";
          					}
            		
          				}
          				echo "</select>";
          				echo "</div>";
          				echo "</div>";

        			} else {
          				echo "<h2>Category not Available</h2>";
        			}

        			// grade and class
        			$query2 = "Select * from Class";
        			$result2 = $mysqli->query($query2);
        			if ($result2 && $result2->num_rows > 0) {

        	  			echo "<div class='form-row'>";
          				echo "<div class='form-group col'>";
          				echo "<label>Class and Grade:</label>";
          				echo "<select class='form-control' id='class' name='class' required>";
                        echo "<option value=''>Choose Option</option>";
          				while ($row2 = $result2->fetch_assoc()) {
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



                    echo "<script>
                       
                        (function() {
                            'use strict';
                            window.addEventListener('load', function() {
                                var forms = document.getElementsByClassName('needs-validation');
                                var validation = Array.prototype.filter.call(forms, function(form) {
                                    form.addEventListener('submit', function(event) {
                                        if (form.checkValidity() === false) {
                                            event.preventDefault();
                                            event.stopPropagation();
                                        }
                                        form.classList.add('was-validated');
                                    }, false);
                                });
                            }, false);
                        })();
                    

                    </script>";



					echo "</div>";
				} else {
					$_SESSION["message"] = "Error! Could not find Student.";
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