<?php

include '../../../controladores/brutur.controlador.php';
include '../../../modelos/brutur.modelo.php';


$descargarExcel = new ControladorBruTur();
$descargarExcel -> ctrGenerarExcelPendientes();


?>