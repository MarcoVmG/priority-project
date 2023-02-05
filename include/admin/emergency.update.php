<?php

session_start();

if (isset($_POST["updateEc"])) {
    $contactId = $_POST['contactId'];
    $fName = $_POST["ec_Fname"];
    $lName = $_POST["ec_Lname"];
    $address = $_POST["ec_Add"];
    $phone = $_POST["ec_Phone"];
    

    require_once '../dbh.inc.php';
    require_once 'function.admin.php';

    adminEmergencyUpdate($conn, $contactId, $fName, $lName, $address, $phone);
}

else {
    header("location: ../admin/index.admin.php");
    exit();
}