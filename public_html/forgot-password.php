<?php
  $page_title = 'Forgot Password';
  $page_description = '';
  include 'header.php';
  // include 'navbar.php';

  if(!isset($_SESSION['activeUser'])){
    if(!empty($_POST)) {
      require 'connection.php';
      include 'test_input.php';
      if (isset($_POST['email-fpass'])){
        // $email = test_input($_POST['email-fpass']);

        $email = mysqli_real_escape_string($con,test_input($_POST['email-fpass']));

        function generatePassword($length = 15) {
          return substr(str_shuffle('[];,.<>?:"|{}-0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()_+'), 0, $length);
        }
        $pass = generatePassword();
        $password = md5($pass);

        try {
          $sql = "SELECT * FROM admins WHERE email = '$email'";
          $result	= mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));
          if(mysqli_num_rows($result) != 0) {
            $row = mysqli_fetch_array($result);
            $table = 'admins';
            $link = 'http://tambalofurniture.esy.es/admin.php';
            $fullname = ucfirst($row['firstname']). " " . ucfirst($row['lastname']);
          } else {
            $sql = "SELECT * FROM instructors WHERE email = '$email'";
            $result	= mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));
            if(mysqli_num_rows($result) != 0) {
              $row = mysqli_fetch_array($result);
              $table = 'instructors';
              $link = 'http://tambalofurniture.esy.es/login';
              $fullname = ucfirst($row['firstname']). " " . ucfirst($row['lastname']);
            } else {
              $sql = "SELECT * FROM students WHERE email = '$email'";
              $result	= mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));
              if(mysqli_num_rows($result) != 0) {
                $row = mysqli_fetch_array($result);
                $table = 'students';
                $link = 'http://tambalofurniture.esy.es/login';
                $fullname = ucfirst($row['firstname']). " " . ucfirst($row['lastname']);
              } else {
                $table = 'notexists';
              }
            }
          }


          if($table != 'notexists') {
            $sql = "UPDATE $table SET password = '$password' WHERE email = '$email'";
            $result	= mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));

            ini_set("sendmail_form", "contact@tambalofurniture.com");
        $message = '<html>
              <head>
                <title>Password Reset</title>
              </head>
              <body>
              <div style="width: 600px; font-family: sans-serif;
                margin: 0 auto;
                border: 2px solid #CD6600;">
                <div style="text-align: center;">
                  <h1 style="background: #CD6600; margin: 0;padding: 10px;color: #feba29;font-weight: 300">Notification</h1>
                </div>
                <div style="padding: 10px;">
                  <h3 style="font-weight: 300">Hello '. $fullname .'</h3>
                  <p>Your new password is: '.$pass.'</p>
                  <p>Please be careful next time</p>
                  <br><br>
                  <a href="'. $link .'" style="background-color: #feba29; padding: 10px 15px; text-decoration: none; color: #CD6600;">Click here to login</a>
                  <br><br><br>
                  <p>Regards,</p>
                  <p><a href="http://tambalofurniture.esy.es/">tambalofurniture.esy.es</a></p>
                 </div>
                  <div style="position: relative;height: 40px;padding: 15px 0 10px 0;color: #feba29; display: table;background-color: #CD6600;  width: 100%;">
                    <p style="margin: 0;text-align: center; vertical-align: middle; display: table-cell;">
                      &copy; All Rights Reserved 2016<br>
                      <a href="http://tambalofurniture.esy.es/" style="color: #fff;">tambalofurniture.esy.es</a>
                    </p>
                  </div>
                </div>
              </body>
            </html>';
         $to = $email;
		     $subject = "Forgot Password";
		     $headers = "From: contact@tambalofurniture.esy.es". "\r\n" .
         "Reply-To: contact@reciever@tambalofurniture.esy.es" . "\r\n" .
         "X-Mailer: PHP/" . phpversion();
         $headers = "MIME-Version: 1.0\r\n";
         $headers = "Content-Type: text/html; charset=ISO-8859-1\r\n";
		     mail($to,$subject,$message,$headers);

            $_SESSION['error'] = 'An email was sent to you.';
            $_SESSION['class'] = 'success';
            header("Location: forgot-password.php");

          } else {
            $_SESSION['error'] = 'Email doesn\'t exists!';
            $_SESSION['class'] = 'error';
            header('Location: forgot-password.php');
          }
        } catch (Exception $e) {
          $_SESSION['error'] = 'Email doesn\'t exists!';
          $_SESSION['class'] = 'error';
          header('Location: forgot-password.php');
        }
      }
      mysqli_close($con);
    } else {
?>

<div class="container">
  <div class="row">
    <div class="login-container">
      <div class="logo">
        <img src="assets/images/logo.png" class="img-responsive">
      </div>
      <?php
        if(isset($_SESSION['error']) && isset($_SESSION['class'])) {
          echo '<p class="text-center '.$_SESSION['class'].'">'.$_SESSION['error'].'</p>';
          echo '<script>setTimeout(function(){window.location.href="/"}, 5000)</script>';
          unset($_SESSION['error']);
          unset($_SESSION['class']);
        }
      ?>
      <form <?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
        <input type="email" name="email-fpass" placeholder="Enter email address here" class="form-control inputs-fields" pattern="^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$" required>
        <button type="submit" class="btn btn-default">Retrieve Password</button>
      </form>
    </div>
  </div>
</div>

<?php
  include 'scripts.php';
}
  } else {
    header("Location: /admin.php");
  }
?>
