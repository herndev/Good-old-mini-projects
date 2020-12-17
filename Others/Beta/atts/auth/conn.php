<?php
	include "const.php";
	
	// Create connection
	$conn = new mysqli($hostname, $db_username, $db_password, $db);

	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

?>