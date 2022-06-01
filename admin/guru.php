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
        <div class="btn-group me-2">
          <a href="guru_edt"><button type="button" class="btn btn-sm btn-outline-secondary"><span data-feather="plus-circle"></span>
          Tambah Baru
        </button></a>
        </div>
      </div>
    </div>
  </div>

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
            <!-- <td><?= $g['tempat_lahir'] . ', ' . date_format(date_create($g['tanggal_lahir']), "d M Y") ?></td> -->
            <td class="d-none d-md-table-cell"><?= $g['ket'] ?></td>
            <td align="right">    
              <a href="guru_edt?id=<?php echo $g['id'] ?>" class="btn btn-sm btn-secondary"><span data-feather="edit"></span></a>
              <a href="guru_lprt?id=<?php echo $g['id'] ?>" target="_blank" class="d-none d-xl-inline-block btn btn-sm btn-secondary"><span data-feather="printer"></span></a>
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