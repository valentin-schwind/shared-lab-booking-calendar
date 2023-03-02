<?php    
	try {  
		require "db_config.php";  
	
		$table = $_GET['table'];
		$sql = "SELECT * FROM ".$table;
		$result = $bdd->query($sql);

		echo '<thead><tr class="data-heading">';
		$column_count = $result->columnCount();
		
		for ($i = 0; $i < $column_count; $i++) {
			$column_meta = $result->getColumnMeta($i);
			echo '<th scope="col">' . $column_meta['name'] . '</th>';
		}
		echo '</tr></thead><tbody>';
		
		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			echo '<tr>';
			foreach ($row as $value) {
				echo "<td>$value</td>";
			}
			echo '</tr>';
		}
		echo '</tbody>';
	
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