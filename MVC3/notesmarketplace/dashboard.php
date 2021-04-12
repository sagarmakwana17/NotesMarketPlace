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



   <!--to get user info-->

<?php
$admin = "SELECT * FROM userprofile WHERE UserID = $user_id AND ProfilePicture IS NOT NULL";
$admin_info = mysqli_query($connection,$admin);
if(!$admin_info){
    die(mysqli_error($connection));
}
    $adm = mysqli_fetch_assoc($admin_info);
if(mysqli_num_rows($admin_info) != 0){
    $profile = $adm['ProfilePicture'];
   
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
    <link rel="stylesheet" href="css/dash.css">
    <link rel="stylesheet" href="css/responsive1.css">
    <link rel="stylesheet" href="admin/css/nav.css">





    <title>Dashboard</title>
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



    <section id="dashboard">
        <div class="container">
            <p id="heading">Dashboard</p>
            <a class="btn btn-primary" href="<?php echo"add_notes.php?user=".$user_id; ?>" role="button" id="addnote">ADD NOTE</a>
            <div class="content-box-lg">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="flex-wrapper d-flex stats">
                                <div class="earn">
                                    <div class="middle">
                                        <center>
                                            <img src="img/images/earning-icon.svg" alt="">
                                            <p>My Earning</p>
                                        </center>
                                    </div>
                                </div>
                                <div class="box">
                                    <div class="middle1">
                                        <center>
                                            <h2 class="title"><?php if(isset($sold_notes)){echo $sold_notes;}else{echo '0';}?></h2>
                                            <p class="description">Number of Notes sold</p>
                                        </center>
                                    </div>
                                </div>
                                <div class="box">
                                    <div class="middle1">
                                        <center>
                                            <h2 class="title">$0</h2>
                                            <p class="description">Money Earned</p>
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        $query1 = "SELECT d.*, s.Title, s.Category, s.IsPaid, s.SellingPrice FROM downloads AS d JOIN sellernotes AS s ON d.NoteID = s.ID  WHERE d.Downloader = '$user_id' AND d.IsSellerHasAllowedDownload = 1 ";
                        $my_downloads = mysqli_query($connection,$query1);
                            
                        if(!$my_downloads){
                            die(mysqli_error($connection));
                        }
                        $downloads = mysqli_num_rows($my_downloads);
                        
                        
                        $query2 = "SELECT d.*, s.Title, s.Category, s.IsPaid, s.SellingPrice FROM downloads AS d JOIN sellernotes AS s ON d.NoteID = s.ID  WHERE d.Seller = '$user_id' AND d.IsSellerHasAllowedDownload = 0 ";
                            
                        
                        $buyer_requests = mysqli_query($connection,$query2);

                            if(!$buyer_requests){
                                die(mysqli_error($connection));
                            }
                        $buyers = mysqli_num_rows($buyer_requests);
                        
                        
                          $query3 = "SELECT d.*, s.Title, s.Category, s.IsPaid, s.SellingPrice FROM downloads AS d JOIN sellernotes AS s ON d.NoteID = s.ID  WHERE d.Seller = '$user_id' ";
                         
                             $sold_notes_query = mysqli_query($connection,$query3);

                            if(!$sold_notes_query){
                                die(mysqli_error($connection));
                            }

                            $sold_notes = mysqli_num_rows($sold_notes_query); 
                        
                   /*QUERY TO FETCH REJECTED NOTES*/ 
                        
                         $query = "SELECT * FROM sellernotes WHERE Status = 'rejected' ";
                        
                            $rejected_notes = mysqli_query($connection,$query);

                                if(!$rejected_notes){
                                    die(mysqli_error($connection));
                                }

                                $rejected_notes = mysqli_num_rows($rejected_notes); 

                        

                        
                        ?>
                        <div class="col-md-6 col-sm-6">
                            <div class="flex-wrapper d-flex justify-content-around flex-nowrap">
                                <div class="box-s">
                                    <div class="middle1">
                                        <center>
                                            <h2 class="title"><?php if(isset($downloads)){echo $downloads;}else{echo '0';}?></h2>
                                            <p class="description">My Downloads</p>
                                        </center>
                                    </div>
                                </div>
                                <div class="box-s">
                                    <div class="middle1">
                                        <center>
                                            <h2 class="title"><?php if(isset($rejected_notes)){echo $rejected_notes;}else{echo '0';}?></h2>
                                            <p class="description">My Rejected Notes</p>
                                        </center>
                                    </div>
                                </div>
                                <div class="box-s">
                                    <div class="middle1">
                                        <center>
                                            <h2 class="title"><?php if(isset($buyers)){echo $buyers;}else{echo '0';}?></h2>
                                            <p class="description">Buyer Requests</p>
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="progress-notes">
        <div class="content-box-lg">
            <div class="container">
                <div class="table-title row">
                    <div class="col-6">
                        <p>In Progress Notes</p>
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
                            <th>ADDED DATE</th>
                            <th>TITLE</th>
                            <th>CATEGORY</th>

                            <th>STATUS</th>
                            <th>ACTIONS</th>
                        </tr>

                        <?php
                        
                        
                        $query = "SELECT * FROM sellernotes WHERE SellerID = '{$user_id}'";
                        
                        
                        
                        $get_table_data = mysqli_query($connection,$query);
                        if(!$get_table_data){
                            die("FAILED".mysqli_error($connection));
                        }
                        
                        while($row = mysqli_fetch_assoc($get_table_data)){
                            $note_id = $row['ID'];
                            $date = $row['CreatedDate'];
                            $title= $row['Title'];
                            $cat  = $row['Category'];
                            $status = $row['Status'];
                            
                            
                            if($status == 'draft'){
                            
                            
                    ?>
                        <tr>
                            <td><?php  echo $date;   ?></td>
                            <td><?php  echo $title;   ?></td>
                            <td><?php  echo $cat;   ?></td>
                            <td><?php  echo $status;   ?></td>

                            <td>
                                <a href="<?php echo 'edit_note.php?note_id='.$note_id ;?>"><img src="img/Dashboard/edit.png"></a>
                                <a href="<?php echo 'note_details.php?note_id='.$note_id ;?>">
                                    <img src="img/Dashboard/eye.png">
                                </a>
                            </td>

                        </tr>


                        <?php   
                                
                            }else{
                                
                    ?>


                        <tr>
                            <td><?php  echo $date;   ?></td>
                            <td><?php  echo $title;   ?></td>
                            <td><?php  echo $cat;   ?></td>
                            <td><?php  echo $status;   ?></td>

                            <td>

                                <a href="<?php echo 'note_details.php?note_id='.$note_id ;?>">
                                    <img src="img/Dashboard/eye.png">
                                </a>
                            </td>

                        </tr>

                        <?php
                            }
                        }


                        ?>



                    </table>
                </div>

                <nav aria-label="Page navigation example">
                    <ul class="pagination d-flex justify-content-center">
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&#60;</span>
                            </a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                        <li class="page-item"><a class="page-link" href="#">5</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">&#62;</span>
                            </a>
                        </li>
                    </ul>
                </nav>

            </div>
        </div>
        <div class="content-box-lg">
            <div class="container">
                <div class="table-title row">
                    <div class="col-6">
                        <p>Published Notes</p>
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
                            <th>ADDED DATE</th>
                            <th>TITLE</th>
                            <th>CATEGORY</th>
                            <th>SELL TYPE</th>
                            <th>PRICE</th>
                            <th>ACTIONS</th>
                        </tr>
                        <?php
                        $query = "SELECT * FROM sellernotes  WHERE SellerID = {$user_id} AND Status = 'published'";
                        
                        
                        
                        $get_table_data = mysqli_query($connection,$query);
                        if(!$get_table_data){
                            die("FAILED".mysqli_error($connection));
                        }
                        
                        while($row = mysqli_fetch_assoc($get_table_data)){
                            $date = $row['CreatedDate'];
                            $title= $row['Title'];
                            $cat  = $row['Category'];
                            $status = $row['Status'];
                            $sell_type = $row['IsPaid'];
                            $price = $row['SellingPrice'];
                            
                            
                            
                            
                            
                    ?>
                        <tr>
                            <td><?php  echo $date;   ?></td>
                            <td><?php  echo $title;   ?></td>
                            <td><?php  echo $cat;   ?></td>

                            <td><?php  echo $sell_type;  ?></td>

                            <td>$<?php  echo $price;  ?></td>

                            <td>
                                <a href="<?php echo 'note_details.php?note_id='.$note_id ;?>">
                                    <img src="img/Dashboard/eye.png">
                                </a>
                            </td>

                        </tr>


                        <?php   
                                
                            }
                    ?>




                    </table>
                </div>
                <center>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination d-flex justify-content-center">
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">&#60;</span>
                                </a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">4</a></li>
                            <li class="page-item"><a class="page-link" href="#">5</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">&#62;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </center>
            </div>
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
            padding-top: 7px;
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
