<?php
date_default_timezone_set('America/Argentina/Buenos_Aires');

require_once "controladores/plantilla.controlador.php";
require_once "controladores/usuarios.controlador.php";
require_once "controladores/animales.controlador.php";
require_once "controladores/perfiles.controlador.php";
require_once "controladores/carpetas.controlador.php";

require_once "modelos/usuarios.modelo.php";
require_once "modelos/animales.modelo.php";
require_once "modelos/perfiles.modelo.php";
require_once "modelos/carpetas.modelo.php";
require_once "extensiones/vendor/autoload.php";

$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();