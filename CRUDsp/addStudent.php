<?php 
      require_once("session.php");
?>

<DOCTYPE! html>
<html lang="en">

<?php 
    verifyLogIn();
    require_once("included_functions.php");
      $mysqli = db_connection();
    if (($output = message()) !== null) {
        echo $output;
    }
    if (isset($_POST['submit'])) {
    
        if ( (isset($_POST["projTitle"]) && $_POST["projTitle"] !== "") && (isset($_POST["fname"]) && $_POST["fname"] !== "") && (isset($_POST["lname"]) && $_POST["lname"] !== "") && (isset($_POST["age"]) && $_POST["age"] !== "") && (isset($_POST["genderRadioOptions"]) && $_POST["genderRadioOptions"] !== "") && (isset($_POST["city"]) && $_POST["city"] !== "") && (isset($_POST["state"]) && $_POST["state"] !== "") && (isset($_POST["zip"]) && $_POST["zip"] !== "") && (isset($_POST["school"]) && $_POST["school"] !== "") && (isset($_POST["adultSponsor"]) && $_POST["adultSponsor"] !== "") && (isset($_POST["class"]) && $_POST["class"] !== "") && (isset($_POST["continuation"]) && $_POST["continuation"] !== "") && (isset($_POST["work"]) && $_POST["work"] !== "") && (isset($_POST["wheelchair"]) && $_POST["wheelchair"] !== "") ) {

            $ID = $_GET['id'];

                
            echo $_POST['fname']." ".$_POST['lname'];

                
            $query = "Insert into Registration ";
            $query .= "(LName, FName, ProjTitle, Age, Gender, Continuation, NumYears, WheelchairAccess, City, State, Zip, AdultSponsor, FKFairID, FKSchoolID, FKCategoryID, FKClassID) ";
            $query .= "VALUES(";
            $query .= "'".$_POST['lname']."', ";
            $query .= "'".$_POST['fname']."', ";
            $query .= "'".$_POST['projTitle']."', ";
            $query .= $_POST['age'].", ";
            $query .= "'".$_POST['genderRadioOptions']."', ";
            $query .= "'".$_POST['continuation']."', ";
            $query .= $_POST['work'].", ";
            $query .= "'".$_POST['wheelchair']."', ";
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

                $query2 = "Select RegistrationID from Registration where ";
                $query2 .= "LName = '".$_POST['lname']."' and ";
                $query2 .= "FName = '".$_POST['fname']."' and ";
                $query2 .= "ProjTitle = '".$_POST['projTitle']."' and ";
                $query2 .= "AdultSponsor = '".$_POST['adultSponsor']."' and ";
                $query2 .= "FKFairID = ".$ID;

                $result2 = $mysqli->query($query2);
                if ($result2 && $result2->num_rows > 0) {
                    
                    if (($row2 = $result2->fetch_assoc()) !== null) {
                        $_SESSION["message"] = "".$_POST["fname"]." ".$_POST["lname"]." has been added";
                        header("Location: addMoreTM.php?id=".$ID."&rid=".$row2['RegistrationID']);
                        exit;
                    }
                    
                } else {
                    $_SESSION["message"] = "".$_POST["fname"]." ".$_POST["lname"]." has been added";
                    header("Location: FairHome.php?id=".$ID);
                    exit;
                }



                
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
                echo "<h3 class='d-none d-md-block'>Add Project: <i>".$fairNameYear."</i></h3>";
                echo "<h5 class='d-md-none'>Add Project: <i>".$fairNameYear."</i></h5>";

                echo "<script type='text/javascript'>";

                

                echo "</script>";

                echo "</head>";
                echo "</div>";
                echo "<br /><br />";
                echo "<div class='container'>";
        
                
                echo "<form method='POST' name='addForm' class='needs-validation' action='addStudent.php?id=".$ID."' novalidate>";

                

                // Project title
                echo "<div class='form-row'>";
                echo "<div class='form-group col'>";
                echo "<label>Project Title</label>";
                echo "<input type='text' class='form-control' id='projTitle' name='projTitle' placeholder='Project Title' required>";
                echo "<div class='invalid-feedback'>Put Project Title!</div>";
                echo "</div>";
                echo "</div>";

                // first and last name
                echo "<div class='form-row'>";
                echo "<div class='form-group col'>";
                echo "<label>First Name:</label>";
                echo "<input type='text' class='form-control' id='fname' name='fname' placeholder='First name' required>";
                echo "<div class='invalid-feedback'>Put First Name!</div>";
                echo "</div>";
                echo "<div class='form-group col'>";
                echo "<label>Last Name:</label>";
                echo "<input type='text' class='form-control' id='lname' name='lname' placeholder='Last name' required>";
                echo "<div class='invalid-feedback'>Put Last Name!</div>";
                echo "</div>";
                echo "</div>";

                // Age and Gender
                echo "<div class='form-row'>";
                echo "<div class='form-group col-6'";
                echo "<label>Age:</label>";
                echo "<input type='number' class='form-control' placeholder='12' id='age' name='age' required>";
                echo "<div class='invalid-feedback'>Put Age!</div>";
                echo "</div>";

                echo "<div class='form-check form-check-inline'>";
                echo "<input class='form-check-input' type='radio' name='genderRadioOptions' id='inlineRadio1' value='Male' required>";
                echo "<label class='form-check-label' for='inlineRadio1'>Male</label>";
                echo "<div class='invalid-feedback'>&nbsp;Choose Gender!</div>";
                echo "</div>";

                echo "<div class='form-check form-check-inline'>";
                echo "<input class='form-check-input' type='radio' name='genderRadioOptions' id='inlineRadio2' value='Female' required>";
                echo "<label class='form-check-label' for='inlineRadio2'>Female</label>";
                echo "<div class='invalid-feedback'>&nbsp;Choose Gender!</div>";
                echo "</div>";
                echo "</div>";

                // Continuation, number of years, wheelchair access
                echo "<div class='form-row'>";

                echo "<div class='form-group col-2'";
                echo "<label>Continuation: </label>";
                echo "<br />";
                echo "<div class='form-check form-check-inline'>";
                echo "<input class='form-check-input' type='radio' name='continuation' id='cRadio1' value='Yes' required>";
                echo "<label class='form-check-label' for='cRadio1'>Yes</label>";
                echo "<div class='invalid-feedback'>&nbsp;Choose Option!</div>";
                echo "</div>";
                echo "<div class='form-check form-check-inline'>";
                echo "<input class='form-check-input' type='radio' name='continuation' id='cRadio2' value='No' required>";
                echo "<label class='form-check-label' for='cRadio2'>No</label>";
                echo "<div class='invalid-feedback'>&nbsp;Choose Option!</div>";
                echo "</div>";
                echo "</div>";

                echo "<div class='form-group col-4'";
                echo "<label>Years of Work: </label>";
                echo "<input type='number' class='form-control' placeholder='0' id='work' name='work' required>";
                echo "<div class='invalid-feedback'>Put Number of Years!</div>";
                echo "</div>";

                echo "<div class='form-group col-3'";
                echo "<label>Wheelchair Access Needed: </label>";
                echo "<br />";
                echo "<div class='form-check form-check-inline'>";
                echo "<input class='form-check-input' type='radio' name='wheelchair' id='wRadio1' value='Yes' required>";
                echo "<label class='form-check-label' for='wRadio1'>Yes</label>";
                echo "<div class='invalid-feedback'>&nbsp;Choose Option!</div>";
                echo "</div>";
                echo "<div class='form-check form-check-inline'>";
                echo "<input class='form-check-input' type='radio' name='wheelchair' id='wRadio2' value='No' required>";
                echo "<label class='form-check-label' for='wRadio2'>No</label>";
                echo "<div class='invalid-feedback'>&nbsp;Choose Option!</div>";
                echo "</div>";
                echo "</div>";

                echo "</div>";

                // city, state, and zip code
                echo "<div class='form-row'>";
                echo "<div class='form-group col'>";
                echo "<label>City:</label>";
                echo "<input type='text' class='form-control' id='city' name='city' placeholder='City' required>";
                echo "<div class='invalid-feedback'>Put City!</div>";
                echo "</div>";
                echo "<div class='form-group col'>";
                echo "<label>State Abbreviation (e.g. MS):</label>";
                echo "<input type='text' class='form-control' id='state' name='state' placeholder='State' required>";
                echo "<div class='invalid-feedback'>Put State!</div>";
                echo "</div>";
                echo "<div class='form-group col'>";
                echo "<label>Zip Code:</label>";
                echo "<input type='number' class='form-control' id='zip' name='zip' placeholder='12345' required>";
                echo "<div class='invalid-feedback'>Put Zip!</div>";
                echo "</div>";
                echo "</div>";

                // Adult Sponsor
                echo "<div class='form-row'>";
                echo "<div class='form-group col'>";
                echo "<label>Adult Sponsor Name</label>";
                echo "<input type='text' class='form-control' id='adultSponsor' name='adultSponsor' placeholder='Name' required>";
                echo "<div class='invalid-feedback'>Put Sponsor Name!</div>";
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
                    echo "<select class='form-control' id='school' name='school' required>";
                    echo "<option value=''>Choose Option</option>";
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
                    echo "<select class='form-control' id='category' name='category' required>";
                    echo "<option value=''>Choose Option</option>";
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
                    echo "<select class='form-control' id='class' name='class' required>";
                    echo "<option value=''>Choose Option</option>";
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

                

                // var a = forms.getElementsByName('age');
                // if (!Number.isInteger(a)) {
                //     event.preventDefault();
                //     event.stopPropagation();
                // }

                // elseif (!Number.isInteger(form.getElementByName('age'))) {
                //             event.preventDefault();
                //             event.stopPropagation();
                //         }

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
