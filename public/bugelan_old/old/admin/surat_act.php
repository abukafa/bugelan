<?php 
session_start();
include 'config.php';

if(isset($_GET['tambah'])){
    $no=$_POST['no'];
    $lamp=$_POST['lamp'];
    $hal=$_POST['hal'];
    $kpd=$_POST['kpd'];
    $satu=$_POST['satu'];
    $dua=$_POST['dua'];
    $tiga=$_POST['tiga'];
    $ttd1=$_POST['ttd1'];
    $ntd1=$_POST['ntd1'];
    $ttd2=$_POST['ttd2'];
    $ntd2=$_POST['ntd2'];
    $ttd3=$_POST['ttd3'];
    $ntd3=$_POST['ntd3'];
    $ttd4=$_POST['ttd4'];
    $ntd4=$_POST['ntd4'];
    $note=$_POST['note'];
    $ket=$_POST['ket'];

    mysqli_query($conn, "insert into letter values('', '$no', '$lamp', '$hal', '$kpd', '$satu', '$dua', '$tiga', '$ttd1', '$ntd1', '$ttd2', '$ntd2', '$ttd3', '$ntd3', '$ttd4', '$ntd4', '$note', '$ket')");
    if(mysqli_affected_rows($conn) > 0){
        flasher('Menambah!', $no, 'success');
    }else{
        flasher('Gagal!', 'Data tidak disimpan', 'error');
    }
    header("location:surat");
}

if(isset($_GET['ubah'])){
    $id=$_POST['eid'];
    $no=$_POST['eno'];
    $lamp=$_POST['elamp'];
    $hal=$_POST['ehal'];
    $kpd=$_POST['ekpd'];
    $satu=$_POST['esatu'];
    $dua=$_POST['edua'];
    $tiga=$_POST['etiga'];
    $ttd1=$_POST['ettd1'];
    $ntd1=$_POST['entd1'];
    $ttd2=$_POST['ettd2'];
    $ntd2=$_POST['entd2'];
    $ttd3=$_POST['ettd3'];
    $ntd3=$_POST['entd3'];
    $ttd4=$_POST['ettd4'];
    $ntd4=$_POST['entd4'];
    $note=$_POST['enote'];
    $ket=$_POST['eket'];
    
    mysqli_query($conn, "update letter set no='$no', lamp='$lamp', hal='$hal', kpd='$kpd', main_1='$satu', main_2='$dua', main_3='$tiga', sign_1='$ttd1', name_1='$ntd1', sign_2='$ttd2', name_2='$ntd2', sign_3='$ttd3', name_3='$ntd3', sign_4='$ttd4', name_4='$ntd4', note='$note', ket='$ket' where id='$id'");
    if(mysqli_affected_rows($conn) > 0){
        flasher('Mengubah!', $no, 'success');
    }else{
        flasher('Gagal!', 'Tidak ada perubahan', 'error');
    }
    header("location:surat");
}

if(isset($_GET['hapus'])){
    $id=$_GET['hapus'];
    mysqli_query($conn, "delete from letter where id='$id'")or die(mysqli_error($conn));
    if(mysqli_affected_rows($conn) > 0){
        flasher('Menghapus!', 'Surat Keluar', 'success');
    }else{
        flasher('Gagal!', 'Data tidak dihapus', 'error');
    }
    header("Location:surat". $inv);
}


