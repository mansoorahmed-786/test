<?php

$category = $_GET['usr_id'];

$result = $con->query("select * from `olx`.`ads` where id = '$category'")->fetch_assoc();
$id = $result['user_id'];
$temp = $con->query("select * from `olx`.`users` where id = '$id'")->fetch_assoc();

?>
<html>
<body>

<div class="panel panel-info">
    <div class="page-header" style="padding-left: 110px">
        <h3><?= $result['title']; ?></h3>
        <h6 style="display: inline; padding-left: 20px">Posted on: <i class="glyphicon glyphicon-time"></i> (<?= $result['date_posted']; ?>)</h6>
        <div  style="float: right">
            <h3 style="display: inline; padding-right: 40px">$ <?= $result['price']; ?></h3>
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
                <form action="ads.php" method="get">
                    <?php setcookie("ad-user",$result['user_id']);
                    setcookie("ad-id",$result['id'])?>
                    <button type="submit" class="btn btn-info" ">Message</button>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>

