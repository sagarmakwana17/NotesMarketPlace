<?php
 session_start();
include"includes/database.php";
?>
<?php
     if(isset($_SESSION['user_id'])){
         
      $user_id = $_SESSION['user_id'];
 
     }

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
    <link rel="stylesheet" href="css/note.css">
    <link rel="stylesheet" href="css/responsive1.css">
    <link rel="stylesheet" href="admin/css/nav.css">



    <title>Note-Details</title>
</head>

<body>
   <style>
       #left-side img{
           width: 300px;
           height: 300px;
       }
    </style>
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
                            <li class="nav-item"><a class="nav-link" href="buyer_requests">Buyer Request</a> </li>
                            <li class="nav-item"><a class="nav-link" href="FAQ.html">FAQ</a></li>
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
                                        <a class="dropdown-item" href="#">My Profile</a>
                                        <a class="dropdown-item" href="my_downloads.php?<?php echo'user_id='.$user_id; ?>">My Downloads</a>
                                        <a class="dropdown-item" href="my_sold_notes.php?<?php echo'user_id='.$user_id; ?>">My Sold Notes</a>
                                        <a class="dropdown-item" href="my_rejected_notes.php?<?php echo'user_id='.$user_id; ?>">My Rejected Notes</a>
                                        <a class="dropdown-item" href="change_password.php?<?php echo'user_id='.$user_id; ?>">Change Password</a>
                                        <a class="dropdown-item" href="logout.php">Log out</a>
                                    </div>
                                </div>


                            </li>
                            <li class="nav-item"><a class="btn btn-primary" href="" role="button">Log Out</a></li>

                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <?php
             $n_id = $_GET['note_id'];
             $query = "SELECT * FROM sellernotes WHERE ID = '{$n_id}'";
                    $all_notes = mysqli_query($connection,$query);
                    if(!$all_notes){
                        die("FAILED TO LOAD NOIES".mysqli_error($connection));
                    }
                    while($row = mysqli_fetch_assoc($all_notes)){
                        $note_id = $row['ID'];
                        $seller_id = $row['SellerID'];
                         $note_title = $row['Title'];
                         $note_cat = $row['Category'];
                         $note_pic = $row['DisplayPicture'];
                         $note_type = $row['NoteType'];
                         $note_page = $row['NumberofPages'];
                         $note_desc = $row['Description'];
                         $note_university = $row['UniversityName'];
                         $note_country = $row['Country'];
                         $note_course = $row['Course'];
                         $note_code = $row['CourseCode'];
                         $note_prof = $row['Professor'];
                         $note_sell_type = $row['IsPaid'];
                         $note_price = $row['SellingPrice'];
                         $note_preview = $row['NotesPreview'];
                         $note_date = $row['CreatedDate'];
                        
                         
                            $file_path = $row['FilePath'];
                           
                        
                    }
                   

    ?>





    <section id="note-details">
        <div class="container">
            <div class="row">
                <div class="col-md-6" id="left-side">

                    <img src="<?php if(!empty($note_pic)){echo $note_pic ;}else {echo 'img/Search/1.jpg'; }?>" alt="" class="img-fluid">

                    <div id="right" class="">
                        <h3><?php echo $note_title; ?></h3>
                        <h4><?php echo $note_cat; ?></h4>
                        <p><?php echo $note_desc; ?></p>
                        <?php
                        if(isset($_GET['user_id'])){
                            
                    ?>
                        <?php 
                            if($note_sell_type == 'no' && !empty($note_preview)){
                        
                        ?>

                        <a href="includes/download_note.php?<?php echo 'note_location='.$file_path.'&sell_type='.$note_sell_type.'&note_id='.$n_id.'&user_id='.$user_id ;?>">
                            <button type="button" class="btn btn-primary" id="download-btn-1" name="download-1">DOWNLOAD / $ 0</button>
                        </a>

                        <?php  }else if($note_sell_type == 'yes' && !empty($note_preview)){ ?>

                        <button type="button" class="btn btn-primary" id="download-btn-paid" name="download-1" data-toggle="modal" data-target="#exampleModal">DOWNLOAD / $<?php  echo $note_price; ?></button>



                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="head">
                                        <?php
                                        $query1 = "INSERT INTO downloads(NoteID,Seller,Downloader,IsSellerHasAllowedDownload,IsAttachmentDownloaded,AttachmentDownloadedDate,IsPaid,NoteTitle,NoteCategory,CreatedDate) VALUES('{$note_id}','$seller_id','{$user_id}',0,0,now(),1,'{$note_title}','{$note_cat}',now())";
                                        $insert_query2 = mysqli_query($connection,$query1);
                                        if(!$insert_query2){
                                            die(mysqli_error($connection));
                                        }
    
                                       ?>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <div id="modal-head">
                                            <img src="img/notedetails/SUCCESS.png" alt="">
                                            <h5>Thank Yor for Purchasing !</h5>
                                        </div>
                                        <div id="success-msg">
                                            <h6> Hello Dear</h6>
                                            <h1>As this is paid note , you need to pay to seller mr.rahil shah<br>offline.We will send him an email that you want to download <br> this note. he may contact you for further payment process <br> completion.</h1><br>
                                            <h1>In case you have urgency, <br> Please contact us on +91836473684</h1> <br>
                                            <h1>Once he receives the payment and acknowledge us- selected <br>selected notes you can see over my downloads tab for download</h1> <br>
                                            <h1>have a good day !</h1>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                        <?php
                             }
                        ?>
                        <?php         
                        }else{
                            
                    ?>

                        <button type="submit" class="btn btn-primary" id="download-btn-2" name="publish" data-toggle="modal" data-target="#exampleModalCenter">DOWNLOAD</button>


                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Please Login or Register !</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>You Need to Register/Login to be able to download this note</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-dismiss="modal" id="reg">REGISTER</button>
                                       
                                        <button type="submit" class="btn btn-primary" id="publish" name="confirm_publish" >LOGIN</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php           
                        }
                    ?>


                    </div>
                </div>
                <div class="col-md-6" id="right-side">
                    <table>
                        <tr>
                            <td>
                                <h6>Institution :</h6>
                            </td>
                            <td>
                                <p><?php echo $note_university; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h6>Country :</h6>
                            </td>
                            <td>
                                <p><?php echo $note_country ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h6>Course Name :</h6>
                            </td>
                            <td>
                                <p><?php echo $note_course; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h6>Course Code :</h6>
                            </td>
                            <td>
                                <p><?php echo $note_code; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h6>Professor :</h6>
                            </td>
                            <td>
                                <p><?php echo $note_prof; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h6>Approved Date :</h6>
                            </td>
                            <td>
                                <p><?php echo $note_date; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h6>Rating :</h6>
                            </td>
                            <td>
                                <p>2 Reviews</p>
                            </td>
                        </tr>
                    </table>
                </div>

            </div>
        </div>
    </section>
    <div class="temp"></div>


    <section id="preview">
        <div class="temp"></div>

        <div class="row">
            <div class="container">
                <h2>Notes Preview and Custom reviews</h2>

                <div class="row d-flex">
                    <div class="col-md-6 note-preview">


                        <div id="Iframe-Cicis-Menu-To-Go" class="set-margin-cicis-menu-to-go set-padding-cicis-menu-to-go set-border-cicis-menu-to-go set-box-shadow-cicis-menu-to-go center-block-horiz">
                            <div class="responsive-wrapper responsive-wrapper-padding-bottom-90pct" style="-webkit-overflow-scrolling: touch; overflow: auto;">

                                <iframe src="<?php if(isset($note_preview)){ echo $note_preview;} ?>">
                                    <p style="font-size: 110%;"><em><strong>ERROR: </strong>
                                            An &#105;frame should be displayed here but your browser version does not support &#105;frames.</em> Please update your browser to its most recent version and try again, or access the file <a href="http://unec.edu.az/application/uploads/2014/12/pdf-sample.pdf">with this link.</a></p>
                                </iframe>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6">
                       <?php
                        $r = "SELECT * FROM sellernotesreviews WHERE NoteID = $n_id  LIMIT 3";
                        $r_query = mysqli_query($connection,$r);
                        if(!$r_query){
                            die(mysqli_error($connection));
                        }
                        while($rs = mysqli_fetch_assoc($r_query)){
                            
                            $rating = $rs['Ratings'];
                            $comments = $rs['Comments'];
                            $reviewedby = $rs['ReviewedByID'];
                            
                            $user = "SELECT * FROM users WHERE ID = $reviewedby";
                            $u_query = mysqli_query($connection,$user);
                            if(!$u_query){
                                die(mysqli_error($connection));
                            }
                            $user_detail = mysqli_fetch_assoc($u_query);
                            $reby =$user_detail['FirstName'].' '.$user_detail['LastName'];
                            
                        ?>    
                        
                            <div class="reviews">
                            <div class="image main">
                                <img src="img/images/customer-1.png" alt="">
                            </div>
                            <div class="info main">
                                <h6><?php echo $reby ?></h6>
                                
                                <div class="rating">
                                   <?php
                                        $num = 1;
                                        while($num<=$rating){
                                            $num++;
                                    ?>
                                     <i class="fa fa-star"></i>
                                    <?php                
                                        }
                            ?>
                                   
                                </div>
                            </div>
                            <p> <?php echo $comments; ?></p>
                        </div>
                        <?php            
                        }
                       ?>
                       
                        
                       
                    </div>

                </div>
            </div>
        </div>
    </section>

    <br><br><br><br><br><br><br><br><br><br><br><br>
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

        .image img {
            height: 60px;
            width: 60px;

        }

        .reviews {
            padding: 10px;
            height: 150px;
            border: 1px solid #8a8a8a;
        }
        .reviews p{
            font-family: "Open Sans";
            font-size: 16px;
            color: #333333;
            padding-left: 90px;
        }

        .main {
            display: inline-block;
        }

        .info {
            margin-left: 30px;
        }

    </style>









    <!-- JQUERY JS-->
    <script src="js/jquery-3.5.1.js"></script>
    <!--Bootstrap js-->
    <script src="js/bootstrap.min.js"></script>
    <!--Custom js-->
    <script src="js/script.js"></script>
    <!--<script src="js/download_note.js"></script>-->

</body>

</html>
