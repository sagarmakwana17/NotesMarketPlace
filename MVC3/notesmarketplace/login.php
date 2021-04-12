 <?php
session_start();
include"includes/database.php";
?>
 <?php
                    ob_start();
                    if(isset($_POST['login'])){
                        $email = $_POST['email'];
                        $password = $_POST['password'];
                        
                        $email  = mysqli_real_escape_string($connection, $email);
                        $password  = mysqli_real_escape_string($connection, $password);
                        
                       $query = "SELECT u.* , RoleID FROM users AS u JOIN userroles AS r ON u.RoleID = r.ID  WHERE u.EmailID = '{$email}' AND u.IsActive = 1";
                        $select_user_query = mysqli_query($connection, $query);
                        if(!$select_user_query){
                           die("FAILED TO EXECUTE YOUR REQUEST" . mysqli_error($connection));
                        }
                        $count = 0;
                        while($row = mysqli_fetch_assoc($select_user_query)){
                            $db_id = $row['ID'];
                             $db_role_id = $row['RoleID'];
                             $db_first_name = $row['FirstName'];
                            $db_last_name = $row['LastName'];
                             $db_email_id = $row['EmailID'];
                            $db_password = $row['Password'];
                           
                            $count = $count+1;
                           
                            $is_email_verified = $row['IsEmailVerified'];
                            $isactive = $row['IsActive'];
                        }
                        if($count == 0){
                            $emailid_error="please enter valid email id & password";
                        }
                         else if($email == $db_email_id &&  $password ==$db_password && $db_role_id=='1' )
                            
                        {
                               $_SESSION['user_id'] = $db_id;
                          /* header("Location : https://localhost/NotesMarketPlace/front/home.php");*/
                             ?>
                         <script>
                             location.replace('admin/dashboard.php');

                         </script>
                         <?php
                        }
                         else if($email == $db_email_id &&  $password !==$db_password)
                         {
                             $password_error="Sorry! You've Entered an incorrect password";
                         }
                          else if($email == $db_email_id &&  $password ==$db_password && $db_role_id=='2' && $is_email_verified ==1 ){
                            $_SESSION['email2'] = $db_email_id;
                            $_SESSION['full_name'] = $db_first_name." ".$db_last_name;
                              $_SESSION['user_id'] = $db_id;
                         ?>
                         <script>
                             location.replace('dashboard.php?user_id=<?php echo $db_id; ?>');

                         </script>
                         <?php
                              
                        }
                         else if($email == $db_email_id &&  $password ==$db_password && $db_role_id=='2' && $is_email_verified ==0 ){
                             $_SESSION['email'] = $db_email_id;
                              $_SESSION['login_first_name'] =  $db_first_name
                         ?>
                         <script>
                             location.replace('email_validation.php');

                         </script>
                         <?php
                              
                        }
                        
                        
                    }
                
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
     <link rel="stylesheet" href="css/log_in.css">
     <link rel="stylesheet" href="admin/css/preloader.css">
     <link rel="stylesheet" href="css/responsive1.css">
     <title>Login</title>
 </head>

 <body>
 <div id="preloader">
      <center>
       <div id="status">&nbsp;</div>
       </center>
   </div>
     <style>
         .form-container {
             background-color: white;
             padding: 50px;
             width: 60%;
             border: 1px solid #6255a5;
             border-radius: 6px;
             margin-top: 25px;
         }

         .container {
             margin-top: 50px;
         }


         label {
             font-family: "Open Sans", sans-serif;
             font-size: 16px;
             font-weight: 400;
             line-height: 20px;
             color: #333333;
             text-align: left !important;
         }

         label span a {
             color: #6255a5;
             margin-left: 280px;
             font-family: "Open Sans", sans-serif;
             font-size: 16px;
             font-weight: 400;
             line-height: 20px;
         }

         .form-control {
             border: 1px solid #6255a5;
             width: 480px;
             height: 50px;
             border-radius: 3px;
         }

         ::placeholder {
             font-family: "Open Sans", sans-serif;
             font-size: 16px;
             font-weight: 400;
             line-height: 20px;
             color: #8a8a8a;
         }

         .field-icon {
             float: right;
            margin-left:200px;
             margin-top: -30px;
             position: absolute;
             z-index: 2;
              font-size: 26px;
             font-weight: 400;
             line-height: 20px;
             color: #8a8a8a;
         }


         @media (max-width:1205px) {

             .form-control {
                 width: 220px;
             }

             .btn-primary {
                 width: 220px;
             }

             label span a {
                 margin-left: 50px;
             }
             .field-icon {
                  margin-left:70px;
             }


         }

         @media (max-width:528px) {
             .form-container {
                 width: 90%;
             }

             label span a {
                 margin-left: 20px;
                 font-size: 11px;

             }

             label {
                 font-size: 12px;
             }
               .field-icon {
                  font-size: 16px;
             }

         }

     </style>
     <div class="container">
         <center>
             <img src="img/top-logo.png" class="img-fluid">

             <div class="form-container">

                 <form action="" method="post">
                     <h4>Login</h4>
                     <p>Enter your email address and password to login</p>
                     <div class="form-group">
                         <div class="label-text" style="text-align:left !important; margin-left:40px;">
                             <label for="exampleInputEmail1">Email address</label>
                         </div>
                         <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Your Email ID" name="email">

                     </div>
                     <div class="form-group">
                         <div class="label-text" style="text-align:left !important; margin-left:40px;">
                             <label for="password">Password<span><a href="forgot_password.php">Forgot password?</a></span></label>
                         </div>
                         <input type="password" class="form-control" id="password" placeholder="Enter Your Password" name="password">
                         <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                         <p style="color:red; margin-top:5px; " class="labels">
                             <?php
                        if(isset($password_error)){
                            echo $password_error;
                            
                        }
                        else if(isset($emailid_error)){
                            echo $emailid_error;
                        }
                    ?>
                         </p>
                     </div>
                     <div class="form-check">
                         <div class="label-text" style="text-align:left !important; margin-left:40px;">
                             <input type="checkbox" class="form-check-input" id="exampleCheck1">
                             <label class="form-check-label" for="exampleCheck1">Remember Me</label>
                         </div>
                     </div>
                     <button type="submit" class="btn btn-primary" name="login">Submit</button>
                     <p>Don't have an account?<a href="sign_up.php"> Sign Up</a></p>
                 </form>

             </div>
         </center>


     </div>






     <!-- JQUERY JS-->
     <script src="js/jquery-3.5.1.js"></script>
     <!--Bootstrap js-->
     <!-- JavaScript Bundle with Popper -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    
     <!--Custom js-->
     <script src="js/login.js"></script>
     <script src="admin/js/loader.js"></script>
 </body>

 </html>
