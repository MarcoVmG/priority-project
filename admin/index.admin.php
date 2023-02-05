<!DOCTYPE html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Priority</title>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous" />
  <link rel="stylesheet" href=" /css/index.css" />
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
              <a class="nav-link active" aria-current="page" href=" /admin/homePage.php">Home</a>
            </li>
          </ul>

        </div>
        <div class="d-grid gap-2 d-md-block">
          <a class="btn btn-primary" href=" /include/logout.inc.php">Log out</a>
        </div>
      </div>
    </nav>
  </header>
  <div class="row justify-content-center mx-auto my-auto">
    <div class="col-sm-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">User table</h5>
          <p class="card-text">Access to the table using the button below.</p>
          <a href="user.table.php" class="btn btn-primary">Access</a>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Emergency information table</h5>
          <p class="card-text">Access to the table using the button below.</p>
          <a href="emergency.contact.php" class="btn btn-primary">Access</a>
        </div>
      </div>
    </div>

    <div class="col-sm-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">User information table</h5>
          <p class="card-text">Access to the table using the button below.</p>
          <a href="user.info.php" class="btn btn-primary">Access</a>
        </div>
      </div>
    </div>
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