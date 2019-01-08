<?php
$page_title = 'Admin Panel';
$page_description = '';
include 'header.php';
include'config.php';
include 'test_input.php';
// include 'navbar.php';
if($_SESSION['activeUser_type'] == 'admin') {
    if(isset($_POST['update'])){

        ob_start();
        $add_type = $_REQUEST['type'];
        $g_id = $_REQUEST['g_id'];

        if($add_type == 'sash'){
            $name=$_FILES['photo']['name'];
            $size=$_FILES['photo']['size'];
            $imgtype=$_FILES['photo']['type'];
            $temp=$_FILES['photo']['tmp_name'];
            $path="assets/images/".$name;

            if($imgtype == 'image/jpeg' || $imgtype == 'image/png' || $imgtype == 'image/bmp'){
                move_uploaded_file($temp,"assets/images/".$name);
            
                $sql="UPDATE sash SET 
                sash_name='$name', sash_img_path='$path' WHERE sash_id=$g_id";
                $result=mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));
                
                if ($result){
                    echo'<script>alert("Record Updated!!");window.location.href="panel.php"</script>';
                }else{
                    echo'<script>alert("Something Wrong!!");window.location.href="edit.php"</script>';
                }

            }else{
                header('Location: edit.php');
                echo'<script>alert("Select Image Only!!");window.location.href="edit.php"</script>';
            }
        }elseif($add_type == 'furniture'){
            $name=$_FILES['photo']['name'];
            $size=$_FILES['photo']['size'];
            $imgtype=$_FILES['photo']['type'];
            $temp=$_FILES['photo']['tmp_name'];
            $path="assets/images/".$name;

            if($imgtype == 'image/jpeg' || $imgtype == 'image/png' || $imgtype == 'image/bmp'){
                move_uploaded_file($temp,"assets/images/".$name);
            
                $sql="UPDATE furniture SET 
                furniture_name='$name', furniture_img_path='$path' WHERE furniture_id=$g_id";
                $result=mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));
                
                if ($result){
                    echo'<script>alert("Record Updated!!");window.location.href="panel.php"</script>';
                }else{
                    echo'<script>alert("Something Wrong!!");window.location.href="edit.php"</script>';
                }

            }else{
                header('Location: edit.php');
                echo'<script>alert("Select Image Only!!");window.location.href="edit.php"</script>';
            }
        }elseif($add_type == 'general'){
            $name=$_FILES['photo']['name'];
            $size=$_FILES['photo']['size'];
            $imgtype=$_FILES['photo']['type'];
            $temp=$_FILES['photo']['tmp_name'];
            $path="assets/images/".$name;

            if($imgtype == 'image/jpeg' || $imgtype == 'image/png' || $imgtype == 'image/bmp'){
                move_uploaded_file($temp,"assets/images/".$name);
            
                $sql="UPDATE general_contructing SET 
                general_name='$name', general_img_path='$path' WHERE general_id=$g_id";
                $result=mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));
                
                if ($result){
                    echo'<script>alert("Record Updated!!");window.location.href="panel.php"</script>';
                }else{
                    echo'<script>alert("Something Wrong!!");window.location.href="edit.php"</script>';
                }

            }else{
                header('Location: edit.php');
                echo'<script>alert("Select Image Only!!");window.location.href="edit.php"</script>';
            }
        }elseif($add_type == 'gallery'){
            $name=$_FILES['photo']['name'];
            $size=$_FILES['photo']['size'];
            $imgtype=$_FILES['photo']['type'];
            $temp=$_FILES['photo']['tmp_name'];
            $path="assets/images/".$name;

            if($imgtype == 'image/jpeg' || $imgtype == 'image/png' || $imgtype == 'image/bmp'){
                move_uploaded_file($temp,"assets/images/".$name);
            
                $sql="UPDATE gallery SET 
                image_name='$name', image_path='$path' WHERE image_id=$g_id";
                $result=mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));
                
                if ($result){
                    echo'<script>alert("Record Updated!!");window.location.href="panel.php"</script>';
                }else{
                    echo'<script>alert("Something Wrong!!");window.location.href="edit.php"</script>';
                }

            }else{
                header('Location: edit.php');
                echo'<script>alert("Select Image Only!!");window.location.href="edit.php"</script>';
            }
        }elseif ($add_type == 'history') {
            // $e_history = test_input($_POST['history']);
            $e_history = mysqli_real_escape_string($con,test_input($_POST['history']));

            $sql="UPDATE history SET 
                history='$e_history' WHERE history_id=$g_id";
            $result=mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));
                
            if ($result){
                echo'<script>alert("Record Updated!!");window.location.href="panel.php"</script>';
            }else{
                echo'<script>alert("Something Wrong!!");window.location.href="edit.php"</script>';
            }
        }elseif($add_type == 'company'){
            $edit_type = $_REQUEST['edit'];
            if($edit_type == 'comp'){
                // $e_name = test_input($_POST['company_name']);
                // $e_des = test_input($_POST['company_slogan']);
                // $e_contact = test_input($_POST['contact']);
                
                $e_name = mysqli_real_escape_string($con,test_input($_POST['company_name']));
                $e_des = mysqli_real_escape_string($con,test_input($_POST['company_slogan']));
                $e_contact = mysqli_real_escape_string($con,test_input($_POST['contact']));

                $sql="UPDATE company SET 
                    company_name='$e_name', company_slogan='$e_des', contact='$e_contact' WHERE company_id=$g_id";
                $result=mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));
                    
                if ($result){
                    echo'<script>alert("Record Updated!!");window.location.href="panel.php"</script>';
                }else{
                    echo'<script>alert("Something Wrong!!");window.location.href="edit.php"</script>';
                }
            }elseif ($edit_type == 'sash') {

                // $e_name = test_input($_POST['services_name']);
                // $e_des = test_input($_POST['services_des']);

                $e_name = mysqli_real_escape_string($con,test_input($_POST['services_name']));
                $e_des
                 = mysqli_real_escape_string($con,test_input($_POST['services_des']));

                $name=$_FILES['photo']['name'];
                $size=$_FILES['photo']['size'];
                $imgtype=$_FILES['photo']['type'];
                $temp=$_FILES['photo']['tmp_name'];
                $path="assets/images/".$name;

                if ($_FILES['photo']['size']==0 ) {
                   
                    $sql="UPDATE services SET 
                        services_name='$e_name',services_des='$e_des' WHERE services_id=$g_id";
                    $result=mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));
                        
                    if ($result){
                        echo'<script>alert("Record Updated!!");window.location.href="panel.php"</script>';
                    }else{
                        echo'<script>alert("Something Wrong!!");window.location.href="edit.php"</script>';
                    }

                }else{

                    if($imgtype == 'image/jpeg' || $imgtype == 'image/png' || $imgtype == 'image/bmp'){
                        move_uploaded_file($temp,"assets/images/".$name);
                    
                        $sql="UPDATE services SET 
                        services_img_path='$path',services_name='$e_name',services_des='$e_des' WHERE services_id=$g_id";
                        $result=mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));
                        
                        if ($result){
                            echo'<script>alert("Record Updated!!");window.location.href="panel.php"</script>';
                        }else{
                            echo'<script>alert("Something Wrong!!");window.location.href="edit.php"</script>';
                        }

                    }else{
                        header('Location: edit.php');
                        echo'<script>alert("Select Image Only!!");window.location.href="edit.php"</script>';
                    }
                }                

            }elseif ($edit_type == 'furniture') {
                // $e_name = test_input($_POST['services_name']);
                // $e_des = test_input($_POST['services_des']);

                $e_name = mysqli_real_escape_string($con,test_input($_POST['services_name']));
                $e_des = mysqli_real_escape_string($con,test_input($_POST['services_des']));

                $name=$_FILES['photo']['name'];
                $size=$_FILES['photo']['size'];
                $imgtype=$_FILES['photo']['type'];
                $temp=$_FILES['photo']['tmp_name'];
                $path="assets/images/".$name;

               if ($_FILES['photo']['size']==0 ) {
                   
                    $sql="UPDATE services SET 
                        services_name='$e_name',services_des='$e_des' WHERE services_id=$g_id";
                    $result=mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));
                        
                    if ($result){
                        echo'<script>alert("Record Updated!!");window.location.href="panel.php"</script>';
                    }else{
                        echo'<script>alert("Something Wrong!!");window.location.href="edit.php"</script>';
                    }

                }else{

                    if($imgtype == 'image/jpeg' || $imgtype == 'image/png' || $imgtype == 'image/bmp'){
                        move_uploaded_file($temp,"assets/images/".$name);
                    
                        $sql="UPDATE services SET 
                        services_img_path='$path',services_name='$e_name',services_des='$e_des' WHERE services_id=$g_id";
                        $result=mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));
                        
                        if ($result){
                            echo'<script>alert("Record Updated!!");window.location.href="panel.php"</script>';
                        }else{
                            echo'<script>alert("Something Wrong!!");window.location.href="edit.php"</script>';
                        }

                    }else{
                        header('Location: edit.php');
                        echo'<script>alert("Select Image Only!!");window.location.href="edit.php"</script>';
                    }
                }
            }elseif ($edit_type == 'general') {
                // $e_name = test_input($_POST['services_name']);
                // $e_des = test_input($_POST['services_des']);

                $e_name = mysqli_real_escape_string($con,test_input($_POST['services_name']));
                $e_des = mysqli_real_escape_string($con,test_input($_POST['services_des']));

                $name=$_FILES['photo']['name'];
                $size=$_FILES['photo']['size'];
                $imgtype=$_FILES['photo']['type'];
                $temp=$_FILES['photo']['tmp_name'];
                $path="assets/images/".$name;

                if ($_FILES['photo']['size']==0 ) {
                   
                    $sql="UPDATE services SET 
                        services_name='$e_name',services_des='$e_des' WHERE services_id=$g_id";
                    $result=mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));
                        
                    if ($result){
                        echo'<script>alert("Record Updated!!");window.location.href="panel.php"</script>';
                    }else{
                        echo'<script>alert("Something Wrong!!");window.location.href="edit.php"</script>';
                    }

                }else{

                    if($imgtype == 'image/jpeg' || $imgtype == 'image/png' || $imgtype == 'image/bmp'){
                        move_uploaded_file($temp,"assets/images/".$name);
                    
                        $sql="UPDATE services SET 
                        services_img_path='$path',services_name='$e_name',services_des='$e_des' WHERE services_id=$g_id";
                        $result=mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));
                        
                        if ($result){
                            echo'<script>alert("Record Updated!!");window.location.href="panel.php"</script>';
                        }else{
                            echo'<script>alert("Something Wrong!!");window.location.href="edit.php"</script>';
                        }

                    }else{
                        header('Location: edit.php');
                        echo'<script>alert("Select Image Only!!");window.location.href="edit.php"</script>';
                    }
                }
            }else{
                echo'<script>alert("Something Wrong!!");window.location.href="panel.php"</script>';
            }
        }else{
        echo '<script>alert("Cannot add DATA"); window.location.href="panel.php";</script>';
        }
        ob_end_flush();
    }else{
        header("Location: panel.php");
    }
} else {
  header('Location: admin.php');
}


?>