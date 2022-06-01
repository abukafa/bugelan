<?php 
include 'config.php';
$kode=$_GET['kode'];

mysqli_query($GLOBALS["___mysqli_ston"], "delete from account where code='$kode'")or die(mysqli_error($GLOBALS["___mysqli_ston"]));
header("Location:akun");
 ?>