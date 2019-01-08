<?php
	session_start(); # NOTE THE SESSION START
	require "config.php";
	if($_SESSION['activeUser_type'] == 'admin') {
		$sql = "UPDATE admins SET user_status = 'offline' WHERE username = '$_SESSION[username]'";
		$result	= mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));
	} else {
		echo'<script>alert("Undefined User!!");</script>';
	}

	mysqli_close($con);
	session_unset();
	session_destroy();
	header('Location: /');
	exit(); # NOTE THE EXIT
?>
