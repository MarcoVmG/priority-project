<?php

session_start();

if (isset($_POST["update"])) {
    $userId = $_POST['userid'];
    $email = $_POST["email"];
    $userPass = $_POST["password"];
    $role = $_POST["role"];
    
    $pass = password_hash($userPass, PASSWORD_DEFAULT);

    require_once '../dbh.inc.php';
    require_once 'function.admin.php';

    adminUserUpdate($conn, $userId, $email, $pass, $role);
}

else {
    header("location: /admin/index.admin.php");
    exit();
}