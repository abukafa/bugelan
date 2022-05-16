<?php 
session_start();
include 'config.php';
$id=$_GET['id'];
$brg=mysqli_query($GLOBALS["___mysqli_ston"], "select * from finance where id= '$id' ");
	while($b=mysqli_fetch_array($brg)){
		
$inv=$b['inv'];
$tgl=$b['date'];
$period=$b['period'];
$akun=$b['account'];
$vend=$b['vendor'];
$urai=$b['des'];
$ket=$b['remark'];
$dbt=$b['debit'];
$kdt=$b['credit'];
} 

$use=$_SESSION['uname'];
$nm=mysqli_query($GLOBALS["___mysqli_ston"], "select name from admin where uname='$use'");
while($name=mysqli_fetch_array($nm)){
$admin=$name['name'];

mysqli_query($GLOBALS["___mysqli_ston"], "insert into trash_finance values('', '$inv', '$tgl', '$period', '$akun', '$vend','$urai','$ket', '$dbt', '$kdt', '$admin')")or die(mysqli_error($GLOBALS["___mysqli_ston"]));
}
mysqli_query($GLOBALS["___mysqli_ston"], "delete from finance where id='$id'")or die(mysqli_error($GLOBALS["___mysqli_ston"]));
header("Location:buku_add.php?tgl=&vend=&ket=&inv=". $inv);

 ?>
