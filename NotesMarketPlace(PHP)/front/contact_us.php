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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0 ,user-scalable=no">

    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <!--font awesome -->
    <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
    <!--BOOTSTRAP CSS-->
    <link rel="stylesheet" href="css/bootstrap/bootstrap.css">

    <!--Custom CSS-->
    <link rel="stylesheet" href="css/contact_us.css">
    <link rel="stylesheet" href="css/responsive.css">



    <title>Contact us</title>
</head>

<body>
    <header>
        <div class="container">
            <nav class="navbar navbar-fixed-top">
                <div class="container-fluid">
                    <div class="site-nav-wrapper">
                        <div class="navbar-header">
                            <!-- mobile menu-->

                            <div class="dropdown"><a href="" class="dropdown-toggle" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span id="mobile-nav-open-btn">&#9776;</span>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="#">Search Notes</a><br>
                                    <a class="dropdown-item" href="#">Sell Your Notes</a><br>
                                    <a class="dropdown-item" href="#">Buyer Requests</a><br>
                                    <a class="dropdown-item" href="#">FAQ</a><br>
                                    <a class="dropdown-item" href="#">Contact Us</a><br>
                                    <a class="dropdown-item" href="#">My Profile</a><br>
                                    <a class="dropdown-item" href="#">Log Out</a>
                                </div>
                            </div>

                            <a href="#" class="navbar-brand">
                                <img src="img/logo.png">
                            </a>
                        </div>
                        <div class="container">
                            <div class="collapse navbar-collapse">
                                <ul class="nav navbar-nav pull-right">
                                    <li><a href="search_notes.html">Search Notes</a></li>
                                    <li><a href="add_notes.html">Sell Your Notes</a></li>
                                    <li><a href="buyer_requests">Buyer Request</a> </li>
                                    <li><a href="FAQ.html">FAQ</a></li>
                                    <li><a href="contact_us.html">Contact Us</a></li>
                                    <li>
                                        <div class="dropdown"><a href="" class="dropdown-toggle" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                               <img src="img/images/user-img.png" alt="">
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="#">My Profile</a><br>
                                                <a class="dropdown-item" href="#">My Downloads</a><br>
                                                <a class="dropdown-item" href="#">My Sold Notes</a><br>
                                                <a class="dropdown-item" href="#">My Rejected Notes</a><br>
                                                <a class="dropdown-item" href="#">Change Password</a><br>
                                                 <a class="dropdown-item" href="#">Log Out</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li><a class="btn btn-primary" href="" role="button">Log Out</a></li>
                                </ul>
                            </div>
                        </div>
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
                                $mail->Password = 'ocean@1711';   // YOUR gmail password for above account

                                // Sender and recipient settings
                                $mail->setFrom($config_email, 'NotesMarketPlace');  // This email address and name will be visible as sender of email


                                $mail->addAddress('skywalker4073@gmail.com', 'NotesMarketPlace Admin');  // This email is where you want to send the email
                                $mail->addReplyTo($config_email, 'Sender name');   // If receiver replies to the email, it will be sent to this email address

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
                        <div class="form-group col-md-6">
                            <label for="title">Full Name*</label>
                            <input type="text" class="form-control" id="full-name" placeholder="Enter your full name" name="name" value="<?php if(isset($_SESSION['full_name'])){echo $_SESSION['full_name'];} ?>">
                                    
                            <?php
                                if(isset($text_only_error_firstname)){
                                    echo "<b><p style='margin-left: 0px !important; text-align:left !important; color:red'>$text_only_error_firstname</p></b>";
                                }
                            ?>
                            <label for="email">Email*</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter Your Note Description" name="user_email" value="<?php if(isset($_SESSION['email'])){echo $_SESSION['email'];} ?>">
                            <label for="subject">Subject*</label>
                            <input type="text" class="form-control" id="subject" placeholder="Enter Subject" name="subject">
                             <?php
                                if(isset($email_sent)){
                                    echo "<b><p style='margin-left: 0px !important; text-align:left !important; color:#6255a5'>$email_sent</p></b>";
                                }
                            ?>
                             <button type="submit" class="btn btn-primary" name="submit" id="submit">SUBMIT</button>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="title">Comments/Questions*</label>
                            <input type="text" name="comments" class="form-control" id="questions" placeholder="Comments">
                        </div>
                    </div>

                </div>

            </form>
        </div>
    </section>
    <footer class="footer1">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p>Copyright &copy; Tatvasoft All Rights reserved<span><a href=""><i class="fa fa-facebook"> </i></a><a href=""><i class="fa fa-twitter"> </i></a><a href=""><i class="fa fa-instagram"></i></a></span></p>
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
