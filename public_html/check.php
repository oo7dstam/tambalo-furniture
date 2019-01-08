<?php
	require 'config.php';
	$item = "item active";
	$sql = "SELECT * FROM sash limit 1";
  	$result = mysqli_query($con,$sql)or die('Error:'.mysqli_error($con));
  	if(mysqli_num_rows($result)!=0){
  		while($row = mysqli_fetch_assoc($result)){
  			if ($row['class'] = "item") {
  				$id = $row['sash_id'];
  				$sql="UPDATE sash SET class='$item' WHERE sash_id = $id";
  				$reult = mysqli_query($con,$sql)or die('Error:'.mysqli_error($con));  				
  			}
  		}
  	}else{
  		echo'<script>alert("Something is Wrong. Please Contact the Web Master");window.location.href="panel.php"</script>';
  	}

  	$sql = "SELECT * FROM furniture limit 1";
  	$result = mysqli_query($con,$sql)or die('Error:'.mysqli_error($con));
  	if(mysqli_num_rows($result)!=0){
  		while($row = mysqli_fetch_assoc($result)){
  			if ($row['class'] = "item") {
  				$id = $row['furniture_id'];
  				$sql="UPDATE furniture SET class='$item' WHERE furniture_id = $id";
  				$reult = mysqli_query($con,$sql)or die('Error:'.mysqli_error($con));  				
  			}
  		}
  	}else{
  		echo'<script>alert("Something is Wrong. Please Contact the Web Master");window.location.href="panel.php"</script>';
  	}
  	
  	$sql = "SELECT * FROM general_contructing limit 1";
  	$result = mysqli_query($con,$sql)or die('Error:'.mysqli_error($con));
  	if(mysqli_num_rows($result)!=0){
  		while($row = mysqli_fetch_assoc($result)){
  			if ($row['class'] = "item") {
  				$id = $row['general_id'];
  				$sql="UPDATE general_contructing SET class='$item' WHERE general_id = $id";
  				$reult = mysqli_query($con,$sql)or die('Error:'.mysqli_error($con));  				
  			}
  		}
  	}else{
  		echo'<script>alert("Something is Wrong. Please Contact the Web Master");window.location.href="panel.php"</script>';
  	}
?>