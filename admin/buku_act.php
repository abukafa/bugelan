<?php 
session_start();
include 'config.php';

if(isset($_GET['tambah'])){
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
	$nm=mysqli_query($conn, "select name from admin where uname='$use'");
	while($name=mysqli_fetch_array($nm)){
	$admin=$name['name'];
	
	mysqli_query($conn, "insert into finance values('', '$inv', '$tgl', '$period', '$akun', '$vend','$urai','$ket', '$dbt', '$kdt', '$admin')")or die(mysqli_error($conn));
	if(mysqli_affected_rows($conn) > 0){
        flasher('Menambah!', $ket, 'success');
    }else{
        flasher('Gagal!', 'Data tidak disimpan', 'error');
    }
	header("Location:buku_add?tgl=". $tgl ."&vend=". $vend ."&ket=". $ket ."&inv=". $inv);
	}	
}

if(isset($_GET['ubah'])){
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
	$nm=mysqli_query($conn, "select name from admin where uname='$use'");
	while($name=mysqli_fetch_array($nm)){
	$admin=$name['name'];
	
	mysqli_query($conn, "update finance set inv='$inv', date='$tgl', period='$period', account='$akun', vendor='$vend', des='$urai', remark='$ket', debit='$dbt', credit='$kdt', admin='$admin' where id='$no' ");
	if(mysqli_affected_rows($conn) > 0){
        flasher('Mengubah!', $ket, 'success');
    }else{
        flasher('Gagal!', 'Tidak ada perubahan', 'error');
    }
	header("Location:buku_add?tgl=". $tgl ."&vend=". $vend ."&ket=". $ket ."&inv=". $inv);
	}
}

if(isset($_GET['hapus'])){
	$id=$_GET['hapus'];
	$brg=mysqli_query($conn, "select * from finance where id= '$id' ");
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
	$nm=mysqli_query($conn, "select name from admin where uname='$use'");
	while($name=mysqli_fetch_array($nm)){
	$admin=$name['name'];
	
	mysqli_query($conn, "insert into trash_finance values('', '$inv', '$tgl', '$period', '$akun', '$vend','$urai','$ket', '$dbt', '$kdt', '$admin')")or die(mysqli_error($conn));
	}
	mysqli_query($conn, "delete from finance where id='$id'")or die(mysqli_error($conn));
	if(mysqli_affected_rows($conn) > 0){
        flasher('Menghapus!', 'Data Pembukuan', 'success');
    }else{
        flasher('Gagal!', 'Data tidak dihapus', 'error');
    }
	header("Location:buku_add?tgl=&vend=&ket=&inv=". $inv);
}
