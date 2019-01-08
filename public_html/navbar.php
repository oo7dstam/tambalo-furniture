<?php
if(isset($_SESSION['message_response'])) {
  $alertType = $_SESSION['message_response'];
  $message = $_SESSION['send_message'];
  include 'alert.php';
  unset($_SESSION['message_response']);
  unset($_SESSION['send_message']);
}
?>

  <nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="panel.php">ADMIN</a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        

        <ul class="nav navbar-nav navbar-right">
          <?php
            if(!isset($_SESSION['activeUser'])) {
              echo '<li><a href="login.php"><i class="fa fa-sign-in"></i> Login</a></li>';
            } else {
              

              echo '
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                '.ucfirst($_SESSION['activeUser_name']).' '.ucfirst($_SESSION['activeUser_lastname']).'
                 <span class="caret"></span></a>
                <ul class="dropdown-menu">';
                if($_SESSION['activeUser_type'] == 'admin') {
                  echo '
                    <li><a href="account.php"><i class="fa fa-user"></i> Account</a></li>
                    <li><a href="panel.php"><i class="fa fa-cog"></i> Admin Panel</a></li>
                    
                    <li role="separator" class="divider"></li>
                    <li><a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a></li>';
                } else {
                  
                }
              echo '</ul>
                  </li>';
              if($_SESSION['activeUser_type'] != 'admin') {
                
              } else {
                echo '<li><img src="'.gravatar($_SESSION['username']).'" class="img-responsive img-circle avatar avatar-md" style="width: 35px; margin-top: 5px;"></li>';
              }
            }
          ?>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>
  