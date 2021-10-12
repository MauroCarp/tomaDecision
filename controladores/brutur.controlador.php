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

               $respuesta = ModeloBruTur::mdlNotificar($tabla, $renspa);

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


               include('vistas/modulos/brutur/mailNotificacion.php');	

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
			
			if($_POST['cambiosBrucelosis']){
				
				$estadoBrucelosis= ControladorBruTur::ctrActualizarEstadoBruTur($tabla,$item,$datosBrucelosis);

				$errores[] = $estadoBrucelosis;
				
			}

			$cargarRegistroBrucelosis = ControladorBruTur::ctrIngresarRegistroHistorial($datosBrucelosis);

			$errores[] = $cargarRegistroBrucelosis;
			
			$tabla = 'tuberculosis';
			
			$actualizarTuberculosis = ControladorBruTur::ctrActualizarBruTur($tabla,$item,$datosTuberculosis);

			$errores[] = $actualizarTuberculosis;
			
			if($_POST['cambiosTuberculosis']){
				
				$estadoBrucelosis= ControladorBruTur::ctrActualizarEstadoBruTur($tabla,$item,$datosTuberculosis);
				$errores[] = $estadoBrucelosis;
			
			}

			// $cargarRegistroTuberculosis = ControladorBruTur::ctrIngresarRegistroHistorial($datosTuberculosis);
			// $errores[] = $cargarRegistroTuberculosis;
			
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
		
		$nombreArchivo = 'EnviadosSenasa('.date('d-m-Y').").xls";
		
		$today = date('d-m-Y');
		$Name = 'hola.xls';

		header('Expires: 0');
		header('Cache-control: private');
		header("Content-type: application/vnd.ms-excel"); // Archivo de Excel
		header("Cache-Control: cache, must-revalidate"); 
		header('Content-Description: File Transfer');
		header('Last-Modified: '.date('D, d M Y H:i:s'));
		header("Pragma: public"); 
		header('Content-Disposition:; filename="'.$Name.'"');
		header("Content-Transfer-Encoding: binary");

		echo utf8_decode("<table border='0'> 

				<tr> 
				<td style='font-weight:bold; border:1px solid #eee;'>FECHA CARGADO</td> 
				<td style='font-weight:bold; border:1px solid #eee;'>RENSPA</td>
				<td style='font-weight:bold; border:1px solid #eee;'>PROTOCOLO</td>
				<td style='font-weight:bold; border:1px solid #eee;'>MOTIVO</td>
				<td style='font-weight:bold; border:1px solid #eee;'>FECHA MUESTRA</td>	
				</tr>");


		$respuesta = ControladorBruTur::ctrMostrarPendientes('brucelosis');
	
		if(!empty($respuesta)){

			for ($i=0; $i < sizeof($respuesta) ; $i++) { 
				
				$fechaMuestra = formatearFecha($respuesta[$i]['fechaEstado']);
				$fechaCarga = formatearFecha($respuesta[$i]['fechaCarga']);
				
				echo utf8_decode("<tr> 
				<td style='font-weight:bold; border:1px solid #eee;'>".$fechaCarga."</td> 
				<td style='font-weight:bold; border:1px solid #eee;'>".$respuesta[$i]['renspa']."</td> 
				<td style='font-weight:bold; border:1px solid #eee;'>".$respuesta[$i]['protocolo']."</td> 
				<td style='font-weight:bold; border:1px solid #eee;'>BRUCELOSIS</td>
				<td style='font-weight:bold; border:1px solid #eee;'>".$fechaMuestra."</td>	
				</tr>");

			}

		}
				
		$respuesta = ControladorBruTur::ctrMostrarPendientes('tuberculosis');

		if(!empty($respuesta)){

			for ($i=0; $i < sizeof($respuesta) ; $i++) { 
				
				$fechaMuestra = formatearFecha($respuesta[$i]['fechaEstado']);
				$fechaCarga = formatearFecha($respuesta[$i]['fechaCarga']);
				
				echo utf8_decode("<tr> 
				<td style='font-weight:bold; border:1px solid #eee;'>".$fechaCarga."</td> 
				<td style='font-weight:bold; border:1px solid #eee;'>".$respuesta[$i]['renspa']."</td> 
				<td style='font-weight:bold; border:1px solid #eee;'>".$respuesta[$i]['protocolo']."</td> 
				<td style='font-weight:bold; border:1px solid #eee;'>TUBERCULOSIS</td>
				<td style='font-weight:bold; border:1px solid #eee;'>".$fechaMuestra."</td>	
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

