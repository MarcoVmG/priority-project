<?php

if (isset($_POST["submit"])) {
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdrepeat"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if (emptyInputSignup($email,$pwd, $pwdRepeat) !== false){
    header("location: ../signup.php?error=emptyinput");
    exit();
    }
    if (invalidEmail($email) !== false){
    header("location: ../signup.php?error=invalidemail");
    exit();
    }      
    if (passwordMatch($pwd, $pwdRepeat) !== false){
        header("location: ../signup.php?error=passwordunmatch");
        exit();
    } 

    if (emailExists($conn, $email) !== false){
        header("location: ../signup.php?error=emailexists");
        exit();
    }

    createUser($conn,$email, $pwd);

}
else {
    header("location: ../signup.php");
}