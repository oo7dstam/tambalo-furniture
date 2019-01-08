<?php
  $page_title = 'Admin Panel';
  $page_description = '';
  include 'header.php';
  include 'navbar.php';
  if($_SESSION['activeUser_type'] == 'admin') {
?>
<div id="dashboard" class="clearfix isOpen">
  <?php
    if(isset($_SESSION['panel_event'])) {
      $alertType = $_SESSION['panel_event'];
      $message = $_SESSION['message'];
      include 'alert.php';
      unset($_SESSION['panel_event']);
      unset($_SESSION['message']);
    }
    function token($length = 100) {
      return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
    }
  ?>
  <div class="dashboard-sidebar">
    <div class="header-sidebar-nav clearfix">
      <span class="header-sidebar-title">Dashboard</span>
      <i id="toggle-sidebar" class="fa fa-bars pull-right"></i>
    </div>
    <ul class="sidebar-nav">
      <li>
        <a href="#company">
          <i class="fa fa-building-o"></i>
          <span>Company</span>
        </a>
      </li>
      <li>
        <a href="#gallery">
          <i class="fa fa-image"></i>
          <span>Gallery</span>
        </a>
      </li>
      <li>
        <a href="#history">
          <i class="fa fa-history"></i>
          <span>History</span>
        </a>
      </li>
      <li>
        <a href="#testimonial">
          <i class="fa fa-paragraph"></i>
          <span>Testimonial</span>
        </a>
      </li>
      <li>
        <a href="#services">
          <i class="fa fa-server"></i>
          <span>Services</span>
          <span class="fa fa-caret-down pull-right" data-toggle="collapse" data-target="#serv"></span>
        </a>
        <ul id="serv" class="sub-menu collapse">
          <li class="active">
            <a href="#sash">
              <i class="fa fa-star-o"></i>
              <span>Sash Factory</span>
            </a>
          </li>
          <li>
            <a href="#furniture">
              <i class="fa fa-moon-o"></i>
              <span>Furniture</span>
            </a>
          </li>
          <li>
            <a href="#contructing">
              <i class="fa fa-sun-o"></i>
              <span>Contructing</span>
            </a>
          </li>
        </ul>
      </li>
      <li>
        <a href="#admins">
          <i class="fa fa-cog"></i>
          <span>Admins</span>
         
        </a>
      </li>
    </ul>
  </div>

  <div class="dashboard-content">
    <div class="container-fluid">

      <!-- Company -->
      <div id="company" class="content-tab">
        <div class="panel panel-default">
          <!-- Default panel contents -->
          <div class="panel-heading">
            <div class="row">
              <div class="col-sm-6">
              <h5>Company</h5>
              </div>
              
            </div>
          </div>
          <!-- Table -->
          <table class="table table-bordered display" cellspacing="0">
                    <thead>
                      <tr>
                       
                        <th>Company ID</th>
                        <th>Company Name</th>
                        <th>Company Slogan</th>
                        <th>Company Contact</th>
                        <th class="text-center" width="50px"><i class="fa fa-pencil"></i></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        require 'config.php';
                        $sql = "SELECT * FROM company limit 1";
                        $result = mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));

                        if(mysqli_num_rows($result) != 0) {
                          while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr>';
                            echo '
                                  <td>'.$row['company_id'].'</td>
                                  <td>'.$row['company_name'].'</td>
                                  <td>'.$row['company_slogan'].'</td>
                                  <td>'.$row['contact'].'</td>
                                  <td class="text-center" width="100px">
                                    <a href="edit.php?type=company&edit=comp&id='.$row['company_id'].'" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a>
                                  </td>
                                ';
                            echo '</tr>';
                          }
                        }
                      ?>
                    </tbody>
                  </table>
        </div>
      </div> <!-- End of Company -->

      <!-- Gallery -->
      <div id="gallery" class="content-tab">
        <div class="panel panel-default">
          <!-- Default panel contents -->
          <div class="panel-heading">
            <div class="row">
              <div class="col-sm-6">
              <h5>Gallery</h5>
              </div>
              <div class="col-sm-6">
                <button type="button" class="btn btn-warning btn-add-subject pull-right" data-toggle="modal" data-target="#addImage"><i class="fa fa-plus"></i> Add Image</button>
              </div>
            </div>
          </div>
          <!-- Table -->
          <table class="table table-bordered display" cellspacing="0">
                <thead>
                  <tr>
                    <th width="60px" class="text-center">Image ID</th>
                    <th>Image Name</th>
                    <th class="text-center"><i class="fa fa-pencil"></i> <i class="fa fa-times"></i></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    require 'config.php';
                    $sql = "SELECT * FROM gallery";
                    $result = mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));

                    if(mysqli_num_rows($result) != 0) {
                      while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '
                              <td  width="60px" class="text-center">'.$row['image_id'].'</td>
                              <td>'.$row['image_name'].'</td>
                              <td class="text-center" width="100px">
                                <a href="edit.php?type=gallery&id='.$row['image_id'].'" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a>
                                
                                <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" title="Delete" data-target="#gallery-'.$row['image_id'].'"><i class="fa fa-times"></i></button>
                                <div class="modal fade" id="gallery-'.$row['image_id'].'" role="dialog">
                                      <div class="modal-dialog">
                                      <form action="delete.php?type=gallery&id='.$row['image_id'].'" method="post">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                              <h2 class="modal-title text-uppercase">Delete Image</h2>
                                            </div>
                                            <div class="modal-body">
                                              <h3 class="text-center text-uppercase">Are you sure to delete this Image ?</h3>
                                                <input type="password" class="form-control inputs-fields" name="password" placeholder="Enter password" required>
                                            </div>
                                            <div class="modal-footer">
                                              <button type="submit" class="btn btn-danger"><i class="fa fa-times"></i> Delete</button>
                                              <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-stop-circle"></i> Cancel</button>
                                            </div>
                                          </div>
                                        </form>
                                      </div> <!-- end modal-dialog -->
                              </td>

                            ';
                        echo '</tr>';
                      }
                    }
                  ?>
                </tbody>
          </table>
        </div>
          <div class="modal fade" id="addImage" role="dialog">
              <div class="modal-dialog">
                <form method="post" action="add.php?type=gallery" enctype='multipart/form-data'>
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h2 class="modal-title text-uppercase">Add new Image</h2>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                        
                        <div class="form-group col-sm-12">
                          <label>Select Image</label>
                          <input type="file" name="photo" id="photo" >
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-default"><i class="fa fa-file"></i> Save</button>
                      <button type="reset" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                    </div>
                  </div>
                </form>
              </div> <!-- end modal-dialog -->
          </div>
      </div>  <!-- End of Gallery -->

      <!-- History -->
      <div id="history" class="content-tab">
        <div class="panel panel-default">
          <!-- Default panel contents -->
          <div class="panel-heading">
            <div class="row">
              <div class="col-sm-6">
              <h5>History</h5>
              </div>
              <!-- <div class="col-sm-6">
                <button type="button" class="btn btn-warning btn-add-subject pull-right" data-toggle="modal" data-target="#addImage"><i class="fa fa-plus"></i> Add Image</button>
              </div> -->
            </div>
          </div>
          <!-- Table -->
          <table class="table table-bordered display" cellspacing="0">
                <thead>
                  <tr>
                    <th width="60px" class="text-center">History ID</th>
                    <th>History</th>
                    <th class="text-center"><i class="fa fa-pencil"></i> </th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    require 'config.php';
                    $sql = "SELECT * FROM history";
                    $result = mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));

                    if(mysqli_num_rows($result) != 0) {
                      while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '
                              <td  width="60px" class="text-center">'.$row['history_id'].'</td>
                              <td>'.$row['history'].'</td>
                              <td class="text-center" width="100px">
                                <a href="edit.php?type=history&id='.$row['history_id'].'" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a>
                                
                                
                                
                              </td>

                            ';
                        echo '</tr>';
                      }
                    }
                  ?>
                </tbody>
          </table>
        </div>
          
      </div>  <!-- End of History -->

      <!-- Testimonial -->
      <div id="testimonial" class="content-tab">
        <div class="panel panel-default">
          <!-- Default panel contents -->
          <div class="panel-heading">
            <div class="row">
              <div class="col-sm-6">
              <h5>Testimonial</h5>
              </div>
              <div class="col-sm-6">
                <button type="button" class="btn btn-warning btn-add-account pull-right" data-toggle="modal" data-target="#addTestimonial"><i class="fa fa-user-plus"></i> Add Testimonial</button>
              </div>
            </div>
          </div>
          <!-- Table -->
          <table class="table table-bordered  display" cellspacing="0">
            <thead>
              <tr>
                
                <th>Testimonial Number</th>
                <th>Testimonial</th>
                <th>Testimonial Name</th>
                <th>Testimonial Title</th>
                <th class="text-center" width="50px">
                <i class="fa fa-pencil"></i> <i class="fa fa-times"></i></th>
                
              </tr>
            </thead>
            <tbody>
              <?php
                require 'config.php';
                $sql = "SELECT * FROM testimonial limit 3";
                $result = mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));

                if(mysqli_num_rows($result) != 0) {
                  while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '
                          <td>'.$row['testimonial_id'].'</td>
                          <td>'.ucfirst($row['testimonial']).'</td>
                          <td>'.ucfirst($row['testimonial_name']).'</td>
                          <td>'.ucfirst($row['testimonial_title']).'</td>
                          <td class="text-center"><a href="testimonial_edit.php?testi_id='.$row['testimonial_id'].'" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a>
                           <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" title="Delete" data-target="#testimonial-'.$row['testimonial_id'].'"><i class="fa fa-times"></i></button>
                                <div class="modal fade" id="testimonial-'.$row['testimonial_id'].'" role="dialog">
                                      <div class="modal-dialog">
                                      <form action="delete.php?type=testimonial&id='.$row['testimonial_id'].'" method="post">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                              <h2 class="modal-title text-uppercase">Delete Testimonial</h2>
                                            </div>
                                            <div class="modal-body">
                                              <h3 class="text-center text-uppercase">Are you sure to delete this Testimonial ?</h3>
                                                <input type="password" class="form-control inputs-fields" name="password" placeholder="Enter password" required>
                                            </div>
                                            <div class="modal-footer">
                                              <button type="submit" class="btn btn-danger"><i class="fa fa-times"></i> Delete</button>
                                              <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-stop-circle"></i> Cancel</button>
                                            </div>
                                          </div>
                                        </form>
                                      </div> <!-- end modal-dialog -->
                          </td>
                        ';
                    echo '</tr>';
                  }
                }
              ?>
            </tbody>
          </table>
        </div>
        <div class="modal fade" id="addTestimonial" role="dialog">
          <div class="modal-dialog">
            <form method="post" action="add.php?type=testi" enctype='multipart/form-data'>
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2 class="modal-title text-uppercase">Add new Testimonial</h2>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-sm-12">
                    <input type="text" name="testimonial" class="form-control inputs-fields" placeholder="Enter Testimonial" required>
                  </div>
                  
                  <div class="col-sm-12">
                    <input type="text" name="testimonial_name" class="form-control inputs-fields" placeholder="Enter Testimonial name" required>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <input type="text" name="testimonial_title" class="form-control inputs-fields" placeholder="Enter Testimonial Title" required>
                  </div>
                </div>
                <div class="form-group">
                  <label>Select Image</label>
                  <input type="file" name="photo" id="photo" required="">
                </div>
              </div>
              <div class="modal-footer">
                <button name="send" type="submit" class="btn btn-default"><i class="fa fa-file"></i> Save</button>
                <button type="reset" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
              </div>
            </div>
          </form>
          </div> <!-- end modal-dialog -->
        </div>
      </div> <!-- End of Testimonial -->

     <!-- Services -->
      <div id="services" class="content-tab">
        <ul id="usersOnline" class="nav nav-pills nav-stacked hidden">
          <li class="active"><a data-toggle="tab" href="#sash">Sash Factory</a></li>
          <li ><a data-toggle="tab" href="#furniture">Furniture</a></li>
          <li ><a data-toggle="tab" href="#contructing">General Contructing</a></li>
        </ul>
        <div class="tab-content">
          <div id="sash" class="tab-pane active">
           
            <div class="tab-content">
              <div id="o_admins" class="tab-pane active">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <div class="row">
                      <div class="col-sm-6">
                        <h5>Sash Factory</h5>
                      </div>
                      <div class="col-sm-6">
                      </div>
                    </div>
                  </div>
                  <table class="table table-bordered display" cellspacing="0">
                    <thead>
                      <tr>
                       
                        <th>Services ID</th>
                        <th>Services Name</th>
                        <th>Services Description</th>
                        <th class="text-center" width="50px"><i class="fa fa-pencil"></i></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        require 'config.php';
                        $sql = "SELECT * FROM services where services_id=1";
                        $result = mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));

                        if(mysqli_num_rows($result) != 0) {
                          while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr>';
                            echo '
                                  <td>'.$row['services_id'].'</td>
                                  <td>'.$row['services_name'].'</td>
                                  <td>'.$row['services_des'].'</td>
                                  <td class="text-center" width="100px">
                                    <a href="edit.php?type=company&edit=sash&id='.$row['services_id'].'" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a>
                                    
                                  </td>
                                ';
                            echo '</tr>';
                          }
                        }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-sm-4">
                    <h5>Sash Factory Gallery</h5>
                  </div>
                  <div class="col-sm-8">
                    <div class="row">
                      <div class="col-sm-8">
                      </div>
                      <div class="col-sm-4">
                        <button type="button" class="btn btn-warning btn-add-subject pull-right" data-toggle="modal" data-target="#addSash"><i class="fa fa-plus"></i> Add Imagee</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <table class="table table-bordered display" cellspacing="0">
                <thead>
                  <tr>
                    <th width="60px" class="text-center">Image ID</th>
                    <th>Image Name</th>
                    <th class="text-center"><i class="fa fa-pencil"></i> <i class="fa fa-times"></i></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    require 'config.php';
                    $sql = "SELECT * FROM sash";
                    $result = mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));

                    if(mysqli_num_rows($result) != 0) {
                      while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '
                              <td  width="60px" class="text-center">'.$row['sash_id'].'</td>
                              <td>'.$row['sash_name'].'</td>
                              <td class="text-center" width="100px">
                                <a href="edit.php?type=sash&id='.$row['sash_id'].'" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a>
                                <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" title="Delete" data-target="#sash-'.$row['sash_id'].'"><i class="fa fa-times"></i></button>
                                <div class="modal fade" id="sash-'.$row['sash_id'].'" role="dialog">
                                      <div class="modal-dialog">
                                      <form action="delete.php?type=sash&id='.$row['sash_id'].'" method="post">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                              <h2 class="modal-title text-uppercase">Delete Image</h2>
                                            </div>
                                            <div class="modal-body">
                                              <h3 class="text-center text-uppercase">Are you sure to delete this Image ?</h3>
                                                <input type="password" class="form-control inputs-fields" name="password" placeholder="Enter password" required>
                                            </div>
                                            <div class="modal-footer">
                                              <button type="submit" class="btn btn-danger"><i class="fa fa-times"></i> Delete</button>
                                              <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-stop-circle"></i> Cancel</button>
                                            </div>
                                          </div>
                                        </form>
                                      </div> <!-- end modal-dialog -->
                              </td>
                            ';
                        echo '</tr>';
                      }
                    }
                  ?>
                </tbody>
              </table>
            </div>
            <div class="modal fade" id="addSash" role="dialog">
              <div class="modal-dialog">
                <form method="post" action="add.php?type=sash" enctype='multipart/form-data'>
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h2 class="modal-title text-uppercase">Add new Image</h2>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="form-group col-sm-12">
                        <label>Select Image</label>
                        <input type="file" name="photo" id="photo" required>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-default"><i class="fa fa-file"></i> Save</button>
                    <button type="reset" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                  </div>
                </div>
              </form>
              </div> <!-- end modal-dialog -->
            </div>
          </div>
          <div id="furniture" class="tab-pane">
            <div class="panel panel-default">
                  <div class="panel-heading">
                    <div class="row">
                      <div class="col-sm-6">
                        <h5>Sash Factory</h5>
                      </div>
                      <div class="col-sm-6">
                      </div>
                    </div>
                  </div>
                  <table class="table table-bordered display" cellspacing="0">
                    <thead>
                      <tr>
                       
                        <th>Services ID</th>
                        <th>Services Name</th>
                        <th>Services Description</th>
                        <th class="text-center" width="50px"><i class="fa fa-pencil"></i></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        require 'config.php';
                        $sql = "SELECT * FROM services where services_id=2";
                        $result = mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));

                        if(mysqli_num_rows($result) != 0) {
                          while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr>';
                            echo '
                                  <td>'.$row['services_id'].'</td>
                                  <td>'.$row['services_name'].'</td>
                                  <td>'.$row['services_des'].'</td>
                                  <td class="text-center" width="100px">
                                    <a href="edit.php?type=company&edit=furniture&id='.$row['services_id'].'" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a>
                                  </td>
                                ';
                            echo '</tr>';
                          }
                        }
                      ?>
                    </tbody>
                  </table>
            </div>
            <div class="panel panel-default">              
              <div class="panel-heading">
                <div class="row">
                  <div class="col-sm-4">
                    <h5>Furniture Gallery</h5>
                  </div>
                  <div class="col-sm-8">
                    <div class="row">
                      <div class="col-sm-8">
                      </div>
                      <div class="col-sm-4">
                        <button type="button" class="btn btn-warning btn-add-subject pull-right" data-toggle="modal" data-target="#addFurniture"><i class="fa fa-plus"></i> Add Image</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <table class="table table-bordered display" cellspacing="0">
                <thead>
                  <tr>
                    <th width="60px" class="text-center">Image ID</th>
                    <th>Image Name</th>
                    <th class="text-center"><i class="fa fa-pencil"></i> <i class="fa fa-times"></i></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    require 'config.php';
                    $sql = "SELECT * FROM furniture";
                    $result = mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));

                    if(mysqli_num_rows($result) != 0) {
                      while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '
                              <td  width="60px" class="text-center">'.$row['furniture_id'].'</td>
                              <td>'.$row['furniture_name'].'</td>
                              <td class="text-center" width="100px">
                                <a href="edit.php?type=furniture&id='.$row['furniture_id'].'" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a>
                                <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" title="Delete" data-target="#furniture-'.$row['furniture_id'].'"><i class="fa fa-times"></i></button>
                                <div class="modal fade" id="furniture-'.$row['furniture_id'].'" role="dialog">
                                      <div class="modal-dialog">
                                      <form action="delete.php?type=furniture&id='.$row['furniture_id'].'" method="post">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                              <h2 class="modal-title text-uppercase">Delete Image</h2>
                                            </div>
                                            <div class="modal-body">
                                              <h3 class="text-center text-uppercase">Are you sure to delete this Image ?</h3>
                                                <input type="password" class="form-control inputs-fields" name="password" placeholder="Enter password" required>
                                            </div>
                                            <div class="modal-footer">
                                              <button type="submit" class="btn btn-danger"><i class="fa fa-times"></i> Delete</button>
                                              <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-stop-circle"></i> Cancel</button>
                                            </div>
                                          </div>
                                        </form>
                                      </div> <!-- end modal-dialog -->
                              </td>
                            ';
                        echo '</tr>';
                      }
                    }
                  ?>
                </tbody>
              </table>
            </div>
            <div class="modal fade" id="addFurniture" role="dialog">
              <div class="modal-dialog">
                <form method="post" action="add.php?type=furniture" enctype='multipart/form-data'>
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h2 class="modal-title text-uppercase">Add new Image</h2>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-sm-12">
                        <label>Select Image</label>
                        <input type="file" name="photo" id="photo" required>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-default"><i class="fa fa-file"></i> Save</button>
                    <button type="reset" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                  </div>
                </div>
              </form>
              </div> <!-- end modal-dialog -->
            </div>
          </div>
          <div id="contructing" class="tab-pane">
            <div class="panel panel-default">
                  <div class="panel-heading">
                    <div class="row">
                      <div class="col-sm-6">
                        <h5>General Contructing</h5>
                      </div>
                      <div class="col-sm-6">
                      </div>
                    </div>
                  </div>
                  <table class="table table-bordered display" cellspacing="0">
                    <thead>
                      <tr>
                       
                        <th>General ID</th>
                        <th>General Name</th>
                        <th>General Description</th>
                        <th class="text-center" width="50px"><i class="fa fa-pencil"></i></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        require 'config.php';
                        $sql = "SELECT * FROM services where services_id=3";
                        $result = mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));

                        if(mysqli_num_rows($result) != 0) {
                          while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr>';
                            echo '
                                  <td>'.$row['services_id'].'</td>
                                  <td>'.$row['services_name'].'</td>
                                  <td>'.$row['services_des'].'</td>
                                  <td class="text-center" width="100px">
                                    <a href="edit.php?type=company&edit=general&id='.$row['services_id'].'" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a>
                                  </td>
                                ';
                            echo '</tr>';
                          }
                        }
                      ?>
                    </tbody>
                  </table>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-sm-4">
                    <h5>General Contructing Gallery</h5>
                  </div>
                  <div class="col-sm-8">
                    <div class="row">
                      <div class="col-sm-8">
                      </div>
                      <div class="col-sm-4">
                        <button type="button" class="btn btn-warning btn-add-subject pull-right" data-toggle="modal" data-target="#addGeneral"><i class="fa fa-plus"></i> Add Gallery</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <table class="table table-bordered display" cellspacing="0">
                <thead>
                  <tr>
                    <th width="60px" class="text-center">Image ID</th>
                    <th>Image Name</th>
                    <th class="text-center"><i class="fa fa-pencil"></i> <i class="fa fa-times"></i></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    require 'config.php';
                    $sql = "SELECT * FROM general_contructing";
                    $result = mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));

                    if(mysqli_num_rows($result) != 0) {
                      while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '
                              <td  width="60px" class="text-center">'.$row['general_id'].'</td>
                              <td>'.$row['general_name'].'</td>
                              <td class="text-center" width="100px">
                                <a href="edit.php?type=general&id='.$row['general_id'].'" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a>
                                <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" title="Delete" data-target="#general-'.$row['general_id'].'"><i class="fa fa-times"></i></button>
                                <div class="modal fade" id="general-'.$row['general_id'].'" role="dialog">
                                      <div class="modal-dialog">
                                      <form action="delete.php?type=general&id='.$row['general_id'].'" method="post">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                              <h2 class="modal-title text-uppercase">Delete Image</h2>
                                            </div>
                                            <div class="modal-body">
                                              <h3 class="text-center text-uppercase">Are you sure to delete this Image ?</h3>
                                                <input type="password" class="form-control inputs-fields" name="password" placeholder="Enter password" required>
                                            </div>
                                            <div class="modal-footer">
                                              <button type="submit" class="btn btn-danger"><i class="fa fa-times"></i> Delete</button>
                                              <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-stop-circle"></i> Cancel</button>
                                            </div>
                                          </div>
                                        </form>
                                      </div> <!-- end modal-dialog -->
                              </td>
                            ';
                        echo '</tr>';
                      }
                    }
                  ?>
                </tbody>
              </table>
            </div>
            <div class="modal fade" id="addGeneral" role="dialog">
              <div class="modal-dialog">
                <form method="post" action="add.php?type=general" enctype='multipart/form-data'>
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h2 class="modal-title text-uppercase">Add new Image</h2>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="form-group col-sm-12">
                        <label>Select Image</label>
                        <input type="file" name="photo" id="photo" required>
                      </div>
                    
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-default"><i class="fa fa-file"></i> Save</button>
                    <button type="reset" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                  </div>
                </div>
              </form>
              </div> <!-- end modal-dialog -->
            </div>
          </div>
        </div>
      </div> <!-- End of Services -->

      <!-- Admins -->
      <div id="admins" class="content-tab">
        <div class="panel panel-default">
          <div class="panel-heading">
            <div class="row">
              <div class="col-sm-6">
              <h5>Admin</h5>
              </div>
              <div class="col-sm-6">
                <button type="button" class="btn btn-warning btn-add-account pull-right" data-toggle="modal" data-target="#addAdmin"><i class="fa fa-user-plus"></i> Add Admin</button>
              </div>
            </div>
          </div>
          <!-- Table -->
          <table class="table table-bordered display" cellspacing="0">
            <thead>
              <tr>
                <th class="text-center" width="50px"><i class="fa fa-user"></i></th>
                <th>Username</th>
                <th>Lastname</th>
                <th>Firstname</th>
                <th>Middlename</th>
                <th>Gender</th>
                <th class="text-center" width="50px"><i class="fa fa-eye"></i></th>
              </tr>
            </thead>
            <tbody>
              <?php
                require 'config.php';
                $sql = "SELECT * FROM admins";
                $result = mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));

                if(mysqli_num_rows($result) != 0) {
                  while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td width="50px"><img src="'.$row['image_path'].'" class="img-responsive small-avatar"></td>
                          <td>'.$row['username'].'</td>
                          <td>'.ucfirst($row['lastname']).'</td>
                          <td>'.ucfirst($row['firstname']).'</td>
                          <td>'.ucfirst($row['middlename']).'</td>
                          <td>'.ucfirst($row['gender']).'</td>
                          <td class="text-center" width="50px">';
                          if($row['username'] != $_SESSION['username']) {
                            echo '<a href="profile.php?user=admin&u_num='.$row['username'].'&u_id='.$row['id'].'" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a>';
                          }
                          echo '</td>
                        ';
                    echo '</tr>';
                  }
                }
              ?>
            </tbody>
          </table>
        </div>
        <div class="modal fade" id="addAdmin" role="dialog">
          <div class="modal-dialog">
            <form method="post" action="addAdmin.php?type=account&user=admin" enctype='multipart/form-data'>
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2 class="modal-title text-uppercase">Add new admin account</h2>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-sm-12 ">
                    <input type="text" name="firstname" class="form-control inputs-fields" placeholder="Enter first name" required>
                  </div>
                  <div class="col-sm-12">
                    <input type="text" name="middlename" class="form-control inputs-fields" placeholder="Enter middle name" required>
                  </div>
                  <div class="col-sm-12">
                    <input type="text" name="lastname" class="form-control inputs-fields" placeholder="Enter last name" required>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <input type="text" name="email" class="form-control inputs-fields" placeholder="Enter email address" pattern="^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$" required>
                  </div>
                  <div class="col-sm-6">
                    <select class="form-control inputs-fields" name="gender" required>
                      <option value>Please select gender</option>
                      <option value="male">Male</option>
                      <option value="female">Female</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-default"><i class="fa fa-file"></i> Save</button>
                <button type="reset" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
              </div>
            </div>
          </form>
          </div> <!-- end modal-dialog -->
        </div>
      </div> <!-- End of Admins -->


    </div>
  </div>
</div>
<?php
  include 'scripts.php';
} else {
  header('Location: admin.php');
}
?>
