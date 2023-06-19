<?php 
include 'config.php';

if(isset($_GET['tambah'])){
    $kode=($_POST['kod']);
    $unit=$_POST['unit'];
    $nama=$_POST['nama'];
    $des=$_POST['des'];
    
    mysqli_query($conn, "insert into account values('$kode', '$unit', '$nama', '$des')");
    if(mysqli_affected_rows($conn) > 0){
        flasher('Menambah!', $nama, 'success');
    }else{
        flasher('Gagal!', 'Data tidak disimpan', 'error');
    }
    header("location:akun");    
}

if(isset($_GET['hapus'])){
    $kode=$_GET['hapus'];

    mysqli_query($conn, "delete from account where code='$kode'")or die(mysqli_error($conn));
    if(mysqli_affected_rows($conn) > 0){
        flasher('Menghapus!', 'Data Akun', 'success');
    }else{
        flasher('Gagal!', 'Data tidak dihapus', 'error');
    }
    header("Location:akun");
}