<?php
include_once "dbconfig.php";
session_start();

if(isset($_POST['update'])){
    $id = $_SESSION["id"];
    $directory = "../files/profil_img/";
    $pic_name = basename($_FILES["primary"]["name"]);
    $path = $directory.$pic_name;
    move_uploaded_file($_FILES["primary"]["tmp_name"], $path);

    $sqlSat = $conn->prepare("UPDATE adhérents SET `profile_pic` = '$pic_name' WHERE id = '$id'");
    $sqlSat->execute();
    header('Location: profil_adhérents.php');
    exit();

}

?>