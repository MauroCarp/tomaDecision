<?php

class ControladorProductores{

	/*=============================================
	CREAR PRODUCTORES
	=============================================*/

	static public function ctrCrearProductor(){

		if(isset($_POST["propietario"])){

			   	$tabla = "productores";

			   	$datos = array("renspa"=>$_POST["renspa"],
							   "propietario"=>$_POST["propietario"],
							   "establecimiento"=>$_POST["establecimiento"],
							   "explotacion"=>$_POST["tipoExplotacion"],
							   "regimen"=>$_POST["regimen"],
							   "tipoDoc"=>$_POST["tipoDoc"],
							   "numDoc"=>$_POST["numDoc"],
							   "iva"=>$_POST["iva"],
							   "telefono"=>$_POST["telefono"],
							   "mail"=>$_POST["mail"],
							   "domicilio"=>$_POST["domicilio"],
							   "localidad"=>$_POST["localidad"],
							   "provincia"=>$_POST["provincia"],
							   "departamento"=>$_POST["departamento"],
							   "distrito"=>$_POST["distrito"]);

			   	$respuesta = ModeloProductores::mdlIngresarProductor($tabla, $datos);

				$tabla = "brucelosis";

			   	$datos = array("renspa"=>$_POST["renspa"]);

			   	$respuesta = ModeloBrucelosis::mdlIngresarRegistro($tabla, $datos);
				
				$tabla = "tuberculosis";

			   	$respuesta = ModeloTuberculosis::mdlIngresarRegistro($tabla, $datos);
				
				// return $respuesta;
				//    die();
			   
				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El Productor/Establecimiento ha sido guardado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "productores";

									}
								})

					</script>';

				}

		
		}

	}

	/*=============================================
	MOSTRAR PRODUCTORES
	=============================================*/

	static public function ctrMostrarProductores($item, $valor){

		$tabla = "productores";

		$respuesta = ModeloProductores::mdlMostrarProductores($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	EDITAR CLIENTE
	=============================================*/

	static public function ctrEditarProductor(){

		if(isset($_POST["renspaEdit"])){

			   	$tabla = "productores";

			   	$datos = array("renspa"=>$_POST["renspaEdit"],
					           "propietario"=>$_POST["propietarioEdit"],
					           "establecimiento"=>$_POST["establecimientoEdit"],
					           "explotacion"=>$_POST["tipoExplotacionEdit"],
					           "regimen"=>$_POST["regimenEdit"],
					           "tipoDoc"=>$_POST["tipoDocEdit"],
					           "numDoc"=>$_POST["numDocEdit"],
					           "iva"=>$_POST["ivaEdit"],
					           "telefono"=>$_POST["telefonoEdit"],
					           "mail"=>$_POST["mailEdit"],
					           "domicilio"=>$_POST["domicilioEdit"],
					           "localidad"=>$_POST["localidadEdit"],
					           "provincia"=>$_POST["provinciaEdit"],
					           "departamento"=>$_POST["departamentoEdit"],
					           "distrito"=>$_POST["distritoEdit"],
					           "id"=>$_POST["idEdit"]);
				
				$respuesta = ModeloProductores::mdlEditarProductor($tabla, $datos);
							//    return $respuesta;
							// 	  die();
			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El Productor ha sido modificado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "productores";

									}
								})

					</script>';

				}

		}

	}

	/*=============================================
	ELIMINAR PRODUCTOR
	=============================================*/

	static public function ctrEliminarProductor(){

		if(isset($_GET["idProductor"])){

			$tabla ="productores";
			
			$datos = $_GET["idProductor"];

			$respuesta = ModeloProductores::mdlEliminarProductor($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El productor ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result){
								if (result.value) {

								window.location = "productores";

								}
							})

				</script>';

			}		

		}

	}

	/*=============================================
	PRODUCTORES SEGUN VETERINARIO
	=============================================*/

	static public function ctrStatusEstablecimientos($item, $valor){

		$tabla = "productores";

		$tabla2 = 'brucelosis';

		$tabla3 = 'tuberculosis';

		$respuesta = ModeloProductores::mdlStatusEstablecimientos($tabla, $tabla2,$tabla3,$item, $valor);

		return $respuesta;

	}

}

