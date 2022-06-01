<?php 
session_start();
include 'config.php';
$no=$_POST['id'];
$inv=$_POST['inv'];
$tgl=$_POST['tgl'];
$date=date_create($tgl);
$period=date_format($date, 'M Y');
$vend=$_POST['vend'];
$ket=$_POST['ket'];
$akun=$_POST['akun'];
$urai=$_POST['des'];

if (substr($akun, 0, 2) == 44){
	$dbt=0;
	$kdt=$_POST['jum'];
} 
else {
	$dbt=$_POST['jum'];
	$kdt=0;
}

$use=$_SESSION['uname'];
$nm=mysqli_query($GLOBALS["___mysqli_ston"], "select name from admin where uname='$use'");
while($name=mysqli_fetch_array($nm)){
$admin=$name['name'];

mysqli_query($GLOBALS["___mysqli_ston"], "update finance set inv='$inv', date='$tgl', period='$period', account='$akun', vendor='$vend', des='$urai', remark='$ket', debit='$dbt', credit='$kdt', admin='$admin' where id='$no' ");
header("Location:buku_add?tgl=". $tgl ."&vend=". $vend ."&ket=". $ket ."&inv=". $inv);
}
?>