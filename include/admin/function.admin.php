<?php

function adminUserUpdate($conn, $userId, $email, $pass, $role) {

    $sql = "UPDATE users SET `user_Email` = '$email', `user_Password` = '$pass', `role` = '$role' WHERE user_Id = '$userId'";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location:  /admin/user.table.php?error=none");
}

function adminEmergencyUpdate($conn, $contactId, $fName, $lName, $address, $phone){
    $sql = "UPDATE user_emergency_contact SET `contact_Fname` = '$fName', `contact_Lname` = '$lName', `contact_Add` = '$address', `contact_Phone` = '$phone' WHERE contact_Id = '$contactId'";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location:  /admin/emergency.contact.php?error=none");
}

function  adminDataUpdate($conn, $infoId ,$fname, $lname, $gender, $bdate, $phone, $address, $city, $postCode, $medicalCon, $treatment, $allergies) {
    $sql = "UPDATE user_info SET `user_Fname` = '$fname', `user_Lname` = '$lname', `user_Gender` = '$gender', `user_Bdate` = '$bdate', `user_Phone` = '$phone', `user_Address` = '$address', `user_City` = '$city', `user_Postcode` = '$postCode', `user_Condition` = '$medicalCon', `user_Treatment` = '$treatment', `user_Allergies` = '$allergies' WHERE `info_Id` = '$infoId'";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../../admin/user.info.php?error=none");
}