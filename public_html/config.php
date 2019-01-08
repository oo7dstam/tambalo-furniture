<?php
	// $host = "mysql.hostinger.in";
	// $user = "u514064435_tamur";
	// $pass = "Td4PPIPSgOQsrJt3M4";
	// $db = "u514064435_tamfu";

	$host = "localhost";
	$user = "root";
	$pass = "";
	$db = "tambalofurniture";
	$con = mysqli_connect($host,$user,$pass,$db) or die("Unable to connect to database");
	if (mysqli_connect_errno())
	{
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	date_default_timezone_set('Asia/Manila');
?>
