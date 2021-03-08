
<?php
ob_start();
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
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/responsive.css">




    <title>Home</title>
</head>

<body>


    <section id="user-section">
        <header>
            <div class="container">
                <nav class="navbar navbar-fixed-top white-nav-top">
                    <div class="container-fluid">
                        <div class="site-nav-wrapper">
                            <div class="navbar-header">
                            <!-- mobile menu-->

                            <div class="dropdown"><a href="" class="dropdown-toggle" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span id="mobile-nav-open-btn">&#9776;</span>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="#">Search Notes</a><br>
                                    <a class="dropdown-item" href="#">Sell Your Notes</a><br>
                                    <a class="dropdown-item" href="#">Buyer Requests</a><br>
                                    <a class="dropdown-item" href="#">FAQ</a><br>
                                    <a class="dropdown-item" href="#">Contact Us</a><br>
                                    <a class="dropdown-item" href="#">My Profile</a><br>
                                    <a class="dropdown-item" href="#">Log Out</a>
                                </div>
                            </div>

                            <a href="#" class="navbar-brand">
                                <img src="img/logo.png">
                            </a>
                        </div>
                            <div class="container">
                                <div class="collapse navbar-collapse">
                                    <ul class="nav navbar-nav pull-right">
                                        <li><a href="search_notes.html">Search Notes</a></li>
                                        <li><a href="add_notes.html">Sell Your Notes</a></li>

                                        <li><a href="FAQ.html">FAQ</a></li>
                                        <li><a href="contact_us.html">Contact Us</a></li>

                                        <li><a class="btn btn-primary" href="" role="button" id="nav-btn">Log Out</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </header>
        <div class="content-box-lg">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div id="user_profile">

                            <h4>Download Free/Paid Notes<br>or Sale your Book</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam adipis<br> consectetur accusamus qui praesentium ipsa, corporis ipsum sequi of!</p>
                            <a class="btn btn-primary" href="" role="button" id="learn_more">LEARN MORE</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="about">
        <div class="content-box-md">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h2>About<br>NotesMarketPlace</h2>
                    </div>
                    <div class="col-md-6">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. At corrupti impedit expedita qui est voluptate et, harum iure recusandae sed dicta quasi incidunt eaque, necessitatibus, voluptatem ab. Quas, ullam voluptatum.</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sed magnam inventore vitae voluptatem, quisquam praesentium possimus ipsam nulla enim dolore quo debitis dignissimos ex consectetur quis minima cum aut illo.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="work">
        <div class="content-box-md">
            <div class="container">
                <div class="row text-center">
                    <div class="col-md-12">
                        <h2>How it Works</h2>
                    </div>
                </div>
                <div class="row">
                    <div id="left">
                        <div class="col-md-6 text-center">
                            <img src="img/home/download.png">
                            <p>Download Free/Paid Notes</p>
                            <h6>get material for your<br>cource etc.</h6>
                            <a class="btn btn-primary" href="" role="button" id="download">DOWNLOAD</a>
                        </div>
                    </div>
                    <div id="left">
                        <div class="col-md-6 text-center">
                            <img src="img/home/seller.png">
                            <p>Seller</p>
                            <h6>Upload and Download<br>Cource and materials etc.</h6>
                            <a class="btn btn-primary" href="" role="button" id="sellnow">SELL NOW</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="customers">
        <div class="content-box-md">
            <div class="container">
                <div class="row text-center">
                    <div class="col-md-12">
                        <h2>What Our Customers are Saying</h2>
                    </div>
                </div>
                <div class="row">
                    <div id="left">
                        <div class="col-md-6 ">
                            <div class="row main-info" id="main">

                                <img src="img/home/testimonial/client-1.jpg">
                                <p>"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iure eos quaerat iste perferendis eaque in est, necessitatibus ipsa dolorem aspernatur dicta, impedit tempore inventore enim at quis tempora, explicabo ad."</p>

                            </div>
                            <div class="basic-info">
                                <p>Walter Meller</p>
                                <h6>Founder and CEO. Matrix Group.</h6>
                            </div>

                        </div>
                    </div>
                    <div id="left">
                        <div class="col-md-6">
                             <div class="row main-info" id="main">

                                <img src="img/home/testimonial/client-2.jpg">
                                <p>"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iure eos quaerat iste perferendis eaque in est, necessitatibus ipsa dolorem aspernatur dicta, impedit tempore inventore enim at quis tempora, explicabo ad."</p>

                            </div>
                            <div class="basic-info">
                                <p>Daniel Cardos</p>
                                <h6>Founder and CEO. Matrix Group.</h6>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div id="left">
                        <div class="col-md-6 ">

                            <div class="row main-info" id="main">

                                <img src="img/home/testimonial/client-3.jpg">
                                <p>"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iure eos quaerat iste perferendis eaque in est, necessitatibus ipsa dolorem aspernatur dicta, impedit tempore inventore enim at quis tempora, explicabo ad."</p>

                            </div>
                            <div class="basic-info">
                                <p>Jonie Rylie</p>
                                <h6>Founder and CEO. Matrix Group.</h6>
                            </div>

                        </div>
                    </div>
                    <div id="left">
                        <div class="col-md-6">
                             <div class="row main-info" id="main">

                                <img src="img/home/testimonial/client-1.jpg">
                                <p>"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iure eos quaerat iste perferendis eaque in est, necessitatibus ipsa dolorem aspernatur dicta, impedit tempore inventore enim at quis tempora, explicabo ad."</p>

                            </div>
                            <div class="basic-info">
                                <p>Walter Meller</p>
                                <h6>Founder and CEO. Matrix Group.</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>










    <footer class="footer1">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p>Copyright &copy; Tatvasoft All Rights reserved<span><a href=""><i class="fa fa-facebook"> </i></a><a href=""><i class="fa fa-twitter"> </i></a><a href=""><i class="fa">in</i></a></span></p>
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
