<?php
	// $host = "mysql.hostinger.in";
	// $user = "u514064435_tamur";
	// $pass = "Td4PPIPSgOQsrJt3M4";
	// $db 	= "u514064435_tamfu";

	$host = "localhost";
	$user = "root";
	$pass = "";
	$db = "tambalofurniture";
	$conn = mysql_connect($host,$user,$pass);
	if($conn){
		$db_selected = mysql_select_db($db,$conn);
		if (!$db_selected) { die ('Can\'t use foo : ' . mysql_error()); }
	} else { 
		die('Not connected : ' . mysql_error()); 
	}
?>
