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
                <li class="nav-item active" id="active">
                    <a id="navlink" class="nav-link" href="#">Request Oxygen</a>
                </li>
                <li class="nav-item">
                    <a id="navlink" class="nav-link" href="../supplyOxygen/">Supply Oxygen</a>
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


    <div class="row" style="margin-top: 68px;">

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
                    echo '<h2 style="margin:30vh auto;">Please Login to Send and view your Requests.</h2>';
                } else {
                    echo '
                    <div class="calendar col-lg-7">
                    <div class="calendar-layout" id="calendar-body">
                        <h2>Request Oxygen Supply</h2>
                        <div id="requestFormStatus"></div>
                        <form name="requestform" onsubmit="return requestOxygen()" style="width:100%;">
                            <label for="Name">Name :</label>
                            <input type="text" class="form-control" id="name" name="name">
                            <label for="address">Delivery Address :</label>
                            <input type="textarea" class="form-control" id="address" name="address">
                            <label for="phone">Contact Number :</label>
                            <input type="number" class="form-control" id="phone" name="phone">
                            <label for="volume">Quantity in Litres :</label>
                            <input type="number" class="form-control" id="volume" name="volume">
                            <label for="deadline">Deadline :</label>
                            <input type="date" class="form-control" id="date" name="date">
                            <button type="submit" class="btn btn-primary">Send Request</button>
                        </form>
                    </div>

                </div>
                <div class="events col-lg-5">
                    <h2>Sent Requests</h2>
                    <ul class="events-list" id="sentRequestList">
                    </ul>
                    <h3>Accepted Requests</h3>
                    <ul class="events-list" id="acceptedRequestList">
                    </ul>

                </div>
                            ';
                }
                ?>
                
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
    <script src="script.js"></script>

</body>

</html>