<?php

class ControladorAnalisis{


	/*=============================================
	MOSTRAR ANIMALES
	=============================================*/

	static public function ctrMostrarAnimales(){

		$tabla = "analisis";

		$respuesta = ModeloAnalisis::mdlMostrarAnimalesPesados($tabla);

		$animales = array();

		foreach ($respuesta as $key => $value) {

			$animales[] = $value['RFID'];

		}

		$data = ModeloAnalisis::mdlMostrarAnimales($tabla,implode(',',$animales));


		return $data;
		die;
		foreach ($respuesta as $key => $value) {
			# code...
			$rfid = $value["RFID"];
				// Obtener ADPV del animal
			$data = self::calcularADPV($rfid);
		
			// Obtener último peso y fecha
		
			// Almacenar datos del animal en el array
			$animales[$rfid] = [
			  "adpv" => $data['adpv'],
			  "peso" => $data["peso"],
			  "fecha" => $data["fecha"]
			];

		}

		return $animales;

	}

	public static function calcularADPV($rfid){

		$resultado = ModeloAnalisis::mdlCalcularADPV($rfid);
		
		$fecha_primer_pesaje = new DateTime($resultado["fecha_primer_pesaje"]);
		$fecha_ultimo_pesaje = new DateTime($resultado["fecha_ultimo_pesaje"]);

		$fecha = $fecha_ultimo_pesaje->format('d-m-Y');
		// Calcular diferencia de días
		$diferencia_dias = $fecha_ultimo_pesaje->diff($fecha_primer_pesaje);

		$peso_primer_pesaje = ModeloAnalisis::mdlObtenerPesos($rfid,'ASC');
		$peso_ultimo_pesaje = ModeloAnalisis::mdlObtenerPesos($rfid,'DESC');

		$diferencia_peso = $peso_ultimo_pesaje[0] - $peso_primer_pesaje[0];

   		 // Calcular ADPV
    	$adpv = ($diferencia_dias->days > 0) ? $diferencia_peso / $diferencia_dias->days : $diferencia_peso;

		return ['adpv'=>number_format($adpv,2,',','.'),'peso'=>$peso_ultimo_pesaje[0],'fecha'=>$fecha];
	
	}

}