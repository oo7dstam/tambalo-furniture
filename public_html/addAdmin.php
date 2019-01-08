<?php
$page_title = 'Contact Us';
$page_description = '';

function generatePassword($length = 10) {
  return substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $length);
}
function generateUsername($length = 10) {
  return substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
}

if (isset($_POST['send'])) {
	require 'test_input.php';
  	ob_start();
    $user_type = $_REQUEST['user'];
    
  	function addUser($user_type){
    require 'config.php';
    $message = '';

	    try {

			// $email =  test_input($_POST['email']);
			$email = mysqli_real_escape_string($con,test_input($_POST['email']));
	    	if(is_valid_email($email)) {
	    		$sql_email = "SELECT email FROM admins WHERE email = '$email'";
		    	$result_email = mysqli_query($con,$sql_email) or die('Error: ' . mysqli_error($con));
	    		
	    		if(mysqli_num_rows($result_email) == 0){
	    			// $firstname = test_input($_POST['firstname']);
			     //    $lastname = test_input($_POST['lastname']);
			     //    $middlename = test_input($_POST['middlename']);
			     //    $gender = test_input($_POST['gender']);

			        $firstname = mysqli_real_escape_string($con,test_input($_POST['firstname']));
			        $lastname = mysqli_real_escape_string($con,test_input($_POST['lastname']));
			        $middlename = mysqli_real_escape_string($con,test_input($_POST['middlename']));
			        $gender = mysqli_real_escape_string($con,test_input($_POST['gender']));

			        $number = date("Ymds");

			        // generate password
			        $convert = generatePassword();
			        $password = md5($convert);

			        if($firstname && $lastname && $middlename && $email && $gender){
			        	if($gender == 'male' || $gender == 'female') {
			        		if($gender == 'male') {
			                	$image = 'assets/images/male.png';
			                } else {
			                	$image = 'assets/images/female.png';
			                }

			                if($user_type == 'admin') {
			                	// checks if username exist if yes then generate a random username
				            	$sql = "SELECT username FROM admins WHERE username = '$convert'";
				            	$result = mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));
			               		
			               		if(mysqli_num_rows($result) != 0) {
			                    	$username = $convert;
			                    } else {
			                    	$username = generateUsername();
			                    }

			                    //This will be include in email
			                    $user_msg = 'Admin Username';
			                    $login = $username;
			                    $link = 'http://tambalofurniture.esy.es/admin.php';

			                    $sql = "INSERT INTO admins(username, password, firstname, middlename, lastname, email, gender, image_path)
	                            	VALUES('$username', '$password', '$firstname', '$middlename', '$lastname', '$email', '$gender', '$image')";
	                        	$result = mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));
				               	
				               	// email goes here.
				               	ini_set("sendmail_form", "contact@tambalofurniture.com");
						        $message = '
						        <html>
								  	<head>
								    	<title>Credentials</title>
								    </head>
						  		<body>
									    <div style="width: 600px; font-family: sans-serif;
									    margin: 0 auto;
									    border: 2px solid #CD6600;">
									    <div style="text-align: center;">
									      <h1 style="background: #CD6600; margin: 0;padding: 10px;color: #feba29;font-weight: 300">Login information</h1>
									    </div>
								    	<div style="padding: 10px;">
										    <h2 style="font-weight: 300">Hello '. $firstname .' '. $lastname .'</h2>
										    <p>You are registered <a href="http://tambalofurniture.esy.es/">TambaloFurniture</a></p>
										    <p>Your '.$user_msg.' is: '. $login .'</p>
										    <p>Your password is : '. $convert .'</p>
										    <br><br>
										    <a href="'. $link .'" style="background-color: #feba29; padding: 10px 15px; text-decoration: none; color: #CD6600;">Click here to login</a>
										    <br><br><br>
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
								$subject = "Registration";
								$headers = "From: Registration@tambalofurniture.esy.es". "\r\n" .
						        "Reply-To: Registration@reciever@tambalofurniture.esy.es" . "\r\n" .
						        "X-Mailer: PHP/" . phpversion();
						        $headers = "MIME-Version: 1.0\r\n";
						        $headers = "Content-Type: text/html; charset=ISO-8859-1\r\n";
								mail($to,$subject,$message,$headers);

				                  
				            	echo'<script>alert("Account Added. Password was sent in email");window.location.href="panel.php"</script>';
				                  // end of query
			                }else{

			                }
			        	}else{ // gender
				            $_SESSION['panel_event'] = 'error';
				            $_SESSION['message'] = 'Cannot add data';		        		
			        	}
			        }else{ // firstname ...
			        	$_SESSION['panel_event'] = 'error';
			        	$_SESSION['message'] = 'Please check inputs';
			        }
	    		echo '<script>alert("Pasok.");window.location.href="panel.php"</script>';
	    		}else{ // check email exist
			        $_SESSION['panel_event'] = 'error';
			        $_SESSION['message'] = 'Email address exist';
	    		}
	   
	    	}else{ // is_valid_email
	        	$_SESSION['panel_event'] = 'error';
	        	$_SESSION['message'] = 'Please check inputs';        
	    	}
	
	    	
	    } catch (Exception $e) {
	    	echo '<script>alert("Something Wrong.");window.location.href="panel.php"</script>';	
	    }
	}
	if($user_type == 'admin') {
        addUser('admin');
      } else {
        echo '<script>alert("Cannot add DATA"); window.location.href="panel.php";</script>';
      }
	ob_end_flush();
}else{
	header("locatio: panel.php");
}
?>