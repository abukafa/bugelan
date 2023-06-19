<?php 
error_reporting(0);
include_once 'navbar.php';
include_once '../admin/config.php';
if(date('m') < 7){
    $thn=date('Y')-1;
    $smt=1;  
}else{
    $thn=date('Y');
    $smt=2;
}
$yth=$thn-1;
$alm=$thn-3;
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

<?php 
if(!isset($_GET['nisn'])){
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="container-fluid">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Data Nilai Akhir</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <form action="" method="get">
            <select type="submit" name="kls" class="btn btn-sm btn-outline-secondary" onchange="this.form.submit()">
                <option value="">.. Filter ..</option>
                <option value="<?= $thn-2 ?>">Kelas 9</option>
                <option value="<?= $thn-1 ?>">Kelas 8</option>
                <option value="<?= $thn ?>">Kelas 7</option>
            </select>
            </form>
        </div>
        </div>
    </div>
    <?php flash(); ?>

    <div class="container-fluid">
        <div class="table-responsive">
        <table class="table table-striped table-hover table-sm">
            <thead>
            <tr>
                <th scope="col" class="d-none d-md-table-cell">No</th>
                <th scope="col">NISN</th>
                <th scope="col">Nama</th>
                <th scope="col" class="d-none d-md-table-cell">JK</th>
                <th scope="col" class="d-none d-md-table-cell">Kelas</th>
                <th scope="col" class="d-none d-lg-table-cell">TTL</th>
                <th scope="col" class="d-none d-lg-table-cell">Nama Ayah</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <?php 
                if(isset($_GET['kls'])){
                $tahun = $_GET['kls'];
                $query = "select * from siswa where tahun='$tahun' order by jk, nama";
                }else{
                $query = "select * from siswa where tahun<>'$alm' order by tahun, jk, nama";
                }
                $siswa=mysqli_query($GLOBALS["___mysqli_ston"], $query);
                $no=1;
                while($s=mysqli_fetch_array($siswa)){
                ?>
                <td class="d-none d-md-table-cell"><?= $no ?></td>
                <td><?= $s['nisn'] ?></td>
                <td><?= $s['nama'] ?></td>
                <td class="d-none d-md-table-cell"><?= $s['jk'] ?></td>
                <td class="d-none d-md-table-cell"><?= $thn-$s['tahun']+7 ?></td>
                <td class="d-none d-lg-table-cell"><?= $s['tempat_lahir'] . ', ' . date_format(date_create($s['tanggal_lahir']), "j M Y") ?></td>
                <td class="d-none d-lg-table-cell"><?= $s['nama_ayah'] ?></td>
                <td align="right">    
                <a href="nilai?nisn=<?php echo $s['nisn'] ?>&tgl=<?= $s['tanggal_lahir'] ?>" class="btn btn-sm btn-dark"><span data-feather="eye"></span></a>
                </td>
            </tr>
            <?php
            $no++;
            }
            ?>
            </tbody>
        </table>
        </div>
    </div>
    </main>
    <?php 
    }else{
        $nisn=$_GET['nisn'];
        $tgl=$_GET['tgl'];
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
    
<main class="content mt-5">
    <div class="container">
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
                        <h6>NISN</h6>
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