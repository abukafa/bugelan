<?php 
include 'config.php';
if(isset($_GET['tambah'])){
    $uname=$_POST['uname'];
    $name=$_POST['name'];
    $pass=password_hash($_POST['pass'], PASSWORD_DEFAULT);
    $akses=$_POST['akses'];
    $ket=$_POST['ket'];

    mysqli_query($conn, "insert into admin values('', '$uname', '$pass', '$name', '$akses', '$ket')");

    if(mysqli_affected_rows($conn) > 0){
        flasher('Berhasil!', 'Menambah Pengguna', 'success');
    }else{
        flasher('Gagal!', 'Menambah Pengguna', 'error');
    }
    header("location:user");
}

if(isset($_GET['hapus'])){
    $id=$_GET['hapus'];
    mysqli_query($conn, "delete from admin where id='$id'")or die(mysqli_error($conn));

    if(mysqli_affected_rows($conn) > 0){
        flasher('Berhasil!', 'Menghapus Pengguna', 'success');
    }else{
        flasher('Gagal!', 'Menghapus Pengguna', 'error');
    }
    header("Location:user");
}

if(isset($_GET['showCollumn'])){
    $tab=$_GET['showCollumn'];
    $kols = myquery("SHOW COLUMNS FROM ". $tab);
    echo "<option value=''>.. none ..</option>";
    foreach($kols as $kol) :
        echo "<option>" . $kol['Field'] . "</option>";
    endforeach;
}

// FUNGSI USER SQL -------------------------------------------------------------------------------------
if(isset($_GET['userSQL'])){
    if($_GET['userSQL']=="edit"){
        global $conn;
        $userQuery = $_POST['query'];
        $q = mysqli_query($conn, $userQuery);
        if($q){
            header("Location: user?userSQL");
            flasher('Your SQL query has been ', 'executed successfully', 'success');
        }else{
            header("Location: user?userSQL");
            flasher('Your SQL query not executed ', 'check it back dude!', 'danger');
        }
    }
}