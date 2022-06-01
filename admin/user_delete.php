<?php 
include 'config.php';
$id=$_GET['id'];

mysqli_query($GLOBALS["___mysqli_ston"], "delete from admin where id='$id'")or die(mysqli_error($GLOBALS["___mysqli_ston"]));
header("Location:user");
 ?>