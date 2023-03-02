<?php   
	try {  
		require "db_config.php";  
	
		$id = $_POST['id'];  
		$title = $_POST['title'];  
		$start = $_POST['start'];  
		$end = $_POST['end'];  
		$room = $_POST['room'];  
		$workstation = $_POST['workstation'];  
		$pin = $_POST['pin'];  
		$className = $_POST['className'];  
		$groupid = $_POST['groupid'];   
   
		$stmt = $bdd->prepare("UPDATE events SET title=:title, start=:start, end=:end, room=:room, workstation=:workstation , pin=:pin, className=:className, groupid=:groupid WHERE id=:id");  
		$stmt->execute([':title'=>$title, ':start'=>$start, ':end'=>$end, ':room'=>$room, ':workstation'=>$workstation, ':pin'=>$pin, ':className'=>$className, ':groupid'=>$groupid, ':id'=>$id]);  
		
		$select_stmt = $bdd->prepare("SELECT * FROM events WHERE id = :id");
		$select_stmt->bindParam(':id', $id);
		$select_stmt->execute(); 
		 
		$result = array(
			"status" => "success",
			"message" => "ID ".$id." updated."
		);
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