<?php 
	require_once("session.php");
 	require('../fpdf.php');
	require_once("included_functions.php");
	$mysqli = db_connection_noMessage();
	
	if ((isset($_GET['id']) && $_GET['id'] != "") && (isset($_GET['snum']) && $_GET['snum'] != "") && (isset($_GET['cid']) && $_GET['cid'] != "")) {
		$ID = $_GET['id'];
		$CID = $_GET['cid'];
		$SNUM = $_GET['snum'];
	

		$query = "Select distinct SetJudgeID, LName, FName, FKCategoryID, Description, SetNumber ";
		$query .= "from JudgeRegistrant ";
		$query .= "inner join SetJudge on FKSetJudgeID = SetJudgeID ";
		$query .= "inner join Judge on FKJudgeID = JudgeID ";
		$query .= "inner join Fair on FKFairID = FairID ";
		$query .= "inner join Category on FKCategoryID = CategoryID ";
		$query .= "where FairID = ".$ID." and FKCategoryID = ".$CID." and SetNumber = ".$SNUM;
		$query .= " order by LName";
		$result = $mysqli->query($query);
		$name = array();
		$des = array();
		$sjid = array();
		if ($result && $result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				array_push($name, $row['FName']." ".$row['LName']);
				array_push($des, $row['Description']);
				array_push($sjid, $row['SetJudgeID']);
			}

			// create pdf ////////////////////////////////////////////////////////////////////////////
			$pdf = new FPDF();

			

			
			
			for ($i = 0; $i < count($name); $i++) {


				$query = "Select distinct TeamMembers.FKRegistrationID from TeamMembers ";
    			$query .= "inner join Registration on TeamMembers.FKRegistrationID = RegistrationID ";
    			$query .= "inner join JudgeRegistrant on JudgeRegistrant.FKRegistrationID = RegistrationID ";
    			$query .= "inner join SetJudge on FKSetJudgeID = SetJudgeID ";
    			$query .= "where FKSetJudgeID = ".$sjid[$i]." and SetNumber = ".$SNUM;

    			$onTeam = array();
    			$tMems = array();
    			$result = $mysqli->query($query);
    			if ($result && $result->num_rows > 0) {
    				while ($row = $result->fetch_assoc()) {
    					array_push($onTeam, $row['FKRegistrationID']);
    				}

    				for ($j = 0; $j < count($onTeam); $j++) {
    					$query1 = "select concat(FName, ' ', LName) as `Name` ";
    					$query1 .= "from TeamMembers where FKRegistrationID = ".$onTeam[$j];

    					$result = $mysqli->query($query1);
    					if ($result && $result->num_rows > 0) {
    						while ($row = $result->fetch_assoc()) {
    							if (count($tMems) <= $j) {
    								array_push($tMems, $row['Name']);
    							} else {
    								$tMems[$j] .= ", ".$row['Name']; 
    							}
    						}
    					}
    				}


    			}


				$query = "Select Class, RegistrationID, LName, FName, ProjTitle ";
				$query .= "from JudgeRegistrant ";
				$query .= "inner join Registration on FKRegistrationID = RegistrationID ";
				$query .= "inner join Class on FKClassID = ClassID ";
				$query .= "inner join Fair on FKFairID = FairID ";
				$query .= "where FairID = ".$ID." and FKSetJudgeID = ".$sjid[$i];
				$query .= " order by LName";
				
				$result = $mysqli->query($query);

				

					
				
				
				if ($result && $result->num_rows > 0) {

					$pdf->AddPage();
					$pdf->SetFont('Arial','B',14);
					$pdf->Cell(0, 10, "Judge's Score Card", 0, 1, 'C');
					$pdf->Ln();
					

					// Judge info

					$pdf->SetFont('Arial', 'B', 8);
					$pdf->Cell(30, 5, "Category: ", 0, 0, 'L');
					$pdf->SetFont('Arial', '', 8);
					$pdf->Cell(65, 5, $CID, 0, 0, 'L');
					$pdf->SetFont('Arial', 'B', 8);
					$pdf->Cell(30, 5, "Name: ", 0, 0, 'L');
					$pdf->SetFont('Arial', '', 8);
					$pdf->Cell(65, 5, $name[$i], 0, 0, 'L');
					$pdf->Ln();

					$pdf->SetFont('Arial', 'B', 8);
					$pdf->Cell(30, 5, "Description: ", 0, 0, 'L');
					$pdf->SetFont('Arial', '', 8);
					$pdf->Cell(65, 5, $des[$i], 0, 0, 'L');
					$pdf->SetFont('Arial', 'B', 8);
					$pdf->Cell(30, 5, "Judge Set Number: ", 0, 0, 'L');
					$pdf->SetFont('Arial', '', 8);
					$pdf->Cell(65, 5, $SNUM, 0, 0, 'L');
					$pdf->Ln();
					$pdf->Ln();
					$pdf->Ln();



					// Table Header

					$pdf->SetLineWidth(0.8);
					$pdf->SetFont('Arial', 'B', 8);
					$pdf->Cell(15, 3, "", "TLR", 0, 'C');
					$pdf->Cell(15, 3, "", "TLR", 0, 'C');
					$pdf->Cell(65, 3, "", "TLR", 0, 'L');
					$pdf->SetFont('Arial', '', 8);
					$pdf->Cell(15, 3, "", "TLR", 0, 'C');
					$pdf->Cell(15, 3, "", "TLR", 0, 'C');
					$pdf->Cell(15, 3, "", "TLR", 0, 'C');
					$pdf->Cell(15, 3, "", "TLR", 0, 'C');
					$pdf->Cell(20, 3, "", "TLR", 0, 'C');
					$pdf->Cell(15, 3, "", "TLR", 0, 'C');
					$pdf->Ln();

					$pdf->SetFont('Arial', 'B', 8);
					$pdf->Cell(15, 3, "Class", "LR", 0, 'C');
					$pdf->Cell(15, 3, "Project", "LR", 0, 'C');
					$pdf->Cell(65, 3, "Exhibitor/Project Title", "LR", 0, 'L');
					$pdf->SetFont('Arial', '', 8);
					$pdf->Cell(15, 3, "Research", "LR", 0, 'C');
					$pdf->Cell(15, 3, "Design", "LR", 0, 'C');
					$pdf->Cell(15, 3, "Execution", "LR", 0, 'C');
					$pdf->Cell(15, 3, "Creativity", "LR", 0, 'C');
					$pdf->Cell(20, 3, "Presentation", "LR", 0, 'C');
					$pdf->Cell(15, 3, "Total", "LR", 0, 'C');
					$pdf->Ln();

					$pdf->SetFont('Arial', 'B', 8);
					$pdf->Cell(15, 3, "", "LR", 0, 'C');
					$pdf->Cell(15, 3, "Number", "LR", 0, 'C');
					$pdf->Cell(65, 3, "", "LR", 0, 'L');
					$pdf->SetFont('Arial', '', 8);
					$pdf->Cell(15, 3, "Question", "LR", 0, 'C');
					$pdf->Cell(15, 3, "Method", "LR", 0, 'C');
					$pdf->Cell(15, 3, "(20 pts)", "LR", 0, 'C');
					$pdf->Cell(15, 3, "(20 pts)", "LR", 0, 'C');
					$pdf->Cell(20, 3, "(35 pts)", "LR", 0, 'C');
					$pdf->Cell(15, 3, "Score", "LR", 0, 'C');
					$pdf->Ln();

					$pdf->SetFont('Arial', 'B', 8);
					$pdf->Cell(15, 3, "", "LR", 0, 'C');
					$pdf->Cell(15, 3, "", "LR", 0, 'C');
					$pdf->Cell(65, 3, "", "LR", 0, 'L');
					$pdf->SetFont('Arial', '', 8);
					$pdf->Cell(15, 3, "(10 pts)", "LR", 0, 'C');
					$pdf->Cell(15, 3, "(15 pts)", "LR", 0, 'C');
					$pdf->Cell(15, 3, "", "LR", 0, 'C');
					$pdf->Cell(15, 3, "", "LR", 0, 'C');
					$pdf->Cell(20, 3, "", "LR", 0, 'C');
					$pdf->Cell(15, 3, "(100 pts)", "LR", 0, 'C');
					$pdf->Ln();

					$pdf->SetFont('Arial', 'B', 8);
					$pdf->Cell(15, 3, "", "BLR", 0, 'C');
					$pdf->Cell(15, 3, "", "BLR", 0, 'C');
					$pdf->Cell(65, 3, "", "BLR", 0, 'L');
					$pdf->SetFont('Arial', '', 8);
					$pdf->Cell(15, 3, "", "BLR", 0, 'C');
					$pdf->Cell(15, 3, "", "BLR", 0, 'C');
					$pdf->Cell(15, 3, "", "BLR", 0, 'C');
					$pdf->Cell(15, 3, "", "BLR", 0, 'C');
					$pdf->Cell(20, 3, "", "BLR", 0, 'C');
					$pdf->Cell(15, 3, "", "BLR", 0, 'C');
					$pdf->Ln();

					
					while ($row = $result->fetch_assoc()) {

						if ( !(in_array($row['RegistrationID'], $onTeam)) ) {


							$pdf->SetLineWidth(0.8);
							$pdf->SetFont('Arial', '', 8);
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Cell(65, 3, "", "LR", 0, 'L');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Cell(20, 3, "", "LR", 0, 'C');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Ln();

							$pdf->Cell(15, 3, $row['Class'], "LR", 0, 'C');
							$pdf->Cell(15, 3, $row['RegistrationID'], "LR", 0, 'C');
							$pdf->Cell(65, 3, $row['FName']." ".$row['LName'], "LR", 0, 'L');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Cell(20, 3, "", "LR", 0, 'C');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Ln();

							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Cell(65, 3, "", "LR", 0, 'L');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Cell(20, 3, "", "LR", 0, 'C');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Ln();

							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Cell(65, 3, $row['ProjTitle'], "LR", 0, 'L');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Cell(20, 3, "", "LR", 0, 'C');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Ln();

							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Cell(65, 3, "", "LR", 0, 'L');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Cell(20, 3, "", "LR", 0, 'C');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Ln();

							$pdf->SetLineWidth(0.3);
							$pdf->Cell(15, 3, "", "BT", 0, 'C');
							$pdf->Cell(15, 3, "", "BT", 0, 'C');
							$pdf->Cell(65, 3, "", "BT", 0, 'L');
							$pdf->Cell(15, 3, "", "BT", 0, 'C');
							$pdf->Cell(15, 3, "", "BT", 0, 'C');
							$pdf->Cell(15, 3, "", "BT", 0, 'C');
							$pdf->Cell(15, 3, "", "BT", 0, 'C');
							$pdf->Cell(20, 3, "", "BT", 0, 'C');
							$pdf->Cell(15, 3, "", "BT", 0, 'C');
							$pdf->Ln();





						} else {


							$pdf->SetLineWidth(0.8);
							$pdf->SetFont('Arial', '', 8);
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Cell(65, 3, "", "LR", 0, 'L');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Cell(20, 3, "", "LR", 0, 'C');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Ln();

							$pdf->Cell(15, 3, $row['Class'], "LR", 0, 'C');
							$pdf->Cell(15, 3, $row['RegistrationID'], "LR", 0, 'C');
							$pdf->Cell(65, 3, $row['FName']." ".$row['LName'].",", "LR", 0, 'L');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Cell(20, 3, "", "LR", 0, 'C');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Ln();

							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Cell(65, 3, "", "LR", 0, 'L');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Cell(20, 3, "", "LR", 0, 'C');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Ln();

							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Cell(65, 3, $tMems[array_search($row['RegistrationID'], $onTeam)], "LR", 0, 'L');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Cell(20, 3, "", "LR", 0, 'C');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Ln();

							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Cell(65, 3, "", "LR", 0, 'L');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Cell(20, 3, "", "LR", 0, 'C');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Ln();

							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Cell(65, 3, "", "LR", 0, 'L');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Cell(20, 3, "", "LR", 0, 'C');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Ln();

							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Cell(65, 3, $row['ProjTitle'], "LR", 0, 'L');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Cell(20, 3, "", "LR", 0, 'C');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Ln();

							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Cell(65, 3, "", "LR", 0, 'L');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Cell(20, 3, "", "LR", 0, 'C');
							$pdf->Cell(15, 3, "", "LR", 0, 'C');
							$pdf->Ln();

							$pdf->SetLineWidth(0.3);
							$pdf->Cell(15, 3, "", "BT", 0, 'C');
							$pdf->Cell(15, 3, "", "BT", 0, 'C');
							$pdf->Cell(65, 3, "", "BT", 0, 'L');
							$pdf->Cell(15, 3, "", "BT", 0, 'C');
							$pdf->Cell(15, 3, "", "BT", 0, 'C');
							$pdf->Cell(15, 3, "", "BT", 0, 'C');
							$pdf->Cell(15, 3, "", "BT", 0, 'C');
							$pdf->Cell(20, 3, "", "BT", 0, 'C');
							$pdf->Cell(15, 3, "", "BT", 0, 'C');
							$pdf->Ln();


							
						}
					}
					
				} 	
				
				
			}
			

		} else {
			$_SESSION["message"] = "Unable to view Set Info";
   			header("Location: FairHome.php?id=".$ID);
   			exit;
		}




		$name = $des[0]."Set".$SNUM;
		$name = str_replace(" ", "", $name);

		$pdf->Output('D', $name);


	} else {
		$_SESSION["message"] = "Error! Variables not set";
        header("Location: SFindex.php");
        exit;
	}


?>