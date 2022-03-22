<?php
require_once "../controladores/carpetas.controlador.php";
require_once "../modelos/carpetas.modelo.php";

class TablaCarpetas{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/ 

	public function mostrarTablaCarpetas(){


		$item = null;
		$valor = null;
  
        $orden = 'fecha';

		$carpetas = ControladorCarpetas::ctrMostrarCarpetas($item,$valor,$orden);

        if(count($carpetas) == 0){

  			echo '{"data": []}';

		  	return;
  		}	
				
		$datosJson = '{
			"data": [';
			
            $cont = 1;

			foreach ($carpetas as $key => $carpeta) {
		
                $color =  'yellow';
                $boton =  'disabled';

                if($carpeta['completa'] == 1){
                    
                    $color =  'green';
                    $boton =  '';

                }
    
                $porcentaje = (($carpeta['animales'] * 100) / $carpeta['cantidad'])."%";

                $progressBar = "<div class='progress progress-xs progress-striped active'><div class='progress-bar progress-bar-".$color."' style='width:".$porcentaje."'></div></div>";

                $button = "<a href='extensiones/fpdf/informesPdf.php?informe=carpeta&idCarpeta=".$carpeta['idCarpeta']."' class='btn btn-primary' ".$boton." target='_blank'>Informe</a>";

                $btnEliminar = "<div class='btn-group'><button class='btn btn-danger btnEliminarCarpeta' idCarpeta='".$carpeta['idCarpeta']."'><i class='fa fa-times'></i></button></div>";

				$datosJson .='[
					"'.$cont.'",
					"'.$carpeta["destino"].'",
                    "'.$carpeta["cantidad"].'",
                    "'.$carpeta["fecha"].'",
                    "'.$progressBar.'",
                    "'.$button.'",
                    "'.$btnEliminar.'"
					],';

                $cont++;

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
$activarTablaCarpetas = new TablaCarpetas();
$activarTablaCarpetas -> mostrarTablaCarpetas();

