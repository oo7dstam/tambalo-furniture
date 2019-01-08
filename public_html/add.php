<?php
  session_start();
  include 'test_input.php';
  require 'config.php';

  function generatePassword($length = 10) {
    return substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $length);
  }
  function generateUsername($length = 10) {
    return substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
  }

  if($_SESSION['activeUser_type'] == 'admin') {
    if(isset($_REQUEST['user'])) {
      $user_type = $_REQUEST['user'];
    }
    $add_type = $_REQUEST['type'];
    // function to add a user
    // Why ? to prevent redundancy of code and make it easy to add
    if($add_type == 'account') {
      function addUser($user_type){
        require 'config.php';
        $message = '';
        try {
          // $email =  test_input($_POST['email']);
          $email = mysqli_real_escape_string($con,test_input($_POST['email']));
          if(is_valid_email($email)) {
            $sql_email = "SELECT email FROM admins WHERE email = '$email'";
            $result_email = mysqli_query($con,$sql_email) or die('Error: ' . mysqli_error($con));

            if(mysqli_num_rows($result_email) == 0) {
              // $firstname = test_input($_POST['firstname']);
              // $lastname = test_input($_POST['lastname']);
              // $middlename = test_input($_POST['middlename']);
              // $gender = test_input($_POST['gender']);
              $firstname = mysqli_real_escape_string($con,test_input($_POST['firstname']));
              $lastname = mysqli_real_escape_string($con,test_input($_POST['lastname']));
              $middlename = mysqli_real_escape_string($con,test_input($_POST['middlename']));
              $gender = mysqli_real_escape_string($con,test_input($_POST['gender']));
              $number = date("Ymds");

              // generate password
              $convert = generatePassword();
              $password = md5($convert);

              if($firstname && $lastname && $middlename && $email && $gender) {
                if($gender == 'male' || $gender == 'female') {
                  if($gender == 'male') {
                    $image = 'assets/images/male.png';
                  } else {
                    $image = 'assets/images/female.png';
                  }
                  // query

                  if($user_type == 'admin') {
                    // checks if username exist if yes then generate a random username
                    $sql = "SELECT username FROM admins WHERE username = '$convert'";
                    $result = mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));
                    if(mysqli_num_rows($result) != 0) {
                      $username = $convert;
                    } else {
                      $username = generateUsername();
                    }
                    // this will be included in the email
                     $user_msg = 'Admin Username';
                     $login = $username;
                     $link = 'http://e-classroom-mba.com/admin';

                    $sql = "INSERT INTO admins(username, password, firstname, middlename, lastname, email, gender, image_path)
                                   VALUES('$username', '$password', '$firstname', '$middlename', '$lastname', '$email', '$gender', '$image')";
                  

                  $result = mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));
                   include 'email.php';
                  
                  echo'<script>alert("Account Added. Password was sent in email");window.location.href="panel.php"</script>';
                  // end of query
    }
                } else { // gender
                  $_SESSION['panel_event'] = 'error';
                  $_SESSION['message'] = 'Cannot add data';
                }
              } else { // firstname ...
                $_SESSION['panel_event'] = 'error';
                $_SESSION['message'] = 'Please check inputs';
              }
            } else { // check email exist
              $_SESSION['panel_event'] = 'error';
              $_SESSION['message'] = 'Email address exist';
            }
          } else { // is_valid_email
            $_SESSION['panel_event'] = 'error';
            $_SESSION['message'] = 'Please check inputs';
          }
        } catch(Exception $e) {
          $_SESSION['panel_event'] = 'error';
          $_SESSION['message'] = 'Something went wrong.';
        }
        echo '<script>window.location.href="add.php";</script>';
      }

      if($user_type == 'admin') {
        addUser('admin');
      } else {
        echo '<script>alert("Cannot add DATA"); window.location.href="panel";</script>';
      }
    } elseif($add_type == 'testi'){
      // $testi=test_input($_POST['testimonial']);
      // $testi_name=test_input($_POST['testimonial_name']);
      // $testi_title=test_input($_POST['testimonial_title']);

      $testi = mysqli_real_escape_string($con,test_input($_POST['testimonial']));
      $testi_name = mysqli_real_escape_string($con,test_input($_POST['testimonial_name']));
      $testi_title = mysqli_real_escape_string($con,test_input($_POST['testimonial_title']));

      $name=$_FILES['photo']['name'];
      $size=$_FILES['photo']['size'];
      $imgtype=$_FILES['photo']['type'];
      $temp=$_FILES['photo']['tmp_name'];
      $path="assets/images/".$name;

        if($imgtype == 'image/jpeg' || $imgtype == 'image/png' || $imgtype == 'image/bmp'){
          move_uploaded_file($temp,"assets/images/".$name);

            $sql= "INSERT INTO testimonial(testimonial,testimonial_img,testimonial_name,testimonial_title)VALUES
                              ('$testi','$path','$testi_name','$testi_title')";
            $result = mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));
            
            if ($result) {    
              echo '<script>alert("Successfully Inserted!!"); window.location.href="panel.php";</script>';
            }else{
              echo '<script>alert("Failed to Insert!!"); window.location.href="panel.php";</script>';
            }
        }else{
          echo '<script>alert("Select Image Only!!"); window.location.href="panel.php";</script>';
        }
    }elseif ($add_type == 'sash') {
      $name=$_FILES['photo']['name'];
      $size=$_FILES['photo']['size'];
      $imgtype=$_FILES['photo']['type'];
      $temp=$_FILES['photo']['tmp_name'];
      $path="assets/images/".$name;
      $cLass="item";
      if ($_FILES['photo']['size'] < 4000000) {
        if($imgtype == 'image/jpeg' || $imgtype == 'image/png' || $imgtype == 'image/bmp'){
          
            move_uploaded_file($temp,"assets/images/".$name);

              $sql= "INSERT INTO sash(sash_name,sash_img_path,class)VALUES('$name','$path','$cLass')";
              $result = mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));
              
              if ($result) {    
                echo '<script>alert("Successfully Inserted!!"); window.location.href="panel.php";</script>';
              }else{
                echo '<script>alert("Failed to Insert!!"); window.location.href="panel.php";</script>';
              }
        }else{
          echo '<script>alert("Select Image Only!!!"); window.location.href="panel.php";</script>';
        }
      }else{
        echo '<script>alert("Maximum 4MB image size."); window.location.href="panel.php";</script>';
      }
    }elseif ($add_type == 'furniture') {
      $name=$_FILES['photo']['name'];
      $size=$_FILES['photo']['size'];
      $imgtype=$_FILES['photo']['type'];
      $temp=$_FILES['photo']['tmp_name'];
      $path="assets/images/".$name;
      $cLass="item";
      if ($_FILES['photo']['size'] < 4000000) {
        if($imgtype == 'image/jpeg' || $imgtype == 'image/png' || $imgtype == 'image/bmp'){
          
            move_uploaded_file($temp,"assets/images/".$name);

              $sql= "INSERT INTO furniture(furniture_name,furniture_img_path,class)VALUES('$name','$path','$cLass')";
              $result = mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));
              
              if ($result) {    
                echo '<script>alert("Successfully Inserted!!"); window.location.href="panel.php";</script>';
              }else{
                echo '<script>alert("Failed to Insert!!"); window.location.href="panel.php";</script>';
              }
        }else{
          echo '<script>alert("Select Image Only!!!"); window.location.href="panel.php";</script>';
        }
      }else{
        echo '<script>alert("Maximum 4MB image size."); window.location.href="panel.php";</script>';
      }
    }elseif ($add_type == 'general') {
      $name=$_FILES['photo']['name'];
      $size=$_FILES['photo']['size'];
      $imgtype=$_FILES['photo']['type'];
      $temp=$_FILES['photo']['tmp_name'];
      $path="assets/images/".$name;
      $cLass="item";
      if ($_FILES['photo']['size'] < 4000000) {
        if($imgtype == 'image/jpeg' || $imgtype == 'image/png' || $imgtype == 'image/bmp'){
          
            move_uploaded_file($temp,"assets/images/".$name);

              $sql= "INSERT INTO general_contructing(general_name,general_img_path,class)VALUES('$name','$path','$cLass')";
              $result = mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));
              
              if ($result) {    
                echo '<script>alert("Successfully Inserted!!"); window.location.href="panel.php";</script>';
              }else{
                echo '<script>alert("Failed to Insert!!"); window.location.href="panel.php";</script>';
              }
        }else{
          echo '<script>alert("Select Image Only!!!"); window.location.href="panel.php";</script>';
        }
      }else{
        echo '<script>alert("Maximum 4MB image size."); window.location.href="panel.php";</script>';
      }
    }elseif ($add_type == 'gallery') {
      $name=$_FILES['photo']['name'];
      $size=$_FILES['photo']['size'];
      $imgtype=$_FILES['photo']['type'];
      $temp=$_FILES['photo']['tmp_name'];
      $path="assets/images/".$name;
      $cLass="item";
      if ($_FILES['photo']['size'] < 4000000) {
        if($imgtype == 'image/jpeg' || $imgtype == 'image/png' || $imgtype == 'image/bmp'){
          
            move_uploaded_file($temp,"assets/images/".$name);

              $sql= "INSERT INTO gallery(image_name,image_path)VALUES('$name','$path')";
              $result = mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));
              
              if ($result) {    
                echo '<script>alert("Successfully Inserted!!"); window.location.href="panel.php";</script>';
              }else{
                echo '<script>alert("Failed to Insert!!"); window.location.href="panel.php";</script>';
              }
        }else{
          echo '<script>alert("Select Image Only!!!"); window.location.href="panel.php";</script>';
        }
      }else{
        echo '<script>alert("Maximum 4MB image size."); window.location.href="panel.php";</script>';
      }
    }else {
      echo '<script>alert("Cannot add DATaaaA"); window.location.href="panel.php";</script>';
    }
} else {
  header('Location: /');
}
?>
