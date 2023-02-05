<?php
session_start();


    require_once '../include/dbh.inc.php';
    $sql = "SELECT * FROM user_info WHERE user_Id = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("location: ./index_user.php?error=stmtfailed");
      exit();
    }
    $userId = $_SESSION['user_Id'];


    mysqli_stmt_bind_param($stmt, "s", $userId);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($resultData);


    $sql2 = "SELECT * FROM user_emergency_contact WHERE user_Id = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql2)) {
      header("location: ./index_user.php?error=stmtfailed");
      exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $userId);
    mysqli_stmt_execute($stmt);
    $resultData2 = mysqli_stmt_get_result($stmt);


?>

<!DOCTYPE html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Priority</title>
  <link rel="stylesheet" href="/css/userDataForm.css" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous" />
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
          <img src="/img/logo_clean.png" alt="" width="70" height="65" class="d-inline-block align-text-top" />
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index_user.php">Home</a>
            </li>
          </ul>

        </div>
        <div class="d-grid gap-2 d-md-block">
          <a class="btn btn-primary" href="/include/logout.inc.php">Log out</a>
        </div>
      </div>
    </nav>
  </header>
  <section>
    <div class=" dataUser mx-auto">
      <div class="row">
        <h2>User Data</h2>
        <hr>
        <div class="col-md-6">
          <h4>First Name</h4>
          <p><?php echo $row['user_Fname'] ?></p>
        </div>
        <div class="col-md-6">
          <h4>Last Name</h4>
          <p><?php echo $row['user_Lname'] ?></p>
        </div>
        <div class="col-md-6">
          <h4>Gender</h4>
          <p><?php echo $row['user_Gender'] ?></p>
        </div>
        <div class="col-md-6">
          <h4>Phone</h4>
          <p><?php echo $row['user_Phone'] ?></p>
        </div>
        <div class="col-md-6">
          <h4>Address</h4>
          <p><?php echo $row['user_Address'] ?></p>
        </div>
        <div class="col-md-6">
          <h4>City</h4>
          <p><?php echo $row['user_City'] ?></p>
        </div>
        <div class="col-md-6">
          <h4>Post Code</h4>
          <p><?php echo $row['user_Postcode'] ?></p>
        </div>
        <div class="col-md-6">
          <h4>Chronic medical conditions</h4>
          <p><?php echo $row['user_Condition'] ?></p>
        </div>
        <div class="col-md-6">
          <h4>Current Medication</h4>
          <p><?php echo $row['user_Treatment'] ?></p>
        </div>
        <div class="col-md-6">
          <h4>Allergies</h4>
          <p><?php echo $row['user_Allergies'] ?></p>
        </div>
      </div>
      <div class="row">
        <h2>Emergency Contact</h2>
        <hr>
        <?php while ($row2 = mysqli_fetch_assoc($resultData2)) { ?>
        <div class="col-md-6">
          <h4>First Name</h4>
          <p><?php  echo $row2['contact_Fname']?></p>
        </div>
        <div class="col-md-6">
          <h4>Last Name</h4>
          <p><?php  echo $row2['contact_Lname']?></p>
        </div>
        <div class="col-md-6">
          <h4>Phone</h4>
          <p><?php  echo $row2['contact_Phone']?></p>
        </div>
        <div class="col-md-6">
          <h4>Address</h4>
          <p><?php  echo $row2['contact_Add']?></p>
        </div>
        <?php } ?>
      </div>
    </div>
    </div>
  </section>

  <footer class="bg-light sticky-bottom mt-5">
    <div class="container">
      <div class="row">
        <div class="col-md-4 pt-2">
          <p>Copyright © 2022 Priority</p>
          <p>All rights reserved</p>
        </div>
        <div class="col-md-4 pt-2">
          <h3>Contact Us</h3>
          <p>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
              <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z" />
            </svg>
            <span>
              Email:
              <br />
              <a href="mailto:">priority@gmail.com</a>
            </span>
          </p>
        </div>
      </div>
    </div>
  </footer>
</body>