<?php

	session_start();
	
	function message() {
		if (isset($_SESSION["message"])) {
			
			$output = "<div class='row'>";
			$output .= "<div class='alert alert-warning'>";
			$output .= htmlentities($_SESSION["message"]);
			$output .= "</div>";
			$output .= "</div>";
			
			// clear message after use
			$_SESSION["message"] = null;
			
			return $output;
		
		}
		else {
			return null;
		}
	}

	function errors() {
		if (isset($_SESSION["errors"])) {

			$errors = "<div class='row'>";
			$errors .= "<div class='alert alert-danger'>";
			$errors .= htmlentities($_SESSION["errors"]);
			$errors .= "</div>";
			$errors .= "</div>";
			
			// clear message after use
			$_SESSION["errors"] = null;
			
			return $errors;
		}
	}

	function verifyLogIn() {
		if ($_SESSION['login'] === false || !(isset($_SESSION['login']))) {
			$_SESSION["message"] = "You are not Logged In!";
   			header("Location: LogIn.php");
   			exit;
		}
	}

	function Logout() {
		session_unset();
		session_destroy();
		$_SESSION["message"] = "You are not Logged In!";
		header("Location: LogIn.php");
   		exit;
	}
	
?>