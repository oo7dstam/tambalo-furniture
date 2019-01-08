<?php
session_start();
if(isset($_SESSION['activeUser'])) {
  require 'config.php';
  require 'test_input.php';
  // type
  // like accounts and  etc
  if(isset($_POST['password'])) {
    $type = $_REQUEST['type'];
    $table = $_SESSION['activeUser_type'].'s';
    // $password = md5(test_input($_POST['password']));

    $password = md5(mysqli_real_escape_string($con,test_input($_POST['password'])));
    
    if($_SESSION['activeUser_type'] == 'admin') {
      $condition = 'username = \'' . $_SESSION['username']. '\'';
      $sql = "SELECT password FROM admins WHERE username = '$_SESSION[username]'";
    } else {
      $condition = 'u_number = \''. $_SESSION['u_number']. '\'';
      $sql = "SELECT password FROM  $table WHERE u_number = '$_SESSION[u_number]'";
    }
    $result = mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));
    $row = mysqli_fetch_array($result);
    $currentPassword = $row['password'];

    if($password == $currentPassword) {
      if($type == 'account') {
        $sql = "DELETE FROM $table WHERE $condition";
        $result = mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));
        echo '<script>alert("ACCOUNT DELETED."); window.location.href="logout.php";</script>';
      } else if($type == 'admin') {
        $user = $_REQUEST['user'];
        $u_num = $_REQUEST['u_num'];
        $u_id = $_REQUEST['u_id'];
        $tbl = $user.'s';

        // get user details fo email
        $sql_email = "SELECT email, firstname, lastname FROM admins WHERE username = '$u_num' AND id = '$u_id'";
        $result_email = mysqli_query($con,$sql_email) or die('Error: ' . mysqli_error($con));
        $row = mysqli_fetch_array($result_email);

        // set email variables
        $subject = "DELETED ACCOUNT";
        $email = $row['email'];
        $fullname = ucfirst($row['firstname']).' '.ucfirst($row['lastname']);
        $email_content = "I just want to inform you that your account has been deleted from the system.";

        if($user == 'admin') {
          $sql = "DELETE FROM admins WHERE username = '$u_num' AND id = '$u_id'";
        } else {
          $sql = "DELETE FROM $tbl WHERE u_number = '$u_num' AND id = '$u_id'";
        }
        $result = mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));

        // send email
         ini_set("sendmail_form", "admin@tambalofurniture.esy.es");
$message = '
<html>
  <head>
    <title>Notification</title>
  </head>
  <body>
  <div style="width: 600px; font-family: sans-serif;
    margin: 0 auto;
    border: 2px solid #5c0017;">
    <div style="text-align: center;">
      <h1 style="background: #5c0017; margin: 0;padding: 10px;color: #feba29;font-weight: 300">Notification</h1>
    </div>
    <div style="padding: 10px;">
      <h3 style="font-weight: 300">Hello '. $fullname .'</h3>
      <p>'.$email_content.'</p>
      <br><br><br>
      <p>Regards,</p>
      <p>'.ucfirst($_SESSION['activeUser_name']).' '.ucfirst($_SESSION['activeUser_lastname']).'</p>
     </div>
      <div style="position: relative;height: 40px;padding: 15px 0 10px 0;color: #feba29; display: table;background-color: #5c0017;  width: 100%;">
        <p style="margin: 0;text-align: center; vertical-align: middle; display: table-cell;">
          &copy; All Rights Reserved 2016<br>
          <a href="http://tambalofurniture.esy.es/" style="color: #fff;">tambalofurniture.esy.es</a>
        </p>
      </div>
    </div>
  </body>
</html>';

        $to = $email;
         $subject = "Deleted Account";
         $headers = "From: contact@tambalofurniture.esy.es". "\r\n" .
         "Reply-To: contact@reciever@tambalofurniture.esy.es" . "\r\n" .
         "X-Mailer: PHP/" . phpversion();
         $headers = "MIME-Version: 1.0\r\n";
         $headers = "Content-Type: text/html; charset=ISO-8859-1\r\n";
         mail($to,$subject,$message,$headers);

        $_SESSION['panel_event'] = 'success';
        $_SESSION['message'] = 'Account was deleted. Email was sent to the user.';
        header("Location: panel.php");
      } else if($type == 'gallery') {
        $u_id = $_REQUEST['id'];

        $sql = "DELETE FROM gallery WHERE image_id = '$u_id'";
        $result = mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));

        $_SESSION['panel_event'] = 'success';
        $_SESSION['message'] = 'Image was deleted.';
        header("Location: panel.php");
      }elseif ($type == 'testimonial') {
        $u_id = $_REQUEST['id'];

        $sql = "DELETE FROM testimonial WHERE testimonial_id = '$u_id'";
        $result = mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));

        $_SESSION['panel_event'] = 'success';
        $_SESSION['message'] = 'Testimonial was deleted.';
        header("Location: panel.php");
      }elseif ($type == 'sash') {
        $u_id = $_REQUEST['id'];

        $sql = "DELETE FROM sash WHERE sash_id = '$u_id'";
        $result = mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));

        $_SESSION['panel_event'] = 'success';
        $_SESSION['message'] = 'Image was deleted.';
        header("Location: panel.php");
      }elseif ($type == 'furniture') {
        $u_id = $_REQUEST['id'];

        $sql = "DELETE FROM furniture WHERE furniture_id = '$u_id'";
        $result = mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));

        $_SESSION['panel_event'] = 'success';
        $_SESSION['message'] = 'Image was deleted.';
        header("Location: panel.php");
      }elseif ($type == 'general') {
        $u_id = $_REQUEST['id'];

        $sql = "DELETE FROM general_contructing WHERE general_id = '$u_id'";
        $result = mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));

        $_SESSION['panel_event'] = 'success';
        $_SESSION['message'] = 'Image was deleted.';
        header("Location: panel.php");
      }
    } else {
      $_SESSION['panel_event'] = 'error';
      $_SESSION['message'] = 'Invalid Password.';
      header("Location: panel.php");
    }
  } else {
    $_SESSION['panel_event'] = 'error';
    $_SESSION['message'] = 'Something is wrong.';
    echo '<script>window.history.back();</script>';
  }
} else {
  header('Location: /');
}

?>
