<?php 
include 'navbar.php';
if(isset($_GET['id'])){
	$id=$_GET['id'];
	$guru=myquery("select * from guru where id=" . $id);
	$gu=$guru[0];
}else{
	$id='';
}
if(date('m')<7){
	$thn=date('Y')-1;
}else{
	$thn=date('Y');
}
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      	<h1 class="h2"><?= ($id=='') ? 'Tambah' : 'Ubah' ?> Data Guru</h1>
		<a href="guru"><button type="button" class="btn btn-sm btn-outline-secondary"><span data-feather="plus-circle"></span>
          Kembali
        </button></a>
    </div>
		<form class="row g-3 mt-3" action="guru_act?<?= ($id=='') ? 'tambah' : 'ubah=' . $gu['id'] ?>" method="post" enctype="multipart/form-data">
			<div class="col-5 col-xl-3">
				<?php if($id<>'' && file_exists("../public/foto/" . $gu['nig'] . ".jpg")){?>
				<img class="img-responsive w-75 rounded-3" id="preview" src="../public/foto/<?= $gu['nig'] ?>.jpg">
				<?php }else{ ?>
				<img class="img-responsive w-75 rounded-3" id="preview" src="../public/foto/no.png">
				<?php } ?>
			</div>
			<div class="col-7 col-xl-9">
				<div class="row mb-2">
					<div class="col-xl-8 mb-2">
						<label class="form-label"><b>NAMA LENGKAP</b></label>
						<input type="text" class="form-control" name="nama" value="<?= ($id<>'') ? $gu['nama'] : '' ?>">
					</div>
					<div class="col-xl-4 mb-2">
						<label class="form-label">NIG</label>
						<input type="text" class="form-control" name="nig" value="<?= ($id<>'') ? $gu['nig'] : '' ?>">
					</div>
					<div class="col-xl-4 mb-2">
						<label class="form-label">Jenis Kelamin</label>
						<select type="text" class="form-select" name="jk">
							<option value="<?= ($id<>'') ? $gu['jk'] : '' ?>"><?= ($id<>'' && $gu['jk']=='L') ? 'Laki-laki' : (($id<>'' && $gu['jk']=='P') ? 'Perempuan' : '') ?></option>
							<option value="L">Laki-laki</option>
							<option value="P">Perempuan</option>
						</select>
					</div>
					<div class="col-xl-4 mb-2">
						<label class="form-label">TTL</label>
						<div class="input-group">
							<input type="text" class="form-control" name="tempat_lahir" value="<?= ($id<>'') ? $gu['tempat_lahir'] : '' ?>">
							<input type="text" class="form-control" name="tanggal_lahir" value="<?= ($id<>'') ? $gu['tanggal_lahir'] : '' ?>" id="tgl_lahir" autocomplete="off" placeholder="yyyy-mm-dd">
						</div>
					</div>
					<div class="col-xl-4 mb-2">
						<label class="form-label">Foto 3x4</label>
						<div class="input-group">
							<input type="file" class="form-control" name="file" id="file" accept=".jpg" onchange="imgPreview()">
						</div>
					</div>
					<div class="col-md-4">	
						<label class="form-label"><b>Status</b></label>
						<input type="text" class="form-control" name="status" value="<?= ($id<>'') ? $gu['status'] : '' ?>">
					</div>		
					<div class="col-md-4">	
						<label class="form-label"><b>Jabatan</b></label>
						<input type="text" class="form-control" name="jabatan" value="<?= ($id<>'') ? $gu['jabatan'] : '' ?>">
					</div>
					<div class="col-md-4">	
						<label class="form-label"><b>Keterangan</b></label>
						<input type="text" class="form-control" name="ket" value="<?= ($id<>'') ? $gu['ket'] : '' ?>">
					</div>
				</div>
			</div>

			<div class="col-xl-6 mb-2">
				<label class="form-label"><b>ALAMAT</b></label>
				<input type="text" class="form-control" name="alamat" value="<?= ($id<>'') ? $gu['alamat'] : '' ?>">
			</div>
			<div class="col-xl-3 mb-2">
				<label class="form-label">RT/RW</label>
				<div class="input-group">
					<input type="text" class="form-control" name="rt" value="<?= ($id<>'') ? $gu['rt'] : '' ?>" placeholder="RT">
					<input type="text" class="form-control" name="rw" value="<?= ($id<>'') ? $gu['rw'] : '' ?>" placeholder="RW">
				</div>
			</div>		
			<div class="col-xl-3 mb-2">
				<label class="form-label">Dusun</label>
				<input type="text" class="form-control" name="dusun" value="<?= ($id<>'') ? $gu['dusun'] : '' ?>">
			</div>
			<div class="col-xl-3 mb-2">
				<label class="form-label">Kelurahan</label>
				<input type="text" class="form-control" name="kelurahan" value="<?= ($id<>'') ? $gu['kelurahan'] : '' ?>">
			</div>
			<div class="col-xl-3 mb-2">
				<label class="form-label">Kecamatan</label>
				<input type="text" class="form-control" name="kecamatan" value="<?= ($id<>'') ? $gu['kecamatan'] : '' ?>">
			</div>
			<div class="col-xl-3 mb-2">
				<label class="form-label">Kode Pos</label>
				<input type="text" class="form-control" name="kode_pos" value="<?= ($id<>'') ? $gu['kode_pos'] : '' ?>">
			</div>			
			<div class="col-xl-3 mb-2">
				<label class="form-label">No. Handphone</label>
				<input type="text" class="form-control" name="hp" value="<?= ($id<>'') ? $gu['hp'] : '' ?>">
			</div>			
            <div class="mt-4 mb-5">  
				<button type="submit" class="btn btn-primary" name="save">Simpan</button>
				<a href="guru"><button type="button" class="btn btn-secondary">Batal</button></a>
			</div>
		</form>
  	</div>
</main>
<br>

<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">
	//   Selektor Tanggal
	$(function() {
		$('#tgl_lahir').datepicker({ 
		autoclose: true,
		todayHighlight: true,
		format : 'yyyy-mm-dd' 
		});
	});
	$(function() {
		$('#tl_ayah').datepicker({ 
		autoclose: true,
		todayHighlight: true,
		format : 'yyyy-mm-dd' 
		});
	});
	$(function() {
		$('#tl_ibu').datepicker({ 
		autoclose: true,
		todayHighlight: true,
		format : 'yyyy-mm-dd' 
		});
	});
	$(function() {
		$('#tl_wali').datepicker({ 
		autoclose: true,
		todayHighlight: true,
		format : 'yyyy-mm-dd' 
		});
	});
	
	$('#tahun').keyup(function(){
		const thn = <?= $thn ?> ;
		$('#kelas').val('KLS ' + (thn - $(this).val() + 7));
	});

	function imgPreview(){
		const img = document.querySelector('#file');
		const preview = document.querySelector('#preview');

		preview.style.display = 'block';

		const oFReader = new FileReader();
		oFReader.readAsDataURL(img.files[0]);

		oFReader.onload = function(oFREvent){
			preview.src = oFREvent.target.result;
		}
	}
</script>