<?php

class ControladorAnimales{

	/*=============================================
	CREAR PRODUCTORES
	=============================================*/

	static public function ctrNuevoAnimal($data){

		$tabla = "animales";

		$datos = array("rfid"=>$_POST["rfid"],
						"mmGrasa"=>$_POST["mmGrasa"],
						"peso"=>$_POST["peso"],
						"sexo"=>$_POST["sexo"],
						"refEco"=>$_POST["refEco"]);

		$tas1 = ($datos['mmGrasa'] * 100) / $datos['peso'];

		$tas2 = $datos['peso'] / $tas1;

		$tas3 = ($datos['sexo'] == 'M') ? $tas2 : $tas2 - 12;

		$datos['tas1'] = $tas1;
		
		$datos['tas2'] = $tas2;
		
		$datos['tas3'] = $tas3;

		return 	$respuesta = ModeloAnimales::mdlNuevoAnimal($tabla, $datos);

	}

	/*=============================================
	MOSTRAR ANIMALES
	=============================================*/

	static public function ctrMostrarAnimales($item, $valor){

		$tabla = "animales";

		$respuesta = ModeloAnimales::mdlMostrarAnimales($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	CONTAR ANIMALES
	=============================================*/

	static public function ctrContarAnimales($item, $valor){

		$tabla = "animales";

		$respuesta = ModeloAnimales::mdlContarAnimales($tabla, $item, $valor);

		return $respuesta;

	}


	/*=============================================
	MOSTRAR ANIMALES SEGUN CLASF
	=============================================*/

	static public function ctrContarAnimalesClasificacion($item, $valor, $clas){

		$tabla = "animales";

		$respuesta = ModeloAnimales::mdlContarAnimalesClasificacion($tabla, $item, $valor, $clas);

		return $respuesta;

	}




}

