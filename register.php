<?php
session_start();

if(isset($_SESSION['usr_id'])) {
    header("Location: home.php");
}

include_once 'db.php';

//set validation error flag as false
$error = false;

//check if form is submitted
if (isset($_POST['signup'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $city = mysqli_real_escape_string($con, $_POST['city']);

    //name can contain only alpha characters and space
    if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
        $error = true;
        $name_error = "Name must contain only alphabets and space";
    }
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $email_error = "Please Enter Valid Email ID";
    }
    if(strlen($password) < 6) {
        $error = true;
        $password_error = "Password must be minimum of 6 characters";
    }
    if($password != $cpassword) {
        $error = true;
        $cpassword_error = "Password does't match";
    }

    if (!is_numeric($phone)){
        $error = true;
        $phone_error = 'Your Phone number can only be in numbers.';

    }


    if (!$error) {
        if(mysqli_query($con, "INSERT INTO `olx`.`users`(`name`,`email`,`password`,`mobile_number`,`city`) VALUES('$name', '$email', '$password', '$phone', '$city')")) {
            $successmsg = "Successfully Registered! <strong><a href='login.php'>Click here to Login</a></strong>";
            header("Location: login.php");
        } else {
            $errormsg = "Error in registering...Pleases try again later!";
        }
    }
}
?>

<!DOCTYPE html>
<html>
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
                <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="signupform">
                    <fieldset>
                        <legend>Sign Up</legend>

                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" name="name" placeholder="Enter Full Name" required value="<?php if($error) echo $name; ?>" class="form-control" />
                            <span class="text-danger"><?php if (isset($name_error)) echo $name_error; ?></span>
                        </div>

                        <div class="form-group">
                            <label for="name">Email address</label>
                            <input type="text" name="email" placeholder="Email" required value="<?php if($error) echo $email; ?>"  class="form-control" />
                            <span class="text-danger"><?php if (isset($email_error)) echo $email_error; ?></span>
                        </div>

                        <div class="form-group">
                            <label for="name">Password</label>
                            <input type="password" name="password" placeholder="Password" required class="form-control" />
                            <span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span>
                        </div>

                        <div class="form-group">
                            <label for="name">Retype Password</label>
                            <input class="form-control "type="password" name="cpassword" placeholder="Confirm Password" required class="form-control" />
                            <span class="text-danger"><?php if (isset($cpassword_error)) echo $cpassword_error; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="phone">Contact Number</label>
                            <i class="glyphicon glyphicon-phone"></i>
                            <input type="text" name="phone" placeholder="Add Phone Number" required value="<?php if($error) echo $phone; ?>" class="form-control" />
                            <span class="text-danger"><?php if (isset($phone_error)) echo $phone_error; ?></span>
                        </div>


                        <div class="form-group">
                            <label >Select city</label>
                            <select id="city" name="city" required >

                                <option value=””>Select City</option>

                                <option value=”Lahore”>Lahore</option>
                                <option value=”Karachi”>Karachi</option>
                                <option value=”islamabad”>Islamabad</option>
                                <option value=”Quetta”>Quetta</option>
                                <option value=”Peshawar”>Peshawar</option>

                            </select>

                        </div>

                        <div class="form-group" align="center">
                            <input align="center" type="submit" name="signup" value="Sign Up" class="btn btn-primary" />
                        </div>
                    </fieldset>
                </form>
                <span class="text-success"><?php if (isset($successmsg)) { echo $successmsg; } ?></span>
                <span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-md-offset-4 text-center">
                Already Registered? <a href="login.php">Login Here</a>
            </div>
        </div>
    </div>

    <footer>
<!---->
<!--        <div class="container-fluid">-->
<!--            <div class="row">-->
<!--                <div id="footer-container">-->
<!--                    <div class="col-lg-7 col-sm-7 col-lg-offset-2 margin-top-2">-->
<!--                        <img src="bootstrap/img/mobile.PNG" style="margin-top: 25px" class="img-responsive">-->
<!--                        <img src="bootstrap/img/apple.PNG" style="margin-top:-100px; margin-left: 300px " class="img-responsive">-->
<!--                        <img src="bootstrap/img/google.PNG" style="margin-top:-50px; margin-left: 480px " class="img-responsive">-->
<!--                        <img src="bootstrap/img/windows.PNG" style="margin-top:-50px; margin-left: 650px" class="img-responsive">-->
<!--                    </div>-->
<!--                </div>-->

<!---->
<!--            </div>-->
<!---->
<!---->
<!--        </div>-->
        <div class="container margin-top-2">
            <div class="row">
                <div class="col-lg-2" style="margin-left:50px">
                    <img style="margin-left:50px;margin-top:5px;height: 100px;width: 100px" src="bootstrap/img/olxlogo.jpeg" class="img-responsive">
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