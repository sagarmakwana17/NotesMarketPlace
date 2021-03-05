<?php
include"includes/database.php";
?>
<?php
      session_start();
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
    <link rel="stylesheet" href="css/user_registration.css">
    <title>User Registration</title>
</head>

<body>
    <center>
        <div id="login_wrapper">
            <img src="img/top-logo.png">


            <?php
                    ob_start();
                    if(isset($_POST['sign_up'])){
                        $first_name= $_POST['first_name'];
                        $last_name= $_POST['last_name'];
                        $email = $_POST['email'];
                        $password1 = $_POST['password1'];
                        $password2 = $_POST['password2'];
                        
                        /*   filtering the entered data*/
                        $first_name  = mysqli_real_escape_string($connection, $first_name);
                        $last_name  = mysqli_real_escape_string($connection, $last_name);
                        $email  = mysqli_real_escape_string($connection, $email);
                       
                        $password2  = mysqli_real_escape_string($connection, $password2);
                       
                        if(preg_match('/[0-9]/', $first_name)){
                        $text_only_error_firstname = "Numeric Value is not allowed !";
                        }
                        
                        else if(preg_match('/[0-9]/', $last_name)){
                        $text_only_error_lastname = "Numeric Value is not allowed !";
                       }
                        else if(!preg_match('/(?=.*[a-z])(?=.*[0-9])(?=.*[@?!#$^%&*])[a-zA-Z0-9@?!#$^%&*]{6,28}/', $password1)){
                            $password_err = "Password Must contain at least 1 special character,1 lowercase character and it should be 6 to 28 digits long !";
                        }
                          
                        else if(preg_match('/(?=.*[a-z])(?=.*[0-9])(?=.*[@?!#$^%&*])[a-zA-Z0-9@?!#$^%&*]{6,28}/', $password1) && $password1=$password2 && !empty($first_name) && !empty($last_name) && !empty($email) && !preg_match('/[0-9]/', $first_name) && !preg_match('/[0-9]/', $last_name) ){
                        
                            $query = "INSERT INTO users(RoleID,FirstName,LastName,EmailID,Password,CreatedDate) VALUES(2,'{$first_name}','{$last_name}','{$email}','$password2',now())";
                            $registration_query = mysqli_query($connection, $query);
                            if(!$registration_query){
                              die("FAILED TO EXECUTE YOUR REQUEST" . mysqli_error($connection));
                           }
                            if($registration_query){
                               
                                    
                                    
                                 $_SESSION['first_name'] = $first_name;
                                 $_SESSION['email'] = $email;
                                
                            ?>
                               <script>
                                    location.replace('email_validation.php');
                               </script>    
                            <?php    
                                
                            }
                        
                       }
                        
                        
                        
                    }
                        
                      ?>




            <form class="col-md-5" id="login-form" action="" method="post">
                <div class="container">
                    <h4>Create an Account</h4>
                    <p id="1">Enter yout details to sign up</p>
                   
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <div style="margin-left: 0px !important; text-align:left !important">
                                <label for="exampleInputEmail1">First Name*</label>
                            </div>
                            <input type="text" class="form-control" id="firstname" placeholder="First Name" name="first_name">
                            
                    <?php
                        if(isset($text_only_error_firstname)){
                            echo "<p style='margin-left: 0px !important; text-align:left !important; color:red'>$text_only_error_firstname</p>";
                        }
                    ?>
                    
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <div style="margin-left: 0px !important; text-align:left !important">
                                <label for="exampleInputEmail1">Last Name*</label>
                            </div>
                            <input type="text" class="form-control" id="lastname" placeholder="Last Name" name="last_name">
                            <?php
                             if(isset($text_only_error_lastname)){
                            echo "<p style='margin-left: 0px !important; text-align:left !important; color:red'>$text_only_error_lastname</p>";
                            }
                    ?>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <div style="margin-left: 0px !important; text-align:left !important">
                                <label for="exampleInputEmail1">Email*</label>
                            </div>
                            <input type="text" class="form-control" id="email" placeholder="email address" name="email">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <div style="margin-left: 0px !important; text-align:left !important">
                                <label for="exampleInputEmail1">Password*</label>
                            </div>
                            <input type="password" class="form-control" id="password-field" placeholder="Enter your password" value="" name="password1">
                             <?php
                             if(isset($password_err)){
                            echo "<p style='margin-left: 0px !important; text-align:left !important; color:red'>$password_err</p>";
                            }
                            ?>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <div style="margin-left: 0px !important; text-align:left !important">
                                <label for="exampleInputEmail1">Confirm Password*</label>
                            </div>
                            <input type="password" class="form-control" id="password-field2" placeholder="Re-Enter your password" value="" name="password2">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <button type="submit" class="btn btn-primary" name="sign_up">SIGN UP</button>
                        </div>
                    </div>
                    <p>Already have an account?<a href="login.php">Login</a></p>
                </div>
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
