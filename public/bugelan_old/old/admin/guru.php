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
      <h1 class="h2">Data Guru</h1>
      <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2 <?= $u['access'] == 'User' ? 'd-none' : '' ?>">
          <a href="guru_edt"><button type="button" class="btn btn-sm btn-outline-secondary"><span data-feather="plus-circle"></span>
          Tambah Baru
        </button></a>
        </div>
        <a href="guru_lpcard" target="_blank" class="btn btn-sm btn-outline-secondary me-2"><span data-feather="credit-card"></span></a>
        <a href="absensiguru" class="btn btn-sm btn-secondary me-2 <?= $u['access'] == 'User' ? 'd-none' : '' ?>"><span data-feather="airplay"></span></a>
      </div>
    </div>
  </div>
  <?php flash() ?>

  <div class="container-fluid">
    <div class="table-responsive">
      <table class="table table-striped table-sm">
        <thead>
          <tr>
            <th scope="col" class="d-none d-md-table-cell">No</th>
            <th scope="col">NIG</th>
            <th scope="col">Nama</th>
            <th scope="col">JK</th>
            <th scope="col" class="d-none d-md-table-cell">TTL</th>
            <th scope="col" class="d-none d-md-table-cell">Ket</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <?php 
            $guru=mysqli_query($GLOBALS["___mysqli_ston"], "select * from guru order by nig");
            $no=1;
            while($g=mysqli_fetch_array($guru)){
            ?>
            <td class="d-none d-md-table-cell"><?= $no ?></td>
            <td><?= $g['nig'] ?></td>
            <td><?= $g['nama'] ?></td>
            <td><?= $g['jk'] ?></td>
            <td class="d-none d-md-table-cell"><?= $g['tempat_lahir'] . ', ' . $g['tanggal_lahir'] ?></td>
            <td class="d-none d-md-table-cell"><?= $g['ket'] ?></td>
            <td align="right">    
              <a href="guru_edt?id=<?php echo $g['id'] ?>" class="btn btn-sm btn-secondary <?= $u['name'] == $g['nama'] || $u['access'] <> 'User' ? '' : 'disabled' ?>"><span data-feather="edit"></span></a>
              <a href="guru_lpcard?id=<?php echo $g['id'] ?>" target="_blank" class="btn btn-sm btn-primary"><span data-feather="credit-card"></span></a>
              <?php
              if ($u['access']=="Programmer" or $u['access']=="Manager"){
              ?>
              <button class="d-none d-md-inline-block btn btn-sm btn-danger delete-<?php echo $g['id']; ?>"><span data-feather="trash-2"></span></button></button>
              <script>
                document.querySelector('.delete-<?php echo $g['id']; ?>').onclick = function(){
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
                  location.href="guru_act?hapus=<?php echo $g['id']; ?>";
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