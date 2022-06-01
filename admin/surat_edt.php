<?php 
include 'config.php';
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

mysqli_query($GLOBALS["___mysqli_ston"], "update letter set no='$no', lamp='$lamp', hal='$hal', kpd='$kpd', main_1='$satu', main_2='$dua', main_3='$tiga', sign_1='$ttd1', name_1='$ntd1', sign_2='$ttd2', name_2='$ntd2', sign_3='$ttd3', name_3='$ntd3', sign_4='$ttd4', name_4='$ntd4', note='$note', ket='$ket' where id='$id'");
header("location:surat");
?>