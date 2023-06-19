<?php
session_start();
include 'config.php';
  if(!isset($_SESSION['uname'])){
    header("location:../index");
    exit;
  }

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
$pdf->SetFont('Arial','B',15);
$pdf->Cell(0,0.7,'I N D E X   K E U A N G A N',0,1,'C');
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,0.7,'Update ' . date("d M Y") ,0,1,'C');

$pdf->ln(0.5);
$pdf->SetFont('Arial','B',8);
$pdf->SetFillColor(244,164,96);
$pdf->Cell(1, 1.4, 'No', 1, 0, 'C');
$pdf->Cell(1.5, 1.4, 'Akun', 1, 0, 'C');
$pdf->Cell(5, 1.4, 'Alokasi', 1, 0, 'C');
$pdf->Cell(6.5, 1.4, 'Keterangan', 1, 0, 'C');
$pdf->Cell(5, 0.7, 'Sub Total', 1, 1, 'C');

$pdf->Cell(14, 0.7, '', 0, 0, 'C');
$pdf->Cell(2.5, 0.7, 'Debit', 1, 0, 'C');
$pdf->Cell(2.5, 0.7, 'Kredit', 1, 1, 'C');

$pdf->Cell(27.5, 0.1, '', 0, 1, 'C');

$no=1;
$aku=mysqli_query($conn, "select * from account order by code");
	while($b=mysqli_fetch_array($aku)){
	$a=$b['code'];
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(1, 0.7, $no, 1, 0, 'C');
	$pdf->Cell(1.5, 0.7, $a, 1, 0, 'C');
		$pdf->Cell(5, 0.7, $b['name'], 1, 0, 'L');
		$pdf->Cell(6.5, 0.7, $b['des'], 1, 0, 'L');

		$tto=mysqli_query($conn, "select sum(if(account='$a', debit, 0)) as dbt, sum(if(account='$a', credit, 0)) as kdt from finance");
            while($t=mysqli_fetch_array($tto)){
			$pdf->Cell(2.5, 0.7, number_format($t['dbt'],0,'.',','), 1, 0, 'R');
			$pdf->Cell(2.5, 0.7, number_format($t['kdt'],0,'.',','), 1, 1, 'R');

		$no++;
		}
}

$total=mysqli_query($conn, "select sum(debit) as tdbt, sum(credit) as tkdt from finance");
while($ttl=mysqli_fetch_array($total)){

$pdf->Cell(27.5, 0.1, '', 0, 1, 'C');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(9, 1, '', 'L,T,B', 0, 'C');
$pdf->Cell(5, 1, 'Total', 'T,B', 0, 'L');
$pdf->Cell(2.5, 1, number_format($ttl['tdbt'], 0, '', ','), 1, 0, 'R');
$pdf->Cell(2.5, 1, number_format($ttl['tkdt'], 0, '', ','), 1, 1, 'R');
$saldo=$ttl['tdbt']-$ttl['tkdt'];
$pdf->Cell(9, 1, '', 'L,T,B', 0, 'C');
$pdf->Cell(5, 1, 'Saldo', 'T,B', 0, 'L');
$pdf->Cell(5, 1, number_format($saldo, 0, '', ','), 1, 1, 'R');
}

$pdf->ln(1.5);
$pdf->SetFont('Arial','',10);
$pdf->Cell(6, 0.5, '', 0, 0, 'C');
$pdf->Cell(7, 0.5, '', 0, 0, 'C');
$pdf->Cell(6, 0.5,"Tasikmalaya, ".date("d M Y"), 0, 1, 'C');
$pdf->Cell(6, 0.5,'Kepala', 0, 0, 'C');
$pdf->Cell(7, 0.5, '', 0, 0, 'C');
$pdf->Cell(6, 0.5,'Bag. Bendahara', 0, 1, 'C');
$pdf->ln(2);
$pdf->Cell(6, 0.5,'____________________', 0, 0, 'C');
$pdf->Cell(7, 0.5, '', 0, 0, 'C');
$pdf->Cell(6, 0.5,'____________________', 0, 1, 'C');

$pdf->Output("alokasi keuangan ". date("dmy") .".pdf","I");
?>

