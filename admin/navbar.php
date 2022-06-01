<!doctype html>
<html lang="en">
  <head>
    <?php 
    session_start();
    include 'config.php';
      if(!isset($_SESSION['uname'])){
        header("location:../");
        exit;
      }
    $use=$_SESSION['uname'];
    $nm=mysqli_query($GLOBALS["___mysqli_ston"], "select * from admin where uname='$use'");
    while($name=mysqli_fetch_array($nm)){
    ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>BUGELAN | Admin</title>
    <link href="../logo/logo.png" rel="shortcut icon" type="image/x-icon">
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="../assets/css/navbar.css" rel="stylesheet">

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
    </style>
    
  </head>
  <body class="bg-light">
    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#"><img src="../logo/logo_white.png"  width="40" height="32"></a>
      <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>
      <label class="form-control form-control-dark" disabled>SISTEM INFORMASI MANAGEMEN SEKOLAH</label>
    </header>

    <div class="container-fluid">
      <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
          <div class="position-sticky pt-3">
            <ul class="nav flex-column">
            <?php 
            // menghilangkan slash (/) di ahir
            $url = rtrim($_SERVER['REQUEST_URI'], '/');
            // memecah URL menjadi array
            $url = explode('/', $url);
            ?> 
              <li class="nav-item">
                <a class="nav-link <?php if(substr($url[3],0,4) === 'dash'){ echo 'active'; } ?>" aria-current="page" href="dashboard">
                  <span data-feather="home"></span>
                  Dashboard
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php if(substr($url[3],0,4) === 'guru'){ echo 'active'; } ?>" href="guru">
                  <span data-feather="file"></span>
                  Data Guru
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php if(substr($url[3],0,4) === 'sisw'){ echo 'active'; } ?>" href="siswa">
                  <span data-feather="file"></span>
                  Data Siswa
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php if(substr($url[3],0,4) === 'abse'){ echo 'active'; } ?>" href="absensi">
                  <span data-feather="bell"></span>
                  Absensi
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php if(substr($url[3],0,4) === 'sura' || substr($url[3],0,4) === 'suratin' ){ echo 'active'; } ?>" href="surat">
                  <span data-feather="mail"></span>
                  Surat menyurat
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php if(substr($url[3],0,4) === 'buku'){ echo 'active'; } ?>" href="buku">
                  <span data-feather="shopping-cart"></span>
                  Pembukuan
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php if(substr($url[3],0,4) === 'akun'){ echo 'active'; } ?>" href="akun">
                  <span data-feather="bar-chart-2"></span>
                  Akuntansi
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php if(substr($url[3],0,4) === 'user'){ echo 'active'; } ?>" href="user">
                  <span data-feather="users"></span>
                  Pengguna
                </a>
              </li>
              <li class="border-top my-3"></li>
              <h5 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-2 mb-1 text-muted">
                <span><?php echo ucfirst($name['name']) ?> - <?php echo ucfirst($name['access']) ?></span>
                <a class="link-secondary" href="#" aria-label="Add a new report">
                  <span data-feather="check-circle"></span>
                </a>
              </h5> 
              <li class="border-top my-3"></li>
              <li class="nav-item">
                <a class="nav-link <?php if(substr($url[3],0,4) === 'pass'){ echo 'active'; } ?>" href="pass">
                  <span data-feather="lock"></span>
                  Ganti Password
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php if(substr($url[3],0,4) === 'logo'){ echo 'active'; } ?>" href="logout">
                  <span data-feather="arrow-left-circle"></span>
                  Logout
                </a>
              </li>         
            </ul>
          </div>
        </nav>
      </div>
    </div>

    <?php 
    }
    ?>

    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/feather.min.js"></script>
    <script src="../assets/js/Chart.min.js"></script>
    <script type="text/javascript">
        feather.replace({ 'aria-hidden': 'true' })
    </script>
  </body>
</html>