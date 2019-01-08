
<?php
  $page_title = 'Admin';
  $page_description = '';
  include 'header.php';

  if(!isset($_SESSION['activeUser'])){

    if(!isset($_SESSION['error'])) {
			$_SESSION['error'] = '';
		}

    if(!empty($_POST)) {
      require 'config.php';
      include 'test_input.php';
      if (isset($_POST['username'])){
    		// $username = test_input($_POST['username']);
    		// $pass = test_input($_POST['password']);

        $username = mysqli_real_escape_string($con,test_input($_POST['username']));
        $pass = mysqli_real_escape_string($con,test_input($_POST['password']));
        $password = md5($pass);

    		try {
    			$sql = "SELECT * FROM admins WHERE username = '$username' AND password = '$password';";
    			$result	= mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));
    			$row = mysqli_fetch_array($result);

          if(mysqli_num_rows($result) != 0) {
            $sql = "UPDATE admins SET user_status = 'online' WHERE username = '$username' AND password = '$password';";
      			$result	= mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));

            $_SESSION['activeUser'] = 'active';
            $_SESSION['username'] = $row['username'];
            $_SESSION['u_number'] = $row['username'];
            $_SESSION['activeUser_name'] = ucfirst($row['firstname']);
            $_SESSION['activeUser_lastname'] = ucfirst($row['lastname']);
            $_SESSION['activeUser_type'] = $row['user_type'];
            header('Location: panel.php');
          } else {
            $_SESSION['error'] = 'Invalid username/password';
            echo '<script>window.history.back()</script>';
          }
    		} catch (Exception $e) {
          $_SESSION['error'] = 'Invalid username/password';
          echo '<script>window.history.back()</script>';
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
            if($_SESSION['error'] != '') {
              echo '<p class="text-center error">'.$_SESSION['error'].'</p>';
              unset($_SESSION['error']);
            }
          ?>
        <form <?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
          <div class="input-group">
            <span class="input-group-addon" id="basic-addon1"><i class="fa fa-user"></i></span>
            <input type="username" name="username" class="form-control" placeholder="Enter username here">
          </div>
          <div class="input-group">
            <span class="input-group-addon" id="basic-addon1"><i class="fa fa-lock"></i> </span>
            <input type="password" name="password" class="form-control" placeholder="Enter password here">
          </div>
          <button type="submit" class="btn btn-default"><i class="fa fa-sign-in"></i> Login</button>
        </form>
        <div class="footer">
          <p class="text-left fpass">
            <a href="#" onclick="window.history.back() ">
              <i class="fa fa-arrow-circle-left"></i>
            Back</a>
          </p>
          <p class="text-right fpass">
            <a href="forgot-password.php">Forgot Password
              <i class="fa fa-refresh"></i>
            </a>
          </p>
        </div>
      </div>
  </div>
</div>


<?php
    include 'scripts.php';
  }
} else {
  header('Location: panel.php');
}
?>
