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

	/*=============================================
	MOSTRAR ACTA
	=============================================*/

	static public function mdlMostrarActa($tabla,$item,$valor,$item2,$valor2){
    
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND $item2 = :$item2");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();


    }

	/*=============================================
	CARGAR ACTA
	=============================================*/
	static public function mdlCargarActa($tabla,$datos){
    
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(renspa,campania,fechaVacunacion,acta,matricula,cantidadPar,fechaRecepcion,vacunoCar,cantidadCar,vacunoBruce,cantidadBruce,pago,admAf,vacunadorAf,vacunaAf,admCar,vacunadorCar,vacunaCar,redondeoAf,redondeoCar) VALUES (:renspa,:campania,:fechaVacunacion,:acta,:matricula,:cantidadPar,:fechaRecepcion,:vacunoCar,:cantidadCar,:vacunoBruce,:cantidadBruce,:pago,:admAf,:vacunadorAf,:vacunaAf,:admCar,:vacunadorCar,:vacunaCar,:redondeoAf,:redondeoCar)");

		$stmt->bindParam(":renspa", $datos["renspa"], PDO::PARAM_STR);
		$stmt->bindParam(":campania", $datos["campania"], PDO::PARAM_STR);
		$stmt->bindParam(":fechaVacunacion", $datos["fechaVacunacion"], PDO::PARAM_STR);
		$stmt->bindParam(":acta", $datos["actaNumero"], PDO::PARAM_STR);
		$stmt->bindParam(":matricula", $datos["matricula"], PDO::PARAM_STR);
		$stmt->bindParam(":cantidadPar", $datos["cantidadVacunas"], PDO::PARAM_STR);
		$stmt->bindParam(":fechaRecepcion", $datos["fechaRecepcion"], PDO::PARAM_STR);
		$stmt->bindParam(":vacunoCar", $datos["vacunoCarbunclo"], PDO::PARAM_STR);
		$stmt->bindParam(":cantidadCar", $datos["cantidadCarbunclo"], PDO::PARAM_STR);
		$stmt->bindParam(":vacunoBruce", $datos["vacunoBrucelosis"], PDO::PARAM_STR);
		$stmt->bindParam(":cantidadBruce", $datos["cantidadBrucelosis"], PDO::PARAM_STR);
		$stmt->bindParam(":pago", $datos["pago"], PDO::PARAM_STR);
		$stmt->bindParam(":admAf", $datos["admAf"], PDO::PARAM_STR);
		$stmt->bindParam(":vacunadorAf", $datos["vacunadorAf"], PDO::PARAM_STR);
		$stmt->bindParam(":vacunaAf", $datos["vacunaAf"], PDO::PARAM_STR);
		$stmt->bindParam(":admCar", $datos["admCar"], PDO::PARAM_STR);
		$stmt->bindParam(":vacunadorCar", $datos["vacunadorCar"], PDO::PARAM_STR);
		$stmt->bindParam(":vacunaCar", $datos["vacunaCar"], PDO::PARAM_STR);
		$stmt->bindParam(":redondeoAf", $datos["montoRedondeoAf"], PDO::PARAM_STR);
		$stmt->bindParam(":redondeoCar", $datos["montoRedondeoCar"], PDO::PARAM_STR);

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
	ACTUALIZAR ACTA
	=============================================*/
	static public function mdlActualizarActa($tabla,$datos){
    
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET
		fechaVacunacion = :fechaVacunacion ,
		acta = :acta ,
		matricula = :matricula ,
		cantidadPar = :cantidadPar ,
		fechaRecepcion = :fechaRecepcion ,
		vacunoCar = :vacunoCar ,
		cantidadCar = :cantidadCar ,
		vacunoBruce = :vacunoBruce ,
		cantidadBruce = :cantidadBruce ,
		pago = :pago ,
		admAf = :admAf ,
		vacunadorAf = :vacunadorAf ,
		vacunaAf = :vacunaAf ,
		admCar = :admCar ,
		vacunadorCar = :vacunadorCar ,
		vacunaCar = :vacunaCar ,
		redondeoAf = :redondeoAf ,
		redondeoCar = :redondeoCar 
		WHERE renspa = :renspa AND campania = :campania");

		$stmt->bindParam(":renspa", $datos["renspa"], PDO::PARAM_STR);
		$stmt->bindParam(":campania", $datos["campania"], PDO::PARAM_STR);
		$stmt->bindParam(":fechaVacunacion", $datos["fechaVacunacion"], PDO::PARAM_STR);
		$stmt->bindParam(":acta", $datos["actaNumero"], PDO::PARAM_STR);
		$stmt->bindParam(":matricula", $datos["matricula"], PDO::PARAM_STR);
		$stmt->bindParam(":cantidadPar", $datos["cantidadVacunas"], PDO::PARAM_STR);
		$stmt->bindParam(":fechaRecepcion", $datos["fechaRecepcion"], PDO::PARAM_STR);
		$stmt->bindParam(":vacunoCar", $datos["vacunoCarbunclo"], PDO::PARAM_STR);
		$stmt->bindParam(":cantidadCar", $datos["cantidadCarbunclo"], PDO::PARAM_STR);
		$stmt->bindParam(":vacunoBruce", $datos["vacunoBrucelosis"], PDO::PARAM_STR);
		$stmt->bindParam(":cantidadBruce", $datos["cantidadBrucelosis"], PDO::PARAM_STR);
		$stmt->bindParam(":pago", $datos["pago"], PDO::PARAM_STR);
		$stmt->bindParam(":admAf", $datos["admAf"], PDO::PARAM_STR);
		$stmt->bindParam(":vacunadorAf", $datos["vacunadorAf"], PDO::PARAM_STR);
		$stmt->bindParam(":vacunaAf", $datos["vacunaAf"], PDO::PARAM_STR);
		$stmt->bindParam(":admCar", $datos["admCar"], PDO::PARAM_STR);
		$stmt->bindParam(":vacunadorCar", $datos["vacunadorCar"], PDO::PARAM_STR);
		$stmt->bindParam(":vacunaCar", $datos["vacunaCar"], PDO::PARAM_STR);
		$stmt->bindParam(":redondeoAf", $datos["montoRedondeoAf"], PDO::PARAM_STR);
		$stmt->bindParam(":redondeoCar", $datos["montoRedondeoCar"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			// return $stmt->errorInfo();
			return "error";
		
		}
		
		$stmt->close();
		$stmt = null;


    }

}