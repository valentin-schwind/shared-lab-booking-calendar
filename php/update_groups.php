<?php  
	try {  
		require "db_config.php";  
	
		$input = filter_input_array(INPUT_POST); 
        
		if ($input['action'] === 'edit') {
			$stmt = $bdd->prepare("UPDATE groups SET name='" . $input['name'] . "', members='" . $input['members']. "', email='" . $input['email'] . "', course='" . $input['course'] . "', semester='" . $input['semester'] . "', pin='" . $input['pin'] . "' WHERE id='" . $input['id'] . "'"); 
		} else if ($input['action'] === 'delete') {
			$stmt = $bdd->prepare("DELETE FROM groups WHERE id='" . $input['id'] . "'"); 
		} else if ($input['action'] === 'restore') {
			$stmt = $bdd->prepare("UPDATE groups SET deleted=0 WHERE id='" . $input['id'] . "'"); 
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