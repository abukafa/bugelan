<?php 
include 'config.php';
$kode=($_POST['kod']);
$unit=$_POST['unit'];
$nama=$_POST['nama'];
$des=$_POST['des'];

mysqli_query($GLOBALS["___mysqli_ston"], "insert into account values('$kode', '$unit', '$nama', '$des')");
header("location:akun.php");
?>