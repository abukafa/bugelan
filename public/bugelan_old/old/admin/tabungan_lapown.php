<?php
include 'config.php';
require('../assets/pdf/fpdf.php');

$pdf = new FPDF("P","mm",array(327, 58));

$pdf->SetMargins(2,0,0,0);
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->Image('../assets/logo/logo_black.png',20.5,3.5,17,15); 
$pdf->ln(18);
$pdf->SetFont('Arial','',6.5);
$pdf->Cell(54, 5,'YAYASAN SOSIAL DAN PENDIDIKAN',"B",1, 'C');
$pdf->SetFont('Arial','B',8);
$pdf->Cell(54, 5,'B     U      G     E     L     A     N',"B",1, 'C');
$pdf->SetFont('Arial','',6.5);
$pdf->Cell(54, 5,'Kawalu - Tasikmalaya - Jawa Barat',"0",0, 'C');

$id=$_GET['id'];
$pdf->ln(8);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(55,5,'RINCIAN TABUNGAN',0,1,'R');
$pdf->SetFont('Arial','',8);
$santri=mysqli_query($conn, "SELECT * from siswa where id =" . $id );
while($lih=mysqli_fetch_assoc($santri)){
$pdf->Cell(55,4,'NISN : ' . $lih['nisn'],0,1,'R');
$pdf->Cell(55,4,'Nama : ' . $lih['nama'],0,1,'R');
$pdf->Cell(55,5,'Wali : ' . $lih['nama_ayah'],0,1,'R');
}
$pdf->ln(3);
$pdf->SetFont('Arial','',7);
$pdf->Cell(5, 5, 'No', 1, 0, 'C');
$pdf->Cell(15, 5, 'Tgl', 1, 0, 'C');
$pdf->Cell(17, 5, 'Debit', 1, 0, 'C');
$pdf->Cell(17, 5, 'Kredit', 1, 1, 'C');

$no=1;
$query=mysqli_query($conn, "SELECT * from tabungan where id_siswa='$id' order by tgl asc");
while($lihat=mysqli_fetch_assoc($query)){
	$pdf->Cell(5, 5, $no,1,0, 'C');
	$pdf->Cell(15, 5, $lihat['tgl'],1, 0, 'C');
	$pdf->Cell(17, 5, number_format($lihat['debit'],0,'',','), 1, 0,'R');
	$pdf->Cell(17, 5, number_format($lihat['kredit'],0,'',','), 1, 1,'R');
	$no++;
}
$pdf->SetFont('Arial','B',8);
$tot=mysqli_query($conn, "SELECT sum(if(id_siswa=". $id .", debit, 0)) as dbt, sum(if(id_siswa=". $id .", kredit, 0)) as kdt from tabungan");
while($see=mysqli_fetch_assoc($tot)){
	$pdf->Cell(20, 5, '', 0, 0,'C');
	$pdf->Cell(17, 5, number_format($see['dbt'],0,'',','), 1, 0,'R');
	$pdf->Cell(17, 5, number_format($see['kdt'],0,'',','), 1, 1,'R');
	$jml = $see['dbt'] - $see['kdt'];
	$pdf->Cell(54, 5, number_format($jml,0,'',','), 0, 1,'R');
}

$pdf->Output("struk.pdf","I");

?>

