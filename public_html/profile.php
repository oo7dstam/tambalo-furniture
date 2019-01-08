<?php
  require 'config.php';
  $user = $_REQUEST['user'];
  $u_num = $_REQUEST['u_num'];
  $u_id = $_REQUEST['u_id'];
  $table = $user .'s';

  if($user == 'admin') {
    $sql = "SELECT * FROM admins WHERE username = '$u_num' AND id = '$u_id'";
  } else {
    $sql = "SELECT * FROM $table WHERE u_number = '$u_num' AND id = '$u_id'";
  }
  $result	= mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));
  $row = mysqli_fetch_array($result);
  $name = $row['firstname']. " " . $row['lastname'];

  $page_title = $name;
  $page_description = '';
  include 'header.php';
  if(isset($_SESSION['activeUser'])) {
  include 'navbar.php';
?>

<div class="container main-content" style="margin-top: 10px;">
  <div class="row">

    <div class="panel panel-default">
      <div class="panel-heading">
        <h1 class="text-title">
          View Profile
        </h1>
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="col-sm-3">
            <img src="<?php echo $row['image_path']; ?>" class="img-responsive center-block" width="200">
          </div>
          <div class="col-sm-9">
            <table class="table">
            <?php if ($user != 'admin') { ?>
            <tr><td><?php echo ucfirst($user).' Number: <td>'. $row['u_number']; ?></td></tr>
            <?php  } else { ?>
              <tr><td>Username:</td><td/><?php echo $row['username']; ?></td></tr>
            <?php } ?>
            <tr><td>Lastname:</td> <td><?php echo $row['lastname']; ?></td></tr>
            <tr><td>Firstname:</td><td><?php echo $row['firstname']; ?></td></tr>
            <tr><td>Middlename:</td><td><?php echo $row['middlename']; ?></td></tr>
            <tr><td>Email:</td><td><?php echo $row['email']; ?></td></tr>
            <tr><td>Gender:</td><td><?php echo $row['gender']; ?></td></tr>
            <tr><td>User type:</td><td><?php echo $row['user_type']; ?></td></tr>

            </table>
            <?php
              if($_SESSION['activeUser_type'] == 'admin') {
                echo '<button type="button" class="btn btn-danger btn-sm pull-right" data-toggle="modal" title="Delete" data-target="#deleteUser"><i class="fa fa-times"></i> Delete Account</button>
                <div class="modal fade" id="deleteUser" role="dialog">
                    <div class="modal-dialog">
                    <form action="delete.php?type=admin&user='.$user.'&u_num='.$u_num.'&u_id='.$u_id.'" method="post">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h2 class="modal-title text-uppercase">Delete Account</h2>
                          </div>
                          <div class="modal-body">
                            <h3 class="text-center text-uppercase">Are you sure to delete this account ?</h3>
                              <input type="password" class="form-control inputs-fields" name="password" placeholder="Enter password" required>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-danger"><i class="fa fa-user-times"></i> Delete</button>
                            <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                          </div>
                        </div>
                      </form>
                    </div> <!-- end modal-dialog -->
                  </div>';
              }
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
  include 'scripts.php';
} else {
  header("Location: /");
}
?>
