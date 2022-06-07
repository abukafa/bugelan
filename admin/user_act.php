<?php 
include 'config.php';
if(isset($_GET['tambah'])){
    $uname=$_POST['uname'];
    $name=$_POST['name'];
    $pass=password_hash($_POST['pass'], PASSWORD_DEFAULT);
    $akses=$_POST['akses'];
    $ket=$_POST['ket'];

    mysqli_query($conn, "insert into admin values('', '$uname', '$pass', '$name', '$akses', '$ket')");

    if(mysqli_affected_rows($conn) > 0){
        flasher('Berhasil!', 'Menambah Pengguna', 'success');
    }else{
        flasher('Gagal!', 'Menambah Pengguna', 'error');
    }
    header("location:user");
}

if(isset($_GET['hapus'])){
    $id=$_GET['hapus'];
    mysqli_query($conn, "delete from admin where id='$id'")or die(mysqli_error($conn));

    if(mysqli_affected_rows($conn) > 0){
        flasher('Berhasil!', 'Menghapus Pengguna', 'success');
    }else{
        flasher('Gagal!', 'Menghapus Pengguna', 'error');
    }
    header("Location:user");
}