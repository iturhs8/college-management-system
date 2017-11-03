<?php

	session_start();
	
	if (!isset($_SESSION['student'])) {
		header("Location: index.php");
	} else if(isset($_SESSION['student'])!="") {
		header("Location: studenthome.php");
	}
	
	if (isset($_GET['logoutstudent'])) {
		unset($_SESSION['student']);
		session_unset();
		session_destroy();
		header("Location: loginstudent.php");
		exit;
	}
