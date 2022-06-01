<?php 
include 'header.php';
?>
<style>
  .form-signin {
    width: 300px;
    max-width: 680px;
    padding: 0 15px;
  }
  .form-signin input[type="text"] {
    margin-bottom: -1px;
    border-bottom-right-radius: 0;
    border-bottom-left-radius: 0;
  }
  .form-signin input[type="password"] {
    margin-bottom: 10px;
    border-top-left-radius: 0;
    border-top-right-radius: 0;
  }
</style>
<body class="d-flex flex-column h-100">
  <main class="container text-center mt-5 form-signin">
    <form action="login_act" method="post">
      <?php 
      if(isset($_GET['pesan'])){
        if($_GET['pesan'] == "gagal"){
          echo "<div style='margin-bottom:-55px' class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-warning-sign'></span>  Maaf, anda tidak diizinkan..</div>";
          // echo '<div class="position-absolute text-white" style="background-color:rgba(0,0,0,0.7);height: 200px;width: 270px;">testing</div>';
        }
      }
      ?>
      <h1 class="h3 mb-3 fw-normal">Admin Login</h1>
      <div class="form-floating">
        <input type="text" class="form-control" id="floatingInput" placeholder="Username" name="uname" autocomplete="off">
        <label for="floatingInput">Username</label>
      </div>
      <div class="form-floating mb-3">
        <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="pass">
        <label for="floatingPassword">Password</label>
      </div>
      <button class="w-100 btn btn-lg btn-dark mb-3" type="submit">Login</button>
      <span data-feather="alert-triangle" class="mb-1 text-danger"></span>
      <p class="mb-3 text-danger">Menu ini hanya untuk Admin</p>
    </form>
  </main>
</body>
</html>

