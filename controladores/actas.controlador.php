<?php

class ControladorActas{
    

    /*=============================================
    VALIDAR ACTA
	=============================================*/

	static public function ctrValidarActa($item,$valor,$item2,$valor2){
    
        $tabla = "actas";

        $respuesta = ModeloActas::mdlValidarActa($tabla, $item, $valor,$item2,$valor2);

		return $respuesta;
    
    }


}

