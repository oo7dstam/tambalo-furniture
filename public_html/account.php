<?php
  $page_title = 'Account';
  $page_description = '';
  include 'header.php';
  if(isset($_SESSION['activeUser'])) {
  include 'navbar.php';

  if(isset($_SESSION['account_event'])) {
    $alertType = $_SESSION['account_event'];
    $message = $_SESSION['message'];
    include 'alert.php';
    unset($_SESSION['account_event']);
    unset($_SESSION['message']);
  }
  require 'config.php';
  $table = $_SESSION['activeUser_type']. 's';

  if($_SESSION['activeUser_type'] == 'admin') {
    $sql = "SELECT * FROM admins WHERE username = '$_SESSION[username]'";
  }
  $result	= mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));
  $row = mysqli_fetch_array($result);
?>
<div id="dashboard" class="clearfix isOpen">
<div class="dashboard-sidebar">
  <div class="header-sidebar-nav clearfix">
    <span class="header-sidebar-title">Account</span>
    <i id="toggle-sidebar" class="fa fa-bars pull-right"></i>
  </div>
  <ul class="sidebar-nav">
    <li>
      <a href="#info">
        <i class="fa fa-user"></i>
        <span>Account information</span>
      </a>
    </li>
    <li>
      <a href="#editInfo">
        <i class="fa fa-pencil"></i>
        <span>Edit information</span>
      </a>
    </li>
    <?php
      if($_SESSION['activeUser_type'] == 'admin' && $row['username_changed'] == 0) {
        echo '
        <li>
          <a href="#editUsername">
            <i class="fa fa-pencil"></i>
            <span>Edit Username</span>
          </a>
        </li>';
      }
    ?>
    <li>
      <a href="#pic">
        <i class="fa fa-image"></i>
        <span>Change picture</span>
      </a>
    </li>
    <li>
      <a href="#pass">
        <i class="fa fa-lock"></i>
        <span>Change Password</span>
      </a>
    </li>
    <?php
    // <li>
    //   <a href="#delete">
    //     <i class="fa fa-times"></i>
    //     <span>Delete Account</span>
    //   </a>
    // </li>
    ?>
  </ul>
</div>

<div class="dashboard-content">
  <div class="container-fluid">
    <div id="info" class="content-tab">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="text-title">Account Information</h3>
        </div>
        <div class="panel-body">
          <div class="row">
            <?php
              echo '
              <div class="col-sm-3">
                <img src="'.$row['image_path'].'" class="img-responsive center-block">
              </div>
              <div class="col-sm-9">
                <table class="table">';
                if($_SESSION['activeUser_type'] == 'admin') {
                  echo '<tr><td>Username</td><td> '. $row['username']. '</td></tr>';
                }
                if($_SESSION['activeUser_type'] == 'student' || $_SESSION['activeUser_type'] == 'instructor') {
                  echo '<tr><td>'.ucfirst($_SESSION['activeUser_type']).' Number</td><td> '. $row['u_number']. '</td></tr>';
                }
                echo '<tr><td>Firstname</td><td> '. $row['firstname']. '</td></tr>';
                echo '<tr><td>Lastname</td><td> '. $row['lastname']. '</td></tr>';
                echo '<tr><td>Middlename</td><td> '. $row['middlename']. '</td></tr>';
                echo '<tr><td>Email</td><td> '. $row['email']. '</td></tr>';
                echo '<tr><td>Gender</td><td> '. ucfirst($row['gender']). '</td></tr>';
                if($_SESSION['activeUser_type'] == 'student') {
                  echo '<tr><td>Year & Section</td><td> '. $row['student_year']. '-'.$row['student_section'].'</td></tr>';
                }
                echo '
                </table>
              </div>';
            ?>
          </div>
        </div>
      </div>
    </div>
    <div id="editInfo" class="content-tab">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="text-title">Edit Information</h3>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-sm-12">
              <form action="update_account.php?user=<?php echo $_SESSION['activeUser_type']; ?>" method="post">
                <?php
                  echo 'Firstname <input type="text" class="form-control inputs-fields" name="firstname" value="'.$row['firstname'].'" required>';
                  echo 'Lastname <input type="text" class="form-control inputs-fields" name="lastname" value="'.$row['lastname'].'" required>';
                  echo 'Middle name <input type="text" class="form-control inputs-fields" name="middlename" value="'.$row['middlename'].'" required>';
                  echo 'Gender <select class="form-control inputs-fields" name="gender" required>
                          <option value="male"'; if($row['gender'] == 'male') {echo 'selected';} echo '>Male</option>
                          <option value="female"'; if($row['gender'] == 'female') {echo 'selected';} echo'>Female</option>
                        </select>';
                ?>
                Password <input type="password" name="password" class="form-control inputs-fields" placeholder="Enter password" required>
                <input type="hidden" name="which" value="info"></br>
                <button type="submit" class="btn btn-default pull-right">Save Changes</button>
              </form>
            </div>
          </div>
        </div>

      </div>
    </div>
    <?php
      if($_SESSION['activeUser_type'] == 'admin' && $row['username_changed'] == 0) { ?>
        <div id="editUsername" class="content-tab">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="text-title">Edit Information</h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-sm-12">
                  <h3>This action can only be done ONCE.</h3>
                  <form action="update_account.php?user=<?php echo $_SESSION['activeUser_type']; ?>" method="post">
                    <?php
                      echo '<input type="text" class="form-control inputs-fields" name="username" required autocomplete="off">';
                    ?>
                    <input type="password" name="password" class="form-control inputs-fields" placeholder="Enter password" required value="">
                    <input type="hidden" name="which" value="username">
                    <button type="submit" class="btn btn-default pull-right">Save Changes</button>
                  </form>
                </div>
              </div>
            </div>

          </div>
        </div>
   <?php } ?>
    <div id="pic" class="content-tab">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="text-title">Change account picture</h3>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-sm-3">
              <img id="imgPreview" class="img-responsive user-avatar-prev" src="<?php echo $row['image_path']; ?>" alt="Preview" style="width: 300px; margin-bottom: 10px;">
            </div>
            <div class="col-sm-9">
              <form class="form-input bordered" action="update_account.php?user=<?php echo $_SESSION['activeUser_type']; ?>" method="post" enctype='multipart/form-data'>
                  <input type="file" name="user_image" id="user_image"  required><br>
                  <p>Please provide your password to proceed</p>
                  <div class="form-group">
                    <input type="password" name="password" class="form-control inputs-fields" style="width:300px;" placeholder="Enter password" required>
                  </div>
                  <button type="submit" class="btn btn-default">Change picture</button>
                  <input type="hidden" name="which" value="pic">
              </form>
            </div>
          </div>
        </div>

      </div>
    </div>
    <div id="pass" class="content-tab">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="text-title">Change account password</h3>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-sm-12">
              <form class="form-input bordered" action="update_account.php?user=<?php echo $_SESSION['activeUser_type']; ?>" method="post">
                Old Password: <input type="password" name="password" placeholder="Enter old password here" class="form-control inputs-fields" required>
                New Password: <input type="password" name="newPassword" placeholder="Enter new password here" class="form-control inputs-fields" required>
                Confirm New Password: <input type="password" name="cPassword" placeholder="Confirm password here" class="form-control inputs-fields" required></br>
                <button type="submit" class="btn btn-default pull-right">Change Password</button>
                <input type="hidden" name="which" value="pass">
              </form>
            </div>
          </div>
        </div>

      </div>
    </div>
    
    <div id="delete" class="content-tab">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="text-title">Deleting account cannot be undone.</h3>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-sm-12">
              <h3 class="sub-title">Please enter password to continue</h3>
              <form class="form-input bordered" action="delete?type=account" method="post">
                <input type="password" class="form-control inputs-fields" name="password" placeholder="Enter password here" required>
                <input type="hidden" name="which" value="account">
                <br>
                <button type="submit" class="btn btn-danger pull-right">DELETE ACCOUNT</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    
  </div>
</div>
</div>

<?php
  include 'scripts.php';
} else {
  header('Location: /');
}
?>
