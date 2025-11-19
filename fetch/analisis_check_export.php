<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../controladores/analisis.controlador.php';
require_once __DIR__ . '/../modelos/analisis.modelo.php';

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Analisis Check');

// Cabeceras una sola vez (mismo formato que analisis_export)
$columns = ['paso por balanza','peso','mm grasa','gdp','gdg'];

// Solo animales checkeados (igual que en la vista analisisCheck)
$animales = ControladorAnalisis::ctrMostrarAnimales('checked', 1);

// Agrupar por RFID
$groups = [];
foreach ($animales as $row) {
    $rfid = $row['RFID'] ?? '';
    if ($rfid === '') { continue; }
    $groups[$rfid][] = $row;
}

$rowIdx = 1;
$defaultBorder = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_THIN,
            'color' => ['argb' => 'FFDDDDDD']
        ]
    ]
];

// Escribir cabeceras
$colLetter = 'A';
foreach ($columns as $title) {
    $sheet->setCellValue($colLetter . $rowIdx, $title);
    $colLetter++;
}
$sheet->getStyle("A{$rowIdx}:E{$rowIdx}")->getFont()->setBold(true);
$sheet->getStyle("A{$rowIdx}:E{$rowIdx}")->getFill()->setFillType(Fill::FILL_SOLID)
      ->getStartColor()->setARGB('FFEFEFEF');
$sheet->getStyle("A{$rowIdx}:E{$rowIdx}")->applyFromArray($defaultBorder);
$rowIdx++;

$firstGroup = true;
foreach ($groups as $rfid => $rows) {
    if (!$firstGroup) {
        $rowIdx++; // línea en blanco entre grupos
    }
    $firstGroup = false;

    // Fila RFID resaltada
    $sheet->setCellValue("A{$rowIdx}", "RFID - {$rfid}");
    $sheet->mergeCells("A{$rowIdx}:E{$rowIdx}");
    $sheet->getStyle("A{$rowIdx}")->getFont()->setBold(true);
    $sheet->getStyle("A{$rowIdx}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
    $sheet->getStyle("A{$rowIdx}:E{$rowIdx}")->getFill()->setFillType(Fill::FILL_SOLID)
          ->getStartColor()->setARGB('FFFFF2CC');
    $sheet->getStyle("A{$rowIdx}:E{$rowIdx}")->applyFromArray($defaultBorder);

    // Preparar GDP/GDG a partir de pares consecutivos
    $n = count($rows);
    $gdp = array_fill(0, $n, '');
    $gdg = array_fill(0, $n, '');

    for ($j = 1; $j < $n; $j++) {
        $prev = $rows[$j-1];
        $curr = $rows[$j];
        $fechaPrev = new DateTime($prev['date']);
        $fechaCurr = new DateTime($curr['date']);
        $diffDays = (int)$fechaPrev->diff($fechaCurr)->format('%a');
        if ($diffDays > 0) {
            $pesoPrev = (float)$prev['peso'];
            $pesoCurr = (float)$curr['peso'];
            $grasaPrev = (float)$prev['mmGrasa'];
            $grasaCurr = (float)$curr['mmGrasa'];
            $gdp[$j-1] = round(($pesoPrev - $pesoCurr) / $diffDays, 2);
            $gdg[$j-1] = round(($grasaPrev - $grasaCurr) / $diffDays, 2);
        } else {
            $gdp[$j-1] = 0;
            $gdg[$j-1] = 0;
        }
    }

    // Filas de datos
    for ($k = 0; $k < $n; $k++) {
        $rowIdx++;
        $r = $rows[$k];
        $fecha = DateTime::createFromFormat('Y-m-d H:i:s', $r['date']);
        if (!$fecha) {
            $fecha = new DateTime($r['date']);
        }
        $fechaStr = $fecha->format('d-m-Y');

        $sheet->setCellValue("A{$rowIdx}", $fechaStr);
        $sheet->setCellValue("B{$rowIdx}", (float)$r['peso']);
        $sheet->setCellValue("C{$rowIdx}", (float)$r['mmGrasa']);
        $sheet->setCellValue("D{$rowIdx}", $gdp[$k] === '' ? null : $gdp[$k]);
        $sheet->setCellValue("E{$rowIdx}", $gdg[$k] === '' ? null : $gdg[$k]);
        $sheet->getStyle("A{$rowIdx}:E{$rowIdx}")->applyFromArray($defaultBorder);
    }
}

// Auto-size
foreach (range('A','E') as $col) {
    $sheet->getColumnDimension($col)->setAutoSize(true);
}

// Descargar
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="analisis_check.xlsx"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
