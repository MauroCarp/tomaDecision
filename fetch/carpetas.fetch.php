<?php

require_once "../controladores/carpetas.controlador.php";
require_once "../modelos/carpetas.modelo.php";


class FetchCarpetas{
	
    public function fetchMostrarCarpetas(){

        $item = 'activa';
        
        $valor = 1;

        $orden = 'fecha';

        $fecha1 = date('Y-m-d');

        $fecha2 = date('Y-m-d',strtotime($fecha1."+ 1 days"));
        
		$respuesta = ControladorCarpetas::ctrMostrarCarpetasBetween($item,$valor,$fecha1,$fecha2,$orden);

        echo json_encode($respuesta);
      
    }
	
    public function fetchNuevaCarpeta($data){
        
        $respuesta = ControladorCarpetas::ctrNuevaCarpeta($data);

        echo json_encode($respuesta);
      
    }

}

if(isset($_POST["accion"])){
    
    $accion = $_POST["accion"];

	if($accion == 'mostrarActivas'){

        $mostrarCarpetasActivas = new FetchCarpetas();
		$mostrarCarpetasActivas -> fetchMostrarCarpetas();

    }

	if($accion == 'nuevaCarpeta'){

        $nuevaCarpeta = new FetchCarpetas();
		$nuevaCarpeta -> fetchNuevaCarpeta($_POST);

    }

}