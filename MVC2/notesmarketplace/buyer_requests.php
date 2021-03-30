<?php
include"includes/database.php";
?>
<?php
if(isset($_GET['user_id'])){
    $user_id = $_GET['user_id'];
    
}else{
    $user_id = 16;
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
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">



    <!--Custom CSS-->
    <link rel="stylesheet" href="css/requests_buyer.css">
    <link rel="stylesheet" href="css/responsive1.css">

    <title>Buyer Requests</title>
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
                            <li class="nav-item"><a class="nav-link" href="buyer_requests">Buyer Request</a> </li>
                            <li class="nav-item"><a class="nav-link" href="FAQ.html">FAQ</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?php if(isset($user_id)){ echo 'contact_us.php?user_id='.$user_id;}else {echo 'contact_us.php';}?>">Contact Us</a></li>
                            <li class="nav-item ">
                                <div class="dropdown show">
                                    <a class="" href="#" role="" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img class="profile" src="img/images/user-img.png" alt="">
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="#">My Profile</a>
                                        <a class="dropdown-item" href="my_downloads.php?<?php echo'user_id='.$user_id; ?>">My Downloads</a>
                                        <a class="dropdown-item" href="my_sold_notes.php?<?php echo'user_id='.$user_id; ?>">My Sold Notes</a>
                                        <a class="dropdown-item"  href="my_rejected_notes.php?<?php echo'user_id='.$user_id; ?>">My Rejected Notes</a>
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




    <section id="buyer-requests">
        <div class="content-box-lg">
            <div class="container">
                <div class="table-title row">
                    <div class="col-6">
                        <p>Buyer Requests</p>
                    </div>
                    <div class="col-6">
                       
                            <form class="form-inline">

                                <input type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" placeholder="Search">

                                <button type="submit" class="btn btn-primary mb-2">Submit</button>
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
                            <th>PHONE NO.</th>
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
                            
                            
                             $query = "SELECT d.*, s.Title, s.Category, s.IsPaid, s.SellingPrice FROM downloads AS d JOIN sellernotes AS s ON d.NoteID = s.ID  WHERE d.Seller = $user_id && d.IsSellerHasAllowedDownload = 0  AND s.Title LIKE '{$search}%'";

                            }else{
                             
                            $query = "SELECT d.*, s.Title, s.Category, s.IsPaid, s.SellingPrice FROM downloads AS d JOIN sellernotes AS s ON d.NoteID = s.ID  WHERE d.Seller = $user_id && d.IsSellerHasAllowedDownload = 0 ";
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
                            if($start_from<$i){


                    ?>
                        <tr>
                            <td>
                                <?php echo $srno; ?>
                            </td>
                            <td><?php echo $row['Title']; ?></td>
                            <td><?php echo $row['Category']; ?></td>
                            <td><?php echo $email; ?></td>
                            <td><?php echo $num; ?></td>
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
                                        <a class="dropdown-item text-center" href="includes/allow_download.php?<?php echo'user_id='.$user_id.'&download_id='.$download_id; ?>">Yes, I Received</a>

                                    </div>
                                </div>
                            </td>

                        </tr>


                        <?php                        
                        }
                             $i++;
                                if($i>$k){
                                    break;
                                }
                        }
                    ?>

                        <tr>
                            <td>1</td>
                            <td>static</td>
                            <td>static category</td>
                            <td>static@gmail.com</td>
                            <td>545454545454</td>
                            <td>Paid</td>
                            <td>$50</td>
                            <td>10-10-20</td>
                            <td><img src="img/images/eye.png"></td>
                            <td>

                                <div class="dropdown">
                                    <a class="" data-toggle="dropdown">
                                        <div class="dots">
                                            <img src="img/images/dots.png">
                                        </div>
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item text-center" href="#">Yes, I Received</a>

                                    </div>
                                </div>
                            </td>

                        </tr>

                    </table>
                </div>

                <nav aria-label="Page navigation example" id="pagination">
                    <ul class="pagination d-flex justify-content-center">
                        <li class="page-item  <?php if($page == 1){ echo 'disabled'; }?>">
                            <a class="page-link" href="buyer_requests.php?page=<?php echo $page-1; ?>" aria-label="Previous">
                                <span aria-hidden="true">&#60;</span>
                            </a>
                        </li>
                        <?php 
                            for($i=1;$i<=$total_pages;$i++){
                        ?>
                        <li class="page-item">
                            <a class="page-link <?php if($page == $i) { echo 'active'; }?>" href="buyer_requests.php?page=<?php echo $i ; ?>"><?php echo $i ;?></a>
                        </li>
                        <?php 
                            }
                        ?>




                        <li class="page-item <?php if($page == $total_pages){ echo 'disabled'; }?>">
                            <a class="page-link" href="buyer_requests.php?page=<?php echo $page-1; ?>" aria-label="Next">
                                <span aria-hidden="true">&#62;</span>
                            </a>
                        </li>
                    </ul>
                </nav>

            </div>
        </div>

    </section>
    <br><br><br><br><br><br> <br><br><br><br><br><br>


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
