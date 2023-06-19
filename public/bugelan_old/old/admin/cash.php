<?php 
include 'navbar.php';

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
      <h1 class="h2">Kas Kepanitiaan</h1>
      <div class="btn-toolbar mb-2 mb-md-0">
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
    $jumlah_record=mysqli_query($conn, "SELECT distinct inv from finance where account='44000'");
    $record=mysqli_query($conn, "SELECT * from finance where account='44000'");
    $per_hal=30;
    $jum=mysqli_num_rows($jumlah_record);
    $item=mysqli_num_rows($record);
    $halaman=ceil($jum / $per_hal);
    $page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
    $start = ($page - 1) * $per_hal;
    
    if(isset($_GET['tgl_awl'])){
      $awl=mysqli_real_escape_string($conn, $_GET['tgl_awl']);
      $fin=mysqli_query($conn, "SELECT distinct inv, period, vendor, remark, sum(debit) as dbt, sum(credit) as kdt from finance where account='44000' and date between '$awl' and '$n' order by date desc");
      $jumlah_record=mysqli_query($conn, "SELECT distinct inv from finance where account='44000' and date between '$awl' and '$n'");
      $jum=mysqli_num_rows($jumlah_record);
      echo "<h6 class='fw-bold'><a style='color:blue'>". $jum ." Pembukuan - " . date_format(date_create($awl), 'd M Y') . " s.d. " . date_format(date_create($n), 'd M Y') ."</a></h6>";
    }else{
      $fin=mysqli_query($conn, "SELECT distinct inv, period, vendor, remark, sum(debit) as dbt, sum(credit) as kdt from finance where account='44000' group by inv order by date desc limit $start, $per_hal");
      echo "<h6 class='fw-bold'><a style='color:blue'>". $jum ." Pembukuan</a></h6>";
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
            <th class="text-end">Anggaran</th>
            <th class="text-end">Item</th>
            <th class="text-end">Jumlah</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <?php 
            $no=1;
            while($jum > 0 && $f=mysqli_fetch_array($fin)){
                $ang = $f['kdt'] - $f['dbt'];
                ?>
            <td><?php echo $no; ?></td>
            <td><?php echo $f['inv']; ?></td>
            <td class="d-none d-md-table-cell"><?php echo $f['period']; ?></td>
            <td class="d-none d-lg-table-cell"><?php echo $f['remark']; ?></td>
            <td class="text-end"><?php echo number_format($ang,0,'',',') ?></td>
            <?php
            $invo=$f['inv'];
            $dat=mysqli_query($conn, "SELECT * from cash where inv='$invo'");
              $data = mysqli_num_rows($dat); 
            $sumi=mysqli_query($conn, "SELECT SUM(if(inv='$invo', debit, 0)) as dbt, SUM(if(inv='$invo', credit, 0)) as krd from cash");
              while($s=mysqli_fetch_array($sumi)){
              $amon = $s['krd'] - $s['dbt'];
            ?>
            <td class="text-end"><?php echo number_format($data,0,'',',') ?></td>
            <td class="text-end"><?php echo number_format($amon,0,'',',') ?></td>
            <?php
            }
            ?>
            <td class="text-end">
              <div class="">    
                <a href="cash_add?tgl=&vend=&ket=<?php echo $f['remark'] ?>&inv=<?php echo $f['inv'] ?>" class="btn btn-sm btn-secondary <?= $f['vendor']<>$u['name'] ? 'disabled' : '' ?>"><span data-feather="edit"></span></a>
                <a href="cash_lpalok?inv=<?php echo $f['inv'] ?>&ket=<?php echo $f['remark']; ?>" target="_blank" class="d-none d-xl-inline-block btn btn-sm btn-primary <?= $f['vendor']<>$u['name'] || $u['access']=='Manager' ? 'disabled' : '' ?>"><span data-feather="printer"></span></a>
              </div>
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
