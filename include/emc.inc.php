<?php

session_start();

if (isset($_POST["submitEc"])) {
    $userId = $_SESSION['user_Id'];
    $fname = $_POST["ec_Fname"];
    $lname = $_POST["ec_Lname"];
    $address = $_POST["ec_Add"];
    $phone = $_POST["ec_Phone"];
    $fnameNd = $_POST["ec_FnameNd"];
    $lnameNd = $_POST["ec_LnameNd"];
    $addressNd = $_POST["ec_AddNd"];
    $phoneNd = $_POST["ec_PhoneNd"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if (emptyInputEcF($fname, $lname, $address, $phone, $fnameNd, $lnameNd, $addressNd, $phoneNd) !== false){
    header("location: ../user/index_user.php?error=emptyinput");
    exit();
    }
    submitEmergencyData($conn, $userId,$fname, $lname, $address, $phone, $fnameNd, $lnameNd, $addressNd, $phoneNd);
}
else {
    header("location: ../user/index_user.php");
    exit();
}