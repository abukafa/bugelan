<?php
include 'config.php';

date_default_timezone_set("Asia/Jakarta");

if (isset($_POST['nisn'])) {
    $nisn = $_POST['nisn'];
    $sesi = $_POST['sesi'];
    $ket = $_POST['ket'];

    //menampilkan data
    $siswa = mysqli_query($conn, "SELECT * FROM siswa WHERE nisn='$nisn'");
    while($s=mysqli_fetch_array($siswa)){
        $nama = $s['nama'];
        $tgl = date("Y-m-d");
        $jam = date("H:i:s");
    }

    if(mysqli_num_rows($siswa) > 0){
        mysqli_query($conn, "INSERT into absen VALUES('', '$tgl', '$jam', '$sesi', '$nisn', '$nama', '$ket')");
        if(mysqli_affected_rows($conn) > 0){
            flasher($nama, 'Selamat Datang', 'success');
        }
        header('location:absensi');
    }else{
        flasher('Gagal!', 'Coba lagi ya', 'error');
        header('location:absensi')or die(mysqli_error($conn));
    }

}

if(isset($_GET['hapus'])){
    $id=$_GET['hapus'];
    mysqli_query($conn, "delete from absen where id='$id'")or die(mysqli_error($conn));
    if(mysqli_affected_rows($conn) > 0){
        flasher('Menghapus!', 'Data absensi', 'success');
    }else{
        flasher('Gagal!', 'Data tidak dihapus', 'error');
    }
    header("Location:absensi");
}