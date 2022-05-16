<?php 
include 'navbar.php';

$uname = $_SESSION['uname'];
$admin = mysqli_query($GLOBALS["___mysqli_ston"], "select * from admin where uname='$uname'");
while($u=mysqli_fetch_array($admin)){
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Data Pengguna (user)</h1>
      <?php
      if ($u['access']=="Programmer" or $u['access']=="Manager"){
      ?>
      <div class="btn-toolbar mb-2 mb-md-0">
        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#staticBackdropLive"><span data-feather="user-plus"></span>
          Pengguna Baru
        </button>
      </div>
      <?php
      } 
      ?>
    </div>
    
    <div class="table-responsive">
      <table class="table table-striped table-sm">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Username</th>
            <th scope="col">Name</th>
            <th scope="col">Access</th>
            <th scope="col">Remark</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          <tr>
          <?php 
          $admin=mysqli_query($GLOBALS["___mysqli_ston"], "select * from admin order by id");
          $no=1;
          while($a=mysqli_fetch_array($admin)){
            $no = sprintf('%04d', $a['id']) ;
          ?>
            <td><?php echo $no ?></td>
            <td><?php echo $a['uname'] ?></td>
            <td><?php echo $a['name'] ?></td>
            <td><?php echo $a['access'] ?></td>
            <td><?php echo $a['remark'] ?></td>
            <td>
              <?php
              if ($u['access']=="Programmer" or $u['access']=="Manager"){
              ?>
              <a onclick="if(confirm('Apakah anda yakin akan menghapus data dengan ID : <?php echo $no; ?> ??')){ location.href='user_delete.php?id=<?php echo $a['id']; ?>' }"><button class="btn btn-sm btn-secondary float-md-end" <?php if($a['access']=="Programmer"){echo "disabled";} ?>><span data-feather="trash-2"></span></button></a>
              <?php
              }
              ?>
            </td>
          </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </div>


    <!-- Modal Entri Data-->
    <div class="modal fade" id="staticBackdropLive" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLiveLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLiveLabel">Tambah Pengguna Baru</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div class="modal-body">
            <form role="form" action="user_add.php" method="post">
              <div class="mb-2">
                <label class="form-label" for="uname">Username</label>
                <input type="text" class="form-control form-control-sm" name="uname" required>
              </div>
              <div class="mb-2">
                <label class="form-label" for="name">Nama Lengkap</label>
                <input type="text" class="form-control form-control-sm" name="name" required>
              </div>
              <div class="mb-2">
                <label class="form-label" for="pass">Password</label> 
                <input type="password" class="form-control form-control-sm" name="pass" id="pass" placeholder="Ketik Password .." required>
              </div>
              <div class="mb-2">
                <input type="password" class="form-control form-control-sm" name="repass" id="repass" placeholder="Ulangi password .." onchange="changeFunction()">
                <div class="invalid-feedback">Password tidak sama ..</div>
                <div class="valid-feedback">Password Sesuai ..</div>
              </div>
              <script>    
                function changeFunction(){  
                var pas = document.getElementById('pass');
                var rpas = document.getElementById('repass');
                  if (rpas.value !== pas.value){
                    rpas.className = "form-control form-control-sm is-invalid";
                  }else if (rpas.value == pas.value){
                    rpas.className = "form-control form-control-sm is-valid";
                  }
                };  
              </script>
              <div class="mb-2">
                <label class="form-label" for="akses">Akses</label>   
                <select class="form-select form-select-sm" name="akses" required>
                  <option value="-">.. pilih ..</option>
                  <option value="User">USER</option>
                  <option value="Supervisor">SUPERVISOR</option>
                  <option value="Manager">MANAGER</option>
                </select>
              </div>
              <div class="mb-2">
                <label class="form-label" for="ket">Keterangan</label>
                <input type="text" class="form-control form-control-sm" name="ket" id="ket" required>
              </div>
              <div class="modal-footer">  
                <button type="submit" class="btn btn-primary btn-sm">Add</button>
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
              </div>
            </form>
          </div>

        </div>
      </div>
    </div>    
  </div>
</main>
<?php 
}
?>

<script type="text/javascript">
    feather.replace({ 'aria-hidden': 'true' })
</script>