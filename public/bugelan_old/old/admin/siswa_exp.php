<?php 

session_start();
include 'config.php';
  if(!isset($_SESSION['uname'])){
    header("location:../");
    exit;
  }
$use=$_SESSION['uname'];
$user=myquery("select * from admin where uname='$use'");
$u=$user[0];

if(date('m')<7){
    $tah=date('Y')-1;
}else{
    $tah=date('Y');
}

// FUNGSI EXPORT SISWA ---------------------------------------------------------------------------------------------------
$query="SELECT * FROM siswa";
if(isset($_GET['thn'])){
    if($_GET['thn']<>''){
        $thn=$_GET['thn'];
        $query .= " WHERE tahun='$thn' ORDER BY nama";
        $label = "Kelas " . $tah-$thn+7;
    }else{
        $label = "SMPT Bugelan";
        $query .= " ORDER BY tahun, nama";
    }
    
    $output = '
    <b>DATA SISWA</b><br>
    <b>'. $label .'</b><br><br>
    <table>
        <tr>
            <th>ID</th>
            <th>NISN</th>
            <th>NAMA</th>
            <th>NIPD</th>
            <th>JK</th>
            <th>TEMPAT_LAHIR</th>
            <th>TANGGAL_LAHIR</th>
            <th>NIK</th>
            <th>AGAMA</th>
            <th>ALAMAT</th>
            <th>RT</th>
            <th>RW</th>
            <th>DUSUN</th>
            <th>KELURAHAN</th>
            <th>KECAMATAN</th>
            <th>KODE_POS</th>
            <th>JENIS_TINGGAL</th>
            <th>ALAT_TRANSPORTASI</th>
            <th>TELEPON</th>
            <th>HP</th>
            <th>EMAIL</th>
            <th>SKHUN</th>
            <th>PENERIMA_KPS</th>
            <th>NO_KPS</th>
            <th>NAMA_AYAH</th>
            <th>TL_AYAH</th>
            <th>PENDIDIKAN_AYAH</th>
            <th>PEKERJAAN_AYAH</th>
            <th>PENGHASILAN_AYAH</th>
            <th>NIK_AYAH</th>
            <th>NAMA_IBU</th>
            <th>TL_IBU</th>
            <th>PENDIDIKAN_IBU</th>
            <th>PEKERJAAN_IBU</th>
            <th>PENGHASILAN_IBU</th>
            <th>NIK_IBU</th>
            <th>NAMA_WALI</th>
            <th>TL_WALI</th>
            <th>PENDIDIKAN_WALI</th>
            <th>PEKERJAAN_WALI</th>
            <th>PENGHASILAN_WALI</th>
            <th>NIK_WALI</th>
            <th>TAHUN</th>
            <th>NPUN</th>
            <th>NO_SERI_IJAZAH</th>
            <th>PENERIMA_KIP</th>
            <th>NOMOR_KIP</th>
            <th>NAMA_DI_KIP</th>
            <th>NOMOR_KKS</th>
            <th>NO_REGISTRASI_AKTA_LAHIR</th>
            <th>BANK</th>
            <th>NOMOR_REKENING_BANK</th>
            <th>REKENING_ATAS_NAMA</th>
            <th>LAYAK_PIP</th>
            <th>ALASAN_LAYAK_PIP</th>
            <th>KEBUTUHAN_KHUSUS</th>
            <th>SEKOLAH_ASAL</th>
            <th>ANAK_KE</th>
            <th>LINTANG</th>
            <th>BUJUR</th>
            <th>NO_KK</th>
            <th>BERAT_BADAN</th>
            <th>TINGGI_BADAN</th>
            <th>LINGKAR_KEPALA</th>
            <th>JML_SAUDARA</th>
            <th>JARAK_RUMAH</th>        
        </tr>
    ';
    $data = myquery($query);
    foreach($data as $da):
    $output .= '
        <tr>
            <td>'. $da['id'] .'</td>
            <td>'. $da['nisn'] .'</td>
            <td>'. $da['nama'] .'</td>
            <td>'. $da['nipd'] .'</td>
            <td>'. $da['jk'] .'</td>
            <td>'. $da['tempat_lahir'] .'</td>
            <td>'. $da['tanggal_lahir'] .'</td>
            <td>'. $da['nik'] .'</td>
            <td>'. $da['agama'] .'</td>
            <td>'. $da['alamat'] .'</td>
            <td>'. $da['rt'] .'</td>
            <td>'. $da['rw'] .'</td>
            <td>'. $da['dusun'] .'</td>
            <td>'. $da['kelurahan'] .'</td>
            <td>'. $da['kecamatan'] .'</td>
            <td>'. $da['kode_pos'] .'</td>
            <td>'. $da['jenis_tinggal'] .'</td>
            <td>'. $da['alat_transportasi'] .'</td>
            <td>'. $da['telepon'] .'</td>
            <td>'. $da['hp'] .'</td>
            <td>'. $da['email'] .'</td>
            <td>'. $da['skhun'] .'</td>
            <td>'. $da['penerima_kps'] .'</td>
            <td>'. $da['no_kps'] .'</td>
            <td>'. $da['nama_ayah'] .'</td>
            <td>'. $da['tl_ayah'] .'</td>
            <td>'. $da['pendidikan_ayah'] .'</td>
            <td>'. $da['pekerjaan_ayah'] .'</td>
            <td>'. $da['penghasilan_ayah'] .'</td>
            <td>'. $da['nik_ayah'] .'</td>
            <td>'. $da['nama_ibu'] .'</td>
            <td>'. $da['tl_ibu'] .'</td>
            <td>'. $da['pendidikan_ibu'] .'</td>
            <td>'. $da['pekerjaan_ibu'] .'</td>
            <td>'. $da['penghasilan_ibu'] .'</td>
            <td>'. $da['nik_ibu'] .'</td>
            <td>'. $da['nama_wali'] .'</td>
            <td>'. $da['tl_wali'] .'</td>
            <td>'. $da['pendidikan_wali'] .'</td>
            <td>'. $da['pekerjaan_wali'] .'</td>
            <td>'. $da['penghasilan_wali'] .'</td>
            <td>'. $da['nik_wali'] .'</td>
            <td>'. $da['tahun'] .'</td>
            <td>'. $da['npun'] .'</td>
            <td>'. $da['no_seri_ijazah'] .'</td>
            <td>'. $da['penerima_kip'] .'</td>
            <td>'. $da['nomor_kip'] .'</td>
            <td>'. $da['nama_di_kip'] .'</td>
            <td>'. $da['nomor_kks'] .'</td>
            <td>'. $da['no_registrasi_akta_lahir'] .'</td>
            <td>'. $da['bank'] .'</td>
            <td>'. $da['nomor_rekening_bank'] .'</td>
            <td>'. $da['rekening_atas_nama'] .'</td>
            <td>'. $da['layak_pip'] .'</td>
            <td>'. $da['alasan_layak_pip'] .'</td>
            <td>'. $da['kebutuhan_khusus'] .'</td>
            <td>'. $da['sekolah_asal'] .'</td>
            <td>'. $da['anak_ke'] .'</td>
            <td>'. $da['lintang'] .'</td>
            <td>'. $da['bujur'] .'</td>
            <td>'. $da['no_kk'] .'</td>
            <td>'. $da['berat_badan'] .'</td>
            <td>'. $da['tinggi_badan'] .'</td>
            <td>'. $da['lingkar_kepala'] .'</td>
            <td>'. $da['jml_saudara'] .'</td>
            <td>'. $da['jarak_rumah'] .'</td>                
        </tr>
    ';
    endforeach;
    '</table>';
    header("Content-Type: application/xls");
    header("Content-Disposition: attachment; filename=Data Siswa.xls");
    echo $output;

}