<?php

class ControladorAnimales{

	/*=============================================
	NUEVO ANIMAL
	=============================================*/

	static public function ctrNuevoAnimal($data){

		$item = 'completa';

		$valor = null;

		$carpetas = ControladorCarpetas::ctrMostrarCarpetas($item,$valor,'prioridad','ASC');

		if(sizeof($carpetas) > 0){

			$tabla = "animales";

			$rfid = ($_POST["rfid"] != '') ? $_POST["rfid"] : 0;

			$datos = array("rfid"=>$rfid,
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

				for ($i=0; $i < sizeof($carpetas) ; $i++) { 
					
					if($carpetas[$i]['activa'] == 1){
						
						if($carpetas[$i]['clasificacion'] != ''){

							// CLASIFICACION POR FORMULA
							$clasificacion = explode('/',$carpetas[$i]['clasificacion']);
							
							$destino = $carpetas[$i]['destino'];

							$clasificacionAnimal = ControladorAnimales::ctrDeterminarClasificacion($destino,$tas3);

							if(in_array($clasificacionAnimal,$clasificacion) AND $datos['peso'] >= $carpetas[$i]['pesoMin'] AND $datos['peso'] <= $carpetas[$i]['pesoMax']){

								$item = 'idAnimal';
		
								$valor = ControladorAnimales::ctrMostrarUltimoReg() ;
		
								$datos = array('idCarpeta'=>$carpetas[$i]['idCarpeta'],'clasificacion'=>$clasificacionAnimal,'registroClas'=>$clasificacionAnimal);
		
								$errors['editarAnimal'] =  ControladorAnimales::ctrEditarAnimal($item,$valor[0],$datos);
								
								$item = 'idCarpeta';
		
								$errors['editarCarpeta'] =  ControladorCarpetas::ctrSumarAnimal($item,$carpetas[$i]['idCarpeta']);
								
								if(in_array('error',$errors)){
		
									return 'error';

								}else{
		
									$datos['status'] = 'ok';
									$datos['carpeta'] = $carpetas[$i]['destino'];
									$datos['descripcion'] = $carpetas[$i]['descripcion'];
									$datos['rfid'] = $rfid;
									$datos['peso'] = $_POST["peso"];

									return $datos;

								}
		
							}else{

								if(($i + 1) == sizeof($carpetas)){
									
									return array('status'=>'ok',
									'descripcion'=>'No Clasifica',
									'clasificacion'=>'-',
									'rfid'=>'-',
									'peso'=>'-');
									
								}

							}
							
						}else{
							// CLASIFICACION POR MM DE GRASA

							$minGrasaCarpeta = $carpetas[$i]['minGrasa'];
							$maxGrasaCarpeta = $carpetas[$i]['maxGrasa'];

							$mmGrasa = $datos['mmGrasa'];

													
							if($mmGrasa  >= $minGrasaCarpeta AND $mmGrasa  <= $maxGrasaCarpeta AND $datos['peso'] >= $carpetas[$i]['pesoMin'] AND $datos['peso'] <= $carpetas[$i]['pesoMax']){
		
								$item = 'idAnimal';
		
								$valor = ControladorAnimales::ctrMostrarUltimoReg() ;
		
								$clasificacion = $minGrasaCarpeta."mm / ".$maxGrasaCarpeta."mm";

								$destino = $carpetas[$i]['destino'];

								$clasificacionAnimal = ControladorAnimales::ctrDeterminarClasificacion($destino,$tas3);

								$datos = array('idCarpeta'=>$carpetas[$i]['idCarpeta'],'clasificacion'=>$clasificacion,'registroClas'=>$clasificacionAnimal);
		
								$errors['editarAnimal'] =  ControladorAnimales::ctrEditarAnimal($item,$valor[0],$datos);
								
								$item = 'idCarpeta';
		
								$errors['editarCarpeta'] =  ControladorCarpetas::ctrSumarAnimal($item,$carpetas[$i]['idCarpeta']);
								
								if(in_array('error',$errors)){
									
									return 'error';

								}else{
		
									$datos['status'] = 'ok';
									$datos['carpeta'] = $carpetas[$i]['destino'];
									$datos['descripcion'] = $carpetas[$i]['descripcion'];
									$datos['rfid'] = $rfid;
									$datos['peso'] = $_POST["peso"];

									return $datos;
		
								}
		
							}else{
		
								if(($i + 1) == sizeof($carpetas)){
		
									return array('status'=>'ok',
									'descripcion'=>'No Clasifica',
									'clasificacion'=>'-',
									'rfid'=>'-',
									'peso'=>'-');
								
								}else{
									
									break;

								}
		
							}

						}

					}

				}

			}else{

				$datos['status'] = 'error';
				return $datos;
			
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
	MOSTRAR ANIMALES BETWEEN
	=============================================*/

	static public function ctrMostrarAnimalesBetween($item, $valor,$valor2){

		$tabla = "animales";

		$respuesta = ModeloAnimales::mdlMostrarAnimalesBetween($tabla, $item, $valor,$valor2);

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

	/*=============================================
	ELIMINAR ANIMAL
	=============================================*/

	static public function ctrEliminarAnimal($item,$valor){
		
		$tabla = 'animales';

        if(isset($_GET['idAnimal'])){

			return $eliminarAnimal = ModeloAnimales::mdlEliminarAnimal($tabla,$item,$valor);

		}

		if($item == 'idCarpeta'){

			return $respuesta = ModeloAnimales::mdlEliminarAnimal($tabla,$item,$valor);

		}

	}

	/*=============================================
	DETERMINAR CLASIFICACION ANIMAL
	=============================================*/
	static public function ctrDeterminarClasificacion($destino,$value){
		
		$item = 'nombre';

		$perfil = ControladorPerfiles::ctrMostrarPerfiles($item,$destino);

		$clasificacionAnimal = null;

		if($value >= ($perfil['flacas'])){
			
			$clasificacionAnimal = 'F';

		}else if($value > ($perfil['buenas']) AND $value < ($perfil['flacas'])){

			$clasificacionAnimal = 'B';

		}
		else if($value >= ($perfil['buenasMas']) AND $value < ($perfil['buenas']) ){

			$clasificacionAnimal = 'B+';

		}
		else if($value >= ($perfil['muyBuenas']) AND $value < ($perfil['buenasMas'])){

			$clasificacionAnimal = 'MB';

		}
		else if($value >= ($perfil['apenasGordas']) AND $value < ($perfil['muyBuenas'])){

			$clasificacionAnimal = 'AP';

		}
		else if($value < ($perfil['apenasGordas'])){

			$clasificacionAnimal = 'G';

		}

		return $clasificacionAnimal;

	}


}

