<?php

require_once "conexion.php";

class ModeloPerfiles{

	/*=============================================
	NUEVO PERFIL
	=============================================*/

    static public function mdlNuevoPerfil($tabla,$datos){
        
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre,flacas,buenas,buenasMas,muyBuenas,apenasGordas,fecha) VALUES(:nombre,:flacas,:buenas,:buenasMas,:muyBuenas,:apenasGordas, CURRENT_DATE)");

		$flacas = ($datos['flacas']);
		$buenas = ($datos['buenas']);
		$buenasMas = ($datos['buenasMas']);
		$muyBuenas = ($datos['muyBuenas']);
		$apenasGordas = ($datos['apenasGordas']);
        
		$stmt -> bindParam(":nombre", $datos['nombre'], PDO::PARAM_STR);
        $stmt -> bindParam(":flacas", $flacas, PDO::PARAM_STR);
        $stmt -> bindParam(":buenas",  $buenas, PDO::PARAM_STR);
        $stmt -> bindParam(":buenasMas",  $buenasMas, PDO::PARAM_STR);
        $stmt -> bindParam(":muyBuenas",  $muyBuenas, PDO::PARAM_STR);
        $stmt -> bindParam(":apenasGordas",  $apenasGordas, PDO::PARAM_STR);

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

        $stmt = Conexion::conectar()->prepare("SELECT (flacas + :flacas) as flacas,(buenas + :buenas) as buenas,(buenasMas + :buenasMas) as buenasMas ,(muyBuenas + :muyBuenas) as muyBuenas,(apenasGordas + :apenasGordas) as apenasGordas, id, nombre, activo, fecha  FROM $tabla WHERE $item = :$item ORDER BY activo DESC, fecha DESC");
        
		$stmt -> bindValue(":flacas", 230);
        $stmt -> bindValue(":buenas", 200);
        $stmt -> bindValue(":buenasMas", 175);
        $stmt -> bindValue(":muyBuenas", 125);
        $stmt -> bindValue(":apenasGordas", 110);
        $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
          
        $stmt -> execute();
  
        return $stmt -> fetch();
        
      }else{
        
        $stmt = Conexion::conectar()->prepare("SELECT (flacas + :flacas) as flacas,(buenas + :buenas) as buenas,(buenasMas + :buenasMas) as buenasMas ,(muyBuenas + :muyBuenas) as muyBuenas,(apenasGordas + :apenasGordas) as apenasGordas, id, nombre, activo, fecha FROM $tabla ORDER BY activo DESC,fecha DESC");

		$stmt -> bindValue(":flacas", 230);
        $stmt -> bindValue(":buenas", 200);
        $stmt -> bindValue(":buenasMas", 175);
        $stmt -> bindValue(":muyBuenas", 125);
        $stmt -> bindValue(":apenasGordas", 110);
          
        $stmt -> execute();
		
        return $stmt -> fetchAll();
      
      }
      

      $stmt -> close();

      $stmt = null;

  }

  /*=============================================
	MOSTRAR PERFILES NEUTROS
	=============================================*/

	static public function mdlMostrarPerfilesNeutros($tabla,$item,$valor){

      if($item != null){

        $stmt = Conexion::conectar()->prepare("SELECT flacas,buenas,buenasMas ,muyBuenas,apenasGordas, id, nombre, activo, fecha  FROM $tabla WHERE $item = :$item ORDER BY activo DESC, fecha DESC");
        
        $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
          
        $stmt -> execute();
  
        return $stmt -> fetch();
        
      }else{
        
        $stmt = Conexion::conectar()->prepare("SELECT flacas,buenas,buenasMas ,muyBuenas,apenasGordas, id, nombre, activo, fecha FROM $tabla ORDER BY activo DESC,fecha DESC");
          
        $stmt -> execute();
		
        return $stmt -> fetchAll();
      
      }
      

      $stmt -> close();

      $stmt = null;

  }

  
	/*=============================================
	EDITAR PERFIL
	=============================================*/

	static public function mdlEditarPerfil($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET 
		flacas = :flacas,
		buenas = :buenas,
		buenasMas = :buenasMas,
		muyBuenas = :muyBuenas,
		apenasGordas = :apenasGordas,
		fecha = CURDATE()
		WHERE id = :id");

		$stmt -> bindParam(":flacas", $datos["flacas"], PDO::PARAM_STR);
		$stmt -> bindParam(":buenas", $datos["buenas"], PDO::PARAM_STR);
		$stmt -> bindParam(":buenasMas", $datos["buenasMas"], PDO::PARAM_STR);
		$stmt -> bindParam(":muyBuenas", $datos["muyBuenas"], PDO::PARAM_STR);
		$stmt -> bindParam(":apenasGordas", $datos["apenasGordas"], PDO::PARAM_STR);
		$stmt -> bindParam(":id", $datos["idPerfil"], PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

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
			
			return $stmt->errorInfo();

			return "error";	

		}

		$stmt -> close();

		$stmt = null;


	}

  /*=============================================
	CAMBIAR ESTADO PERFIL
	=============================================*/

	static public function mdlActivarDesactivarPerfil($tabla, $item,$valor){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET 
		activo = !activo
		WHERE $item = :$item");

		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

}