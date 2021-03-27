<?php
include"includes/database.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!--meta tags-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0 ,user-scalable=no">

    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <!--font awesome -->
    <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
    <!--BOOTSTRAP CSS-->
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
    <!--Custom CSS-->
    <link rel="stylesheet" href="css/login2.css">


    <title>Change Password</title>
</head>

<body>
    <center>
        <div class="col-lg-5">
            <img src="img/top-logo.png">
            <?php
                    ob_start();
                    if(isset($_POST['change_password'])){
                        
                        if(isset($_GET['user_id'])){
                            $user_id = $_GET['user_id'];
                        }else{
                            $user_id = 15;
                        }
                       
                        $old_password = $_POST['old_password'];
                         $new_password = $_POST['new_password'];
                        $confirm_new_password = $_POST['confirm_new_password'];
                       
                        $fetch_pass = "SELECT * FROM users WHERE ID = $user_id";
                        $fetch_pass_query = mysqli_query($connection,$fetch_pass);
                        if(!$fetch_pass_query){
                            die(mysqli_error($connection));
                        }
                        
                        $user_data = mysqli_fetch_assoc($fetch_pass_query);
                        $db_password = $user_data['Password'];
                        
                        
                if($db_password == $old_password){
                        
                        
                         if(!preg_match('/(?=.*[a-z])(?=.*[0-9])(?=.*[@?!#$^%&*])[a-zA-Z0-9@?!#$^%&*]{6,28}/',  $new_password)){
                            $password_err = "Password Must contain at least 1 special character,1 lowercase character and it should be 6 to 28 digits long !";
                        }
                          
                        else if(preg_match('/(?=.*[a-z])(?=.*[0-9])(?=.*[@?!#$^%&*])[a-zA-Z0-9@?!#$^%&*]{6,28}/',  $new_password) && $new_password= $confirm_new_password ){
                        
                            $query = "UPDATE users SET Password = '{$new_password}' WHERE ID = $user_id";
                            $registration_query = mysqli_query($connection, $query);
                            if(!$registration_query){
                              die("FAILED TO EXECUTE YOUR REQUEST" . mysqli_error($connection));
                           }
                            if($registration_query){
                                
                            
                                
                            }
                        
                       }
                        
                        
                        
                    }else if($db_password !== $old_password){
                    $wrong_password = "Please Enter Correct Password !";
                       
                    }
                 }
                        
         ?>

            <form class="" id="login-form" method="post" action="">
                <h4>Change Password</h4>
                <p>Enter your old password to change it</p>


                <div class="form-group">
                    <div style="margin-left: 0px !important; text-align:left !important">
                        <label for="exampleInputPassword1">Old Password </label>
                    </div>
                    <input type="password" class="form-control" id="password-field" placeholder="Enter your old Password" value="" name="old_password">
                    <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    <p style="margin-left: 0px !important; text-align:left !important; color:red">
                    <?php
                        if(isset($wrong_password)){
                            echo $wrong_password;
                        }
                        ?>
                    </p>


                </div>
                <div class="form-group">
                    <div style="margin-left: 0px !important; text-align:left !important">
                        <label for="exampleInputPassword1">New Password </label>
                    </div>
                    <input type="password" class="form-control" id="password-field" placeholder="Enter New Password" value="" name="new_password">
                    <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    <p style="margin-left: 0px !important; text-align:left !important; color:red">
                        <?php
                        if(isset($password_err)){
                            echo $password_err;
                        }
                        ?>
                    </p>


                </div>
                <div class="form-group">
                    <div style="margin-left: 0px !important; text-align:left !important">
                        <label for="exampleInputPassword1">Confirm New Password </label>
                    </div>
                    <input type="password" class="form-control" id="password-field" placeholder="Re-Enter New  Password" value="" name="confirm_new_password">
                    <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    <p style="margin-left: 0px !important; text-align:left !important; color:red">

                    </p>


                </div>

                <button type="submit" class="btn btn-primary" name="change_password">CHANGE PASSWORD</button>

            </form>
        </div>


    </center>






    <!-- JQUERY JS-->
    <script src="js/jquery-3.5.1.js"></script>
    <!--Bootstrap js-->
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
    <!--Custom js-->
    <script src="js/script.js"></script>
</body>

</html>
