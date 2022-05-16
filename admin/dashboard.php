<?php 
include 'navbar.php';
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Dashboard</h1>
<!--       <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
          <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
          <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
        </div>
        <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
          <span data-feather="calendar"></span>
          This week
        </button>
      </div> -->
    </div>
    <canvas class="my-4 w-100" id="financeChart" width="900" height="380"></canvas>

    <br>
    <h3>Indeks Keuangan</h3>
    <div class="table-responsive">
      <table class="table table-striped table-sm">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Akun</th>
            <th scope="col">Nama</th>
            <th scope="col">Ket</th>
            <th scope="col">Sub Debit</th>
            <th scope="col">Sub Kredit</th>
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
            <td><?php echo $ack ?></td>
          <?php
          $aku=mysqli_query($GLOBALS["___mysqli_ston"], "select * from account where code='$ack'");
            while($akk=mysqli_fetch_array($aku)){
          ?>
            <td><?php echo $akk['name']; ?></td>
            <td><?php echo $akk['des']; ?></td>
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
      labels: [
        'Jan',
        'Feb',
        'Mar',
        'Apr',
        'Mei',
        'Jun',
        'Jul',
        'Agu',
        'Sep',
        'Okt',
        'Nov',
        'Des'
      ],
      datasets: [{
        label: 'Kredit',
        data: [
          <?php 
          $jan = mysqli_query($GLOBALS["___mysqli_ston"], "select sum(if(period='Jan 2021', credit, 0)) as kdt from finance");
          while($j=mysqli_fetch_assoc($jan)){
          echo $j['kdt'];
          }
          ?>,
          <?php 
          $feb = mysqli_query($GLOBALS["___mysqli_ston"], "select sum(if(period='Feb 2021', credit, 0)) as kdt from finance");
          while($f=mysqli_fetch_assoc($feb)){
          echo $f['kdt'];
          }
          ?>,
          <?php 
          $mar = mysqli_query($GLOBALS["___mysqli_ston"], "select sum(if(period='Mar 2021', credit, 0)) as kdt from finance");
          while($m=mysqli_fetch_assoc($mar)){
          echo $m['kdt'];
          }
          ?>,
          <?php 
          $apr = mysqli_query($GLOBALS["___mysqli_ston"], "select sum(if(period='Apr 2021', credit, 0)) as kdt from finance");
          while($a=mysqli_fetch_assoc($apr)){
          echo $a['kdt'];
          }
          ?>,
          <?php 
          $may = mysqli_query($GLOBALS["___mysqli_ston"], "select sum(if(period='May 2021', credit, 0)) as kdt from finance");
          while($ma=mysqli_fetch_assoc($may)){
          echo $ma['kdt'];
          }
          ?>,
          <?php 
          $jun = mysqli_query($GLOBALS["___mysqli_ston"], "select sum(if(period='Jun 2021', credit, 0)) as kdt from finance");
          while($jn=mysqli_fetch_assoc($jun)){
          echo $jn['kdt'];
          }
          ?>,
          <?php 
          $jul = mysqli_query($GLOBALS["___mysqli_ston"], "select sum(if(period='Jul 2021', credit, 0)) as kdt from finance");
          while($jl=mysqli_fetch_assoc($jul)){
          echo $jl['kdt'];
          }
          ?>,
          <?php 
          $aug = mysqli_query($GLOBALS["___mysqli_ston"], "select sum(if(period='Aug 2021', credit, 0)) as kdt from finance");
          while($ag=mysqli_fetch_assoc($aug)){
          echo $ag['kdt'];
          }
          ?>,
          <?php 
          $sep = mysqli_query($GLOBALS["___mysqli_ston"], "select sum(if(period='Sep 2021', credit, 0)) as kdt from finance");
          while($s=mysqli_fetch_assoc($sep)){
          echo $s['kdt'];
          }
          ?>,
          <?php 
          $oct = mysqli_query($GLOBALS["___mysqli_ston"], "select sum(if(period='Oct 2021', credit, 0)) as kdt from finance");
          while($o=mysqli_fetch_assoc($oct)){
          echo $o['kdt'];
          }
          ?>,
          <?php 
          $nov = mysqli_query($GLOBALS["___mysqli_ston"], "select sum(if(period='Nov 2021', credit, 0)) as kdt from finance");
          while($n=mysqli_fetch_assoc($nov)){
          echo $n['kdt'];
          }
          ?>,
          <?php 
          $dec = mysqli_query($GLOBALS["___mysqli_ston"], "select sum(if(period='Dec 2021', credit, 0)) as kdt from finance");
          while($d=mysqli_fetch_assoc($dec)){
          echo $d['kdt'];
          }
          ?>
        ],
        lineTension: 0,
        backgroundColor: 'transparent',
        borderColor: '#f63c0a',
        borderWidth: 4,
        pointBackgroundColor: '#f63c0a'
      }, {
        label: 'Debit',
        data: [
          <?php 
          $jan = mysqli_query($GLOBALS["___mysqli_ston"], "select sum(if(period='Jan 2021', debit, 0)) as kdt from finance");
          while($j=mysqli_fetch_assoc($jan)){
          echo $j['kdt'];
          }
          ?>,
          <?php 
          $feb = mysqli_query($GLOBALS["___mysqli_ston"], "select sum(if(period='Feb 2021', debit, 0)) as kdt from finance");
          while($f=mysqli_fetch_assoc($feb)){
          echo $f['kdt'];
          }
          ?>,
          <?php 
          $mar = mysqli_query($GLOBALS["___mysqli_ston"], "select sum(if(period='Mar 2021', debit, 0)) as kdt from finance");
          while($m=mysqli_fetch_assoc($mar)){
          echo $m['kdt'];
          }
          ?>,
          <?php 
          $apr = mysqli_query($GLOBALS["___mysqli_ston"], "select sum(if(period='Apr 2021', debit, 0)) as kdt from finance");
          while($a=mysqli_fetch_assoc($apr)){
          echo $a['kdt'];
          }
          ?>,
          <?php 
          $may = mysqli_query($GLOBALS["___mysqli_ston"], "select sum(if(period='May 2021', debit, 0)) as kdt from finance");
          while($ma=mysqli_fetch_assoc($may)){
          echo $ma['kdt'];
          }
          ?>,
          <?php 
          $jun = mysqli_query($GLOBALS["___mysqli_ston"], "select sum(if(period='Jun 2021', debit, 0)) as kdt from finance");
          while($jn=mysqli_fetch_assoc($jun)){
          echo $jn['kdt'];
          }
          ?>,
          <?php 
          $jul = mysqli_query($GLOBALS["___mysqli_ston"], "select sum(if(period='Jul 2021', debit, 0)) as kdt from finance");
          while($jl=mysqli_fetch_assoc($jul)){
          echo $jl['kdt'];
          }
          ?>,
          <?php 
          $aug = mysqli_query($GLOBALS["___mysqli_ston"], "select sum(if(period='Aug 2021', debit, 0)) as kdt from finance");
          while($ag=mysqli_fetch_assoc($aug)){
          echo $ag['kdt'];
          }
          ?>,
          <?php 
          $sep = mysqli_query($GLOBALS["___mysqli_ston"], "select sum(if(period='Sep 2021', debit, 0)) as kdt from finance");
          while($s=mysqli_fetch_assoc($sep)){
          echo $s['kdt'];
          }
          ?>,
          <?php 
          $oct = mysqli_query($GLOBALS["___mysqli_ston"], "select sum(if(period='Oct 2021', debit, 0)) as kdt from finance");
          while($o=mysqli_fetch_assoc($oct)){
          echo $o['kdt'];
          }
          ?>,
          <?php 
          $nov = mysqli_query($GLOBALS["___mysqli_ston"], "select sum(if(period='Nov 2021', debit, 0)) as kdt from finance");
          while($n=mysqli_fetch_assoc($nov)){
          echo $n['kdt'];
          }
          ?>,
          <?php 
          $dec = mysqli_query($GLOBALS["___mysqli_ston"], "select sum(if(period='Dec 2021', debit, 0)) as kdt from finance");
          while($d=mysqli_fetch_assoc($dec)){
          echo $d['kdt'];
          }
          ?>
        ],
        lineTension: 0,
        backgroundColor: 'transparent',
        borderColor: '#0a1ef7',
        borderWidth: 4,
        pointBackgroundColor: '#0a1ef7'
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