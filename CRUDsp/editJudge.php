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
    if (isset($_POST["submit"])) {
     
        if ((isset($_POST["fname"]) && $_POST["fname"] !== "") && (isset($_POST["lname"]) && $_POST["lname"] !== "") && (isset($_POST["email"]) && $_POST["email"] !== "") && (isset($_POST["category"]) && $_POST["category"] !== "")) {

            $ID = $_GET['id'];

            $query = "select * from SetJudge inner join Judge on FKJudgeID = JudgeID where SetJudgeID = ".$_GET['sjid'];
                $result = $mysqli->query($query);
                if ($result && $result->num_rows > 0) {
                    $row = $result->fetch_assoc();

                    $query = "Update Judge set ";
                    $query .= "LName = '".$_POST['lname']."', ";
                    $query .= "FName = '".$_POST['fname']."', ";
                    $query .= "Email = '".$_POST['email']."' ";
                    $query .= "where JudgeID = ".$row['JudgeID'];

                    $result = $mysqli->query($query);
                    if ($result) {

                        $query = "Update SetJudge set ";
                        $query .= "FKCategoryID = ".$_POST['category']." ";
                        $query .= "where SetJudgeID = ".$_GET['sjid'];

                        $result = $mysqli->query($query);
                        if ($result) {
                            $_SESSION["message"] = $_POST["fname"]." ".$_POST['lname']." has been updated";
                            header("Location: FairHome.php?id=".$ID);
                            exit;
                        } else {
                            $_SESSION["message"] = "Error! The category for ".$_POST["fname"]." ".$_POST['lname']." could not be updated";
                            header("Location: FairHome.php?id=".$ID);
                            exit;
                        }

                        
                    } else {
                        $_SESSION["message"] = "Error! ".$_POST["fname"]." ".$_POST['lname']." could not be updated";
                        header("Location: FairHome.php?id=".$ID);
                        exit;
                    }

                } else {
                    $_SESSION["message"] = "Error! Judge could not be found.";
                    header("Location: FairHome.php?id=".$ID);
                    exit;
                }

            



        } else {
            $_SESSION["message"] = "Unable to update Category. Fill in all information!";
            header("Location: FairHome.php?id=".$ID);
            exit; 
        }
    } else {

        if ((isset($_GET['id']) && $_GET['id'] != "") && (isset($_GET['sjid']) && $_GET['sjid'] != "")) {
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
                //echo "<h3>Edit Category:</h3>";
                echo "<h3 class='d-none d-md-block'>Edit Judge:</h3>";
                echo "<h5 class='d-md-none'>Edit Judge:</h5>";
                echo "</head>";
                echo "</div>";
                echo "<br /><br />";

                $query = "select * from SetJudge inner join Judge on FKJudgeID = JudgeID where SetJudgeID = ".$_GET['sjid'];
                $result = $mysqli->query($query);
                if ($result && $result->num_rows > 0) {
                    $row = $result->fetch_assoc();

                    echo "<div class='container'>";
                
                    echo "<form name='addform' method='POST' class='needs-validation' action='editJudge.php?id=".$ID."&sjid=".$_GET['sjid']."' novalidate>";
        
                    
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
                    echo "<div class='invalid-feedback'>Put Last Name!</div>";
                    echo "</div>";
                    echo "</div>";

                    // email
                    echo "<div class='form-row'>";
                    echo "<div class='form-group col'>";
                    echo "<label>Email:</label>";
                    echo "<input type='text' class='form-control' id='email' name='email' value='".$row['Email']."' required>";
                    echo "<div class='invalid-feedback'>Put Email!</div>";
                    echo "</div>";
                    echo "</div>";

                    // category
                    $query = "Select * from Category";
                    $result2 = $mysqli->query($query);
                    if ($result2 && $result->num_rows > 0) {

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
                    $_SESSION["message"] = "Error! Judge could not be found.";
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