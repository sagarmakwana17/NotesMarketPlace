<?php
session_start();
include"../includes/database.php";
 ob_start();

?>
<?php
if(!isset($_SESSION['user_id'])){
    
?>
<script>
    location.replace('../login.php');

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
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">



    <!--Custom CSS-->
    <link rel="stylesheet" href="css/dash.css">
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/preloader.css">



    <title>Manage Type</title>
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
                        <a class="navbar-brand float-left" href="#"><img src="../img/logo.png" class="img-fluid"></a>
                        <ul class="navbar-nav mr-auto mt-2 mt-lg-0 ml-auto">


                            <li class="nav-item"><a class="nav-link" href="<?php if(isset($user_id)){ echo 'dashboard.php?user_id='.$user_id;}else {echo 'dashboard.php';}?>">Dashboard</a></li>
                            <li class="nav-item note-dropdown">
                                <div class="dropdown show">
                                    <a class="note-dropdown" href="#" role="" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Notes
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="notes_under_review.php">Notes Under Review</a>

                                        <a class="dropdown-item" href="published_notes.php">Published Notes</a>
                                        <a class="dropdown-item" href="download_notes.php">Downloaded Notes</a>
                                        <a class="dropdown-item" href="rejected_notes.php">Rejected Notes</a>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="members.php">Members</a> </li>
                            <li class="nav-item"><a class="nav-link" href="spam_reports.php">Reports</a></li>
                             <li class="nav-item note-dropdown">
                             <div class="dropdown show">
                                    <a class="note-dropdown" href="#" role="" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                                      Settings
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="configuration.php">Configurations</a>

                                        <a class="dropdown-item" href="manage_administrator.php">Manage Administrator</a>
                                        <a class="dropdown-item" href="manage_category.php">Manage Category</a>
                                        <a class="dropdown-item" href="manage_type.php">Manage Types</a>
                                        <a class="dropdown-item" href="manage_country.php">Manage Countries</a>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item ">
                                <div class="dropdown show">
                                    <a class="" href="#" role="" id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <?php
                                       if(isset($profile)){
                                           
                                           ?>
                                        <img class="profile" src="<?php if(isset($profile)){ echo $profile; }?>" alt="">
                                        <?php
                                       }else{
                                          ?>

                                        <img class="profile" src="../img/images/user-l.jpg" alt="">
                                        <?php } ?>
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu">
                                        <a class="dropdown-item" href="my_profile.php">Update Profile</a>

                                        <a class="dropdown-item" href="change_password.php?<?php echo'user_id='.$user_id; ?>">Change Password</a>
                                        <a class="dropdown-item" href="../logout.php">Log out</a>
                                    </div>
                                </div>


                            </li>
                            <li class="nav-item"><a class="btn btn-primary" href="../logout.php" role="button">Log Out</a></li>

                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <style>
        #month {
            margin-bottom: 9px;
        }

        .form-control,
        .btn,
        #month {
            height: 40px;
        }

        .dropdown-menu {
            box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.1);
            border: none;
            width: 250px;
        }


        /*modal*/
        .title h4 {
            font-weight: 600;
            margin-left: 50px;
            margin-top: 20px;
        }

        .close {
            margin-top: 10px;
            margin-right: 10px;
        }

        .form-row {
            margin-left: 50px;
        }

        .modal .btn {
            margin-left: 50px;
            margin-bottom: 35px;
            width: 120px;
        }

        #progress-notes {
            margin-top: 100px;
        }

        .col-6 p {
            position: relative;
        }

        .form-inline {
            margin-top: 30px;
        }

        #admin {
            width: 150px;
            padding-top: 10px;
        }





        .modal-footer {
            border-color: #fff;
        }

    </style>
    <section id="progress-notes">
        <div class="content-box-lg">
            <div class="container">
                <div class="table-title row">
                    <div class="col-6">
                        <p>Manage Type</p>

                        <a class="btn btn-primary" href="add_type.php" role="button" style="" id="admin">ADD TYPE</a>
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
                            <th>SR.NO.</th>

                            <th>CATEGORY</th>
                            <th>DESCRIPTION</th>

                            <th>DATE ADDED</th>

                            <th>ADDED BY</th>

                            <th> ACTIVE</th>

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
                                 $query = "SELECT * FROM notetypes WHERE IsActive = 1 AND FirstName LIKE '{$search}%' OR LastName LIKE '{$search}%' ";
                             }
                            else{
                            $query = "SELECT * FROM notetypes WHERE IsActive = 1";
                            }
                        
                          $cat = mysqli_query($connection,$query);

                        if(!$cat){
                            die(mysqli_error($connection));
                        }
                          $total_records = mysqli_num_rows($cat); 
                         $total_pages = ceil($total_records / $num_per_page);
                        $i=1;
                        $k=  $num_per_page + $start_from;
                        $srno = 0;
                         $count = 0;
                        while($row = mysqli_fetch_assoc($cat)){
                            $srno++;
                            $id = $row['ID'];
                             $name = $row['Name'];
                             $des = $row['Description'];
                            $u = $row['CreatedBy'];
                            $user = "SELECT * FROM users WHERE ID = $u";
                            $u_query = mysqli_query($connection,$user);
                            if(!$u_query){
                                die(mysqli_error($connection));
                            }
                            $user_detail = mysqli_fetch_assoc($u_query);
                            $createdby =$user_detail['FirstName'].' '.$user_detail['LastName'];
                            
                            
                            $date = $row['CreatedDate'];
                            $isactive = $row['IsActive'];
                            if($isactive = 1){
                                $active = 'Yes';
                            }else{
                                $active = 'No';
                            }
                               
                          
                            if($start_from<$i){


                    ?>
                        <tr>
                            <td><?php echo $srno; ?></td>
                            <td><?php echo $name; ?></td>
                            <td><?php echo $des; ?></td>

                            <td><?php echo $date; ?></td>
                            <td><?php echo $createdby; ?></td>

                            <td><?php echo $active; ?></td>
                             <td>
                                <a class="" href="add_type.php?edit=<?php echo $id; ?>" >
                                    <div class="dots">
                                        <img src="../img/images/edit.png">
                                    </div>
                                </a>
                            </td>
                            <td>
                                <a class="" data-toggle="modal" data-target="#p<?php echo $srno; ?>">
                                    <div class="dots">
                                        <img src="../img/images/delete.png">
                                    </div>
                                </a>
                            </td>

                        </tr>
                        <!--modal for reject-->

                        <div class="modal fade" id="p<?php echo $srno; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="head">

                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <div class="title">
                                            <h4><?php echo $name;?></h4>
                                            <h4 style="font-size:16px; margin-top:20px;"> Are you sure you want to remove this type?</h4>
                                        </div>


                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCEL</button>
                                        <a class="btn btn-primary" href="remove_typephp?t_id=<?php echo $id ?>" role="button" style="margin-right:50px; background-color:red; " id="approved">YES</a>

                                    </div>


                                </div>
                            </div>
                        </div>





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
                <?php
                if($total_records==0){
                    echo" <p class='text-center' style= 'font-size:26px; margin-top : 20px; color:#6255a5; font-weight:600'>No Records Found !</p>";
                }
                ?>
                <nav aria-label="Page navigation example" id="pagination" style="margin-top : 20px;">
                    <ul class="pagination d-flex justify-content-center">
                        <li class="page-item  <?php if($page == 1){ echo 'disabled'; }?>">
                            <a class="page-link" href="dashboard.php?page=<?php echo $page-1; ?>" aria-label="Previous">
                                <span aria-hidden="true">&#60;</span>
                            </a>
                        </li>
                        <?php 
                            for($i=1;$i<=$total_pages;$i++){
                        ?>
                        <li class="page-item">
                            <a class="page-link <?php if($page == $i) { echo 'active'; }?>" href="dashboard.php?page=<?php echo $i ; ?>"><?php echo $i ;?></a>
                        </li>
                        <?php 
                            }
                        ?>




                        <li class="page-item <?php if($page == $total_pages){ echo 'disabled'; }?>">
                            <a class="page-link" href="dashboard.php?page=<?php echo $page-1; ?>" aria-label="Next">
                                <span aria-hidden="true">&#62;</span>
                            </a>
                        </li>
                    </ul>
                </nav>

            </div>
        </div>

    </section>

    <br><br><br><br>

    <footer>
        <div class="container">
            <div class="row">
                <!-- Copyright -->
                <div class="col-md-6 col-sm-8 foot-text text-left">
                    <p>Version 1.1.24</p>

                </div>
                <!-- Social Icon -->
                <div class="col-md-6 col-sm-4 foot-icon col-sm-4 text-right">
                    <p>Copyright &copy; TatvaSoft All Rights Reserved.</p>
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

    </style>










    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- JQUERY JS-->
    <script src="js/jquery-3.5.1.js"></script>
    <!--Bootstrap js-->
    <script src="js/bootstrap.min.js"></script>
    <!--Custom js-->
    <script src="js/script.js"></script>
    <script src="js/loader.js"></script>
</body>

</html>
