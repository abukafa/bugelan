<?php 
include 'config.php';

if(isset($_GET['mapel'])){
    $kode=($_POST['kode']);
    $kel=$_POST['kel'];
    $mapel=$_POST['mapel'];
    $kls=$_POST['kls'];
    $guru=$_POST['guru'];
    $note=$_POST['note'];
    
    mysqli_query($conn, "insert into mapel values('$kode', '$kel', '$mapel', '$kls', '$guru', '$note')");
    if(mysqli_affected_rows($conn) > 0){
        flasher('Menambah!', $kode, 'success');
    }else{
        flasher('Gagal!', 'Data tidak disimpan', 'error');
    }
    header("location:modul");    
}

if(isset($_GET['tambah'])){
    $kode=$_GET['tambah'];
    $no=$_POST['no_tema'] .'.'. $_POST['no_bab'] .'.'. $_POST['no_judul'] .'.';
    $tema=$_POST['tema'];
    $bab=$_POST['bab'];
    $sub=$_POST['judul'];
    $target=$_POST['target'];
    $indikator=$_POST['indikator'];
    $media=$_POST['media'];
    
    mysqli_query($conn, "insert into modul values('', '$kode', '$no', '$tema', '$bab', '$sub', '$target', '$indikator', '$media', '', '')");
    if(mysqli_affected_rows($conn) > 0){
        flasher('Menambah!', $sub, 'success');
    }else{
        flasher('Gagal!', 'Data tidak disimpan', 'error');
    }
    header("location:modul_add?kode=" . $kode);    
}

if(isset($_GET['edit'])){
    $id=$_GET['edit'];
    $no=$_POST['no_tema'] .'.'. $_POST['no_bab'] .'.'. $_POST['no_judul'] .'.';
    $tema=$_POST['tema'];
    $bab=$_POST['bab'];
    $sub=$_POST['judul'];
    $target=$_POST['target'];
    $indikator=$_POST['indikator'];
    $media=$_POST['media'];
    $materi=$_POST['materi'];
    $note=$_POST['note'];
    
    mysqli_query($conn, "UPDATE modul SET no='$no', tema='$tema', bab='$bab', sub='$sub', target='$target', indikator='$indikator', media='$media', note='$note', materi='$materi' WHERE id='$id'");
    if(mysqli_affected_rows($conn) > 0){
        flasher('Mengubah!', $sub, 'success');
    }else{
        flasher('Gagal!', 'Data tidak disimpan', 'error');
    }
    header("location:modul_edt?id=" . $id);    
}

if(isset($_GET['hapus'])){
    $id=$_GET['hapus'];
    $kode=$_GET['kode'];
    mysqli_query($conn, "DELETE from modul where id='$id'")or die(mysqli_error($conn));
    if(mysqli_affected_rows($conn) > 0){
        flasher('Menghapus!', 'Data Modul', 'success');
    }else{
        flasher('Gagal!', 'Data tidak dihapus', 'error');
    }
    header("Location:modul_add?kode=" . $kode);
}

if(isset($_GET['deleteMapel'])){
    $kode=$_GET['deleteMapel'];
    mysqli_query($conn, "DELETE from mapel where kode='$kode'")or die(mysqli_error($conn));
    if(mysqli_affected_rows($conn) > 0){
        flasher('Menghapus!', 'Mata Pelajaran', 'success');
    }else{
        flasher('Gagal!', 'Data tidak dihapus', 'error');
    }
    header("Location:modul");
}