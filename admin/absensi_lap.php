<?php
include 'config.php';
require('../assets/pdf/fpdf.php');

$no=1;
if(date('m')<7){
    $thn=date('Y')-1;
}else{
    $thn=date('Y');
}

// FUNGSI FORMAT TANGGAL INDONESIA ------- | H:i --------------------------------------------------------------
function indo_date($timestamp = '', $date_format = 'l, j F Y', $suffix = '') { 
    if (trim ($timestamp) == '')
    {
            $timestamp = time ();
    }
    elseif (!ctype_digit ($timestamp))
    {
        $timestamp = strtotime ($timestamp);
    }
    # remove S (st,nd,rd,th) there are no such things in indonesia :p
    $date_format = preg_replace ("/S/", "", $date_format);
    $pattern = array (
        '/Mon[^day]/','/Tue[^sday]/','/Wed[^nesday]/','/Thu[^rsday]/',
        '/Fri[^day]/','/Sat[^urday]/','/Sun[^day]/','/Monday/','/Tuesday/',
        '/Wednesday/','/Thursday/','/Friday/','/Saturday/','/Sunday/',
        '/Jan[^uary]/','/Feb[^ruary]/','/Mar[^ch]/','/Apr[^il]/','/May/',
        '/Jun[^e]/','/Jul[^y]/','/Aug[^ust]/','/Sep[^tember]/','/Oct[^ober]/',
        '/Nov[^ember]/','/Dec[^ember]/','/January/','/February/','/March/',
        '/April/','/June/','/July/','/August/','/September/','/October/',
        '/November/','/December/',
    );
    $replace = array ( 'Sen','Sel','Rab','Kam','Jum','Sab','Aha',
        'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Ahad',
        'Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des',
        'Januari','Februari','Maret','April','Juni','Juli','Agustus','Sepember',
        'Oktober','November','Desember',
    );
    $date = date ($date_format, $timestamp);
    $date = preg_replace ($pattern, $replace, $date);
    $date = "{$date} {$suffix}";
    return $date;
}

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
$kls=$_GET['kls'];
$today=$_GET['tgl'];
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,0.5,'REKAP ABSENSI SISWA',0,1,'C');
$pdf->SetFont('Arial','B',11);
$pdf->Cell(0,0.5, indo_date($today),0,1,'C');
$pdf->Cell(0,0.5,'Kelas : ' . $kls,0,1,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(1, 0.7, 'No', 1, 0, 'C');
$pdf->Cell(2.5, 0.7, 'NISN', 1, 0, 'C');
$pdf->Cell(5, 0.7, 'Nama Siswa', 1, 0, 'C');
$pdf->Cell(2, 0.7, 'Jam', 1, 0, 'C');
$pdf->Cell(2, 0.7, 'Terlambat', 1, 0, 'C');
$pdf->Cell(1, 0.7, 'Ket', 1, 0, 'C');
$pdf->Cell(5.5, 0.7, 'Note', 1, 1, 'C');

$tahun=$thn-($kls-7);
$query=mysqli_query($conn, "SELECT * from siswa where tahun='$tahun' order by nama");
while($lihat=mysqli_fetch_assoc($query)){
$ids=$lihat['id'];
$pdf->SetFont('Arial','',8);
	$pdf->Cell(1, 0.7, $no,1, 0, 'C');
	$pdf->Cell(2.5, 0.7, $lihat['nisn'],1, 0, 'C');
	$pdf->Cell(5, 0.7, ' ' . substr($lihat['nama'], 0, 30), 1, 0,'L');
    $absen=myquery("SELECT * FROM absen WHERE id_siswa='$ids' AND date='$today'");
	$pdf->Cell(2, 0.7, !$absen ? '' : ($absen[0]['time'] == '00:00:00' ? '' : $absen[0]['time']),1, 0, 'C');
	$pdf->Cell(2, 0.7, !$absen ? '' : ($absen[0]['late'] == '00:00:00' ? '' : $absen[0]['late']),1, 0, 'C');
	$pdf->Cell(1, 0.7, !$absen ? '' : $absen[0]['ket'], 1, 0,'C');
	$pdf->Cell(5.5, 0.7, !$absen ? '' : $absen[0]['note'], 1, 1,'L');
	$no++;
}

$pdf->Output("ansensi kelas ". $kls .".pdf","I");

?>
