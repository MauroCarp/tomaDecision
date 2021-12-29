<?php

class ControladorAnimales{
    

    /*=============================================
    VALIDAR ACTA
	=============================================*/

	static public function ctrMostrarAnimales($item,$valor,$item2,$valor2){
    
        $tabla = "animales";

        $respuesta = ModeloAnimales::mdlMostrarAnimales($tabla, $item, $valor,$item2,$valor2);

		return $respuesta;
    
    }


}

