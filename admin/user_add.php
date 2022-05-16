<?php 
include 'config.php';
$uname=$_POST['uname'];
$name=$_POST['name'];
$pass=$_POST['pass'];
$akses=$_POST['akses'];
$ket=$_POST['ket'];

mysqli_query($GLOBALS["___mysqli_ston"], "insert into admin values('', '$uname', '$pass', '$name', '$akses', '$ket')");
header("location:user.php");
?>