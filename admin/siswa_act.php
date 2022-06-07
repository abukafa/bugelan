<?php 
require 'config.php';

// FUNGSI TAMBAH SISWA ------------------------------------------------------------------------------
if(isset($_GET['tambah'])){
    $nisn = $_POST['nisn'];
    $nama = $_POST['nama'];
    $nipd = $_POST['nipd'];
    $jk = $_POST['jk'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $nik = $_POST['nik'];
    $agama = $_POST['agama'];
    $alamat = $_POST['alamat'];
    $rt = $_POST['rt'];
    $rw = $_POST['rw'];
    $dusun = $_POST['dusun'];
    $kelurahan = $_POST['kelurahan'];
    $kecamatan = $_POST['kecamatan'];
    $kode_pos = $_POST['kode_pos'];
    $jenis_tinggal = $_POST['jenis_tinggal'];
    $alat_transportasi = $_POST['alat_transportasi'];
    $telepon = $_POST['telepon'];
    $hp = $_POST['hp'];
    $email = $_POST['email'];
    $skhun = $_POST['skhun'];
    $penerima_kps = $_POST['penerima_kps'];
    $no_kps = $_POST['no_kps'];
    $nama_ayah = $_POST['nama_ayah'];
    $tl_ayah = $_POST['tl_ayah'];
    $pendidikan_ayah = $_POST['pendidikan_ayah'];
    $pekerjaan_ayah = $_POST['pekerjaan_ayah'];
    $penghasilan_ayah = $_POST['penghasilan_ayah'];
    $nik_ayah = $_POST['nik_ayah'];
    $nama_ibu = $_POST['nama_ibu'];
    $tl_ibu = $_POST['tl_ibu'];
    $pendidikan_ibu = $_POST['pendidikan_ibu'];
    $pekerjaan_ibu = $_POST['pekerjaan_ibu'];
    $penghasilan_ibu = $_POST['penghasilan_ibu'];
    $nik_ibu = $_POST['nik_ibu'];
    $nama_wali = $_POST['nama_wali'];
    $tl_wali = $_POST['tl_wali'];
    $pendidikan_wali = $_POST['pendidikan_wali'];
    $pekerjaan_wali = $_POST['pekerjaan_wali'];
    $penghasilan_wali = $_POST['penghasilan_wali'];
    $nik_wali = $_POST['nik_wali'];
    $tahun = $_POST['tahun'];
    $npun = $_POST['npun'];
    $no_seri_ijazah = $_POST['no_seri_ijazah'];
    $penerima_kip = $_POST['penerima_kip'];
    $nomor_kip = $_POST['nomor_kip'];
    $nama_di_kip = $_POST['nama_di_kip'];
    $nomor_kks = $_POST['nomor_kks'];
    $no_registrasi_akta_lahir = $_POST['no_registrasi_akta_lahir'];
    $bank = $_POST['bank'];
    $nomor_rekening_bank = $_POST['nomor_rekening_bank'];
    $rekening_atas_nama = $_POST['rekening_atas_nama'];
    $layak_pip = $_POST['layak_pip'];
    $alasan_layak_pip = $_POST['alasan_layak_pip'];
    $kebutuhan_khusus = $_POST['kebutuhan_khusus'];
    $sekolah_asal = $_POST['sekolah_asal'];
    $anak_ke = $_POST['anak_ke'];
    $lintang = $_POST['lintang'];
    $bujur = $_POST['bujur'];
    $no_kk = $_POST['no_kk'];
    $berat_badan = $_POST['berat_badan'];
    $tinggi_badan = $_POST['tinggi_badan'];
    $lingkar_kepala = $_POST['lingkar_kepala'];
    $jml_saudara = $_POST['jml_saudara'];
    $jarak_rumah = $_POST['jarak_rumah'];    
    mysqli_query($conn, "INSERT INTO siswa VALUES(
        '', 
        '$nisn',
        '$nama',
        '$nipd',
        '$jk',
        '$tempat_lahir',
        '$tanggal_lahir',
        '$nik',
        '$agama',
        '$alamat',
        '$rt',
        '$rw',
        '$dusun',
        '$kelurahan',
        '$kecamatan',
        '$kode_pos',
        '$jenis_tinggal',
        '$alat_transportasi',
        '$telepon',
        '$hp',
        '$email',
        '$skhun',
        '$penerima_kps',
        '$no_kps',
        '$nama_ayah',
        '$tl_ayah',
        '$pendidikan_ayah',
        '$pekerjaan_ayah',
        '$penghasilan_ayah',
        '$nik_ayah',
        '$nama_ibu',
        '$tl_ibu',
        '$pendidikan_ibu',
        '$pekerjaan_ibu',
        '$penghasilan_ibu',
        '$nik_ibu',
        '$nama_wali',
        '$tl_wali',
        '$pendidikan_wali',
        '$pekerjaan_wali',
        '$penghasilan_wali',
        '$nik_wali',
        '$tahun',
        '$npun',
        '$no_seri_ijazah',
        '$penerima_kip',
        '$nomor_kip',
        '$nama_di_kip',
        '$nomor_kks',
        '$no_registrasi_akta_lahir',
        '$bank',
        '$nomor_rekening_bank',
        '$rekening_atas_nama',
        '$layak_pip',
        '$alasan_layak_pip',
        '$kebutuhan_khusus',
        '$sekolah_asal',
        '$anak_ke',
        '$lintang',
        '$bujur',
        '$no_kk',
        '$berat_badan',
        '$tinggi_badan',
        '$lingkar_kepala',
        '$jml_saudara',
        '$jarak_rumah')
    ");
    if(mysqli_affected_rows($conn) > 0){
        flasher('Menambah!', $nama, 'success');
    }else{
        flasher('Gagal!', 'Data tidak disimpan', 'error');
    }
    header("Location: siswa");
}

// FUNGSI UBAH SISWA ------------------------------------------------------------------------------
if(isset($_GET['ubah'])){
    $id = $_GET['ubah'];
    $nisn = $_POST['nisn'];
    $nama = $_POST['nama'];
    $nipd = $_POST['nipd'];
    $jk = $_POST['jk'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $nik = $_POST['nik'];
    $agama = $_POST['agama'];
    $alamat = $_POST['alamat'];
    $rt = $_POST['rt'];
    $rw = $_POST['rw'];
    $dusun = $_POST['dusun'];
    $kelurahan = $_POST['kelurahan'];
    $kecamatan = $_POST['kecamatan'];
    $kode_pos = $_POST['kode_pos'];
    $jenis_tinggal = $_POST['jenis_tinggal'];
    $alat_transportasi = $_POST['alat_transportasi'];
    $telepon = $_POST['telepon'];
    $hp = $_POST['hp'];
    $email = $_POST['email'];
    $skhun = $_POST['skhun'];
    $penerima_kps = $_POST['penerima_kps'];
    $no_kps = $_POST['no_kps'];
    $nama_ayah = $_POST['nama_ayah'];
    $tl_ayah = $_POST['tl_ayah'];
    $pendidikan_ayah = $_POST['pendidikan_ayah'];
    $pekerjaan_ayah = $_POST['pekerjaan_ayah'];
    $penghasilan_ayah = $_POST['penghasilan_ayah'];
    $nik_ayah = $_POST['nik_ayah'];
    $nama_ibu = $_POST['nama_ibu'];
    $tl_ibu = $_POST['tl_ibu'];
    $pendidikan_ibu = $_POST['pendidikan_ibu'];
    $pekerjaan_ibu = $_POST['pekerjaan_ibu'];
    $penghasilan_ibu = $_POST['penghasilan_ibu'];
    $nik_ibu = $_POST['nik_ibu'];
    $nama_wali = $_POST['nama_wali'];
    $tl_wali = $_POST['tl_wali'];
    $pendidikan_wali = $_POST['pendidikan_wali'];
    $pekerjaan_wali = $_POST['pekerjaan_wali'];
    $penghasilan_wali = $_POST['penghasilan_wali'];
    $nik_wali = $_POST['nik_wali'];
    $tahun = $_POST['tahun'];
    $npun = $_POST['npun'];
    $no_seri_ijazah = $_POST['no_seri_ijazah'];
    $penerima_kip = $_POST['penerima_kip'];
    $nomor_kip = $_POST['nomor_kip'];
    $nama_di_kip = $_POST['nama_di_kip'];
    $nomor_kks = $_POST['nomor_kks'];
    $no_registrasi_akta_lahir = $_POST['no_registrasi_akta_lahir'];
    $bank = $_POST['bank'];
    $nomor_rekening_bank = $_POST['nomor_rekening_bank'];
    $rekening_atas_nama = $_POST['rekening_atas_nama'];
    $layak_pip = $_POST['layak_pip'];
    $alasan_layak_pip = $_POST['alasan_layak_pip'];
    $kebutuhan_khusus = $_POST['kebutuhan_khusus'];
    $sekolah_asal = $_POST['sekolah_asal'];
    $anak_ke = $_POST['anak_ke'];
    $lintang = $_POST['lintang'];
    $bujur = $_POST['bujur'];
    $no_kk = $_POST['no_kk'];
    $berat_badan = $_POST['berat_badan'];
    $tinggi_badan = $_POST['tinggi_badan'];
    $lingkar_kepala = $_POST['lingkar_kepala'];
    $jml_saudara = $_POST['jml_saudara'];
    $jarak_rumah = $_POST['jarak_rumah'];    
    mysqli_query($conn, "UPDATE siswa SET
        nisn = '$nisn',
        nama = '$nama',
        nipd = '$nipd',
        jk = '$jk',
        tempat_lahir = '$tempat_lahir',
        tanggal_lahir = '$tanggal_lahir',
        nik = '$nik',
        agama = '$agama',
        alamat = '$alamat',
        rt = '$rt',
        rw = '$rw',
        dusun = '$dusun',
        kelurahan = '$kelurahan',
        kecamatan = '$kecamatan',
        kode_pos = '$kode_pos',
        jenis_tinggal = '$jenis_tinggal',
        alat_transportasi = '$alat_transportasi',
        telepon = '$telepon',
        hp = '$hp',
        email = '$email',
        skhun = '$skhun',
        penerima_kps = '$penerima_kps',
        no_kps = '$no_kps',
        nama_ayah = '$nama_ayah',
        tl_ayah = '$tl_ayah',
        pendidikan_ayah = '$pendidikan_ayah',
        pekerjaan_ayah = '$pekerjaan_ayah',
        penghasilan_ayah = '$penghasilan_ayah',
        nik_ayah = '$nik_ayah',
        nama_ibu = '$nama_ibu',
        tl_ibu = '$tl_ibu',
        pendidikan_ibu = '$pendidikan_ibu',
        pekerjaan_ibu = '$pekerjaan_ibu',
        penghasilan_ibu = '$penghasilan_ibu',
        nik_ibu = '$nik_ibu',
        nama_wali = '$nama_wali',
        tl_wali = '$tl_wali',
        pendidikan_wali = '$pendidikan_wali',
        pekerjaan_wali = '$pekerjaan_wali',
        penghasilan_wali = '$penghasilan_wali',
        nik_wali = '$nik_wali',
        tahun = '$tahun',
        npun = '$npun',
        no_seri_ijazah = '$no_seri_ijazah',
        penerima_kip = '$penerima_kip',
        nomor_kip = '$nomor_kip',
        nama_di_kip = '$nama_di_kip',
        nomor_kks = '$nomor_kks',
        no_registrasi_akta_lahir = '$no_registrasi_akta_lahir',
        bank = '$bank',
        nomor_rekening_bank = '$nomor_rekening_bank',
        rekening_atas_nama = '$rekening_atas_nama',
        layak_pip = '$layak_pip',
        alasan_layak_pip = '$alasan_layak_pip',
        kebutuhan_khusus = '$kebutuhan_khusus',
        sekolah_asal = '$sekolah_asal',
        anak_ke = '$anak_ke',
        lintang = '$lintang',
        bujur = '$bujur',
        no_kk = '$no_kk',
        berat_badan = '$berat_badan',
        tinggi_badan = '$tinggi_badan',
        lingkar_kepala = '$lingkar_kepala',
        jml_saudara = '$jml_saudara',
        jarak_rumah = '$jarak_rumah'
    WHERE id='$id'");

    // UPLOAD FOTO
    if($_FILES['file']['error'] === 0){
        $nama = $_FILES['file']['name'];
        // $ekst = explode('.', $nama);
        // $ekst = strtolower(end($ekst));
        $tmp = $_FILES['file']['tmp_name'];
        $namaFile = $id . '.jpg';

        move_uploaded_file($tmp, '../public/foto/' . $namaFile);
    }

    if(mysqli_affected_rows($conn) > 0 || $_FILES['file']['error'] === 0){
        flasher('Mengubah!', $nama, 'success');
    }else{
        flasher('Gagal!', 'Tidak ada perubahan', 'error');
    }
    header("Location: siswa");
}

// FUNGSI HAPUS SISWA ------------------------------------------------------------------------------
if(isset($_GET['hapus'])){
    $id=$_GET['hapus'];
    mysqli_query($conn, "delete from siswa where id='$id'")or die(mysqli_error($conn));
    if(mysqli_affected_rows($conn) > 0){
        flasher('Menghapus!', 'Data Siswa', 'success');
    }else{
        flasher('Gagal!', 'Data tidak dihapus', 'error');
    }
    header("Location:siswa");
}