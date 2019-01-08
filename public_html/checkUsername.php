<?php
  session_start();
  require 'connection.php';

  $value = urldecode($_REQUEST['q']);


  // $sql = "SELECT id, u_number, firstname, lastname FROM instructors UNION SELECT id, u_number, firstname, lastname FROM students WHERE u_number LIKE '%$value%' OR firstname  LIKE '%$value%' OR lastname  LIKE '%$value%'";
  $sql = "SELECT id, u_number, firstname, lastname FROM instructors WHERE u_number
          LIKE '%$value%' OR firstname  LIKE '$value%' OR lastname  LIKE '$value%'";

  $result	= mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));

  $sql_S = "SELECT id, u_number, firstname, lastname FROM students WHERE u_number
            LIKE '%$value%' OR firstname  LIKE '$value%' OR lastname  LIKE '$value%'";
  $result_S	= mysqli_query($con,$sql_S) or die('Error: ' . mysqli_error($con));

  if(mysqli_num_rows($result) > 0 || mysqli_num_rows($result_S)) {
    require 'scripts.php';
    while($row = mysqli_fetch_assoc($result)){
      if($row['u_number'] != $_SESSION['u_number']) {
        echo '<li class="list-group-item list-user" data-u-number="'.$row['u_number'].'" data-id="'.$row['id'].'">'.$row['firstname'].' '.$row['lastname'].'</li>';
      }
    }
    while($row = mysqli_fetch_assoc($result_S)){
      if($row['u_number'] != $_SESSION['u_number']) {
        echo '<li class="list-group-item list-user" data-u-number="'.$row['u_number'].'" data-id="'.$row['id'].'">'.$row['firstname'].' '.$row['lastname'].'</li>';
      }
    }
  } else {
    echo 'nodata';
  }
?>
