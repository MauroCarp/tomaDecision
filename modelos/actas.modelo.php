<?php

require_once "conexion.php";

class ModeloActas{

	/*=============================================
	VALIDAR ACTA
	=============================================*/

	static public function mdlValidarActa($tabla,$item,$valor,$item2,$valor2){
    
			$stmt = Conexion::conectar()->prepare("SELECT COUNT(*) as valida FROM $tabla WHERE $item = :$item AND $item2 = :$item2");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();


    }

}