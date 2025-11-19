<?php
// Intentar cargar FPDF desde Composer si está disponible
if(!class_exists('FPDF')){
	$autoloadPath = __DIR__ . '/../../vendor/autoload.php';
	if(file_exists($autoloadPath)){
		require_once $autoloadPath;
	}
}
// Fallback a librería incluida local si Composer no está presente
if(!class_exists('FPDF')){
	require_once __DIR__ . '/fpdf.php';
}

$pdf = new FPDF('P','mm','A4');	
$pdf->AddPage();
$pdf->SetFillColor(0,0,0);
$pdf->SetTitle($cabezera);
$pdf->SetDisplayMode('fullpage', 'single');
$pdf->SetAutoPageBreak(1,1);
$pdf->Image('img/logo-negro-bloque.png', 140, 10,60 );
$pdf->SetFont('helvetica','B',14);
$pdf->Ln(4);
$pdf->MultiCell(130,9,mb_convert_encoding($cabezera,'ISO-8859-1','UTF-8'),0,'L');
$pdf->MultiCell(130,9,mb_convert_encoding($perfil,'ISO-8859-1','UTF-8'),0,'L');
$pdf->MultiCell(130,9,mb_convert_encoding($destino,'ISO-8859-1','UTF-8'),0,'L');
$pdf->Cell(130,8,$fecha,0,'L');
$pdf->Ln(8);
	
