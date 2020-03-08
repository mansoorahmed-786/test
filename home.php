<?php
session_start();
include_once 'db.php';
?>

<!DOCTYPE HTML>
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

<div class="container well well-lg">
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
                <a class="link" href="profile.php"style="margin-left: 50%;height: 30px">
                    <i class="glyphicon glyphicon-user glyphicon-25"></i>
                    <h4 class="clr-change inline">My Account</h4>
                </a>
            </div>

            <div class="col-lg-2 margin-top-2"style="margin-left: 0%">
                <a href="postad.php"> <button  class="btn custom-btn custom-btn-orange white" style="padding: 7px 18px 7px 18px;float: right;">
                        <h5>Submit an Add</h5></button></a>
            </div>

            <div class="col-lg-2 margin-top-2">
                <a class="link" href="logout.php">
                    <button class="btn btn-danger btn-block" style="padding: 7px 18px 7px 18px;float: right; margin-right:-1px">
                        <h4 style="color: white;">Logout</h4>
                    </button>
                </a>


            </div>


        </div>

    </div>

</div>

<?php


if(!isset($_SESSION["usr_id"])){
    header("Location: login.php");
}

$ses_id = $_SESSION["usr_id"];
echo $ses_id;
//include "home.php";

?>
<!DOCTYPE HTML>
<html>

<body>
<div class="row">
    <div class="col-lg-2">
        <?php
        if($ses_id == 1){ ?>
            <div class="nav navbar-brand">
                <ul class="nav navbar-left">
                    <li><a href="add-category.php"> <button style="width: 170px" class="btn btn-info btn-block" >Add Category</button></a></li>
                    <li><a href="delete-category.php"> <button style="width: 170px" class="btn btn-block btn-warnings"  >Delete Category</button></a></li>

                </ul>
            </div>
        <?php }
        ?>
    </div>
    <div class="col-lg-10">
        <?php
        $page_size = 10;
        $page = 1;
        $offset = 0;

        if(isset($_GET['page'])){
            $page = $_GET['page'];
            if($page == " " || $page == 1){
                $offset = 0;
            }
            else{
                $offset = ($page * $page_size) - $page_size;
            }
        }
        $result = $con->query("select * from `olx`.`ads` WHERE `user_id` = '$ses_id' ORDER BY `date_posted` DESC limit $offset,$page_size");
        $total_ads =  $result->num_rows;
        if($total_ads > 0){
            ?>
            <div class="row" align="center" style="color: grey;">
                <div class="col-lg-2">
                    <h3 class="page-header">Picture</h3>
                </div>
                <div class="col-lg-2">
                    <h3 class="page-header">Title</h3>
                </div>
                <div class="col-lg-4">
                    <h3 class="page-header">Description</h3>
                </div>
                <div class="col-lg-2">
                    <h3 class="page-header">Price</h3>
                </div>
                <div class="col-lg-2">
                    <h3 class="page-header">Status</h3>
                </div>
            </div>
            <?php while($row = $result->fetch_assoc()){
                if($row['status'] == 1){
                    $status = "Activated";
                }
                else{
                    $status = "Deactivated";
                }
                ?>
                <div class="row" align="center">
                    <div class="col-lg-2">
                        <img src="<?= $row['picture_file_name'] ?>" width="150px" height="150px">
                    </div>
                    <div class="col-lg-2">
                        <a href="#" style="color: black"><?= $row['title'] ?></a>
                    </div>
                    <div class="col-lg-4">
                        <h5><?= $row['description'] ?></h5>
                    </div>
                    <div class="col-lg-2">
                        <h3><?= $row['price'] ?></h3>
                    </div>
                    <div class="col-lg-2">
                        <h3><?php echo $status; ?></h3>
                    </div>


                </div><br/>

        <div class="btn btn-group" >
            <form method="get" action="viewad.php">
                <button type="submit" class="btn btn-info " name="update" value="<?= $row['id']; ?>">view add</button>
                <!--                        <button type="submit" class="btn btn-warning" name="delete" value="--><?//= $row['id']; ?><!--">Delete</button>-->

            </form>

            <div class="btn btn-group" >
                    <form method="get" action="alterads.php">
                        <button type="submit" class="btn btn-info " name="update" value="<?= $row['id']; ?>">Update</button>
<!--                        <button type="submit" class="btn btn-warning" name="delete" value="--><?//= $row['id']; ?><!--">Delete</button>-->

                    </form>
                </div>
                <div class="btn btn-group" >
                    <form method="get" action="activate.php">
                        <button type="submit" class="btn btn-warning" name="delete" value="<?= $row['id']; ?>">Delete</button>


                        <?php if($row['status'] == 1){ ?>
                            <button type="submit" class="btn btn-danger" name="deactivate" value="<?= $row['id']; ?>">Deactivate</button>
                        <?php }
                        else{ ?>
                            <button type="submit" class="btn btn-default" name="activate" value="<?= $row['id']; ?>">Activate</button>
                        <?php } ?>
                    </form>
                </div>
                <hr>
            <?php }
            $total_ads = $con->query("Select * from `olx`.`ads` where status = 1");
            $total_ads =  $total_ads->num_rows;
            $pages = ceil($total_ads/$page_size);
            echo "<div align='right'> <h3 style='display: inline-block'>Pages: </h3>";
            for($j=1;$j<=$pages;$j++){
                echo "<div class=\"pagination\">";
                echo "<a href=home.php?page=".$j."><button class='form-control' style='background-color: #414141;color:black'>".$j."</button></a>";
                echo "</div>";
            }
            echo "</div>";
        }
        ?>
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


