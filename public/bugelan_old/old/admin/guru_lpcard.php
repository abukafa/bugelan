<?php
session_start();
include 'config.php';
  if(!isset($_SESSION['uname'])){
    header("location:../index");
    exit;
  }

require('../assets/pdf/fpdf.php');

$pdf = new FPDF("P","cm",array(5.5, 9));

$pdf->setX(0);
$pdf->SetMargins(0,0,0,0);
$pdf->AliasNbPages();

if(date('m')<7){
    $thn=date('Y')-1;
}else{
    $thn=date('Y');
}
$alm=$thn-3;

$no=1;
if(isset($_GET['id'])){
  $idg = $_GET['id'];
  $myquery = 'SELECT * FROM guru WHERE id=' . $idg;
}else{
  $myquery = 'SELECT * FROM guru ORDER BY nig';
}
$query=mysqli_query($conn, $myquery);
while($s=mysqli_fetch_assoc($query)){

$pdf->AddPage();
$id = $s['id'];
if($id<>'' && file_exists('../public/foto/' . $s['nig'] . '.jpg')){
  $pdf->Image('../public/foto/'. $s['nig'] .'.jpg',1.6,1.7,2.3,3); 
}
$pdf->Image('../assets/logo/ct_front.png',0,0,5.5,9); 
$pdf->SetFont('Arial','B',9);
$pdf->ln(0.73);
$pdf->Cell(1.3,0.35,'',0,0,'L');
$pdf->Cell(1,0.35,'SMP Terpadu Bugelan',0,0,'L');
$pdf->ln(4.2);
$pdf->SetFont('Arial','B',10);
$pdf->SetTextColor(255,255,255);
$pdf->multiCell(5.5,0.5, $s['nama'] ,0,'C');
$pdf->ln(0.5);
$pdf->SetFont('Arial','B',9);

require_once('../assets/phpqrcode-master/qrlib.php');
QRcode::png($s['nig'], '../public/qrcode/'. $id .'.png', 'M', 2, 2);
$pdf->Image('../public/qrcode/'.$id.'.png', 3.38, 6.45, 1.9, 1.9, 'png');

$pdf->setAutoPageBreak(false);
$pdf->AddPage();
$pdf->Image('../assets/logo/ct_back.png',0,0,5.5,9); 
$pdf->ln(2);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(0.25,0.35,'',0,0,'L');
$pdf->Cell(1,0.35,'Biodata Guru',0,0,'L');
$pdf->ln(0.5);
$pdf->SetFont('Arial','',7);
$pdf->Cell(0.25,0.35,'',0,0,'L');
$pdf->Cell(1,0.35,'NIG',0,0,'L');
$pdf->Cell(0.2,0.35,': ',0,0,'L');
$pdf->multiCell(3.5,0.35, $s['nig'] ,0,'L');
$pdf->Cell(0.25,0.35,'',0,0,'L');
$pdf->Cell(1,0.35,'Nama',0,0,'L');
$pdf->Cell(0.2,0.35,': ',0,0,'L');
$pdf->multiCell(3.5,0.35, $s['nama'] ,0,'L');
$pdf->Cell(0.25,0.35,'',0,0,'L');
$pdf->Cell(1,0.35,'JK',0,0,'L');
$pdf->Cell(0.2,0.35,': ',0,0,'L');
$pdf->multiCell(3.5,0.35, $s['jk']=='P' ? 'Perempuan' : 'Laki-laki' ,0,'L');
$pdf->Cell(0.25,0.35,'',0,0,'L');
$pdf->Cell(1,0.35,'TTL',0,0,'L');
$pdf->Cell(0.2,0.35,': ',0,0,'L');
$tgl = date_create($s['tanggal_lahir']);
$pdf->multiCell(3.5,0.35, $s['tempat_lahir'] .', '. date_format($tgl,'j M Y') ,0,'L');
$pdf->Cell(0.25,0.35,'',0,0,'L');
$pdf->Cell(1,0.35,'Alamat',0,0,'L');
$pdf->Cell(0.2,0.35,': ',0,0,'L');
$pdf->multiCell(3.5,0.35, $s['alamat'] ,0,'L');

$pdf->Output( isset($_GET['id']) ? $s['nama'] . ".pdf" : "Kartu Guru.pdf","I");
}
?>

