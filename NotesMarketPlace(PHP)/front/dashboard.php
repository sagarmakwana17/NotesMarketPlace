
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
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/responsive.css">



    <title>Dashboard</title>
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
            </nav>
        </div>
    </header>


    <section id="dashboard">
        <div class="container">
            <p id="heading">Dashboard</p>
            <a class="btn btn-primary" href="" role="button" id="addnote">ADD NOTE</a>
            <div id="table-container">
                <div class="row">

                <table id="t1" class="col-md-6">
                    <tr>
                        <td id="td1" class="">
                            <center>
                                <img src="img/images/earning-icon.svg" alt="">
                                <p>My Earning</p>
                            </center>
                        </td>
                        <td id="td2">
                            <center>
                                <h2 class="title">100</h2>
                                <p class="description">Number of Notes sold</p>
                            </center>
                        </td>
                        <td id="td3">
                            <center>
                                <h2 class="title">$10,00,00</h2>
                                <p class="description">Money Earned</p>
                            </center>
                        </td>
                    </tr>
                </table>
                <div id="right" class="col-md-6">
                    <div class="cell">
                        <center>
                            <h2 class="title">38</h2>
                            <p class="description">My Downloads</p>
                        </center>
                    </div>
                    <div class="cell">
                        <center>
                            <h2 class="title">12</h2>
                            <p class="description">My Rejected Notes</p>
                        </center>
                    </div>
                    <div class="cell">
                        <center>
                            <h2 class="title">112</h2>
                            <p class="description">Buyer Requests</p>
                        </center>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </section>
    <section id="progress-notes">
        <div class="content-box-lg">
           <div class="container">
            <div class="table-title">
                <p>In Progress Notes</p>
                <div id="search">
                    <input type="text" placeholder="search" class="search-input">
                    <a class="btn btn-primary search-btn" href="" role="button">SEARCH</a>
                </div>
            </div>
            <table class="progres .table-responsive">
                <tr>
                    <th>ADDED DATE</th>
                    <th>TITLE</th>
                    <th>CATEGORY</th>

                    <th>PRICE</th>
                    <th>ACTIONS</th>
                </tr>
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
            <div class="table-title">
                <p>Published Notes</p>
                <div id="search">
                    <input type="text" placeholder="search" class="search-input">
                    <a class="btn btn-primary search-btn" href="" role="button">SEARCH</a>
                </div>
            </div>
            <table class="progres ">
                <tr>
                    <th>ADDED DATE</th>
                    <th>TITLE</th>
                    <th>CATEGORY</th>
                    <th>SELL TYPE</th>
                    <th>PRICE</th>
                    <th>ACTIONS</th>
                </tr>
                <tr>
                    <td>09-10-20</td>
                    <td>Data science</td>
                    <td>Science</td>
                    <td>Draft</td>
                    <td>$567</td>

                    <td>
                        <img src="img/Dashboard/eye.png">
                    </td>

                </tr>
                <tr>
                    <td>10-10-20</td>
                    <td>Accounts</td>
                    <td>Commerce</td>
                    <td>In review</td>
                    <td>$0</td>

                    <td>

                        <img src="img/Dashboard/eye.png">
                    </td>

                </tr>
                <tr>
                    <td>11-10-20</td>
                    <td>Social studies</td>
                    <td>Social</td>
                    <td>Submitted</td>
                    <td>$0</td>
                    <td>
                        <img src="img/Dashboard/eye.png">
                    </td>

                </tr>
                <tr>
                    <td>12-10-20</td>
                    <td>AI</td>
                    <td>IT</td>
                    <td>Submitted</td>
                    <td>$3542</td>
                    <td>
                        <img src="img/Dashboard/eye.png">
                    </td>

                </tr>
                <tr>
                    <td>13-10-20</td>
                    <td>Data science</td>
                    <td>Science</td>
                    <td>Draft</td>
                    <td>$0</td>
                    <td>

                        <img src="img/Dashboard/eye.png">
                    </td>

                </tr>
            </table>
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
