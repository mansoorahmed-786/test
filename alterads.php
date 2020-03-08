<?php
//session_start();
include_once 'db.php';
include_once 'postad.php';

if(isset($_GET['delete'])){
    $id= $_GET['delete'];
    $query = $con->query("DELETE FROM `olx`.`ads` WHERE id = '$id'");
    if(!$query){
        echo "<span class='alert-danger'> <h2>Some error occurred, try again later.</h2></span>";
        echo "<br><br><a href='home.php'> <button type=\"submit\" class=\"btn btn-danger\" name = \"back\">Go Back</button></a>";
    }
    else{
        header("location: home.php ");
    }

    $con->close();
}

else if (isset($_GET['activate'])){
    $id=$_GET['activate'];
    $query = $con->query("update `olx`.`ads` set `status` = '1' WHERE `id` = '$id'");
    if(!$query){
        echo "<span class='alert-danger'> <h2>Some error occurred, try again later.</h2></span>";
        echo "<br><br><a href='home.php'> <button type=\"submit\" class=\"btn btn-danger\" name = \"back\">Go Back</button></a>";
        header("location: home.php ");
    }
    else{
        header("location: home.php ");
    }

    $con->close();

}
else if (isset($_GET['deactivate'])){
    $id=$_GET['deactivate'];
    $query = $con->query("update `olx`.`ads` set `status` = '0' WHERE `id` = '$id'");
    if(!$query){
        echo "<span class='alert-danger'> <h2>Some error occurred, try again later.</h2></span>";
        echo "<br><br><a href='home.php'> <button type=\"submit\" class=\"btn btn-danger\" name = \"back\">Go Back</button></a>";
    }
    else{
        header("location: home.php ");
    }

    $con->close();

}
else if(isset($_GET['update'])) {

    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $id = $_GET['update'];
    $result = $con->query("UPDATE  `olx1`.`ads` set title= '$title',description = '$description',price = '$price'
                                WHERE `id` = '$id' AND `user_id` = '$ses_id'");

    if ($result) {

        ?>
        <div class="alert alert-success">
           <!-- <h3>Your Ad has been updated successfully.</h3><br><br>-->
            <button class="btn btn-info"><a href="home.php">Go back to Dashboard</a></button>
        </div>
        <?php
    } else {
        ?>
        <div class="alert alert-warning">
            <h3>Profile Can't be update due to some error.</h3><br><br>
            <button class="btn btn-default"><a href="home.php">Try Again</a></button>
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
        <div class="panel panel-success" style="background-color: whitesmokei">
            <div class="panel-heading" align="center">
                <h3>Update Your current ad information</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <form action="alterads.php" method = "post" enctype="multipart/form-data">
                        <div class="col-lg-4">
                            <div align="right">
                                <p> Title  </p><br/><br/>
                                <p> Description  </p><br/><br/><br/>
                                <p style="padding-top: 7px"> Price  </p><br/><br/>
                                <p> Attach new picture </p><br/><br/>


                            </div>
                        </div>
                        <div class="col-lg-5">

                            <input type="text" name = "title" class="form-control" value="<?php echo $temp['title']; ?>">Change ad Title<br/><br/>
                            <textarea name="description" class="form-control"><?php echo $temp['description']; ?></textarea>Your ad Description<br/><br/>
                            <input type="text" name="price" class="form-control" value="<?php echo $temp['price']; ?>">Change Price<br/><br/>
                            <input type="file" name="picture" class="btn btn-warning" >New Picture<br/><br/>

                            <div align="right">
                                <br/>
                                <button type="submit" class="btn btn-info" name = "ad-update" value="<?php echo $id; ?>">Update</button>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <img src="<?php echo $temp['picture_file_name']; ?>" width="240px">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </body>
    </html>
<?php } ?>

