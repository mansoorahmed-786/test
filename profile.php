<?php
session_start();

include "db.php";
if(!isset($_SESSION['usr_id']))
{
    header("Location: login.php");
}
$ses_id = $_SESSION["usr_id"];
$data = $con->query("SELECT * from `olx`.`users` WHERE id = '$ses_id'");
$temp = $data->fetch_array();

if(isset($_POST['update'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $mob = $_POST['phone'];
    $city = $_POST['city'];

    $result = $con->query("UPDATE `olx`.`users` set name = '$name',email = '$email',password = '$password', city = '$city',mobile_number = '$mob'
                                WHERE id = '$ses_id'");

    if ($result) {

        ?>
        <div class="alert alert-warning">
            <h3>Your Profile has been updated successfully.</h3><br><br>
            <?= session_destroy(); ?>
            <a href="login.php">Click here to Login</a>
        </div>
        <?php
    } else {
        ?>
        <div class="alert alert-warning">
            <h3>Profile Can't be update due to some error.</h3><br><br>
            <button class="btn btn-default"><a href="profile.php">Try Again</a></button>
            <button class="btn btn-default"><a href="home.php">Go back to Dashboard</a></button>

        </div>
        <?php
    }
}

else{
    ?>
    <html>
    <body>
    <div class="container">
        <div class="panel panel-success" style="background-color: whitesmoke">
            <div class="panel-heading" align="center">
                <h3>Update Your Profile Information</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <form action="profile.php" method = "post" enctype="application/x-www-form-urlencoded">
                       <!-- <div class="col-lg-4">
                            <div align="center">
                                <p> Name  </p><br/><br/>
                                <p> Email  </p><br/><br/>
                                <p> Password  </p><br/><br/><br/>
                                <p> Mobile # </p><br/><br/>
                                <p> City </p><br/><br/>

                            </div>-->
                        <div class="col-lg-5" align="center">

                            <input type="text" name = "name" class="form-control" value="<?php echo $temp['name']; ?>">Enter Your Name<br/><br/>
                            <input type="email" name  = "email" class="form-control" value="<?php echo $temp['email']; ?>">Enter valid email<br/><br/>
                            <input type="password" name  = "pass" class="form-control" value="<?php echo $temp['password']; ?>">choose password<br/><br/>
                            <input type="text" name  = "mobile" class="form-control" value="<?php echo $temp['phone']; ?>">Enter Your Mobile number<br/><br/>

                            <select class="form-control" name = "city" data-value="<?php echo $temp['city'];?>">

                                <option>Lahore</option>
                                <option>Karachi</option>
                                <option>Islamabad</>
                                <option>Faisalabad</option>
                                <option>Multan</option>
                                <option>Peshawar</option>
                            </select>
                            <div align="center">
                                <br/>
                                <button type="submit" class="btn btn-success" name = "update">Update</button>
                            </div>
                        </div>
                        <div class="col-lg-3">

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </body>
    </html>
<?php } ?>