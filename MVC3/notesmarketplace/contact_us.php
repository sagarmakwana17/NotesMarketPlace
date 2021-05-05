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

<?php
if(isset($user_id)){
$admin = "SELECT * FROM userprofile WHERE UserID = $user_id AND ProfilePicture IS NOT NULL";
$admin_info = mysqli_query($connection,$admin);
if(!$admin_info){
    die(mysqli_error($connection));
}
    $adm = mysqli_fetch_assoc($admin_info);
if(mysqli_num_rows($admin_info) != 0){
    $profile = $adm['ProfilePicture'];
   
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
    <link rel="stylesheet" href="admin/css/bootstrap/bootstrap.min.css">

    <!--Custom CSS-->
    <link rel="stylesheet" href="css/contact_us1.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="admin/css/nav.css">
    <link rel="stylesheet" href="css/responsive1.css">



    <title>Contact us</title>
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
                        <a class="navbar-brand float-left" href="#"><img src="img/logo.png" class="img-fluid"></a>
                        <ul class="navbar-nav mr-auto mt-2 mt-lg-0 ml-auto">


                            <li class="nav-item"><a class="nav-link" href="<?php if(isset($user_id)){ echo 'search_notes.php?user_id='.$user_id;}else {echo 'search_notes.php';}?>">Search Notes</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?php echo"dashboard.php?user=".$user_id; ?>">Sell Your Notes</a></li>
                            <li class="nav-item"><a class="nav-link" href="buyer_requests.php">Buyer Request</a> </li>
                            <li class="nav-item"><a class="nav-link" href="FAQ.php">FAQ</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?php if(isset($user_id)){ echo 'contact_us.php?user_id='.$user_id;}else {echo 'contact_us.php';}?>">Contact Us</a></li>
                            <li class="nav-item ">
                                <div class="dropdown show">
                                     <a class="" href="#" role="" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          <?php
                                       if(isset($profile)){
                                           
                                           ?>
                                        <img class="profile" src="<?php if(isset($profile)){ echo $profile; }?>" alt="">
                                        <?php
                                       }else{
                                          ?>

                                        <img class="profile" src="img/images/user-l.jpg" alt="">
                                        <?php } ?>

                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="user_profile.php?<?php echo'user_id='.$user_id; ?>">My Profile</a>
                                        <a class="dropdown-item" href="my_downloads.php?<?php echo'user_id='.$user_id; ?>">My Downloads</a>
                                        <a class="dropdown-item" href="my_sold_notes.php?<?php echo'user_id='.$user_id; ?>">My Sold Notes</a>
                                        <a class="dropdown-item" href="my_rejected_notes.php?<?php echo'user_id='.$user_id; ?>">My Rejected Notes</a>
                                        <a class="dropdown-item" href="change_password.php?<?php echo'user_id='.$user_id; ?>">Change Password</a>
                                        <a class="dropdown-item" href="logout.php">Log out</a>
                                    </div>
                                </div>


                            </li>
                            <li class="nav-item"><a class="btn btn-primary" href="logout.php" role="button">Log Out</a></li>

                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <section id="user-section">
        <div class="content-box-lg">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div id="user_profile" class="text-center">

                            <h4>Contact Us</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="details">
        <div class="content-box-lg">
            <form action="" method="post">
              
               <?php
                    if(isset($_POST['submit'])){
                        $name = $_POST['name'];
                        $user_email = $_POST['user_email'];
                        $subject = $_POST['subject'];
                        $comments = $_POST['comments'];
                        
                        if(preg_match('/[0-9]/', $name)){
                        $text_only_error_firstname = "Numeric Value is not allowed !";
                        }
                        else if(!preg_match('/[0-9]/', $name) && !empty($user_email) && !empty($subject) && !empty($comments)){
                            
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
                                $mail->Password = 'Oceanmakwana@1711';   // YOUR gmail password for above account

                                // Sender and recipient settings
                                $mail->setFrom($config_email, 'NotesMarketPlace');  // This email address and name will be visible as sender of email


                                $mail->addAddress('skywalker4073@gmail.com', 'NotesMarketPlace Admin');  // This email is where you want to send the email
                                $mail->addReplyTo($config_email, 'NotesMarketPlace');   // If receiver replies to the email, it will be sent to this email address

                                // Setting the email content
                                $mail->IsHTML(true);  // You can set it to false if you want to send raw text in the body
                                $mail->Subject = "$name -Query";       //subject line of email
                                $mail->Body = "<p>Hello,</p><br><br><p>$comments</p><br><p>Regards,</p><br><p>$name</p>";   //Email body
                                $mail->AltBody = 'Plain text message body for non-HTML email client. Gmail SMTP email body.';   //Alternate body of email

                                $mail->send();
                                $email_sent= "Thank You For Contacting us! We will try to resolve your issue as soon as posibble!";
                            } catch (Exception $e) {
                                echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
                            }
                            }
                    }
               ?>
                <div class="container">
                    <h3>Basic Details</h3>
                    <div class="form-row">
                       <?php
                           
                        if(isset($_GET['user_id'])){
                        
                            $user_id = $_GET['user_id'];
                            $query = "SELECT * FROM users WHERE ID = '{$user_id}'";
                            $user_details = mysqli_query($connection,$query);
                            if(!$user_details){
                                die(mysqli_error($connection));
                            }
                            $row = mysqli_fetch_assoc($user_details);
                            $full_name = $row['FirstName'];
                            $email = $row['EmailID'];
                        }
                        ?>
                        <div class="form-group col-md-6">
                            <label for="title">Full Name*</label>
                            <input type="text" class="form-control" id="full-name" placeholder="Enter your full name" name="name" value="<?php if(isset($full_name)){echo $full_name;} ?>">
                                    
                            <?php
                                if(isset($text_only_error_firstname)){
                                    echo "<b><p style='margin-left: 0px !important; text-align:left !important; color:red'>$text_only_error_firstname</p></b>";
                                }
                            ?>
                            <label for="email">Email*</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter Your Note Description" name="user_email" value="<?php if(isset($email)){echo $email;} ?>">
                            <label for="subject">Subject*</label>
                            <input type="text" class="form-control" id="subject" placeholder="Enter Subject" name="subject">
                             <?php
                                if(isset($email_sent)){
                                    echo "<b><p style='margin-left: 0px !important; text-align:left !important; color:#6255a5'>$email_sent</p></b>";
                                }
                            ?>
                            
                        </div>
                        <div class="form-group col-md-6">
                            <label for="title">Comments/Questions*</label>
                            <input type="text" name="comments" class="form-control" id="questions" placeholder="Comments">
                        </div>
                    </div>
                         <button type="submit" class="btn btn-primary" name="submit" id="submit">SUBMIT</button>
                </div>

            </form>
        </div>
    </section>
    <footer>
        <div class="container">
            <div class="row">
                <!-- Copyright -->
                <div class="col-md-6 col-sm-8 foot-text text-left">
                    <p>Copyright &copy; TatvaSoft All Rights Reserved.</p>
                </div>
                <!-- Social Icon -->
                <div class="col-md-6 col-sm-4 foot-icon col-sm-4 text-right">
                    <ul class="social-list">
                        <li>
                            <a href="#">
                                <img src="img/images/facebook.png" alt="facebook-image">
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img src="img/images/twitter.png" alt="twitter-image">
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img src="img/images/linkedin.png" alt="linkedin-image">
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
   

   
    <!-- JQUERY JS-->
    <script src="js/jquery-3.5.1.js"></script>
    <!--Bootstrap js-->
    <script src="js/bootstrap.min.js"></script>
    <!--Custom js-->
    <script src="js/script.js"></script>
</body>

</html>
