<?php
include 'config.php';
require('../assets/pdf/fpdf.php');

$pdf = new FPDF("P","cm","A4");

if(date('m')<7){
    $thn=date('Y')-1;
}else{
    $thn=date('Y');
}
$alm=$thn-3;

$pdf->SetMargins(1,1,1);
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->Image('../assets/logo/kop.png',1,0.5,19,2); 
$pdf->Line(1,2.7,20,2.7);
$pdf->SetLineWidth(0.1);      
$pdf->Line(1,2.8,20,2.8);   
$pdf->SetLineWidth(0);

$pdf->ln(2.5);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,0.7,'INDEX TABUNGAN SISWA',0,1,'C');
$pdf->Cell(0,0.7,'Update '.date("d M Y"),0,1,'C');
$pdf->ln(0.5);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(0.7, 0.7, 'No', 1, 0, 'C');
$pdf->Cell(1.8, 0.7, 'NIS', 1, 0, 'C');
$pdf->Cell(1, 0.7, 'Kls', 1, 0, 'C');
$pdf->Cell(4.5, 0.7, 'Nama Santri', 1, 0, 'C');
$pdf->Cell(4, 0.7, 'Nama Wali', 1, 0, 'C');
$pdf->Cell(2, 0.7, 'Debit', 1, 0, 'C');
$pdf->Cell(2, 0.7, 'Kredit', 1, 0, 'C');
$pdf->Cell(3, 0.7, 'Saldo', 1, 1, 'C');

$no=1;
$query=mysqli_query($conn, "SELECT * from siswa where tahun>'$alm' order by tahun");
while($lihat=mysqli_fetch_assoc($query)){
	$pdf->SetFont('Arial','',8);
	$ni=$lihat['nisn'];
	$pdf->Cell(0.7, 0.7, $no, 1, 0, 'C');
	$pdf->Cell(1.8, 0.7, $ni,1, 0, 'C');
	$pdf->Cell(1, 0.7, $thn-$lihat['tahun']+7,1, 0, 'C');
	$pdf->Cell(4.5, 0.7, substr($lihat['nama'], 0, 30), 1, 0,'L');
	$pdf->Cell(4, 0.7, substr($lihat['nama_ayah'], 0, 20), 1, 0,'L');
	
$ids=$lihat['id'];
$jml=mysqli_query($conn, "select sum(if(id_siswa=". $ids .", debit, 0)) as dbt, sum(if(id_siswa=". $ids .", kredit, 0)) as kdt from tabungan");
while($see=mysqli_fetch_assoc($jml)){
	$jum=$see['dbt']-$see['kdt'];
	$pdf->Cell(2, 0.7, number_format($see['dbt'],0,'',','), 1, 0,'R');
	$pdf->Cell(2, 0.7, number_format($see['kdt'],0,'',','), 1, 0,'R');
	$pdf->Cell(3, 0.7, number_format($jum,0,'',','), 1, 1,'R');
	$no++;
}
}

$tjml=mysqli_query($conn, "select sum(debit) as tdbt, sum(kredit) as tkdt from tabungan");
while($tsee=mysqli_fetch_assoc($tjml)){
	$tot=$tsee['tdbt']-$tsee['tkdt'];
	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(12, 0.8, '', 0, 0, 'C');
	$pdf->Cell(2, 0.8, number_format($tsee['tdbt'],0,'',','), 0, 0, 'R');
	$pdf->Cell(2, 0.8, number_format($tsee['tkdt'],0,'',','), 0, 0, 'R');
	$pdf->Cell(3, 0.8, number_format($tot, 0,'',', '), 0, 0, 'R');
	
}

$pdf->Output("bank summary " .date("dmy") .".pdf","I");
?>
