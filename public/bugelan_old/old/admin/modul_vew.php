<?php 
include 'navbar.php';

$id=$_GET['id'];
$modul=myquery("SELECT * FROM modul WHERE id='$id'");
$m=$modul[0];
$km=$m['kode'];
$mapel=myquery("SELECT * FROM mapel WHERE kode='$km'");
$p=$mapel[0];
?>

<style>
  .input-no {
    max-width: 15%;
  }
  .trix-button-group.trix-button-group--file-tools {
    display:none;
  }
</style>

<!-- Trix Editor -->
<link rel="stylesheet" type="text/css" href="../assets/css/trix.css">
<script type="text/javascript" src="../assets/js/trix.js"></script>
<script type="text/javascript" src="../assets/js/attachments.js"></script>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 border-bottom">
      <h1 class="h2">Modul Pelajaran</h1>
      <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <a href="modul_add?kode=<?= $m['kode'] ?>" class="btn btn-sm btn-outline-secondary"><span data-feather="arrow-left"></span> Kembali</a>
        </div>
      </div>
    </div>
  </div>
  <br/>

  <div class="container-fluid mb-3">
    <div class="row mb-3">
        <div class="col-3 col-xl-2">
            <label class="form-label h6">Mata Pelajaran</label> 
        </div>
        <div class="col-9 col-xl-10">
            <label class="form-label h6">: <?= $p['mapel'] ?></label> 
        </div>
        <div class="col-3 col-xl-2">
            <label class="form-label h6">Kelas</label> 
        </div>
        <div class="col-9 col-xl-10">
            <label class="form-label h6">: <?= $p['kelas'] ?></label> 
        </div>
        <div class="col-3 col-xl-2">
            <label class="form-label h6">Nama Guru</label> 
        </div>
        <div class="col-9 col-xl-10">
            <label class="form-label h6">: <?= $p['guru'] ?></label> 
        </div>
        <div class="col-3 col-xl-2">
            <label class="form-label h6">Tema</label> 
        </div>
        <div class="col-9 col-xl-10">
            <label class="form-label h6">: <?= $m['tema'] ?></label> 
        </div>
    </div>

    <div class="row border-bottom border-top py-3">
        <div class="col-4">
            <label class="form-label">Target :</label> 
            <textarea type="text" class="form-control"><?= $m['target'] ?></textarea>
        </div>
        <div class="col-4">
            <label class="form-label">Indikator :</label> 
            <textarea type="text" class="form-control"><?= $m['indikator'] ?></textarea>
        </div>
        <div class="col-4">
            <label class="form-label">Media :</label> 
            <textarea type="text" class="form-control"><?= $m['media'] ?></textarea>
        </div>
    </div>
  </div>

  <h5 class="text-center">BAB <?= substr($m['no'],2,1) ?></h5>
  <h5 class="text-center mb-3"><?= $m['bab'] ?></h5>

  <div class="container-fluid p-4">
    <h6 class="mb-4"><?= substr($m['no'],4,1) .'. '. $m['sub'] ?></h6>
    <div style="text-align:justify;"><?= $m['materi'] ?></div>
  </div>
</main>

<script type="text/javascript">
    feather.replace({ 'aria-hidden': 'true' });
    document.addEventListener('trix-file-accept', function(e){
      e.preventDefault(); 
    });
</script>
