<?php 
include 'config.php';
$user=$_POST['user'];
$lama=$_POST['lama'];
$baru=$_POST['baru'];
$ulang=$_POST['ulang'];

$cek=mysqli_query($conn, "select * from admin where uname='$user'");
if(mysqli_num_rows($cek)==1){
	$row = mysqli_fetch_assoc($cek);
	if(password_verify($lama, $row["pass"])){
		$ba = password_hash($baru, PASSWORD_DEFAULT);
		if($baru==$ulang){
			mysqli_query($conn, "update admin set pass='$ba' where uname='$user'");
			if(mysqli_affected_rows($conn) > 0){
				flasher('Berhasil!', 'Mengubah Password', 'success');
			}
			header("location:pass?pesan=oke");
		}else{
			flasher('Salah!', 'Password nya tidak sama', 'warning');
			header("location:pass");
		}
	}else{
		flasher('Gagal!', 'Password nya salah', 'error');
		header("location:pass");
	}
}else{
	flasher('Gagal!', 'Password salah', 'error');
	header("location:pass");
}

 ?>