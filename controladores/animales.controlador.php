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
					
					if($carpetas[$i]['activa'] == 1){
						
						if($carpetas[$i]['clasificacion'] != ''){							
							// CLASIFICACION POR FORMULA

							$clasificacion = explode('/',$carpetas[$i]['clasificacion']);
							
							$destino = $carpetas[$i]['destino'];
		
							$item = 'nombre';
		
							$perfil = ControladorPerfiles::ctrMostrarPerfiles($item,$destino);
		
							$clasificacionAnimal = null;
		
							if($tas3 >= ($perfil['flacas'] + 230)){
								
								$clasificacionAnimal = 'F';
		
							}else if($tas3 > ($perfil['buenas'] + 200) AND $tas3 < ($perfil['flacas'] + 230)){
		
								$clasificacionAnimal = 'B';
		
							}
							else if($tas3 >= ($perfil['buenasMas'] + 175) AND $tas3 < ($perfil['buenas'] + 200) ){
		
								$clasificacionAnimal = 'B+';
		
							}
							else if($tas3 >= ($perfil['muyBuenas'] + 125) AND $tas3 < ($perfil['buenasMas'] + 175)){
		
								$clasificacionAnimal = 'MB';
		
							}
							else if($tas3 >= ($perfil['apenasGordas'] + 110) AND $tas3 < ($perfil['muyBuenas'] + 125)){
		
								$clasificacionAnimal = 'AP';
		
							}
							else if($tas3 < ($perfil['apenasGordas'] + 110)){
		
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
		
									$datos['status'] = 'ok';
									$datos['carpeta'] = $carpetas[$i]['destino'];
									$datos['descripcion'] = $carpetas[$i]['descripcion'];
									$datos['rfid'] = $_POST["rfid"];
									$datos['peso'] = $_POST["peso"];

									return $datos;
		
								}else{
		
									return 'error';
		
								}
		
							}else{
								
								if(($i + 1) == sizeof($carpetas)){
		
									return array('status'=>'ok');
								
								}else{
									return array('status'=>'ok','descripcion'=>'No Clasifica');
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

								$datos = array('idCarpeta'=>$carpetas[$i]['idCarpeta'],'clasificacion'=>$clasificacion);
		
								$errors['editarAnimal'] =  ControladorAnimales::ctrEditarAnimal($item,$valor[0],$datos);
								
								$item = 'idCarpeta';
		
								$errors['editarCarpeta'] =  ControladorCarpetas::ctrSumarAnimal($item,$carpetas[$i]['idCarpeta']);
								
								if(in_array('ok',$errors)){
		
									$datos['status'] = 'ok';
									$datos['carpeta'] = $carpetas[$i]['destino'];
									$datos['descripcion'] = $carpetas[$i]['descripcion'];
									$datos['rfid'] = $_POST["rfid"];
									$datos['peso'] = $_POST["peso"];
									return $datos;
		
								}else{
		
									return 'error';
		
								}
		
							}else{
		
											return array('status'=>'ok',
											'descripcion'=>'No Clasifica',
											'clasificacion'=>'-',
											'rfid'=>'-',
											'peso'=>'-');

								// if(($i + 1) == sizeof($carpetas)){
		
								// 	return array('status'=>'ok');
								
								// }else{

								// 		return array('status'=>'ok',
								// 		'descripcion'=>'No Clasifica',
								// 		'clasificacion'=>'-',
								// 		'rfid'=>'-',
								// 		'peso'=>'-',
								// 	);

								// }
		
							}


						}

					}else{

						$item = 'RFID';

						$valor = $_POST["rfid"];
		
						$eliminarAnimal = ModeloAnimales::mdlEliminarAnimal($tabla,$item,$valor);
		
						$datos['status'] = 'error';
						$datos['motivo'] = 'noCarpeta';
						return $datos;

					}

				}

			}else{

				$item = 'RFID';

				$valor = $_POST["rfid"];

				$eliminarAnimal = ModeloAnimales::mdlEliminarAnimal($tabla,$item,$valor);

				$datos['status'] = 'error';
				$datos['motivo'] = 'noCarpeta';
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
	ELIMINAR PERFIL
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


		/*=============================================
	ELIMINAR PERFIL
	=============================================*/

	static public function ctrEliminarAnimal(){

        if(isset($_GET['idAnimal'])){

			$tabla = 'animales';

			return $eliminarAnimal = ModeloAnimales::mdlEliminarAnimal($tabla,$item,$valor);


		}

	}


}

