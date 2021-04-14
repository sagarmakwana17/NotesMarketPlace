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
    <link rel="stylesheet" href="css/bootstrap/bootstrap.css">
    <!--Custom CSS-->
    <link rel="stylesheet" href="css/search_note.css">
    <link rel="stylesheet" href="css/responsive1.css">
    
   
    <title>Search notes</title>
</head>

<body>
    <div class="">
        <header>
            <div class="">
                <nav class="navbar navbar-fixed-top">
                    <div class="container-fluid">
                        <div class="site-nav-wrapper">
                            <div class="navbar-header">
                                <!-- mobile menu-->
                                <div class="dropdown"><a href="" class="dropdown-toggle" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span id="mobile-nav-open-btn">&#9776;</span>
                                    </a>
                                   <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="<?php if(isset($user_id)){ echo 'user_profile.php?user_id='.$user_id;}else {echo 'login.php';}?>">My Profile</a>
                                        <a class="dropdown-item" href="my_downloads.php?<?php echo'user_id='.$user_id; ?>">My Downloads</a>
                                        <a class="dropdown-item" href="my_sold_notes.php?<?php echo'user_id='.$user_id; ?>">My Sold Notes</a>
                                        <a class="dropdown-item"  href="my_rejected_notes.php?<?php echo'user_id='.$user_id; ?>">My Rejected Notes</a>
                                        <a class="dropdown-item" href="change_password.php?<?php echo'user_id='.$user_id; ?>">Change Password</a>
                                        <a class="dropdown-item" href="logout.php">Log out</a>
                                    </div>
                                </div>
                                <a href="#" class="navbar-brand">
                                    <img src="img/logo.png">
                                </a>
                            </div>
                            <div class=" ">
                                <div class="collapse navbar-collapse">
                                    <ul class="nav navbar-nav pull-right">
                                        <li><a href="">Search Notes</a></li>
                                        <li><a href="<?php echo"dashboard.php?user=".$user_id; ?>">Sell Your Notes</a></li>
                                        <li><a href="buyer_requests">Buyer Request</a> </li>
                                        <li><a href="FAQ.html">FAQ</a></li>
                                        <li><a href="<?php if(isset($user_id)){ echo 'contact_us.php?user_id='.$user_id;}else {echo 'contact_us.php';}?>">Contact Us</a></li>
                                        <li>
                                            <div class="dropdown"><a href="" class="dropdown-toggle" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <img src="img/images/user-img.png" alt="">
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                    <a class="dropdown-item" href="<?php if(isset($user_id)){ echo 'user_profile.php?user_id='.$user_id;}else {echo 'login.php';}?>">My Profile</a><br>
                                                    <a class="dropdown-item" href="<?php if(isset($user_id)){ echo 'my_downloads.php?user_id='.$user_id;}else {echo 'login.php';}?>">My Downloads</a><br>
                                                    <a class="dropdown-item" href="<?php if(isset($user_id)){ echo 'my_sold_notes.php?user_id='.$user_id;}else {echo 'login.php';}?>">My Sold Notes</a><br>
                                                    <a class="dropdown-item" href="<?php if(isset($user_id)){ echo 'my_rejected_notes.php?user_id='.$user_id;}else {echo 'login.php';}?>">My Rejected Notes</a><br>
                                                    <a class="dropdown-item" href="<?php if(isset($user_id)){ echo 'change_password.php?user_id='.$user_id;}else {echo 'login.php';}?>">Change Password</a><br>
                                                    <a class="dropdown-item" href="logout.php">Log Out</a>
                                                </div>
                                            </div>
                                        </li>
                                        <li><a class="btn btn-primary" href="logout.php" role="button">Log Out</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </header>
    </div>
    <section id="user-section">
        <div class="content-box-lg">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div id="user_profile" class="text-center">
                            <h4>Search Notes</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="search-notes">
        <div class="content-box-lg">
            <div class="container">
                <h3>Search and filter notes</h3>

                <div id="form_wrapper">
                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <i class="fa fa-search"></i>
                                <div id="search-bar">
                                    <input type="text" placeholder="     search notes here" class="form-control" id="search" onkeyup="">
                                </div> 
                            </div>
                            <div class="form-group col-md-2">
                                <select id="type" class="form-control" name="type">
                                    <option value="" selected disabled>select type</option>
                                     <?php
                                        $query = "SELECT * FROM notetypes";
                                        $types = mysqli_query($connection,$query);
                                        if(!$types){
                                            die(mysqli_error($connection));
                                        }
                                        while($row = mysqli_fetch_assoc($types)){
                                            $type_name = $row['Name'];
                                            echo"<option value='$type_name'>$type_name</option>";
                                        }
                                    ?>
                                   
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <select id="category" class="form-control" name="category" id="category">
                                    <option value = "" selected disabled>Select category</option>
                                     <?php
                                        $query = "SELECT * FROM notecategories WHERE IsActive = 1";
                                        $cats = mysqli_query($connection,$query);
                                        if(!$cats){
                                            die(mysqli_error($connection));
                                        }
                                        while($row = mysqli_fetch_assoc($cats)){
                                            $cat_name = $row['Name'];
                                            echo"<option value='$cat_name'>$cat_name</option>";
                                        }
                                    ?>
                                   
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <select id="university" class="form-control" name="university">
                                    <option value="" disabled selected>select university</option>
                                     <?php
                                        $query = "SELECT DISTINCT UniversityName FROM sellernotes";
                                        $universities = mysqli_query($connection,$query);
                                        if(!$universities){
                                            die(mysqli_error($connection));
                                        }
                                        while($row = mysqli_fetch_assoc($universities)){
                                            $uni_name = $row['UniversityName'];
                                            echo"<option value='$uni_name'>$uni_name</option>";
                                        }
                                    ?>
                                   
                                    
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <select id="course" class="form-control" name="course">
                                    <option value="" selected disabled>select course</option>
                                     <?php
                                        $query = "SELECT DISTINCT Course FROM sellernotes";
                                        $courses = mysqli_query($connection,$query);
                                        if(!$courses){
                                            die(mysqli_error($connection));
                                        }
                                        while($row = mysqli_fetch_assoc($courses)){
                                            $course_name = $row['Course'];
                                            echo"<option value='$course_name'>$course_name</option>";
                                        }
                                    ?>
                                   
                                    
                                   
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <select id="country" class="form-control" name="country">
                                    <option selected disabled>select country</option>
                                    <?php
                                        $query = "SELECT * FROM countries";
                                        $countries = mysqli_query($connection,$query);
                                        if(!$countries){
                                            die(mysqli_error($connection));
                                        }
                                        while($row = mysqli_fetch_assoc($countries)){
                                            $country_name = $row['Name'];
                                            echo"<option value='$country_name'>$country_name</option>";
                                        }
                                    ?>
                                   
                                   
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <select id="rating" class="form-control" name="rating">
                                    <option selected disabled>select rating</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="">
            <div class="container note_container">
               
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
                
                
                    $query = "SELECT * FROM sellernotes";
                    $all_notes = mysqli_query($connection,$query);
                    if(!$all_notes){
                        die("FAILED TO LOAD NOIES".mysqli_error($connection));
                    }
                
                     $total_records = mysqli_num_rows($all_notes); 
                         $total_pages = ceil($total_records / $num_per_page);
                        $i=1;
                        $k=  $num_per_page + $start_from;
                        $srno = 1;
                
                   $count = mysqli_num_rows($all_notes);
                    echo"<h3>Total $count  notes</h3>";
                    while($row = mysqli_fetch_assoc($all_notes)){
                        $note_id = $row['ID'];
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
                        if($start_from<$i){
                        
                    ?>
                <a href="<?php if(isset($user_id)){ echo 'note_details.php?note_id='.$note_id.'&user_id='.$user_id;}else {echo 'note_details.php?note_id='.$note_id;}?>">
                    <div class="col-md-4">
                        <div class="note-wrapper">
                            <img src="<?php if(!empty($note_pic)){echo $note_pic ;}else {echo 'img/Search/1.jpg'; }?>" class="img-responsive">
                            <div class="details">

                                <div class="note-title">
                                    <p><?php echo $note_title ;?></p>
                                </div>
                                <table class="note-info table-borderless">
                                    <tr>
                                        <td><img src="img/images/university.png"></td>
                                        <td><?php echo $note_university ;?></td>
                                    </tr>
                                    <tr>
                                        <td><img src="img/images/pages.png"></td>
                                        <td><?php echo $note_page ;?></td>
                                    </tr>
                                    <tr>
                                        <td><img src="img/images/calendar.png"></td>
                                        <td><?php echo $note_date ;?></td>
                                    </tr>
                                    <tr>
                                        <td><img src="img/images/flag.png"></td>
                                        <td class="report" style="color: red"> users marked this note as inapporpriate</td>
                                    </tr>

                                </table>
                                <div class="bottom">
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
                                    <div class="reviews">
                                        <p>500 Reviews</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>







                <?php         
                    }
                                $i++;
                                if($i>$k){
                                    break;
                                }
                    }
                
                ?>


    


            </div>
        </div>
    </section>
    <style>
        .note-wrapper{
            height: 450px;
        }
    </style>
    <center>
        <nav aria-label="Page navigation example" id="pagination">
                    <ul class="pagination d-flex justify-content-center">
                        <li class="page-item  <?php if($page == 1){ echo 'disabled'; }?>">
                            <a class="page-link" href="search_notes.php?page=<?php echo $page-1; ?>" aria-label="Previous">
                                <span aria-hidden="true">&#60;</span>
                            </a>
                        </li>
                        <?php 
                            for($i=1;$i<=$total_pages;$i++){
                        ?>
                        <li class="page-item">
                            <a class="page-link <?php if($page == $i) { echo 'active'; }?>" href="search_notes.php?page=<?php echo $i ; ?>"><?php echo $i ;?></a>
                        </li>
                        <?php 
                            }
                        ?>




                        <li class="page-item <?php if($page == $total_pages){ echo 'disabled'; }?>">
                            <a class="page-link" href="search_notes.php?page=<?php echo $page-1; ?>" aria-label="Next">
                                <span aria-hidden="true">&#62;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
    </center>
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
    <script src="js/filter_notes2.js"></script>
</body>

</html>
