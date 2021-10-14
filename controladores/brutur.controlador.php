<?php

class ControladorBruTur{

    /*=============================================
	PRODUCTORES VENCIDOS
	=============================================*/
    
	static public function ctrEsVencido($tabla1,$today){

		$tabla2 = 'productores';

		$respuesta = ModeloBruTur::mdlEsVencido($tabla1,$tabla2,$today);

		return $respuesta;

	} 
    
	/*=============================================
	PRODUCTORES POR VENCER
	=============================================*/

	static public function ctrPorVencer($tabla1,$today){

		$tabla2 = 'productores';

		$respuesta = ModeloBruTur::mdlPorVencer($tabla1,$tabla2,$today);

		return $respuesta;

	} 

    /*=============================================
	NOTIFICAR PRODUCTOR
	=============================================*/

    static public function ctrNotificar(){

		if(isset($_GET["alerta"])){
				
			   $tabla = $_GET["campania"];
			
               $renspa = $_GET["renspa"];

               $alerta = $_GET["alerta"];
               
			   $estado = $_GET["estado"];

			   $campania = $_GET["campania"];

			   if(isset($_GET['notificar'])){

				   $respuesta = ModeloBruTur::mdlNotificar($tabla, $renspa);
				
				}

               $item = 'renspa';
               
               $valor = $renspa;

               $datos = ControladorProductores::ctrMostrarProductores($item, $valor);

               $establecimiento = $datos['establecimiento'];

               $propietario = $datos['propietario'];

               $matriculaVeterinario = $datos['veterinario'];
               
               $item = 'matricula';

               $veterinario = ControladorVeterinarios::ctrMostrarVeterinarios($item, $matriculaVeterinario);

               $emailVeterinario = $veterinario['email'];

               $nombreVeterinario = $veterinario['nombre'];

			   $mailEnviado = FALSE;

			   if(isset($_GET['notificar'])){

               include('vistas/modulos/brutur/mailNotificacion.php');	
			   
				}else{
				
				include('mailNotificacion.php');	
				
				}
			 //  echo "<script>
			 //	window.location = 'index.php?ruta=brutur/actualizarStatus&renspa=".$valor."';  
			  // </script>";
		}	


	}

    /*=============================================
	ELIMINAR REGISTRO DE HISTORIAL
	=============================================*/

    static public function ctrEliminarRegistro(){
        
        if(isset($_GET["idRegistro"])){

			$tabla ="registros";
			
			$item = 'id';

			$valor= $_GET["idRegistro"];

			$renspa = $_GET['renspa'];

			$respuesta = ModeloBruTur::mdlEliminarRegistro($tabla, $item,$valor);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El Registro ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result){
								if (result.value) {

								window.location = "index.php?ruta=brutur/actualizarStatus&renspa='.$renspa.'";

								}
							})

				</script>';

			}		

		}
    }

	/*=============================================
	MOSTRAR DATOS BRUCELOSIS Y TUBERCULOSIS
	=============================================*/

    static public function ctrMostrarBruTur($valor){
		
		$tabla = 'brucelosis';

		$tabla2 = 'tuberculosis';

		$item = 'renspa';

		$respuesta = ModeloBruTur::mdlMostrarBruTur($tabla,$tabla2,$item,$valor);

		return $respuesta;

    }

	/*=============================================
	INSERTAR NUEVO REGISTRO EN HISTORIAL
	=============================================*/

    static public function ctrIngresarRegistroHistorial($datos){
		
		$tabla = 'registros';
		
		$respuesta = ModeloBruTur::mdlIngresarRegistroHistorial($tabla,$datos);

		return $respuesta;

    }


	/*=============================================
	ACTUALIZAR STATUS SANITARIO
	=============================================*/

    static public function ctrActualizarStatus(){
		
		if(isset($_POST['actualizarStatus'])){

			$fechaHoy = Date('Y-m-d');

			$item = 'renspa';

			$valor = $_POST['renspaHidden'];
			//DATOS  BRUCELOSIS
			
			$datosBrucelosis = array(
				'campania'=>'brucelosis',
				'renspa'=>$valor,
				'vacas'=>$_POST['vacasBruceAct'],
				'vaquillonas'=>$_POST['vaquillonasBruceAct'],
				'toros'=>$_POST['torosBruceAct'],
				'protocolo'=>$_POST['protocoloBruceAct'],
				'estado'=>$_POST['estadoBruceAct'],
				'estadoSenasa'=> 'Pendiente',
				'fechaEstado'=>$_POST['fechaMuestraBruceAct']);
			
			if($datosBrucelosis['estado'] == 'MuVe'){

				$datosBrucelosis['saneamientoNum'] = $_POST['saneamientoNumBruceAct'];
				$datosBrucelosis['positivo'] = $_POST['positivoBruceAct'];
				$datosBrucelosis['negativo'] = $_POST['negativoBruceAct'];
				$datosBrucelosis['sospechoso'] = $_POST['sospechosoBruceAct'];

			}

			//DATOS  TUBERCULOSIS
			
			$datosTuberculosis = array(
				'campania'=>'tuberculosis',
				'renspa'=>$valor,
				'vacas'=>$_POST['vacasTuberAct'],
				'vaquillonas'=>$_POST['vaquillonasTuberAct'],
				'terneros'=>$_POST['ternerosTuberAct'],
				'terneras'=>$_POST['ternerasTuberAct'],
				'toros'=>$_POST['torosTuberAct'],
				'novillos'=>$_POST['novillosTuberAct'],
				'novillitos'=>$_POST['novillitosTuberAct'],
				'protocolo'=>$_POST['protocoloTuberAct'],
				'estado'=>$_POST['estadoTuberAct'],
				'estadoSenasa'=> 'Pendiente',
				'fechaEstado'=>$_POST['fechaMuestraTuberAct']);
			
			if($datosTuberculosis['estado'] == 'En Saneamiento'){

				$datosTuberculosis['saneamientoNum'] = $_POST['saneamientoNumTuberAct'];
				$datosTuberculosis['positivo'] = $_POST['positivoTuberAct'];
				$datosTuberculosis['negativo'] = $_POST['negativoTuberAct'];
				$datosTuberculosis['sospechoso'] = $_POST['sospechosoTuberAct'];

			}

			$errores = array();

			$tabla = 'brucelosis';
			
			$item = 'renspa';
			
			$actualizarBrucelosis = ControladorBruTur::ctrActualizarBruTur($tabla,$item,$datosBrucelosis);
			$errores[] = $actualizarBrucelosis;
			
			$cambios = '';

			if($_POST['cambiosBrucelosis']){
				
				$estadoBrucelosis= ControladorBruTur::ctrActualizarEstadoBruTur($tabla,$item,$datosBrucelosis);

				$errores[] = $estadoBrucelosis;

				$cambios = 'brucelosis';

				
			}

			$cargarRegistroBrucelosis = ControladorBruTur::ctrIngresarRegistroHistorial($datosBrucelosis);

			$errores[] = $cargarRegistroBrucelosis;
			
			$tabla = 'tuberculosis';
			
			$actualizarTuberculosis = ControladorBruTur::ctrActualizarBruTur($tabla,$item,$datosTuberculosis);

			$errores[] = $actualizarTuberculosis;
			
			if($_POST['cambiosTuberculosis']){
				
				$estadoBrucelosis= ControladorBruTur::ctrActualizarEstadoBruTur($tabla,$item,$datosTuberculosis);
				$errores[] = $estadoBrucelosis;

				($cambios != '') ? 'bruTur' : 'tuberculosis';

			}

			$estados[] = $datosBrucelosis['estado'];

			$estados[] = $datosTuberculosis['estado'];

			$estados = implode(',',$estados);

			$cargarRegistroTuberculosis = ControladorBruTur::ctrIngresarRegistroHistorial($datosTuberculosis);

			$errores[] = $cargarRegistroTuberculosis;

			if(!in_array('error',$errores)){

				echo'<script>

				swal({
					  type: "success",
					  title: "El Status ha sido actualizado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  })
					  .then(()=>{
								
						swal({
							title: "¿Notificar a Vacunador?",
							text: "¡Si no puede cancelar la acción!",
							type: "warning",
							showCancelButton: true,
							confirmButtonColor: "#3085d6",
							cancelButtonColor: "#d33",
							cancelButtonText: "Cancelar",
							confirmButtonText: "Si, notificar a Vacunador!"
						  })
						.then(function(result){
								
							if (result.value) {
							  
								window.open("vistas/modulos/brutur/notificarVeterinario.php?renspa='.$valor.'&campania='.$cambios.'&estado='.$estados.'&alerta=cambioStatus" , "_blank")
										
							}

						})
						.then(function(){
							
							window.location = "index.php?ruta=brutur/actualizarStatus&renspa='.$valor.'"

						})
					})

				</script>';
			
			}
			
		}

	}
	
	/*=============================================
	ACTUALIZAR STATUS BRUTUR
	=============================================*/
    static public function ctrActualizarBruTur($tabla,$item,$datos){
	
		return	$respuesta = ModeloBrutur::mdlActualizarBruTur($tabla,$item,$datos);

	}

	/*=============================================
	ACTUALIZAR ESTADO BRUTUR
	=============================================*/
    static public function ctrActualizarEstadoBruTur($tabla,$item,$datos){
	
		return	$respuesta = ModeloBrutur::mdlActualizarEstadoBruTur($tabla,$item,$datos);

	}

	/*=============================================
	APROBAR ESTADO BRUTUR
	=============================================*/
    static public function ctrAprobarEstado($tabla,$item,$datos){

		return	$respuesta = ModeloBrutur::mdlAprobarEstado($tabla,$item,$datos);

	}

	/*=============================================
	MOSTRAR DATOS PENDIENTES BRUCELOSIS Y TUBERCULOSIS
	=============================================*/

    static public function ctrMostrarPendientes($tabla){
		
		$item = 'estadoSenasa';

		$valor = 'Pendiente';

		$respuesta = ModeloBruTur::mdlMostrarPendientes($tabla,$item,$valor);

		return $respuesta;

    }
	

	/*=============================================
	ENVIAR PENDIENTES BRUCELOSIS Y TUBERCULOSIS
	=============================================*/

    static public function ctrEnviarPendientes($item, $valor, $valor2){
		
		$tabla = 'brucelosis';

		$respuesta = ModeloBruTur::mdlEnviarPendientes($tabla,$item,$valor,$valor2);
		
		$tabla = 'tuberculosis';
		
		$respuesta = ModeloBruTur::mdlEnviarPendientes($tabla,$item,$valor,$valor2);

		return $respuesta;

    }

	/*=============================================
	GENERAR EXCEL PENDIENTES BRUCELOSIS Y TUBERCULOSIS
	=============================================*/

    static public function ctrGenerarExcelPendientes(){

		function formatearFecha($fecha){

			$fechaExplode = explode('-',$fecha);
			
			$fechaFormateada = $fechaExplode[2]."-".$fechaExplode[1]."-".$fechaExplode[0];
			
			return $fechaFormateada;
		
		}
		
		$respuestaBrucelosis = ControladorBruTur::ctrMostrarPendientes('brucelosis');
		$respuestaTuberulosis = ControladorBruTur::ctrMostrarPendientes('tuberculosis');

		$nombreArchivo = 'EnviadosSenasa('.date('d-m-Y').").xls";
		
		$today = date('d-m-Y');
		$Name = 'hola.xls';

		$item = 'renspa';

		header('Expires: 0');
		header('Cache-control: private');
		header("Content-type: application/vnd.ms-excel"); // Archivo de Excel
		header("Cache-Control: cache, must-revalidate"); 
		header('Content-Description: File Transfer');
		header('Last-Modified: '.date('D, d M Y H:i:s'));
		header("Pragma: public"); 
		header('Content-Disposition:; filename="'.$nombreArchivo.'"');
		header("Content-Transfer-Encoding: binary");

		echo utf8_decode("<table border='0'> 

				<tr> 
				<td style='font-weight:bold; border:1px solid #eee;'>RENSPA</td>
				<td style='font-weight:bold; border:1px solid #eee;'>PRODUCTOR</td>
				<td style='font-weight:bold; border:1px solid #eee;'>MOTIVO</td>
				<td style='font-weight:bold; border:1px solid #eee;'>FECHA MUESTRA</td>	
				<td style='font-weight:bold; border:1px solid #eee;'>VETERINARIOO</td> 
				</tr>");

		if(!empty($respuestaBrucelosis)){

			for ($i=0; $i < sizeof($respuestaBrucelosis) ; $i++) { 
				
				$fechaMuestra = formatearFecha($respuestaBrucelosis[$i]['fechaEstado']);
				
				$valor = $respuestaBrucelosis[$i]['renspa'];

				$respuesta = ControladorProductores::ctrMostrarProductores($item,$valor);

				$propietario = $respuesta['propietario'];

				$matriculaVet  = $respuesta['veterinario'];

				$item = 'matricula';

				$respuesta = ControladorVeterinarios::ctrMostrarVeterinarios($item,$matriculaVet);

				$veterinario = $respuesta['nombre'];

				echo utf8_decode("<tr> 
				<td style='font-weight:bold; border:1px solid #eee;'>".$respuestaBrucelosis[$i]['renspa']."</td> 
				<td style='font-weight:bold; border:1px solid #eee;'>".$propietario."</td> 
				<td style='font-weight:bold; border:1px solid #eee;'>".$respuestaBrucelosis[$i]['estado']."</td> 
				<td style='font-weight:bold; border:1px solid #eee;'>".$fechaMuestra."</td>	
				<td style='font-weight:bold; border:1px solid #eee;'>".$veterinario."</td>
				</tr>");

			}

		}
				

		if(!empty($respuestaTuberulosis)){

			for ($i=0; $i < sizeof($respuestaTuberulosis) ; $i++) { 
				
				$fechaMuestra = formatearFecha($respuestaTuberulosis[$i]['fechaEstado']);

				$valor = $respuestaTuberulosis[$i]['renspa'];
				
				$respuesta = ControladorProductores::ctrMostrarProductores($item,$valor);

				$propietario = $respuesta['propietario'];

				$matriculaVet  = $respuesta['veterinario'];

				$item = 'matricula';

				$respuesta = ControladorVeterinarios::ctrMostrarVeterinarios($item,$matriculaVet);

				$veterinario = $respuesta['nombre'];

				echo utf8_decode("<tr> 
				<td style='font-weight:bold; border:1px solid #eee;'>".$respuestaTuberculosis[$i]['renspa']."</td> 
				<td style='font-weight:bold; border:1px solid #eee;'>".$propietario."</td> 
				<td style='font-weight:bold; border:1px solid #eee;'>".$respuestaTuberculosis[$i]['estado']."</td> 
				<td style='font-weight:bold; border:1px solid #eee;'>".$fechaMuestra."</td>	
				<td style='font-weight:bold; border:1px solid #eee;'>".$matriculaVet."</td>
				</tr>");

			}
			
		}

		echo "</table>";

		$item = "estadoSenasa";
		
        $valor = "Pendiente";
        
        $valor2 = "Enviado";

		$respuesta = ControladorBruTur::ctrEnviarPendientes($item, $valor, $valor2);

    }

}

