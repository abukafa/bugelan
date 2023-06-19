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
$pdf->SetMargins(0.5,0,0,0);
$pdf->AliasNbPages();

if(date('m')<7){
    $thn=date('Y')-1;
}else{
    $thn=date('Y');
}
$alm=$thn-3;

if(isset($_GET['kls'])){
  $kls=$_GET['kls'];
  $query="SELECT * from siswa where tahun='$kls'";
}else if(isset($_GET['id'])){
  $ids=$_GET['id'];
  $query="SELECT * from siswa where id='$ids'";
}else{
  $query="SELECT * from siswa where tahun>'$alm'";
}

$no=1;
$query=mysqli_query($conn, $query);
while($s=mysqli_fetch_assoc($query)){

$pdf->AddPage();
$id = $s['id'];
if($id<>'' && file_exists('../public/foto/' . $id . '.jpg')){
$pdf->Image('../public/foto/'. $id .'.jpg',1.8,1.8,1.8,2.4); 
}
$pdf->Image('../assets/logo/card_front.png',0,0,5.5,9); 
$pdf->ln(4.9);
$pdf->SetTextColor(255,255,255);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(0.25,0.35,'',0,0,'L');
$pdf->multiCell(4,0.5, $s['nama'] ,0,'C');
$pdf->ln(0.5);
$pdf->SetFont('Arial','B',9);

require_once('../assets/phpqrcode-master/qrlib.php');
QRcode::png($s['nisn'], '../public/qrcode/'. $id .'.png', 'M', 2, 2);
$pdf->Image('../public/qrcode/'.$id.'.png', 1.8, 6.8, 1.9, 1.9, 'png');

$pdf->setAutoPageBreak(false);
$pdf->AddPage();
$pdf->Image('../assets/logo/card_back.png',0,0,5.5,9); 
$pdf->ln(4.5);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','',7);
$pdf->Cell(1,0.35,'NIS',0,0,'L');
$pdf->Cell(0.2,0.35,': ',0,0,'L');
$pdf->multiCell(3.5,0.35, $s['nisn'] ,0,'L');
$pdf->Cell(1,0.35,'Nama',0,0,'L');
$pdf->Cell(0.2,0.35,': ',0,0,'L');
$pdf->multiCell(3.5,0.35, $s['nama'] ,0,'L');
$pdf->Cell(1,0.35,'JK',0,0,'L');
$pdf->Cell(0.2,0.35,': ',0,0,'L');
$pdf->multiCell(3.5,0.35, $s['jk']=='P' ? 'Perempuan' : 'Laki-laki' ,0,'L');
$pdf->Cell(1,0.35,'TTL',0,0,'L');
$pdf->Cell(0.2,0.35,': ',0,0,'L');
$tgl = date_create($s['tanggal_lahir']);
$pdf->multiCell(3.5,0.35, $s['tempat_lahir'] .', '. date_format($tgl,'j M Y') ,0,'L');
$pdf->Cell(1,0.35,'Alamat',0,0,'L');
$pdf->Cell(0.2,0.35,': ',0,0,'L');
$pdf->multiCell(3.5,0.35, $s['alamat'] .', '. $s['kelurahan'] .', '. $s['kecamatan'] .' '. $s['kode_pos'] ,0,'L');

if(isset($_GET['kls'])){
  $kls=$_GET['kls'];
  $print= "Kartu Siswa Kls " . ($thn-$kls)+7;
}else if(isset($_GET['id'])){
  $ids=$_GET['id'];
  $print=$s['nama'];
}else{
}

}
$pdf->Output($print .".pdf","I");
?>

