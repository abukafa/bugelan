<?php 
include 'config.php';
$from=$_POST['from'];
$no=$_POST['no'];
$lamp=$_POST['lamp'];
$hal=$_POST['hal'];
$ket=$_POST['ket'];

$file=upload();

mysqli_query($GLOBALS["___mysqli_ston"], "insert into letterin values('', '$from', '$no', '$lamp', '$hal', '$file', '$ket')");
header("location:suratin");

function upload(){
    $nama = $_FILES['file']['name'];
    $ekst = explode('.', $nama);
    $ekst = strtolower(end($ekst));
    $tmp = $_FILES['file']['tmp_name'];
    $namaFile = uniqid();
    $namaFile .= '.';
    $namaFile .= $ekst;

    move_uploaded_file($tmp, '../public/surat/' . $namaFile);
    return $namaFile;
}
?>