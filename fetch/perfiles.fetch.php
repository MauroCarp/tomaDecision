<?php

require_once "../controladores/perfiles.controlador.php";
require_once "../modelos/perfiles.modelo.php";


class FetchPerfiles{
	
    public $idPerfil;

    public function fetchMostrarPerfil(){

        $item = 'id';
        
        $valor = $this->idPerfil;

		$respuesta = ControladorPerfiles::ctrMostrarPerfiles($item,$valor);

        echo json_encode($respuesta);
      
    }

}

if(isset($_POST["accion"])){
    
    $accion = $_POST["accion"];

	if($accion == 'mostrarPerfil'){

        $mostrarPerfil = new FetchPerfiles();
        $mostrarPerfil->idPerfil = $_POST['idPerfil'];
		$mostrarPerfil -> fetchMostrarPerfil();

    }

}