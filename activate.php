<?php

session_start();
include_once 'db.php';
if (isset($_GET['activate'])){
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