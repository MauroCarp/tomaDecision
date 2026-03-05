<?php

class ControladorAnalisis{


	/*=============================================
	MOSTRAR ANIMALES
	=============================================*/

	static public function ctrMostrarAnimales($checked = 0){

		$tabla = "analisis";

		$respuesta = ModeloAnalisis::mdlMostrarAnimalesPesados($tabla,$checked);

		$animales = array();

		foreach ($respuesta as $key => $value) {

			$animales[] = $value['RFID'];

		}

		$data = ModeloAnalisis::mdlMostrarAnimales($tabla,implode(',',$animales));

		foreach ($data as $key => $value) {
			# code...
			$rfid = $value["RFID"];
				// Obtener ADPV del animal
			$adpv = self::calcularADPV($rfid);
		
			
			// Obtener último peso y fecha
		
			// Almacenar datos del animal en el array
			$data[$key]['adpv']= $adpv;

		}

		return $data;

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

		return number_format($adpv,2,',','.');
	
	}

	public static function ctrEliminarRfid($rfid){

		return ModeloAnalisis::mdlEliminarRfid('analisis',$rfid);
		
	}

	public static function ctrRfidCheck($rfid,$check){
		
		$tabla = 'analisis';
		return ModeloAnalisis::mdlRfidCheck($tabla,$rfid,$check);

	}

}