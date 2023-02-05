<?php

session_start();

if (isset($_POST["updateInfo"])) {
    $infoId = $_POST["infoId"];
    $fname = $_POST["Fname"];
    $lname = $_POST["Lname"];
    $gender = $_POST["gender"];
    $bdate = $_POST["bdate"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $city = $_POST["city"];
    $postCode = $_POST["postCode"];
    $medicalCon = $_POST["medicalCon"];
    $treatment = $_POST["treatment"];
    $allergies = $_POST["allergies"];

    require_once '../dbh.inc.php';
    require_once 'function.admin.php';

    adminDataUpdate($conn, $infoId ,$fname, $lname, $gender, $bdate, $phone, $address, $city, $postCode, $medicalCon, $treatment, $allergies);
}

else {
    header("location: /admin/index.admin.php");
    exit();
}