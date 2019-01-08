<?php
  function gravatar($uid){
    require 'config.php';
    $image_path = '';
    $sql = "SELECT image_path FROM admins WHERE username = '$uid'";
    $result	= mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));
    if(mysqli_num_rows($result) != 0) {
      $row = mysqli_fetch_array($result);
      $image_path = $row['image_path'];
    }
    return $image_path;
  }
?>
