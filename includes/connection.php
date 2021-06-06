<?php

	$dbconnect = new mysqli('localhost', 'root', '', 'galaxy_academy');
	if ($dbconnect){
		
	}else{

		die($dbconnect->connect_error);
	}
?>