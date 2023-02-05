<?php
    require_once '../dbh.inc.php';
    $sql = "DELETE FROM users WHERE user_Id = '" . $_GET["userid"] . "'";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_execute($stmt);
    
    mysqli_stmt_close($stmt);
    header("location: /priority/admin/user.table.php?error=none");
?>