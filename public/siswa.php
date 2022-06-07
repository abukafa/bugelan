<?php 
error_reporting(0);
include_once 'header.php';
include_once '../admin/config.php';
if(date('m')<7){
  $thn=date('Y')-1;
}else{
  $thn=date('Y');
}
?>
<main class="content">
	<div class="container mt-5">
	<p class="display-6 text-center mb-2">Data Siswa</p>
	<p class="h5 text-center mb-3"><?php echo date('D, d M Y') . $thn ?></p>
	<div class="d-flex mb-3">
		<div class="col-6 col-md-4 col-lg-3">
			<!-- Filter Data Santri -->
			<form action="" method="get">
				<div class="input-group">
					<label class="input-group-text" for="thn"><span data-feather="search"></span></label>
					<select type="submit" id="thn" name="thn" class="form-select" onchange="this.form.submit()">
						<option>.. Pilih ..</option>
						<option value="<?= $thn-2 ?>">Kelas 9</option>
						<option value="<?= $thn-1 ?>">Kelas 8</option>
						<option value="<?= $thn ?>">Kelas 7</option>
					</select>
				</div>
			</form>
		</div>
	</div>
	<div class="card">
		<div class="card-header">
			<div class="card-body">
				<table class="table table-hover table-strip">
					<tr>
						<th class="d-none d-md-table-cell">NISN</th>
						<th>Nama Siswa</th>
						<th>Kelas</th>
						<th class="d-none d-md-table-cell">TTL</th>
						<th class="d-none d-lg-table-cell">Nama Ayah</th>
						<th class="d-none d-lg-table-cell">Nama Ibu</th>
					</tr>
					<?php 
					if(isset($_GET['thn'])){
						$tahun=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_GET['thn']);
						$brg=mysqli_query($GLOBALS["___mysqli_ston"], "select * from siswa where tahun = '$tahun' order by nama");
					}else{
						$jumlah_record=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * from siswa");
						$per_hal=20;
						$jum=mysqli_num_rows($jumlah_record);
						$halaman=ceil($jum / $per_hal);
						$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
						$start = ($page - 1) * $per_hal;
						$brg=mysqli_query($GLOBALS["___mysqli_ston"], "select * from siswa order by tahun, nama limit $start, $per_hal");
					}
					$no=1;
					while($b=mysqli_fetch_array($brg)){
					?>
					<tr>
						<td class="d-none d-md-table-cell"><?php echo $b['nisn'] ?></td>
						<td><?php echo $b['nama'] ?></td>
						<td><?php echo $thn - $b['tahun'] + 7 ?></td>
						<td class="d-none d-md-table-cell"><?php echo $b['tempat_lahir'] .', '. date_format(date_create($b['tanggal_lahir']),'d M Y') ?></td>
						<td class="d-none d-lg-table-cell"><?php echo $b['nama_ayah'] ?></td>
						<td class="d-none d-lg-table-cell"><?php echo $b['nama_ibu'] ?></td>
					</tr>		
					<?php 
					}
					?>
				</table>
		
				<!-- Pagination -->
				<?php
				if(!isset($_GET['thn'])){ ?>
					<div class="text-center mt-5"><?php echo $jum; ?> Records in <?php echo $halaman; ?> pages </div>
					<ul class="pagination justify-content-center">			
						<li class="page-item"><a class="page-link" href="?page=1">First</a></li>
						<li class="page-item <?php if($page <= 1){ echo 'disabled'; } ?>">
							<a class="page-link" href="<?php if($page <= 1){ echo '#'; } else { echo "?page=".($page - 1); } ?>"><<</a>
						</li>
						<li class="page-item disabled"><a class="page-link"><?php echo $page; ?></a></li>
						<li class="page-item <?php if($page >= $halaman){ echo 'disabled'; } ?>">
							<a class="page-link" href="<?php if($page >= $halaman){ echo '#'; } else { echo "?page=".($page + 1); } ?>">>></a>
						</li>	
						<li class="page-item"><a class="page-link" href="?page=<?php echo $halaman ?>">Last</a></li>				
					</ul>
				<?php } ?>
			</div>
		</div>
	</div>
</main>
<script>
    feather.replace({ 'aria-hidden': 'true' })
</script>