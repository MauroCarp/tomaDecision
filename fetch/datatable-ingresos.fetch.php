<?php

require_once "../controladores/animales.controlador.php";
require_once "../modelos/animales.modelo.php";

class TablaIngresos{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/ 

	public function mostrarTablaAnimales(){


		$item = NULL;
		$valor = NULL;
				
		$animales = ControladorAnimales::ctrMostrarAnimales($item, $valor);

        if(count($animales) == 0){

  			echo '{"data": []}';

		  	return;
  		}	
		
		$deleteBtn = "<div class='btn-group'><button class='btn btn-danger btnEliminar btnEliminarAnimal' idAnimal=''><i class='fa fa-times'></i></button></div>";

		$label = "<span class='label label-danger' style='width: 90%'>Flaca</span>";

		$datosJson = '{
			"data": [';
			
			foreach ($animales as $key => $animal) {
			  
				$sexo = ($animal['sexo'] == 'M') ? 'Macho' : 'Hembra';

				$datosJson .='[
					"'.$animal["RFID"].'",
					"'.$animal["mmGrasa"].'",
					"'.$animal["peso"].'",
					"'.$sexo.'",
					"'.$animal["ecoRef"].'",
					"'.$label.'",
					"-",
					"'.$deleteBtn.'"
					],';

			}

		  $datosJson = substr($datosJson, 0, -1);

		 $datosJson .=   '] 

		 }';
		
		echo $datosJson;


	}


}

/*=============================================
TABLA DE ANIMALES
=============================================*/ 
$activarTablaAnimales = new TablaIngresos();
$activarTablaAnimales -> mostrarTablaAnimales();

