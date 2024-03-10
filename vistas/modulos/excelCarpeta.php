<?php

include '../../controladores/carpetas.controlador.php';
include '../../modelos/carpetas.modelo.php';
include '../../controladores/animales.controlador.php';
include '../../modelos/animales.modelo.php';

$descargarExcel = new ControladorCarpetas();
$descargarExcel -> ctrGenerarExcelCarpeta();


?>