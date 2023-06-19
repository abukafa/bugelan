<?php 
include 'config.php';

if(isset($_GET['tambah'])){
    $from=$_POST['from'];
    $no=$_POST['no'];
    $lamp=$_POST['lamp'];
    $hal=$_POST['hal'];
    $ket=$_POST['ket'];
    
    $nama = $_FILES['file']['name'];
    $ekst = explode('.', $nama);
    $ekst = strtolower(end($ekst));
    $tmp = $_FILES['file']['tmp_name'];
    $namaFile = uniqid();
    $namaFile .= '.';
    $namaFile .= $ekst;

    move_uploaded_file($tmp, '../public/surat/' . $namaFile);
    $file=$namaFile;
    
    mysqli_query($conn, "insert into letterin values('', '$from', '$no', '$lamp', '$hal', '$file', '$ket')");
    if(mysqli_affected_rows($conn) > 0){
        flasher('Menambah!', $no, 'success');
    }else{
        flasher('Gagal!', 'Data tidak disimpan', 'error');
    }
    header("location:suratin");
}

if(isset($_GET['ubah'])){
    $id=$_POST['eid'];
    $from=$_POST['efrom'];
    $no=$_POST['eno'];
    $lamp=$_POST['elamp'];
    $hal=$_POST['ehal'];
    $ket=$_POST['eket'];
    $old=$_POST['eold'];
    
    if($_FILES['efile']['error'] === 4){
        $file=$old;
    }else{
        $nama = $_FILES['efile']['name'];
        $ekst = explode('.', $nama);
        $ekst = strtolower(end($ekst));
        $tmp = $_FILES['efile']['tmp_name'];
        $namaFile = uniqid();
        $namaFile .= '.';
        $namaFile .= $ekst;
    
        move_uploaded_file($tmp, '../public/surat/' . $namaFile);
        $file=$namaFile;
        unlink('../public/surat/' . $old);
    }
    
    mysqli_query($conn, "update letterin set sip='$from', no='$no', lamp='$lamp', hal='$hal', file='$file' , ket='$ket' where id='$id'");
    if(mysqli_affected_rows($conn) > 0){
        flasher('Mengubah!', $no, 'success');
    }else{
        flasher('Gagal!', 'Tidak ada perubahan', 'error');
    }
    header("location:suratin");
}

if(isset($_GET['hapus'])){
    $id=$_GET['hapus'];
    $oldFile=$_GET['file'];
    
    unlink('../public/surat/' . $oldFile);
    mysqli_query($conn, "delete from letterin where id='$id'")or die(mysqli_error($conn));
    if(mysqli_affected_rows($conn) > 0){
        flasher('Menghapus!', 'Surat Masuk', 'success');
    }else{
        flasher('Gagal!', 'Data tidak dihapus', 'error');
    }
    header("Location:suratin". $inv);
}