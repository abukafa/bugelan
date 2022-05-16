<?php 
include 'config.php';
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
    $file=upload();
}


mysqli_query($GLOBALS["___mysqli_ston"], "update letterin set sip='$from', no='$no', lamp='$lamp', hal='$hal', file='$file' , ket='$ket' where id='$id'");
header("location:suratin.php");

function upload(){
    $nama = $_FILES['efile']['name'];
    $ekst = explode('.', $nama);
    $ekst = strtolower(end($ekst));
    $tmp = $_FILES['efile']['tmp_name'];
    $namaFile = uniqid();
    $namaFile .= '.';
    $namaFile .= $ekst;

    move_uploaded_file($tmp, '../surat/' . $namaFile);
    return $namaFile;
}
?>