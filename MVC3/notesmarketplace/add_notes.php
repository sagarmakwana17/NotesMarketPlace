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

 <!--to get user info-->

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
    <link rel="stylesheet" href="css/note_add.css">
    <link rel="stylesheet" href="css/responsive1.css">
    <link rel="stylesheet" href="admin/css/nav.css">



    <title>add-notes</title>
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

                            <h4>Add Notes</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="details">
        <div class="content-box-lg">

            <?php
                /*getting user_id through super global get*/
              if(isset($_GET['user'])){
               $user_id = $_GET['user'];
;              }
                if(isset($_POST['save'])){
                    /*Getting the form data */
                    
                    $note_title = $_POST['note_title'];
                    $note_category = $_POST['note_category'];
                    $note_type = $_POST['note_type'];
                    $note_pages = $_POST['note_pages'];
                    $note_description = $_POST['note_description'];
                    $note_country = $_POST['note_country'];
                    $institute_name = $_POST['institute_name'];
                    $course_name = $_POST['course_name'];
                    $course_code = $_POST['course_code'];
                    $proffesor = $_POST['proffesor'];
                    $sell_type = $_POST['sell_type'];
                    $note_sell_price = $_POST['note_sell_price'];
                    if($sell_type =="paid"){
                        $sell_type1 = "yes";
                    }else{
                        $sell_type1 = "no";
                    }
    
                    /*code to upload display pic*/
                    

                                $file = $_FILES['display_picture'];
                                $file_name = $_FILES['display_picture']['name'];
                                $file_tmp_name = $_FILES['display_picture']['tmp_name'];
                                $file_size = $_FILES['display_picture']['size'];
                                $file_error = $_FILES['display_picture']['error'];

                                /*code to allow only certain types of file*/


                                $file_ext = explode('.', $file_name);
                                $file_actual_ext = strtolower(end($file_ext));
                                $allowed_types = array('jpg','jpeg','png');
                                if(in_array($file_actual_ext,$allowed_types)){
                                    if($file_error === 0){
                                        if($file_size < 5000000){
                                            $file_destination = 'uploads/note_display_pictures/'.$file_name;
                                            move_uploaded_file($file_tmp_name, $file_destination);
                                            $display_pic =  $file_destination;
                                        }else{
                                            echo "your file is too big";
                                        }
                                    }else{
                                        $display_pic_upload_error = "Failed to upload";
                                    }
                                }else{
                                    $display_pic_type_error  = "Please upload only jpeg , jpg and png files";
                                }
                                
                                if(!isset( $display_pic)){
                                     $display_pic = "";
                                }
                    
                    
                    
                    /*code to upload note*/
                    

                                $note = $_FILES['upload_notes'];
           
                                $note_name = $_FILES['upload_notes']['name'];
                                $note_tmp_name = $_FILES['upload_notes']['tmp_name'];
                                $note_size = $_FILES['upload_notes']['size'];
                                $note_error = $_FILES['upload_notes']['error'];

                                /*code to allow only certain types of file*/


                                $note_ext = explode('.', $note_name);
                                $note_actual_ext = strtolower(end($note_ext));
                                $allowed_types = array('pdf');
                                if(in_array($note_actual_ext,$allowed_types)){
                                    if($note_error === 0){
                                        if($note_size < 500000000){
                                            $note_destination = 'uploads/notes_uploaded/'.$note_name;
                                            move_uploaded_file($note_tmp_name, $note_destination);
                                            $uploaded_note =  $note_destination;
                                        }else{
                                            echo "your file is too big";
                                        }
                                    }else{
                                        $note_upload_error = "Failed to upload";
                                    }
                                }else{
                                    $note_type_error  = "Please upload only pdf files";
                                }
   
                     /*code to upload note preview*/
                    

                                $preview = $_FILES['note_preview'];
                
                                $preview_name = $_FILES['note_preview']['name'];
                                $preview_tmp_name = $_FILES['note_preview']['tmp_name'];
                                $preview_size = $_FILES['note_preview']['size'];
                                $preview_error = $_FILES['note_preview']['error'];

                                /*code to allow only certain types of file*/


                                $preview_ext = explode('.', $preview_name);
                                $preview_actual_ext = strtolower(end($preview_ext));
                                $allowed_types = array('pdf');
                                if(in_array($preview_actual_ext,$allowed_types)){
                                    if($preview_error === 0){
                                        if($preview_size < 500000000){
                                            $preview_destination = 'uploads/notes_preview/'.$preview_name;
                                            move_uploaded_file($preview_tmp_name, $preview_destination);
                                            $preview_note =  $preview_destination;
                                        }else{
                                            echo "your file is too big";
                                        }
                                    }else{
                                        $preview_upload_error = "Failed to upload";
                                    }
                                }else{
                                    $preview_type_error  = "Please upload only pdf files";
                                }
                    
                    /*code to insert data in database*/
                    
                    if(!preg_match('/[a-zA-Z]/', $note_pages) && isset($preview_note) && isset($uploaded_note)){
                        /*query to insert in sellernotes table*/
                        $query1 = "INSERT INTO sellernotes(SellerID,Status,Title,Category,DisplayPicture,NoteType,NumberofPages,Description,UniversityName,Country,Course,CourseCode,Professor,IsPaid,SellingPrice,NotesPreview,CreatedDate) VALUES('{$user_id}','Draft','{$note_title}','$note_category','{$display_pic}','{ $note_type}','{$note_pages}','{$note_description}','{$institute_name}','{$note_country}','{$course_name}','{$course_code}','{$proffesor}','{$sell_type1}','$note_sell_price','{$preview_note}',now())";
                        
                        $sellernotes_query = mysqli_query($connection,$query1);
                        if(!$sellernotes_query){
                            die("FAILED".mysqli_error($connection));
                        }
                      }
 
                }else if(isset($_POST['confirm_publish'])){
                    /*Getting the form data */
                    
                    $note_title = $_POST['note_title'];
                    $note_category = $_POST['note_category'];
                    $note_type = $_POST['note_type'];
                    $note_pages = $_POST['note_pages'];
                    $note_description = $_POST['note_description'];
                    $note_country = $_POST['note_country'];
                    $institute_name = $_POST['institute_name'];
                    $course_name = $_POST['course_name'];
                    $course_code = $_POST['course_code'];
                    $proffesor = $_POST['proffesor'];
                    $sell_type = $_POST['sell_type'];
                    $note_sell_price = $_POST['note_sell_price'];
                    if($sell_type =="paid"){
                        $sell_type1 = "yes";
                    }else{
                        $sell_type1 = "no";
                    }
                    
                    
                    
                    
                    /*code to upload display pic*/
                    

                                $file = $_FILES['display_picture'];
                                $file_name = $_FILES['display_picture']['name'];
                                $file_tmp_name = $_FILES['display_picture']['tmp_name'];
                                $file_size = $_FILES['display_picture']['size'];
                                $file_error = $_FILES['display_picture']['error'];

                                /*code to allow only certain types of file*/


                                $file_ext = explode('.', $file_name);
                                $file_actual_ext = strtolower(end($file_ext));
                                $allowed_types = array('jpg','jpeg','png');
                                if(in_array($file_actual_ext,$allowed_types)){
                                    if($file_error === 0){
                                        if($file_size < 500000){
                                            $file_destination = 'uploads/note_display_pictures/'.$file_name;
                                            move_uploaded_file($file_tmp_name, $file_destination);
                                            $display_pic =  $file_destination;
                                        }else{
                                            echo "your file is too big";
                                        }
                                    }else{
                                        $display_pic_upload_error = "Failed to upload";
                                    }
                                }else{
                                    $display_pic_type_error  = "Please upload only jpeg , jpg and png files";
                                }
                                
                                if(!isset( $display_pic)){
                                     $display_pic = "";
                                }
                    
                    
                    
                    /*code to upload note*/
                    

                                $note = $_FILES['upload_notes'];
                    
                    
                    
                        
                                $note_name = $_FILES['upload_notes']['name'];
                                $note_tmp_name = $_FILES['upload_notes']['tmp_name'];
                                $note_size = $_FILES['upload_notes']['size'];
                                $note_error = $_FILES['upload_notes']['error'];

                                /*code to allow only certain types of file*/


                                $note_ext = explode('.', $note_name);
                                $note_actual_ext = strtolower(end($note_ext));
                                $allowed_types = array('pdf');
                                if(in_array($note_actual_ext,$allowed_types)){
                                    if($note_error === 0){
                                        if($note_size < 500000000){
                                            $note_destination = 'uploads/notes_uploaded/'.$note_name;
                                            move_uploaded_file($note_tmp_name, $note_destination);
                                            $uploaded_note =  $note_destination;
                                        }else{
                                            echo "your file is too big";
                                        }
                                    }else{
                                        $note_upload_error = "Failed to upload";
                                    }
                                }else{
                                    $note_type_error  = "Please upload only pdf files";
                                }
                    
                    
                    
                    
                    
                    
                    
                     /*code to upload note preview*/
                    

                                $preview = $_FILES['note_preview'];
                
                                $preview_name = $_FILES['note_preview']['name'];
                                $preview_tmp_name = $_FILES['note_preview']['tmp_name'];
                                $preview_size = $_FILES['note_preview']['size'];
                                $preview_error = $_FILES['note_preview']['error'];

                                /*code to allow only certain types of file*/


                                $preview_ext = explode('.', $preview_name);
                                $preview_actual_ext = strtolower(end($preview_ext));
                                $allowed_types = array('pdf');
                                if(in_array($preview_actual_ext,$allowed_types)){
                                    if($preview_error === 0){
                                        if($preview_size < 500000000){
                                            $preview_destination = 'uploads/notes_uploaded/'.$preview_name;
                                            move_uploaded_file($preview_tmp_name, $preview_destination);
                                            $preview_note =  $preview_destination;
                                        }else{
                                            echo "your file is too big";
                                        }
                                    }else{
                                        $preview_upload_error = "Failed to upload";
                                    }
                                }else{
                                    $preview_type_error  = "Please upload only pdf files";
                                }
                    
                    /*code to insert data in database*/
                    
                    if(!preg_match('/[a-zA-Z]/', $note_pages) && isset($preview_note) && isset($uploaded_note)){
                        /*query to insert in sellernotes table*/
                        $query1 = "INSERT INTO sellernotes(SellerID,Status,Title,Category,DisplayPicture,FilePath,NoteType,NumberofPages,Description,UniversityName,Country,Course,CourseCode,Professor,IsPaid,SellingPrice,NotesPreview,CreatedDate) VALUES('{$user_id}','submitted','{$note_title}','$note_category','{$display_pic}','{$uploaded_note}','{$note_type}','{$note_pages}','{$note_description}','{$institute_name}','{$note_country}','{$course_name}','{$course_code}','{$proffesor}','{$sell_type1}','$note_sell_price','{$preview_note}',now())";
                        
                        $sellernotes_query = mysqli_query($connection,$query1);
                        if(!$sellernotes_query){
                            die("FAILED".mysqli_error($connection));
                        }
                        else{
                            $success="PUBLISHED";
                            
                            
                            
                            
                /*EMAIL TO NOTIFY THE ADMIN ABOUT THIS*/
                            
                            
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
                            $mail->Subject = "New note sent for review";       //subject line of email
                            $mail->Body = "<p>Hello Admins</p><br><br><p>We want to inform you that new note has been sent to you for review<br>please take required actions<p>";   //Email body
                            $mail->AltBody = 'Plain text message body for non-HTML email client. Gmail SMTP email body.';   //Alternate body of email

                            $mail->send();
                            echo "Note Uploaded Successfully";
                        } catch (Exception $e) {
                            echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
                        }
                            
                            
                            
                        }
                      }
                    
                    
                    
                    
                    
                    
                    
                }
           ?>

            <form action="" method="post" enctype="multipart/form-data">
                <div class="container">
                    <h3>Basic Details</h3>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="title">Title*</label>
                            <input type="text" class="form-control" id="title" placeholder="Enter note title" name="note_title" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="category">Category*</label>
                            <select id="category" class="form-control" placeholder="" name="note_category" required>
                                <option selected value="">Select your category</option>
                                <option value="1">science</option>
                                <option value="ACCOUNTS">ACCOUNTS</option>
                                <option value="SOCIAL STUDIES">SOCIAL STUDIES</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">

                            <label for="display-picture">display-picture</label>
                            <input type="file" class="form-control" id="display-picture" placeholder="" name="display_picture" style="">


                        </div>
                        <div class="form-group col-md-6">

                            <label for="update-notes">Upload notes*</label>
                            <input type="file" class="form-control" id="update-notes" placeholder="" name="upload_notes" required>


                        </div>


                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="type">Type*</label>
                            <select id="type" class="form-control" placeholder="" name="note_type">
                                <option value="" selected>Select your type</option>
                                <option value="printed">printed</option>
                                <option value="handwritten">handwritten</option>
                                 
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="pages">Number of pages</label>
                            <input type="number" class="form-control" id="pages" placeholder="Enter Number of Pages" name="note_pages">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="type">Description*</label>
                            <input type="text" class="form-control" id="description" placeholder="Enter Your Note Description" name="note_description" required>
                        </div>

                    </div>


                    <h4>Institution Information</h4>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="category">country*</label>
                            <select id="country" class="form-control" placeholder="" name="note_country">

                                <option value="INDIA">INDIA</option>
                                <option value="INDIA">USA</option>
                                <option value="INDIA">UK</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="institution-name">institution name*</label>
                            <input type="text" class="form-control" id="institution-name" placeholder="Enter your institution name" name="institute_name">
                        </div>
                    </div>
                    <h4>Course Details</h4>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="course-name">Course name*</label>
                            <input type="text" class="form-control" id="course-name" placeholder="Enter the Course Name" name="course_name">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="course-code">Course code*</label>
                            <input type="text" class="form-control" id="course-code" placeholder="Enter Course code" name="course_code">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="professor">Professor/Lecturer*</label>
                            <input type="text" class="form-control" id="professor" placeholder="Enter your professor name" name="proffesor">
                        </div>

                    </div>

                    <h4>Selling Information</h4>
                    <div class="form-row">
                        <div id="radio" class="col-md-6">
                            <table>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="sell_type" id="exampleRadios1" value="1" checked>
                                    </td>
                                    <td> <label class="" for="exampleRadios1">
                                            Free
                                        </label>
                        </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="sell_type" id="exampleRadios2" value="2">
                        </td>
                        <td> <label class="" for="exampleRadios2">
                                Paid
                            </label>
                    </div>
                    </td>
                    </tr>
                    </table>

                </div>

                <div class="form-group col-md-6 prev">
                    <label for="note-preview">Note Preview*</label>
                    <input type="file" class="form-control" id="note-preview" placeholder="" name="note_preview">
                </div>
                <div class="form-row col-md-12">

                    <div class="form-group col-md-12">
                        <label for="sell-price">Sell Price*</label>
                        <input type="number" class="form-control" id="sell-price" placeholder="Enter Your Sell price" name="note_sell_price" required>
                    </div>
                </div>
                <div class="form-row col-md-6">
                    <button type="submit" class="btn btn-primary" name="save" id="save">SAVE</button>



                    <!--HTML FOR CONFIRMATION POPUP-->

                    <button type="button" class="btn btn-primary" id="publish" name="publish" data-toggle="modal" data-target="#exampleModalCenter">PUBLISH</button>



                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Confirm Publish?</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>are you sure you want to publish this note?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCEL</button>
                                    <button type="submit" class="btn btn-primary" id="publish" name="confirm_publish">PUBLISH</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

        </div>




        </div>
        </form>
        </div>
    </section>
    <style>
        @media (max-width:772px) {

            .prev {
                margin-top: 50px;
            }

        }

    </style>
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
    <style>
        hr {
            margin: 0;
            margin-top: 60px;
        }

        .foot-text p {
            margin: 40px 0;
            font-family: 'Open Sans', sans-serif;
            font-size: 14px;
            font-weight: 400;
            line-height: 18px;
            color: #333333;
        }

        .social-list {
            margin: 30px 0;
        }

        ul.social-list {
            padding: 0;
        }

        ul.social-list li {
            display: inline-block;
            padding: 0;
        }

        ul.social-list li a {
            text-align: center;
            background-color: #6255a5;
            border: 1px solid #6255a5;
            width: 36px;
            height: 36px;
            display: inline-block;
            line-height: 30px;
            color: white;
            border-radius: 50%;
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            -ms-border-radius: 50%;
            -o-border-radius: 50%;
            transition: all 400ms linear;
            -webkit-transition: all 400ms linear;
            -moz-transition: all 400ms linear;
            -ms-transition: all 400ms linear;
            -o-transition: all 400ms linear;
        }

    </style>










    <!-- JQUERY JS-->
    <script src="js/jquery-3.5.1.js"></script>
    <!--Bootstrap js-->
    <script src="js/bootstrap.min.js"></script>
    <!--Custom js-->
    <script src="js/script.js"></script>
</body>

</html>
