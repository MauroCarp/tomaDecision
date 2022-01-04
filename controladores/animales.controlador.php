<?php

class ControladorAnimales{
    

    /*=============================================
    MOSTRAR ANIMALES
	=============================================*/

	static public function ctrMostrarAnimales($item,$valor,$item2,$valor2){
    
        $tabla = "animales";

        $respuesta = ModeloAnimales::mdlMostrarAnimales($tabla, $item, $valor,$item2,$valor2);

		return $respuesta;
    
    }

    /*=============================================
    ACTUALIZAR EXISTENCIA
	=============================================*/

	static public function ctrCargarExistencia($datos){
    
        $tabla = "animales";

        $datos['campania'] = $_COOKIE['campania'];

        $respuesta = ModeloAnimales::mdlCargarExistencia($tabla, $datos);

		return $respuesta;
    
    }
    
    /*=============================================
    ACTUALIZAR EXISTENCIA
	=============================================*/

	static public function ctrActualizarExistencia($datos){
    
        $tabla = "animales";

        $respuesta = ModeloAnimales::mdlActualizarExistencia($tabla, $datos);

		return $respuesta;
    
    }


}

