<!doctype html>
<?php
session_start();
  if(isset($_SESSION['uname'])){
    header("location:admin/dashboard.php");
    exit;
  }
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>SIMSE - BUGELAN</title>
    <link href="./logo/logo.png" rel="shortcut icon" type="image/x-icon">

    

    <!-- Bootstrap core CSS -->
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
      .container {
        width: auto;
        max-width: 680px;
        padding: 0 15px;
      }
    </style>

    <?php 
    if(isset($_GET['pesan'])){
      if($_GET['pesan'] == "gagal"){
        echo "<span class='alert alert-danger'>Login gagal.. Coba Lagi..</span>";
      }
    }
    ?>

    <!-- Custom styles for this template -->
    <link href="./assets/css/signin.css" rel="stylesheet">
  </head>
  <body class="d-flex flex-column h-100">

    <main class="form-signin">
      <form action="login_act.php" method="post">
        <center class="flex-shrink-0">
          <img class="mb-4" src="./logo/logo.png" alt="" width="125" height="110">
          <h1 class="h3 mb-3 fw-normal">Please Login</h1>
          <div class="form-floating">
            <input type="text" class="form-control" id="floatingInput" placeholder="Username" name="uname">
            <label for="floatingInput">Username</label>
          </div>
          <div class="form-floating">
            <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="pass">
            <label for="floatingPassword">Password</label>
          </div>

          <div class="checkbox mb-3">
            <label>
              <input type="checkbox" value="remember-me"> Remember me
            </label>
          </div>
          <button class="w-100 btn btn-lg btn-success" type="submit">Login</button>
          <p class="mt-5 mb-3 text-muted">&copy; Yayasan Bugelan</p>
        </center>
      </form>
    </main>

  </body>
</html>