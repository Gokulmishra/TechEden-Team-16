<?php
session_start();


?>
<html>

<head>
    <title>Boss Buddy</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/e09a89de7b.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="main.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Raleway&display=swap" rel="stylesheet">
    <link rel="icon" href="../images/logo.png">
</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top navbar-light">
        <a class="navbar-brand" href="../">
            <img src="../images/logo.png" width="40" height="40" class="d-inline-block align-top" alt="">
            <span class="brand">Oxygen <span>Delivery</span></span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item ">
                    <a id="navlink" class="nav-link" href="../">Home</a>
                </li>
                <li class="nav-item " >
                    <a id="navlink" class="nav-link" href="../needOxygen/">Request Oxygen</a>
                </li>
                <li class="nav-item active" id="active">
                    <a id="navlink" class="nav-link" href="#">Supply Oxygen</a>
                </li>
                <li class="nav-item">
                    <a id="navlink" class="nav-link" href="../deliveryAgent/">Delivery Agent</a>
                </li>

            </ul>
            <div class="form-inline my-2 my-lg-0">
                <?php
                if (!isset($_SESSION['logged'])) {
                    echo '
                        <a type="button" id="navlink" class="nav-link" data-toggle="modal" data-target="#LoginModal">Login</a>
                        <a type="button" id="navlink" class="nav-link" data-toggle="modal" data-target="#SignupModal">Sign Up</a>';
                } else {
                    echo '<a id="navlink" class="nav-link" href="#">' . $_SESSION['logged'] . '</a>
                    <a id="navlink" class="nav-link" href="../php/logout.php">Logout</a>';
                }
                ?>
            </div>
        </div>
    </nav>


    <div class="row">
    <nav id="navbarSupportedContent" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <div class="sidebar-sticky pt-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">
                            Oxygen Requests
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="acceptedRequests.php">
                           Accepted Requests
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="transportationStatus.php">
                            Transportation Status
                        </a>
                    </li>
                </ul><hr>
            </div>
        </nav>
    <div id="maincontainer" class="col-md-9 ml-sm-auto col-lg-10" style="width: 100%;padding-right:0;">
        <div id="tooltip">
            <?php
            if (isset($_SESSION['error'])) {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">'
                    . $_SESSION['error'] .
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
                unset($_SESSION['error']);
            }
            if (isset($_SESSION['success'])) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">'
                    . $_SESSION['success'] .
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
                unset($_SESSION['success']);
            }
            ?>
        </div>
        <div class="container-fluid row" style="margin: 0;">
            <div class="app row">

               


                <?php
                if (!isset($_SESSION['logged'])) {
                    echo '<h2 style="margin:30vh auto;">Please Login to view and accept requests.';
                } else {
                    echo '
                    <div class="calendar col-lg-7" >
                <div class="calendar-layout" id="calendar-body">
                            <h2 id="monthAndYear"></h2>
                        </div>
                        <div>
                            <div class="form-inline" style="width: 100%;margin:5px 20px;">

                                <button class="btn btn-primary col-sm-3" id="previous" onclick="previous()" style="margin: 0 15px 0 auto;">Previous</button>

                                <button class="btn btn-primary col-sm-3" id="next" onclick="next()" style="margin: 0 auto 0 15px; ">Next</button>
                            </div>
                            <form class="form-inline" style="margin: 0 auto; width:100%;">
                                <label class="lead mr-2 ml-2" for="month">Jump To: </label>
                                <select class="form-control col-sm-4" name="month" id="month" onchange="jump()">
                                    <option value=0>Jan</option>
                                    <option value=1>Feb</option>
                                    <option value=2>Mar</option>
                                    <option value=3>Apr</option>
                                    <option value=4>May</option>
                                    <option value=5>Jun</option>
                                    <option value=6>Jul</option>
                                    <option value=7>Aug</option>
                                    <option value=8>Sep</option>
                                    <option value=9>Oct</option>
                                    <option value=10>Nov</option>
                                    <option value=11>Dec</option>
                                </select>


                                <label for="year"></label><select class="form-control col-sm-4" name="year" id="year" onchange="jump()">
                                    <option value=1990>1990</option>
                                    <option value=1991>1991</option>
                                    <option value=1992>1992</option>
                                    <option value=1993>1993</option>
                                    <option value=1994>1994</option>
                                    <option value=1995>1995</option>
                                    <option value=1996>1996</option>
                                    <option value=1997>1997</option>
                                    <option value=1998>1998</option>
                                    <option value=1999>1999</option>
                                    <option value=2000>2000</option>
                                    <option value=2001>2001</option>
                                    <option value=2002>2002</option>
                                    <option value=2003>2003</option>
                                    <option value=2004>2004</option>
                                    <option value=2005>2005</option>
                                    <option value=2006>2006</option>
                                    <option value=2007>2007</option>
                                    <option value=2008>2008</option>
                                    <option value=2009>2009</option>
                                    <option value=2010>2010</option>
                                    <option value=2011>2011</option>
                                    <option value=2012>2012</option>
                                    <option value=2013>2013</option>
                                    <option value=2014>2014</option>
                                    <option value=2015>2015</option>
                                    <option value=2016>2016</option>
                                    <option value=2017>2017</option>
                                    <option value=2018>2018</option>
                                    <option value=2019>2019</option>
                                    <option value=2020>2020</option>
                                    <option value=2021>2021</option>
                                    <option value=2022>2022</option>
                                    <option value=2023>2023</option>
                                    <option value=2024>2024</option>
                                    <option value=2025>2025</option>
                                    <option value=2026>2026</option>
                                    <option value=2027>2027</option>
                                    <option value=2028>2028</option>
                                    <option value=2029>2029</option>
                                    <option value=2030>2030</option>
                                </select>
                            </form>
                        </div>

                </div>
                <div class="events col-lg-5">
                    <h2 id="evedate"></h2><hr>
                    <h4 style="margin: 0;">Pending Requests</h4>
                    <label for="distance">Within Radius :</label>
                    <select name="distance" id="distance">
                <option value="10">10 Km</option>
                <option value="50">50 Km</option>
                <option value="100">100 Km</option>
                <option value="500">500 Km</option>
                <option value="1000">1000 Km</option>
            </select>
                    <div id="acceptRequestStatus"></div>
                    <ul class="events-list" id="currentRequestList">
                    
                    </ul>
                   
                </div>
                            ';
                }
                ?>
                
                
            </div>
            




        </div>
    </div>
    </div>

    <!--Login Modal -->
    <div class="modal fade" id="LoginModal" tabindex="-1" aria-labelledby="LoginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body modalbody">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3>Login</h3>
                    <div id="message1"></div>
                    <form onsubmit="return login();" id="loginform">
                        <div id="msg"></div>
                        <label for="Username">Username</label>
                        <input class="form-control" type="text" name="username">
                        <label for="Password">Password</label>
                        <input type="password" class="form-control" name="password">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!--Signup Modal -->
    <div class="modal fade" id="SignupModal" tabindex="-1" aria-labelledby="SignupModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body modalbody">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3>Sign Up</h3>
                    <div name="signupform">


                        <div id="message">

                        </div>
                        <form onsubmit="return signup();" id="signupform">

                            <label for="username">Username:</label>
                            <input type="text" class="form-control" id="username" name="username">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" name="email">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" name="password">
                            <label for="confpass">Confirm Password:</label>
                            <input type="password" class="form-control" name="confpass">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Sign Up</button>
                            </div>
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <script src="../js/main.js"></script>
    <script src="../js/jquery-1.11.3.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="scripts.js"></script>

</body>

</html>