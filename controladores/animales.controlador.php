<?php

class ControladorAnimales{

	/*=============================================
	CREAR PRODUCTORES
	=============================================*/

	static public function ctrNuevoAnimal($data){

		$tabla = "animales";

		$datos = array("rfid"=>$_POST["rfid"],
						"mmGrasa"=>$_POST["mmGrasa"],
						"peso"=>$_POST["peso"],
						"sexo"=>$_POST["sexo"],
						"refEco"=>$_POST["refEco"]);

		$tas1 = ($datos['mmGrasa'] * 100) / $datos['peso'];

		$tas2 = $datos['peso'] / $tas1;

		$tas3 = ($datos['sexo'] == 'M') ? $tas2 : $tas2 - 12;

		$datos['tas1'] = $tas1;
		
		$datos['tas2'] = $tas2;
		
		$datos['tas3'] = $tas3;

		$respuesta = ModeloAnimales::mdlNuevoAnimal($tabla, $datos);

		if($respuesta == 'ok'){
			
			$item = 'completa';

			$valor = null;

			$carpetas = ControladorCarpetas::ctrMostrarCarpetas($item,$valor,'prioridad');

			foreach ($carpetas as $key => $carpeta) {
				
				$clasificacion = explode('/',$carpeta['clasificacion']);
				
				$destino = $carpeta['destino'];

				$item = 'nombre';

				$perfil = ControladorPerfiles::ctrMostrarPerfiles($item,$destino);

				$clasificacionAnimal = null;

				if($tas3 >= $perfil['flacas']){
					
					$clasificacionAnimal = 'F';

				}else if($tas3 > $perfil['buenas'] AND $tas3 < $perfil['flacas']){

					$clasificacionAnimal = 'B';

				}
				else if($tas3 >= $perfil['buenasMas'] AND $tas3 < $perfil['buenas']){

					$clasificacionAnimal = 'B+';

				}
				else if($tas3 >= $perfil['muyBuenas'] AND $tas3 < $perfil['buenasMas']){

					$clasificacionAnimal = 'MB';

				}
				else if($tas3 >= $perfil['apenasGordas'] AND $tas3 < $perfil['muyBuenas']){

					$clasificacionAnimal = 'AP';

				}
				else if($tas3 < $perfil['apenasGordas']){

					$clasificacionAnimal = 'G';

				}

				
				if(in_array($clasificacionAnimal,$clasificacion)){
					
					$item = 'idAnimal';

					$valor = ControladorAnimales::ctrMostrarUltimoReg() ;

					$datos = array('idCarpeta'=>$carpeta['idCarpeta'],'clasificacion'=>$clasificacionAnimal);

					return $respuesta = ControladorAnimales::ctrEditarAnimal($item,$valor[0],$datos);

				}

			}
		
		}

	}

	/*=============================================
	MOSTRAR ANIMALES
	=============================================*/

	static public function ctrMostrarAnimales($item, $valor){

		$tabla = "animales";

		$respuesta = ModeloAnimales::mdlMostrarAnimales($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	CONTAR ANIMALES
	=============================================*/

	static public function ctrContarAnimales($item, $valor){

		$tabla = "animales";

		$respuesta = ModeloAnimales::mdlContarAnimales($tabla, $item, $valor);

		return $respuesta;

	}


	/*=============================================
	MOSTRAR ANIMALES SEGUN CLASF
	=============================================*/

	static public function ctrContarAnimalesClasificacion($item, $valor, $valor2 ,$clas){

		$tabla = "animales";

		$respuesta = ModeloAnimales::mdlContarAnimalesClasificacion($tabla, $item, $valor, $valor2,$clas);

		return $respuesta;

	}

	/*=============================================
	EDITAR ANIMALES 
	=============================================*/

	static public function ctrEditarAnimal($item, $valor, $datos){

		$tabla = "animales";

		$respuesta = ModeloAnimales::mdlEditarAnimal($tabla, $item, $valor,$datos);

		return $respuesta;

	}

	/*=============================================
	MOSTRAR ULTIMO REGISTRO 
	=============================================*/

	static public function ctrMostrarUltimoReg(){

		$tabla = "animales";

		$respuesta = ModeloAnimales::mdlMostrarUltimoReg($tabla);

		return $respuesta;

	}




}

