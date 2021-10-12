<?php
include("includes/conexion.php");
include("includes/arrays.php");
include("includes/functions.php");
include("lib/fpdf/fpdf.php");

$desde = $_GET['desde'];
$hasta = $_GET['hasta'];

	$pdf = new FPDF('P','mm','A4');	
	$pdf->AddPage();
	$pdf->SetFillColor(0,255,0);
	$pdf->SetTitle('Informe Entes Brucelosis');
	$pdf->SetDisplayMode('fullpage', 'single');
	$pdf->SetAutoPageBreak(1,1);
	$pdf->Image('img/logo.png', 15, 10,40);
	$pdf->SetFont('helvetica','B',16);
	$pdf->Ln(6);
	$pdf->SetX(60);
	$pdf->Cell(50,7,'Establecimientos SIN DATOS',0,0,'L',0);
	$pdf->Ln(25);
	$pdf->Cell(22);
	$pdf->SetFont('Times','B',12);
	$pdf->SetX(10);
	$pdf->Cell(8,7,utf8_decode('N°'),0,0,'L',0);
	$pdf->Cell(30,7,'Renspa',0,0,'L',0);
	$pdf->Cell(130,7,'Propietario',0,0,'L',0);
	$pdf->Cell(40,7,'Fecha de Status',0,1,'L',0);
	$pdf->SetFont('Times','',10);

	$sql = "SELECT * FROM establecimientos INNER JOIN brucelosis ON establecimientos.renspa = brucelosis.renspaBruce WHERE brucelosis.estado = 'S/D' AND fechaSD BETWEEN '$desde' AND '$hasta' ORDER BY fechaSD ASC";
	$query = mysqli_query($conexion, $sql);
	$contador = 1;
	while ($fila = mysqli_fetch_array($query)){

		$pdf->Cell(8,7,$contador,0,0,'L',0);
		$pdf->Cell(30,7,$fila['renspa'],0,0,'L',0);
		$pdf->Cell(130,7,$fila['propietario'],0,0,'L',0);
		$pdf->Cell(40,7,formatearFecha($fila['fechaSD']),0,1,'L',0);
		$contador++;
	}



	$pdf->Output();
?>