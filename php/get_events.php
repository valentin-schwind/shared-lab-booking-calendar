<?php    	
	try {  
		require "db_config.php";  
	
		$workstation = $_GET['workstation'];
		$room = $_GET['room'];
	
		$request = "SELECT * FROM events WHERE workstation = '".$workstation."' AND room = '".$room."'";  
		$result = $bdd->query($request) or die(print_r($bdd->errorInfo()));  
	
		echo json_encode($result->fetchAll(PDO::FETCH_ASSOC));  
	
	} catch(PDOException $e) {
		$result = array(
			"status" => "error",
			"message" => $e->getMessage()
		);
		 
		echo json_encode($result);
	} finally {  
		$bdd = null;
		//mysqli_close($mysqli);
	}
?>  
	