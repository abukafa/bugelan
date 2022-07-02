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
      <h1 class="h2">Modul Ajar</h1>
      <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <a class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#staticBackdropLive"><span data-feather="plus-circle"></span> Pelajaran Baru</a>
        </div>
        <form action="" method="get">
          <select type="submit" name="kls" class="btn btn-sm btn-outline-secondary" onchange="this.form.submit()">
            <option value="">.. Filter ..</option>
            <option value="7">Kls 7</option>
            <option value="8">Kls 8</option>
            <option value="9">Kls 9</option>
          </select>
        </form>
      </div>
    </div>
    <?php flash(); ?>
  
    <?php  
    $query="SELECT * from mapel";
    $jumlah_record=mysqli_query($conn, $query);
    $record=mysqli_query($conn, $query);
    $per_hal=30;
    $jum=mysqli_num_rows($jumlah_record);
    $item=mysqli_num_rows($record);
    $halaman=ceil($jum / $per_hal);
    $page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
    $start = ($page - 1) * $per_hal;

    if(isset($_GET['kls'])){
      $kls=$_GET['kls'];
      $query.=" WHERE kelas='$kls'";
      $mapel=mysqli_query($conn, $query);
      $jumlah_record=mysqli_query($conn, $query);
      $jum=mysqli_num_rows($jumlah_record);
    //   echo "<div class='btn-group float-end'><button type='button' class='btn btn-sm btn-outline-primary'><a href='modul=". $kls ."' target='_blank' style='text-decoration:none'>Rekap</a></button><button type='button' class='btn btn-sm btn-outline-primary'><a href='buku_lpindex' target='_blank' style='text-decoration:none'>Index</a></button><button class='btn btn-sm btn-primary'><span data-feather='printer'></span></button></div>";
      echo "<h6 class='fw-bold'><a style='color:blue'>". $jum ." Mata Pelajaran - Kelas ". $kls ."</a></h6>";
          
    }else{
      $mapel=mysqli_query($conn, $query);
      echo "<h6 class='fw-bold'><a style='color:blue'>". $jum ." Mata Pelajaran</a></h6>";
    }
    ?>
  </div>
  <br/>
  <div class="container-fluid">
    <div class="table-responsive">
      <table class="table table-striped table-sm">
        <thead>
          <tr>
            <th>No</th>
            <th>Kode</th>
            <th class="d-none d-md-table-cell">Mata Pelajaran</th>
            <th class="d-none d-lg-table-cell">Kelas</th>
            <th class="d-none d-lg-table-cell">Guru</th>
            <th>Item</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <?php 
            $no=1;
            while($m=mysqli_fetch_array($mapel)){
            ?>
            <td><?php echo $no; ?></td>
            <td><?php echo $m['kode']; ?></td>
            <td class="d-none d-md-table-cell"><?php echo $m['mapel']; ?></td>
            <td class="d-none d-lg-table-cell"><?php echo $m['kelas']; ?></td>
            <td class="d-none d-lg-table-cell"><?php echo $m['guru']; ?></td>
            <?php
            $km=$m['kode'];
            $dat=mysqli_query($conn, "SELECT * from modul where kode='$km'");
              $item = $dat ? mysqli_num_rows($dat) : 0; 
            ?>
            <td><?php echo number_format($item,0,'',',') ?></td>
            <td class="text-end">    
              <a href="modul_add?kode=<?= $m['kode'] ?>" class="btn btn-sm btn-secondary"><span data-feather="edit"></span></a>
              <a class="btn btn-sm btn-danger <?= $item<>0 ? 'disabled' : '' ?>" id="delete-<?= $m['kode']; ?>"><span data-feather="trash-2"></span></a>
              <script>
                document.querySelector('#delete-<?= $m['kode']; ?>').onclick = function(){
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
                    location.href="modul_act?deleteMapel=<?= $m['kode'] ?>";
                  });
                };
              </script>
            </td>
          </tr>
            <?php
            $no++;
            }
            ?>
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    <?php 
    if(!isset($_GET['kls'])){
    ?>
    <ul class="pagination">     
      <li class="page-item">
        <a class="page-link" href="?page=1"><span data-feather="skip-back"></span></a>
      </li>
      <li>
        <a class="page-link" href="<?php if($page <= 1){ echo '#'; } else { echo "?page=".($page - 1); } ?>"><span data-feather="rewind"></span></a>
      </li>
      <li class="page-item">
        <a class="page-link"><?php echo $page . " / " . $halaman ?></a>
      </li>
      <li>
        <a class="page-link" href="<?php if($page >= $halaman){ echo '#'; } else { echo "?page=".($page + 1); } ?>"><span data-feather="fast-forward"></span></a>
      </li> 
      <li class="page-item">
        <a class="page-link" href="?page=<?php echo $halaman ?>"><span data-feather="skip-forward"></span></a>
      </li>        
    </ul>
    <?php 
    }
    ?>

    <!-- Modal Entri Data-->
    <div class="modal fade" id="staticBackdropLive" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLiveLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLiveLabel">Tambah Pelajaran</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div class="modal-body">
            <form role="form" action="modul_act?mapel" method="post">
              <div class="mb-2">
                <label class="form-label" for="kode">Kode Mapel</label>
                <input type="text" class="form-control form-control-sm" name="kode" id="kode" readonly>
              </div>
              <div class="mb-2">
                <label class="form-label" for="kel">Kelompok</label>
                <select type="text" class="form-select form-select-sm" name="kel" id="kel" required>
                  <option value="">.. pilih ..</option>
                  <option value="A">Kelompok A</option>
                  <option value="B">Kelompok B</option>
                  <option value="Mulok">Muatan Lokal</option>
                  <option value="Tematik">Tematik</option>
                </select>
              </div>
              <div class="mb-2">
                <label class="form-label" for="mapel">Mata Pelajaran</label>
                <select type="text" class="form-select form-select-sm" name="mapel" id="mapel" onchange="generateCode()" required>
                  <option value="">.. pilih ..</option>
                  <option>PAI</option>
                  <option>PPKN</option>
                  <option>B. INDONESIA</option>
                  <option>MATEMATIKA</option>
                  <option>IPA</option>
                  <option>IPS</option>
                  <option>B. INGGRIS</option>
                  <option>SENI BUDAYA</option>
                  <option>PJOK</option>
                  <option>PRAKARYA</option>
                  <option>B. SUNDA</option>
                  <option>TEMATIK</option>
                </select>
              </div>
              <div class="mb-2">
                <label class="form-label" for="kls">Kelas</label>
                <select type="text" class="form-select form-select-sm" name="kls" id="kls" onchange="generateCode()" required>
                  <option value="">.. pilih ..</option>
                  <option>7</option>
                  <option>8</option>
                  <option>9</option>
                </select>
              </div>
              <div class="mb-2">
                <label class="form-label" for="guru">Guru</label>
                <select type="text" class="form-select form-select-sm" name="guru" id="guru" onchange="generateCode()" required>
                  <option value="">.. pilih ..</option>
                    <?php 
                    $guru=mysqli_query($conn, "select * from guru order by id");
                    $jsArray = "var guru = new Array();\n";        
                    while($g=mysqli_fetch_array($guru)){
                    echo '<option>' . $g['nama'] . '</option>';
                    $jsArray .= "guru['" . $g['nama'] . "'] = {nig:'".substr(addslashes($g['nig']),6,3) . "'};\n";
                    }
                    ?>
                </select>
              </div>

              <script>    
                <?php echo $jsArray; ?>  
                function generateCode(){  
                    var mapel = document.getElementById('mapel').value;
                    var kls = document.getElementById('kls').value;
                    var id = document.getElementById('guru').value;
                    var nig = id=='' ? '' : guru[id].nig;
                    switch (mapel){
                    case 'PPKN' :
                        km = 'PKN';
                        break;
                    case 'B. INDONESIA' :
                        km = 'BID';
                        break;
                    case 'MATEMATIKA' :
                        km = 'MTK';
                        break;
                    case 'B. INGGRIS' :
                        km = 'BIG';
                        break;
                    case 'SENI BUDAYA' :
                        km = 'SBY';
                        break;
                    case 'PJOK' :
                        km = 'PJK';
                        break;
                    case 'PRAKARYA' :
                        km = 'PRK';
                        break;
                    case 'B. SUNDA' :
                        km = 'BSD';
                        break;
                    default :
                        km = mapel.substring(0,3);
                    }
                    document.getElementById('kode').value = km + kls + nig ;
                };  
              </script>
              <div class="mb-2">
                <label class="form-label" for="note">Catatan</label> 
                <input type="text" class="form-control form-control-sm" name="note">
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

<script type="text/javascript">
    feather.replace({ 'aria-hidden': 'true' })
</script>
