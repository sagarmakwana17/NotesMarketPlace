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
    <link rel="stylesheet" href="css/add_notes2.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="admin/css/nav.css">
    <link rel="stylesheet" href="css/responsive.css">



    <title>add-notes</title>
</head>

<body>
    <header>
        <div class="">

            <nav class="navbar navbar-expand-lg navbar-light fixed-top">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                    <a class="navbar-brand" href="#"><img src="img/logo.png"></a>
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
                /*getting note_id through super global get*/
                $note_id  = $_GET['note_id'];
              
;            
                if(isset($_POST['confirm_edit'])){
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
                                        if($note_size < 500000){
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
                                        if($preview_size < 500000){
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
                        
                        
                        
                         $query1 = "UPDATE sellernotes SET Title = '{$note_title}', Category = '{$note_category}', DisplayPicture = '{$display_pic}', FilePath = '{$uploaded_note}' , NoteType = '{$note_type}', NumberofPages = '{$note_pages}', Description = '{$note_description}', UniversityName = '{$institute_name}', Country = '{$note_country}', Course = '{$course_name}', CourseCode = '{$course_code}', Professor = '{$proffesor}', IsPaid = '{$sell_type1}',  SellingPrice = '$note_sell_price', NotesPreview = '{$preview_note}', ModifiedDate = now() WHERE ID = '{$note_id}'  ";
                        
                        
                        $sellernotes_query = mysqli_query($connection,$query1);
                        if(!$sellernotes_query){
                            die("FAILED".mysqli_error($connection));
                        }
                      }
 
                }
                    
           ?>

            <form action="" method="post" enctype="multipart/form-data">
                <div class="container">
                    <h3>Basic Details</h3>
                    <?php
                    $note_id = $_GET['note_id'];
                    $Q = "SELECT * FROM sellernotes WHERE ID = '{$note_id}'";
                    $get_details = mysqli_query($connection,$Q);
                    if(!$get_details){
                        die(mysqli_error($coneection));
                    }else{
                        $row = mysqli_fetch_assoc($get_details);
                        $old_title = $row['Title'];
                        $old_cat = $row['Category'];
                        $old_pages = $row['NumberofPages'];
                        $old_desc = $row['Description'];
                        $old_uni = $row['UniversityName'];
                        $old_course = $row['Course'];
                        $old_code = $row['CourseCode'];
                        $old_prof = $row['Professor'];
                         $old_status = $row['Status'];
                        $old_price =  $row['SellingPrice'];
                        $old_price = $row['SellingPrice'];
                        $old_price = $row['SellingPrice'];
                         
                    }
                    
                    
                    ?>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="title">Title*</label>
                            <input type="text" class="form-control" id="title" placeholder="Enter note title" name="note_title" value="<?php if(isset($old_title)){echo $old_title;}?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="category">Category*</label>
                            <select id="category" class="form-control" placeholder="" name="note_category" required>
                                <option selected value=" ">Select your category</option>
                                <option value="1">science</option>
                                <option value="ACCOUNTS">ACCOUNTS</option>
                                <option value="SOCIAL STUDIES">SOCIAL STUDIES</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">

                            <label for="display-picture">display-picture</label>
                            <input type="file" class="form-control" id="display-picture" placeholder="" name="display_picture">


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
                                <option>type 1</option>
                                <option>type 2</option>
                                <option>type 3</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="pages">Number of pages</label>
                            <input type="number" class="form-control" id="pages" placeholder="Enter Number of Pages" name="note_pages" value="<?php if(isset($old_pages)){echo $old_pages;}?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="type">Description*</label>
                            <input type="text" class="form-control" id="description" placeholder="Enter Your Note Description" name="note_description" value="<?php if(isset($old_desc)){echo $old_desc;}?>" required>
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
                            <input type="text" class="form-control" id="institution-name" placeholder="Enter your institution name" name="institute_name" value="<?php if(isset($old_uni)){echo $old_uni;}?>">
                        </div>
                    </div>
                    <h4>Course Details</h4>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="course-name">Course name*</label>
                            <input type="text" class="form-control" id="course-name" placeholder="Enter the Course Name" name="course_name" value="<?php if(isset($old_course)){echo $old_course;}?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="course-code">Course code*</label>
                            <input type="text" class="form-control" id="course-code" placeholder="Enter Course code" name="course_code" value="<?php if(isset($old_code)){echo $old_code;}?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="professor">Professor/Lecturer*</label>
                            <input type="text" class="form-control" id="professor" placeholder="Enter your professor name" name="proffesor" value="<?php if(isset($old_prof)){echo $old_prof;}?>">
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

                <div class="form-group col-md-6">
                    <label for="note-preview">Note Preview*</label>
                    <input type="file" class="form-control" id="note-preview" placeholder="" name="note_preview">
                </div>
                <div class="form-row col-md-12">

                    <div class="form-group col-md-12">
                        <label for="sell-price">Sell Price*</label>
                        <input type="number" class="form-control" id="sell-price" placeholder="Enter Your Sell price" name="note_sell_price" value="<?php if(isset($old_price)){echo $$old_price;}?>" required>
                    </div>
                </div>
                <div class="form-row col-md-6">
                    
      <!--HTML FOR CONFIRMATION POPUP-->
                   
                    <button type="button" class="btn btn-primary" id="" name="publish" data-toggle="modal" data-target="#exampleModalCenter">EDIT</button>
                    
                       
                       
                       <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Edit this Note?</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                   <p>are you sure you want to edit this note?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"  data-dismiss="modal">CANCEL</button>
                                    <button type="submit" class="btn btn-primary" id="publish" name="confirm_edit">EDIT</button>
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
