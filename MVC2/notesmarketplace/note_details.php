<?php
 session_start();
include"includes/database.php";
?>
<?php
     if(isset($_SESSION['user_id'])){
         
      $user_id = $_SESSION['user_id'];
 
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
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">

    <!--Custom CSS-->
    <link rel="stylesheet" href="css/note_info.css">
    <link rel="stylesheet" href="css/responsive.css">



    <title>Note-Details</title>
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


                        <li class="nav-item"><a class="nav-link" href="search_notes.html">Search Notes</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo"dashboard.php?user=".$user_id; ?>">Sell Your Notes</a></li>
                        <li class="nav-item"><a class="nav-link" href="buyer_requests">Buyer Request</a> </li>
                        <li class="nav-item"><a class="nav-link" href="FAQ.html">FAQ</a></li>
                        <li class="nav-item"><a class="nav-link" href="contact_us.html">Contact Us</a></li>
                        <li class="">
                            <div class="dropdown"><a class="nav-link" href="" class="dropdown-toggle" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                        <li class="nav-item"><a class="btn btn-primary" href="" role="button">Log Out</a></li>


                    </ul>

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
                    }
                   

    ?>





    <section id="note-details">
        <div class="container">
            <div class="row">
                <div class="col-md-6" id="left-side">

                    <img src="img/notedetails/first.jpg" alt="" class="img-responsive">

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

                        <a href="includes/download_note.php?<?php echo 'note_location='.$note_preview.'&sell_type='.$note_sell_type.'&note_id='.$n_id.'&user_id='.$user_id ;?>">
                            <button type="button" class="btn btn-primary" id="download-btn-1" name="download-1">DOWNLOAD / $ 0</button>
                        </a>

                        <?php  }else if($note_sell_type == 'yes' && !empty($note_preview)){ ?>
                        
                            <button type="button" class="btn btn-primary" id="download-btn-paid" name="download-1"  data-toggle="modal" data-target="#exampleModal">DOWNLOAD / $<?php  echo $note_price; ?></button>
                       
                        
                            
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
                                            <h6> dear Smith</h6>
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
                                        <button type="submit" class="btn btn-primary" id="publish" name="confirm_publish">LOGIN</button>
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

        <h2>Notes Preview and Custom Previews</h2>

        <div class="container">
            <div class="row">
                <div class="col-md-6 note-preview">


                    <div id="Iframe-Cicis-Menu-To-Go" class="set-margin-cicis-menu-to-go set-padding-cicis-menu-to-go set-border-cicis-menu-to-go set-box-shadow-cicis-menu-to-go center-block-horiz">
                        <div class="responsive-wrapper responsive-wrapper-padding-bottom-90pct" style="-webkit-overflow-scrolling: touch; overflow: auto;">

                            <iframe src="uploads/notes_preview/TS_SRS_Notes_marketplace_v1.0.pdf">
                                <p style="font-size: 110%;"><em><strong>ERROR: </strong>
                                        An &#105;frame should be displayed here but your browser version does not support &#105;frames.</em> Please update your browser to its most recent version and try again, or access the file <a href="http://unec.edu.az/application/uploads/2014/12/pdf-sample.pdf">with this link.</a></p>
                            </iframe>
                        </div>
                    </div>

                </div>

                <div class="col-md-6" id="note-reviews">
                    <div class="review-container">
                        <table>
                            <tr>
                                <td><img src="img/home/testimonial/client-1.jpg"></td>
                                <td>
                                    <div class="main-information">
                                        <p>Richard Brown</p>
                                        <div class="rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o"></i>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <h6>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iure repellat asperiores nisi dignissimos pariatur dolor quis ut beatae, totam quos. Possimus facere impedit similique nobis at a dolores veritatis perspiciatis?</h6>
                    </div>
                    <div class="review-container">
                        <table>
                            <tr>
                                <td><img src="img/home/testimonial/client-1.jpg"></td>
                                <td>
                                    <div class="main-information">
                                        <p>Alis Ortiaz</p>
                                        <div class="rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o"></i>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <h6>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iure repellat asperiores nisi dignissimos pariatur dolor quis ut beatae, totam quos. Possimus facere impedit similique nobis at a dolores veritatis perspiciatis?</h6>
                    </div>
                    <div class="review-container">
                        <table>
                            <tr>
                                <td><img src="img/home/testimonial/client-1.jpg"></td>
                                <td>
                                    <div class="main-information">
                                        <p>Sara Martin</p>
                                        <div class="rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o"></i>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <h6>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iure repellat asperiores nisi dignissimos pariatur dolor quis ut beatae, totam quos. Possimus facere impedit similique nobis at a dolores veritatis perspiciatis?</h6>
                    </div>
                </div>
            </div>
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
    <!--<script src="js/download_note.js"></script>-->

</body>

</html>
