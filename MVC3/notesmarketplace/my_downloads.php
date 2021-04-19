<?php
 session_start();
include"includes/database.php";
?>
<?php
if(!isset($_SESSION['user_id'])){
    
?>
<script>
    location.replace('login.php');

</script>
<?php
    
}else{
    $user_id = $_SESSION['user_id'];
}

?>

<?php
     
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <link rel="stylesheet" href="admin/css/bootstrap/bootstrap.min.css">



    <!--Custom CSS-->
    <link rel="stylesheet" href="css/requests_buyer.css">
    <link rel="stylesheet" href="css/responsive1.css">
    <link rel="stylesheet" href="admin/css/nav.css">

    <title>My Downloads</title>
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
    <style>
        .dropdown-menu {
            box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.1);
            border: none;
            width: 250px;
        }

    </style>


    <section id="buyer-requests">
        <div class="content-box-lg">
            <div class="container">
                <div class="table-title row">
                    <div class="col-6">
                        <p>My Downloads</p>
                    </div>
                    <div class="col-6">
                         <form class="form-inline" method="post">

                            <input type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" placeholder="Search" name="search">

                            <button type="submit" class="btn btn-primary mb-2" name="submit">Submit</button>

                        </form>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="progres">

                        <tr>
                            <th>Sr.No.</th>

                            <th>TITLE</th>
                            <th>CATEGORY</th>
                            <th>BUYER</th>

                            <th>SELL TYPE</th>
                            <th>PRICE</th>
                            <th>DWONLOAD DATE/TIME</th>
                            <th></th>
                            <th></th>
                        </tr>


                        <?php
            
                    if(isset($_GET['page'])){
                    $page = $_GET['page'];
                    $page =mysqli_real_escape_string($connection,$page);
                    $page = htmlentities($page);
                    }
                    else{
                        $page = 1;
                    }    
                    $num_per_page = 5;
                    $start_from = ($page-1) * $num_per_page;

                        
                         if(isset($_POST['submit'])){ 
                                $search = $_POST['search'];
                                 $query = "SELECT d.*, s.Title, s.Category, s.IsPaid, s.SellingPrice, s.FilePath FROM downloads AS d JOIN sellernotes AS s ON d.NoteID = s.ID  WHERE d.Downloader = $user_id AND d.IsSellerHasAllowedDownload = 1 AND s.Title LIKE '{$search}%'";
                             }
                            else{
                             $query = "SELECT d.*, s.Title, s.Category, s.IsPaid, s.SellingPrice, s.FilePath FROM downloads AS d JOIN sellernotes AS s ON d.NoteID = s.ID  WHERE d.Downloader = $user_id && d.IsSellerHasAllowedDownload = 1 ";
                            }
                        
                    

                    $buyer_requests = mysqli_query($connection,$query);
                            
                        if(!$buyer_requests){
                            die(mysqli_error($connection));
                        }
                        
                        $total_records = mysqli_num_rows($buyer_requests); 
                         $total_pages = ceil($total_records / $num_per_page);
                        $i=1;
                        $k=  $num_per_page + $start_from;
                        $srno = 1;
                         $count = 0;
                        while($row = mysqli_fetch_assoc($buyer_requests)){
                             $count = $count + 1;
                                if($row['IsPaid'] == 'no'){
                                    $selltype = "Free";
                                }else{
                                    $selltype = "Paid";
                                }
                                $download_id = $row['ID'];

                                $seller = $row['Seller'];
                                $seller_details = "SELECT u.* , p.* FROM userprofile AS p JOIN users AS u WHERE UserID = $seller";
                                $seller_details_query = mysqli_query($connection,$seller_details);
                                if(!$seller_details_query){
                                    die(mysqli_error($connection));
                                }else{
                                    $seller_info = mysqli_fetch_assoc($seller_details_query);
                                    $email = $seller_info['EmailID'];
                                    $num = $seller_info['PhoneNumber'];
                                }
                                $note_id = $row['NoteID'];
                               
                                $file_location = $row['FilePath'];
                                 if($start_from<$i){
                                     

                    ?>
                        <tr>
                            <td>
                                <?php echo $srno++;?>
                            </td>
                            <td><?php echo $row['Title']; ?></td>
                            <td><?php echo $row['Category']; ?></td>
                            <td><?php echo $email; ?></td>

                            <td><?php echo $selltype; ?></td>
                            <td>$<?php echo $row['SellingPrice']; ?></td>
                            <td><?php echo $row['AttachmentDownloadedDate']; ?></td>
                            <td><a href="<?php echo 'note_details.php?note_id='.$row['NoteID']; ?>"><img src="img/images/eye.png"></a></td>
                            <td>

                                <div class="dropdown">
                                    <a class="" data-toggle="dropdown">
                                        <div class="dots">
                                            <img src="img/images/dots.png">
                                        </div>
                                    </a>
                                    <div class="dropdown-menu">


                                        <a class="dropdown-item text-center" href="<?php echo $file_location; ?>" download>Download Note</a>
                                        <a class="dropdown-item text-center" data-toggle="modal" data-target="#p<?php echo $srno; ?>">Add Reviews/Feedback</a>
                                        <a class="dropdown-item text-center" >Report as inappropriate</a>
                                    </div>
                                </div>
                            </td>

                            <!--modal for reviews-->

                            <div class="modal fade" id="p<?php echo $srno; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="head">

                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <div class="title">
                                                <h4>Add Review</h4>
                                            </div>
                                          <?php
                                                if(isset($_POST['submit_review'])){
                                                    $rating = $_POST['rate'];
                                                    $comment = $_POST['comment'];
                                                    $d_id = $download_id;
                                                    $u_id = $user_id;
                                                    $n_id = $note_id; 
                                                   
                                                   
                                                }
                                            ?>

                                            <form action="" method="post">
                                                <div class="ratings col-md-12">
                                                    <div class="rate">

                                                        <input type="radio" id="star5" name="rate" value="5" />
                                                        <label for="star5" title="text">5 stars</label>
                                                        <input type="radio" id="star4" name="rate" value="4" />
                                                        <label for="star4" title="text">4 stars</label>
                                                        <input type="radio" id="star3" name="rate" value="3" />
                                                        <label for="star3" title="text">3 stars</label>
                                                        <input type="radio" id="star2" name="rate" value="2" />
                                                        <label for="star2" title="text">2 stars</label>
                                                        <input type="radio" id="star1" name="rate" value="1" />
                                                        <label for="star1" title="text">1 star</label>

                                                    </div>
                                                </div>
                                                <div class="form-row col-md-12" style="margin-left:20px;">
                                                    <div class="form-group">
                                                        <label for="title">Comments<span style="margin-left: 0px !important; text-align:left !important; color:red"> *</span></label>
                                                        <input type="text" class="form-control" id="title" placeholder="Comments....." name="comment" required>
                                                    </div>
                                                    
                                                </div>
                                                 <button type="submit" class="btn btn-primary" name="submit_review" style="margin-left:20px;" id="review_submit">SUBMIT</button>

                                            </form>
                                        </div>


                                    </div>
                                </div>
                            </div>
                            <style>
                                #review_submit{
                                     margin-left: 20px;
                                }
                                .form-group{
                                    margin-top: 50px;
                                    
                            
                                }
                                .form-group input{
                                    width: 200%;
                                    height: 120px;
                                }
                                .modal-content {
                                    height: 500px;
                                }

                                .close {
                                    margin: 10px;
                                }

                                .title {
                                    margin-top: 20px;
                                    margin-left: 20px;
                                }

                                .title h4 {
                                    font-family: "Open Sans";
                                    font-size: 26px;
                                    font-weight: 600;
                                    line-height: 30px;
                                    color: #6255a5;
                                    margin-top: 10px;
                                }

                                * {
                                    margin: 0;
                                    padding: 0;
                                }

                                .rate {
                                    float: left;
                                    height: 46px;
                                    padding: 0 10px;
                                }

                                .rate:not(:checked)>input {
                                    position: absolute;
                                    top: -9999px;
                                }

                                .rate:not(:checked)>label {
                                    float: right;
                                    width: 1em;
                                    overflow: hidden;
                                    white-space: nowrap;
                                    cursor: pointer;
                                    font-size: 60px;
                                    color: #ccc;
                                }

                                .rate:not(:checked)>label:before {
                                    content: '★ ';
                                }

                                .rate>input:checked~label {
                                    color: #ffc700;
                                }

                                .rate:not(:checked)>label:hover,
                                .rate:not(:checked)>label:hover~label {
                                    color: #deb217;
                                }

                                .rate>input:checked+label:hover,
                                .rate>input:checked+label:hover~label,
                                .rate>input:checked~label:hover,
                                .rate>input:checked~label:hover~label,
                                .rate>label:hover~input:checked~label {
                                    color: #c59b08;
                                }

                            </style>


                        </tr>


                        <?php                        
                            }    
                            
                                $i++;
                                if($i>$k){
                                    break;
                                }
                                 }
                        ?>

                       
                    </table>
                </div>
                <style>
                    #pagination {
                        margin-top: 50px;
                    }

                </style>
                 <?php
                if($total_records==0){
                    echo" <p class='text-center' style= 'font-size:26px; margin-top : 20px; color:#6255a5; font-weight:600'>No Records Found !</p>";
                }
                ?>
                <nav aria-label="Page navigation example" id="pagination">
                    <ul class="pagination d-flex justify-content-center">
                        <li class="page-item  <?php if($page == 1){ echo 'disabled'; }?>">
                            <a class="page-link" href="my_downloads.php?page=<?php echo $page-1; ?>" aria-label="Previous">
                                <span aria-hidden="true">&#60;</span>
                            </a>
                        </li>
                        <?php 
                            for($i=1;$i<=$total_pages;$i++){
                        ?>
                        <li class="page-item">
                            <a class="page-link <?php if($page == $i) { echo 'active'; }?>" href="my_downloads.php?page=<?php echo $i ; ?>"><?php echo $i ;?></a>
                        </li>
                        <?php 
                            }
                        ?>




                        <li class="page-item <?php if($page == $total_pages){ echo 'disabled'; }?>">
                            <a class="page-link" href="my_downloads.php?page=<?php echo $page-1; ?>" aria-label="Next">
                                <span aria-hidden="true">&#62;</span>
                            </a>
                        </li>
                    </ul>
                </nav>

            </div>
        </div>

    </section>

    <!--INSERT REVIEW QUERY-->
                                         <?php
                                                if(isset($_POST['submit_review'])){
                                                    
                                                    $query2 = "SELECT * FROM sellernotesreviews WHERE NoteID=$note_id && ReviewedByID = $u_id AND AgainstDownloadsID = $d_id";
                                                    $fetch_reviews = mysqli_query($connection,$query2);
                                                    if(!$fetch_reviews){
                                                        die(mysqli_error($connection));
                                                    }
                                                    if(mysqli_num_rows($fetch_reviews) == 0){
                                                        $insert_review = "INSERT INTO sellernotesreviews(NoteID,ReviewedByID,AgainstDownloadsID,Ratings,Comments,CreatedDate) VALUES($n_id,$u_id,$d_id,$rating,'$comment',now())";
                                                        $insert_query = mysqli_query($connection,$insert_review);
                                                        if(!$insert_query){
                                                            die(mysqli_error($connection));
                                                        }else{
                                                            
                                                            
                                                            
                                                            
                                                            
                                                        }
                                                    }
                                                }
                                            ?>
                                         

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
