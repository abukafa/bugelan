<?php
include 'config.php';
require('../assets/pdf/fpdf.php');

$pdf = new FPDF("P","cm","A4");

$pdf->SetMargins(1,0,0);
$pdf->SetAutoPageBreak(true);
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->Image('../assets/logo/kop.png',1,0.5,19,2); 
$pdf->Line(1,2.7,20,2.7);
$pdf->SetLineWidth(0.1);      
$pdf->Line(1,2.8,20,2.8);   
$pdf->SetLineWidth(0);

$pdf->ln(3);

$id=mysqli_real_escape_string($conn, $_GET['id']);
$surat=mysqli_query($conn, "select * from letter where id=" . $id);
while($a=mysqli_fetch_array($surat)){

$pdf->SetFont('Arial','',10);
$pdf->Cell(3,0.6,'Nomor',0,0,'L');
$pdf->Cell(4,0.6,': ' . $a['no'] ,0,1,'L');
$pdf->Cell(3,0.6,'Lampiran',0,0,'L');
$pdf->Cell(4,0.6,': ' . $a['lamp'] ,0,1,'L');
$pdf->Cell(3,0.6,'Perihal',0,0,'L');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(4,0.6,': ' . $a['hal'] ,0,0,'L');
$pdf->SetFont('Arial','',10);
$pdf->Cell(5,0.6,'',0,0,'L');
$pdf->Cell(4,0.6,'Kepada :',0,1,'L');
$pdf->Cell(12,0.6,'',0,0,'L');
$pdf->MultiCell(7,0.6, $a['kpd'] ,0,'L');
$pdf->Cell(12,0.6,'',0,0,'L');
$pdf->Cell(4,0.6,'Di tempat',0,1,'L');

$pdf->SetFont('Arial','I',10);
$pdf->Cell(3,0.6,'Assalaamu\'alaikum warohmatullaahi wabarokaatuh',0,1,'L');

$pdf->ln(0.5);
$pdf->SetFont('Arial','',10);
$pdf->multiCell(19,0.7,'Puji syukur senantiasa kita panjatkan kehadirat Allah SWT atas segala limpahan rahmat, karunia dan rizki-Nya yang berlimpah ruah. Sholawat serta salam semoga selalu tercurah kepada Rasulullah saw, beserta keluarganya, sahabat dan orang-orang yang senantiasa mengikuti jejak langkah beliau hingga akhir zaman.',0,'J');

if ($a['main_1'] <> ""){
    $pdf->ln(0.5);
    $pdf->multiCell(19,0.6, $a['main_1'] ,0,'J');
}

if ($a['main_2'] <> ""){
    $pdf->ln(0.5);
    $pdf->multiCell(19,0.6, $a['main_2'] ,0,'J');
}

if ($a['main_3'] <> ""){
    $pdf->ln(0.5);
    $pdf->multiCell(19,0.6, $a['main_3'] ,0,'J');
}

$pdf->ln(0.5);
$pdf->SetFont('Arial','',10);
$pdf->multiCell(19,0.6,'Atas perhatiannya kami ucapkan Jazakumullah khoiron katsiron.' ,0,'J');

$pdf->ln(0.5);
$pdf->SetFont('Arial','I',10);
$pdf->Cell(3,0.6,'Wassalaamu\'alaikum warohmatullaahi wabarokaatuh',0,1,'L');

$pdf->ln(1);
$pdf->SetFont('Arial','',10);
$pdf->Cell(9.5, 0.6, '', 0, 0, 'C');
$timestamp= time();
$pdf->Cell(9.5, 0.6,"Tasikmalaya, ". indonesian_date($timestamp, 'd F Y', ''), 0, 1, 'C');

if ($a['sign_2'] <> ""){
    $pdf->Cell(9.5, 0.6, $a['sign_2'], 0, 0, 'C');  
}else{
    $pdf->Cell(9.5, 0.6, '', 0, 0, 'C');
}
$pdf->Cell(9.5, 0.6, $a['sign_1'], 0, 1, 'C');

$pdf->ln(1.25);
$pdf->SetFont('Arial','B',10);
if ($a['sign_2'] <> ""){
    $pdf->Cell(9.5, 0.6, $a['name_2'] , 0, 0, 'C');
}else{
    $pdf->Cell(9.5, 0.6, '' , 0, 0, 'C');
}
$pdf->Cell(9.5, 0.6, $a['name_1'] , 0, 1, 'C');

$pdf->SetFont('Arial','',10);
if ($a['sign_3'] <> "" && $a['sign_4'] <> ""){
    $pdf->Cell(19, 0.6,"Mengetahui", 0, 1, 'C');
    $pdf->Cell(9.5, 0.6, $a['sign_4'], 0, 0, 'C'); 
    $pdf->Cell(9.5, 0.6, $a['sign_3'], 0, 1, 'C'); 
    $pdf->ln(1.25);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(9.5, 0.6, $a['name_4'], 0, 0, 'C');
    $pdf->Cell(9.5, 0.6, $a['name_3'], 0, 1, 'C');
}elseif ($a['sign_3'] <> ""){
    $pdf->Cell(19, 0.6,"Mengetahui", 0, 1, 'C');
    $pdf->Cell(19, 0.6, $a['sign_3'], 0, 1, 'C'); 
    $pdf->ln(1.25);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(19, 0.6, $a['name_3'], 0, 1, 'C');
}elseif ($a['sign_4'] <> ""){
    $pdf->Cell(19, 0.6,"Mengetahui", 0, 1, 'C');
    $pdf->Cell(19, 0.6, $a['sign_4'], 0, 1, 'C'); 
    $pdf->ln(1.25);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(19, 0.6, $a['name_4'], 0, 1, 'C');
}

if($a['note'] <> ""){
$pdf->ln(1.25);
$pdf->SetFont('Arial','I',8);
$pdf->Cell(19, 0.4, 'Catatan : ', 0, 1, 'L');
$pdf->Cell(0.25, 0.4, '', 0, 0, 'C');
$pdf->multiCell(10, 0.4, $a['note'], 0, 'L');
}

$pdf->Output($a['no'] . ".pdf","I");
}

function indonesian_date ($timestamp = '', $date_format = 'l, j F Y | H:i', $suffix = 'WIB') {
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
    $replace = array ( 'Sen','Sel','Rab','Kam','Jum','Sab','Min',
        'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu',
        'Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des',
        'Januari','Februari','Maret','April','Juni','Juli','Agustus','Sepember',
        'Oktober','November','Desember',
    );
    $date = date ($date_format, $timestamp);
    $date = preg_replace ($pattern, $replace, $date);
    $date = "{$date} {$suffix}";
    return $date;
}  
?>

