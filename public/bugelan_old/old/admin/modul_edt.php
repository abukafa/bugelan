<?php 
include 'navbar.php';

$id=$_GET['id'];
$modul=myquery("SELECT * FROM modul WHERE id='$id'");
$m=$modul[0];
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
      <h1 class="h2">Modul <?= $m['kode'] .' - '. $m['no'] ?></h1>
      <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <a href="modul_add?kode=<?= $m['kode'] ?>" class="btn btn-sm btn-outline-secondary"><span data-feather="arrow-left"></span> Kembali</a>
        </div>
      </div>
    </div>
    <?php flash(); ?>
  </div>
  <br/>

  <div class="container-fluid mb-5">
    <form class="row g-3" action="modul_act?edit=<?= $id ?>" method="post">
        <div class="col-md-4">
            <label class="form-label">Tema</label> 
            <div class="input-group">
              <input type="text" class="form-control form-control input-no" name="no_tema" value="<?= substr($m['no'],0,1) ?>">
              <input type="text" class="form-control form-control" name="tema" value="<?= $m['tema'] ?>" placeholder="Dalam Satu Bulan">
            </div>
        </div>
        <div class="col-md-4">
            <label class="form-label">BAB</label> 
            <div class="input-group">
              <input type="text" class="form-control form-control input-no" name="no_bab" value="<?= substr($m['no'],2,1) ?>">
              <input type="text" class="form-control form-control" name="bab" value="<?= $m['bab'] ?>" placeholder="Dalam Satu Pekan">
            </div>
        </div>
        <div class="col-md-4">
            <label class="form-label">Pembahasan</label> 
            <div class="input-group">
              <input type="text" class="form-control form-control input-no" name="no_judul" value="<?= substr($m['no'],4,1) ?>">
              <input type="text" class="form-control form-control" name="judul" value="<?= $m['sub'] ?>" placeholder="Dalam Satu Pertemuan">
            </div>
        </div>
        <div class="col-md-4">
            <label class="form-label">Target</label> 
            <textarea type="text" class="form-control form-control-sm" name="target"><?= $m['target'] ?></textarea>
        </div>
        <div class="col-md-4">
            <label class="form-label">Indikator</label> 
            <textarea type="text" class="form-control form-control-sm" name="indikator"><?= $m['indikator'] ?></textarea>
        </div>
        <div class="col-md-4">
            <label class="form-label">Media</label> 
            <textarea type="text" class="form-control form-control-sm" name="media"><?= $m['media'] ?></textarea>
        </div>
        <div class="col-md-12">
            <label class="form-label">Catatan</label> 
            <input type="text" class="form-control form-control-sm" name="note" value="<?= $m['note'] ?>">
        </div>
        <div class="col-12">
          <label class="form-label">Materi</label> 
          <textarea type="hidden" class="form-control mb-3 d-none" name="materi" id="materi"><?= $m['materi'] ?></textarea>
          <trix-editor input="materi"></trix-editor>
        </div>
        <div class="text-end">  
            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
            <a href="modul_add?kode=<?= $m['kode'] ?>" class="btn btn-secondary btn-sm">Batal</a>
        </div>
    </form>
  </div>
</main>

<script type="text/javascript">
    feather.replace({ 'aria-hidden': 'true' });
    document.addEventListener('trix-file-accept', function(e){
      e.preventDefault(); 
    });
</script>
