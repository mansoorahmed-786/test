<?php
session_start();

if(isset($_SESSION['usr_id'])!="") {
    header("Location: home.php");
}

include_once 'db.php';

//check if form is submitted
if (isset($_POST['login'])) {

    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $result = mysqli_query($con, "SELECT * FROM `olx`.`users` WHERE `email` = '$email' and `password` = '$password'");

    if ($row = mysqli_fetch_array($result)) {
        echo "okay";
        $_SESSION['usr_id'] = $row['id'];
        $_SESSION['usr_name'] = $row['name'];
        header("Location: home.php");
    } else {

        echo "not okay";
        $errormsg = "Incorrect Email or Password!!!";
    }
}
?>

<!DOCTYPE html>

<head xmlns="http://www.w3.org/1999/html">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Free classifieds in Pakistan, classified ads in Pakistan (For Sale in Pakistan, Vehicles in Pakistan, Real
        Estate in Pakistan, Community in Pakistan,...</title>
    <link rel="icon" type="image/x-icon" href="bootstrap/img/olxlogo.jpeg">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="bootstrap/css/styles.css">
    <link rel="stylesheet" href="bootstrap/font-awesome/css/font-awesome.min.css" media="all">


    <script src="bootstrap/jquery/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body>


<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-1">
                <a href="./">
                    <img src="bootstrap/img/olxlogo.jpeg"style="height: 70px;width: 70px;margin-left: 150px; " >
                </a>
            </div>
            <div class="col-lg-5">
                <h4 class="margin-top-10" style="margin-left: 35%;">Pakistan's Largest Marketplace</h4>
            </div>

            <div class="col-lg-2  margin-top-4">
                <a class="link" href="login.php"style="margin-left: 50%;height: 30px">
                    <i class="glyphicon glyphicon-user glyphicon-25"></i>
                    <h4 class="clr-change inline">My Account</h4>
                </a>
            </div>

            <div class="col-lg-2 margin-top-2"style="margin-left: 0%">
                <a href="ads.php"> <button  class="btn custom-btn custom-btn-orange white" style="padding: 7px 18px 7px 18px;float: right;">
                        <h5>Submit an Add</h5></button></a>
            </div>

        </div>

    </div>

</div>


<div class="container" style="margin-top: 70px">
    <div class="row">
        <div class="col-md-4 col-md-offset-4 well">
            <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="loginform">
                <fieldset>
                    <legend>Login</legend>

                    <div class="form-group">
                        <label for="name">Email</label>
                        <input type="text" name="email" placeholder="Enter email address here" required class="form-control" />
                    </div>

                    <div class="form-group">
                        <label for="name">Password</label>
                        <input type="password" name="password" placeholder=" Password" required class="form-control" />
                    </div>

                    <div class="form-group " align="center">
                        <input  align="center" type="submit" name="login" value="Login" class="btn btn-primary" />
                    </div>
                </fieldset>
            </form>
            <span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-4 well">
            <fieldset>
                <legend>Login with your facebook account</legend>

                <div class="form-group " align="center">
                    <input  align="center" type="submit" name="fb" value="Facebook" class="btn btn-primary" />
                </div>

            </fieldset>

        </div>


    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-4 text-center">
            New User? <a href="register.php">Sign Up Here</a>
        </div>
    </div>
</div>



<footer>


    <div class="col-lg-12 col-sm-12  margin-top-2">
        <img src="bootstrap/img/footer.png"style="margin-top: -60px;margin-bottom: 20px" class="img-responsive">
    </div>
    <div class="container margin-top-2">
        <div class="row">
            <div class="col-lg-2" style="margin-left:50px;">
                <img style="margin-left:50px;margin-top:5px;height: 100px" src="bootstrap/img/olxlogo.jpeg"class="img-responsive">
            </div>
            <div class="col-lg-2">
                <ul class="list-unstyled">
                    <li><a class="clr-change black" href="#" >Locations Map</a></li>
                    <li><a class="clr-change black" href="#" >Popular Searches</a></li>
                    <li><a class="clr-change black" href="#" >Archives</a></li>
                    <li><a class="clr-change black" href="#" >Sitemap</a></li>
                </ul>
            </div>
            <div class="col-lg-2">
                <ul class="list-unstyled">
                    <li><a class="clr-change black" href="#" >Terms of Use</a></li>
                    <li><a class="clr-change black" href="#" >Help & Contact Us</a></li>
                </ul>
            </div>
            <div class="col-lg-2">
                <ul class="list-unstyled">
                    <li><a class="clr-change black" href="#" >Who we are</a><i class="fa fa-caret-down"></i></li>
                    <li><a class="clr-change black" href="#" >Join Olx</a></li>
                    <li><a class="clr-change black" href="#" >Happy Olexrs</a></li>
                </ul>
            </div>
            <div class="col-lg-2">
                <ul class="list-unstyled">
                    <li><a style="color: black"> Connect with us </a></li>
                </ul>
            </div>

        </div>
    </div>

</footer>



<script src="bootstrap/js/jquery-1.10.2.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
