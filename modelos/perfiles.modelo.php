<?php

require_once "conexion.php";

class ModeloPerfiles{

	/*=============================================
	NUEVO PERFIL
	=============================================*/

    static public function mdlNuevoPerfil($tabla,$datos){
        
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre,flacas,buenas,buenasMas,muyBuenas,apenasGordas) VALUES(:nombre,:flacas,:buenas,:buenasMas,:muyBuenas,:apenasGordas)");

        $stmt -> bindParam(":nombre", $datos['nombre'], PDO::PARAM_STR);
        $stmt -> bindParam(":flacas", $datos['flacas'], PDO::PARAM_STR);
        $stmt -> bindParam(":buenas", $datos['buenas'], PDO::PARAM_STR);
        $stmt -> bindParam(":buenasMas", $datos['buenasMas'], PDO::PARAM_STR);
        $stmt -> bindParam(":muyBuenas", $datos['muyBuenas'], PDO::PARAM_STR);
        $stmt -> bindParam(":apenasGordas", $datos['apenasGordas'], PDO::PARAM_STR);

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
	MOSTRAR PERFILES
	=============================================*/

	static public function mdlMostrarPerfiles($tabla,$item,$valor){

      if($item != null){

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY fecha");
        
        $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
          
        $stmt -> execute();
  
        return $stmt -> fetch();
        
      }else{
        
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY fecha");
          
        $stmt -> execute();
  
        return $stmt -> fetchAll();
      
      }
      

      $stmt -> close();

      $stmt = null;

  }


  /*=============================================
	ELIMINAR PERFIL
	=============================================*/

	static public function mdlEliminarPerfil($tabla, $item, $valor){

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