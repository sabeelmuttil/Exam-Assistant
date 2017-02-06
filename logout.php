
<?php

	session_start();
	
	if (!isset($_SESSION['admi'])) {
		header("Location: admin.php");
	} else if(isset($_SESSION['admi'])!="") {
		header("Location: dash.php");
	}
	
	if (isset($_GET['logout'])) {
		unset($_SESSION['admi']);
		session_unset();
		session_destroy();
		header("Location: admin.php");
		exit;
	}
?>