<?php
 session_start();
include"includes/database.php";
?>
<?php
     
      $user_id = $_SESSION['user_id'];

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
    <link rel="stylesheet" href="css/dashboard1.css">
    <link rel="stylesheet" href="css/responsive1.css">





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


                            <li class="nav-item"><a class="nav-link" href="search_notes.html">Search Notes</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?php echo"add_notes.php?user=".$user_id; ?>">Sell Your Notes</a></li>
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
                                            <h2 class="title">100</h2>
                                            <p class="description">Number of Notes sold</p>
                                        </center>
                                    </div>
                                </div>
                                <div class="box">
                                    <div class="middle1">
                                        <center>
                                            <h2 class="title">$10,00,00</h2>
                                            <p class="description">Money Earned</p>
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="flex-wrapper d-flex justify-content-around flex-nowrap">
                                <div class="box-s">
                                    <div class="middle1">
                                        <center>
                                            <h2 class="title">38</h2>
                                            <p class="description">My Downloads</p>
                                        </center>
                                    </div>
                                </div>
                                <div class="box-s">
                                    <div class="middle1">
                                        <center>
                                            <h2 class="title">12</h2>
                                            <p class="description">My Rejected Notes</p>
                                        </center>
                                    </div>
                                </div>
                                <div class="box-s">
                                    <div class="middle1">
                                        <center>
                                            <h2 class="title">112</h2>
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
                        $query = "SELECT s.* , r.*,t.*,c.* FROM sellernotes AS s JOIN referencedata AS r ON s.ID = r.ID JOIN notetypes AS t ON r.ID = t.ID JOIN notecategories AS c ON t.ID = c.ID  WHERE s.SellerID = '{$user_id}'";
                        
                        
                        
                        $get_table_data = mysqli_query($connection,$query);
                        if(!$get_table_data){
                            die("FAILED".mysqli_error($connection));
                        }
                        
                        while($row = mysqli_fetch_assoc($get_table_data)){
                            $date = $row['CreatedDate'];
                            $title= $row['Title'];
                            $cat  = $row['Name'];
                            $status = $row['RefCategory'];
                            
                            
                            if($status == 'draft'){
                            
                            
                    ?>
                        <tr>
                            <td><?php  echo $date;   ?></td>
                            <td><?php  echo $title;   ?></td>
                            <td><?php  echo $cat;   ?></td>
                            <td><?php  echo $status;   ?></td>

                            <td>
                                <img src="img/Dashboard/edit.png">
                                <img src="img/Dashboard/eye.png">
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

                                <img src="img/Dashboard/eye.png">
                            </td>

                        </tr>

                    <?php
                            }
                        }


                        ?>


                        <tr>
                            <td>09-10-20</td>
                            <td>Data science</td>
                            <td>Science</td>
                            <td>Draft</td>

                            <td>
                                <img src="img/Dashboard/edit.png">
                                <img src="img/Dashboard/eye.png">
                            </td>

                        </tr>
                        <tr>
                            <td>10-10-20</td>
                            <td>Accounts</td>
                            <td>Commerce</td>
                            <td>In review</td>
                            <td>

                                <img src="img/Dashboard/eye.png">
                            </td>

                        </tr>
                        <tr>
                            <td>11-10-20</td>
                            <td>Social studies</td>
                            <td>Social</td>
                            <td>Submitted</td>

                            <td>
                                <img src="img/Dashboard/eye.png">
                            </td>

                        </tr>
                        <tr>
                            <td>12-10-20</td>
                            <td>AI</td>
                            <td>IT</td>
                            <td>Submitted</td>

                            <td>
                                <img src="img/Dashboard/eye.png">
                            </td>

                        </tr>
                        <tr>
                            <td>13-10-20</td>
                            <td>Data science</td>
                            <td>Science</td>
                            <td>Draft</td>

                            <td>
                                <img src="img/Dashboard/edit.png">
                                <img src="img/Dashboard/eye.png">
                            </td>

                        </tr>
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
                        $query = "SELECT s.* , r.*,t.*,c.* FROM sellernotes AS s JOIN referencedata AS r ON s.ID = r.ID JOIN notetypes AS t ON r.ID = t.ID JOIN notecategories AS c ON t.ID = c.ID  WHERE s.SellerID = '{$user_id}' AND r.RefCategory = 'published'";
                        
                        
                        
                        $get_table_data = mysqli_query($connection,$query);
                        if(!$get_table_data){
                            die("FAILED".mysqli_error($connection));
                        }
                        
                        while($row = mysqli_fetch_assoc($get_table_data)){
                            $date = $row['CreatedDate'];
                            $title= $row['Title'];
                            $cat  = $row['Name'];
                            $status = $row['RefCategory'];
                            $sell_type = $row['IsPaid'];
                            $price = $row['SellingPrice'];
                            
                            
                            
                            
                            
                    ?>
                        <tr>
                            <td><?php  echo $date;   ?></td>
                            <td><?php  echo $title;   ?></td>
                            <td><?php  echo $cat;   ?></td>
                            
                            <td><?php  echo $sell_type;  ?></td>
                            <td><?php  echo $sell_type;  ?></td>
                            <td>$<?php  echo $$price;  ?></td>
                            
                            <td>
                                
                                <img src="img/Dashboard/eye.png">
                            </td>

                        </tr>


                        <?php   
                                
                            }
                    ?>


                    
                        <tr>
                            <td>09-10-20</td>
                            <td>Data science</td>
                            <td>Science</td>
                            <td>paid</td>
                            <td>$567</td>

                            <td>
                                <img src="img/Dashboard/eye.png">
                            </td>

                        </tr>
                        <tr>
                            <td>10-10-20</td>
                            <td>Accounts</td>
                            <td>Commerce</td>
                            <td>free</td>
                            <td>$0</td>

                            <td>

                                <img src="img/Dashboard/eye.png">
                            </td>

                        </tr>
                        <tr>
                            <td>11-10-20</td>
                            <td>Social studies</td>
                            <td>Social</td>
                            <td>free</td>
                            <td>$0</td>
                            <td>
                                <img src="img/Dashboard/eye.png">
                            </td>

                        </tr>
                        <tr>
                            <td>12-10-20</td>
                            <td>AI</td>
                            <td>IT</td>
                            <td>paid</td>
                            <td>$3542</td>
                            <td>
                                <img src="img/Dashboard/eye.png">
                            </td>

                        </tr>
                        <tr>
                            <td>13-10-20</td>
                            <td>Data science</td>
                            <td>Science</td>
                            <td>free</td>
                            <td>$0</td>
                            <td>

                                <img src="img/Dashboard/eye.png">
                            </td>

                        </tr>
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



    <footer class="footer1">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p>Copyright &copy; Tatvasoft All Rights reserved<span><a href=""><i class="fa fa-facebook"> </i></a><a href=""><i class="fa fa-twitter"> </i></a><a href=""><i class="fa ">in</i></a></span></p>
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
