<?php
if(isset($_SESSION['message_response'])) {
  $alertType = $_SESSION['message_response'];
  $message = $_SESSION['send_message'];
  include 'alert.php';
  unset($_SESSION['message_response']);
  unset($_SESSION['send_message']);
}
?>