<?php
include 'config.php';

date_default_timezone_set("Asia/Jakarta");

if (isset($_POST['nisn'])) {
    $go = $_GET['tambah'];
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

    //menampilkan data
    $result = mysqli_query($conn, "SELECT * FROM absen WHERE nisn='$nisn' AND date='$tgl'");
    if(mysqli_num_rows($result) > 0){
        flasher('Gagal!', 'Anda Sudah Mengabsen', 'warning');
        header('location:absensi?go=' . $go)or die(mysqli_error($conn));
    }else{
        $siswa = mysqli_query($conn, "SELECT * FROM siswa WHERE nisn='$nisn'");
        while($s=mysqli_fetch_array($siswa)){
            $ids = $s['id'];
            $nama = $s['nama'];
        }
    
        if(mysqli_num_rows($siswa) > 0){
            mysqli_query($conn, "INSERT into absen VALUES('', '$tgl', '$jam', '$sesi', '$late', '$ids', '$nisn', '$nama', '$ket', '$note')");
            if(mysqli_affected_rows($conn) > 0){
                if($ket==''){
                    flasher($nama, 'Selamat Datang', 'success');
                }else{
                    flasher($nama, $note, 'success');
                }
            }
            header('location:absensi?go=' . $go);
        }else{
            flasher('Gagal!', 'Coba lagi ya', 'error');
            header('location:absensi?go=' . $go)or die(mysqli_error($conn));
        }
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