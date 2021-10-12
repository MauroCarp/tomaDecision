<?php

require_once "../controladores/productores.controlador.php";
require_once "../modelos/productores.modelo.php";

class AjaxProductores{

	/*=============================================
	EDITAR CLIENTE
	=============================================*/	

	public $idProductor;

	public function ajaxEditarProductor(){

		$item = "productor_id";
		$valor = $this->idProductor;

		$respuesta = ControladorProductores::ctrMostrarProductores($item, $valor);

		echo json_encode($respuesta);


	}

}

/*=============================================
EDITAR CLIENTE
=============================================*/	

if(isset($_POST["idProductor"])){

	$productor = new AjaxProductores();
	$productor -> idProductor = $_POST["idProductor"];
	$productor -> ajaxEditarProductor();

}