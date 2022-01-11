<?php
require_once "../controladores/actas.controlador.php";
require_once "../modelos/actas.modelo.php";


class AjaxActas{
	
    public $renspa;
    
    public $campania;

    public function ajaxValidarActa(){

        $renspa = $this->renspa;

        $campania = $this->campania;

        $item = 'renspa';
        $item2 = 'campania';

		$respuesta = ControladorActas::ctrValidarActa($item,$renspa,$item2,$campania);

        echo json_encode($respuesta);
      
    }

}




if(isset($_POST["accion"])){
    
    $accion = $_POST["accion"];

	if($accion == 'validarActa'){

		$validarActa = new AjaxActas();
        $validarActa-> campania = $_POST['campania'];
        $validarActa-> renspa = $_POST['renspa'];
		$validarActa -> ajaxValidarActa();

    }

}