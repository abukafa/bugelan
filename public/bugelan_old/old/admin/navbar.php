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
    $user=myquery("select * from admin where uname='$use'");
    $u=$user[0];
    ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>BUGELAN | Admin</title>
    <link rel="shortcut icon" href="../assets/logo/logo_black.png">
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="../assets/css/navbar.css" rel="stylesheet">
    <link href="../assets/css/sweetalert.css" rel="stylesheet">

    <style>
      .bd-aside .btn::before {
        width: 1.25em;
        line-height: 0;
        content: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='rgba%280,0,0,.5%29' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M5 14l6-6-6-6'/%3e%3c/svg%3e");
        transition: transform .35s ease;

        /* rtl:raw:
        transform: rotate(180deg) translateX(-2px);
        */
        transform-origin: .5em 50%;
      }
      .bd-aside .btn[aria-expanded="true"]::before {
        transform: rotate(90deg)/* rtl:ignore */;
      }
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
      <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="/"><img src="../assets/logo/logo_white.png"  width="40" height="35"></a>
      <button class="navbar-toggler position-absolute d-md-none collapsed mt-1" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <label class="form-control form-control-dark d-none d-md-block" disabled>SISTEM INFORMASI - SMPT BUGELAN</label>
      <li class="nav-item dropdown d-none d-md-inline-block">
        <button class="btn btn-dark mx-2" data-bs-toggle="dropdown"><span data-feather="settings"></span></button>
        <div class="dropdown-menu dropdown-menu-end">
          <a class="dropdown-item" href="user"><i class="align-middle me-1" data-feather="user"></i> Pengguna</a>
          <a class="dropdown-item" href="pass"><i class="align-middle me-1" data-feather="lock"></i> Password</a>
          <!-- <a class="dropdown-item" href="manual"><i class="align-middle me-1" data-feather="help-circle"></i> Manual</a> -->
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="logout"><i class="align-middle me-1" data-feather="arrow-left-circle"></i> Logout</a>
        </div>
      </li>
    </header>

    <div class="container-fluid">
      <?php 
      $url = rtrim($_SERVER['REQUEST_URI'], '/');
      $url = explode('/', $url);
      $myurl = substr($url[2],0,4);
      ?> 
      <div class="row <?php if(substr($url[2],0,10) === 'nilai?nisn' || substr($url[2],0,10) === 'absensi?go' || substr($url[2],0,14) === 'absensiguru?go'){ echo 'd-md-none'; } ?>">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
          <div class="position-sticky pt-md-4">
            <ul class="nav flex-column">
              <li class="nav-item mt-md-2 ms-2">
                <a class="nav-link h6 <?php if($myurl === 'dash'){ echo 'active'; } ?>" aria-current="page" href="dashboard">
                  Dashboard
                </a>
              </li>
              <li class="border-top my-2"></li>
              <aside class="bd-aside nav flex-column text-muted align-self-start mb-3 px-2">
                <a class="btn nav-link d-inline-flex align-items-center collapsed" data-bs-toggle="collapse" aria-expanded="false" data-bs-target="#database-collapse" aria-controls="database-collapse">Database</a>
                <ul class="list-unstyled ps-3 <?php if($myurl<>'guru' && $myurl<>'sisw'){ echo 'collapse'; } ?>" id="database-collapse">
                  <li class="nav-item">
                    <a class="nav-link <?php if($myurl === 'guru'){ echo 'active'; } ?>" href="guru">
                      <span data-feather="file-text"></span>
                      Data Guru
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link <?php if($myurl === 'sisw'){ echo 'active'; } ?>" href="siswa">
                      <span data-feather="file-text"></span>
                      Data Siswa
                    </a>
                  </li>
                </ul>
                <a class="btn nav-link d-inline-flex align-items-center collapsed" data-bs-toggle="collapse" aria-expanded="false" data-bs-target="#pengajaran-collapse" aria-controls="pengajaran-collapse">Pengajaran</a>
                <ul class="list-unstyled ps-3 <?php if($myurl<>'nila' && $myurl<>'abse' && $myurl<>'modu'){ echo 'collapse'; } ?>" id="pengajaran-collapse">
                  <li class="nav-item">
                    <a class="nav-link <?php if($myurl === 'modu'){ echo 'active'; } ?>" href="modul">
                      <span data-feather="book"></span>
                      Modul Ajar
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link <?php if($myurl === 'nila'){ echo 'active'; } ?>" href="nilai">
                      <span data-feather="grid"></span>
                      Nilai Akhir
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link <?php if($myurl === 'abse'){ echo 'active'; } ?>" href="absensi">
                      <span data-feather="bell"></span>
                      Absensi
                    </a>
                  </li>
                </ul>
                <a class="btn nav-link d-inline-flex align-items-center collapsed" data-bs-toggle="collapse" aria-expanded="false" data-bs-target="#administrasi-collapse" aria-controls="administrasi-collapse">Administrasi</a>
                <ul class="list-unstyled ps-3 <?php if($myurl<>'tabu' && $myurl<>'sura'){ echo 'collapse'; } ?>" id="administrasi-collapse">
                  <li class="nav-item <?= $u['access'] == 'User' ? 'd-none' : '' ?>">
                    <a class="nav-link <?php if($myurl === 'sura' || $myurl === 'suratin' ){ echo 'active'; } ?>" href="surat">
                      <span data-feather="mail"></span>
                      Surat menyurat
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link <?php if($myurl === 'tabu'){ echo 'active'; } ?>" href="tabungan">
                      <span data-feather="dollar-sign"></span>
                      Tabungan
                    </a>
                  </li>
                </ul>
                <a class="btn nav-link d-inline-flex align-items-center collapsed" data-bs-toggle="collapse" aria-expanded="false" data-bs-target="#keuangan-collapse" aria-controls="keuangan-collapse">Keuangan</a>
                <ul class="list-unstyled ps-3 <?php if($myurl<>'cash' && $myurl<>'buku' && $myurl<>'akun'){ echo 'collapse'; } ?>" id="keuangan-collapse">
                  <li class="nav-item">
                    <a class="nav-link <?php if($myurl === 'cash'){ echo 'active'; } ?>" href="cash">
                      <span data-feather="shopping-bag"></span>
                      Kas Kecil
                    </a>
                  </li>
                  <li class="nav-item <?= $u['access'] == 'User' ? 'd-none' : '' ?>">
                    <a class="nav-link <?php if($myurl === 'buku'){ echo 'active'; } ?>" href="buku">
                      <span data-feather="shopping-cart"></span>
                      Pembukuan
                    </a>
                  </li>
                  <li class="nav-item <?= $u['access'] == 'User' ? 'd-none' : '' ?>">
                    <a class="nav-link <?php if($myurl === 'akun'){ echo 'active'; } ?>" href="akun">
                      <span data-feather="bar-chart-2"></span>
                      Akuntansi
                    </a>
                  </li>
                </ul>
              </aside>

              <li class="border-top my-3"></li>
              <h5 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-2 mb-1 text-muted">
                <span><?php echo ucfirst($u['name']) ?> - <?php echo ucfirst($u['access']) ?></span>
                <a class="link-secondary" href="#">
                  <span data-feather="check-circle"></span>
                </a>
              </h5> 
              <li class="border-top my-3"></li>
              <li class="nav-item ms-2">
                <a class="nav-link <?php if($myurl === 'user'){ echo 'active'; } ?>" href="user">
                  <span data-feather="users"></span>
                  Pengguna
                </a>
              </li>
              <li class="nav-item ms-2">
                <a class="nav-link <?php if($myurl === 'pass'){ echo 'active'; } ?>" href="pass">
                  <span data-feather="lock"></span>
                  Ganti Password
                </a>
              </li>
              <li class="nav-item ms-2">
                <a class="nav-link <?php if($myurl === 'logo'){ echo 'active'; } ?>" href="logout">
                  <span data-feather="arrow-left-circle"></span>
                  Logout
                </a>
              </li>         
            </ul>
          </div>
        </nav>
      </div>
    </div>

    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/feather.min.js"></script>
    <script src="../assets/js/Chart.min.js"></script>
    <script src="../assets/js/sweetalert.js"></script>
    <script type="text/javascript">
        feather.replace({ 'aria-hidden': 'true' })
    </script>
  </body>
</html>