<?php 
session_start();
include 'config.php';

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

mysqli_query($GLOBALS["___mysqli_ston"], "insert into finance values('', '$inv', '$tgl', '$period', '$akun', '$vend','$urai','$ket', '$dbt', '$kdt', '$admin')")or die(mysqli_error($GLOBALS["___mysqli_ston"]));
header("Location:buku_add.php?tgl=". $tgl ."&vend=". $vend ."&ket=". $ket ."&inv=". $inv);
}
?>
