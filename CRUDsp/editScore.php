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
     
  	    if ((isset($_POST["score"]) && $_POST["score"] !== "") && (isset($_GET['id']) && $_GET['id'] != "") && (isset($_GET['rid']) && $_GET['rid'] != "") && (isset($_GET['sjid']) && $_GET['sjid'] != "") && (isset($_GET['snum']) && $_GET['snum'] != "") && (isset($_GET['type']) && $_GET['type'] != "")) {

    		$RID = $_GET['rid'];
            $ID = $_GET['id'];

            $query = "Select LName, FName, Score1, Score2, Total from Registration where RegistrationID = ".$RID;
            $result = $mysqli->query($query);
            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if ($_GET['type'] === '1') {

                    if ($row['Score2'] !== null) {
                        $total = ($row['Score2'] + $_POST['score']) / 2;

                        $query = "Update Registration ";
                        $query .= "set Score1 = ".$_POST['score'].", ";
                        $query .= "Total = ".$total." ";
                        $query .= "where RegistrationID = ".$RID;
                    } else {
                        $query = "Update Registration ";
                        $query .= "set Score1 = ".$_POST['score']." ";
                        $query .= "where RegistrationID = ".$RID;
                    }
                    

                    $result = $mysqli->query($query);
                    if ($result) {
                        $_SESSION["message"] = "Score Updated";
                        header("Location: readScoreCardDetails.php?id=".$ID."&sjid=".$_GET['sjid']."&snum=".$_GET['snum']);
                        exit;
                    } else {
                        $_SESSION["message"] = "Error! Score could not be updated!";
                        header("Location: readScoreCardDetails.php?id=".$ID."&sjid=".$_GET['sjid']."&snum=".$_GET['snum']);
                        exit;
                    }

                } else {

                    if ($row['Score1'] !== null) {
                        $total = ($row['Score1'] + $_POST['score']) / 2;

                        $query = "Update Registration ";
                        $query .= "set Score2 = ".$_POST['score'].", ";
                        $query .= "Total = ".$total." ";
                        $query .= "where RegistrationID = ".$RID;
                    } else {
                        $query = "Update Registration ";
                        $query .= "set Score2 = ".$_POST['score']." ";
                        $query .= "where RegistrationID = ".$RID;
                    }

        
                    $result = $mysqli->query($query);
                    if ($result) {
                        $_SESSION["message"] = "Score Updated";
                        header("Location: readScoreCardDetails.php?id=".$ID."&sjid=".$_GET['sjid']."&snum=".$_GET['snum']);
                        exit;
                    } else {
                        $_SESSION["message"] = "Error! Score could not be updated!";
                        header("Location: readScoreCardDetails.php?id=".$ID."&sjid=".$_GET['sjid']."&snum=".$_GET['snum']);
                        exit;
                    }

                } 
            } else {
                $_SESSION["message"] = "Error! could not find student!";
                header("Location: readScoreCardDetails.php?id=".$ID."&sjid=".$_GET['sjid']."&snum=".$_GET['snum']);
                exit;
            }


        } else {
        	$_SESSION["message"] = "Unable to update Score. Fill in all information!";
          	header("Location: FairHome.php?id=".$ID);
          	exit;	
        }
    } else {

      	if ((isset($_GET['id']) && $_GET['id'] != "") && (isset($_GET['rid']) && $_GET['rid'] != "") && (isset($_GET['sjid']) && $_GET['sjid'] != "") && (isset($_GET['snum']) && $_GET['snum'] != "") && (isset($_GET['type']) && $_GET['type'] != "")) {
      		$ID = $_GET['id'];
            $RID = $_GET['rid'];

      		$query = "Select * from Fair where FairID = ".$ID;

            $result = $mysqli->query($query);
            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                new_header($row['FairName']." ".$row['Year'], $ID);
                $fairNameYear = $row['FairName']." ".$row['Year'];


                $query = "Select CONCAT(FName, ' ', LName) as `Name` from TeamMembers where FKRegistrationID = ".$RID;

                $result = $mysqli->query($query);
                $tMems = "";
                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        if ($tMems === "") {
                            $tMems = $row['Name'];
                        } else {
                            $tMems .= ", ".$row['Name']; 
                        }
                    }
                }



                $query = "Select * from Registration inner join Class on FKClassID = ClassID where RegistrationID = ".$RID;

                $result = $mysqli->query($query);
                if ($result && $result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    echo "<br /><br />";
                    echo "<div class='row justify-content-center'";
                    echo "<head>";
                    //echo "<h3>Add Category:</h3>";
                    echo "<h3 class='d-none d-md-block'>Edit Score:</h3>";
                    echo "<h5 class='d-md-none'>Edit Score:</h5>";
                    echo "</head>";
                    echo "</div>";
                    echo "<br />";
                
                    if ($tMems !== "") {
                        echo "<div class='row justify-content-center'>";
                        echo "<p><b>Name: </b>&emsp;".$row['FName']." ".$row['LName'].", ".$tMems."</p>";
                        echo "</div>";
                    } else {
                        echo "<div class='row justify-content-center'>";
                        echo "<p><b>Name: </b>&emsp;".$row['FName']." ".$row['LName']."</p>";
                        echo "</div>";
                    }
                    

                    echo "<div class='row justify-content-center'>";
                    echo "<p><b>Project Title: </b>&emsp;".$row['ProjTitle']."</p>";
                    echo "</div>";

                    echo "<div class='row justify-content-center'>";
                    echo "<p><b>Project Number: </b>&emsp;".$row['RegistrationID']."</p>";
                    echo "</div>";

                    echo "<div class='row justify-content-center'>";
                    echo "<p><b>Class: </b>&emsp;".$row['Class']."</p>";
                    echo "</div>";

                    echo "<div class='container'>";
                    echo "<div class='row justify-content-center'>";
                    echo "<div class='col-xs-12 col-sm-12 col-md-8 col-lg-6'>";
                    echo "<form method='POST' class='needs-validation' action='editScore.php?id=".$ID."&rid=".$RID."&sjid=".$_GET['sjid']."&snum=".$_GET['snum']."&type=".$_GET['type']."' novalidate>";

                    echo "<div class='form-row'>";
                    echo "<div class='form-group col'>";
                    echo "<label>Score:</label>";
                    if ($_GET['type'] === '1' && $row['Score1'] !== null) {
                        echo "<input type='number' class='form-control' id='score' name='score' value='".$row['Score1']."' required>";
                         echo "<div class='invalid-feedback'>Put Score!</div>";
                    } elseif ($_GET['type'] === '2' && $row['Score2'] !== null) {
                        echo "<input type='number' class='form-control' id='score' name='score' value='".$row['Score2']."' required>";
                         echo "<div class='invalid-feedback'>Put Score!</div>";
                    } else {
                        echo "<input type='number' class='form-control' id='score' name='score' placeholder='' required>";
                         echo "<div class='invalid-feedback'>Put Score!</div>";
                    }
                    
                    //echo "<small id='cidHelp' class=form-text text-muted'>Make sure ID is unique compared to the other ID's</small>";
                    echo "</div>";
          //        echo "<div class='form-group col'>";
          //        echo "<label>Category Description:</label>";
          //        echo "<input type='text' class='form-control' id='description' name='description' placeholder='Description'>";
          //        echo "</div>";
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
                    echo "</div>";
                    echo "</div>";

                } else {
                    $_SESSION["message"] = "Error! Student could not be found.";
                    header("Location: readScoreCardDetails.php?id=".$ID."&sjid=".$_GET['sjid']."&snum=".$_GET['snum']);
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
