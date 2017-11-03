<?php

	session_start();
	
	if (!isset($_SESSION['faculty'])) {
		header("Location: index.php");
	} else if(isset($_SESSION['faculty'])!="") {
		header("Location: facultyhome.php");
	}
	
	if (isset($_GET['logoutfaculty'])) {
		unset($_SESSION['faculty']);
		session_unset();
		session_destroy();
		header("Location: loginfaculty.php");
		exit;
	}
