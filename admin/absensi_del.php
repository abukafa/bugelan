<?php 
include 'config.php';
$id=$_GET['id'];

mysqli_query($GLOBALS["___mysqli_ston"], "delete from absen where id='$id'")or die(mysqli_error($GLOBALS["___mysqli_ston"]));
header("Location:absensi");
 ?>