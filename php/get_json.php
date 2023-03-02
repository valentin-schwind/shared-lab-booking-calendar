<?php   
	try {  
		require "db_config.php";  
	
		$table = $_GET['table']; 
		 
		$select_stmt = $bdd->prepare("SELECT * FROM ".$table);  
		$select_stmt->execute();  
		 
		$result = $select_stmt->fetchAll(PDO::FETCH_ASSOC);
  
		header('Content-Type: application/json');
		echo json_encode($result);
		
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