<?php
session_start();

if(isset($_SESSION['usr_id'])) {

    unset($_SESSION['usr_id']);
    unset($_SESSION['usr_name']);
    session_destroy();
    header("Location: main.php");
} else {
    header("Location: main.php");
}
?>