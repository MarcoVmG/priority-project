<?php
// This function chechk if any imput of the signup form is empty
function emptyInputSignup($email, $pwd, $pwdRepeat) {
    $result = false;
    if (empty($email) || empty($pwd) || empty($pwdRepeat)) {
       $result = true;
    }
    else {
        $result = false;
    }

    return $result;
}
// This function check if the email input of the signup form is a valid email
function invalidEmail($email) {
    $result = false;
    if (!filter_var ($email, FILTER_VALIDATE_EMAIL)) {
    $result = true;
    }
    else {
    $result = false;
    }
    return $result;
}
// This function compare the passwords and confirmation password that are required in the signup form
function passwordMatch ($pwd, $pwdRepeat) {
    $result = false;
    if ($pwd !== $pwdRepeat) {
    $result = true;
    }
    else {
    $result = false;
    }
    return $result;
}
// This function check if the email introduced on the signup form is already in use inside the database
function emailExists($conn, $email) {
    $sql = "SELECT * FROM users WHERE user_Email = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../signup.php?error=stmtfailed");
    exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
   
    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    }
    else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}
//Once all the validations were passed, this function is called to create the new user and insert it inside the database.
function createUser($conn,$email, $pwd) {
    $sql = "INSERT INTO users (user_Email, user_Password, role) VALUES (?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../signup.php?error=stmtfailed");
    exit();
    }
    if(str_contains($email, 'admin@priority.com')) {
        $role = 'administrator';
    } else if(str_contains($email, 'emergency@priority.com')){
        $role = 'Emergency Team';
    } else {
        $role = 'user';
    }
    
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sss", $email, $hashedPwd, $role);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../signup.php?error=none");
  
}
// This function check if the inputs of the login form are empty.
function emptyInputLogin($email, $pwd) {
    $result = false;
    if (empty($email) || empty($pwd)) {
       $result = true;
    }
    else {
        $result = false;
    }

    return $result;
}
// This function let the user login inside the web by checking if the password an the email introduced are located inside the database.
function loginUser($conn, $email, $pwd){
    $emailExists = emailExists($conn, $email);

    if ($emailExists === false) {
        header("location: ../login.php?error=wronglogin");
        exit();
    }

    $pwdHashed = $emailExists['user_Password'];
    // password_verify check if the password introduced is the same as the one located on the database
    $checkPwd = password_verify($pwd, $pwdHashed);

    if ($checkPwd === false) {
        header("location: ../login.php?error=passwordunmatch");
        exit();
    }
    else if ($checkPwd === true) {
        session_start();
        $_SESSION['user_Id'] = $emailExists['user_Id'];
        $_SESSION['user_Email'] = $emailExists['user_Email'];
        $_SESSION['user_Role'] = $emailExists['role'];
        //The next if  ensure which is the role of the user and redirect it to the index relative for them.
        if ($_SESSION['user_Role'] == 'user') {
            header("location: ../user/index_user.php?login=success");
        } else if ($_SESSION['user_Role'] == 'Emergency Team') {
            header("location: ../emergencyUser/index.em.php?login=success");
        } else if ($_SESSION['user_Role'] == 'administrator') {
            header("location: ../admin/index.admin.php?login=success");
        }
        exit();
    }
}
//This function check if the key created by the function generateKey are located already in the data base or not.
function checkKeys($conn, $randStr) {
    $sql = "SELECT * FROM user_info";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../priority/user/index_user.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_execute($stmt);
    $result= mysqli_stmt_get_result($stmt);

    while ($row = mysqli_fetch_assoc($result)) {
        if ($row['user_unique'] == $randStr) {
            $keyExists = true;
        }
        else {
            $keyExists = false;
        }
    }
    return $keyExists;
}
// This function generate a unique key for each user random created by using a string of different characters.
function generateKey($conn) {
    $keyLenght = 6;
    $str = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $randStr = substr(str_shuffle($str), 0, $keyLenght);

    $checkKeys = checkKeys($conn, $randStr);


    while ($checkKeys == true) {
    $randStr = substr(str_shuffle($str), 0, $keyLenght);
    $checkKeys = checkKeys($conn, $randStr);
    
    }

    return $randStr;
}


/**
 * If any of the variables are empty, return true. Otherwise, return false.
 * 
 * @param fname user First name
 * @param lname user Last name
 * @param gender User Gender
 * @param bdate user date of birth
 * @param phone user phone number
 * @param address  user address
 * @param city user city
 * @param postCode user post code
 * @param medicalCon user Medical Condition
 * @param treatment user treatment
 * @param allergies user allergies
 * 
 * @return a boolean value.
 */
function emptyInputDf($fname, $lname, $gender, $bdate, $phone, $address, $city, $postCode, $medicalCon, $treatment, $allergies) {
    $result = false;
    if (empty($fname) || empty($lname) || empty($gender) || empty($bdate) || empty($phone) || empty($address) || empty($city) || empty($postCode) || empty($medicalCon) || empty($treatment) || empty($allergies)) {
       $result = true;
    }
    else {
        $result = false;
    }

    return $result;
}


/**
 * It takes the user's input from the form and inserts it into the database.
 * 
 * @param conn connection to the database
 * @param userId The user's ID
 * @param fname  user First name
 * @param lname user Last name
 * @param gender User Gender
 * @param bdate date
 * @param phone 
 * @param address 
 * @param city 
 * @param postCode VARCHAR(10)
 * @param medicalCon textarea
 * @param treatment varchar(255)
 * @param allergies varchar(255)
 */
function submitDataform($conn, $userId,$fname, $lname, $gender, $bdate, $phone, $address, $city, $postCode, $medicalCon, $treatment, $allergies) {
    $sql = "INSERT INTO user_info (user_Id, user_Fname, user_Lname, user_Gender, user_Bdate, user_Phone, user_Address, user_City, user_Postcode, user_Condition, user_Treatment, user_Allergies, user_Unique)  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    $userId2 = $_SESSION['user_Id'];
    if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../user/index_user.php?error=stmtfailed");
    exit();
    }
    $unique = generateKey($conn);

    mysqli_stmt_bind_param($stmt, "sssssssssssss", $userId2, $fname, $lname, $gender, $bdate, $phone, $address, $city, $postCode, $medicalCon, $treatment, $allergies, $unique);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../user/index_user.php?error=none");
  
}



function emptyInputEcF($fname, $lname, $address, $phone, $fnameNd, $lnameNd, $addressNd, $phoneNd) {
    $result = false;
    if (empty($fname) || empty($lname) || empty($address) || empty($phone) || empty($fnameNd) || empty($lnameNd) || empty($addressNd) || empty($phoneNd)) {
       $result = true;
    }
    else {
        $result = false;
    }

    return $result;
}

function submitEmergencyData($conn, $userId,$fname, $lname, $address, $phone, $fnameNd, $lnameNd, $addressNd, $phoneNd) {
    $sql = "INSERT INTO user_emergency_contact (user_Id, contact_Fname, contact_Lname, contact_Add, contact_Phone )  VALUES (?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../user/index_user.php?error=stmtfailed");
    exit();
    }

    mysqli_stmt_bind_param($stmt, "sssss", $userId,$fname, $lname, $address, $phone);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_bind_param($stmt, "sssss", $userId, $fnameNd, $lnameNd, $addressNd, $phoneNd);
    mysqli_stmt_execute($stmt);
    
    mysqli_stmt_close($stmt);
    header("location: ../user/index_user.php?error=none");
  
}

// emergency user access to user data

function emptyInputEmUserData($userUnique,$eMCId) {
    $result = false;
    if (empty($userUnique) || empty($eMCId) ) {
       $result = true;
    }
    else {
        $result = false;
    }

    return $result;
}

function updateDataForm ($conn, $userId,$fname, $lname, $gender, $bdate, $phone, $address, $city, $postCode, $medicalCon, $treatment, $allergies) {
    $sql = "UPDATE user_info SET `user_Fname` = '$fname', `user_Lname` = '$lname', `user_Gender` = '$gender', `user_Bdate` = '$bdate', `user_Phone` = '$phone', `user_Address` = '$address', `user_City` = '$city', `user_Postcode` = '$postCode', `user_Condition` = '$medicalCon', `user_Treatment` = '$treatment', `user_Allergies` = '$allergies' WHERE user_Id = '$userId'";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../user/index_user.php?error=none");
}