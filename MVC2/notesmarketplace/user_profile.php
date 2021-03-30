<?php
include"includes/database.php";
session_start();

if(isset($_GET['user_id'])){
    $user_id = $_GET['user_id'];
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
    <link rel="stylesheet" href="css/user_profilee.css">
<link rel="stylesheet" href="css/responsive1.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>



    <title>user_profile</title>
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
                            <li class="nav-item"><a class="btn btn-primary" href="" role="button">Log Out</a></li>

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

                            <h4>User Profile</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="details">
        <div class="content-box-lg">
           <?php
                   if(isset($_POST['submit'])){
                    
                       $first_name = $_POST['first_name'];
                        $last_name = $_POST['first_name'];
                        $email = $_POST['email'];
                        $birth_date = $_POST['birth_date'];
                        $gender = $_POST['gender'];
                        $country_code = $_POST['country_code'];
                        $phone_number = $_POST['phone_number'];
                        
                        $address1 = $_POST['address1'];
                        $address2 = $_POST['address2'];
                        $city = $_POST['city'];
                        $state = $_POST['state'];
                        $zipcode = $_POST['zipcode']; 
                        $country = $_POST['country'];
                        $uni = $_POST['uni'];
                        $college = $_POST['college'];
                       
                       
                       
                       
                       
                       
                        /*code to upload profile pic*/
                    

                                $file = $_FILES['profile'];
                                $file_name = $_FILES['profile']['name'];
                                $file_tmp_name = $_FILES['profile']['tmp_name'];
                                $file_size = $_FILES['profile']['size'];
                                $file_error = $_FILES['profile']['error'];

                                /*code to allow only certain types of file*/


                                $file_ext = explode('.', $file_name);
                                $file_actual_ext = strtolower(end($file_ext));
                                $allowed_types = array('jpg','jpeg','png');
                                if(in_array($file_actual_ext,$allowed_types)){
                                    if($file_error === 0){
                                        if($file_size < 10000000){
                                            $file_destination = 'uploads/user_profile_pictures/'.$file_name;
                                            move_uploaded_file($file_tmp_name, $file_destination);
                                            $profile_pic =  $file_destination;
                                        }else{
                                            $size_error= "your file must be less than 10 mb";
                                        }
                                    }else{
                                        $upload_error = "Failed to upload";
                                    }
                                }else{
                                    $type_error  = "Please upload only jpeg , jpg and png files";
                                }
                                
                                if(!isset( $display_pic)){
                                     $profile_pic = "";
                                }
                       
                       
                       
                         $query1 = "INSERT INTO userprofile(UserID,DOB,Gender,SecondaryEmailAddress,PhoneNumber_CountryCode,PhoneNumber,ProfilePicture,AddressLine1,AddressLine2,City,State,Zipcode,Country,University,College,CreatedDate) VALUES(15,'{$birth_date}','{$gender}','$email',{$country_code},'{$phone_number}','{$profile_pic}','{$address1}','{$address2}','{$city}','{$state}','{$zipcode}','{$country}','{$uni}','{$college}',now())";
                        
                                        $user_profile_query = mysqli_query($connection,$query1);
                                        if(!$user_profile_query ){
                                            die("FAILED".mysqli_error($connection));
                                        }    
                       
                                if(preg_match('/^[1-9][0-9]{10}$/', $phone_number)){
                                    
                                     $query1 = "INSERT INTO userprofile(UserID,DOB,Gender,SecondaryEmailAddress,PhoneNumber_CountryCode,PhoneNumber,ProfilePicture,AddressLine1,AddressLine2,City,State,Zipcode,Country,University,College,CreatedDate) VALUES('{$user_id}','{$birth_date}','{$gender}','$email',{$country_code},'{$phone_number}','{$profile_pic}','{$address1}','{$address2}','{$city}','{$state}','{$zipcode}','{$country}','{$uni}','{$college}',now())";
                        
                                        $user_profile_query = mysqli_query($connection,$query1);
                                        if(!$user_profile_query ){
                                            die("FAILED".mysqli_error($connection));
                                        }    
                                    
                                }
                       
                       
                       
                   }
           ?> 
          
           
           
            <form action="" method="post" enctype="multipart/form-data">
              <div class="container">
               <h3>Basic Profile Details</h3>  
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="first-name">First Name<span style="margin-left: 0px !important; text-align:left !important; color:red"> *</span></label>
                        <input type="text" class="form-control" id="first-name" placeholder="Enter your firstname" name="first_name" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="last-name">Last Name<span style="margin-left: 0px !important; text-align:left !important; color:red"> *</span></label>
                        <input type="text" class="form-control" id="last-name" placeholder="Enter your last name" name="last_name" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="email">Email<span style="margin-left: 0px !important; text-align:left !important; color:red"> *</span></label>
                        <input type="email" class="form-control" id="email" placeholder="Enter your email" name="email" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="birthdate">Birth Date</label>
                        <input type="date" class="form-control" id="birthdate" placeholder="Enter your birthdate" name="birth_date">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="gender">Gender</label>
                        <select id="gender" class="form-control" name="gender">
                            <option value="male" selected>male</option>
                            <option value="female">female</option>
                        </select>
                    </div>
                    <div class="form-group col-md-2"> 
                        <label for="country-code">Phone</label>
                        <select id="country-code" class="form-control" name="country_code">
                            <option value="91" selected>+91</option>
                            <option value="92">+92</option>
                            <option value="1">+1</option>
                            
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="phone-no"> </label>
                        <input type="text" class="form-control" id="phone-no" placeholder="Enter your phone number" name="phone_number" required  maxlength="10" size="10">
                    </div>
                </div>
                <div class="form-row" id="profile-upload">
                    <div class="form-group col-md-12">
                        <label for="last-name">Profile-picture</label>
                        <input type="file" class="form-control" id="profile" placeholder="upload a picture" name="profile">
                    </div>
                </div>
                 <h4>Address Details</h4>
                 <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="Address-line-1">Address line 1<span style="margin-left: 0px !important; text-align:left !important; color:red"> *</span></label>
                        <input type="text" class="form-control" id="Address-line-1" placeholder="Enter your address" name="address1" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="Address-line-2">Address line 2<span style="margin-left: 0px !important; text-align:left !important; color:red"> *</span></label>
                        <input type="text" class="form-control" id="Address-line-2" placeholder="Enter your address" name="address2" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="city">City<span style="margin-left: 0px !important; text-align:left !important; color:red"> *</span></label>
                        <input type="text" class="form-control" id="city" placeholder="Enter your city" name="city" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="state">State<span style="margin-left: 0px !important; text-align:left !important; color:red"> *</span></label>
                        <input type="text" class="form-control" id="state" placeholder="Enter your state" name="state" required>
                    </div>
                </div>
                 <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="zipcode">Zipcode<span style="margin-left: 0px !important; text-align:left !important; color:red"> *</span></label>
                        <input type="number" class="form-control" id="zipcode" placeholder="Enter your zipcode" name="zipcode" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="country">Country<span style="margin-left: 0px !important; text-align:left !important; color:red"> *</span></label>
                        <input type="text" class="form-control" id="country" placeholder="Enter your country" name="country" required>
                    </div>
                </div>
                <h5>University and College Information</h5>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="university">university</label>
                        <input type="text" class="form-control" id="university" placeholder="Enter your university" name="uni">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="college">College</label>
                        <input type="text" class="form-control" id="college" placeholder="Enter your college" name="college">
                    </div>
                </div>
                 <button type="submit" class="btn btn-primary" name="submit">SUBMIT</button>
                
                </div>
            </form>
        </div>
    </section>
    
<!--    Footer-->
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
