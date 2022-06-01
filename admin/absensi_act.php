<?php
include 'config.php';

date_default_timezone_set("Asia/Jakarta");

if (isset($_POST['nisn'])) {
    $nisn = $_POST['nisn'];
    $sesi = $_POST['sesi'];
    $ket = $_POST['ket'];

    //menampilkan data
    $siswa = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM siswa WHERE nisn='$nisn'");
    while($s=mysqli_fetch_array($siswa)){
        $nama = $s['nama'];
        $tgl = date("Y-m-d");
        $jam = date("H:i:s");
    }

    if(mysqli_num_rows($siswa) > 0){
        mysqli_query($GLOBALS["___mysqli_ston"], "INSERT into absen VALUES('', '$tgl', '$jam', '$sesi', '$nisn', '$nama', '$ket')");
        header('location:absensi');
    }else{
        header('location:absensi?pesan=gagal')or die(mysqli_error($GLOBALS["___mysqli_ston"]));
    }

}

?>