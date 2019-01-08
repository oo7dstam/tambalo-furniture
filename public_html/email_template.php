<?php
ini_set("sendmail_form", "contact@tambalofurniture.com");
        $message = '
        <html>
  <head>
    <title>Credentials</title>
  </head>
  <body>
  <div style="width: 600px; font-family: sans-serif;
    margin: 0 auto;
    border: 2px solid #5c0017;">
    <div style="text-align: center;">
      <h1 style="background: #5c0017; margin: 0;padding: 10px;color: #feba29;font-weight: 300">Login information</h1>
    </div>
    <div style="padding: 10px;">
      <h2 style="font-weight: 300">Hello '. $first_name .' '. $last_name .'</h2>
      <p>You are registered <a href="http://tambalofurniture.esy.es/">E-Classroom</a></p>
      <p>Your '.$user_msg.' is: '. $login .'</p>
      <p>Your password is : '. $convert .'</p>
      <br><br>
      <a href="'. $link .'" style="background-color: #feba29; padding: 10px 15px; text-decoration: none; color: #5c0017;">Click here to login</a>
      <br><br><br>
     </div>
      <div style="position: relative;height: 40px;padding: 15px 0 10px 0;color: #feba29; display: table;background-color: #5c0017;  width: 100%;">
        <p style="margin: 0;text-align: center; vertical-align: middle; display: table-cell;">
          &copy; All Rights Reserved 2016<br>
          <a href="http://e-classroom-mba.com/" style="color: #fff;">e-classroom-mba.com</a>
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
		     mail($to,$subject,$message,$headers);
?>
