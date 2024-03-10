<?php

require_once "../controladores/analisis.controlador.php";
require_once "../modelos/analisis.modelo.php";

class FetchAnalisis{
	
    public function fetchMostrarAnimales(){

        $animales = ControladorAnalisis::ctrMostrarAnimales();

        echo json_encode($animales);
            
    }

}

$mostrarAnimales = new FetchAnalisis();
$mostrarAnimales -> fetchMostrarAnimales();