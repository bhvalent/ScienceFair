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
     
  	    if ((isset($_POST["score"]) && $_POST["score"] !== "") && (isset($_GET['id']) && $_GET['id'] != "") && (isset($_GET['rid']) && $_GET['rid'] != "") && (isset($_GET['sjid']) && $_GET['sjid'] != "") && (isset($_GET['snum']) && $_GET['snum'] != "")) {

    		$RID = $_GET['rid'];
            $ID = $_GET['id'];

            $query = "Select LName, FName, Score1, Score2 from Registration where RegistrationID = ".$RID;
            $result = $mysqli->query($query);
            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if ($row['Score1'] === null && $row['Score2'] === null) {

                    $query = "Update Registration ";
                    $query .= "set Score1 = ".$_POST['score']." ";
                    $query .= "where RegistrationID = ".$RID;

                    $result = $mysqli->query($query);
                    if ($result) {
                        $_SESSION["message"] = "Score Added";
                        header("Location: readScoreCardDetails.php?id=".$ID."&sjid=".$_GET['sjid']."&snum=".$_GET['snum']);
                        exit;
                    } else {
                        $_SESSION["message"] = "Error! Score could not be added!";
                        header("Location: readScoreCardDetails.php?id=".$ID."&sjid=".$_GET['sjid']."&snum=".$_GET['snum']);
                        exit;
                    }

                } elseif ($row['Score1'] !== null && $row['Score2'] === null) {

                    $total = $row['Score1'] + $_POST['score'] / 2;

                    $query = "Update Registration ";
                    $query .= "set Score2 = ".$_POST['score'].", ";
                    $query .= "Total = ".$total." ";
                    $query .= "where RegistrationID = ".$RID;

                    $result = $mysqli->query($query);
                    if ($result) {
                        $_SESSION["message"] = "Score Added";
                        header("Location: readScoreCardDetails.php?id=".$ID."&sjid=".$_GET['sjid']."&snum=".$_GET['snum']);
                        exit;
                    } else {
                        $_SESSION["message"] = "Error! Score could not be added!";
                        header("Location: readScoreCardDetails.php?id=".$ID."&sjid=".$_GET['sjid']."&snum=".$_GET['snum']);
                        exit;
                    }

                } elseif ($row['Score1'] === null && $row['Score2'] !== null) {

                    $total = ($row['Score2'] + $_POST['score']) / 2;

                    $query = "Update Registration ";
                    $query .= "set Score1 = ".$_POST['score'].", ";
                    $query .= "Total = ".$total." ";
                    $query .= "where RegistrationID = ".$RID;

                    $result = $mysqli->query($query);
                    if ($result) {
                        $_SESSION["message"] = "Score Added";
                        header("Location: readScoreCardDetails.php?id=".$ID."&sjid=".$_GET['sjid']."&snum=".$_GET['snum']);
                        exit;
                    } else {
                        $_SESSION["message"] = "Error! Score could not be added!";
                        header("Location: readScoreCardDetails.php?id=".$ID."&sjid=".$_GET['sjid']."&snum=".$_GET['snum']);
                        exit;
                    }

                } else {
                    $_SESSION["message"] = "Error! Both Scores are already set!";
                    header("Location: readScoreCardDetails.php?id=".$ID."&sjid=".$_GET['sjid']."&snum=".$_GET['snum']);
                    exit;
                }
            } else {
                $_SESSION["message"] = "Error! Could not find student!";
                header("Location: readScoreCardDetails.php?id=".$ID."&sjid=".$_GET['sjid']."&snum=".$_GET['snum']);
                exit;
            }


        } else {
        	$_SESSION["message"] = "Unable to add Score. Fill in all information!";
          	header("Location: FairHome.php?id=".$ID);
          	exit;	
        }
    } else {

      	if ((isset($_GET['id']) && $_GET['id'] != "") && (isset($_GET['rid']) && $_GET['rid'] != "") && (isset($_GET['sjid']) && $_GET['sjid'] != "") && (isset($_GET['snum']) && $_GET['snum'] != "")) {
      		$ID = $_GET['id'];
            $RID = $_GET['rid'];

      		$query = "Select * from Fair where FairID = ".$ID;

            $result = $mysqli->query($query);
            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                new_header($row['FairName']." ".$row['Year'], $ID);
                $fairNameYear = $row['FairName']." ".$row['Year'];

                $query = "Select * from Registration inner join Class on FKClassID = ClassID where RegistrationID = ".$RID;

                $result = $mysqli->query($query);
                if ($result && $result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    echo "<br /><br />";
                    echo "<div class='row justify-content-center'";
                    echo "<head>";
                    //echo "<h3>Add Category:</h3>";
                    echo "<h3 class='d-none d-md-block'>Add Score:</h3>";
                    echo "<h5 class='d-md-none'>Add Score:</h5>";
                    echo "</head>";
                    echo "</div>";
                    echo "<br />";
                

                    echo "<div class='row justify-content-center'>";
                    echo "<p><b>Name: </b>&emsp;".$row['FName']." ".$row['LName']."</p>";
                    echo "</div>";

                    echo "<div class='row justify-content-center'>";
                    echo "<p><b>Project Title: </b>&emsp;".$row['ProjTitle']."</p>";
                    echo "</div>";

                    echo "<div class='row justify-content-center'>";
                    echo "<p><b>Project Number: </b>&emsp;".$row['RegistrationID']."</p>";
                    echo "</div>";

                    echo "<div class='row justify-content-center'>";
                    echo "<p><b>Class: </b>&emsp;".$row['Class']."</p>";
                    echo "</div>";
                    
                    //echo "<br /><br />";

                    echo "<div class='container'>";
                    echo "<div class='row justify-content-center'>";
                    echo "<div class='col-xs-12 col-sm-12 col-md-8 col-lg-6'>";

                    echo "<form method='POST' action='addScore.php?id=".$ID."&rid=".$RID."&sjid=".$_GET['sjid']."&snum=".$_GET['snum']."'>";

                    echo "<div class='form-row'>";
                    echo "<div class='form-group col'>";
                    echo "<label>Score:</label>";
                    echo "<input type='number' class='form-control' id='score' name='score' placeholder='100'>";
                    //echo "<small id='cidHelp' class=form-text text-muted'>Make sure ID is unique compared to the other ID's</small>";
                    echo "</div>";
          //        echo "<div class='form-group col'>";
          //        echo "<label>Category Description:</label>";
          //        echo "<input type='text' class='form-control' id='description' name='description' placeholder='Description'>";
          //        echo "</div>";
                    echo "</div>";


                    echo "<br />";
                    echo "<button type='submit' name='submit' class='btn btn-primary btn-block'>Submit</button>";
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
