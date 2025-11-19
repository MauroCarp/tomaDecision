<?php

require_once "../controladores/login.controlador.php";
require_once "../modelos/login.modelo.php";

class AjaxLogin{

    /*=============================================
    INGRESO CODIGO
    =============================================*/
    public $codigo;

    public function ajaxLoginCodigo(){

        $valor = $this->codigo;

        $respuesta = ControladorLogin::ctrVerLogin($valor);

        echo json_encode($respuesta);

    }

}

if(isset($_POST['login'])){

    $loginCodigo = new AjaxLogin;
    $loginCodigo-> codigo = $_POST['login'];
    $loginCodigo-> ajaxLoginCodigo();

}