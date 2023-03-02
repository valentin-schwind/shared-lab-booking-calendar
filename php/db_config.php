<?php  
	$bdd = new PDO('mysql:host=HOSTNAME;dbname=DBNAME', 'USERNAME', 'PASSWORD');   
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>  