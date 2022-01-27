<?php

require_once "../controladores/animales.controlador.php";
require_once "../modelos/animales.modelo.php";


class FetchAnimales{
	
    public function fetchNuevoAnimal($data){

		$respuesta = ControladorAnimales::ctrNuevoAnimal($data);

        echo json_encode($respuesta);
      
    }

}

if(isset($_POST["accion"])){
    
    $accion = $_POST["accion"];

	if($accion == 'nuevo'){

        $nuevoAnimal = new FetchAnimales();
		$nuevoAnimal -> fetchNuevoAnimal($_POST);

    }

}