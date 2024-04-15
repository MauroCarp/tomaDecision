<?php

class ControladorAnimales{



	/*=============================================
	NUEVO ANIMAL
	=============================================*/

	static public function ctrNuevoAnimal($data){

		$item = 'completa';

		$valor = null;

		$carpetas = ControladorCarpetas::ctrMostrarCarpetas($item,$valor,'prioridad','ASC');

		$tabla = "animales";

		$rfid = ($_POST["rfid"] != '') ? $_POST["rfid"] : 0;

		$empresa = $_COOKIE['empresa'];

		$datos = array("empresa"=>$empresa,
						"rfid"=>$rfid,
						"mmGrasa"=>$_POST["mmGrasa"],
						"peso"=>$_POST["peso"],
						"sexo"=>$_POST["sexo"],
						"aob"=>$_POST["aob"],
						"refEco"=>$_POST["refEco"]);

		$tas1 = ($datos['mmGrasa'] * 100) / $datos['peso'];

		$tas2 = ($datos['peso'] / $tas1) + 15;

		$tas3 = ($datos['sexo'] == 'M') ? $tas2 : $tas2 - 12;

		$datos['tas1'] = $tas1;
		
		$datos['tas2'] = $tas2;
		
		$datos['tas3'] = $tas3;

		$datos['clasificacion'] = ControladorAnimales::ctrDeterminarClasificacion(null,$tas3,$datos['sexo']);

		$respuesta = ModeloAnimales::mdlNuevoAnimal($tabla, $datos);
		ModeloAnimales::mdlNuevoAnimal('analisis',$datos);
		
		if($respuesta == 'ok'){

			if(sizeof($carpetas) > 0){
				
				for ($i=0; $i < sizeof($carpetas) ; $i++) { 
					
					if($carpetas[$i]['prioridad'] != null){

						if($carpetas[$i]['activa'] == 1 AND $carpetas[$i]['descripcion'] != 'Sin destino'){
							// CLASIFICACION POR FORMULA
							if($carpetas[$i]['clasificacion'] != ''){
	
								$clasificacion = explode('/',$carpetas[$i]['clasificacion']);
								
								$destino = $carpetas[$i]['destino'];
	
								$clasificacionAnimal = ControladorAnimales::ctrDeterminarClasificacion($destino,$tas3,$datos['sexo']);
	
								if(in_array($clasificacionAnimal,$clasificacion) AND $datos['peso'] >= $carpetas[$i]['pesoMin'] AND $datos['peso'] <= $carpetas[$i]['pesoMax'] AND ($carpetas[$i]['sexo'] == $datos['sexo'] OR $carpetas[$i]['sexo'] == '')){

									$item = 'idAnimal';
									
									$ultimoReg = ControladorAnimales::ctrMostrarUltimoReg();
	
									$datos = array('idCarpeta'=>$carpetas[$i]['idCarpeta'],'clasificacion'=>$clasificacionAnimal,'registroClas'=>$clasificacionAnimal,'tipo'=>$carpetas[$i]['tipo']);
									
									$errors['editarAnimal'] =  ControladorAnimales::ctrEditarAnimal($item,$ultimoReg[0],$datos);
									
									$item = 'idCarpeta';
									
									$errors['editarCarpeta'] =  ControladorCarpetas::ctrSumarAnimal($item,$carpetas[$i]['idCarpeta']);
																	
									if(in_array('error',$errors)){
			
										return 'error';
	
									}else{
			
										$datos['status'] = 'ok';
										$datos['carpeta'] = $carpetas[$i]['destino'];
										$datos['descripcion'] = $carpetas[$i]['descripcion'];
										$datos['tipo'] = $carpetas[$i]['tipo'];
										$datos['rfid'] = $rfid;
										$datos['peso'] = $_POST["peso"];
	
										return $datos;
	
									}
			
								}else{

									if(($i + 1) == sizeof($carpetas)){
										
										$response = array('status'=>'ok',
										'carpeta'=>'Sin Destino',
										'descripcion'=>'No Clasifica',
										'clasificacion'=>'-',
										'rfid'=>$rfid,
										'peso'=>$_POST["peso"]);
										// Cargar animal en carpeta SIN DESTINO, SINO esta creada, crearla
										$item = 'descripcion';
	
										$valor = 'Sin Destino';
										
										$item2 = 'activa';
	
										$valor2 = 1;
										
										$respuesta = ControladorCarpetas::ctrMostrarCarpetaSDactiva($item,$valor,$item2,$valor2);
	
										if($respuesta){
											
											// BUSCAMOS EL ANIMAL CARGADO
											$item = 'idAnimal';
			
											$ultimoReg = ControladorAnimales::ctrMostrarUltimoReg() ;
					
											// UBICAMOS AL ANIMAL EN LA CARPETA SD
	
											$datos = array('idCarpeta'=>$respuesta['idCarpeta']);
					
											$editarAnimal =  ControladorAnimales::ctrEditarAnimal($item,$ultimoReg[0],$datos);
	
											// SUMAMOS UN ANIMAL A ESA CARPETA
											$item = 'idCarpeta';
					
											$editarCarpeta =  ControladorCarpetas::ctrSumarAnimal($item,$respuesta['idCarpeta']);
	
											$datos['nuevaCarpeta'] = false;
	
										}else{
											
											ControladorCarpetas::ctrGenerarCarpetaSDAnimal();
	
											$response['nuevaCarpeta'] = true;
	
										}
	
										return $response;
										
									}
	
								}
								
							}else{
								
								// CLASIFICACION POR MM DE GRASA
								$minGrasaCarpeta = $carpetas[$i]['minGrasa'];
								$maxGrasaCarpeta = $carpetas[$i]['maxGrasa'];
								
								$mmGrasa = $datos['mmGrasa'];
	
								if($mmGrasa >= $minGrasaCarpeta AND $mmGrasa  <= $maxGrasaCarpeta AND $datos['peso'] >= $carpetas[$i]['pesoMin'] AND $datos['peso'] <= $carpetas[$i]['pesoMax'] AND ($carpetas[$i]['sexo'] == $datos['sexo'] OR $carpetas[$i]['sexo'] == '')){
									
									$item = 'idAnimal';
			
									$valor = ControladorAnimales::ctrMostrarUltimoReg() ;
			
									$clasificacion = $minGrasaCarpeta."mm / ".$maxGrasaCarpeta."mm";
	
									$destino = $carpetas[$i]['destino'];
	
									$clasificacionAnimal = ControladorAnimales::ctrDeterminarClasificacion($destino,$tas3,$datos['sexo']);
	
									$datos = array('idCarpeta'=>$carpetas[$i]['idCarpeta'],'clasificacion'=>$clasificacion,'registroClas'=>$clasificacionAnimal,'tipo'=>$carpetas[$i]['tipo']);
			
									$errors['editarAnimal'] =  ControladorAnimales::ctrEditarAnimal($item,$valor[0],$datos);
									
									$item = 'idCarpeta';
			
									$errors['editarCarpeta'] =  ControladorCarpetas::ctrSumarAnimal($item,$carpetas[$i]['idCarpeta']);
									
									if(in_array('error',$errors)){
										
										return 'error';
	
									}else{
			
										$datos['status'] = 'ok';
										$datos['carpeta'] = $carpetas[$i]['destino'];
										$datos['descripcion'] = $carpetas[$i]['descripcion'];
										$datos['tipo'] = $carpetas[$i]['tipo'];
										$datos['rfid'] = $rfid;
										$datos['peso'] = $_POST["peso"];
	
										return $datos;
			
									}
			
								}else{
	
									if(($i + 1) == sizeof($carpetas)){
			
										$response = array('status'=>'ok',
										'carpeta'=>'Sin Destino',
										'descripcion'=>'No Clasifica',
										'clasificacion'=>'-',
										'rfid'=>$rfid,
										'peso'=>$_POST["peso"]);
										// Cargar animal en carpeta SIN DESTINO, SINO esta creada, crearla
										$item = 'descripcion';
	
										$valor = 'Sin Destino';
										
										$item2 = 'activa';
	
										$valor2 = 1;
										
										$respuesta = ControladorCarpetas::ctrMostrarCarpetaSDactiva($item,$valor,$item2,$valor2);
	
										if($respuesta){
											
											// BUSCAMOS EL ANIMAL CARGADO
											$item = 'idAnimal';
			
											$ultimoReg = ControladorAnimales::ctrMostrarUltimoReg() ;
					
											// UBICAMOS AL ANIMAL EN LA CARPETA SD
	
											$datos = array('idCarpeta'=>$respuesta['idCarpeta']);
					
											$editarAnimal =  ControladorAnimales::ctrEditarAnimal($item,$ultimoReg[0],$datos);
	
											// SUMAMOS UN ANIMAL A ESA CARPETA
											$item = 'idCarpeta';
					
											$editarCarpeta =  ControladorCarpetas::ctrSumarAnimal($item,$respuesta['idCarpeta']);
											
											$response['nuevaCarpeta'] = false;
	
										}else{
											
											ControladorCarpetas::ctrGenerarCarpetaSDAnimal();
	
											$response['nuevaCarpeta'] = true;
											
										}
										
										return $response;
									
									}
									
								}
	
							}
	
						}else{
							
							$response = array('status'=>'ok',
							'carpeta'=>'Sin Destino',
							'descripcion'=>'No Clasifica',
							'clasificacion'=>'-',
							'rfid'=>$rfid,
							'peso'=>$_POST["peso"]);
	
							$item = 'descripcion';
	
							$valor = 'Sin Destino';
							
							$item2 = 'activa';
	
							$valor2 = 1;
							
							$respuesta = ControladorCarpetas::ctrMostrarCarpetaSDactiva($item,$valor,$item2,$valor2);
	
							if($respuesta){
								
								// BUSCAMOS EL ANIMAL CARGADO
								$item = 'idAnimal';
	
								$ultimoReg = ControladorAnimales::ctrMostrarUltimoReg() ;
		
								// UBICAMOS AL ANIMAL EN LA CARPETA SD
	
								$datos = array('idCarpeta'=>$respuesta['idCarpeta']);
		
								$editarAnimal =  ControladorAnimales::ctrEditarAnimal($item,$ultimoReg[0],$datos);
	
								// SUMAMOS UN ANIMAL A ESA CARPETA
								$item = 'idCarpeta';
		
								$editarCarpeta =  ControladorCarpetas::ctrSumarAnimal($item,$respuesta['idCarpeta']);
								
								$response['nuevaCarpeta'] = false;
	
								return $response;
	
							}else{				
	
								ControladorCarpetas::ctrGenerarCarpetaSDAnimal();
	
								$response['nuevaCarpeta'] = true;
							}
	
							return $response;
					
						}

					}

				}

			}else{

				$response = array('status'=>'ok',
									'carpeta'=>'Sin Destino',
									'descripcion'=>'No Clasifica',
									'clasificacion'=>'-',
									'rfid'=>$rfid,
									'peso'=>$_POST["peso"],
									'nuevaCarpeta'=>true);

				
				ControladorCarpetas::ctrGenerarCarpetaSDAnimal();

				return $response;	

			}
			
		}else{
			
			$datos['status'] = 'error';
			return $datos;
			
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

	static public function ctrContarAnimalesClasificacion($item, $valor, $valor2 ,$clas,$item3,$valor3){

		$tabla = "animales";

		$respuesta = ModeloAnimales::mdlContarAnimalesClasificacion($tabla, $item, $valor, $valor2,$clas,$item3,$valor3);

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

	static public function ctrEliminarAnimal($item,$valor,$analisis = false){
		
		$tabla = (!$analisis) ? 'animales' : 'analisis';

		return ModeloAnimales::mdlEliminarAnimal($tabla,$item,$valor);

	}

	/*=============================================
	DETERMINAR CLASIFICACION ANIMAL
	=============================================*/
	static public function ctrDeterminarClasificacion($destino,$value,$sexo){

		$clasificacionAnimal = null;
		
		if($destino != null){

			$item = 'nombre';

			$perfil = ControladorPerfiles::ctrMostrarPerfiles($item,$destino);

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
		
		}else{

			if($value >= 250){
				
				$clasificacionAnimal = 'F';

			}else if($value > 200 AND $value < 250){

				$clasificacionAnimal = 'B';

			}
			else if($value >= 170 AND $value < 200 ){

				$clasificacionAnimal = 'B+';

			}
			else if($value >= 110 AND $value < 170){

				$clasificacionAnimal = 'MB';

			}
			else if($value >= 100 AND $value < 110){

				$clasificacionAnimal = 'AP';

			}
			else if($value < 100){

				$clasificacionAnimal = 'G';

			}

		}

		return $clasificacionAnimal;

	}

	/*=============================================
	ASIGNAR DESTINO ANIMAL
	=============================================*/

	static public function ctrAsignarDestino(){
		
		if(isset($_POST['asignarDestino'])){

			$destino = $_POST['perfilAsignarDestino'];

			foreach ($_POST as $key => $value) {

				if($key != 'asignarDestino' AND $key != 'perfilAsignarDestino'){
					
					$item = 'idAnimal';

					if($value != ''){

						list($idAnimal,$sexo,$tas) = explode('-',$key);
						
						list($idCarpeta, $tipo) = explode('-', $value);
						
						$clasificacion = ControladorAnimales::ctrDeterminarClasificacion($destino,$tas,$sexo);
					
						$datos = array('idCarpeta'=>$idCarpeta,'tipo'=>$tipo,'registroClas'=>$clasificacion,'clasificacion'=>$clasificacion);

						$editarDestinoAnimal = ControladorAnimales::ctrEditarAnimal($item,$idAnimal,$datos);

						$item = 'idCarpeta';

						$sumarAnimalaCarpeta = ControladorCarpetas::ctrSumarAnimal($item,$idCarpeta);

					}else{

						$datos = array('idCarpeta'=>NULL,'tipo'=>NULL,'clasificacion'=>'-');

						list($idAnimal,$sexo,$tas) = explode('-',$key);
	
						$editarDestinoAnimal = ControladorAnimales::ctrEditarAnimal($item,$idAnimal,$datos);				

					}

				}

				
			}

			$item = 'descripcion';
			
			$descripcion = 'Sin destino';

			$eliminarCarpetaSD = ControladorCarpetas::ctrEliminarCarpeta($item,$descripcion);

			echo '<script>

                    new swal({

                        icon: "success",
                        title: "Los animales fueron asignados correctamente!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"

                    }).then(function(result){

                        if(result.value){
                        
                            window.location = "inicio";

                        }

                    });
					</script>';
                

		
		}
		
	}

}

