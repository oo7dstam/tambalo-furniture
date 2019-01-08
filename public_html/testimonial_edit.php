<?php
  $page_title = 'Admin Panel';
  $page_description = '';
  include 'test_input.php';
  include 'header.php';
  include 'navbar.php';
  if($_SESSION['activeUser_type'] == 'admin') {
?>

<div id="page-wrapper">
  <div class="row">
      <div class="col-lg-12">
          <h1 class="page-header">Edit</h1>
      </div> <!-- /.col-lg-12 -->
  </div>
  <?php 
    $testi_id = $_GET['testi_id'];
      ob_start();
      include('config.php');
        if(isset($_GET['testi_id'])){
          $id=$_GET['testi_id'];
            if(isset($_POST['update'])){
              // $testi=$_POST['testi'];
              // $testi_name=$_POST['testi_name'];
              // $testi_title=$_POST['testi_title'];
              
              $testi = mysqli_real_escape_string($con,test_input($_POST['testi']));
              $testi_name = mysqli_real_escape_string($con,test_input($_POST['testi_name']));
              $testi_title = mysqli_real_escape_string($con,test_input($_POST['testi_title']));

              // $name=$_FILES['photo']['name'];
              $name = mysqli_real_escape_string($con,test_input($_FILES['photo']['name']));
              $size=$_FILES['photo']['size'];
              $imgtype=$_FILES['photo']['type'];
              $temp=$_FILES['photo']['tmp_name'];
              $path="assets/images/".$name;

              if ($size == 0) {
                $sql="UPDATE testimonial SET 
                testimonial='$testi', testimonial_name='$testi_name',testimonial_title ='$testi_title' WHERE testimonial_id=$testi_id";
                $result=mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));
                if ($result){
                    echo'<script>alert("Record Updated!!");window.location.href="panel.php"</script>';
                }else{
                    echo'<script>alert("Something Wrong!!");window.location.href="testimonial_edit.php"</script>';
                }
              }else{
                if($imgtype == 'image/jpeg' || $imgtype == 'image/png' || $imgtype == 'image/bmp'){
                 move_uploaded_file($temp,"assets/images/".$name);
                
                $sql="UPDATE testimonial SET 
                testimonial='$testi',testimonial_img='$path', testimonial_name='$testi_name',testimonial_title ='$testi_title' WHERE testimonial_id=$testi_id";
                $result=mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));
                if ($result){
                    echo'<script>alert("Record Updated!!");window.location.href="panel.php"</script>';
                }else{
                    echo'<script>alert("Something Wrong!!");window.location.href="testimonial_edit.php"</script>';
                }
                }else{
                    header('Location: panel.php');
                    echo'Please Select Image Only.';
                } //imgtype
              } // size

                
            } // update
          } // isset
            ob_end_flush();
            ?>

            <?php 
              
              if(isset($_GET['testi_id']))
              {
              $id=$_GET['testi_id'];
              $sql="SELECT * FROM testimonial WHERE testimonial_id='$testi_id'";
              $result=mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));

              if(mysqli_num_rows($result) != 0) {
                  while ($row = mysqli_fetch_assoc($result)) {
             
                $testi_id=$row['testimonial_id'];
                $testi=$row['testimonial'];
                $testi_name=$row['testimonial_name'];
                $testi_title=$row['testimonial_title'];
            ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    Testimonial
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <form role="form" method="post" enctype="multipart/form-data" action="" name="form">
                                <div class="form-group">
                                    <label>ID</label>
                                    <input id="disabledInput" class="form-control" type="text" name="testi_id" required placeholder="Enter your id" 
                                    value="<?php echo $testi_id; ?>" id="inputid" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Testimonial</label>
                                    <input class="form-control" type="text" name="testi" required placeholder="Enter testimonial" 
                                    value="<?php echo $testi; ?>" id="inputid" >
                                </div>
                                <div class="form-group">
                                    <label>Testimonial Name</label>
                                    <input class="form-control" type="text" name="testi_name" required placeholder="Enter Testimonial name" 
                                    value="<?php echo $testi_name; ?>" id="inputid" >
                                </div>
                                <div class="form-group">
                                    <label>Testimonial Title</label>
                                    <input class="form-control" type="text" name="testi_title" required placeholder="Enter Testimonial Title" 
                                    value="<?php echo $testi_title; ?>" id="inputid" >
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

          <?php } } }?>

</div> <!-- /#page-wrapper -->        
<?php
} else {
  header('Location: admin.php');
}
?>