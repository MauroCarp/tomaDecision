<?php
// Script de prueba para validar carga via Composer de FPDF
// Ejecutar: http://tu-dominio/extensiones/fpdf/test_generacion.php

// Forzamos autoload Composer primero
$autoload = __DIR__ . '/../../vendor/autoload.php';
if(file_exists($autoload)) {
    require_once $autoload;
}

if(!class_exists('FPDF')) {
    // Fallback local
    require_once __DIR__ . '/fpdf.php';
}

// Variables mínimas para reutilizar la cabecera si se desea
$cabezera = 'Informe de Carpeta (Prueba)';
$perfil = 'Perfil: Test';
$destino = 'Destino: Test';
$fecha = 'Fecha: '.date('d-m-Y');

// Crear PDF
$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();
$pdf->SetFont('helvetica','B',14);
$pdf->Cell(0,10,'Validación librería FPDF via Composer',0,1,'L');
$pdf->SetFont('helvetica','',11);
$pdf->MultiCell(0,7,"Estado de carga: " . (class_exists('FPDF') ? 'OK' : 'NO'));
$pdf->MultiCell(0,7,'Version PHP: '.PHP_VERSION);
$pdf->MultiCell(0,7,'Generado: '.date('c'));
$pdf->Ln(5);
$pdf->SetFont('helvetica','',10);
$pdf->MultiCell(0,6,'Si ves este PDF, la integración Composer/Fallback funciona correctamente.');

$pdf->Output('I','prueba_fpdf.pdf');
