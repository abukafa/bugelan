<?php
$this->extend('template/main');
$this->section('content');
?>

<div class="row d-flex justify-content-center mt-4 <?= ($idm) ?: 'd-none' ?>">
    <div class="col-lg-6">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailLabel">Portofolio</h5>
                <a href="/pengajar" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
            </div>
            <?php if ($idm) { ?>
                <div class="modal-body">
                    <div class="text-center">
                        <img src="<?= uploaded($guru['id'] . '.png', 'img/profile') ?>" class="img rounded-circle mb-4 w-50" />
                        <h3><?= $guru['nama'] ?></h3>
                        <div>
                            <?php
                            $ket = explode(',', $guru['ket']);
                            for ($i = 0; $i < count($ket); $i++) {
                            ?>
                                <span class="badge rounded-pill bg-primary"><?= $ket[$i] ?></span>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="row my-4">
                        <div class="col-6 text-end">Tgl Lahir :</div>
                        <div class="col-6"><?= $guru['tanggal_lahir'] ?></div>
                        <div class="col-6 text-end">Asal :</div>
                        <div class="col-6"><?= $guru['kecamatan'] ?></div>
                        <div class="col-6 text-end">E-mail :</div>
                        <div class="col-6"><?= $guru['email'] ?></div>
                    </div>
                    <div class="mb-4">
                        <h5 class="text-center mb-3">Pendidikan</h5>
                        <ul class="list-group">
                            <?php foreach ($kompetensi as $item) :
                                if ($item['jenis'] == 'Pendidikan') {
                                    $thn = date_format(date_create($item['tgl_ahir']), 'Y');
                                    if (date('Y') == $thn) { ?>
                                        <li class="list-group-item"><?= $item['tempat'] ?> - <em><?= $item['subjek'] ?></em><span class="badge rounded-pill bg-warning float-end">now</span></li>
                                    <?php } else { ?>
                                        <li class="list-group-item"><?= $item['tempat'] ?> - <em><?= $item['subjek'] ?></em><span class="badge rounded-pill bg-info float-end"><?= $thn ?></span></li>
                            <?php }
                                }
                            endforeach; ?>
                        </ul>
                    </div>
                    <div class="mb-4">
                        <h5 class="text-center mb-3">Kompetensi</h5>
                        <ul class="list-group">
                            <?php foreach ($kompetensi as $item) :
                                if ($item['jenis'] !== 'Pendidikan') { ?>
                                    <li class="list-group-item"><?= $item['tempat'] ?> - <em><?= $item['subjek'] ?></em><span class="badge rounded-pill bg-info float-end"><?= $item['hasil'] ?></span></li>
                            <?php }
                            endforeach; ?>
                        </ul>
                    </div>
                    <div class="alert alert-success" role="alert">
                        <div>
                            <p><?= $guru['kesan'] ?></p>
                        </div>
                        <hr>
                        <div>
                            <p><?= $guru['pesan'] ?></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="Https://wa.me/<?= $guru['telepon'] ?>" type="button" class="btn btn-success"><i class="fa fa-whatsapp" aria-hidden="true"></i></a>
                    <a href="/pengajar" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<div class="<?= (!$idm) ?: 'd-none' ?>">
    <div class="row g-5 mt-2 ps-2">
        <div class="col">
            <article class="blog-post text-center">
                <h2 class="blog-post-title">Staff Pengajar</h2>
                <p class="blog-post-meta mb-5">Periode <?= $profil['periode'] . '-' . ($profil['periode'] + 1) ?></p>
            </article>
            <div class="row">
                <?php if (!$idm) {
                    foreach ($guru as $key => $row) : ?>
                        <div class="col-6 col-md-4 col-lg-3 mb-4">
                            <div class="card p-2">
                                <a href="/pengajar/<?= $row['id'] ?>">
                                    <img src="<?= uploaded(($row) ? $row['id'] . '.png' : '', '/img/profile') ?>" class="rounded mb-2 w-100 h-100" />
                                </a>
                                <div class="card-body text-center">
                                    <h5 class="card-title"><?= $row['nama'] ?></h5>
                                    <?php
                                    $ket = explode(',', $row['ket']);
                                    for ($i = 0; $i < count($ket); $i++) {
                                    ?>
                                        <span class="badge rounded-pill bg-primary"><?= $ket[$i] ?></span>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                <?php endforeach;
                } ?>
            </div>
        </div>
    </div>
    <?= $this->include('template/foot-galeri') ?>
</div>

<?php $this->endSection();  ?>