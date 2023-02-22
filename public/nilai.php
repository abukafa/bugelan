<?php 
error_reporting(0);
include_once 'header.php';
include_once '../admin/config.php';
if(date('m') < 7){
    $thn=date('Y')-1;
    $smt=1;  
}else{
    $thn=date('Y');
    $smt=2;
}
$yth=$thn+1;
?>
<style>
	.form-signin {
	width: 100%;
	max-width: 330px;
	padding: 15px;
	margin: auto;
	}
    @media (min-width: 1200px) {  
    h6 {font-size:1.35rem;} 
    }
</style>
<main class="content mt-5">
	<div class="container">
    <?php 
    if(!isset($_POST['nisn'])){
    ?>
	<p class="display-6 text-center mb-2">My Data</p>
	<p class="h5 text-center mb-3">Period <?= $thn . '-' . $yth ?></p>
    
    <div class="form-signin text-center mt-5">  
		<form action="" method="post">
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><span data-feather="user"></span></span>
                <input type="text" name="nisn" class="form-control" placeholder="Nomor Induk" autocomplete="off">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><span data-feather="calendar"></span></span>
                <input type="text" name="tgl" id="tgl" class="form-control" placeholder="Tgl Lahir" aria-label="Username" autocomplete="off">
            </div>
			<button class="btn btn-lg btn-dark mt-2" type="submit">Masuk</button>
		</form>
	</div>
    <?php 
    }else{
        $nisn=$_POST['nisn'];
        $tgl=$_POST['tgl'];
        $siswa=myquery("SELECT * FROM siswa WHERE nisn='$nisn' AND tanggal_lahir='$tgl'");
        if(!$siswa){
            echo '<h3 class="text-center text-danger mt-5">.. Data Tidak Ditemukan ..</h3>';
        }else{
            $san=$siswa[0];
            $id=$san['id'];
            // QUERY NILAI TAHUN INI
            $pro=myquery("SELECT DISTINCT smt, SUM(nilai_p)/COUNT(*) as pgt, SUM(nilai_k)/COUNT(*) as ktr FROM `nilai` WHERE id_siswa='$id' GROUP BY smt;");
            $mapel=myquery("SELECT DISTINCT mapel, SUM(nilai_p)/COUNT(*) as pgt, SUM(nilai_k)/COUNT(*) as ktr FROM `nilai` WHERE id_siswa='$id' GROUP BY mapel;");
            $pk=myquery("SELECT SUM(nilai_p)/COUNT(*) as np, SUM(nilai_k)/COUNT(*) as nk FROM nilai WHERE id_siswa=37;");
    ?>
    <a href="nilai" class="btn btn-dark float-md-end mb-2"><span data-feather="arrow-left"></span> Kembali</a>

    <div class="row mb-3">
        <div class="col-5 col-md-2">
            <?php if($id<>'' && file_exists("../public/foto/" . $id . ".jpg")){?>
            <img class="img-responsive w-100 rounded-3" id="preview" src="../public/foto/<?= $id ?>.jpg">
            <?php }else{ ?>
            <img class="img-responsive w-100 rounded-3" id="preview" src="../public/foto/no.png">
            <?php } ?>
        </div>
        <div class="col-5 col-md-10">
            <div class="row">
                <div class="d-none d-md-inline col-md-2">
                    <h6>Nomor Induk</h6>
                </div>
                <div class="col-md-10">
                    <h6><?= $nisn ?></h6>
                </div>
                <div class="d-none d-md-inline col-md-2">
                    <h6>Nama</h6>
                </div>
                <div class="col-md-10">
                    <h6><?= $san['nama'] ?></h6>
                </div>
                <div class="d-none d-md-inline col-md-2">
                    <h6>Ayah</h6>
                </div>
                <div class="col-md-10">
                    <h6><div class="d-inline d-md-none"><?= $san['jk'] == 'L' ? 'bin' : 'binti' ?></div> <?= $san['nama_ayah'] ?></h6>
                </div>
                <div class="d-none d-md-inline col-md-2">
                    <h6>Ibu</h6>
                </div>
                <div class="col-md-10">
                    <h6><div class="d-inline d-md-none">Ibu</div> <?= $san['nama_ibu'] ?></h6>
                </div>
                <div class="d-none d-md-inline col-md-2">
                    <h6>TTL</h6>
                </div>
                <div class="col-md-10">
                    <h6><?= $san['tempat_lahir'] . ', ' . date_format(date_create($s['tanggal_lahir']), "j M Y") ?></h6>
                </div>
                <div class="d-none d-md-inline col-md-2">
                    <h6>Alamat</h6>
                </div>
                <div class="col-md-10">
                    <h6><?= $san['alamat'] . ' RT. ' . $san['rt'] . '/' . $san['rw'] . ' ' . $san['kelurahan'] . ', ' . $san['kecamatan'] ?></h6>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <?php 
                    $sumTabungan = myquery("SELECT sum(if(id_siswa=". $id .", debit, 0)) as dbt, sum(if(id_siswa=". $id .", kredit, 0)) as kdt from tabungan");
                    $sum = $sumTabungan[0];
                    $jml = $sum['dbt'] - $sum['kdt'];
                    ?>
                    <h5 class="card-title mb-0">Data Tabungan</h5>
                    <h5 class="card-title mb-0">Rp. <?= number_format($jml,0,".",",") ?></h5>
                </div>
                <div class="card-body py-3">
                    <table class="table table-bordered table-striped">
                        <tr class="text-center">
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Debit</th>
                            <th>Kredit</th>
                        </tr>
                        <?php 
                        $no=1;
                        $tabungan = myquery("SELECT * from tabungan where id_siswa='$id' order by tgl asc");
                        foreach($tabungan as $tab) :
                        ?>
                        <tr class="text-center">
                            <td><?= $no ?></td>
                            <td><?= $tab['tgl'] ?></td>
                            <td class="text-end"><?= number_format($tab['debit'],0,".",",") ?></td>
                            <td class="text-end"><?= number_format($tab['kredit'],0,".",",") ?></td>
                        </tr>
                        <?php 
                        $no++;
                        endforeach;
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <?php 
                    $sumAbsen = myquery("SELECT count(*) as con from absen where id_siswa='$id' and ket=''");
                    $suma = $sumAbsen[0];
                    ?>
                    <h5 class="card-title mb-0">Data Absensi</h5>
                    <h5 class="card-title mb-0">Hadir : <?= $suma['con'] ?></h5>
                </div>
                <div class="card-body py-3">
                    <table class="table table-bordered table-striped">
                        <tr class="text-center">
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Absen</th>
                            <th>Keterangan</th>
                        </tr>
                        <?php 
                        $no=1;
                        $absen = myquery("SELECT * from absen where id_siswa='$id' and ket<>'' order by date");
                        foreach($absen as $abs) :
                        ?>
                        <tr class="text-center">
                            <td><?= $no ?></td>
                            <td><?= $abs['date'] ?></td>
                            <td><?= $abs['ket'] ?></td>
                            <td class="text-start"><?= $abs['note'] ?></td>
                        </tr>
                        <?php 
                        $no++;
                        endforeach;
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-5 mb-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Progress</h5>
                </div>
                <div class="card-body py-3">
                    <div class="chart chart-sm">
                        <canvas id="progres"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 mb-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">PGT vs KTR</h5>
                </div>
                <div class="card-body d-flex">
                    <div class="align-self-center w-100">
                        <div class="chart chart-xs">
                            <canvas id="pkChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-5 mb-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Mata Pelajaran</h5>
                </div>
                <div class="card-body d-flex">
                    <div class="align-self-center w-100">
                        <div class="chart">
                            <canvas id="mapelChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

	<p class="mb-3 mt-3 text-center text-muted">Tekan tombol Kembali jika sudah selasai.. <span data-feather="smile"></span></p>
</main>
<?php
    }
}
?>

<script>
feather.replace({ 'aria-hidden': 'true' })
// GRAFIK PROGRES NILAI RATA-RATA
document.addEventListener("DOMContentLoaded", function() {
    // document.addEventListener("DOMContentLoaded", function() {
    var ctx = document.getElementById("progres").getContext("2d");
    // Line chart
    new Chart(document.getElementById("progres"), {
        type: "line",
        data: {
            labels: [
                <?php 
                foreach($pro as $p) :
                    echo '"S-' . $p['smt'] . '", ';
                endforeach; 
                ?> 
            ],
            datasets: [{
                label: "Pengetahuan",
                fill: true,
                backgroundColor: 'rgba(255,99,132,0.2)',
                borderColor: 'rgba(255,99,132,2)',
                data: [
                    <?php 
                    foreach($pro as $p) :
                        echo round($p['pgt'],2) . ', ';
                    endforeach; 
                    ?> 
                ]
            }, {
                label: "Keterampilan",
                fill: true,
                backgroundColor: 'rgba(54,162,235,0.2)',
                borderColor: 'rgba(54,162,235,2)',
                data: [
                    <?php 
                    foreach($pro as $p) :
                        echo round($p['ktr'],2) . ', ';
                    endforeach; 
                    ?> 
                ]
            }]
        },
        options: {
            maintainAspectRatio: false,
            legend: {
                display: false
            },
            tooltips: {
                intersect: false
            },
            hover: {
                intersect: true
            },
            plugins: {
                filler: {
                    propagate: false
                }
            },
            scales: {
                xAxes: [{
                    reverse: true,
                    gridLines: {
                        color: "rgba(0,0,0,0.0)"
                    }
                }],
                yAxes: [{
                    ticks: {
                        stepSize: 1000
                    },
                    display: true,
                    borderDash: [3, 3],
                    gridLines: {
                        color: "rgba(0,0,0,0.0)"
                    }
                }]
            }
        }
    });
});
// GRAFIK PENGETAHUAN & KETERAMPILAN
document.addEventListener("DOMContentLoaded", function() {
    new Chart(document.getElementById("pkChart"), {
        type: "pie",
        data: {
            labels: ["Pengetahuan", "Keterampilan"],
            datasets: [{
                data: [
                    <?= round($pk[0]['np'], 2) ?> ,
                    <?= round($pk[0]['nk'], 2) ?> 
                ],
                backgroundColor: [
                    'rgba(255,99,132,0.75)',
                    'rgba(54,162,235,0.75)'
                ],
                borderWidth: 5
            }]
        },
        options: {
            responsive: !window.MSInputMethodContext,
            maintainAspectRatio: false,
            legend: {
                display: false
            },
            cutoutPercentage: 0
        }
    });
});
// GRAFIK MATA PELAJARAN
document.addEventListener("DOMContentLoaded", function() {
    new Chart(document.getElementById("mapelChart"), {
        type: "bar",
        data: {
            labels: [
                <?php 
                foreach($mapel as $m) :
                    echo '"' . $m['mapel'] . '", ';
                endforeach; 
                ?> 
            ],
            datasets: [{
                label: "Pengetahuan",
                backgroundColor: [
                    <?php foreach($mapel as $m) : ?>
                    'rgba(255,99,132,0.5)' ,
                    <?php endforeach; ?>
                ],
                data: [
                    <?php 
                    foreach($mapel as $m) :
                        echo round($m['pgt'],2) . ', ';
                    endforeach; 
                    ?> 
                ],
                barPercentage: 1,
                categoryPercentage: .75
            }, {
                label: "Keterampilan",
                backgroundColor: [
                    <?php foreach($mapel as $m) : ?>
                    'rgba(54,162,235,0.5)' ,
                    <?php endforeach; ?>
                ],
                data: [
                    <?php 
                    foreach($mapel as $m) :
                        echo round($m['ktr'],2) . ', ';
                    endforeach; 
                    ?> 
                ],
                barPercentage: 1,
                categoryPercentage: .75
            }]
        },
        options: {
            maintainAspectRatio: false,
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                    gridLines: {
                        display: false
                    },
                    stacked: false
                }],
                xAxes: [{
                    stacked: false,
                    gridLines: {
                        color: "transparent"
                    }
                }]
            }
        }
    });
});
</script>