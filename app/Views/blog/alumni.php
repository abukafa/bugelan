<?php
$this->extend('template/main');
$this->section('content');
?>

<?php if ($idm) { ?>
    <div class="row d-flex justify-content-center mt-4">
        <div class="col-lg-6">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailLabel">Portofolio</h5>
                    <a href="/alumni" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <img src="<?= uploaded($alumni['id'] . '.png', 'img/profile') ?>" class="img rounded-circle mb-4 w-50" />
                        <h3><?= $alumni['nama'] ?></h3>
                        <div>
                            <?php
                            $ket = explode(',', $alumni['ket']);
                            for ($i = 0; $i < count($ket); $i++) {
                            ?>
                                <span class="badge rounded-pill bg-primary"><?= $ket[$i] ?></span>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="row my-4">
                        <div class="col-6 text-end">Tgl Lahir :</div>
                        <div class="col-6"><?= $alumni['tanggal_lahir'] ?></div>
                        <div class="col-6 text-end">Asal :</div>
                        <div class="col-6"><?= $alumni['kecamatan'] ?></div>
                        <div class="col-6 text-end">E-mail :</div>
                        <div class="col-6"><?= $alumni['email'] ?></div>
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
                            <p><?= $alumni['kesan'] ?></p>
                        </div>
                        <hr>
                        <div>
                            <p><?= $alumni['pesan'] ?></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="Https://wa.me/<?= $alumni['telepon'] ?>" type="button" class="btn btn-success"><i class="fa fa-whatsapp" aria-hidden="true"></i></a>
                    <a href="/alumni" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php if (!$idm) { ?>
    <div class="row g-5 mt-2 px-2">
        <div class="col">
            <article class="blog-post">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap ">
                    <div class="col-6">
                        <h2 class="blog-post-title">Alumni SMPT Bugelan</h2>
                        <p class="blog-post-meta mb-5">Update <?= $profil['periode'] ?></p>
                    </div>
                    <div class="col-6 text-end pt-2">
                        <button type="button" class="btn btn-sm btn-outline-success dropdown-toggle" id="dropdownFilter" data-bs-toggle="dropdown" aria-expanded="true">
                            <span data-feather="calendar"></span>
                            Tahun
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownFilter" data-popper-placement="bottom-start" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(0px, 40px, 0px);">
                            <?php
                            $prd = $profil['periode'];
                            for ($i = $prd; $i > 2014; $i--) {
                            ?>
                                <li><a class="dropdown-item" href="/alumni/<?= $i - 3 ?>"><?= $i ?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>

                <table class="table table-hover align-middle">
                    <tr>
                        <th>Pic</th>
                        <th>Nama</th>
                        <th class="d-none d-lg-table-cell">Tgl Lahir</th>
                        <th>Ayah</th>
                        <th class="d-none d-lg-table-cell">Pendidikan</th>
                        <th>Kelulusan</th>
                    </tr>
                    <?php foreach ($alumni as $row) : ?>
                        <tr>
                            <td>
                                <a href="/alumni/<?= $row['tahun'] . '/' . $row['id'] ?>">
                                    <img src="<?= uploaded(($row) ? $row['id'] . '.png' : '', '/img/profile') ?>" class="w5 rounded-circle" style="max-width: 50px;">
                                </a>
                            </td>
                            <td><?= $row['nama'] ?></td>
                            <td class="d-none d-lg-table-cell"><?= $row['tanggal_lahir'] ?></td>
                            <td><?= $row['nama_ayah'] ?></td>
                            <td class="d-none d-lg-table-cell"></td>
                            <td>
                                <span class="badge rounded-pill bg-success"><?= $row['tahun'] + 3 ?></span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </article>
        </div>
    </div>
<?php } ?>

<?php $this->endSection();  ?>