<?php 
include 'navbar.php';
if(date('m')<7){
  $thn=date('Y')-1;
}else{
  $thn=date('Y');
}
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Data Siswa</h1>
      <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2 <?= $u['access'] == 'User' ? 'd-none' : '' ?>">
          <a href="siswa_edt"><button type="button" class="btn btn-sm btn-outline-secondary"><span data-feather="plus-circle"></span>
          Tambah Baru
        </button></a>
        </div>
        <form action="" method="get">
        <div class="input-group">
          <select type="submit" name="kls" class="btn btn-sm btn-outline-secondary" onchange="this.form.submit()">
            <option value="">.. Filter ..</option>
            <option value="<?= $thn-2 ?>">Kelas 9</option>
            <option value="<?= $thn-1 ?>">Kelas 8</option>
            <option value="<?= $thn ?>">Kelas 7</option>
          </select>
          <a href="siswa_exp?thn=<?= isset($_GET['kls']) ? $_GET['kls'] : '' ?>" type="button" class="btn btn-sm btn-secondary"><span data-feather="download"></span></a>
        </div>
      </form>
      </div>
    </div>
  <?php flash(); 
  if(isset($_GET['kls'])){
      $kls=$_GET['kls'];
      echo "<div class='btn-group float-end'><button type='button' class='btn btn-sm btn-outline-primary'><a href='siswa_lpcard?kls=". $kls ."' target='_blank' style='text-decoration:none'>Kartu Siswa</a><button class='btn btn-sm btn-primary'><span data-feather='printer'></span></button></div><br/>";
  }
  ?>
  </div>

<br/>
  <div class="container-fluid">
    <div class="table-responsive">
      <table class="table table-striped table-hover table-sm">
        <thead>
          <tr>
            <th scope="col" class="d-none d-md-table-cell">No</th>
            <th scope="col">Nomor Induk</th>
            <th scope="col">Nama</th>
            <th scope="col" class="d-none d-md-table-cell">JK</th>
            <th scope="col" class="d-none d-md-table-cell">Kelas</th>
            <th scope="col" class="d-none d-lg-table-cell">TTL</th>
            <th scope="col" class="d-none d-lg-table-cell">Nama Ayah</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <?php 
            if(isset($_GET['kls'])){
              $tahun = $_GET['kls'];
              $query = "select * from siswa where tahun='$tahun' order by jk, nama";
            }else{
              $query = "select * from siswa order by tahun DESC, jk, nama";
            }
            $siswa=mysqli_query($GLOBALS["___mysqli_ston"], $query);
            $no=1;
            while($s=mysqli_fetch_array($siswa)){
            ?>
            <td class="d-none d-md-table-cell"><?= $no ?></td>
            <td><?= $s['nisn'] ?></td>
            <td><?= $s['nama'] ?></td>
            <td class="d-none d-md-table-cell"><?= $s['jk'] ?></td>
            <td class="d-none d-md-table-cell"><?= $thn-$s['tahun']+7 ?></td>
            <td class="d-none d-lg-table-cell"><?= $s['tempat_lahir'] . ', ' . date_format(date_create($s['tanggal_lahir']), "j M Y") ?></td>
            <td class="d-none d-lg-table-cell"><?= $s['nama_ayah'] ?></td>
            <td align="right">    
              <a href="siswa_edt?id=<?php echo $s['id'] ?>" class="btn btn-sm btn-secondary <?= $u['access'] == 'User' ? 'd-none' : '' ?>"><span data-feather="edit"></span></a>
              <a href="siswa_lprt?id=<?php echo $s['id'] ?>" target="_blank" class="d-none d-xl-inline-block btn btn-sm btn-primary"><span data-feather="printer"></span></a>
              <a href="siswa_lpcard?id=<?php echo $s['id'] ?>" target="_blank" class="btn btn-sm btn-primary"><span data-feather="credit-card"></span></a>
              <?php
              if ($u['access']=="Programmer" or $u['access']=="Manager"){
              ?>
              <button class="d-none d-xl-inline-block btn btn-sm btn-danger delete-<?php echo $s['id']; ?>"><span data-feather="trash-2"></span></button></button>
              <script>
                document.querySelector('.delete-<?php echo $s['id']; ?>').onclick = function(){
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
                  location.href="siswa_act?hapus=<?php echo $s['id']; ?>";
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
  </div>
</main>

<script type="text/javascript">
  feather.replace({ 'aria-hidden': 'true' })
</script>