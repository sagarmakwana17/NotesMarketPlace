<?php
include"includes/database.php";
?>
<?php
if(isset($_GET['user_id'])){
    $user_id = $_GET['user_id'];
    
}
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

if(isset($_GET['download_id'])&& isset($_GET['user_id']) ){
        $download_id = $_GET['download_id'];
        $user_id = $_GET['user_id'];
   /* getting details for seller and users*/
        $d = "SELECT * FROM downloads WHERE ID = $download_id";
        $d_query = mysqli_query($connection,$d);
        if(!$d_query){
            die(mysqli_error($connection));
        }
            $dq = mysqli_fetch_assoc($d_query);
            $seller = $dq['Seller'];
            $downloader = $dq['Downloader'];

            $u = "SELECT * FROM users WHERE ID = $seller";
                $u_query = mysqli_query($connection,$u);
                if(!$u_query){
                    die(mysqli_error($connection));
                }
             $du = mysqli_fetch_assoc($u_query);
            $sellername = $du['FirstName'];

            $s = "SELECT * FROM users WHERE ID = $downloader";
                $s_query = mysqli_query($connection,$s);
                if(!$s_query){
                    die(mysqli_error($connection));
                }
             $ds = mysqli_fetch_assoc($s_query);
            $uname = $ds['FirstName'];
            $uemail = $ds['EmailID'];


    
       $allow_download = "UPDATE downloads SET IsSellerHasAllowedDownload =1 WHERE ID = $download_id";
                        $allow_download_query = mysqli_query($connection,$allow_download);
                        
                        if(!$allow_download_query){
                            die(mysqli_error($connection));
                        }
                        else if($allow_download_query){
                            
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
                            $mail->setFrom($config_email, 'Sender name');  // This email address and name will be visible as sender of email


                            $mail->addAddress($uemail, 'Receiver name');  // This email is where you want to send the email
                            $mail->addReplyTo($config_email, 'NotesMarketPlace');   // If receiver replies to the email, it will be sent to this email address

                            // Setting the email content
                            $mail->IsHTML(true);  // You can set it to false if you want to send raw text in the body
                            $mail->Subject = "$sellername Allows You to Download a note";       //subject line of email
                            $mail->Body = "<p>Hello Dear $uname</p><br><p>We would like to inform you that $sellername Allows you to download a note, <br> Please login to notesmarketplace and check mydownloads tab<p> <a href='http://localhost/NotesMarketPlace/notesmarketplace/verify.php?vkey=$vkey'> Click Here to verify</a> <br><br><p>Regards</p><br><p>NotesMarketPlace</p>";   //Email body
                            $mail->AltBody = 'Plain text message body for non-HTML email client. Gmail SMTP email body.';   //Alternate body of email

                            $mail->send();
                            echo "Email message sent.";
                        } catch (Exception $e) {
                            echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
                        }
    
                            
                            
                    ?>
                       <script>
                                    location.replace('../buyer_requests.php?user_id=<?php echo $user_id; ?>');
                         </script>
                    <?php                 
                        
                        }
}
?>