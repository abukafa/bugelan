<?php 
include 'navbar.php';

$uname = $_SESSION['uname'];
$admin = mysqli_query($conn, "select * from admin where uname='$uname'");
while($u=mysqli_fetch_array($admin)){
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Akuntansi</h1>
      <?php
      if ($u['access']=="Programmer" or $u['access']=="Manager"){
      ?>
      <div class="btn-toolbar mb-2 mb-md-0">
        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#staticBackdropLive"><span data-feather="plus-circle"></span>
          Akun Baru
        </button>
      </div>
      <?php
      } 
      flash()
      ?>
    </div>
    
    <div class="table-responsive">
      <table class="table table-striped table-sm">
        <thead>
          <tr>
            <th scope="col" class="d-none d-md-table-cell">No</th>
            <th scope="col">Kode</th>
            <th scope="col" class="d-none d-md-table-cell">Unit</th>
            <th scope="col">Nama</th>
            <th scope="col" class="d-none d-lg-table-cell">Deskripsi</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          <tr>
          <?php 
          $no=1;
          $akun=mysqli_query($conn, "select * from account order by code");
          while($a=mysqli_fetch_array($akun)){
          ?>
            <td class="d-none d-md-table-cell"><?php echo $no ?></td>
            <td><?php echo $a['code'] ?></td>
            <td class="d-none d-md-table-cell"><?php echo $a['unit'] ?></td>
            <td><?php echo $a['name'] ?></td>
            <td class="d-none d-lg-table-cell"><?php echo $a['des'] ?></td>
            <td>
            <?php
            if ($u['access']=="Programmer" or $u['access']=="Manager"){
            ?>
              <button class="btn btn-sm btn-danger d-none d-md-inline-block float-md-end delete-<?php echo $a['code']; ?>"><span data-feather="trash-2"></span></button></button>
              <script>
                document.querySelector('.delete-<?php echo $a['code']; ?>').onclick = function(){
                swal({
                  title: "Yakin?",
                  text: "Data tidak bisa dikembalikan!",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonClass: "btn-danger",
                  confirmButtonText: "Delete",
                  closeOnConfirm: false
                },
                function(){
                  location.href="akun_act?hapus=<?php echo $a['code']; ?>";
                });
                };
              </script>
            <?php
            } 
            ?>
            </td>
          </tr>
          <?php
          $no++;
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
            <h5 class="modal-title" id="staticBackdropLiveLabel">Tambah Akun Baru</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div class="modal-body">
            <form role="form" action="akun_act?tambah" method="post">
              <?php
              $query = mysqli_query($conn, "SELECT max(code) as besar FROM account");
              $data = mysqli_fetch_array($query);
              $de = $data['besar'];
              $urutan = (int) substr($de, 2, 3);
              $urutan = $urutan+1;
              $kd = sprintf("%03s", $urutan);
              ?>
              <div class="mb-2">
                <label class="form-label" for="kode">Kode Akun</label>
                <input type="hidden" class="form-control form-control-sm" id="kd" value="<?php echo $kd; ?>">
                <input type="text" class="form-control form-control-sm" name="kod" id="kod">
              </div>
              <div class="mb-2">
                <label class="form-label" for="unit">Kategori</label>
                <select type="text" class="form-select form-select-sm" name="unit" id="unit" onchange="changeValue(this.value)" required>
                  <option value="">.. pilih ..</option>
                  <option value="Aktiva">11 - Aktiva : Kekayaan milik Lembaga</option>
                  <option value="Ekuitas">22 - Ekuitas : Kekayaan bersumber dari Pemilik</option>
                  <option value="Pendapatan">33 - Pendapatan : Lain-lain</option>
                  <option value="Biaya">44 - Biaya : Kebutuhan Lembaga</option>
                </select>
              </div>
              <script>    
                function changeValue(unit){  
                var unit = document.getElementById('unit').value;
                var kode = document.getElementById('kd').value;
                  if (unit==""){
                    document.getElementById('kod').value = "";
                  }else if (unit=="Aktiva"){
                    document.getElementById('kod').value = 11 +kode;
                  }else if (unit=="Ekuitas"){
                    document.getElementById('kod').value = 22 +kode;
                  }else if (unit=="Pendapatan"){
                    document.getElementById('kod').value = 33 +kode;
                  }else if (unit=="Biaya"){
                    document.getElementById('kod').value = 44 +kode;
                  }
                };  
              </script>
              <div class="mb-2">
                <label class="form-label" for="nama">Nama Akun</label> 
                <input type="text" class="form-control form-control-sm" name="nama" required>
              </div>
              <div class="mb-2">
                <label class="form-label" for="des">Deskripsi</label>
                <input type="textarea" class="form-control form-control-sm" name="des" required>
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