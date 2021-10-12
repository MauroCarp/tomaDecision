<?php

class ControladorVeterinarios{

	/*=============================================
	CREAR VETERINARIO
	=============================================*/

	static public function ctrCrearVeterinario(){

		if(isset($_POST["matricula"])){

			   	$tabla = "veterinarios";

			   	$datos = array("nombre"=>$_POST["nombre"],
							   "matricula"=>$_POST["matricula"],
							   "domicilio"=>$_POST["domicilio"],
							   "telefono"=>$_POST["telefono"],
							   "mail"=>$_POST["email"],
							   "tipo"=>$_POST["tipo"]);

			   	$respuesta = ModeloVeterinarios::mdlIngresarVeterinario($tabla, $datos);
				
				// return $respuesta;
				//    die();
			   
				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El Veterinario ha sido guardado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "veterinarios";

									}
								})

					</script>';

				}

		
		}

	}

	/*=============================================
	MOSTRAR VETERINARIOS
	=============================================*/

	static public function ctrMostrarVeterinarios($item, $valor){

		$tabla = "veterinarios";

		$respuesta = ModeloVeterinarios::mdlMostrarVeterinarios($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	EDITAR CLIENTE
	=============================================*/

	static public function ctrEditarVeterinario(){

		if(isset($_POST["matriculaEdit"])){

			   	$tabla = "veterinarios";

			   	$datos = array("nombre"=>$_POST["nombreEdit"],
								"matricula"=>$_POST["matriculaEdit"],
								"domicilio"=>$_POST["domicilioEdit"],
								"telefono"=>$_POST["telefonoEdit"],
								"mail"=>$_POST["emailEdit"],
								"tipo"=>$_POST["tipoEdit"],
					        	"id"=>$_POST["idEdit"]);
				
				$respuesta = ModeloVeterinarios::mdlEditarVeterinario($tabla, $datos);
							//    return $respuesta;
							// 	  die();
			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El Veterinario ha sido modificado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "veterinarios";

									}
								})

					</script>';

				}

		}

	}

	/*=============================================
	ELIMINAR PRODUCTOR
	=============================================*/

	static public function ctrEliminarVeterinario(){

		if(isset($_GET["idVeterinario"])){

			$tabla ="veterinarios";
			
			$datos = $_GET["idVeterinario"];

			$respuesta = ModeloVeterinarios::mdlEliminarVeterinario($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El Veterinario ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result){
								if (result.value) {

								window.location = "veterinarios";

								}
							})

				</script>';

			}		

		}

	}



}

