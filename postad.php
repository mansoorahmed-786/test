<?php
session_start();
include_once 'db.php';
if( !isset($_SESSION["usr_id"])){
    header("Location: login.php");
}

if(isset($_POST['new-ad']))
{

    $title = $con->real_escape_string(trim($_POST['title']));
    $desc = $con->real_escape_string(trim($_POST['description']));
    $category = $con->real_escape_string(trim($_POST['category']));
    $status = $con->real_escape_string(trim($_POST['status']));
    $price = $con->real_escape_string(trim($_POST['price']));
    if($status === "Active")
        $state = 1;
    else
        $state = 0;
    $file_name = $_FILES['img1']['name'];


    $location = $_FILES['img1']['tmp_name'];

    if (is_uploaded_file($location))
        move_uploaded_file($location, $file_name);



    $u_id = $_SESSION["usr_id"];
    $cat_id = $con->query("SELECT * FROM `olx`.`categories` WHERE name = '$category'");
    $cat_id = $cat_id->fetch_assoc()['id'];
    $query = $con->query("INSERT INTO `olx`.`ads` (user_id, title, description, price, category_id, status, picture_file_name, date_posted)
                                          values ('$u_id','$title','$desc','$price','$cat_id','$state','$file_name',current_timestamp())");


    if(!$query) {
        echo "Not posted";
    }
    else{
        header("location: home.php");
    }
    $con->close();
}


else{
    ?>
    <html>
    <head >
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

            </div>

        </div>

    </div>

    <div class="container">
        <div class="panel panel-success" style="background-color: whitesmoke">
            <div class="panel-heading" align="center">
                <h3>Modify your Add</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <form action="postad.php" method = "post" enctype="multipart/form-data">
                        <div class="col-lg-5" align="right">
                            <div align="center">
                                <h3> Title </h3>
                                <input type="text" name  = "title" class="form-control" required placeholder="Give title">
                                <h3 style="padding-top: 5px"> Description </h3><br/>
                                <textarea name  = "description" class="form-control" placeholder="Post Description" ></textarea>
                                <h3 style="padding-top: 5px"> Select Category </h3>
                                <?php

                                $query = $con->query("select * from `olx`.`categories`");
                                $count = $query->num_rows;
                                $result = $query->fetch_array();
                                echo "<form><select required name = \"category\" class=\"form-control\" >";
                                echo "<option value=''>Select Category</option>";
                                for($i = 1;$i<= $count; $i++){
                                    $temp = $con->query("select name from `olx`.`categories` where id = '$i'")->fetch_assoc()['name'];
                                    if(empty($temp)){
                                        $count++;
                                    }
                                    else{
                                        echo "<option >".$temp."</option>";
                                    }
                                }
                                echo "</select></form>";
                                ?>
                                <p style="padding-top: 5px"> Status </p><br/><br/>
                                <select name = "status" class="form-control">
                                    <option value="">Select Status of add</option>
                                    <option>Active</option>
                                    <option>Deactivate</option>
                                </select><br><br>
                                <p> Price </p><br/><br/><br>
                                <input type="number" name  = "price" class="form-control" required placeholder="Price of Product"><br/><br/><br>
                                <p style="padding-top: 5px"> Select Picture 1<br> <small>ad with picture sell faster</small></p><br>
                                <input type="file" name="img1" class=" btn btn-warning " required placeholder="Primary Image"><br>

                                <br/>
                                <button type="submit" class="btn btn-success" name = "new-ad">Post Ad</button>
                                <br><br>

                            </div>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
    </div>

    <script src="bootstrap/js/jquery-1.10.2.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    </body>
    </html>
<?php } ?>
