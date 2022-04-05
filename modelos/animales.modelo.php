<?php

require_once "conexion.php";

class ModeloAnimales{

	/*=============================================
	CARGAR EXISTENCIA
	=============================================*/

	static public function mdlNuevoAnimal($tabla,$datos){
    
    $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(RFID,mmGrasa,peso,sexo,tas1,tas2,tas3,ecoRef,date) VALUES(:rfid, :mmGrasa, :peso, :sexo, :tas1, :tas2, :tas3, :ecoRef,CURRENT_DATE)");

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

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY date DESC");
        
        $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
          
        $stmt -> execute();
  
        return $stmt -> fetchAll();
        
      }else{
        
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY date DESC");
          
        $stmt -> execute();
  
        return $stmt -> fetchAll();
      
      }
      

      $stmt -> close();

      $stmt = null;

  }

	/*=============================================
	MOSTRAR ANIMALES BETWEEN
	=============================================*/

	static public function mdlMostrarAnimalesBetween($tabla,$item,$valor,$valor2){

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item BETWEEN :valor AND :valor2 ORDER BY idAnimal DESC");
        
        $stmt -> bindParam(":valor", $valor, PDO::PARAM_STR);
        $stmt -> bindParam(":valor2", $valor2, PDO::PARAM_STR);
          
        $stmt -> execute();

        return $stmt -> fetchAll();
        
      $stmt -> close();

      $stmt = null;

  }

  
	/*=============================================
	CONTAR ANIMALES SEGUN CLASF
	=============================================*/

	static public function mdlContarAnimalesClasificacion($tabla,$item,$valor,$valor2,$clas){


    $operador = '>=';

    if($clas == 'gordas'){
      
      $operador = '<';

    }
    
    
    if($clas == 'gordas' OR $clas == 'flacas'){
      
      $stmt = Conexion::conectar()->prepare("SELECT COUNT(*) as total FROM $tabla WHERE $item $operador :$item");
      
    }else{
      $stmt = Conexion::conectar()->prepare("SELECT COUNT(*) as total FROM $tabla WHERE $item $operador :$item AND $item < :valor2");
      $stmt -> bindParam(":valor2", $valor2, PDO::PARAM_STR);
      
    }
    
    $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
      
    $stmt -> execute();

    // return $stmt;
    return $stmt -> fetch();

    $stmt -> close();

    $stmt = null;

  }


	/*=============================================
	CONTAR ANIMALES
	=============================================*/

	static public function mdlContarAnimales($tabla,$item,$valor,$valor2){

      if($item != null){

        $stmt = Conexion::conectar()->prepare("SELECT COUNT(*) as total FROM $tabla WHERE $item = :$item");
        
        if($valor2 != null){
          
          $stmt = Conexion::conectar()->prepare("SELECT COUNT(*) as total FROM $tabla WHERE $item = :$item");

          $stmt -> bindParam(":".$item, $valor2, PDO::PARAM_STR);

        }
        $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
          
        $stmt -> execute();
  
        return $stmt -> fetch();
        
      }else{
        
        $stmt = Conexion::conectar()->prepare("SELECT COUNT(*) FROM $tabla ORDER BY date");
          
        $stmt -> execute();
  
        return $stmt -> fetch();
      
      }
      

      $stmt -> close();

      $stmt = null;

  }

  /*=============================================
	EDITAR ANIMAL
	=============================================*/

	static public function mdlEditarAnimal($tabla,$item,$valor,$datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET clasificacion = :clasificacion, idCarpeta = :idCarpeta WHERE $item = :$item");

		$stmt -> bindParam(":clasificacion", $datos["clasificacion"], PDO::PARAM_STR);
		$stmt -> bindParam(":idCarpeta", $datos["idCarpeta"], PDO::PARAM_STR);
		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

      return $stmt->errorInfo();
			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

  	/*=============================================
	MOSTRAR ULTIMO REGISTRO
	=============================================*/

	static public function mdlMostrarUltimoReg($tabla){

      $stmt = Conexion::conectar()->prepare("SELECT MAX(idAnimal) FROM $tabla");
              
      $stmt -> execute();

      return $stmt -> fetch();
      
    $stmt -> close();

    $stmt = null;

}

  /*=============================================
	ELIMINAR ANIMAL
	=============================================*/

	static public function mdlEliminarAnimal($tabla, $item, $valor){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE $item = :$item");

		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;


	}




}