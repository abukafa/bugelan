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

$inv=$_GET['inv'];
$fin=myquery("SELECT * FROM finance where inv='$inv'");
$pdf->SetFont('Arial','B',15);
$pdf->Cell(0,0.7,'LAPORAN KEUANGAN',0,1,'C');
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,0.7,$fin[0]['remark'],0,1,'C');

$pdf->ln(0.5);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(1, 0.8, 'No', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'TGL', 1, 0, 'C');
$pdf->Cell(1.5, 0.8, 'Akun', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Vendor', 1, 0, 'C');
$pdf->Cell(9.5, 0.8, 'Uraian', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'Jumlah', 1, 1, 'C');
    $no=1;
    foreach($fin as $f) :
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(1, 0.7, $no,1,0, 'C');
    $pdf->Cell(2, 0.7, $f['date'],1, 0, 'C');
    $pdf->Cell(1.5, 0.7, $f['account'],1, 0, 'C');
    $pdf->Cell(3, 0.7, 'Bendahara', 1, 0,'L');
    $pdf->Cell(9.5, 0.7, $f['des'], 1, 0,'L');
    $amt=$f['credit']-$f['debit'];
    $pdf->Cell(2, 0.7, number_format($amt,0,'',','), 1, 1,'R');
    $no++;
    endforeach;
$pdf->ln(0.1);
$pdf->SetFont('Arial','B',8);
$jf=myquery("SELECT sum(debit) as jd, sum(credit) as jk from finance where inv='".$inv."'");
    $jum_fin=$jf[0]['jk']-$jf[0]['jd'];
    $pdf->Cell(17, 0.8, 'Total Pemasukan', 1, 0,'C');
    $pdf->Cell(2, 0.8, number_format($jum_fin,0,'',','), 1, 1,'R');


$pdf->ln(0.5);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(1, 0.8, 'ID', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'TGL', 1, 0, 'C');
$pdf->Cell(1.5, 0.8, 'Akun', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Vendor', 1, 0, 'C');
$pdf->Cell(9.5, 0.8, 'Uraian', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'Jumlah', 1, 1, 'C');
$query=mysqli_query($conn, "SELECT * from cash where inv='".$inv."' order by account, date");
    while($lihat=mysqli_fetch_array($query)){
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(1, 0.7, $no,1,0, 'C');
    $pdf->Cell(2, 0.7, $lihat['date'],1, 0, 'C');
    $pdf->Cell(1.5, 0.7, $lihat['account'],1, 0, 'C');
    $pdf->Cell(3, 0.7, substr($lihat['vendor'],0,19), 1, 0,'L');
    $pdf->Cell(9.5, 0.7, $lihat['des'], 1, 0,'L');
    $amon=$lihat['credit']-$lihat['debit'];
    $pdf->Cell(2, 0.7, number_format($amon,0,'',','), 1, 1,'R');
    $no++;
}
$pdf->ln(0.1);
$pdf->SetFont('Arial','B',8);
$jml=mysqli_query($conn, "SELECT sum(debit) as jd, sum(credit) as jk from cash where inv='".$inv."'");
    while($see=mysqli_fetch_array($jml)){
    $jum=$see['jk']-$see['jd'];
    $pdf->Cell(17, 0.8, 'Total Pengeluaran', 1, 0,'C');
    $pdf->Cell(2, 0.8, number_format($jum,0,'',','), 1, 1,'R');
}

$saldo=$jum_fin-$jum;
$pdf->Cell(17, 0.8, 'Saldo Akhir', 1, 0,'C');
$pdf->Cell(2, 0.8, number_format($saldo,0,'',','), 1, 1,'R');

$pdf->ln(1);
$pdf->SetFont('Arial','',10);
$pdf->Cell(6, 0.5, '', 0, 0, 'C');
$pdf->Cell(7, 0.5, '', 0, 0, 'C');
$pdf->Cell(6, 0.5,"Tasikmalaya, ". date("d M Y"), 0, 1, 'C');
$pdf->Cell(6, 0.5,'', 0, 0, 'C');
$pdf->Cell(7, 0.5, '', 0, 0, 'C');
$pdf->Cell(6, 0.5,'Penanggungjawab', 0, 1, 'C');
$pdf->ln(1);
$pdf->Cell(6, 0.5,'', 0, 0, 'C');
$pdf->Cell(7, 0.5, '', 0, 0, 'C');
$pdf->Cell(6, 0.5, $fin[0]['vendor'] , 0, 1, 'C');

$pdf->Output("laporan keuangan ". date("dmy") .".pdf","I");
?>