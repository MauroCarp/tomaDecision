<?php

require_once "conexion.php";

class ModeloAnimales{

	/*=============================================
	CARGAR EXISTENCIA
	=============================================*/

	static public function mdlNuevoAnimal($tabla,$datos){
    
    $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(RFID,mmGrasa,peso,sexo,tas1,tas2,tas3,ecoRef) VALUES(:rfid, :mmGrasa, :peso, :sexo, :tas1, :tas2, :tas3, :ecoRef)");

    $stmt -> bindParam(":rfid", $datos['rfid'], PDO::PARAM_STR);
    $stmt -> bindParam(":mmGrasa", $datos['mmGrasa'], PDO::PARAM_STR);
    $stmt -> bindParam(":peso", $datos['peso'], PDO::PARAM_STR);
    $stmt -> bindParam(":sexo", $datos['sexo'], PDO::PARAM_STR);
    $stmt -> bindParam(":tas1", $datos['tas1'], PDO::PARAM_STR);
    $stmt -> bindParam(":tas2", $datos['tas2'], PDO::PARAM_STR);
    $stmt -> bindParam(":tas3", $datos['tas3'], PDO::PARAM_STR);
    $stmt -> bindParam(":ecoRef", $datos['ecoRef'], PDO::PARAM_STR);

    if($stmt->execute()){

      return "ok";

    }else{

      return $stmt->errorInfo();
      return "error";
    
    }
    
    $stmt->close();
    $stmt = null;

}

	/*=============================================
	MOSTRAR ANIMALES
	=============================================*/

	static public function mdlMostrarAnimales($tabla,$item,$valor){

      if($item != null){

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY date");
        
        $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
          
        $stmt -> execute();
  
        return $stmt -> fetch();
        
      }else{
        
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY date");
          
        $stmt -> execute();
  
        return $stmt -> fetchAll();
      
      }
      

      $stmt -> close();

      $stmt = null;

  }




}