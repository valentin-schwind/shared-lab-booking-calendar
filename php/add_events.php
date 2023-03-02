<?php  
	try {  
		require "db_config.php";
		
		$title = $_POST['title'];  
		$start = $_POST['start'];  
		$end = $_POST['end'];  
		$room = $_POST['room'];  
		$workstation = $_POST['workstation'];  
		$pin = $_POST['pin'];  
		$className = $_POST['className'];  
		$groupid = $_POST['groupid'];   
		
		$stmt = $bdd->prepare("INSERT INTO events (title, start, end, workstation, room, pin, className, groupid) VALUES (:title, :start, :end, :workstation, :room, :pin, :className, :groupid)");
		$stmt->execute([':title'=>$title, ':start'=>$start, ':end'=>$end, ':room'=>$room, ':workstation'=>$workstation, ':pin'=>$pin, ':className'=>$className, ':groupid'=>$groupid]);    
		$last_id = $bdd->lastInsertId();
		/*$request = "SELECT * FROM events WHERE id = ".$last_id;  
		$result = $bdd->query($request) or die(print_r($bdd->errorInfo()));  
		
		echo json_encode($result->fetchAll(PDO::FETCH_ASSOC));   */
		$result = array(
			"status" => "success",
			"id" => $last_id
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