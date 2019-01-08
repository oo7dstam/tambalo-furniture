<?php
	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  // $data = mysql_real_escape_string($data);
	  return $data;
	}

  function is_valid_email($email) {
    $email = filter_var($email,FILTER_SANITIZE_STRING);
    if (filter_var($email, FILTER_VALIDATE_EMAIL)===FALSE)
      return false;
    return true;
  }
?>
