<?php
    require_once '../dbh.inc.php';
    $sql = "DELETE FROM emergency_contact WHERE `contact_Id` = '" . $_GET["contactid"] . "'";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../../admin/index.admin.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_execute($stmt);
    
    mysqli_stmt_close($stmt);
    header("location: ../../admin/emergency.contact.php?error=none");