<?php

class ControladorAnalisis{


	/*=============================================
	MOSTRAR ANIMALES
	=============================================*/

	static public function ctrMostrarAnimales(){

		$tabla = "animales";

		$respuesta = ModeloAnalisis::mdlMostrarAnimales($tabla);

		return $respuesta;

	}

}