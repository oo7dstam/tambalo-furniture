<?php
$page_title = 'Contact Us';
$page_description = '';

if(isset($_POST['send'])) {
  require 'test_input.php';
  ob_start();
  // $from_email = test_input($_POST['email']);
  // $fullname = test_input($_POST['fullname']);
  // $message_content = test_input($_POST['message']);

  $from_email = mysqli_real_escape_string($con,test_input($_POST['email']));
  $fullname = mysqli_real_escape_string($con,test_input($_POST['fullname']));
  $message_content = mysqli_real_escape_string($con,test_input($_POST['message']));

  try {
    if($from_email && $fullname && $message_content) {
      if(strlen($message_content) >= 30 && strlen($message_content) <= 1000) {
       	ini_set("sendmail_form", "contact@tambalofurniture.com");
        $message = '
        <html>
          <head>
            <title>Contact US</title>
          </head>
          <body>
          <div style="width: 600px; font-family: sans-serif;
            margin: 0 auto;
            border: 2px solid #CD6600;">
            <div style="text-align: center;">
              <h1 style="background: #CD6600; margin: 0;padding: 10px;color: white;font-weight: 300">Message</h1>
            </div>
            <div style="padding: 10px;">
              <p>'.$message_content.'</p>
              <br><br><br>

              <p>Regards,</p>
              <p>'.$fullname.'</p>
              <p>email: '.$from_email.'</p>
             </div>
              <div style="position: relative;height: 40px;padding: 15px 0 10px 0;color: #feba29; display: table;background-color: #CD6600;  width: 100%;">
                <p style="margin: 0;text-align: center; vertical-align: middle; display: table-cell;">
                  &copy; All Rights Reserved 2016<br>
                  <a href="http://tambalofurniture.esy.es/" style="text-decoration:underline; color: #fff;">tambalofurniture.esy.es</a>
                </p>
              </div>
            </div>
          </body>
        </html>';
         $to = "davetambalo@gmail.com";
		     $subject = "Contact Us";
		     $headers = "From: contact@tam-furniture.comxa.com". "\r\n" .
         "Reply-To: contact@reciever@tam-furniture.comxa.com" . "\r\n" .
         "X-Mailer: PHP/" . phpversion();
         $headers = "MIME-Version: 1.0\r\n";
         $headers = "Content-Type: text/html; charset=ISO-8859-1\r\n";
		     $result_email = mail($to,$subject,$message,$headers);

         if (!$result_email) {
           echo '<script>alert("Email Not Delivered!!"); window.location.href="panel.php";</script>';
         }else{
          echo '<script>alert("Email Successfully Delivered"); window.location.href="panel.php";</script>';
         }
      	echo '<script>alert("Thank you for contacting us. We will try to respond to you ASAP.");window.location.href="/"</script>';
      } else {
      	echo '<script>alert("Message length must greater than 30 characters and less than 255 characters.");window.location.href="/"</script>';
      }
    } else {
	echo '<script>alert("Something Wrong.");window.location.href="/"</script>';
    }
  } catch(Exception $e) {
  	echo '<script>alert("Something Wrong.");window.location.href="/"</script>';
  }
  ob_end_flush();
} else {
	header("location: /");
}
?>			