<?php
$this->extend('template/admin');
$this->section('content');
?>

<link href="<?= base_url() ?>/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet">

<style>
    .this-btn {
        padding-top: 1.75rem;
    }
</style>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Laporan</h1>
    </div>
    <form action="/admin/rekap/absensi" method="POST">
        <div class="row">
            <div class='col-md-5 mb-2'>
                <label class='form-label' for='tabel'>Tabel</label>
                <select type='text' class='form-select' name='tabel' id='tabel'>
                    <option value=''>.. pilih ..</option>
                    <option>absensi</option>
                </select>
            </div>
            <div class='col-md-3 mb-2'>
                <label class='form-label' for='tgl_awal'>Tanggal Awal</label>
                <input type="text" class="form-control" name="tgl_awal" id="tgl_awal" autocomplete="off">
            </div>
            <div class='col-md-3 mb-2'>
                <label class='form-label' for='tgl_ahir'>Tanggal Ahir</label>
                <input type="text" class="form-control" name="tgl_ahir" id="tgl_ahir" autocomplete="off">
            </div>
            <div class='this-btn col-md-1 mb-2'>
                <button type="submit" class="btn btn-primary w-100"><span data-feather="printer"></span></button>
            </div>
        </div>
    </form>
</main>
<script src="<?= base_url() ?>/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script>
    $('#tgl_awal').datepicker({
        autoclose: true,
        todayHighlight: true,
        format: 'yyyy-mm-dd'
    });
    $('#tgl_ahir').datepicker({
        autoclose: true,
        todayHighlight: true,
        format: 'yyyy-mm-dd'
    });
</script>
<?php $this->endSection();  ?>