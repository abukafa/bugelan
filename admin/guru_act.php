<?php 
require 'config.php';

// FUNGSI TAMBAH SISWA ------------------------------------------------------------------------------
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
    $ket = $_POST['ket'];
    mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO guru VALUES(
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
        '$ket')
    ");
    header("Location: guru");
}

// FUNGSI UBAH SISWA ------------------------------------------------------------------------------
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
    $ket = $_POST['ket'];
    mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE guru SET
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
        ket = '$ket'
    WHERE id='$id'");
    header("Location: guru");
}


