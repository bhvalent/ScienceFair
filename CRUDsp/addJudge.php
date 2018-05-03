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
        
        if ( (isset($_POST["fname"]) && $_POST["fname"] !== "") && (isset($_POST["lname"]) && $_POST["lname"] !== "") && (isset($_POST["email"]) && $_POST["email"] !== "") && (isset($_POST["category"]) && $_POST["category"] !== "") ) {

            $ID = $_GET['id'];

            $query = "Select * from Judge where LName = '".$_POST['lname']."' and FName = '".$_POST['fname']."' and Email = '".$_POST['email']."'";
            $result = $mysqli->query($query);
            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();

                $query1 = "Insert into SetJudge ";
                $query1 .= "(FKFairID, FKJudgeID, FKCategoryID) ";
                $query1 .= "VALUES(";
                $query1 .= $ID.", ";
                $query1 .= $row['JudgeID'].", ";
                $query1 .= $_POST['category'].")";

                $result1 = $mysqli->query($query1);
                if ($result1) {
                    $_SESSION["message"] = $_POST["fname"]." ".$_POST["lname"]." has been added";
                    header("Location: FairHome.php?id=".$ID);
                    exit;
                } else {
                    $_SESSION["message"] = "Error! Could not add category to ".$_POST["fname"]." ".$_POST["lname"];
                    header("Location: FairHome.php?id=".$ID);
                    exit;
                }

            } else {

                $query2 = "Insert into Judge ";
                $query2 .= "(LName, FName, Email) ";
                $query2 .= "VALUES(";
                $query2 .= "'".$_POST['lname']."', ";
                $query2 .= "'".$_POST['fname']."', ";
                $query2 .= "'".$_POST['email']."')";

                $result2 = $mysqli->query($query2);

                if($result2) {

                    $query3 = "Select * from Judge where LName = '".$_POST['lname']."' and FName = '".$_POST['fname']."' and Email = '".$_POST['email']."'";
                    $result3 = $mysqli->query($query3);
                    if ($result3) {
                        $row = $result3->fetch_assoc();

                        $query = "Insert into SetJudge ";
                        $query .= "(FKFairID, FKJudgeID, FKCategoryID) ";
                        $query .= "VALUES(";
                        $query .= $ID.", ";
                        $query .= $row['JudgeID'].", ";
                        $query .= $_POST['category'].")";

                        $result = $mysqli->query($query);
                        if ($result) {
                            $_SESSION["message"] = $_POST["fname"]." ".$_POST["lname"]." has been added";
                            header("Location: FairHome.php?id=".$ID);
                            exit;
                        } else {
                            $_SESSION["message"] = "Error! Could not add category to ".$_POST["fname"]." ".$_POST["lname"];
                            header("Location: FairHome.php?id=".$ID);
                            exit;
                        }
                    } else {
                        $_SESSION["message"] = "Error! Could not get JudgeID for ".$_POST["fname"]." ".$_POST["lname"];
                        header("Location: FairHome.php?id=".$ID);
                        exit;
                    }

                } else {
                    $_SESSION["message"] = "Error! Could not add ".$_POST["fname"]." ".$_POST["lname"];
                    header("Location: FairHome.php?id=".$ID);
                    exit;
                    
                }
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
                echo "<h3 class='d-none d-md-block'>Add Judge: <i>".$fairNameYear."</i></h3>";
                echo "<h5 class='d-md-none'>Add Judge: <i>".$fairNameYear."</i></h5>";

                //echo "<script type='text/javascript'>";

                //echo "function formValidation() { var title = document.addForm.projTitle;if (title == '') {window.alert( 'Please provide Project Title!' );projTitle.focus();return false;}}";

                //echo "</script>";

                echo "</head>";
                echo "</div>";
                echo "<br /><br />";
                echo "<div class='container'>";
                
                // onsubmit='return formValidation();'
                echo "<form name='addform' method='POST' class='needs-validation' action='addJudge.php?id=".$ID."' novalidate>";
    
                
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

                // email
                echo "<div class='form-row'>";
                echo "<div class='form-group col'>";
                echo "<label>Email:</label>";
                echo "<input type='text' class='form-control' id='email' name='email' placeholder='johndoe123@gmail.com' required>";
                echo "<div class='invalid-feedback'>Put Email!</div>";
                echo "</div>";
                echo "</div>";

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


                echo "<br />";
                echo "<button type='submit' name='submit' class='btn btn-primary btn-block'>Submit</button>";



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
