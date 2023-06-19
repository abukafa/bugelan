<?php 
include 'navbar.php';
if(date('m')<7){
  $thn=date('Y')-1;
}else{
  $thn=date('Y');
}
?>
<style>
  .input-no {
    max-width: 15%;
  }
</style>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 border-bottom">
      <h1 class="h2">Modul <?= $_GET['kode'] ?></h1>
      <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <a href="modul" class="btn btn-sm btn-outline-secondary"><span data-feather="arrow-left"></span> Kembali</a>
        </div>
      </div>
    </div>
    <?php flash(); ?>
  </div>
  <br/>

  <?php 
  $km=$_GET['kode'];
  $mapel=myquery("SELECT * FROM mapel WHERE kode='$km'");
  $p=$mapel[0];
  ?>
  <div class="container-fluid <?= $u['name'] == $p['guru'] ? '' : 'd-none' ?>">
    <form class="row g-3 mb-3" action="modul_act?tambah=<?= $_GET['kode'] ?>" method="post">
        <div class="col-md-4">
            <label class="form-label">Tema</label> 
            <div class="input-group">
              <input type="text" class="form-control form-control input-no" name="no_tema" placeholder="No" required>
              <input type="text" class="form-control form-control" name="tema" list="tema" required placeholder="Dalam Satu Bulan" autocomplete="off">
              <datalist id="tema">
                <?php 
                $kode=$_GET['kode'];
                $tema=myquery("SELECT DISTINCT tema FROM modul where kode='$kode'");
                foreach($tema as $te) :
                  echo '<option>'. $te['tema'] .'</option>';
                endforeach;
                ?>
              </datalist>
            </div>
        </div>
        <div class="col-md-4">
            <label class="form-label">BAB</label> 
            <div class="input-group">
              <input type="text" class="form-control form-control input-no" name="no_bab" placeholder="No" required>
              <input type="text" class="form-control form-control" name="bab" list="bab" required placeholder="Dalam Satu Pekan" autocomplete="off">
              <datalist id="bab">
                <?php 
                $kode=$_GET['kode'];
                $tema=myquery("SELECT DISTINCT bab FROM modul where kode='$kode'");
                foreach($tema as $te) :
                  echo '<option>'. $te['bab'] .'</option>';
                endforeach;
                ?>
              </datalist>
            </div>
        </div>
        <div class="col-md-4">
            <label class="form-label">Pembahasan</label> 
            <div class="input-group">
              <input type="text" class="form-control form-control input-no" name="no_judul" placeholder="No" required>
              <input type="text" class="form-control form-control" name="judul" list="sub" required placeholder="Dalam Satu Pertemuan" autocomplete="off">
              <datalist id="sub">
                <?php 
                $kode=$_GET['kode'];
                $tema=myquery("SELECT DISTINCT sub FROM modul where kode='$kode'");
                foreach($tema as $te) :
                  echo '<option>'. $te['sub'] .'</option>';
                endforeach;
                ?>
              </datalist>
            </div>
        </div>
        <div class="col-md-4">
            <label class="form-label">Target</label> 
            <textarea type="text" class="form-control form-control" name="target"></textarea>
        </div>
        <div class="col-md-4">
            <label class="form-label">Indikator</label> 
            <textarea type="text" class="form-control form-control" name="indikator"></textarea>
        </div>
        <div class="col-md-4">
            <label class="form-label">Media</label> 
            <textarea type="text" class="form-control form-control" name="media"></textarea>
        </div>
        <div class="text-end">  
            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
            <a href="modul" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</a>
        </div>
    </form>
  </div>
  
  <div class="container-fluid">
    <div class="table-responsive">
      <table class="table table-striped table-sm">
        <thead>
          <tr>
            <th>No</th>
            <th>Tema</th>
            <th class="d-none d-md-table-cell">BAB</th>
            <th class="d-none d-lg-table-cell">Judul</th>
            <th class="d-none d-lg-table-cell">Catatan</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <?php 
            $no=1;
            $kode=$_GET['kode'];
            $modul=myquery("SELECT * FROM modul WHERE kode='$kode'");
            foreach($modul as $m) :
            ?>
            <td><?php echo $m['no']; ?></td>
            <td><?php echo $m['tema']; ?></td>
            <td class="d-none d-md-table-cell"><?php echo $m['bab']; ?></td>
            <td class="d-none d-lg-table-cell"><?php echo $m['sub']; ?></td>
            <td class="d-none d-lg-table-cell"><?php echo $m['note']; ?></td>
            <td class="text-end">    
              <a href="modul_vew?id=<?= $m['id'] ?>" class="btn btn-sm btn-secondary"><span data-feather="eye"></span></a>
              <a href="modul_edt?id=<?= $m['id'] ?>" class="btn btn-sm btn-secondary <?= $u['name'] == $p['guru'] ? '' : 'd-none' ?>"><span data-feather="edit"></span></a>
              <a class="btn btn-sm btn-danger <?= $u['name'] == $p['guru'] ? '' : 'd-none' ?> delete-<?php echo $m['id'] ?>"><span data-feather="trash-2"></span></a>
              <script>
                document.querySelector('.delete-<?php echo $m['id']; ?>').onclick = function(){
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
                    location.href="modul_act?hapus=<?php echo $m['id']; ?>&kode=<?php echo $m['kode']; ?>";
                  });
                };
                document.getElementById('scanned-QR').focus();
              </script>
            </td>
          </tr>
            <?php
            $no++;
            endforeach;
            ?>
        </tbody>
      </table>
    </div>

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
                    $jsArray .= "guru['" . $g['nama'] . "'] = {nig:'".substr(addslashes($g['nig']),4,2) . "'};\n";
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
