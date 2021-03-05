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
    <link rel="stylesheet" href="css/email_validation.css">


    <title>Email Verification</title>
</head>

<body>
    <?php
    
    if(isset($_SESSION['email'])){
    $email = $_SESSION['email'];
    }else if(isset($_SESSION['email2'])){
    $email = $_SESSION['email'];
    }
        
        
        
        
    if(isset($_POST['email_verification'])){
 
        $vkey = md5(time().$email);
        
        $query = "UPDATE users SET vkey = '{$vkey}' WHERE EmailID = '{$email}'";
        $insert_vkey = mysqli_query($connection,$query);
        if(!$insert_vkey){
            die("FAILED".mysqli_error($connection));
        }
        
        
        
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
    $mail->Subject = "Send email using Gmail SMTP and PHPMailer";       //subject line of email
    $mail->Body = " <a href='http://localhost/NotesMarketPlace/front/verify.php?vkey=$vkey'> Click Here to verify</a>";   //Email body
    $mail->AltBody = 'Plain text message body for non-HTML email client. Gmail SMTP email body.';   //Alternate body of email
 
    $mail->send();
    echo "Email message sent.";
} catch (Exception $e) {
    echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
}
    }
    ?>

    <div class="col-lg-5 offset-lg-3">

        <form class="" id="login-form" method="post">
            <img src="img/logo.png">
            <h4>Email Verification</h4>
            <h5>Dear
     <?php
            if(isset($_SESSION['first_name'])){
                echo $_SESSION['first_name'];
            } else if(isset( $_SESSION['login_first_name'])){
                echo  $_SESSION['login_first_name'];
            }
        ?>
            </h5>
            <p>Thanks for signing in,</p>
            <p>Simply click below for email verification.</p>
            <div class="form-group">
                <button type="submit" class="btn btn-primary" name="email_verification">VERIFY YOUR EMAIL</button>
            </div>



        </form>
    </div>





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
