<?php 
include 'navbar.php';

$p = date('M Y');
$n = date('Y-m-d');
$w = date('Y-m-d', strtotime('-1 week'));
$m = date('Y-m-d', strtotime('-1 month'));
$s = date('Y-m-d', strtotime('-6 month'));
$y = date('Y-m-d', strtotime('-1 year'));

if(date('m')<7){
  $thn=date('Y')-1;
}else{
  $thn=date('Y');
}
$alm=$thn-3;
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Tabungan</h1>
      <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#myModal">Menabung</button>
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
  <?php flash(); 
  if(isset($_GET['tgl_awl'])){
      $awl=$_GET['tgl_awl'];
      $jum_sum=mysqli_query($conn, "SELECT sum(debit) as dbt, sum(kredit) as kdt from tabungan where tgl between '$awl' and '$n' ");
while($see=mysqli_fetch_assoc($jum_sum)){
  $jml_sum = $see['dbt'] - $see['kdt'];
}
      echo "
      <div class='d-flex justify-content-between'>
      <h6>" . $awl . " s.d. " . $n . " : " . number_format($jml_sum,0,'',',') . "</h6>
      <div class='btn-group float-end'>
      <button type='button' class='btn btn-sm btn-outline-primary'>
        <a href='tabungan_laphis?tgl_awal=". $awl ."&tgl_ahir=". $n ."' target='_blank' style='text-decoration:none'>Rekap</a>
      </button>
      <button type='button' class='btn btn-sm btn-outline-primary'>
        <a href='tabungan_lapsum' target='_blank' style='text-decoration:none'>Index</a>
      </button>
      <button class='btn btn-sm btn-primary'><span data-feather='printer'></span></button>
      </div>
      </div>
      <br/>";
  }
  ?>
  </div>
    
  <br/>
  <div class="container-fluid">
    <div class="table-responsive">
      <table class="table table-striped table-hover table-sm">
        <thead>
          <tr>
            <th class="d-none d-md-table-cell">No</th>
            <th>Tanggal</th>
            <th>Nama</th>
            <th class="text-end">Debit</th>			
            <th class="d-none d-md-table-cell text-end">Kredit</th>
            <th class="d-none d-md-table-cell text-end">Saldo</th>		
            <th></th>
          </tr>
        </thead>
        <tbody>
            <?php 
            $per_hal=30;
            $jumlah_record=mysqli_query($conn, "SELECT * from tabungan");
            $jum=mysqli_num_rows($jumlah_record);
            $halaman=ceil($jum / $per_hal);
            $page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
            $start = ($page - 1) * $per_hal;
            
            if(isset($_GET['tgl_awl'])){
                $awl=$_GET['tgl_awl'];
                $brg=mysqli_query($conn, "select * from tabungan where tgl between '$awl' and '$n' order by tgl");
            }else{
                $brg=mysqli_query($conn, "select * from tabungan order by id desc limit $start, $per_hal");
            }
            while($b=mysqli_fetch_array($brg)){
                ?>
                <tr>
                    <td class="d-none d-md-table-cell"><?php echo $b['id'] ?></td>
                    <td><?php echo $b['tgl'] ?></td>
                    
                    <td><?php echo substr($b['nama'], 0, 20) ?></td>
                    <td class="text-end"><?php echo number_format($b['debit'],0,'',','); ?></td>		
                    <td class="text-end d-none d-md-table-cell"><?php echo number_format($b['kredit'],0,'',','); ?></td>
                    
                    <?php
                    $ids=$b['id_siswa'];
                    $tot=mysqli_query($conn, "select sum(debit) as dbt, sum(kredit) as kdt from tabungan where id_siswa='$ids'");
                    while($see=mysqli_fetch_assoc($tot)){
                        $jml = $see['dbt'] - $see['kdt'];
                        ?>
                        <td class="text-end d-none d-md-table-cell"><?php echo number_format($jml,0,'',','); ?></td>
                    
                    <?php
                    }
                    ?>
                    <td class="text-end">		
                        <a href="tabungan_lapown?id=<?php echo $b['id_siswa']; ?>"  target="_blank"  class="d-none d-md-inline-block btn btn-sm btn-primary"><span data-feather='printer'></span></a>
                        <?php
                        if ($u['access']=="Programmer" or $u['access']=="Manager"){
                        ?>
                        <button class="btn btn-sm btn-danger delete-<?php echo $b['id']; ?>"><span data-feather="trash-2"></span></button></button>
                        <script>
                            document.querySelector('.delete-<?php echo $b['id']; ?>').onclick = function(){
                            swal({
                            title: "Yakin?",
                            text: "Data tidak bisa dikembalikan!",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonClass: "btn-danger",
                            confirmButtonText: "Delete",
                            closeOnConfirm: false
                            },
                            function(){
                            location.href="tabungan_act?hapus=<?php echo $b['id']; ?>";
                            });
                            };
                        </script>
                        <?php
                        }
                        ?>
                    </td>
                </tr>
                <?php 
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

<!-- modal input -->
<div id="myModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="staticBackdropLabel">Input Data</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">				
				<form action="tabungan_act?tambah" method="post">	
					<div class="form-group mb-2">
						<label class="form-label">Tanggal</label>
						<input name="tgl" id="tgl" type="text" class="form-control form-control-sm" value="<?= date('Y-m-d') ?>" autocomplete="off">
					</div>			
					<div class="form-group mb-2">
						<label class="form-label">Siswa</label>								
						<select name="ids" id="ids" class="form-control form-control-sm" onchange="changeValue(this.value)">
							<option value=0>-Pilih-</option>
							<?php 
							$brg=mysqli_query($conn, "select * from siswa where tahun<>'$alm' order by tahun, nama");
							$jsArray = "var sant = new Array();\n";        
							while($b=mysqli_fetch_array($brg)){
							echo '<option value="' . $b['id'] . '">' . $b['nama'] . '</option>';
							
							$jml=mysqli_query($conn, "select sum(if(id_siswa=". $b['id'] .", debit, 0)) as dbt, sum(if(id_siswa=". $b['id'] .", kredit, 0)) as kdt from tabungan");
							while($s=mysqli_fetch_assoc($jml)){

							$jsArray .= "sant['" . $b['id'] . "'] = {nama:'" . addslashes($b['nama']) . "',ket_wali:'".addslashes($b['nama_ayah']) . "',dbt:'".addslashes($s['dbt']) . "',kdt:'".addslashes($s['kdt']) . "'};\n";
							}
							}
							?>
						</select>
					</div>				
					<div class="form-group mb-2">
						<label class="form-label">Nama</label>
						<input name="nama" type="text" class="form-control form-control-sm" id="nama" readonly="yes">
					</div>	
					<div class="form-group mb-2">
						<label class="form-label">Nama Wali</label>
						<input name="wali" type="text" class="form-control form-control-sm" id="wali" readonly="yes">
					</div>				
					<div class="form-group mb-2">
						<label class="form-label">Saldo</label>
						<input name="saldo" id="saldo" type="text" class="form-control form-control-sm" autocomplete="off" readonly="yes" >
					</div>	
					<div class="form-group mb-2">
						<label class="form-label">Debit</label>
						<input name="debit" id="debit" type="text" class="form-control form-control-sm" value="0" autocomplete="off">
					</div>			
					<div class="form-group mb-2">
						<label class="form-label">Kredit</label>
						<input name="kredit" id="kredit" type="text" class="form-control form-control-sm" value="0" autocomplete="off">
					</div>	
					<div class="form-group mb-2">
						<label class="form-label">Keterangan</label>
						<input name="ket" type="text" class="form-control form-control-sm" autocomplete="off" value="-" >
					</div>		

					<script type="text/javascript">    
					<?php echo $jsArray; ?>  
					function changeValue(nis){  
					document.getElementById('nama').value = sant[nis].nama;
					document.getElementById('wali').value = sant[nis].ket_wali;
					document.getElementById('saldo').value = sant[nis].dbt-sant[nis].kdt;
					};  
					</script>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Save</button>
					</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">
  feather.replace({ 'aria-hidden': 'true' })
    $(function() {
        $('#tgl').datepicker({ 
          autoclose: true,
          todayHighlight: true,
          format : 'yyyy-mm-dd' 
        });
      });
</script>