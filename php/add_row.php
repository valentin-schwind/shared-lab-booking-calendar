<?php 
	try {  
		require "db_config.php";
		
		$newRowID = $_POST['id'];
		$table = $_POST['table'];
		
		$stmt = $bdd->prepare("INSERT INTO ".$table." (id) VALUES (".$newRowID.")");
		$stmt->execute();   
		
		echo $newRowID; 
	} catch(PDOException $e) {
		$result = array(
			"status" => "error",
			"message" => $e->getMessage()
		);
		
		echo json_encode($result);
	} finally {  
		$bdd = null;
		mysqli_close($mysqli);
	}
?>