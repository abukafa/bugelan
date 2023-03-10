<?php
include 'header.php';
include '../admin/config.php';
if (date('m') < 7) {
  $thn = date('Y') - 1;
} else {
  $thn = date('Y');
}
$satu = $thn;
$dua = $thn - 1;
$tiga = $thn - 2;
$alm = $thn - 3;
?>
<main class="content">
  <div class="container mt-5">
    <p class="display-6 text-center mb-2">Dashboard</p>
    <p class="h5 text-center mb-3"><?php echo date('D, d M Y') ?></p>
    <br>
    <div class="row">
      <div class="col-lg-4 mb-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Kelas VII</h5>
            <div class="h-100 justify-content-between no-gutters row">
              <div class="col-xxl pr-2 col-5 col-sm-6">
                <div class="mt-3">
                  <?php
                  $now = date('Y-m-d');
                  $kls7 = myNumRow("SELECT * FROM siswa WHERE tahun='$satu'");
                  $hdr7 = myNumRow("SELECT * FROM absen INNER JOIN siswa ON absen.id_siswa=siswa.id WHERE siswa.tahun='$satu' AND absen.ket=''");
                  $tdk7 = $kls7 - $hdr7;
                  ?>
                  <div class="d-flex justify-content-between">
                    <span><?= $hdr7; ?> Siswa Hadir</span>
                  </div>
                  <div class="d-flex justify-content-between">
                    <span><?= $tdk7; ?> Belum Hadir</span>
                  </div>
                </div>
              </div>
              <div class="col-auto">
                <div class="position-relative">
                  <canvas id="absen7" width="120%" height="100"></canvas>
                </div>
              </div>
              <center>
                <h1><?= $hdr7; ?></h1>
              </center>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 mb-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Kelas VIII</h5>
            <div class="h-100 justify-content-between no-gutters row">
              <div class="col-xxl pr-2 col-5 col-sm-6">
                <div class="mt-3">
                  <?php
                  $now = date('Y-m-d');
                  $kls8 = myNumRow("SELECT * FROM siswa WHERE tahun='$dua'");
                  $hdr8 = myNumRow("SELECT * FROM absen INNER JOIN siswa ON absen.id_siswa=siswa.id WHERE siswa.tahun='$dua' AND absen.ket=''");
                  $tdk8 = $kls8 - $hdr8;
                  ?>
                  <div class="d-flex justify-content-between">
                    <span><?= $hdr8; ?> Siswa Hadir</span>
                  </div>
                  <div class="d-flex justify-content-between">
                    <span><?= $tdk8; ?> Belum Hadir</span>
                  </div>
                </div>
              </div>
              <div class="col-auto">
                <div class="position-relative">
                  <canvas id="absen8" width="120%" height="100"></canvas>
                </div>
              </div>
              <center>
                <h1><?= $hdr8; ?></h1>
              </center>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 mb-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Kelas IX</h5>
            <div class="h-100 justify-content-between no-gutters row">
              <div class="col-xxl pr-2 col-5 col-sm-6">
                <div class="mt-3">
                  <?php
                  $now = date('Y-m-d');
                  $kls9 = myNumRow("SELECT * FROM siswa WHERE tahun='$tiga'");
                  $hdr9 = myNumRow("SELECT * FROM absen INNER JOIN siswa ON absen.id_siswa=siswa.id WHERE siswa.tahun='$tiga' AND absen.ket=''");
                  $tdk9 = $kls9 - $hdr9;
                  ?>
                  <div class="d-flex justify-content-between">
                    <span><?= $hdr9; ?> Siswa Hadir</span>
                  </div>
                  <div class="d-flex justify-content-between">
                    <span><?= $tdk9; ?> Belum Hadir</span>
                  </div>
                </div>
              </div>
              <div class="col-auto">
                <div class="position-relative">
                  <canvas id="absen9" width="120%" height="100"></canvas>
                </div>
              </div>
              <center>
                <h1><?= $hdr9; ?></h1>
              </center>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6 mb-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title mb-3">Terlambat</h5>
            <table class="table table-hover my-0">
              <thead>
                <tr>
                  <th>Nama</th>
                  <th>Kelas</th>
                  <th>Masuk</th>
                  <th>Terlambat</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $late = myquery("SELECT * FROM absen INNER JOIN siswa ON absen.id_siswa=siswa.id WHERE late<>'00:00:00'");
                foreach ($late as $l) :
                ?>
                  <tr>
                    <td><?= $l['name'] ?></td>
                    <td><?= date('Y') - $l['tahun'] + 7 ?></td>
                    <td><?= $l['time'] ?></td>
                    <td class="d-none d-md-table-cell"><?= $l['late'] ?></td>
                  </tr>
                <?php endforeach ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-lg-6 mb-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title mb-3">Tidak Masuk</h5>
            <table class="table table-hover my-0">
              <thead>
                <tr>
                  <th>Nama</th>
                  <th>Kelas</th>
                  <th>Ket</th>
                  <th>Catatan</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $abs = myquery("SELECT * FROM absen INNER JOIN siswa ON absen.id_siswa=siswa.id WHERE ket<>''");
                foreach ($abs as $a) :
                ?>
                  <tr>
                    <td><?= $a['name'] ?></td>
                    <td><?= date('Y') - $a['tahun'] + 7 ?></td>
                    <td>
                      <?php if ($a['ket'] == 's') { ?>
                        <span class="badge bg-success">Sakit</span>
                      <?php } else if ($a['ket'] == 'i') { ?>
                        <span class="badge bg-warning">Izin</span>
                      <?php } else if ($a['ket'] == 'a') { ?>
                        <span class="badge bg-danger">Alpa</span>
                      <?php } ?>
                    </td>
                    <td class="d-none d-md-table-cell"><?= $a['note'] ?></td>
                  </tr>
                <?php endforeach ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col mb-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Tabungan</h5>
            <canvas id="tabungan"></canvas>
          </div>
        </div>
      </div>
    </div>

    <!-- membuat tabel rekap nilai -->
    <p class="display-6 text-center mb-4">Guru Penggerak</p>
    <div class="card mb-5">
      <div class="card-body">
        <table class="table table-bordered table-striped">
          <thead>
            <tr class="text-center">
              <th class="d-none d-md-table-cell">NIG</th>
              <th>Nama</th>
              <th class="d-none d-md-table-cell">JK</th>
              <th>Data</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $san = mysqli_query($GLOBALS["___mysqli_ston"], "select * from guru order by nig, nama");
            if ($san === false) {
              die(mysqli_error($GLOBALS["___mysqli_ston"]));
            }
            while ($s = mysqli_fetch_assoc($san)) {
            ?>
              <tr>
                <td class="d-none d-md-table-cell text-center"><?php echo $s['nig'] ?></td>
                <td><?php echo $s['nama'] ?></td>
                <td class="d-none d-md-table-cell text-center"><?php echo $s['jk'] == 'L' ? 'Laki-laki' : 'Perempuan' ?></td>
                <td class="text-center">
                  <a class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#modal-<?php echo $s['nig'] ?>"><span data-feather="eye"></span></a>
                </td>
              </tr>
              <!-- Modal View Data-->
              <div class="modal fade" id="modal-<?php echo $s['nig'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLiveLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="modalLabel">Guru Penggerak</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form>
                        <div class="text-center">
                          <?php if (file_exists("foto/" . $s['nig'] . ".jpg")) { ?>
                            <img class="img-responsive w-50 rounded-3" id="preview" src="foto/<?= $s['nig'] ?>.jpg">
                          <?php } else { ?>
                            <img class="img-responsive w-50 rounded-3" id="preview" src="foto/no.png">
                          <?php } ?>
                        </div>
                        <div class="my-2">
                          <label class="form-label" for="kode">Nama</label>
                          <input type="text" class="form-control form-control" id="kd" value="<?php echo $s['nama'] ?>" disabled>
                        </div>
                        <div class="mb-2">
                          <label class="form-label" for="des">Status</label>
                          <input type="textarea" class="form-control form-control" name="des" value="<?php echo $s['status'] ?>" disabled>
                        </div>
                        <div class="mb-2">
                          <label class="form-label" for="nama">Jabatan</label>
                          <input type="text" class="form-control form-control" name="nama" value="<?php echo $s['jabatan'] ?>" disabled>
                        </div>
                        <div class="mb-2">
                          <label class="form-label" for="des">Keterangan</label>
                          <input type="textarea" class="form-control form-control" name="des" value="<?php echo $s['ket'] ?>" disabled>
                        </div>
                        <div class="mb-2">
                          <label class="form-label" for="des">No. Handphone</label>
                          <input type="textarea" class="form-control form-control" name="des" value="<?php echo $s['hp'] ?>" disabled>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            <?php
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</main>

<!---------------------------------------------------------->
<?php
$d1 = date("Y-m-d");
$d2 = date("Y-m-d", strtotime("-1 days"));
$d3 = date("Y-m-d", strtotime("-2 days"));
$d4 = date("Y-m-d", strtotime("-3 days"));
$d5 = date("Y-m-d", strtotime("-4 days"));
$d6 = date("Y-m-d", strtotime("-5 days"));
$d7 = date("Y-m-d", strtotime("-6 days"));
$h1 = myNumRow("SELECT * FROM tabungan WHERE tgl='$d1'");
$h2 = myNumRow("SELECT * FROM tabungan WHERE tgl='$d2'");
$h3 = myNumRow("SELECT * FROM tabungan WHERE tgl='$d3'");
$h4 = myNumRow("SELECT * FROM tabungan WHERE tgl='$d4'");
$h5 = myNumRow("SELECT * FROM tabungan WHERE tgl='$d5'");
$h6 = myNumRow("SELECT * FROM tabungan WHERE tgl='$d6'");
$h7 = myNumRow("SELECT * FROM tabungan WHERE tgl='$d7'");
?>
<script>
  feather.replace({
    'aria-hidden': 'true'
  })
  // Data Grafik Bar Tabungan
  var ctx = document.getElementById('tabungan')
  var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: [
        '<?= date("l", strtotime("-6 days")); ?>',
        '<?= date("l", strtotime("-5 days")); ?>',
        '<?= date("l", strtotime("-4 days")); ?>',
        '<?= date("l", strtotime("-3 days")); ?>',
        '<?= date("l", strtotime("-2 days")); ?>',
        '<?= date("l", strtotime("-1 days")); ?>',
        '<?= date("l"); ?>'
      ],
      datasets: [{
        label: 'Menabung',
        data: [
          <?= $h7; ?>,
          <?= $h6; ?>,
          <?= $h5; ?>,
          <?= $h4; ?>,
          <?= $h3; ?>,
          <?= $h2; ?>,
          <?= $h1; ?>
        ],
        backgroundColor: '#95DAC1',
        borderColor: 'transparent',
        borderWidth: 1,
        pointBackgroundColor: '#95DAC1'
      }]
    },
    options: {
      scales: {
        yAxes: [{
          id: 'A',
          type: 'linear',
          position: 'left',
          ticks: {
            beginAtZero: false
          }
        }]
      },
    }
  });
  // Data Grafik Donat absen kls 7
  var cta = document.getElementById('absen7')
  var yourChart = new Chart(cta, {
    type: 'doughnut',
    data: {
      datasets: [{
        data: [<?= $hdr7; ?>, <?= $tdk7; ?>],
        backgroundColor: ['#95DAC1', '#fff999']
      }]
    }
  });
  // Data Grafik Donat absen kls 8
  var cta = document.getElementById('absen8')
  var yourChart = new Chart(cta, {
    type: 'doughnut',
    data: {
      datasets: [{
        data: [<?= $hdr8; ?>, <?= $tdk8; ?>],
        backgroundColor: ['#95DAC1', '#fff999']
      }]
    }
  });
  // Data Grafik Donat absen kls 9
  var cta = document.getElementById('absen9')
  var yourChart = new Chart(cta, {
    type: 'doughnut',
    data: {
      datasets: [{
        data: [<?= $hdr9; ?>, <?= $tdk9; ?>],
        backgroundColor: ['#95DAC1', '#fff999']
      }]
    }
  });
</script>