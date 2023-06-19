<?php
include 'config.php';
require('../assets/pdf/fpdf.php');

if(date('m')<7){
    $thn=date('Y')-1;
}else{
    $thn=date('Y');
}
$alm=$thn-3;

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
$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,0.7,'INDEX ABSENSI GURU',0,1,'C');
$pdf->Cell(0,0.7,'Update '.date("d M Y"),0,1,'C');
$pdf->ln(0.5);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(1, 1.4, 'No', 1, 0, 'C');
$pdf->Cell(2, 1.4, 'NIG', 1, 0, 'C');
$pdf->Cell(7.5, 1.4, 'Nama Guru', 1, 0, 'C');
$pdf->Cell(4, 0.7, 'Kehadiran', 1, 0, 'C');
$pdf->Cell(4.5, 0.7, 'Absen', 1, 1, 'C');

$pdf->Cell(10.5, 0.7, '', 0, 0, 'C');
$pdf->Cell(1.5, 0.7, 'Hadir', 1, 0, 'C');
$pdf->Cell(2.5, 0.7, 'Terlambat', 1, 0, 'C');
$pdf->Cell(1.5, 0.7, 'I', 1, 0, 'C');
$pdf->Cell(1.5, 0.7, 'S', 1, 0, 'C');
$pdf->Cell(1.5, 0.7, 'A', 1, 1, 'C');

$no=1;
$query=mysqli_query($conn, "SELECT * from guru ORDER BY nig");
while($lihat=mysqli_fetch_assoc($query)){
	$pdf->SetFont('Arial','',8);
	$ni=$lihat['nig'];
	$pdf->Cell(1, 0.7, $no, 1, 0, 'C');
	$pdf->Cell(2, 0.7, $ni,1, 0, 'C');
	$pdf->Cell(7.5, 0.7, substr($lihat['nama'], 0, 30), 1, 0,'L');
	
$ids=$lihat['id'];
$jml=mysqli_query($conn, "SELECT COUNT(IF(ket='', time, NULL)) AS h, COUNT(DISTINCT IF(ket='i', ket, NULL)) AS i, COUNT(DISTINCT IF(ket='s', ket, NULL)) AS s, COUNT(DISTINCT IF(ket='a', ket, NULL)) AS a, SUM(LEFT(late,2)) AS hor, SUM(MID(late,4,2)) AS min, SUM(RIGHT(late,2)) AS sec FROM absenguru WHERE id_guru='$ids'");
while($see=mysqli_fetch_assoc($jml)){
    if($see['sec'] > 59){
        $sec = $see['sec']%60;
        $min_add = intval($see['sec']/60);
    }else{
        $sec = $see['sec'];
        $min_add = 0;
    }
    if($see['min'] > 59){
        $min = $see['min']%60+$min_add;
        $hor_add = intval($see['min']/60);
    }else{
        $min = $see['min']+$min_add;
        $hor_add = 0;
    }
    $hor = $see['hor']+$hor_add;

    $late = sprintf("%02d", $hor) . ':' . sprintf("%02d", $min) . ':' . sprintf("%02d", $sec);

    $pdf->Cell(1.5, 0.7, $see['h'] == 0 ? '' : $see['h'], 1, 0, 'C');
    $pdf->Cell(2.5, 0.7, $late == '00:00:00' ? '' : $late, 1, 0, 'C');
    $pdf->Cell(1.5, 0.7, $see['i'] == 0 ? '' : $see['i'], 1, 0, 'C');
    $pdf->Cell(1.5, 0.7, $see['s'] == 0 ? '' : $see['s'], 1, 0, 'C');
    $pdf->Cell(1.5, 0.7, $see['a'] == 0 ? '' : $see['a'], 1, 1, 'C');
	$no++;
}
}

$pdf->Output("bank summary " .date("dmy") .".pdf","I");
?>
