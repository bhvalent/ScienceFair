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

            $query = "Update Category set ";
            $query .= "CategoryID = ".$_POST['cid'].", ";
            $query .= "Description = '".$_POST['description']."' ";
            $query .= "where CategoryID = ".$_GET['cid'];

            $result = $mysqli->query($query);
            if ($result) {
                $_SESSION["message"] = $_POST["description"]." has been updated";
                header("Location: FairHome.php?id=".$ID);
                exit;
            } else {
                $_SESSION["message"] = "Error! Could not update ".$_POST["description"].".  Error Message: ".$mysqli->error;
                header("Location: FairHome.php?id=".$ID);
                exit;
            }



        } else {
            $_SESSION["message"] = "Unable to update Category. Fill in all information!";
            header("Location: FairHome.php?id=".$ID);
            exit; 
        }
    } else {

        if ((isset($_GET['id']) && $_GET['id'] != "") && (isset($_GET['cid']) && $_GET['cid'] != "")) {
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
                echo "<h3 class='d-none d-md-block'>Edit Category:</h3>";
                echo "<h5 class='d-md-none'>Edit Category:</h5>";
                echo "</head>";
                echo "</div>";
                echo "<br /><br />";

                $query = "select * from Category where CategoryID = ".$_GET['cid'];
                $result = $mysqli->query($query);
                if ($result && $result->num_rows > 0) {
                    $row = $result->fetch_assoc();

                    echo "<div class='container'>";
                    echo "<form method='POST' class='needs-validation' action='editCategory.php?id=".$ID."&cid=".$row['CategoryID']."' novalidate>";

                    echo "<div class='form-row'>";
                    echo "<div class='form-group col'>";
                    echo "<label>Category ID:</label>";
                    echo "<input type='number' class='form-control' id='cid' name='cid' value='".$row['CategoryID']."' required>";
                    echo "<small id='cidHelp' class=form-text text-muted'>Make sure ID is unique compared to the other ID's</small>";
                    echo "<div class='invalid-feedback'>Put CategoryID!</div>";
                    echo "</div>";
                    echo "<div class='form-group col'>";
                    echo "<label>Category Description:</label>";
                    echo "<input type='text' class='form-control' id='description' name='description' value='".$row['Description']."' required>";
                    echo "<div class='invalid-feedback'>Put Description!</div>";
                    echo "</div>";
                    echo "</div>";


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
                    $_SESSION["message"] = "Error! Category could not be found.";
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
