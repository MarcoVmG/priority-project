<?php
session_start();
?>
<!DOCTYPE html>

<head>
    <title>Form for user data</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous" />
    <link rel="stylesheet" href="/css/data-form.css" />
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
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
            </div>
        </nav>
    </header>

    <form class="data-form row" method="post" action="/include/emc.inc.php">

        <h4>Emergency Contact</h4>
        <hr />
        <h5>First Person</h5>
        <hr />
        <div class="col-md-6">
            <label for="" class="form-label">First name</label>
            <input type="text" class="form-control" name="ec_Fname" id="" aria-describedby="helpId" placeholder="" />
        </div>
        <div class="col-md-6">
            <label for="" class="form-label">Last name</label>
            <input type="text" class="form-control" name="ec_Lname" aria-describedby="helpId" placeholder="" />
        </div>

        <div class="col-md-6">
            <label for="" class="form-label">Address</label>
            <input type="text" class="form-control" name="ec_Add" aria-describedby="helpId" placeholder="" />
        </div>
        <div class="col-md-6">
            <label for="" class="form-label">Phone Number</label>
            <input type="tel" class="form-control"  name="ec_Phone" />
        </div>
        <h5>Second person</h5>
        <hr />
        <div class="col-md-6">
            <label for="" class="form-label">First name</label>
            <input type="text" class="form-control" name="ec_FnameNd" aria-describedby="helpId" placeholder="" />
        </div>
        <div class="col-md-6">
            <label for="" class="form-label">Last name</label>
            <input type="text" class="form-control" name="ec_LnameNd" aria-describedby="helpId" placeholder="" />
        </div>

        <div class="col-md-6">
            <label for="" class="form-label">Address</label>
            <input type="text" class="form-control" name="ec_AddNd"  />
        </div>
        <div class="col-md-6">
            <label for="" class="form-label">Phone Number</label>
            <input type="tel" class="form-control" name="ec_PhoneNd" />
        </div>

        <div class="mb-3 mt-3">
            <button type="submit" class="btn btn-primary" name="submitEc">
                Submit
            </button>
        </div>
    </form>

    <footer class="bg-light fixed-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-4 pt-2">
                    <p>Copyright © 2022 Marco</p>
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