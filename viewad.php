<?php
session_start();
include_once 'db.php';
//include_once 'db.php';

$category = $_GET['update'];
$result = $con->query("select * from `olx`.`ads`where id = '$category'")->fetch_assoc();
$id = $result['usr_id'];
$temp = $con->query("select * from `olx`.`users` where id = '$id'")->fetch_assoc();

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

<div class="panel panel-info">
    <div class="page-header" style="padding-left: 110px">
        <h3><?= $result['title']; ?></h3>
        <h6 style="display: inline; padding-left: 20px">Posted on: <i class="glyphicon glyphicon-time"></i> (<?= $result['date_posted']; ?>)</h6>
        <div  style="float: right">
            <h3 style="display: inline; padding-right: 40px">RS <?= $result['price']; ?></h3>
        </div>
    </div>
    <div class="panel-body" >
        <div class="row">
            <div class="col-lg-5" align="center">
                <img src="<?= $result['picture_file_name']; ?>" style="width: 300px">
            </div>
            <div class="col-lg-7">
                <h4>Description:</h4>
                <p><?= $result['description']; ?></p>
            </div>
        </div>

    </div>
    <div class="panel-footer">
        <h3 style="padding-left: 100px">Owner Information:</h3>
        <div class="row" style="padding-left: 50px">
            <div class="col-lg-6" style="padding-left: 110px">
                <?= $temp['name']; ?><br/>
                <?= $temp['mobile_number']; ?>
            </div>
            <div class="col-lg-6" align="right">
                <form action="send-message.php" method="get">
                    <?php setcookie("ad-user",$result['user_id']);
                    setcookie("ad-id",$result['id'])?>
                    <button type="submit" class="btn btn-info" ">Message</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="bootstrap/js/jquery-1.10.2.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>

