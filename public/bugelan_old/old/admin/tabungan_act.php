<?php 
session_start();
include 'config.php';
if(isset($_GET['tambah'])){
    $tgl=$_POST['tgl'];
    $date=date_create($tgl);
    $period=date_format($date, 'M Y');
    $ids=$_POST['ids'];
    $nama=$_POST['nama'];
    $wali=$_POST['wali'];
    $dbt=$_POST['debit'];
    $kdt=$_POST['kredit'];
    $ket=$_POST['ket'];

    $use=$_SESSION['uname'];
    $nm=mysqli_query($conn, "select name from admin where uname='$use'");
    while($name=mysqli_fetch_array($nm)){
    $admin=$name['name'];
    mysqli_query($conn, "insert into tabungan values('', '$tgl', '$period', '$ids', '$nama', '$dbt', '$kdt', '$ket', '$admin')")or die(mysqli_error($conn));

    if(mysqli_affected_rows($conn) > 0){
        flasher('Berhasil!', 'Menambah Tabungan', 'success');
    }else{
        flasher('Gagal!', 'Menambah Tabungan', 'error');
    }
    header("location:tabungan");
    }
}

if(isset($_GET['hapus'])){
    $id=$_GET['hapus'];
    mysqli_query($conn, "delete from tabungan where id='$id'")or die(mysqli_error($conn));

    if(mysqli_affected_rows($conn) > 0){
        flasher('Berhasil!', 'Menghapus Tabungan', 'success');
    }else{
        flasher('Gagal!', 'Menghapus Tabungan', 'error');
    }
    header("Location:tabungan");
}