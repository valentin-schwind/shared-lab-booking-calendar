<?php 
	header('Content-Type: application/json');
	
	$mysqli = new mysqli('HOSTNAME', 'USERNAME', 'PASSWORD', 'DBNAME'); 
	
	$input = filter_input_array(INPUT_POST);

	if ($input['action'] === 'edit') {
		$mysqli->query("UPDATE events SET workstation='" . $input['workstation'] . "', className='" . $input['className']. "', room='" . $input['room'] . "', groupid='" . $input['groupid'] . "', title='" . $input['title'] . "', start='" . $input['start']. "', end='" . $input['end'] . "' WHERE id='" . $input['id'] . "'");
		} else if ($input['action'] === 'delete') {
		$mysqli->query("DELETE FROM groups WHERE id='" . $input['id'] . "'");
		} else if ($input['action'] === 'restore') {
		$mysqli->query("UPDATE groups SET deleted=0 WHERE id='" . $input['id'] . "'");
	}
	
	mysqli_close($mysqli);
	
	echo json_encode($input);
	
?>