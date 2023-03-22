<?php
session_start();
if (!isset($_SESSION["sign"])) {
    header('Location:http://localhost/labiral/php/login.php');
    exit();
}else {
    session_unset();
    session_destroy();
    header('Location: http://localhost/labiral/php/login.php');
    exit();
}
