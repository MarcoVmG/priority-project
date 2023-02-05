<?php
    require_once '../include/dbh.inc.php';
    $sql = "SELECT * FROM user_info";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

?>


<!DOCTYPE html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Priority</title>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href=" /css/admin-tables.css" />
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src=" /img/logo_clean.png" alt="" width="70" height="65" class="d-inline-block align-text-top" />
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href=" /admin/index.admin.php">Home</a>
                        </li>
                    </ul>

                </div>
                <div class="d-grid gap-2 d-md-block">
                    <a class="btn btn-primary" href=" /include/logout.inc.php">Log out</a>
                </div>
            </div>
        </nav>
    </header>
    <div class="table-responsive">
        <table class="user mx-auto table">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">User Id</th>
                    <th scope="col">Fist Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Birthday</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Address</th>
                    <th scope="col">City</th>
                    <th scope="col">Post Code</th>
                    <th scope="col">Medical Condition</th>
                    <th scope="col">Medication</th>
                    <th scope="col">Allergies</th>
                    <th scope="col">Unique Code</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>    
                <tr>
                    <th scope="row"><?php echo $row["info_Id"] ?></th>
                    <td><?php echo $row["user_Id"] ?></td>
                    <td><?php echo $row["user_Fname"] ?></td>
                    <td><?php echo $row["user_Lname"] ?></td>
                    <td><?php echo $row["user_Gender"] ?></td>
                    <td><?php echo $row["user_Bdate"] ?></td>
                    <td><?php echo $row["user_Phone"] ?></td>
                    <td><?php echo $row["user_Address"] ?></td>
                    <td><?php echo $row["user_City"] ?></td>
                    <td><?php echo $row["user_Postcode"] ?></td>
                    <td><?php echo $row["user_Condition"] ?></td>
                    <td><?php echo $row["user_Treatment"] ?></td>
                    <td><?php echo $row["user_Allergies"] ?></td>
                    <td><?php echo $row["user_unique"] ?></td>
                    <td>
                        <a href="../include/admin/delete.info.php?infoId=<?php echo $row["info_Id"]?>" class="btn btn-danger"><i class="bi bi-trash3-fill"></i></a>
                    </td>
                    <td><a href=" /admin/update/user.info.php?infoid=<?php echo $row["info_Id"] ?>" class="btn btn-warning"><i class="bi bi-pencil-fill"></i></a></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

    <footer class="footer bg-light fixed-bottom ">
        <div class="container">
            <div class="row">
                <div class="col-sm-10">
                    <p>Copyright © 2022 Priority.</p>
                    <p>All rights reserved</p>
                </div>
            </div>
    </footer>
</body>