<?php

class ControladorLogin{

    /*=============================================
    CARGAR ARCHIVO
    =============================================*/

    static public function ctrVerLogin($valor){

        $tabla = 'login';

        $item = 'codigo';

        return $respuesta = ModeloLogin::mdlVerLogin($tabla,$item,$valor);
        
    }

}