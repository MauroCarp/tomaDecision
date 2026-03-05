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
$sheet->setTitle('Analisis');

// Column titles for data rows
$columns = ['Paso por balanza','Peso','mm Grasa','Sexo','GDP','GDG'];

// Fetch all animals (unchecked by default)
$animales = ControladorAnalisis::ctrMostrarAnimales();

// Group by RFID preserving order by date DESC
$groups = [];
foreach ($animales as $row) {
    $rfid = $row['RFID'];
    if (!isset($groups[$rfid])) {
        $groups[$rfid] = [];
    }
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

// Write headers once at the top
$colLetter = 'A';
foreach ($columns as $title) {
    $sheet->setCellValue($colLetter . $rowIdx, $title);
    $colLetter++;
}
$sheet->getStyle("A{$rowIdx}:F{$rowIdx}")->getFont()->setBold(true);
$sheet->getStyle("A{$rowIdx}:F{$rowIdx}")->getFill()->setFillType(Fill::FILL_SOLID)
      ->getStartColor()->setARGB('FFEFEFEF');
$sheet->getStyle("A{$rowIdx}:F{$rowIdx}")->applyFromArray($defaultBorder);

$rowIdx++;

// Iterate groups, add a colored RFID row per group
$firstGroup = true;
foreach ($groups as $rfid => $rows) {
    if (!$firstGroup) {
        $rowIdx++; // blank row between groups
    }
    $firstGroup = false;

    // RFID separator row
    $sheet->setCellValue("A{$rowIdx}", "RFID - {$rfid}");
    $sheet->mergeCells("A{$rowIdx}:F{$rowIdx}");
    $sheet->getStyle("A{$rowIdx}")->getFont()->setBold(true);
    $sheet->getStyle("A{$rowIdx}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
    // Highlight RFID row
    $sheet->getStyle("A{$rowIdx}:F{$rowIdx}")->getFill()->setFillType(Fill::FILL_SOLID)
          ->getStartColor()->setARGB('FFFFF2CC');
    $sheet->getStyle("A{$rowIdx}:F{$rowIdx}")->applyFromArray($defaultBorder);

    // Prepare GDP/GDG aligned with the previous row (like UI)
    $n = count($rows);
    $gdp = array_fill(0, $n, '');
    $gdg = array_fill(0, $n, '');

    for ($j = 1; $j < $n; $j++) {
        $prev = $rows[$j-1]; // later date (DESC order)
        $curr = $rows[$j];   // earlier date
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

    // Data rows
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
        $sheet->setCellValue("D{$rowIdx}", (string)$r['sexo']);
        $sheet->setCellValue("E{$rowIdx}", $gdp[$k] === '' ? null : $gdp[$k]);
        $sheet->setCellValue("F{$rowIdx}", $gdg[$k] === '' ? null : $gdg[$k]);

        $sheet->getStyle("A{$rowIdx}:F{$rowIdx}")->applyFromArray($defaultBorder);
    }
}

// Autosize columns
foreach (range('A','F') as $col) {
    $sheet->getColumnDimension($col)->setAutoSize(true);
}

// Output as download
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="analisis.xlsx"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
