<?php
session_start();
include 'config.php';
  if(!isset($_SESSION['uname'])){
    header("location:../index");
    exit;
  }

require('../assets/pdf/fpdf.php');

$pdf = new FPDF("L","cm","A4");

$pdf->SetMargins(1,1,1);
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->Image('../assets/logo/kop.png',1,0.5,27.5,2.9); 
$pdf->Line(1,3.5,28.5,3.5);
$pdf->SetLineWidth(0.1);      
$pdf->Line(1,3.6,28.5,3.6);   
$pdf->SetLineWidth(0);

$awl=$_GET['tgl_awal'];
$ahr=$_GET['tgl_ahir'];
$pdf->ln(3);
$pdf->SetFont('Arial','B',15);
$pdf->Cell(0,0.7,'LAPORAN KEUANGAN',0,1,'C');
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,0.7,$awl .' s.d. '. $ahr,0,1,'C');

$akun=mysqli_query($conn, "SELECT * from account order by code");
$jk=mysqli_num_rows($akun);
	while($an=mysqli_fetch_array($akun)){
	$akn=$an['code'];
	$record=mysqli_query($conn, "SELECT * from finance where account='$akn' and date between '".$awl."' and '".$ahr."'");
	if(mysqli_num_rows($record)>0){
		$pdf->ln(0.5);
		$pdf->SetFont('Arial','B',8);
		$pdf->Cell(0,0.7, $an['code'] . ' - ' . $an['unit'] . ' : ' . $an['name'] ,0,1,'L');
		$pdf->Cell(1, 0.8, 'ID', 1, 0, 'C');
		$pdf->Cell(2, 0.8, 'Invoice', 1, 0, 'C');
		$pdf->Cell(2, 0.8, 'TGL', 1, 0, 'C');
		$pdf->Cell(1.5, 0.8, 'Akun', 1, 0, 'C');
		$pdf->Cell(3, 0.8, 'Vendor', 1, 0, 'C');
		$pdf->Cell(9, 0.8, 'Uraian', 1, 0, 'C');
		$pdf->Cell(4, 0.8, 'Keterangan', 1, 0, 'C');
		$pdf->Cell(2.5, 0.8, 'Debit', 1, 0, 'C');
		$pdf->Cell(2.5, 0.8, 'Kredt', 1, 1, 'C');
		$query=mysqli_query($conn, "select * from finance where account= '" . $akn . "' and date between '".$awl."' and '".$ahr."' order by date");
			while($lihat=mysqli_fetch_array($query)){
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(1, 0.7, $lihat['id'],1,0, 'C');
			$pdf->Cell(2, 0.7, $lihat['inv'],1,0, 'C');
			$pdf->Cell(2, 0.7, $lihat['date'],1, 0, 'C');
			$pdf->Cell(1.5, 0.7, $lihat['account'],1, 0, 'C');
			$pdf->Cell(3, 0.7, substr($lihat['vendor'],0,19), 1, 0,'L');
			$pdf->Cell(9, 0.7, $lihat['des'], 1, 0,'L');
			$pdf->Cell(4, 0.7, $lihat['remark'], 1, 0,'C');
			$pdf->Cell(2.5, 0.7, number_format($lihat['debit'],0,'',','), 1, 0,'R');
			$pdf->Cell(2.5, 0.7, number_format($lihat['credit'],0,'',','), 1, 1,'R');
		}
		$pdf->SetFont('Arial','B',8);
		$jml=mysqli_query($conn, "select sum(debit) as jd, sum(credit) as jk from finance where account =  '" . $akn . "' and date between '".$awl."' and '".$ahr."'");
			while($see=mysqli_fetch_array($jml)){
			$jum=$see['jk']-$see['jd'];
			$pdf->Cell(22.5, 0.8, 'Total', 1, 0,'C');
			$pdf->Cell(5, 0.8, number_format($jum,0,'',','), 1, 0,'R');
		}
	}
}

$pdf->ln(1.5);
$pdf->SetFont('Arial','',10);
$pdf->Cell(9.5, 0.5, '', 0, 0, 'C');
$pdf->Cell(8.5, 0.5, '', 0, 0, 'C');
$pdf->Cell(9.5, 0.5,"Tasikmalaya, ".date("d M Y"), 0, 1, 'C');
$pdf->Cell(9.5, 0.5,'Kepala', 0, 0, 'C');
$pdf->Cell(8.5, 0.5, '', 0, 0, 'C');
$pdf->Cell(9.5, 0.5,'Bag. Bendahara', 0, 1, 'C');

$pdf->Output("laporan keuangan ". date("dmy") .".pdf","I");
?>