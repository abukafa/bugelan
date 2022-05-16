<?php 
include 'config.php';
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

mysqli_query($GLOBALS["___mysqli_ston"], "insert into letter values('', '$no', '$lamp', '$hal', '$kpd', '$satu', '$dua', '$tiga', '$ttd1', '$ntd1', '$ttd2', '$ntd2', '$ttd3', '$ntd3', '$ttd4', '$ntd4', '$note', '$ket')");
header("location:surat.php");
?>