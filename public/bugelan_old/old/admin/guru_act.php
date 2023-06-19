<?php 
require 'config.php';

// FUNGSI TAMBAH GURU ------------------------------------------------------------------------------
if(isset($_GET['tambah'])){
    $nig = $_POST['nig'];
    $nama = $_POST['nama'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $jk = $_POST['jk'];
    $jabatan = $_POST['jabatan'];
    $status = $_POST['status'];
    $alamat = $_POST['alamat'];
    $rt = $_POST['rt'];
    $rw = $_POST['rw'];
    $dusun = $_POST['dusun'];
    $kelurahan = $_POST['kelurahan'];
    $kecamatan = $_POST['kecamatan'];
    $kode_pos = $_POST['kode_pos'];
    $hp = $_POST['hp'];
    $ket = $_POST['ket'];
    mysqli_query($conn, "INSERT INTO guru VALUES(
        '', 
        '$nig',
        '$nama',
        '$tempat_lahir',
        '$tanggal_lahir',
        '$jk',
        '$jabatan',
        '$status',
        '$alamat',
        '$rt',
        '$rw',
        '$dusun',
        '$kelurahan',
        '$kecamatan',
        '$kode_pos',
        '$hp',
        '$ket')
    ");

    if(mysqli_affected_rows($conn) > 0){
        flasher('Menambah!', $nama, 'success');
    }else{
        flasher('Gagal!', 'Data tidak disimpan', 'error');
    }
    header("Location: guru");
}

// FUNGSI UBAH GURU ------------------------------------------------------------------------------
if(isset($_GET['ubah'])){
    $id = $_GET['ubah'];
    $nig = $_POST['nig'];
    $nama = $_POST['nama'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $jk = $_POST['jk'];
    $jabatan = $_POST['jabatan'];
    $status = $_POST['status'];
    $alamat = $_POST['alamat'];
    $rt = $_POST['rt'];
    $rw = $_POST['rw'];
    $dusun = $_POST['dusun'];
    $kelurahan = $_POST['kelurahan'];
    $kecamatan = $_POST['kecamatan'];
    $kode_pos = $_POST['kode_pos'];
    $hp = $_POST['hp'];
    $ket = $_POST['ket'];
    mysqli_query($conn, "UPDATE guru SET
        nig = '$nig',
        nama = '$nama',
        tempat_lahir = '$tempat_lahir',
        tanggal_lahir = '$tanggal_lahir',
        jk = '$jk',
        jabatan = '$jabatan',
        status = '$status',
        alamat = '$alamat',
        rt = '$rt',
        rw = '$rw',
        dusun = '$dusun',
        kelurahan = '$kelurahan',
        kecamatan = '$kecamatan',
        kode_pos = '$kode_pos',
        hp = '$hp',
        ket = '$ket'
    WHERE id='$id'");

    // UPLOAD FOTO
    if($_FILES['file']['error'] === 0){
        $nama = $_FILES['file']['name'];
        // $ekst = explode('.', $nama);
        // $ekst = strtolower(end($ekst));
        $tmp = $_FILES['file']['tmp_name'];
        $namaFile = $nig . '.jpg';

        move_uploaded_file($tmp, '../public/foto/' . $namaFile);
    }

    if(mysqli_affected_rows($conn) > 0 || $_FILES['file']['error'] === 0){
        flasher('Mengubah!', $nama, 'success');
    }else{
        flasher('Gagal!', 'Tidak ada perubahan', 'error');
    }
    header("Location: guru");
}

// FUNGSI HAPUS GURU ------------------------------------------------------------------------------
if(isset($_GET['hapus'])){
    $id=$_GET['hapus'];
    mysqli_query($conn, "delete from guru where id='$id'")or die(mysqli_error($conn));
    if(mysqli_affected_rows($conn) > 0){
        flasher('Menghapus!', 'Data Guru', 'success');
    }else{
        flasher('Gagal!', 'Data tidak dihapus', 'error');
    }
    header("Location:guru");
}