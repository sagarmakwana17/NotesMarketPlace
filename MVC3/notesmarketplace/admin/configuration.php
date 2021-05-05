<?php
session_start();
include"../includes/database.php";
 ob_start();

?>
<?php
if(!isset($_SESSION['user_id'])){
    
?>
<script>
    location.replace('../login.php');

</script>
<?php
    
}else{
    $user_id = $_SESSION['user_id'];
}

?>
<!--to get user info-->

<?php
$admin = "SELECT * FROM userprofile WHERE UserID = $user_id AND ProfilePicture IS NOT NULL";
$admin_info = mysqli_query($connection,$admin);
if(!$admin_info){
    die(mysqli_error($connection));
}
    $adm = mysqli_fetch_assoc($admin_info);
if(mysqli_num_rows($admin_info) != 0){
    $profile = $adm['ProfilePicture'];
   
}
   


?>
<?php
                    ob_start();
                    if(isset($_POST['add'])){
                        
                        $s_email = $_POST['s_email'];
                        $phone = $_POST['phone'];
                        $email = $_POST['email'];
                        $fb = $_POST['fb'];
                        $tw = $_POST['tw'];
                        $ln = $_POST['ln'];
                        
                        
                        
                         /*code to upload notes pic*/
                    

                                $file = $_FILES['display_picture'];
                                $file_name = $_FILES['display_picture']['name'];
                                $file_tmp_name = $_FILES['display_picture']['tmp_name'];
                                $file_size = $_FILES['display_picture']['size'];
                                $file_error = $_FILES['display_picture']['error'];

                                /*code to allow only certain types of file*/


                                $file_ext = explode('.', $file_name);
                                $file_actual_ext = strtolower(end($file_ext));
                                $allowed_types = array('jpg','jpeg','png');
                                if(in_array($file_actual_ext,$allowed_types)){
                                    if($file_error === 0){
                                        if($file_size < 500000){
                                            $file_destination = '../uploads/user_profile_pictures/'.$file_name;
                                            move_uploaded_file($file_tmp_name, $file_destination);
                                            $display_pic =  $file_destination;
                                        }else{
                                            echo "your file is too big";
                                        }
                                    }else{
                                        $display_pic_upload_error = "Failed to upload";
                                    }
                                }else{
                                    $display_pic_type_error  = "Please upload only jpeg , jpg and png files";
                                }
                                
                         /*code to upload profile pic*/
                    

                                $file = $_FILES['profile'];
                                $file_name = $_FILES['profile']['name'];
                                $file_tmp_name = $_FILES['profile']['tmp_name'];
                                $file_size = $_FILES['profile']['size'];
                                $file_error = $_FILES['profile']['error'];

                                /*code to allow only certain types of file*/


                                $file_ext = explode('.', $file_name);
                                $file_actual_ext = strtolower(end($file_ext));
                                $allowed_types = array('jpg','jpeg','png');
                                if(in_array($file_actual_ext,$allowed_types)){
                                    if($file_error === 0){
                                        if($file_size < 500000){
                                            $file_destination = '../uploads/user_profile_pictures/'.$file_name;
                                            move_uploaded_file($file_tmp_name, $file_destination);
                                            $profile_pic =  $file_destination;
                                        }else{
                                            echo "your file is too big";
                                        }
                                    }else{
                                        $display_pic_upload_error = "Failed to upload";
                                    }
                                }else{
                                    $display_pic_type_error  = "Please upload only jpeg , jpg and png files";
                                }
                                
                         
                        
                          
      
                    }
                        
                      ?>



<!DOCTYPE html>
<html lang="en">

<head>
    <!--meta tags-->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0 ,user-scalable=no">

    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <!--font awesome -->
    <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
    <!--BOOTSTRAP CSS-->
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">



    <!--Custom CSS-->
    <link rel="stylesheet" href="css/dash.css">
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/config.css">



    <title>System Configurations</title>
</head>


<body>
    <header>
        <div class="container">

            <nav class="navbar navbar-expand-lg navbar-light fixed-top">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarTogglerDemo01">
                    <div class="container">
                        <a class="navbar-brand float-left" href="#"><img src="../img/logo.png" class="img-fluid"></a>
                        <ul class="navbar-nav mr-auto mt-2 mt-lg-0 ml-auto">


                            <li class="nav-item"><a class="nav-link" href="<?php if(isset($user_id)){ echo 'dashboard.php?user_id='.$user_id;}else {echo 'dashboard.php';}?>">Dashboard</a></li>
                            <li class="nav-item note-dropdown">
                                <div class="dropdown show">
                                    <a class="note-dropdown" href="#" role="" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Notes
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="notes_under_review.php">Notes Under Review</a>

                                        <a class="dropdown-item" href="published_notes.php">Published Notes</a>
                                        <a class="dropdown-item" href="download_notes.php">Downloaded Notes</a>
                                        <a class="dropdown-item" href="rejected_notes.php">Rejected Notes</a>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="members.php">Members</a> </li>
                            <li class="nav-item"><a class="nav-link" href="spam_reports.php">Reports</a></li>
                            <li class="nav-item note-dropdown">
                             <div class="dropdown show">
                                    <a class="note-dropdown" href="#" role="" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                                      Settings
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="configuration.php">Configurations</a>

                                        <a class="dropdown-item" href="manage_administrator.php">Manage Administrator</a>
                                        <a class="dropdown-item" href="manage_category.php">Manage Category</a>
                                        <a class="dropdown-item" href="manage_type.php">Manage Types</a>
                                        <a class="dropdown-item" href="manage_country.php">Manage Countries</a>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item ">
                                <div class="dropdown show">
                                    <a class="" href="#" role="" id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <?php
                                       if(isset($profile)){
                                           
                                           ?>
                                        <img class="profile" src="<?php if(isset($profile)){ echo $profile; }?>" alt="">
                                        <?php
                                       }else{
                                          ?>

                                        <img class="profile" src="../img/images/user-l.jpg" alt="">
                                        <?php } ?>
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu">
                                        <a class="dropdown-item" href="my_profile.php">Update Profile</a>

                                        <a class="dropdown-item" href="change_password.php?<?php echo'user_id='.$user_id; ?>">Change Password</a>
                                        <a class="dropdown-item" href="../logout.php">Log out</a>
                                    </div>
                                </div>


                            </li>
                            <li class="nav-item"><a class="btn btn-primary" href="../logout.php" role="button">Log Out</a></li>

                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <style>
       
    </style>
    <section id="add_admin" style="margin-top:70px;">
        <div class="content-box-lg">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="container">
                    <h3>Manage System Configurations</h3>
                   <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="email">Support Email<span style="margin-left: 0px !important; text-align:left !important; color:red"> *</span></label>
                            <input type="email" class="form-control" id="email" name="s_email" placeholder="Enter your support email">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="last-name">Phone Number<span style="margin-left: 0px !important; text-align:left !important; color:red"> *</span></label>
                            <input type="text" class="form-control" id="last-name" placeholder="Enter phone number" name="phone" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="email">Email Address(for various events system will send email)<span style="margin-left: 0px !important; text-align:left !important; color:red"> *</span></label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="last-name">Facebook URL</label>
                            <input type="text" class="form-control" id="last-name" placeholder="Enter Facebook URL" name="fb">
                        </div>
                    </div>
                     <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="last-name">Twitter URL</label>
                            <input type="text" class="form-control" id="last-name" placeholder="Enter Twitter URL" name="tw">
                        </div>
                    </div>
                     <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="last-name">LinkeIn URL</label>
                            <input type="text" class="form-control" id="last-name" placeholder="Enter LinkeIn URL" name="ln" >
                        </div>
                    </div>
                    <br>
                    
                    <div class="form-row">
                        <label for="last-name">Default Picture for Notes</label>
                        <div class="form-group col-md-12">

                            <input type="file" class="form-control p_photo" id="last-name" placeholder="Enter your firstname" name="display_picture">
                             <?php
                             if(isset($display_pic_type_error)){
                            echo "<p style='margin-left: 0px !important; text-align:left !important; color:red'>$display_pic_type_error</p>";
                            }
                          ?>
                        </div>
                    </div>
                     <div class="form-row">
                        <label for="last-name">Default Profile Picture</label>
                        <div class="form-group col-md-12">

                            <input type="file" class="form-control p_photo" id="last-name" placeholder="Enter your firstname" name="profile">
                             <?php
                             if(isset($display_pic_type_error)){
                            echo "<p style='margin-left: 0px !important; text-align:left !important; color:red'>$display_pic_type_error</p>";
                            }
                          ?>
                        </div>
                    </div>
                    <div class="form-row">
                        <button type="submit" class="btn btn-primary" name="add">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <br><br><br><br><br>
    <footer>
        <div class="container">
            <div class="row">
                <!-- Copyright -->
                <div class="col-md-6 col-sm-8 foot-text text-left">
                    <p>Version 1.1.24</p>
                </div>
                <!-- Social Icon -->
                <div class="col-md-6 col-sm-4 foot-icon col-sm-4 text-right">
                    <p>Copyright &copy; TatvaSoft All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </footer>
    <style>
       

    </style>
    <!-- JQUERY JS-->
    <script src="js/jquery-3.5.1.js"></script>
    <!--Bootstrap js-->
    <script src="js/bootstrap.min.js"></script>
    <!--Custom js-->
    <script src="js/script.js"></script>
</body>

</html>
