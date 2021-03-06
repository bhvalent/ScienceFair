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
		
		if ((isset($_POST['judge']) && $_POST['judge'] !== "") && (isset($_POST['student']) && $_POST['student'] !== "") && (isset($_POST['setNumber']) && $_POST['setNumber'] !== "") && (isset($_GET['id']) && $_GET['id'] != "") && (isset($_GET['cid']) && $_GET['cid'] != "")) {

			$ID = $_GET['id'];
			$CID = $_GET['cid'];

			$query = "Insert into JudgeRegistrant(FKSetJudgeID, FKRegistrationID, SetNumber) ";
			$query .= "Value(".$_POST['judge'].", ".$_POST['student'].", ".$_POST['setNumber'].")";

			$result = $mysqli->query($query);
			if ($result) {
				$_SESSION["message"] = "Set has been added.";
	            header("Location: addSets.php?id=".$ID."&cid=".$CID);
	            exit;
			} else {
				$_SESSION["message"] = "Error! Set could not be added.";
	            header("Location: FairHome.php?id=".$ID);
	            exit;
			}

		} else {
			$_SESSION["message"] = "Error! Fill in all information.";
	        header("Location: SFindex.php");
	        exit;
		}








	} else {
		if ((isset($_GET['id']) && $_GET['id'] != "") && (isset($_GET['cid']) && $_GET['cid'] != "")) {
			$ID = $_GET['id'];
			$CID = $_GET['cid'];
			$query1 = "Select * from Fair where FairID = ".$ID;

			$result = $mysqli->query($query1);
			if ($result && $result->num_rows > 0) {
				$row = $result->fetch_assoc();
				new_header($row['FairName']." ".$row['Year'], $ID);


				$query = "Select LName, FName, Description from SetJudge ";
				$query .= "inner join Judge on FKJudgeID = JudgeID ";
				$query .= "inner join Category on FKCategoryID = CategoryID ";
				$query .= "inner join Fair on FKFairID = FairID ";
				$query .= "where FairID = ".$ID." and CategoryID = ".$CID." order by LName";

				$result = $mysqli->query($query);
				echo "<div class='container-fluid'>";
				echo "<br /><br />";
				echo "<div class='row'>";

				echo "<div class='col-4 text-center'>";
				if ($result) {
					

					echo "<head>";
					echo "<h3 class='d-none d-md-block'>Judges</h3>";
		            echo "<h5 class='d-md-none'>Judges</h5>";
		            echo "</head>";
		            
		            

		            echo "<div class='table-responsive'>";
					echo "<table class='table table-bordered table-hover'>";
					echo "<thead class='thead-dark text-center'>";
					echo "<tr>";
					echo "<th scope='col'>Last Name</th>";
					echo "<th scope='col'>First Name</th>";
					echo "<th scope='col'>Category</th>";
					echo "</tr>";
					echo "</thead>";
					echo "<tbody>";
					while ($row = $result->fetch_assoc()) {
						echo "<tr>";
						echo "<td class='text-center'>".$row['LName']."</td>";
						echo "<td class='text-center'>".$row['FName']."</td>";
						echo "<td class='text-center'>".$row['Description']."</td>";
						echo "</tr>";
					}
					echo "</tbody>";
					echo "</table>";
					echo "</div>";

					
				} else {
					$_SESSION["message"] = "Error! Judges could not be found.";
	            	header("Location: FairHome.php?id=".$ID);
	            	exit;
				}

				echo "<br /><br /><br />";

				$query = "Select distinct FairID, SetJudgeID, LName, FName, Description, SetNumber ";
				$query .= "from JudgeRegistrant ";
				$query .= "inner join SetJudge on FKSetJudgeID = SetJudgeID ";
				$query .= "inner join Judge on FKJudgeID = JudgeID ";
				$query .= "inner join Category on FKCategoryID = CategoryID ";
				$query .= "inner join Fair on FKFairID = FairID ";
				$query .= "where FairID = ".$ID." and CategoryID = ".$CID." order by LName";

				$result = $mysqli->query($query);
				if ($result) {

					echo "<head>";
					echo "<h3 class='d-none d-md-block'>Judges with Sets</h3>";
		            echo "<h5 class='d-md-none'>Judges with Sets</h5>";
		            echo "</head>";

		            echo "<div class='table-responsive'>";
					echo "<table class='table table-bordered table-hover'>";
					echo "<thead class='thead-dark text-center'>";
					echo "<tr>";
					echo "<th scope='col'>Last Name</th>";
					echo "<th scope='col'>First Name</th>";
					echo "<th scope='col'>Category</th>";
					echo "<th scope='col'>Set Number</th>";
					echo "</tr>";
					echo "</thead>";
					echo "<tbody>";
					while ($row = $result->fetch_assoc()) {
						echo "<tr>";
						echo "<td class='text-center'>".$row['LName']."</td>";
						echo "<td class='text-center'>".$row['FName']."</td>";
						echo "<td class='text-center'>".$row['Description']."</td>";
						echo "<td class='text-center'>".$row['SetNumber']."</td>";
						echo "</tr>";
					}
					echo "</tbody>";
					echo "</table>";
					echo "</div>";

				} else {
					$_SESSION["message"] = "Error! Judges could not be found.";
	            	header("Location: FairHome.php?id=".$ID);
	            	exit;
				}

				echo "</div>";
				












				echo "<div class='col-4'>";
				echo "<form name='addform' method='POST' class='needs-validation' action='addSets.php?id=".$ID."&cid=".$CID."' novalidate>";
                
                // Judge
                $query = "Select SetJudgeID, LName, FName, Description from SetJudge ";
				$query .= "inner join Judge on FKJudgeID = JudgeID ";
				$query .= "inner join Category on FKCategoryID = CategoryID ";
				$query .= "inner join Fair on FKFairID = FairID ";
				$query .= "where FairID = ".$ID." and CategoryID = ".$CID." order by LName";
                $result = $mysqli->query($query);
                if ($result && $result->num_rows > 0) {

                    echo "<div class='form-row'>";
                    echo "<div class='form-group col'>";
                    echo "<label>Judge:</label>";
                    echo "<select class='form-control' id='judge' name='judge' required>";
                    echo "<option value=''>Choose Option</option>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='".$row['SetJudgeID']."'>".$row['FName']." ".$row['LName'].", ".$row['Description']."</option>";
                    }
                    echo "</select>";
                    echo "</div>";
                    echo "</div>";

                } else {
                    echo "<h2>Class not Available</h2>";
                }

                // Student
                $query = "Select RegistrationID, LName, FName, Class, Description from Registration ";
				$query .= "inner join Category on FKCategoryID = CategoryID ";
				$query .= "inner join Fair on FKFairID = FairID ";
				$query .= "inner join Class on FKClassID = ClassID ";
				$query .= "where FairID = ".$ID." and CategoryID = ".$CID." order by LName and Class";
                $result = $mysqli->query($query);
                if ($result && $result->num_rows > 0) {

                    echo "<div class='form-row'>";
                    echo "<div class='form-group col'>";
                    echo "<label>Student:</label>";
                    echo "<select class='form-control' id='student' name='student' required>";
                    echo "<option value=''>Choose Option</option>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='".$row['RegistrationID']."'>".$row['FName']." ".$row['LName'].", Class: ".$row['Class'].", ".$row['Description']."</option>";
                    }
                    echo "</select>";
                    echo "</div>";
                    echo "</div>";

                } else {
                    echo "<h2>Class not Available</h2>";
                }

                // SetNumber
                echo "<div class='form-row'>";
                echo "<div class='form-group col'>";
                echo "<label>Set Number:</label>";
                echo "<input type='number' class='form-control' id='setNumber' name='setNumber' placeholder='0' required>";
                echo "<div class='invalid-feedback'>Put Set Number!</div>";
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













				$query = "Select LName, FName, Class, Description from Registration ";
				$query .= "inner join Category on FKCategoryID = CategoryID ";
				$query .= "inner join Fair on FKFairID = FairID ";
				$query .= "inner join Class on FKClassID = ClassID ";
				$query .= "where FairID = ".$ID." and CategoryID = ".$CID." order by LName and Class";
				
				$result = $mysqli->query($query);


				echo "<div class='col-4 text-center'>";
				if ($result) {
					
					
					echo "<head>";
					echo "<h3 class='d-none d-md-block'>Students</h3>";
		            echo "<h5 class='d-md-none'>Students</h5>";
		            echo "</head>";

		            echo "<div class='table-responsive'>";
					echo "<table class='table table-bordered table-hover'>";
					echo "<thead class='thead-dark text-center'>";
					echo "<tr>";
					echo "<th scope='col'>Last Name</th>";
					echo "<th scope='col'>First Name</th>";
					echo "<th scope='col'>Class</th>";
					echo "<th scope='col'>Category</th>";
					echo "</tr>";
					echo "</thead>";
					echo "<tbody>";
					while ($row = $result->fetch_assoc()) {
						echo "<tr>";
						echo "<td class='text-center'>".$row['LName']."</td>";
						echo "<td class='text-center'>".$row['FName']."</td>";
						echo "<td class='text-center'>".$row['Class']."</td>";
						echo "<td class='text-center'>".$row['Description']."</td>";
						echo "</tr>";
					}
					echo "</tbody>";
					echo "</table>";
					echo "</div>";

					

					
				} else {
					$_SESSION["message"] = "Error! Students could not be found.";
	            	header("Location: FairHome.php?id=".$ID);
	            	exit;
				}

				echo "<br /><br /><br />";


				$query = "Select FairID, RegistrationID, Registration.LName as `LName`, ";
				$query .= "Registration.FName as `FName`, Class, Description, SetNumber, ";
				$query .= "CONCAT(Judge.FName, ' ', Judge.LName) as `JudgeName` ";
				$query .= "from JudgeRegistrant ";
				$query .= "inner join Registration on FKRegistrationID = RegistrationID ";
				$query .= "inner join Category on FKCategoryID = CategoryID ";
				$query .= "inner join Fair on FKFairID = FairID ";
				$query .= "inner join Class on FKClassID = ClassID ";
				$query .= "inner join SetJudge on FKSetJudgeID = SetJudgeID ";
				$query .= "inner join Judge on FKJudgeID = JudgeID ";
				$query .= "where FairID = ".$ID." and CategoryID = ".$CID." order by LName";

				$result = $mysqli->query($query);

				if ($result) {

					echo "<head>";
					echo "<h3 class='d-none d-md-block'>Students with Sets</h3>";
		            echo "<h5 class='d-md-none'>Students with Sets</h5>";
		            echo "</head>";

		            echo "<div class='table-responsive'>";
					echo "<table class='table table-bordered table-hover'>";
					echo "<thead class='thead-dark text-center'>";
					echo "<tr>";
					echo "<th scope='col'>Last Name</th>";
					echo "<th scope='col'>First Name</th>";
					echo "<th scope='col'>Class</th>";
					echo "<th scope='col'>Category</th>";
					echo "<th scope='col'>Set Number</th>";
					echo "<th scope='col'>Judge</th>";
					echo "</tr>";
					echo "</thead>";
					echo "<tbody>";
					while ($row = $result->fetch_assoc()) {
						echo "<tr>";
						echo "<td class='text-center'>".$row['LName']."</td>";
						echo "<td class='text-center'>".$row['FName']."</td>";
						echo "<td class='text-center'>".$row['Class']."</td>";
						echo "<td class='text-center'>".$row['Description']."</td>";
						echo "<td class='text-center'>".$row['SetNumber']."</td>";
						echo "<td class='text-center'>".$row['JudgeName']."</td>";
						echo "</tr>";
					}
					echo "</tbody>";
					echo "</table>";
					echo "</div>";

				} else {
					$_SESSION["message"] = "Error! Students could not be found.";
	            	header("Location: FairHome.php?id=".$ID);
	            	exit;
				}



				echo "</div>";
				echo "</div>";
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