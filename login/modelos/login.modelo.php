<?php

require_once "conexion.php";

class ModeloLogin{
    
    /*=============================================
    VER LOGIN
    =============================================*/

	static public function mdlVerLogin($tabla,$item,$codigo){
		
		$stmt = Conexion::conectar()->prepare("SELECT url FROM $tabla WHERE $item = :$item");
		
        $stmt -> bindParam(":".$item, $codigo, PDO::PARAM_STR);

		$stmt -> execute();
		
        return $stmt -> fetch();
		
		$stmt->close();
		
		$stmt = null;
	
	}

}
	