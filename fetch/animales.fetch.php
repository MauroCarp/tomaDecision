<?php

require_once "../controladores/animales.controlador.php";
require_once "../modelos/animales.modelo.php";

require_once "../controladores/perfiles.controlador.php";
require_once "../modelos/perfiles.modelo.php";


class FetchAnimales{
	
    public $idPerfil;

    public function fetchNuevoAnimal($data){

		$respuesta = ControladorAnimales::ctrNuevoAnimal($data);

        echo json_encode($respuesta);
      
    }
	
    public function fetchActualizarClasificacion(){
        
        $item = 'id';
        
        $valor = $this->idPerfil;

		$respuesta = ControladorPerfiles::ctrMostrarPerfiles($item,$valor);

        $flacas = $respuesta['flacas'];
        $buenas = $respuesta['buenas'];
        $buenasMas = $respuesta['buenasMas'];
        $muyBuenas = $respuesta['muyBuenas'];
        $apenasGordas = $respuesta['apenasGordas'];

        // TOTAL FLACAS
        
        $item = 'tas3';
        
        $valor = $flacas;
        
        $clas = 'flacas';

        $cantFlacas = ControladorAnimales::ctrContarAnimalesClasificacion($item,$valor,null,$clas);

        $data['flacas'] = $cantFlacas['total'];

        // TOTAL BUENAS
                
        $valor = $buenas;
        
        $valor2 = $flacas;

        $clas = 'buenas';

        $cantBuenas = ControladorAnimales::ctrContarAnimalesClasificacion($item,$valor,$valor2,$clas);

        $data['buenas'] = $cantBuenas['total'];

        // TOTAL BUENAS+
        
        $valor = $buenasMas;
        
        $valor2 = $buenas;

        $clas = 'buenasMas';

        $cantBuenasMas = ControladorAnimales::ctrContarAnimalesClasificacion($item,$valor,$valor2,$clas);

        $data['buenasMas'] = $cantBuenasMas['total'];

        // TOTAL MUY BUENAS
        
        $valor = $muyBuenas;
        
        $valor2 = $buenasMas;

        $clas = 'muyBuenas';

        $cantMuyBuenas = ControladorAnimales::ctrContarAnimalesClasificacion($item,$valor,$valor2,$clas);

        $data['muyBuenas'] = $cantMuyBuenas['total'];

        // TOTAL AP
        
        $valor = $apenasGordas;
        
        $valor2 = $muyBuenas;

        $clas = 'apenasGordas';

        $cantApenasGordas = ControladorAnimales::ctrContarAnimalesClasificacion($item,$valor,$valor2,$clas);
        
        $data['apenasGordas'] = $cantApenasGordas['total'];

        // TOTAL GORDAS

        $clas = 'gordas';

        $cantGordas = ControladorAnimales::ctrContarAnimalesClasificacion($item,$valor,null,$clas);
        
        $data['gordas'] = $cantGordas['total'];

        
        // TOTAL ANIMALES
        $data['total'] = $data['flacas'] + $data['buenas'] + $data['buenasMas'] + $data['muyBuenas'] + $data['apenasGordas'] + $data['gordas'];
        
        echo json_encode($data);
      
    }

}

if(isset($_POST["accion"])){
    
    $accion = $_POST["accion"];

	if($accion == 'nuevo'){

        $nuevoAnimal = new FetchAnimales();
		$nuevoAnimal -> fetchNuevoAnimal($_POST);

    }

    if($accion == 'actualizarClasificacion'){

        $actualizarClasif = new FetchAnimales();
		$actualizarClasif -> idPerfil = $_POST['idPerfil'];
		$actualizarClasif -> fetchActualizarClasificacion();

    }

}