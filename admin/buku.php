<?php 
include 'navbar.php';

function createRandomPassword() {
  $chars = "003232303232023232023456789";
  srand((double)microtime()*1000000);
  $i = 0;
  $pass = '' ;
  while ($i <= 7) {
    $num = rand() % 33;
    $tmp = substr($chars, $num, 1);
    $pass = $pass . $tmp;
    $i++;
  }
  return $pass;
}
$finalcode='FC-'.createRandomPassword();

date_default_timezone_set("Asia/Jakarta");

$p = date('M Y');
$n = date('Y-m-d');
$w = date('Y-m-d', strtotime('-1 week'));
$m = date('Y-m-d', strtotime('-1 month'));
$s = date('Y-m-d', strtotime('-6 month'));
$y = date('Y-m-d', strtotime('-1 year'));
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Pembukuan</h1>
      <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2 <?= $u['access']=='User' ? 'd-none' : '' ?>">
          <a href="buku_add?tgl=&vend=&ket=&inv=<?php echo $finalcode ?>"><button type="button" class="btn btn-sm btn-outline-secondary"><span data-feather="plus-circle"></span>
          Transaksi Baru
        </button></a>
        </div>
        <form action="" method="get">
          <select type="submit" name="tgl_awl" class="btn btn-sm btn-outline-secondary" onchange="this.form.submit()">
            <option value="">.. Filter ..</option>
            <option value="<?php echo $n ?>">Hari ini</option>
            <option value="<?php echo $w ?>">Pekan ini</option>
            <option value="<?php echo $m ?>">Bulan ini</option>
            <option value="<?php echo $s ?>">Semester ini</option>
            <option value="<?php echo $y ?>">Tahun ini</option>
          </select>
        </form>
      </div>
    </div>
  
    <?php  
    $jumlah_record=mysqli_query($conn, "SELECT distinct inv from finance");
    $record=mysqli_query($conn, "SELECT * from finance");
    $per_hal=30;
    $jum=mysqli_num_rows($jumlah_record);
    $item=mysqli_num_rows($record);
    $halaman=ceil($jum / $per_hal);
    $page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
    $start = ($page - 1) * $per_hal;

    
    if(isset($_GET['tgl_awl'])){
      $awl=mysqli_real_escape_string($conn, $_GET['tgl_awl']);
      $fin=mysqli_query($conn, "select distinct inv, period, remark from finance where date between '$awl' and '$n' order by date desc");
      $jumlah_record=mysqli_query($conn, "SELECT distinct inv from finance where date between '$awl' and '$n'");
      $jum=mysqli_num_rows($jumlah_record);
      echo "<div class='btn-group float-end'><button type='button' class='btn btn-sm btn-outline-primary'><a href='buku_lpalok?tgl_awal=". $awl ."&tgl_ahir=". $n ."' target='_blank' style='text-decoration:none'>Rekap</a></button><button type='button' class='btn btn-sm btn-outline-primary'><a href='buku_lpindex' target='_blank' style='text-decoration:none'>Index</a></button><button class='btn btn-sm btn-primary'><span data-feather='printer'></span></button></div>";
      echo "<h6 class='fw-bold'><a style='color:blue'>". $jum ." invoice - Tanggal " . date_format(date_create($awl), 'd M Y') . " s.d. " . date_format(date_create($n), 'd M Y') ."</a></h6>";
          
    }else{
      $fin=mysqli_query($conn, "select distinct inv, period, remark from finance order by date desc limit $start, $per_hal");
      echo "<h6 class='fw-bold'><a style='color:blue'>". $jum ." invoice</a></h6>";
    }
    ?>
  </div>
  <br/>
  <div class="container-fluid">
    <div class="table-responsive">
      <table class="table table-striped table-sm">
        <thead>
          <tr>
            <th>No</th>
            <th>Invoice</th>
            <th class="d-none d-md-table-cell">Periode</th>
            <th class="d-none d-lg-table-cell">Keterangan</th>
            <th class="text-end">Item</th>
            <th class="text-end">Jumlah</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <?php 
            $no=1;
            while($f=mysqli_fetch_array($fin)){
            ?>
            <td><?php echo $no; ?></td>
            <td><?php echo $f['inv']; ?></td>
            <td class="d-none d-md-table-cell"><?php echo $f['period']; ?></td>
            <td class="d-none d-lg-table-cell"><?php echo $f['remark']; ?></td>
            <?php
            $invo=$f['inv'];
            $dat=mysqli_query($conn, "SELECT * from finance where inv='$invo'");
              $data = mysqli_num_rows($dat); 
              $d = mysqli_fetch_array($dat);
            $sumi=mysqli_query($conn, "SELECT SUM(if(inv='$invo', debit, 0)) as dbt, SUM(if(inv='$invo', credit, 0)) as krd from finance");
              while($s=mysqli_fetch_array($sumi)){
              $amon = $s['krd'] - $s['dbt'];
            ?>
            <td align="right"><?php echo number_format($data,0,'',',') ?></td>
            <td align="right"><?php echo number_format($amon,0,'',',') ?></td>
              <?php
              }
              ?>
            <td align="right">    
              <a href="buku_add?tgl=<?= $d['date'] ?>&vend=<?= $d['vendor'] ?>&ket=<?php echo $f['remark'] ?>&inv=<?php echo $f['inv'] ?>" class="btn btn-sm btn-secondary <?= $u['access'] == 'User' ? 'd-none' : '' ?>"><span data-feather="edit"></span></a>
              <a href="buku_lpstruk?inv=<?php echo $f['inv'] ?>" target="_blank" class="d-none d-xl-inline-block btn btn-sm btn-primary"><span data-feather="printer"></span></a>
            </td>
          </tr>
            <?php
            $no++;
            }
            ?>
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    <?php 
    if(!isset($_GET['tgl_awl'])){
    ?>
    <ul class="pagination">     
      <li class="page-item">
        <a class="page-link" href="?page=1"><span data-feather="skip-back"></span></a>
      </li>
      <li>
        <a class="page-link" href="<?php if($page <= 1){ echo '#'; } else { echo "?page=".($page - 1); } ?>"><span data-feather="rewind"></span></a>
      </li>
      <li class="page-item">
        <a class="page-link"><?php echo $page . " / " . $halaman ?></a>
      </li>
      <li>
        <a class="page-link" href="<?php if($page >= $halaman){ echo '#'; } else { echo "?page=".($page + 1); } ?>"><span data-feather="fast-forward"></span></a>
      </li> 
      <li class="page-item">
        <a class="page-link" href="?page=<?php echo $halaman ?>"><span data-feather="skip-forward"></span></a>
      </li>        
    </ul>
    <?php 
    }
    ?>

  </div>
</main>

<script type="text/javascript">
    feather.replace({ 'aria-hidden': 'true' })
</script>
