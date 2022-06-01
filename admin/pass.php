<?php 
include 'navbar.php';
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Ganti Password Pengguna</h1>
      <div class="btn-toolbar mb-2 mb-md-0">
      </div>
    </div>
  </div>

  <body>  
    <div class="container"> 
      <?php 
      if(isset($_GET['pesan'])){
      $pesan=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_GET['pesan']);
      if($pesan=="oke"){
        echo "<center><div class='alert alert-success'>Password telah dirubah  !!     Terima kasih !! </div></center>";
      }else if($pesan=="tdksama"){
        echo "<center><div class='alert alert-warning'>Password yang anda masukkan tidak sesuai  !!     silahkan ulangi !! </div></center>";
      }else if($pesan=="gagal"){
        echo "<center><div class='alert alert-danger'>Password gagal di ganti !!     Periksa Kembali Password yang anda masukkan !!</div></center>";
      }
      }
      ?>
    </div>

    <br/>

    <div class="container-fluid">
      <form action="pass_act" method="post">
        <div class="col-md-4 col-md-offset-4">
          <div class="mb-2">
            <label class="form-label">Username</label>
            <input name="user" type="text" class="form-control form-control-sm" value="<?php echo $_SESSION['uname']; ?>" readonly>
          </div>
          <div class="mb-2">
            <label class="form-label">Password Lama</label>
            <input name="lama" type="password" class="form-control form-control-sm" placeholder="Password Lama .." required>
          </div>
          <div class="mb-2">
            <label class="form-label">Password Baru</label>
            <input name="baru" id="baru" type="password" class="form-control form-control-sm" placeholder="Password Baru .."required>
          </div>
          <div class="mb-2">
            <label class="form-label">Ulangi Password</label>
            <input name="ulang" id="ulang" type="password" class="form-control form-control-sm" placeholder="Ulangi Password .." onchange="sameCheck()">
            <div class="invalid-feedback">Password tidak sama ..</div>
            <div class="valid-feedback">Password Sesuai ..</div>
          </div>
          <script>    
            function sameCheck(){  
            var pas = document.getElementById('baru');
            var rpas = document.getElementById('ulang');
              if (rpas.value !== pas.value){
                rpas.className = "form-control form-control-sm is-invalid";
              }else if (rpas.value == pas.value){
                rpas.className = "form-control form-control-sm is-valid";
              }
            };  
          </script>  
          <div class="mb-2">
            <input type="submit" class="btn btn-primary btn-sm" value="Simpan">
            <input type="reset" class="btn btn-secondary btn-sm" value="Reset">
          </div>                    
        </div>    
      </form>
    </div>
  </body>
</main>