<?php 
error_reporting(0);
include_once 'header.php';
include_once '../admin/config.php';
if(date('m')<7){
  $thn=date('Y')-1;
}else{
  $thn=date('Y');
}
$alm=$thn-3;
?>
<main class="content">
	<div class="container mt-5">
	<p class="display-6 text-center mb-2">Data Siswa</p>
	<p class="h5 text-center mb-3"><?php echo date('D, d M Y') ?></p>
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
						<th class="d-none d-md-table-cell">Nomor Induk</th>
						<th>Nama Siswa</th>
						<th class="d-none d-md-table-cell">Kelas</th>
						<th class="d-none d-md-table-cell">TTL</th>
						<th class="d-none d-lg-table-cell">Nama Ayah</th>
						<th class="d-none d-lg-table-cell">Nama Ibu</th>
						<th class="text-center">Data</th>
					</tr>
					<?php 
					if(isset($_GET['thn'])){
						$tahun=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_GET['thn']);
						$brg=mysqli_query($GLOBALS["___mysqli_ston"], "select * from siswa where tahun = '$tahun' order by nama");
					}else{
						$jumlah_record=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * from siswa where tahun <> '$alm'");
						$per_hal=20;
						$jum=mysqli_num_rows($jumlah_record);
						$halaman=ceil($jum / $per_hal);
						$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
						$start = ($page - 1) * $per_hal;
						$brg=mysqli_query($GLOBALS["___mysqli_ston"], "select * from siswa where tahun <> '$alm' order by tahun, nama limit $start, $per_hal");
					}
					$no=1;
					while($b=mysqli_fetch_array($brg)){
					?>
					<tr>
						<td class="d-none d-md-table-cell"><?php echo $b['nisn'] ?></td>
						<td><?php echo $b['nama'] ?></td>
						<td class="d-none d-md-table-cell"><?php echo $thn - $b['tahun'] + 7 ?></td>
						<td class="d-none d-md-table-cell"><?php echo $b['tempat_lahir'] .', '. date_format(date_create($b['tanggal_lahir']),'d M Y') ?></td>
						<td class="d-none d-lg-table-cell"><?php echo $b['nama_ayah'] ?></td>
						<td class="d-none d-lg-table-cell"><?php echo $b['nama_ibu'] ?></td>
						<td class="text-center">
                        	<a class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#modal-<?php echo $b['id'] ?>"><span data-feather="eye"></span></a>
                      </td>
					</tr>		
					<!-- Modal View Data-->
					<div class="modal fade" id="modal-<?php echo $b['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLiveLabel" aria-hidden="true">
						<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
							<h5 class="modal-title" id="modalLabel">Siswa Penggerak</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">
							<form>
								<div class="text-center">
								<?php if(file_exists("foto/" . $b['id'] . ".jpg")){?>
								<img class="img-responsive w-50 rounded-3" id="preview" src="foto/<?= $b['id'] ?>.jpg">
								<?php }else{ ?>
								<img class="img-responsive w-50 rounded-3" id="preview" src="foto/no.png">
								<?php } ?>
								</div>
								<div class="my-2">
								<label class="form-label" for="kode">Nama</label>
								<input type="text" class="form-control form-control" id="kd" value="<?php echo $b['nama'] ?>" disabled>
								</div>
								<div class="mb-2">
								<label class="form-label" for="des">NISN</label>
								<input type="textarea" class="form-control form-control" name="des" value="<?php echo $b['nisn'] ?>" disabled>
								</div>
								<div class="mb-2">
								<label class="form-label" for="nama">Tahun Masuk</label> 
								<input type="text" class="form-control form-control" name="nama" value="<?php echo $b['tahun'] ?>" disabled>
								</div>
								<div class="mb-2">
								<label class="form-label" for="des">Nama Ayah</label>
								<input type="textarea" class="form-control form-control" name="des" value="<?php echo $b['nama_ayah'] ?>" disabled>
								</div>
								<div class="mb-2">
								<label class="form-label" for="des">Nama Ibu</label>
								<input type="textarea" class="form-control form-control" name="des" value="<?php echo $b['nama_ibu'] ?>" disabled>
								</div>
							</form>
							</div>

						</div>
						</div>
					</div> 
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