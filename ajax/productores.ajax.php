<?php

require_once "../controladores/productores.controlador.php";
require_once "../modelos/productores.modelo.php";

class AjaxProductores{


	public $idProductor;
	public $renspa;

	public function ajaxEditarProductor(){

		$item = "productor_id";
		$valor = $this->idProductor;

		$respuesta = ControladorProductores::ctrMostrarProductores($item, $valor);

		echo json_encode($respuesta);


	}

	public function ajaxProductorExistente(){

		$item = "renspa";
		$valor = $this->renspa;

		$respuesta = ControladorProductores::ctrMostrarProductores($item, $valor);

		echo json_encode($respuesta);


	}

}

/*=============================================
PRODUCTOR EXISTENTE
=============================================*/	

if(isset($_POST["renspa"])){

	$productorExistente = new AjaxProductores();
	$productorExistente -> renspa = $_POST["renspa"];
	$productorExistente -> ajaxProductorExistente();

}

/*=============================================
EDITAR PRODUCTOR
=============================================*/	

if(isset($_POST["idProductor"])){

	$productor = new AjaxProductores();
	$productor -> idProductor = $_POST["idProductor"];
	$productor -> ajaxEditarProductor();

}