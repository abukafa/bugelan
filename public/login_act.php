<?php 
session_start();
include '../admin/config.php';
$uname=$_POST['uname'];
$pass=$_POST['pass'];
$pas=md5($pass);
$query=mysqli_query($GLOBALS["___mysqli_ston"], "select * from admin where uname='$uname' and pass='$pass'")or die(mysqli_error($GLOBALS["___mysqli_ston"]));
if(mysqli_num_rows($query)==1 and $uname<>""){
	$_SESSION['uname']=$uname;
	header("location:../admin/dashboard");
}else{
	header("location:login?pesan=gagal")or die(mysqli_error($GLOBALS["___mysqli_ston"]));
}
?>