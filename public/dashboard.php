<?php 
include 'header.php';
include '../admin/config.php';
if(date('m')<7){
  $thn=date('Y')-1;
}else{
  $thn=date('Y');
}
$satu=$thn;
$dua=$thn-1;
$tiga=$thn-2;
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
						<h5 class="card-title">Siswa</h5>
                        <br>
						<canvas id="JKChart" width="200" height="175"></canvas>
                        <br>
					</div>
				</div>
			</div>
			<div class="col-lg-8 mb-4">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Kelas</h5>
						<canvas id="KLSChart" width="400" height="185"></canvas>
					</div>
				</div>
			</div>
        </div>
		<div class="row">
			<div class="col-12 mb-4">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Keuangan</h5>
						<canvas id="FNChart"></canvas>
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
                      $san=mysqli_query($GLOBALS["___mysqli_ston"], "select * from guru order by nig, nama");
                      if($san === false) {
                          die(mysqli_error($GLOBALS["___mysqli_ston"]));
                      }
                  while($s=mysqli_fetch_assoc($san)){
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
                              <?php if(file_exists("foto/" . $s['nig'] . ".jpg")){?>
                              <img class="img-responsive w-50 rounded-3" id="preview" src="foto/<?= $s['nig'] ?>.jpg">
                              <?php }else{ ?>
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

<script>
feather.replace({ 'aria-hidden': 'true' })
// Jenis Kelamin Santri
var ctx = document.getElementById("JKChart").getContext('2d');
var JKChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ["Laki-laki", "Perempuan"],
        datasets: [{
            label: '',
            data: [
                <?php 
                $jumlah_laki = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM siswa WHERE jk='L'");
                echo mysqli_num_rows($jumlah_laki);
                ?>, 
                <?php 
                $jumlah_perempuan = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM siswa WHERE jk='P'");
                echo mysqli_num_rows($jumlah_perempuan);
                ?>
            ],
            backgroundColor: [
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 99, 132, 0.2)'
            ],
            borderColor: [
                'rgba(54, 162, 235, 1)',
                'rgba(255,99,132,1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
// Chart kls Qonuni
var ctx = document.getElementById("KLSChart").getContext('2d');
var KLSChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["Kls VII", "Kls VIII", "Kls IX"],
        datasets: [{
            label: 'siswa',
            data: [
                <?php 
                $kls1 = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM siswa WHERE tahun='$satu'");
                echo mysqli_num_rows($kls1);
                ?>, 
                <?php 
                $kls2 = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM siswa WHERE tahun='$dua'");
                echo mysqli_num_rows($kls2);
                ?>, 
                <?php 
                $kls3 = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM siswa WHERE tahun='$tiga'");
                echo mysqli_num_rows($kls3);
                ?>
            ],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
var ctx = document.getElementById('FNChart')
  // eslint-disable-next-line no-unused-vars
  var FNChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
      datasets: [{
        label: 'Kredit',
        data: [
          <?php 
          $jan = mysqli_query($GLOBALS["___mysqli_ston"], "select sum(if(period='Jan 2021', credit, 0)) as kdt from finance");
          while($j=mysqli_fetch_assoc($jan)){
          echo $j['kdt'] / 1000;
          }
          ?>,
          <?php 
          $feb = mysqli_query($GLOBALS["___mysqli_ston"], "select sum(if(period='Feb 2021', credit, 0)) as kdt from finance");
          while($f=mysqli_fetch_assoc($feb)){
          echo $f['kdt'] / 1000;
          }
          ?>,
          <?php 
          $mar = mysqli_query($GLOBALS["___mysqli_ston"], "select sum(if(period='Mar 2021', credit, 0)) as kdt from finance");
          while($m=mysqli_fetch_assoc($mar)){
          echo $m['kdt'] / 1000;
          }
          ?>,
          <?php 
          $apr = mysqli_query($GLOBALS["___mysqli_ston"], "select sum(if(period='Apr 2021', credit, 0)) as kdt from finance");
          while($a=mysqli_fetch_assoc($apr)){
          echo $a['kdt'] / 1000;
          }
          ?>,
          <?php 
          $may = mysqli_query($GLOBALS["___mysqli_ston"], "select sum(if(period='May 2021', credit, 0)) as kdt from finance");
          while($ma=mysqli_fetch_assoc($may)){
          echo $ma['kdt'] / 1000;
          }
          ?>,
          <?php 
          $jun = mysqli_query($GLOBALS["___mysqli_ston"], "select sum(if(period='Jun 2021', credit, 0)) as kdt from finance");
          while($jn=mysqli_fetch_assoc($jun)){
          echo $jn['kdt'] / 1000;
          }
          ?>,
          <?php 
          $jul = mysqli_query($GLOBALS["___mysqli_ston"], "select sum(if(period='Jul 2021', credit, 0)) as kdt from finance");
          while($jl=mysqli_fetch_assoc($jul)){
          echo $jl['kdt'] / 1000;
          }
          ?>,
          <?php 
          $aug = mysqli_query($GLOBALS["___mysqli_ston"], "select sum(if(period='Aug 2021', credit, 0)) as kdt from finance");
          while($ag=mysqli_fetch_assoc($aug)){
          echo $ag['kdt'] / 1000;
          }
          ?>,
          <?php 
          $sep = mysqli_query($GLOBALS["___mysqli_ston"], "select sum(if(period='Sep 2021', credit, 0)) as kdt from finance");
          while($s=mysqli_fetch_assoc($sep)){
          echo $s['kdt'] / 1000;
          }
          ?>,
          <?php 
          $oct = mysqli_query($GLOBALS["___mysqli_ston"], "select sum(if(period='Oct 2021', credit, 0)) as kdt from finance");
          while($o=mysqli_fetch_assoc($oct)){
          echo $o['kdt'] / 1000;
          }
          ?>,
          <?php 
          $nov = mysqli_query($GLOBALS["___mysqli_ston"], "select sum(if(period='Nov 2021', credit, 0)) as kdt from finance");
          while($n=mysqli_fetch_assoc($nov)){
          echo $n['kdt'] / 1000;
          }
          ?>,
          <?php 
          $dec = mysqli_query($GLOBALS["___mysqli_ston"], "select sum(if(period='Dec 2021', credit, 0)) as kdt from finance");
          while($d=mysqli_fetch_assoc($dec)){
          echo $d['kdt'] / 1000;
          }
          ?>
        ],
        lineTension: 0,
        backgroundColor: 'transparent',
        borderColor: 'rgba(255,99,132,0.5)',
        borderWidth: 4,
        pointBackgroundColor: 'rgba(255,99,132,1)'
      }, {
        label: 'Debit',
        data: [
          <?php 
          $jan = mysqli_query($GLOBALS["___mysqli_ston"], "select sum(if(period='Jan 2021', debit, 0)) as kdt from finance");
          while($j=mysqli_fetch_assoc($jan)){
          echo $j['kdt'] / 1000;
          }
          ?>,
          <?php 
          $feb = mysqli_query($GLOBALS["___mysqli_ston"], "select sum(if(period='Feb 2021', debit, 0)) as kdt from finance");
          while($f=mysqli_fetch_assoc($feb)){
          echo $f['kdt'] / 1000;
          }
          ?>,
          <?php 
          $mar = mysqli_query($GLOBALS["___mysqli_ston"], "select sum(if(period='Mar 2021', debit, 0)) as kdt from finance");
          while($m=mysqli_fetch_assoc($mar)){
          echo $m['kdt'] / 1000;
          }
          ?>,
          <?php 
          $apr = mysqli_query($GLOBALS["___mysqli_ston"], "select sum(if(period='Apr 2021', debit, 0)) as kdt from finance");
          while($a=mysqli_fetch_assoc($apr)){
          echo $a['kdt'] / 1000;
          }
          ?>,
          <?php 
          $may = mysqli_query($GLOBALS["___mysqli_ston"], "select sum(if(period='May 2021', debit, 0)) as kdt from finance");
          while($ma=mysqli_fetch_assoc($may)){
          echo $ma['kdt'] / 1000;
          }
          ?>,
          <?php 
          $jun = mysqli_query($GLOBALS["___mysqli_ston"], "select sum(if(period='Jun 2021', debit, 0)) as kdt from finance");
          while($jn=mysqli_fetch_assoc($jun)){
          echo $jn['kdt'] / 1000;
          }
          ?>,
          <?php 
          $jul = mysqli_query($GLOBALS["___mysqli_ston"], "select sum(if(period='Jul 2021', debit, 0)) as kdt from finance");
          while($jl=mysqli_fetch_assoc($jul)){
          echo $jl['kdt'] / 1000;
          }
          ?>,
          <?php 
          $aug = mysqli_query($GLOBALS["___mysqli_ston"], "select sum(if(period='Aug 2021', debit, 0)) as kdt from finance");
          while($ag=mysqli_fetch_assoc($aug)){
          echo $ag['kdt'] / 1000;
          }
          ?>,
          <?php 
          $sep = mysqli_query($GLOBALS["___mysqli_ston"], "select sum(if(period='Sep 2021', debit, 0)) as kdt from finance");
          while($s=mysqli_fetch_assoc($sep)){
          echo $s['kdt'] / 1000;
          }
          ?>,
          <?php 
          $oct = mysqli_query($GLOBALS["___mysqli_ston"], "select sum(if(period='Oct 2021', debit, 0)) as kdt from finance");
          while($o=mysqli_fetch_assoc($oct)){
          echo $o['kdt'] / 1000;
          }
          ?>,
          <?php 
          $nov = mysqli_query($GLOBALS["___mysqli_ston"], "select sum(if(period='Nov 2021', debit, 0)) as kdt from finance");
          while($n=mysqli_fetch_assoc($nov)){
          echo $n['kdt'] / 1000;
          }
          ?>,
          <?php 
          $dec = mysqli_query($GLOBALS["___mysqli_ston"], "select sum(if(period='Dec 2021', debit, 0)) as kdt from finance");
          while($d=mysqli_fetch_assoc($dec)){
          echo $d['kdt'] / 1000;
          }
          ?>
        ],
        lineTension: 0,
        backgroundColor: 'transparent',
        borderColor: 'rgba(54,162,235,0.5)',
        borderWidth: 4,
        pointBackgroundColor: 'rgba(54,162,235,1)'
      }]
    },
    options: {
      scales: {
        yAxes: [{
          id: 'A',
          type: 'linear',
          position: 'left',
          ticks: {
            beginAtZero: true
          }
        }, {
          id: 'B',
          type: 'linear',
          position: 'right',
          ticks: {
            beginAtZero: true
          }
        }]
      },
      legend: {
        display: true
      }
    }
  })
</script>  
