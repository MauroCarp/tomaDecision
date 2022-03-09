<?php

require_once "conexion.php";

class ModeloCarpetas{

	/*=============================================
	NUEVO CARPETA
	=============================================*/

    static public function mdlNuevaCarpeta($tabla,$datos){
        
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(destino,cantidad,pesoMin,pesoMax,clasificacion,prioridad) VALUES(:destino,:cantidad,:pesoMin,:pesoMax,:clasificacion,:prioridad)");

        $stmt -> bindParam(":destino", $datos['destino'], PDO::PARAM_STR);
        $stmt -> bindParam(":cantidad", $datos['cantidad'], PDO::PARAM_STR);
        $stmt -> bindParam(":pesoMin", $datos['pesoMin'], PDO::PARAM_STR);
        $stmt -> bindParam(":pesoMax", $datos['pesoMax'], PDO::PARAM_STR);
        $stmt -> bindParam(":clasificacion", $datos['clasificacion'], PDO::PARAM_STR);
        $stmt -> bindParam(":prioridad", $datos['prioridad'], PDO::PARAM_STR);

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
	MOSTRAR CARPETAS
	=============================================*/

	static public function mdlMostrarCarpetas($tabla,$item,$valor){

      if($item != null){

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY fecha");
        
        $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
          
        $stmt -> execute();
  
        return $stmt -> fetchAll();
        
      }else{
        
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY fecha");
          
        $stmt -> execute();
  
        return $stmt -> fetchAll();
      
      }
      

      $stmt -> close();

      $stmt = null;

    }

	/*=============================================
	PRIORIDAD CARPETAS
	=============================================*/

	static public function mdlPrioridadCarpetas($tabla,$orden){

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY $orden DESC LIMIT 1");
                  
        $stmt -> execute();
  
        return $stmt -> fetch();

      $stmt -> close();

      $stmt = null;

  }

  /*=============================================
	ELIMINAR CARPETA
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


  /*=============================================
	ELIMINAR CARPETA
	=============================================*/

	static public function mdlPriorizar($tabla, $prioridadSeleccionada){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET prioridad = prioridad + 1 WHERE prioridad >= :prioridad");

		$stmt -> bindParam(":prioridad", $prioridadSeleccionada, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;


	}





}