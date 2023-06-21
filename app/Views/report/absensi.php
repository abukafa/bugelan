<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Absensi</title>
    <link rel="shortcut icon" href="<?= base_url() ?>/img/logo/yayasan.png">
    <link href="<?= base_url() ?>/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css" media="print">
        @page {
            size: landscape;
        }
    </style>
</head>
<body>
    <div class="container-fluid" id="target">
        <img src="<?= base_url() ?>/img/logo/kop.png" width="100%" alt="kop">
        <hr>
        <div class="text-center mt-2">
            <h3>Rekap Absensi</h3>
            <h6><?= $tgl_awal . ' s.d. ' . $tgl_ahir ?></h6>
        </div>
        <table class="table table-sm table-bordered mt-4">
            <tr class="text-center">
                <th rowspan="2" class="align-middle">No</th>
                <th rowspan="2" class="align-middle">Nama</th>
                <th rowspan="2" class="align-middle">Kelas</th>
                <th colspan="3">Absen</th>
            </tr>
            <tr class="text-center">
                <th>Sakit</th>
                <th>Ijin</th>
                <th>Alpa</th>
            </tr>
            <?php
            foreach ($absen as $key => $value) { ?>
                <tr>
                    <td class="text-center"><?= $key + 1 ?></td>
                    <td class="text-left"><?= $value->nama ?></td>
                    <td class="text-center"><?= kelas($value->tahun) ?></td>
                    <td class="text-center"><?= $value->sakit ?></td>
                    <td class="text-center"><?= $value->ijin ?></td>
                    <td class="text-center"><?= $value->alpa ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>