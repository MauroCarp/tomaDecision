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

			if(sizeof($carpetas) > 0){
				
				for ($i=0; $i < sizeof($carpetas) ; $i++) { 
					// } ($carpetas as $key => $carpeta) {
					
					$clasificacion = explode('/',$carpetas[$i]['clasificacion']);
					
					$destino = $carpetas[$i]['destino'];

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
					
					if(in_array($clasificacionAnimal,$clasificacion) AND $datos['peso'] >= $carpetas[$i]['pesoMin'] AND $datos['peso'] <= $carpetas[$i]['pesoMax']){

						$item = 'idAnimal';

						$valor = ControladorAnimales::ctrMostrarUltimoReg() ;

						$datos = array('idCarpeta'=>$carpetas[$i]['idCarpeta'],'clasificacion'=>$clasificacionAnimal);

						$errors['editarAnimal'] =  ControladorAnimales::ctrEditarAnimal($item,$valor[0],$datos);
						
						$item = 'idCarpeta';

						$errors['editarCarpeta'] =  ControladorCarpetas::ctrSumarAnimal($item,$carpetas[$i]['idCarpeta']);
						
						if(in_array('ok',$errors)){

							return 'ok';

						}else{

							return 'error';

						}

					}else{

						if(($i + 1) == sizeof($carpetas)){

							return 'ok';
						
						}

					}

				}

			}else{

				return 'ok';
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

