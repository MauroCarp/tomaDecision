<?php

require_once "controladores/plantilla.controlador.php";
require_once "controladores/usuarios.controlador.php";
require_once "controladores/productos.controlador.php";
require_once "controladores/clientes.controlador.php";
require_once "controladores/ventas.controlador.php";
require_once "controladores/productores.controlador.php";
require_once "controladores/veterinarios.controlador.php";
require_once "controladores/brutur.controlador.php";
require_once "controladores/brucelosis.controlador.php";
require_once "controladores/tuberculosis.controlador.php";
require_once "controladores/notificados.controlador.php";
require_once "controladores/aftosa.controlador.php";

require_once "modelos/usuarios.modelo.php";
require_once "modelos/productos.modelo.php";
require_once "modelos/clientes.modelo.php";
require_once "modelos/ventas.modelo.php";
require_once "modelos/productores.modelo.php";
require_once "modelos/veterinarios.modelo.php";
require_once "modelos/brutur.modelo.php";
require_once "modelos/brucelosis.modelo.php";
require_once "modelos/tuberculosis.modelo.php";
require_once "modelos/notificados.modelo.php";
require_once "modelos/aftosa.modelo.php";
require_once "extensiones/vendor/autoload.php";

$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();