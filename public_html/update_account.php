<?php
  session_start();
  if(isset($_SESSION['activeUser'])) {
    require 'test_input.php';
    require 'config.php';

    $user = $_REQUEST['user'];
    $which = $_POST['which'];
    $table = $user.'s';
    // $password = md5(test_input($_POST['password']));

    $password = md5(mysqli_real_escape_string($con,test_input($_POST['password'])));

    if($user == 'admin') {
      $condition = 'username = \'' . $_SESSION['username']. '\'';
      $sql = "SELECT * FROM admins WHERE username = '$_SESSION[username]'";
      $imageName = $_SESSION['username'];
    }

    $result	= mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));
    $row = mysqli_fetch_array($result);
    $currentPassword = $row['password'];

    try {
      if($password == $currentPassword) {
        if($which == 'username' && $_SESSION['activeUser_type'] == 'admin') {
          // $username = test_input($_POST['username']);
          $username = mysqli_real_escape_string($con,test_input($_POST['username']));

          if(strlen($username) >= 6) {
            $sql = "SELECT * FROM admins WHERE username = '$username'";
            $result	= mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));

            if(mysqli_num_rows($result) == 0) {
              $sql = "UPDATE $table
                      SET username = '$username',
                          username_changed = 1
                      WHERE $condition AND password = '$password'";
              $result	= mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));
              echo '<script>alert("Username was changed. Please login again."); window.location.href="logout.php";</script>';
            } else {
              $_SESSION['account_event'] = 'error';
              $_SESSION['message'] = 'Username is maybe taken. TRY another.';
            }
          } else {
            $_SESSION['account_event'] = 'error';
            $_SESSION['message'] = 'Username must be greater than 6 characters. TRY another.';
          }

        } else if($which == 'info') {
          // $firstname = test_input($_POST['firstname']);
          // $lastname = test_input($_POST['lastname']);
          // $middlename = test_input($_POST['middlename']);
          // $gender = test_input($_POST['gender']);

          $firstname = mysqli_real_escape_string($con,test_input($_POST['firstname']));
          $lastname = mysqli_real_escape_string($con,test_input($_POST['lastname']));
          $middlename = mysqli_real_escape_string($con,test_input($_POST['middlename']));
          $gender = mysqli_real_escape_string($con,test_input($_POST['gender']));

          if($firstname && $lastname && $middlename && $gender) {
            $sql = "UPDATE $table
                    SET firstname = '$firstname',
                        lastname = '$lastname',
                        middlename = '$middlename',
                        gender = '$gender'
                    WHERE $condition AND password = '$password'";
            $result	= mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));

            $_SESSION['account_event'] = 'success';
            $_SESSION['message'] = 'Account Information was updated';
          } else {
            $_SESSION['account_event'] = 'error';
            $_SESSION['message'] = 'Please check inputs.';
          }

        } else if($which == 'pass') {
          // $newPassword = test_input($_POST['newPassword']);
          // $cPassword = test_input($_POST['cPassword']);

          $newPassword = mysqli_real_escape_string($con,test_input($_POST['newPassword']));
          $cPassword = mysqli_real_escape_string($con,test_input($_POST['cPassword']));

          if(strlen($newPassword) >= 6) {
            if($newPassword == $cPassword) {
              $hashPass = md5($newPassword);

              $sql = "UPDATE $table
                      SET password = '$hashPass'
                      WHERE $condition AND password = '$password'";
              $result	= mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));

              $_SESSION['account_event'] = 'success';
              $_SESSION['message'] = 'Password was updated';
            } else { // $newPassword == $cPassword
              $_SESSION['account_event'] = 'error';
              $_SESSION['message'] = 'Passwords doesn\'t match.';
            } // $newPassword == $cPassword
          } else { // strlen
            $_SESSION['account_event'] = 'error';
            $_SESSION['message'] = 'Password must be greater than 6 characters';
          } // strlen

        } else if($which == 'pic') {
          require 'connection_image.php';
          if (!empty($_FILES["user_image"]["name"])) {
            function GetImageExtension($imagetype) {
              if(empty($imagetype)) return false;
              switch($imagetype) {
                case 'image/bmp': return '.bmp';
                case 'image/gif': return '.gif';
                case 'image/jpeg': return '.jpg';
                case 'image/png': return '.png';
                default: return false;
              }
           }
            if ($_FILES['user_image']['size'] < 10000000) {
              $imgtype   = $_FILES["user_image"]["type"];
              if($imgtype == 'image/jpeg' || $imgtype == 'image/png' || $imgtype == 'image/bmp'){
                // $file_name = test_input($_FILES["user_image"]["name"]);
                $file_name = mysqli_real_escape_string($con,test_input($_FILES["user_image"]["name"]));
                $temp_name = $_FILES["user_image"]["tmp_name"];
                $ext = GetImageExtension($imgtype);
                $target_path = "assets/images/".$table."/". $imageName . $ext;

                if(move_uploaded_file($temp_name, $target_path)) {
                  $query_upload="UPDATE $table SET image_path = '$target_path' WHERE $condition";
                  mysql_query($query_upload) or die("error in $query_upload == ----> ".mysql_error());

                  $_SESSION['account_event'] = 'success';
                  $_SESSION['message'] = 'Profile picture was updated.';
                } else {
                  $_SESSION['account_event'] = 'error';
                  $_SESSION['message'] = 'Cannot process now.';
                }
              } else {
                $_SESSION['account_event'] = 'error';
                $_SESSION['message'] = 'Invalid FILE.';
              }
            } else {
              $_SESSION['account_event'] = 'error';
              $_SESSION['message'] = 'Maximum 4MB image size.';
            }
          } else {
            $_SESSION['account_event'] = 'error';
            $_SESSION['message'] = 'Please upload image again.';
          }
        
        } else { // pic
          $_SESSION['account_event'] = 'error';
          $_SESSION['message'] = 'Something is not right!';
        }
      } else {

        $_SESSION['message'] = 'Password maybe incorrect.';
        if($which == 'subject') {
            $_SESSION['panel_event'] = 'error';
        } else {
          $_SESSION['account_event'] = 'error';
        }
      }
    } catch(Exception $e) {
      $_SESSION['account_event'] = 'error';
      $_SESSION['message'] = 'Something is not right!';
    }

    if($which == 'username') {
      // echo '<script>alert("Username was changed. Please login again."); window.location.href="logout.php";</script>';
    } else if($which == 'subject') {
      header('Location: panel.php');
    } else {
      header('Location: account.php');
    }
  } else { // isset($_SESSION['activeUser']
    header("Location: /");
  }
?>
