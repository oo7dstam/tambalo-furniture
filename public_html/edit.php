<?php
 
  $page_title = 'Admin Panel';
  $page_description = '';
  include 'header.php';
  include 'navbar.php';
  include'config.php';
  include 'test_input.php';
if($_SESSION['activeUser_type'] == 'admin') {
  ob_start();
  $add_type = $_REQUEST['type'];
  $g_id = $_REQUEST['id'];
  
  if($add_type == 'sash'){
    $sql="SELECT * FROM sash WHERE sash_id='$g_id'";
    $result=mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));
    
    while($row = mysqli_fetch_assoc($result)){
    $id=$row['sash_id'];

    echo '<div id="page-wrapper">
            <div class="row">
              <div class="col-lg-12">
                <h1 class="page-header">Edit</h1>
              </div> <!-- /.col-lg-12 -->
          </div>';

    echo '<div class="panel panel-default">
                <div class="panel-heading">
                    Sash Factory
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <form role="form" method="post" enctype="multipart/form-data" action="update.php?type=sash&g_id='.$id.'" name="form">
                                <div class="form-group">
                                    <label>ID</label>
                                    <input id="disabledInput" class="form-control" type="text" name="c_id" required placeholder="Enter your id" 
                                    value="'.$id.'" id="inputid" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Select Image</label>
                                    <input type="file" name="photo" id="photo" required>
                                </div>
                                <button type="submit" class="btn btn-default" name="update" value="Update" id="inputid" >Submit Button</button>
                            </form>
                        </div>
                    </div>
                </div>
          </div>
        ';
      }
  }elseif($add_type == 'furniture'){
    $sql="SELECT * FROM furniture WHERE furniture_id='$g_id'";
    $result=mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));
    
    while($row = mysqli_fetch_assoc($result)){
    $id=$row['furniture_id'];

    echo '<div id="page-wrapper">
            <div class="row">
              <div class="col-lg-12">
                <h1 class="page-header">Edit</h1>
              </div> <!-- /.col-lg-12 -->
            </div>';


    echo '<div class="panel panel-default">
                <div class="panel-heading">
                    Furniture
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <form role="form" method="post" enctype="multipart/form-data" action="update.php?type=furniture&g_id='.$id.'" name="form">
                                <div class="form-group">
                                    <label>ID</label>
                                    <input id="disabledInput" class="form-control" type="text" name="c_id" required placeholder="Enter your id" 
                                    value="'.$id.'" id="inputid" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Select Image</label>
                                    <input type="file" name="photo" id="photo" required>
                                </div>
                                <button type="submit" class="btn btn-default" name="update" value="Update" id="inputid" >Submit Button</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        ';
      }
  }elseif($add_type == 'general'){
    $sql="SELECT * FROM general_contructing WHERE general_id='$g_id'";
    $result=mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));
    
    while($row = mysqli_fetch_assoc($result)){
    $id=$row['general_id'];

    echo '<div id="page-wrapper">
            <div class="row">
              <div class="col-lg-12">
                <h1 class="page-header">Edit</h1>
              </div> <!-- /.col-lg-12 -->
            </div>';


    echo '<div class="panel panel-default">
                <div class="panel-heading">
                    General Contructing
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <form role="form" method="post" enctype="multipart/form-data" action="update.php?type=general&g_id='.$id.'" name="form">
                                <div class="form-group">
                                    <label>ID</label>
                                    <input id="disabledInput" class="form-control" type="text" name="c_id" required placeholder="Enter your id" 
                                    value="'.$id.'" id="inputid" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Select Image</label>
                                    <input type="file" name="photo" id="photo" required>
                                </div>
                                <button type="submit" class="btn btn-default" name="update" value="Update" id="inputid" >Submit Button</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        ';
      }
  }elseif($add_type == 'gallery'){
    $sql="SELECT * FROM gallery WHERE image_id='$g_id'";
    $result=mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));
    
    while($row = mysqli_fetch_assoc($result)){
    $id=$row['image_id'];

    echo '<div id="page-wrapper">
            <div class="row">
              <div class="col-lg-12">
                <h1 class="page-header">Edit</h1>
              </div> <!-- /.col-lg-12 -->
            </div>';


    echo '<div class="panel panel-default">
                <div class="panel-heading">
                    Gallery
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <form role="form" method="post" enctype="multipart/form-data" action="update.php?type=gallery&g_id='.$id.'" name="form">
                                <div class="form-group">
                                    <label>ID</label>
                                    <input id="disabledInput" class="form-control" type="text" name="c_id" required placeholder="Enter your id" 
                                    value="'.$id.'" id="inputid" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Select Image</label>
                                    <input type="file" name="photo" id="photo" required>
                                </div>
                                <button type="submit" class="btn btn-default" name="update" value="Update" id="inputid" >Submit Button</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        ';
      }
  }elseif ($add_type == "history") {
    $sql="SELECT * FROM history WHERE history_id='$g_id'";
    $result=mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));
    
    while($row = mysqli_fetch_assoc($result)){
    $id=$row['history_id'];
    $histo=$row['history'];
    echo '<div id="page-wrapper">
            <div class="row">
              <div class="col-lg-12">
                <h1 class="page-header">Edit</h1>
              </div> <!-- /.col-lg-12 -->
            </div>';


    echo '<div class="panel panel-default">
                <div class="panel-heading">
                    History
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <form role="form" method="post" enctype="multipart/form-data" action="update.php?type=history&g_id='.$id.'" name="form">
                                <div class="form-group">
                                    <label>ID</label>
                                    <input id="disabledInput" class="form-control" type="text" name="c_id" required placeholder="Enter your id" 
                                    value="'.$id.'" id="inputid" disabled>
                                </div>
                                <div class="form-group">
                                    <label>History</label>
                                    <input class="form-control" type="text" name="history" required placeholder="Enter your history" 
                                    value="'.$histo.'" id="inputid" >
                                </div>
                                <button type="submit" class="btn btn-default" name="update" value="Update" id="inputid" >Submit Button</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        ';
      }
  
  }elseif($add_type == 'company'){
    $edit_type = $_REQUEST['edit'];
    if($edit_type == 'comp'){
      $sql="SELECT * FROM company WHERE company_id='$g_id'";
      $result=mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));
    
      while($row = mysqli_fetch_assoc($result)){
      $id = $row['company_id'];
      $name = $row['company_name'];
      $des = $row['company_slogan'];
      $contact = $row['contact'];
      echo '<div id="page-wrapper">
              <div class="row">
                <div class="col-lg-12">
                  <h1 class="page-header">Edit</h1>
                </div> <!-- /.col-lg-12 -->
              </div>';

      echo '<div class="panel panel-default">
          <div class="panel-heading">
              Company
          </div>
          <div class="panel-body">
              <div class="row">
                  <div class="col-lg-6">          
                      <form role="form" action="update.php?type=company&edit=comp&g_id='.$id.'" method="post" name="insertform">
                          <div class="form-group">
                              <label>ID</label>
                              <input id="disabledInput" class="form-control" type="text" name="c_id" required placeholder="Enter your name" 
                              value="'.$id.'" id="inputid" disabled>
                          </div>
                          <div class="form-group">
                              <label>Company Name</label>
                              <input class="form-control" type="text" name="company_name" required placeholder="Enter your company name" 
                              value="'.$name.'" id="inputid" >
                          </div>
                          <div class="form-group">
                              <label>Company slogan</label>
                              <input class="form-control" type="text" name="company_slogan" required placeholder="Enter your company slogan" 
                              value="'.$des.'" id="inputid" >
                          </div>
                          <div class="form-group">
                              <label>Company Contact</label>
                              <input class="form-control" type="text" name="contact" required placeholder="Enter your company slogan" 
                              value="'.$contact.'" id="inputid" >
                          </div>
                          <button type="submit" class="btn btn-default" name="update" value="Update" id="inputid" >Submit Button</button>
                      </form>
                  </div>
              </div>
          </div>
      </div>';
      }
    }elseif ($edit_type == 'sash') {
      $sql="SELECT * FROM services WHERE services_id='$g_id'";
      $result=mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));
    
    while($row = mysqli_fetch_assoc($result)){
    $id = $row['services_id'];
    $name = $row['services_name'];
    $des = $row['services_des'];

    echo '<div id="page-wrapper">
            <div class="row">
              <div class="col-lg-12">
                <h1 class="page-header">Edit</h1>
              </div> <!-- /.col-lg-12 -->
            </div>';


    echo '<div class="panel panel-default">
                <div class="panel-heading">
                    Sash Factory
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <form role="form" method="post" enctype="multipart/form-data" action="update.php?type=company&edit=sash&g_id='.$id.'" name="form">
                                <div class="form-group">
                                    <label>ID</label>
                                    <input id="disabledInput" class="form-control" type="text" name="c_id" required placeholder="Enter your id" 
                                    value="'.$id.'" id="inputid" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Services Name</label>
                                    <input  class="form-control" type="text" name="services_name" required placeholder="Enter your id" 
                                    value="'.$name.'" id="inputid" >
                                </div>
                                <div class="form-group">
                                    <label>Services Description</label>
                                    <input class="form-control" type="text" name="services_des" required placeholder="Enter your id" 
                                    value="'.$des.'" id="inputid" >
                                </div>
                                <div class="form-group">
                                    <label>Select Image</label>
                                    <input type="file" name="photo" id="photo" >
                                </div>
                                <button type="submit" class="btn btn-default" name="update" value="Update" id="inputid" >Submit Button</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        ';
      }
    }elseif ($edit_type == 'furniture') {
      $sql="SELECT * FROM services WHERE services_id='$g_id'";
      $result=mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));
    
      while($row = mysqli_fetch_assoc($result)){
      $id = $row['services_id'];
      $name = $row['services_name'];
      $des = $row['services_des'];

      echo '<div id="page-wrapper">
              <div class="row">
                <div class="col-lg-12">
                  <h1 class="page-header">Edit</h1>
                </div> <!-- /.col-lg-12 -->
              </div>';


      echo '<div class="panel panel-default">
                  <div class="panel-heading">
                      Furniture
                  </div>
                  <div class="panel-body">
                      <div class="row">
                          <div class="col-lg-6">
                              <form role="form" method="post" enctype="multipart/form-data" action="update.php?type=company&edit=furniture&g_id='.$id.'" name="form">
                                  <div class="form-group">
                                      <label>ID</label>
                                      <input id="disabledInput" class="form-control" type="text" name="c_id" required placeholder="Enter your id" 
                                      value="'.$id.'" id="inputid" disabled>
                                  </div>
                                  <div class="form-group">
                                      <label>Services Name</label>
                                      <input  class="form-control" type="text" name="services_name" required placeholder="Enter your id" 
                                      value="'.$name.'" id="inputid" >
                                  </div>
                                  <div class="form-group">
                                      <label>Services Description</label>
                                      <input class="form-control" type="text" name="services_des" required placeholder="Enter your id" 
                                      value="'.$des.'" id="inputid" >
                                  </div>
                                  <div class="form-group">
                                      <label>Select Image</label>
                                      <input type="file" name="photo" id="photo" >
                                  </div>
                                  <button type="submit" class="btn btn-default" name="update" value="Update" id="inputid" >Submit Button</button>
                              </form>
                          </div>
                      </div>
                  </div>
              </div>
          ';
        }
    }elseif ($edit_type == 'general') {
      $sql="SELECT * FROM services WHERE services_id='$g_id'";
      $result=mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));
    
      while($row = mysqli_fetch_assoc($result)){
      $id = $row['services_id'];
      $name = $row['services_name'];
      $des = $row['services_des'];
      echo '<div id="page-wrapper">
              <div class="row">
                <div class="col-lg-12">
                  <h1 class="page-header">Edit</h1>
                </div> <!-- /.col-lg-12 -->
              </div>';

      echo '<div class="panel panel-default">
                  <div class="panel-heading">
                      General Contructing
                  </div>
                  <div class="panel-body">
                      <div class="row">
                          <div class="col-lg-6">
                              <form role="form" method="post" enctype="multipart/form-data" action="update.php?type=company&edit=furniture&g_id='.$id.'" name="form">
                                  <div class="form-group">
                                      <label>ID</label>
                                      <input id="disabledInput" class="form-control" type="text" name="c_id" required placeholder="Enter your id" 
                                      value="'.$id.'" id="inputid" disabled>
                                  </div>
                                  <div class="form-group">
                                      <label>Services Name</label>
                                      <input  class="form-control" type="text" name="services_name" required placeholder="Enter your id" 
                                      value="'.$name.'" id="inputid" >
                                  </div>
                                  <div class="form-group">
                                      <label>Services Description</label>
                                      <input class="form-control" type="text" name="services_des" required placeholder="Enter your id" 
                                      value="'.$des.'" id="inputid" >
                                  </div>
                                  <div class="form-group">
                                      <label>Select Image</label>
                                      <input type="file" name="photo" id="photo" >
                                  </div>
                                  <button type="submit" class="btn btn-default" name="update" value="Update" id="inputid" >Submit Button</button>
                              </form>
                          </div>
                      </div>
                  </div>
              </div>
          ';
      }
    }else{
      echo'<script>alert("Something Wrong!!");window.location.href="panel.php"</script>';
    }

  }else{
    echo '<script>alert("Cannot add DATA"); window.location.href="panel.php";</script>';
  }
  include 'scripts.php';  
} else {
  header('Location: admin.php');
}
 

 ob_end_flush();

?>