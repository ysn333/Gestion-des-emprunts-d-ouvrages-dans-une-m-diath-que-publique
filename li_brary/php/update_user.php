<?php
// تأكد من إضافة ملف dbconfig.php الذي يحتوي على معلومات الاتصال بقاعدة البيانات

include "dbconfig.php";
session_start();

$id = $_SESSION["id"];
$email = $_POST["email"];
$phone_number = $_POST["phone_number"];



    
$sql = "SELECT * FROM adhérents WHERE   id = '$id'";
$result = $conn->query($sql);


$sql = "UPDATE `adhérents` SET  email = '$email' , phone_number = '$phone_number' WHERE id ='$id' ";
$result = $conn->query($sql);



 header('Location: profil_adhérents.php');