<?php  
	try {  
		require "db_config.php";  
	 
		$id = $_POST['id'];   
		$q = $bdd->prepare("DELETE from events WHERE id=".$id);  
		$q->execute();   
		
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