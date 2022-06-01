<?php 
include 'navbar.php';
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Dashboard</h1>
    </div>
    <canvas class="my-4 w-100" id="financeChart" width="900" height="380"></canvas>

    <br>
    <h3>Indeks Keuangan</h3>
    <div class="table-responsive">
      <table class="table table-striped table-sm">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col" class="d-none d-md-table-cell">Akun</th>
            <th scope="col">Nama</th>
            <th scope="col" class="d-none d-lg-table-cell">Ket</th>
            <th scope="col">Debit</th>
            <th scope="col">Kredit</th>
          </tr>
        </thead>
        <tbody>
          <tr>
          <?php
          $no=1;
          $accou=mysqli_query($GLOBALS["___mysqli_ston"], "select distinct account from finance order by account");
            while($acco=mysqli_fetch_array($accou)){
            $ack=$acco['account'];
          ?>
            <td><?php echo $no; ?></td>
            <td class="d-none d-md-table-cell"><?php echo $ack ?></td>
          <?php
          $aku=mysqli_query($GLOBALS["___mysqli_ston"], "select * from account where code='$ack'");
            while($akk=mysqli_fetch_array($aku)){
          ?>
            <td><?php echo $akk['name']; ?></td>
            <td class="d-none d-lg-table-cell"><?php echo $akk['des']; ?></td>
          <?php
          $tto=mysqli_query($GLOBALS["___mysqli_ston"], "select sum(if(account='$ack', debit, 0)) as dbt, sum(if(account='$ack', credit, 0)) as kdt from finance");
            while($ttl=mysqli_fetch_array($tto)){
          ?>
            <td align="right"><?php echo number_format($ttl['dbt'],0,'',','); ?></td>
            <td align="right"><?php echo number_format($ttl['kdt'],0,'',','); ?></td>
          </tr>
          <?php
          $no++;
        }
        }
          } 
          ?>
        </tbody>
      </table>
    </div>
  </div>
</main>

<script type="text/javascript">
  // Graphs
  var ctx = document.getElementById('financeChart')
  // eslint-disable-next-line no-unused-vars
  var myChart = new Chart(ctx, {
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
        borderColor: 'rgba(255,99,132,1)',
        borderWidth: 4,
        pointBackgroundColor: 'rgba(255,99,132,0.2)'
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
        borderColor: 'rgba(54,162,235,1)',
        borderWidth: 4,
        pointBackgroundColor: 'rgba(54,162,235,0.2)'
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