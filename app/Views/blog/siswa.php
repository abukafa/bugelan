<?php
$this->extend('template/main');
$this->section('content');
?>

<style>
    .w5 {
        max-width: 50px;
    }
</style>

<?php if ($idm) { ?>
    <div class="row d-flex justify-content-center mt-4">
        <div class="col-lg-6">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailLabel">Data Siswa</h5>
                    <a href="/siswa/<?= $siswa['tahun'] ?>" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <img src="<?= uploaded($siswa['id'] . '.png', 'img/profile') ?>" class="img rounded-circle mb-4 w-50" />
                        <h3><?= $siswa['nama'] ?></h3>
                    </div>
                    <div class="row my-4">
                        <div class="col-6 text-end">Tgl Lahir :</div>
                        <div class="col-6"><?= $siswa['tanggal_lahir'] ?></div>
                        <div class="col-6 text-end">Asal :</div>
                        <div class="col-6"><?= $siswa['kecamatan'] ?></div>
                        <div class="col-6 text-end">E-mail :</div>
                        <div class="col-6"><?= $siswa['email'] ?></div>
                    </div>
                    <div class="text-center mb-4">
                        <h5>Progress Keaktifan</h5>
                    </div>
                    <div class="">
                        <canvas id="absen"></canvas>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="Https://wa.me/<?= $siswa['telepon'] ?>" type="button" class="btn btn-success"><i class="fa fa-whatsapp" aria-hidden="true"></i></a>
                    <a href="/siswa" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
                </div>
            </div>
        </div>
    </div>
    <?php
    $hadir1 = $hadir2 = $hadir3 = $hadir4 = $hadir5 = $hadir6 = 0;
    foreach ($absensi as $abs) {
        if ($abs['tanggal'] == date('Y-m-d')) {
            $hadir1 = $abs['jam1'] + $abs['jam2'] + $abs['jam3'] + $abs['jam4'] + $abs['jam5'];
        }
        if ($abs['tanggal'] == date('Y-m-d', strtotime("-1 days"))) {
            $hadir2 = $abs['jam1'] + $abs['jam2'] + $abs['jam3'] + $abs['jam4'] + $abs['jam5'];
        }
        if ($abs['tanggal'] == date('Y-m-d', strtotime("-2 days"))) {
            $hadir3 = $abs['jam1'] + $abs['jam2'] + $abs['jam3'] + $abs['jam4'] + $abs['jam5'];
        }
        if ($abs['tanggal'] == date('Y-m-d', strtotime("-3 days"))) {
            $hadir4 = $abs['jam1'] + $abs['jam2'] + $abs['jam3'] + $abs['jam4'] + $abs['jam5'];
        }
        if ($abs['tanggal'] == date('Y-m-d', strtotime("-4 days"))) {
            $hadir5 = $abs['jam1'] + $abs['jam2'] + $abs['jam3'] + $abs['jam4'] + $abs['jam5'];
        }
        if ($abs['tanggal'] == date('Y-m-d', strtotime("-5 days"))) {
            $hadir6 = $abs['jam1'] + $abs['jam2'] + $abs['jam3'] + $abs['jam4'] + $abs['jam5'];
        }
    }
    ?>
    <script src="<?= base_url() ?>/js/chart.min.js"></script>
    <script>
        const dh1 = <?= $hadir1 ?>;
        const dh2 = <?= $hadir2 ?>;
        const dh3 = <?= $hadir3 ?>;
        const dh4 = <?= $hadir4 ?>;
        const dh5 = <?= $hadir5 ?>;
        const dh6 = <?= $hadir6 ?>;
        const h1 = new Date();
        const h2 = new Date();
        const h3 = new Date();
        const h4 = new Date();
        const h5 = new Date();
        const h6 = new Date();
        const options = {
            weekday: 'long'
        };
        h2.setDate(h2.getDate() - 1);
        h3.setDate(h3.getDate() - 2);
        h4.setDate(h4.getDate() - 3);
        h5.setDate(h5.getDate() - 4);
        h6.setDate(h6.getDate() - 5);
        const ctx = $('#absen');
        const data = {
            labels: [
                h6.toLocaleDateString('en-US', options),
                h5.toLocaleDateString('en-US', options),
                h4.toLocaleDateString('en-US', options),
                h3.toLocaleDateString('en-US', options),
                h2.toLocaleDateString('en-US', options),
                h1.toLocaleDateString('en-US', options)
            ],
            datasets: [{
                label: 'Keaktifan',
                data: [dh6, dh5, dh4, dh3, dh2, dh1],
                backgroundColor: [
                    'rgb(255, 205, 86, .5)'
                ],
                hoverOffset: 4
            }]
        };
        new Chart(ctx, {
            type: 'line',
            data: data,
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                legend: {
                    display: false
                }
            }
        });
    </script>
<?php } ?>

<?php if (!$idm) { ?>
    <div class="row g-5 mt-2 px-2">
        <div class="col">
            <article class="blog-post">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap ">
                    <div class="col-6">
                        <h2 class="blog-post-title">Siswa SMPT Bugelan</h2>
                        <p class="blog-post-meta mb-5">Periode <?= $profil['periode'] . '-' . ($profil['periode'] + 1) ?></p>
                    </div>
                    <div class="col-6 text-end pt-2">
                        <button type="button" class="btn btn-sm btn-outline-success dropdown-toggle" id="dropdownFilter" data-bs-toggle="dropdown" aria-expanded="true">
                            <span data-feather="user"></span>
                            Kelas
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownFilter" data-popper-placement="bottom-start" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(0px, 40px, 0px);">
                            <li>
                                <h6 class="dropdown-header">Tampilkan Data</h6>
                            </li>
                            <li><a class="dropdown-item" href="/siswa/<?= tahun(7) ?>">Kelas VII</a></li>
                            <li><a class="dropdown-item" href="/siswa/<?= tahun(8) ?>">Kelas VIII</a></li>
                            <li><a class="dropdown-item" href="/siswa/<?= tahun(9) ?>">Kelas IX</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="/siswa">Semua Data</a></li>
                        </ul>
                    </div>
                </div>

                <table class="table table-hover align-middle">
                    <tr>
                        <th>Pic</th>
                        <th class="d-none d-lg-table-cell">No. Induk</th>
                        <th>Nama</th>
                        <th class="d-none d-md-table-cell">Kelas</th>
                        <th>Keaktifan</th>
                    </tr>
                    <?php foreach ($siswa as $row) : ?>
                        <tr>
                            <td><a href="/siswa/<?= $row['tahun'] . '/' . $row['id'] ?>"><img src="<?= uploaded(($row) ? $row['id'] . '.png' : '', '/img/profile') ?>" class="w5 rounded-circle"></a></td>
                            <td class="d-none d-lg-table-cell"><?= $row['ni'] ?></td>
                            <td><?= $row['nama'] ?></td>
                            <td class="d-none d-md-table-cell"><?= kelas($row['tahun']) ?></td>
                            <td>
                                <div class="progress">
                                    <?php
                                    $jumlah = 0;
                                    $normal = 0;
                                    foreach ($absensi as $item) :
                                        if ($item['idm'] == $row['id']) {
                                            $jam = $item['jam1'] + $item['jam2'] + $item['jam3'] + $item['jam4'] + $item['jam5'];
                                            $jumlah += $jam;
                                            $normal += 5;
                                        }
                                    endforeach;
                                    if ($jumlah == 0) { ?>
                                        <div class="progress-bar bg-danger w-0" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                    <?php
                                    } else {
                                        $abs = round(($jumlah / $normal) * 100);
                                    ?>
                                        <?php if ($abs > 75) { ?>
                                            <div class="progress-bar bg-primary w-100" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"><?= $abs ?> %</div>
                                        <?php } else if ($abs > 50) { ?>
                                            <div class="progress-bar bg-success w-75" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"><?= $abs ?> %</div>
                                        <?php } else if ($abs > 25) { ?>
                                            <div class="progress-bar bg-warning w-50" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"><?= $abs ?> %</div>
                                        <?php } else { ?>
                                            <div class="progress-bar bg-danger w-25" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?= $abs ?> %</div>
                                    <?php }
                                    } ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </article>
        </div>
    </div>
<?php } ?>

<?php $this->endSection();  ?>