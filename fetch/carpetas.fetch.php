<?php

require_once "../controladores/carpetas.controlador.php";
require_once "../modelos/carpetas.modelo.php";


class FetchCarpetas{
	
    public function fetchMostrarCarpetas(){

        $item = 'activa';
        
        $valor = 1;

		$respuesta = ControladorCarpetas::ctrMostrarCarpetas($item,$valor);

        echo json_encode($respuesta);
      
    }

}

if(isset($_POST["accion"])){
    
    $accion = $_POST["accion"];

	if($accion == 'mostrarActivas'){

        $mostrarCarpetasActivas = new FetchCarpetas();
		$mostrarCarpetasActivas -> fetchMostrarCarpetas();

    }

}