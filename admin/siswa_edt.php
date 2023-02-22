<?php 
include 'navbar.php';
if(isset($_GET['id'])){
	$id=$_GET['id'];
	$siswa=myquery("select * from siswa where id=" . $id);
	$si=$siswa[0];
}else{
	$id='';
	$si=[];
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
      	<h1 class="h2"><?= ($id=='') ? 'Tambah' : 'Ubah' ?> Data Siswa</h1>
		<a href="siswa"><button type="button" class="btn btn-sm btn-outline-secondary"><span data-feather="plus-circle"></span>
          Kembali
        </button></a>
    </div>
		<form class="row g-3" action="siswa_act?<?= ($id=='') ? 'tambah' : 'ubah=' . $si['id'] ?>" method="post" enctype="multipart/form-data">
			<div class="row g-3">
				<div class="col-5 col-xl-3">
					<?php if($id<>'' && file_exists("../public/foto/" . $id . ".jpg")){?>
					<img class="img-responsive w-75 rounded-3" id="preview" src="../public/foto/<?= $id ?>.jpg">
					<?php }else{ ?>
					<img class="img-responsive w-75 rounded-3" id="preview" src="../public/foto/no.png">
					<?php } ?>
				</div>
				<div class="col-7 col-xl-9">
					<div class="row mb-2">
						<div class="col-xl-4 mb-2">
							<label class="form-label"><b>NAMA LENGKAP</b></label>
							<input type="text" class="form-control" name="nama" value="<?= ($id<>'') ? $si['nama'] : '' ?>">
						</div>
						<div class="col-xl-4 mb-2">
							<label class="form-label">Nomor Induk</label>
							<input type="text" class="form-control" name="nisn" value="<?= ($id<>'') ? $si['nisn'] : '' ?>">
						</div>
						<div class="col-xl-4 mb-2">
							<label class="form-label">NIPD</label>
							<input type="text" class="form-control" name="nipd" value="<?= ($id<>'') ? $si['nipd'] : '' ?>">
						</div>
						<div class="col-xl-4 mb-2">
							<label class="form-label">NIK</label>
							<input type="text" class="form-control" name="nik" value="<?= ($id<>'') ? $si['nik'] : '' ?>">	
						</div>
						<div class="col-xl-4 mb-2">
							<label class="form-label">Jenis Kelamin</label>
							<select type="text" class="form-select" name="jk">
								<option value="<?= ($id<>'') ? $si['jk'] : '' ?>"><?= ($id<>'' && $si['jk']=='L') ? 'Laki-laki' : (($id<>'' && $si['jk']=='P') ? 'Perempuan' : '') ?></option>
								<option value="L">Laki-laki</option>
								<option value="P">Perempuan</option>
							</select>
						</div>
						<div class="col-xl-4 mb-2">
							<label class="form-label">TTL</label>
							<div class="input-group">
								<input type="text" class="form-control" name="tempat_lahir" value="<?= ($id<>'') ? $si['tempat_lahir'] : '' ?>">
								<input type="text" class="form-control" name="tanggal_lahir" value="<?= ($id<>'') ? $si['tanggal_lahir'] : '' ?>" id="tgl_lahir" autocomplete="off" placeholder="yyyy-mm-dd">
							</div>
						</div>
						<div class="col-xl-4 mb-2">
							<label class="form-label">Anak ke</label>
							<div class="input-group">
								<input type="text" class="form-control" name="anak_ke" value="<?= ($id<>'') ? $si['anak_ke'] : '' ?>">
								<input type="text" class="form-control" name="jml_saudara" value="<?= ($id<>'') ? $si['jml_saudara'] : '' ?>" placeholder="Jml saudara">
							</div>
						</div>
						<div class="col-xl-4 mb-2">
							<label class="form-label">Tahun</label>
							<div class="input-group">
								<input type="text" class="form-control" name="tahun" id="tahun" value="<?= ($id<>'') ? $si['tahun'] : $thn ?>">
								<input type="text" class="form-control" name="kelas" id="kelas" value="KLS <?= ($id<>'') ? ($thn-$si['tahun'])+7 : 7 ?>" readonly>
							</div>
						</div>
						<div class="col-xl-4 mb-2">
							<label class="form-label">Foto 3x4</label>
							<div class="input-group">
								<input type="file" class="form-control" name="file" id="file" accept=".jpg" onchange="imgPreview()">
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-xl-3">
				<label class="form-label"><b>ALAMAT</b></label>
				<input type="text" class="form-control" name="alamat" value="<?= ($id<>'') ? $si['alamat'] : '' ?>">
			</div>
			<div class="col-xl-3">
				<label class="form-label">RT/RW</label>
				<div class="input-group">
					<input type="text" class="form-control" name="rt" value="<?= ($id<>'') ? $si['rt'] : '' ?>" placeholder="RT">
					<input type="text" class="form-control" name="rw" value="<?= ($id<>'') ? $si['rw'] : '' ?>" placeholder="RW">
				</div>
			</div>		
			<div class="col-xl-3">	
				<label class="form-label">Dusun</label>
				<input type="text" class="form-control" name="dusun" value="<?= ($id<>'') ? $si['dusun'] : '' ?>">
			</div>
			<div class="col-xl-3">	
				<label class="form-label">Kelurahan</label>
				<input type="text" class="form-control" name="kelurahan" value="<?= ($id<>'') ? $si['kelurahan'] : '' ?>">
			</div>

			<div class="col-xl-3">
				<label class="form-label">Kecamatan</label>
				<input type="text" class="form-control" name="kecamatan" value="<?= ($id<>'') ? $si['kecamatan'] : '' ?>">
			</div>
			<div class="col-xl-3">	
				<label class="form-label">Kode Pos</label>
				<input type="text" class="form-control" name="kode_pos" value="<?= ($id<>'') ? $si['kode_pos'] : '' ?>">
			</div>
			<div class="col-xl-3">	
				<label class="form-label">Jenis Tempat Tinggal</label>
				<input type="text" class="form-control" name="jenis_tinggal" value="<?= ($id<>'') ? $si['jenis_tinggal'] : '' ?>">
			</div>
			<div class="col-xl-3">	
				<label class="form-label">Jarak Rumah</label>
				<input type="text" class="form-control" name="jarak_rumah" value="<?= ($id<>'') ? $si['jarak_rumah'] : '' ?>">
			</div>	

			<div class="col-xl-3">	
				<label class="form-label">Transportasi</label>
				<input type="text" class="form-control" name="alat_transportasi" value="<?= ($id<>'') ? $si['alat_transportasi'] : '' ?>">
			</div>	
			<div class="col-xl-3">		
				<label class="form-label">No. Telepon</label>
				<input type="text" class="form-control" name="hp" value="<?= ($id<>'') ? $si['hp'] : '' ?>">
			</div>	
			<div class="col-xl-3">		
				<label class="form-label">Email</label>
				<input type="text" class="form-control" name="email" value="<?= ($id<>'') ? $si['email'] : '' ?>">
			</div>	
			<div class="col-xl-3">
				<label class="form-label">Agama</label>
				<input type="text" class="form-control" name="agama" value="<?= ($id<>'') ? $si['agama'] : '' ?>">
			</div>

			<div class="col-xl-3">		
				<label class="form-label"><b>Nama Ayah</b></label>
				<input type="text" class="form-control" name="nama_ayah" value="<?= ($id<>'') ? $si['nama_ayah'] : '' ?>">
			</div>	
			<div class="col-xl-3">	
				<label class="form-label">NIK Ayah</label>
				<input type="text" class="form-control" name="nik_ayah" value="<?= ($id<>'') ? $si['nik_ayah'] : '' ?>">
			</div>	
			<div class="col-xl-3">	
				<label class="form-label">Tgl Lahir & PDD</label>
				<div class="input-group">
					<input type="text" class="form-control" name="tl_ayah" id="tl_ayah" value="<?= ($id<>'') ? $si['tl_ayah'] : '' ?>" placeholder="yyyy-mm-dd">
					<input type="text" class="form-control" name="pendidikan_ayah" value="<?= ($id<>'') ? $si['pendidikan_ayah'] : '' ?>" placeholder="Pendidikan">
				</div>
			</div>	
			<div class="col-xl-3">	
				<label class="form-label">Pekerjaan</label>
				<div class="input-group">
					<input type="text" class="form-control" name="pekerjaan_ayah" value="<?= ($id<>'') ? $si['pekerjaan_ayah'] : '' ?>" placeholder="Kerja">
					<input type="text" class="form-control" name="penghasilan_ayah" value="<?= ($id<>'') ? $si['penghasilan_ayah'] : '' ?>" placeholder="Penghasilan">
				</div>
			</div>	

			<div class="col-xl-3">		
				<label class="form-label"><b>Nama Ibu</b></label>
				<input type="text" class="form-control" name="nama_ibu" value="<?= ($id<>'') ? $si['nama_ibu'] : '' ?>">
			</div>	
			<div class="col-xl-3">	
				<label class="form-label">NIK Ibu</label>
				<input type="text" class="form-control" name="nik_ibu" value="<?= ($id<>'') ? $si['nik_ibu'] : '' ?>">
			</div>	
			<div class="col-xl-3">	
				<label class="form-label">Tgl Lahir & PDD</label>
				<div class="input-group">
					<input type="text" class="form-control" name="tl_ibu" id="tl_ibu" value="<?= ($id<>'') ? $si['tl_ibu'] : '' ?>" placeholder="yyyy-mm-dd">
					<input type="text" class="form-control" name="pendidikan_ibu" value="<?= ($id<>'') ? $si['pendidikan_ibu'] : '' ?>" placeholder="Pendidikan">
				</div>
			</div>	
			<div class="col-xl-3">	
				<label class="form-label">Pekerjaan</label>
				<div class="input-group">
					<input type="text" class="form-control" name="pekerjaan_ibu" value="<?= ($id<>'') ? $si['pekerjaan_ibu'] : '' ?>" placeholder="Kerja">
					<input type="text" class="form-control" name="penghasilan_ibu" value="<?= ($id<>'') ? $si['penghasilan_ibu'] : '' ?>" placeholder="Penghasilan">
				</div>
			</div>	

			<div class="col-xl-3">		
				<label class="form-label"><b>Nama Wali</b></label>
				<input type="text" class="form-control" name="nama_wali" value="<?= ($id<>'') ? $si['nama_wali'] : '' ?>">
			</div>	
			<div class="col-xl-3">	
				<label class="form-label">NIK Wali</label>
				<input type="text" class="form-control" name="nik_wali" value="<?= ($id<>'') ? $si['nik_wali'] : '' ?>">
			</div>	
			<div class="col-xl-3">	
				<label class="form-label">Tgl Lahir & PDD</label>
				<div class="input-group">
					<input type="text" class="form-control" name="tl_wali" id="tl_wali" value="<?= ($id<>'') ? $si['tl_wali'] : '' ?>" placeholder="yyyy-mm-dd">
					<input type="text" class="form-control" name="pendidikan_wali" value="<?= ($id<>'') ? $si['pendidikan_wali'] : '' ?>" placeholder="Pendidikan">
				</div>
			</div>	
			<div class="col-xl-3">	
				<label class="form-label">Pekerjaan</label>
				<div class="input-group">
					<input type="text" class="form-control" name="pekerjaan_wali" value="<?= ($id<>'') ? $si['pekerjaan_wali'] : '' ?>" placeholder="Kerja">
					<input type="text" class="form-control" name="penghasilan_wali" value="<?= ($id<>'') ? $si['penghasilan_wali'] : '' ?>" placeholder="Penghasilan">
				</div>
			</div>	

			<div class="col-xl-3">		
				<label class="form-label">SKHUN</label>
				<input type="text" class="form-control" name="skhun" value="<?= ($id<>'') ? $si['skhun'] : '' ?>">
			</div>	
			<div class="col-xl-3">	
				<label class="form-label">NPUN</label>
				<input type="text" class="form-control" name="npun" value="<?= ($id<>'') ? $si['npun'] : '' ?>">
			</div>	
			<div class="col-xl-3">	
				<label class="form-label">No. Ijazah</label>
				<input type="text" class="form-control" name="no_seri_ijazah" value="<?= ($id<>'') ? $si['no_seri_ijazah'] : '' ?>">
			</div>	
			<div class="col-xl-3">	
				<label class="form-label">No. KKS</label>
				<input type="text" class="form-control" name="nomor_kks" value="<?= ($id<>'') ? $si['nomor_kks'] : '' ?>">
			</div>	
			
			<div class="col-xl-3">	
				<label class="form-label"><b>KSP</b></label>
				<div class="input-group">
					<select type="text" class="form-select" name="penerima_kps">
						<option><?= ($id<>'') ? $si['penerima_kps'] : '' ?></option>
						<option>Ya</option>
						<option>Tidak</option>
					</select>
					<input type="text" class="form-control" name="no_kps" value="<?= ($id<>'') ? $si['no_kps'] : '' ?>" placeholder="Nomor">
				</div>
			</div>	
			<div class="col-xl-3">	
				<label class="form-label"><b>KIP</b></label>
				<div class="input-group">
					<select type="text" class="form-select" name="penerima_kip">
						<option><?= ($id<>'') ? $si['penerima_kip'] : '' ?></option>
						<option>Ya</option>
						<option>Tidak</option>
					</select>
					<input type="text" class="form-control" name="nomor_kip" value="<?= ($id<>'') ? $si['nomor_kip'] : '' ?>" placeholder="Nomor">
				</div>
			</div>	
			<div class="col-xl-3">	
				<label class="form-label">Nama KIP</label>
				<input type="text" class="form-control" name="nama_di_kip" value="<?= ($id<>'') ? $si['nama_di_kip'] : '' ?>">
			</div>	
			<div class="col-xl-3">	
				<label class="form-label"><b>Layak PIP</b></label>
				<div class="input-group">
				<select type="text" class="form-select" name="layak_pip">
					<option><?= ($id<>'') ? $si['layak_pip'] : '' ?></option>
					<option>Ya</option>
					<option>Tidak</option>
				</select>
				<input type="text" class="form-control" name="alasan_layak_pip" value="<?= ($id<>'') ? $si['alasan_layak_pip'] : '' ?>" placeholder="Alasan">
				</div>
			</div>	

			<div class="col-xl-3">	
				<label class="form-label">Bank</label>
				<input type="text" class="form-control" name="bank" value="<?= ($id<>'') ? $si['bank'] : '' ?>">
			</div>	
			<div class="col-xl-3">	
				<label class="form-label">No. Rekening</label>
				<input type="text" class="form-control" name="nomor_rekening_bank" value="<?= ($id<>'') ? $si['nomor_rekening_bank'] : '' ?>">
			</div>	
			<div class="col-xl-3">	
				<label class="form-label">a/n</label>
				<input type="text" class="form-control" name="rekening_atas_nama" value="<?= ($id<>'') ? $si['rekening_atas_nama'] : '' ?>">
			</div>	
			<div class="col-xl-3">	
				<label class="form-label">Berkebutuhan Khusus</label>
				<input type="text" class="form-control" name="kebutuhan_khusus" value="<?= ($id<>'') ? $si['kebutuhan_khusus'] : '' ?>">
			</div>	

			<div class="col-xl-3">	
				<label class="form-label">Akta Lahir</label>
				<input type="text" class="form-control" name="no_registrasi_akta_lahir" value="<?= ($id<>'') ? $si['no_registrasi_akta_lahir'] : '' ?>">
			</div>	
			<div class="col-xl-3">	
				<label class="form-label">No. KK</label>
				<input type="text" class="form-control" name="no_kk" value="<?= ($id<>'') ? $si['no_kk'] : '' ?>">
			</div>	
			<div class="col-xl-3">	
				<label class="form-label">BB / TB</label>
				<div class="input-group">
					<input type="text" class="form-control" name="berat_badan" value="<?= ($id<>'') ? $si['berat_badan'] : '' ?>" placeholder="Berat">
					<input type="text" class="form-control" name="tinggi_badan" value="<?= ($id<>'') ? $si['tinggi_badan'] : '' ?>" placeholder="Tinggi">
				</div>
			</div>	
			<div class="col-xl-3">	
				<label class="form-label">Lingkar Kepala</label>
				<input type="text" class="form-control" name="lingkar_kepala" value="<?= ($id<>'') ? $si['lingkar_kepala'] : '' ?>">
			</div>	

			<div class="col-xl-3">	
				<label class="form-label"><b>Sekolah Asal</b></label>
				<input type="text" class="form-control" name="sekolah_asal" value="<?= ($id<>'') ? $si['sekolah_asal'] : '' ?>">
			</div>	
			<div class="col-xl-3">	
				<label class="form-label">Kordinat</label>
				<div class="input-group">
					<input type="text" class="form-control" name="lintang" value="<?= ($id<>'') ? $si['lintang'] : '' ?>" placeholder="Lintang">
					<input type="text" class="form-control" name="bujur" value="<?= ($id<>'') ? $si['bujur'] : '' ?>" placeholder="Bujur">
				</div>
			</div>	
			<div class="mt-4 mb-5">  
				<button type="submit" class="btn btn-primary" name="save">Simpan</button>
				<a href="siswa"><button type="button" class="btn btn-secondary">Batal</button></a>
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