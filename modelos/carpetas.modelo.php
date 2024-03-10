<?php

require_once "conexion.php";

class ModeloCarpetas{

	/*=============================================
	NUEVO CARPETA
	=============================================*/

  static public function mdlNuevaCarpeta($tabla,$datos){
      
      $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(empresa,tipo,destino,descripcion,cantidad,sexo,pesoMin,pesoMax,clasificacion,minGrasa,maxGrasa,prioridad,fecha) VALUES(:empresa,:tipo,:destino,:descripcion,:cantidad,:sexo,:pesoMin,:pesoMax,:clasificacion,:minGrasa,:maxGrasa,:prioridad,:fecha)");

      $fechaCarpeta = ($datos['fechaCarpeta'] != '') ? $datos['fechaCarpeta'] : date('Y-m-d');
      
      $stmt -> bindParam(":empresa", $datos['empresa'], PDO::PARAM_STR);
      $stmt -> bindParam(":tipo", $datos['tipo'], PDO::PARAM_STR);
      $stmt -> bindParam(":destino", $datos['destino'], PDO::PARAM_STR);
      $stmt -> bindParam(":descripcion", $datos['descripcion'], PDO::PARAM_STR);
      $stmt -> bindParam(":cantidad", $datos['cantidad'], PDO::PARAM_STR);
      $stmt -> bindParam(":sexo", $datos['sexo'], PDO::PARAM_STR);
      $stmt -> bindParam(":pesoMin", $datos['pesoMin'], PDO::PARAM_STR);
      $stmt -> bindParam(":pesoMax", $datos['pesoMax'], PDO::PARAM_STR);
      $stmt -> bindParam(":clasificacion", $datos['clasificacion'], PDO::PARAM_STR);
      $stmt -> bindParam(":minGrasa", $datos['minGrasa'], PDO::PARAM_STR);
      $stmt -> bindParam(":maxGrasa", $datos['maxGrasa'], PDO::PARAM_STR);
      $stmt -> bindParam(":prioridad", $datos['prioridad'], PDO::PARAM_STR);
      $stmt -> bindParam(":fecha", $fechaCarpeta, PDO::PARAM_STR);
      
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
	NUEVA CARPETA SD
	=============================================*/

  static public function mdlNuevaCarpetaSD($tabla,$datos){
      
    $empresa = $_COOKIE['empresa'];

      $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(empresa,destino,descripcion,cantidad,clasificacion,prioridad,fecha) VALUES(:empresa,:destino,:descripcion,:cantidad,:clasificacion,999,CURRENT_DATE)");

      $stmt -> bindParam(":empresa", $empresa, PDO::PARAM_STR);
      $stmt -> bindParam(":destino", $datos['destino'], PDO::PARAM_STR);
      $stmt -> bindParam(":descripcion", $datos['descripcion'], PDO::PARAM_STR);
      $stmt -> bindParam(":cantidad", $datos['cantidad'], PDO::PARAM_STR);
      $stmt -> bindParam(":clasificacion", $datos['clasificacion'], PDO::PARAM_STR);
    
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

	static public function mdlMostrarCarpetas($tabla,$item,$valor,$orden,$ascDesc){

    $empresa = $_COOKIE['empresa'];

      if($item != null){

        if($valor == null){
          
          $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item IS NULL AND empresa = :empresa ORDER BY $orden $ascDesc");
          
        }else{
          
          $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND empresa = :empresa ORDER BY $orden $ascDesc");
          $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
        
        }
          
        $stmt -> bindParam(":empresa", $empresa, PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetchAll();
        
      }else{
        
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE empresa = :empresa ORDER BY $orden $ascDesc");
          
        $stmt -> bindParam(":empresa", $empresa, PDO::PARAM_STR);

        $stmt -> execute();
  
        return $stmt -> fetchAll();
      
      }
      

      $stmt -> close();

      $stmt = null;

  }

  /*=============================================
	MOSTRAR CARPETAS NO DEL DIA
	=============================================*/

	static public function mdlMostrarCarpetasNoToday($tabla,$item,$valor,$fecha){
        
      $empresa = $_COOKIE['empresa'];

      $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND fecha < :fecha AND empresa = :empresa ORDER BY fecha DESC");

      $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
      $stmt -> bindParam(":fecha", $fecha, PDO::PARAM_STR);
      $stmt -> bindParam(":empresa", $empresa, PDO::PARAM_STR);
          
      $stmt -> execute();

      return $stmt -> fetchAll();

      $stmt -> close();

      $stmt = null;

  }

	/*=============================================
	MOSTRAR CARPETAS BETWEEN
	=============================================*/

	static public function mdlMostrarCarpetasBetween($tabla,$item, $valor,$fecha1,$fecha2,$orden){
    
    $empresa = $_COOKIE['empresa'];
    
      if($item != null){

          $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND empresa = :empresa AND fecha BETWEEN :fecha1 AND :fecha2 ORDER BY $orden DESC");
          
          $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
          $stmt -> bindParam(":empresa", $empresa, PDO::PARAM_STR);
          $stmt -> bindParam(":fecha1", $fecha1, PDO::PARAM_STR);
          $stmt -> bindParam(":fecha2", $fecha2, PDO::PARAM_STR);

          $stmt -> execute();

        return $stmt -> fetchAll();
        
      }else{
        
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE empresa = :empresa AND fecha BETWEEN :$fecha1 AND :$fecha2 ORDER BY $orden DESC");
          
        $stmt -> bindParam(":empresa", $empresa, PDO::PARAM_STR);

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

    $empresa = $_COOKIE['empresa'];

    $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE prioridad < 999 AND empresa = :empresa ORDER BY $orden DESC LIMIT 1");
              
    $stmt -> bindParam(":empresa", $empresa, PDO::PARAM_STR);

    $stmt -> execute();

    return $stmt -> fetch();

    $stmt -> close();

    $stmt = null;

  }

  /*=============================================
	ELIMINAR CARPETA
	=============================================*/

	static public function mdlEliminarCarpeta($tabla, $item, $valor){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE $item = :$item");

    if($valor == 'Sin destino'){

      $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
    
    }else{

      $stmt -> bindParam(":".$item, $valor, PDO::PARAM_INT);
    
    }


    if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;


	}


  /*=============================================
	PRIORIZAR CARPETA
	=============================================*/

	static public function mdlPriorizar($tabla, $prioridadSeleccionada){

    $empresa = $_COOKIE['empresa'];

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET prioridad = prioridad + 1 WHERE prioridad >= :prioridad AND empresa = :empresa");

		$stmt -> bindParam(":prioridad", $prioridadSeleccionada, PDO::PARAM_INT);
		$stmt -> bindParam(":empresa", $empresa, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;


	}

  /*=============================================
	SUMAR ANIMAL
	=============================================*/

	static public function mdlSumarAnimal($tabla,$item,$valor){

    $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET animales = animales + 1 WHERE $item = :$item");

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
	EDITAR CARPETA
	=============================================*/

	static public function mdlEditarCarpeta($tabla,$item,$valor,$datos){

    if($datos == 'restar'){

      $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET animales = animales-1 WHERE $item = :$item");
    
    }

    if($datos == 'completa'){

      $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET completa = 1 WHERE $item = :$item");
      
    }
    
    if($datos == 'desactivar'){
      
      $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET activa = 0, prioridad = NULL WHERE $item = :$item");
      
    }

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
	CARPETA COMPLETA
	=============================================*/

	static public function mdlCarpetaCompleta($tabla,$item,$item2,$valor2){
      
    $empresa = $_COOKIE['empresa'];


    if($item2 != null){
      
      $stmt = Conexion::conectar()->prepare("SELECT COUNT(*) FROM $tabla WHERE $item IS NULL AND $item2 = :$item2 AND empresa = :empresa");
      $stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);
      
    }      
        
    $stmt -> bindParam(":empresa", $empresa, PDO::PARAM_STR);

    $stmt -> execute();

    return $stmt -> fetch();
      
    $stmt -> close();

    $stmt = null;

  }

	/*=============================================
	HAY CARPETA SIN DESTINO ACTIVA?
	=============================================*/


    static public function mdlMostrarCarpetaSDactiva($tabla,$item,$valor,$item2,$valor2){

      $empresa = $_COOKIE['empresa'];

      $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND $item2 = :$item2 AND empresa = :empresa");
          
      $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

      $stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

      $stmt -> bindParam(":empresa", $empresa, PDO::PARAM_STR);

      $stmt -> execute();

      return $stmt -> fetch();

      $stmt -> close();

      $stmt = null;

  }

}