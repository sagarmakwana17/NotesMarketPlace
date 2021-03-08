
<?php
include"includes/database.php";
?>
<?php
      session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
 
 
//include PHPMailer classes to your PHP file for sending email
require_once __DIR__ . '/src/Exception.php';
require_once __DIR__ . '/src/PHPMailer.php';
require_once __DIR__ . '/src/SMTP.php';
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
    <link rel="stylesheet" href="css/Forgot_password.css">


    <title>forgot password</title>
</head>

<body>
   <center>
        <div class="col-lg-5">
            <img src="img/top-logo.png">
            
            <?php
                if(isset($_POST['forgot'])){
                    $email = $_POST['email'];
                    $query = "SELECT * FROM users WHERE EmailID = '{$email}'";
                    $select_query = mysqli_query($connection,$query);
                    if(!$select_query){
                        die("FaILED".mysqli_error($connection));
                    }
                    
                   if(mysqli_num_rows($select_query)==0){
                       $invalid_email_error = "This email id is invalid!";
                   }
                    if(mysqli_num_rows($select_query)==1){
                       $password = rand(1000,10000);
                        $password_chnage = "UPDATE users SET Password ='{$password}' WHERE EmailID = '{$email}'";
                        $password_change_query = mysqli_query($connection,$password_chnage);
                        
                        if(!$password_change_query ){
                            die("FAILED TO CHANGE YOUR PASSWORD".mysqli_error($connection));
                        }
                        if($password_change_query ){
                            
                              $mail = new PHPMailer(true);
 
                        try {
                            // Server settings
                            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;        // You can enable this for detailed debug output
                            $mail->isSMTP();
                            $mail->Host = 'smtp.gmail.com';
                            $mail->SMTPAuth = true;
                            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                            $mail->Port = 587;  // This is fixed port for gmail SMTP

                            $config_email = 'sagmak99@gmail.com';
                            $mail->Username = $config_email; // YOUR gmail email which will be used as sender and PHPMailer configuration 
                            $mail->Password = 'ocean@1711';   // YOUR gmail password for above account

                            // Sender and recipient settings
                            $mail->setFrom($config_email, 'Sender name');  // This email address and name will be visible as sender of email


                            $mail->addAddress($email, 'Receiver name');  // This email is where you want to send the email
                            $mail->addReplyTo($config_email, 'Sender name');   // If receiver replies to the email, it will be sent to this email address

                            // Setting the email content
                            $mail->IsHTML(true);  // You can set it to false if you want to send raw text in the body
                            $mail->Subject = "New Temporary Password has been Created for you";       //subject line of email
                            $mail->Body = "<p>Hello,</p><br><br><p>We have generated a new password for you<p><br><p>Password : $password</p>";   //Email body
                            $mail->AltBody = 'Plain text message body for non-HTML email client. Gmail SMTP email body.';   //Alternate body of email

                            $mail->send();
                            echo "Email message sent.";
                        } catch (Exception $e) {
                            echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
                        }
                        }
                        
                   }
                }
            ?>
             

            <form class="" id="login-form" method="post" action="">
                <h4>Forgot Password?</h4>
                <p>Enter your email to reset password</p>
             
                <div class="form-group" style="margin-left: 0px !important; text-align:left !important">
                    
                        <label for="exampleInputEmail1">Email</label>
                    
                    <input type="email" class="form-control" id="email" placeholder="Abc@gmail.com" name="email"> 
                       <p style="margin-left: 0px !important; text-align:left !important; color:red"> <b>
                       <?php
                        if(isset($invalid_email_error)){
                            echo $invalid_email_error;
                         }
                    ?>
                    </b>
                    </p>
                    
                    
                </div>
                <div class="form-group" style="margin-left: 0px !important; text-align:left !important">
                    
                <button type="submit" class="btn btn-primary" name="forgot">SUBMIT</button>
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
