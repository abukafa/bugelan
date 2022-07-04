<?php
include 'config.php';
require('../assets/pdf/fpdf.php');

$pdf = new FPDF("P","cm","A4");

$pdf->SetMargins(1,1,1);
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->Image('../assets/logo/kop.png',1,0.5,19,2); 
$pdf->Line(1,2.7,20,2.7);
$pdf->SetLineWidth(0.1);      
$pdf->Line(1,2.8,20,2.8);   
$pdf->SetLineWidth(0);

$pdf->ln(2.5);
$awl=$_GET['tgl_awal'];
$ahr=$_GET['tgl_ahir'];
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,0.7,'REKAP ABSENSI SISWA',0,1,'C');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,0.5,$awl . ' s.d. ' . $ahr,0,0,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(1, 0.7, 'No', 1, 0, 'C');
$pdf->Cell(2.5, 0.7, 'Tanggal', 1, 0, 'C');
$pdf->Cell(2, 0.7, 'Jam', 1, 0, 'C');
$pdf->Cell(2, 0.7, 'Terlambat', 1, 0, 'C');
$pdf->Cell(2.5, 0.7, 'NISN', 1, 0, 'C');
$pdf->Cell(5, 0.7, 'Nama Siswa', 1, 0, 'C');
$pdf->Cell(1, 0.7, 'Ket', 1, 0, 'C');
$pdf->Cell(3, 0.7, 'Note', 1, 1, 'C');

$no=1;
$query=mysqli_query($conn, "SELECT * from absen where date between '$awl' and '$ahr' order by date");
while($lihat=mysqli_fetch_assoc($query)){
$pdf->SetFont('Arial','',8);
	$pdf->Cell(1, 0.7, $no,1, 0, 'C');
	$pdf->Cell(2.5, 0.7, $lihat['date'],1, 0, 'C');
	$pdf->Cell(2, 0.7, $lihat['time'] == '00:00:00' ? '' : $lihat['time'],1, 0, 'C');
	$pdf->Cell(2, 0.7, $lihat['late'] == '00:00:00' ? '' : $lihat['late'],1, 0, 'C');
	$pdf->Cell(2.5, 0.7, $lihat['nisn'],1, 0, 'C');
	$pdf->Cell(5, 0.7, ' ' . substr($lihat['name'], 0, 30), 1, 0,'L');
	$pdf->Cell(1, 0.7, $lihat['ket'], 1, 0,'C');
	$pdf->Cell(3, 0.7, ' ' . $lihat['note'], 1, 1,'L');
	$no++;
}

$pdf->Output("bank history ". $awl . "-" . $ahr .".pdf","I");

?>
