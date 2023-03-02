<?php
	header("Content-Type: text/plain");
	$page = $_GET['page']; 
	$password = $_POST['password'];
	
	switch ($page) {
		case "backend":
        if($password == "ENTER_ADMIN_PASSWORD"){
			echo 'Granted';
			} else {
			echo 'Denied';
		} 
        break;
		case "frontend":
        if($password == "ENTER_USER_PASSWORD"){
			echo 'Granted';
			} else {
			echo 'Denied';
		} 
        break;
		default:
		echo "Denied";
	}
?>