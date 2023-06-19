<?php
include '../admin/config.php';

date_default_timezone_set("Asia/Jakarta");

if (isset($_POST['nisn'])) {
    $nisn = $_POST['nisn'];
    $sesi = $_POST['sesi'];
    $ket = $_POST['ket'];
    $note = $_POST['note'];
    $tgl = date("Y-m-d");
    if($ket<>''){
        $jam = '00:00:00';
    }else{
        $jam = date("H:i:s");
    }
    
    $masuk = strtotime($jam);
    $waktu = strtotime($sesi);
    if($masuk>$waktu){
        $diff = $masuk-$waktu;
        $hor = ($diff/(60*60))%24;
        $min = ($diff/60)%60;
        $sec = ($diff)%60;
        $late = sprintf("%02d", $hor) . ':' . sprintf("%02d", $min) . ':' . sprintf("%02d", $sec);
    }else{
        $late = '00:00:00';
    }

    // menampilkan data siswa
    $result = mysqli_query($conn, "SELECT * FROM absen WHERE nisn='$nisn' AND date='$tgl'");
    $result2 = mysqli_query($conn, "SELECT * FROM absenguru WHERE nisn='$nisn' AND date='$tgl'");
    if(mysqli_num_rows($result) > 0 || mysqli_num_rows($result2) > 0){
        flasher('Gagal!', 'Anda Sudah Mengabsen', 'warning');
    }else{

        $siswa = mysqli_query($conn, "SELECT * FROM siswa WHERE nisn='$nisn'");
        $guru = mysqli_query($conn, "SELECT * FROM guru WHERE nig='$nisn'");

        if(mysqli_num_rows($siswa) > 0){
            while($s=mysqli_fetch_array($siswa)){
                $ids = $s['id'];
                $nama = $s['nama'];
                mysqli_query($conn, "INSERT into absen VALUES('', '$tgl', '$jam', '$sesi', '$late', '$ids', '$nisn', '$nama', '$ket', '$note')");
            }

        }elseif(mysqli_num_rows($guru) > 0){
            while($g=mysqli_fetch_array($guru)){
                $ids = $g['id'];
                $nama = $g['nama'];
                mysqli_query($conn, "INSERT into absenguru VALUES('', '$tgl', '$jam', '$sesi', '$late', '$ids', '$nisn', '$nama', '$ket', '$note')");
            }
        }else{
            flasher('Gagal!', 'Coba lagi ya', 'error');
        }

        if(mysqli_affected_rows($conn) > 0){
            if($ket==''){
                flasher($nama, 'Selamat Datang', 'success');
            }else{
                flasher($nama, $note, 'success');
            }
        }
    }
    header('location:dashboard');
}
