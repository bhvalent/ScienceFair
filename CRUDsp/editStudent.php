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
	  	if ( (isset($_POST["projTitle"]) && $_POST["projTitle"] !== "") && (isset($_POST["fname"]) && $_POST["fname"] !== "") && (isset($_POST["lname"]) && $_POST["lname"] !== "") && (isset($_POST["age"]) && $_POST["age"] !== "") && (isset($_POST["genderRadioOptions"]) && $_POST["genderRadioOptions"] !== "") && (isset($_POST["city"]) && $_POST["city"] !== "") && (isset($_POST["state"]) && $_POST["state"] !== "") && (isset($_POST["zip"]) && $_POST["zip"] !== "") && (isset($_POST["school"]) && $_POST["school"] !== "") && (isset($_POST["adultSponsor"]) && $_POST["adultSponsor"] !== "") ) {

        	//echo "<h2>Recieved all the information</h2>";
        	$query = "Insert into Registration ";
        	$query .= "(LName, FName, ProjTitle, Age, Gender, City, State, Zip, AdultSponsor, FKFairID, FKSchoolID, FKCategoryID, FKClassID) ";
       		$query .= "VALUES(";
        	$query .= "'".$_POST['lname']."', ";
        	$query .= "'".$_POST['fname']."', ";
        	$query .= "'".$_POST['projTitle']."', ";
        	$query .= $_POST['age'].", ";
        	$query .= "'".$_POST['genderRadioOptions']."', ";
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

          		$_SESSION["message"] = $_POST["fname"]." ".$_POST["lname"]." has been updated";
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
				echo "<h3>Add Student: <i>".$fairNameYear."</i></h3>";
				echo "</head>";
				echo "</div>";
				echo "<br /><br />";
				echo "<div class='container'>";

				$query = "Select LName, FName, ProjTitle, Age, Gender, City, State, Zip, AdultSponsor, FKFairID, FKSchoolID, FKCategoryID, FKClassID ";
				$query .= "from Registration where RegistrationID = ".$SID;

				$result = $mysqli->query($query);
				if ($result && $result->num_rows > 0) {
					$row = $result->fetch_assoc();
		
      
					echo "<form method='POST' action='editStudent.php?id=".$ID."&sid=".$SID."'>";
		
					// Project title
					echo "<div class='form-row'>";
					echo "<div class='form-group col'>";
					echo "<label>Project Title</label>";
					echo "<input type='text' class='form-control' id='projTitle' name='projTitle' value='".$row['ProjTitle']."'>";
					echo "</div>";
					echo "</div>";

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

        			// Adult Sponsor
        			echo "<div class='form-row'>";
        			echo "<div class='form-group col'>";
        			echo "<label>Adult Sponsor Name</label>";
        			echo "<input type='text' class='form-control' id='adultSponsor' name='adultSponsor' value='".$row['AdultSponsor']."'>";
        			echo "</div>";
        			echo "</div>";
		
  					// select school
  					$query2 = "Select * from School order by SName";
  					$result2 = $mysqli->query($query2);
  					if ($result2 && $result2->num_rows > 0) {

  						echo "<div class='form-row'>";
  						echo "<div class='form-group col'>";
  						echo "<label>School:</label>";
  						echo "<select class='form-control' id='school' name='school'>";
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
          				echo "<select class='form-control' id='category' name='category'>";
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
          				echo "<select class='form-control' id='class' name='class'>";
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
					echo "</div>";
				} else {
					$_SESSION["message"] = "Error! Could not find Student.";
          			header("Location: FairHome.php?id=".$ID);
          			exit;
				}
			} else {
				$_SESSION["message"] = "Error! ".$FairName." could not be found.";
          		header("Location: SFindex.php");
          		exit;
			}	

		} else {
			$_SESSION["message"] = "Error! Variables not set in address";
          	header("Location: SFindex.php");
          	exit;
		}

	} 
?>
<br /><br /><br />
</html>