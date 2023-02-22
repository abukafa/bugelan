<?php
include 'config.php';
require('../assets/pdf/fpdf.php');

$pdf = new FPDF("P","cm","A4");
$id=$_GET['id'];
$query=mysqli_query($conn, "select * from siswa where id=" . $id);

$pdf->SetMargins(1,1,1);
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->Image('../assets/logo/kop.png',1,0.6,20,2); 
$pdf->Line(1,2.7,20,2.7);
$pdf->SetLineWidth(0.1);      
$pdf->Line(1,2.8,20,2.8);   
$pdf->SetLineWidth(0);

$pdf->ln(2.2);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(19,0.7,"D A T A   S I S W A",0,10,'C');
$pdf->ln(0.3);

$no=1;
$id=$_GET['id'];
$query=mysqli_query($conn, "SELECT * from siswa where id=" . $id);
while($lihat=mysqli_fetch_array($query)){

if(file_exists('../public/foto/'. $id . '.jpg')){
	$pdf->Image('../public/foto/'. $id . '.jpg',1.3,4.5,3,4);
 }else{
	$pdf->Image('../public/foto/no.png',1.3,4.5,3,4);
}

$pdf->SetFont('Arial','',10);
$pdf->Cell(4, 0.8, '', 0, 0, 'C');
$pdf->Cell(3, 0.8, 'Nama Lengkap', 0, 0, 'L');
$pdf->Cell(12, 0.8,": " . $lihat['nama'],0, 1, 'L');
$pdf->Cell(4, 0.8, '', 0, 0, 'C');
$pdf->Cell(3, 0.8, 'Nomor Induk', 0, 0, 'L');
$pdf->Cell(12, 0.8,": " . $lihat['nisn'],0, 1, 'L');
$pdf->Cell(4, 0.8, '', 0, 0, 'C');
$pdf->Cell(3, 0.8, 'Jenis Kelamin', 0, 0, 'L');
$pdf->Cell(12, 0.8, $lihat['jk']=='L' ? ': Laki-laki' : ': Perempuan' , 0, 1,'L');
$pdf->Cell(4, 0.8, '', 0, 0, 'C');
$pdf->Cell(3, 0.8, 'Kelas', 0, 0, 'L');

if(date('m')<7){
    $thn=date('Y')-1;
}else{
    $thn=date('Y');
}
$kls=$thn-$lihat['tahun']+7;

$pdf->Cell(12, 0.8,": " . $kls , 0, 1,'L');
$pdf->Cell(4, 0.8, '', 0, 0, 'C');
$pdf->Cell(3, 0.8, 'Tempat Tgl Lahir', 0, 0, 'L');
$pdf->Cell(12, 0.8,": " . $lihat['tempat_lahir'] . ", " . $lihat['tanggal_lahir'], 0, 1,'L');
$pdf->Cell(4, 0.8, '', 0, 0, 'C');
$pdf->Cell(3, 0.8, 'Status Keluarga', 0, 0, 'L');
$pdf->Cell(12, 0.8,": Anak ke " . $lihat['anak_ke'] . "  dari  " . $lihat['jml_saudara'] . " Bersaudara ", 0, 1,'L');
$pdf->ln(0.25);
$pdf->Cell(19, 1, 'ALAMAT LENGKAP', 1, 1, 'C');
$pdf->Cell(19, 0.8, $lihat['alamat'] ." RT. " . $lihat['rt'] . "  RW. " . $lihat['rw'] , 0, 1,'C');
$pdf->Cell(19, 0.8, "Kel. " . $lihat['kelurahan'] . "  Kec. " . $lihat['kelurahan'] . "  Kode pos. " . $lihat['kode_pos'], 0, 1,'C');
$pdf->ln(0.25);

// $pdf->Cell(9.5, 1, 'BAKAT DAN MINAT',1,0, 'C');
// $pdf->Cell(9.5, 1, 'KETERANGAN FISIK', 1, 1, 'C');
// $pdf->Cell(0.5, 0.8, '', 0, 0, 'C');
// $pdf->Cell(3.5, 0.8, 'Hobi', 0, 0, 'L');
// $pdf->Cell(6, 0.8,": " . $lihat['hobi'], 0, 0,'L');
// $pdf->Cell(3, 0.8, 'Tinggi Badan', 0, 0, 'L');
// $pdf->Cell(6.5, 0.8,": " . $lihat['tinggi'] . " cm", 0, 1,'L');
// $pdf->Cell(0.5, 0.8, '', 0, 0, 'C');
// $pdf->Cell(3.5, 0.8, 'Olah raga yg disuka', 0, 0, 'L');
// $pdf->Cell(6, 0.8,": " . $lihat['olah_raga'], 0, 0,'L');
// $pdf->Cell(3, 0.8, 'Berat Badan', 0, 0, 'L');
// $pdf->Cell(6.5, 0.8,": " . $lihat['berat'] . " Kg", 0, 1,'L');
// $pdf->Cell(0.5, 0.8, '', 0, 0, 'C');
// $pdf->Cell(3.5, 0.8, 'Pelajaran yg disuka', 0, 0, 'L');
// $pdf->Cell(6, 0.8,": " , 0, 0,'L');
// $pdf->Cell(3, 0.8, 'Jarak ke Sekolah', 0, 0, 'L');
// $pdf->Cell(6.5, 0.8,": " . $lihat['jarak'], 0, 1,'L');
// $pdf->Cell(0.5, 0.8, '', 0, 0, 'C');
// $pdf->Cell(3.5, 0.8, 'Prestasi yg diraih', 0, 0, 'L');
// $pdf->Cell(6, 0.8,": " . $lihat['prestasi'], 0, 0,'L');
// $pdf->Cell(3, 0.8, 'Waktu tempuh', 0, 0, 'L');
// $pdf->Cell(6.5, 0.8,": " . $lihat['waktu'], 0, 1,'L');
// $pdf->Cell(0.5, 0.8, '', 0, 0, 'C');
// $pdf->Cell(3.5, 0.8, 'Cita-cita', 0, 0, 'L');
// $pdf->Cell(6, 0.8,": " . $lihat['cita'], 0, 1,'L');
// $pdf->ln(0.25);

$pdf->Cell(19, 1, 'DATA ORANG TUA/ WALI', 1, 1, 'C');
$pdf->Cell(0.5, 0.8, '', 0, 0, 'C');
$pdf->Cell(3.5, 0.8, 'Nama Ayah', 0, 0, 'L');
$pdf->Cell(6, 0.8,": " . $lihat['nama_ayah'], 0, 0,'L');
$pdf->Cell(3, 0.8, 'Nama Ibu', 0, 0, 'L');
$pdf->Cell(6, 0.8,": " . $lihat['nama_ibu'], 0, 1,'L');
$pdf->Cell(0.5, 0.8, '', 0, 0, 'C');
$pdf->Cell(3.5, 0.8, 'Tempat Lahir', 0, 0, 'L');
$pdf->Cell(6, 0.8,": " . $lihat['tl_ayah'], 0, 0,'L');
$pdf->Cell(3, 0.8, 'Tempat Lahir', 0, 0, 'L');
$pdf->Cell(6, 0.8,": " . $lihat['tl_ibu'], 0, 1,'L');
$pdf->Cell(0.5, 0.8, '', 0, 0, 'C');
$pdf->Cell(3.5, 0.8, 'Pendidikan terakhir', 0, 0, 'L');
$pdf->Cell(6, 0.8,": " . $lihat['pendidikan_ayah'], 0, 0,'L');
$pdf->Cell(3, 0.8, 'Pendidikan akhir', 0, 0, 'L');
$pdf->Cell(6, 0.8,": " . $lihat['pendidikan_ibu'], 0, 1,'L');
$pdf->Cell(0.5, 0.8, '', 0, 0, 'C');
$pdf->Cell(3.5, 0.8, 'Pekerjaan', 0, 0, 'L');
$pdf->Cell(6, 0.8,": " . $lihat['pekerjaan_ayah'], 0, 0,'L');
$pdf->Cell(3, 0.8, 'Pekerjaan', 0, 0, 'L');
$pdf->Cell(6, 0.8,": " . $lihat['pekerjaan_ibu'], 0, 1,'L');
$pdf->Cell(0.5, 0.8, '', 0, 0, 'C');
$pdf->Cell(3.5, 0.8, 'Penghasilan', 0, 0, 'L');
$pdf->Cell(6, 0.8,": " . $lihat['penghasilan_ayah'], 0, 0,'L');
$pdf->Cell(3, 0.8, 'Penghasilan', 0, 0, 'L');
$pdf->Cell(6, 0.8,": " . $lihat['penghasilan_ibu'], 0, 1,'L');
$pdf->ln(0.25);
$pdf->Cell(0.5, 0.8, '', 'L,T', 0, 'C');
$pdf->Cell(3.5, 0.8, 'Wali', 'T', 0, 'L');
$pdf->Cell(6, 0.8,": " . $lihat['nama_wali'], 'T', 0,'L');
$pdf->Cell(3, 0.8, 'Pekerjaan', 'T', 0, 'L');
$pdf->Cell(6, 0.8,": " . $lihat['tl_wali'], 'T,R', 1,'L');
$pdf->Cell(0.5, 0.8, '', 'L', 0, 'C');
$pdf->Cell(3.5, 0.8, 'Telepon', 0, 0, 'L');
$pdf->Cell(6, 0.8,": " . $lihat['pendidikan_wali'], 0, 0,'L');
$pdf->Cell(3, 0.8, 'Keterangan', 0, 0, 'L');
$pdf->Cell(6, 0.8,": " . $lihat['pekerjaan_wali'], 'R', 1,'L');
$pdf->Cell(0.5, 0.8, '', 'L,B', 0, 'C');
$pdf->Cell(3.5, 0.8, 'Alamat', 'B', 0, 'L');
$pdf->Cell(15, 0.8,": " . $lihat['penghasilan_wali'], 'R,B', 1,'L');
$pdf->ln(0.25);

$pdf->Cell(0.5, 0.8, '', 0, 0, 'C');
$pdf->Cell(3.5, 0.8, 'Catatan', 0, 0, 'L');
// $pdf->Cell(6, 0.8,": " . $lihat['ket_santri'], 0, 1,'L');

$no++;


$pdf->Output($lihat['nama']. ".pdf","I");
}
?>

