 <?php
session_start();
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
     <link rel="stylesheet" href="css/responsive1.css">
     <title>Login</title>
 </head>

 <body>
     <style>
        
        
         @media (min-width: 555px) and (max-width: 998px) {
             .labels {
                 margin-left: 150px !important;
             }

         }
          @media (min-width: 1388px)and (max-width: 1600px){
             .labels {
                 margin-left: 50px !important;
             }


         }
          @media (min-width: 1600px)and (max-width: 1800px){
             .labels {
                 margin-left: 80px !important;
             }
              .form-check{
                  margin-left: 50px !important;
              }


         }
         @media (min-width: 1800px)and (max-width: 2000px){
             .labels {
                 margin-left: 100px !important;
             }
             .form-check{
                  margin-left: 50px !important;
              }


         }
          @media (min-width: 2000px)and (max-width: 2300px){
             .labels {
                 margin-left: 170px !important;
             }
              .form-check{
                  margin-left: 120px !important;
              }


         }
         


     </style>
     <center>
         <div class="col-lg-5">
             <img src="img/top-logo.png">
             <?php
                    ob_start();
                    if(isset($_POST['login'])){
                        $email = $_POST['email'];
                        $password = $_POST['password'];
                        
                        $email  = mysqli_real_escape_string($connection, $email);
                        $password  = mysqli_real_escape_string($connection, $password);
                        
                       $query = "SELECT u.* , RoleID FROM users AS u JOIN userroles AS r ON u.RoleID = r.ID  WHERE u.EmailID = '{$email}'";
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
                            $db_name = $row['Name'];
                            $count = $count+1;
                            $db_description = $row['Description'];
                            $is_email_verified = $row['IsEmailVerified'];
                        }
                        if($count == 0){
                            $emailid_error="please enter valid email id & password";
                        }
                         else if($email == $db_email_id &&  $password ==$db_password && $db_role_id=='1' )
                        {
                          /* header("Location : https://localhost/NotesMarketPlace/front/home.php");*/
                             ?>
             <script>
                 location.replace('../admin/dashboard.html');

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

             <form class="" id="login-form" method="post" action="login.php">
                 <h4>Login</h4>
                 <p>Enter your email address and password to login</p>

                 <div class="form-group">
                     <div style=" text-align:left !important" class="labels">
                         <label for="exampleInputEmail1">Email</label>
                     </div>
                     <input type="email" class="form-control" id="email" placeholder="email address" name="email">
                 </div>
                 <div class="form-group">
                     <div style="text-align:left !important" class="labels">
                         <label for="exampleInputPassword1">Password </label>
                     </div>
                     <input type="password" class="form-control" id="password-field" placeholder="Password" value="" name="password">
                     <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                     <p style="text-align:left !important; color:red" class="labels">
                         <?php
                        if(isset($password_error)){
                            echo $password_error;
                            
                        }
                        else if(isset($emailid_error)){
                            echo $emailid_error;
                        }
                    ?>
                     </p>

                     <h6><a href="forgot_password.php">forgot password?</a></h6>
                 </div>
                 <div class="form-group form-check">
                     <input type="checkbox" class="form-check-input" id="exampleCheck1">
                     <div style="text-align:left !important" class="">
                         <label class="form-check-label" for="exampleCheck1">Remember me</label>

                     </div>
                 </div>
                 <button type="submit" class="btn btn-primary" name="login">LOGIN</button>
                 <p>Don't have an account?<a href="sign_up.php"> Sign Up</a></p>
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
