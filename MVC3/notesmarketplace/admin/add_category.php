
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
                        $cat_name= $_POST['cat_name'];
                        $des= $_POST['des'];
                       
                       
                        if(preg_match('/[0-9]/', $cat_name)){
                        $text_only_error = "Numeric Value is not allowed !";
                        }
                        
                        else if(!preg_match('/[0-9]/', $cat_name)){
                            
                            if(isset($_GET['edit'])){
                                $query = "UPDATE notecategories SET Name = '{$cat_name}', Description = '{$des}', ModifiedDated = now(), Modifiedby = $user_id WHERE ID = $cat_id";
                                
                            }else{
                            $query = "INSERT INTO notecategories(Name,Description,CreatedDate,CreatedBy) VALUES('{$cat_name}','{$des}',now(),$user_id)";
                            }
                                
                            $registration_query = mysqli_query($connection, $query);
                            if(!$registration_query){
                              die("FAILED TO EXECUTE YOUR REQUEST" . mysqli_error($connection));
                           }
                                
                                
                            if($registration_query){
                         
                             echo "added successfully";
                                
                            }
                        
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
    <link rel="stylesheet" href="css/add_cat.css">

    <title>Add Category</title>
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
            <form action="" method="post">
                <div class="container">
                    <h3>Add Category</h3>
                    <?php
                    if(isset($_GET['edit'])){
                        $cat_id = $_GET['edit'];
                        $c = "SELECT * FROM notecategories WHERE ID = $cat_id";
                        $c_query = mysqli_query($connection,$c);
                        if(!$c_query){
                            die(mysqli_error($connection));
                        }
                        $c_data = mysqli_fetch_assoc($c_query);
                        $c_name = $c_data['Name'];       
                        $c_des = $c_data['Description']; 
                    }
                    ?>
                    
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="first-name">Category Name<span style="margin-left: 0px !important; text-align:left !important; color:red"> *</span></label>
                            <input type="text" class="form-control" id="first-name" placeholder="Enter Category Name" name="cat_name" value="<?php if(isset($c_name)){ echo $c_name; } ?>" required>
                             <?php
                             if(isset($text_only_error)){
                            echo "<p style='margin-left: 0px !important; text-align:left !important; color:red'>$text_only_error</p>";
                            }
                    ?>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="last-name">Description<span style="margin-left: 0px !important; text-align:left !important; color:red"> *</span></label>
                            <input type="text" class="form-control des" id="last-name" placeholder="Enter Description" name="des" value="<?php if(isset($c_des)){ echo $c_des; } ?>" required>
                        </div>
                    </div>
                   
                    <div class="form-row">
                       <button type="submit" class="btn btn-primary" name="add">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <br><br><br><br>
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
