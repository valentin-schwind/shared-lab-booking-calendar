<?php 
	try {  
		require "db_config.php";  
	
		$input = filter_input_array(INPUT_POST); 
        
		if ($input['action'] === 'edit') {
			$stmt = $bdd->prepare("UPDATE workstations SET name='" . $input['name'] . "', room='" . $input['room']. "', seats='" . $input['seats']. "' WHERE id='" . $input['id'] . "'"); 
		} else if ($input['action'] === 'delete') {
			$stmt = $bdd->prepare("DELETE FROM workstations WHERE id='" . $input['id'] . "'"); 
		} else if ($input['action'] === 'restore') {
			$stmt = $bdd->prepare("UPDATE workstations SET deleted=0 WHERE id='" . $input['id'] . "'"); 
		}
		
		$stmt->execute();  
		echo json_encode($input);
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