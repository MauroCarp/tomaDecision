<?php

// Helper para conversión segura UTF-8 a ISO-8859-1 evitando función deprecated utf8_decode
function utf8_to_iso($str){
    return mb_convert_encoding($str,'ISO-8859-1','UTF-8');
}

function desvioEstandarExcel($arr,$prom,$total){

    $distanciasCuadrada = array();

    foreach ($arr as $key => $value) {

        $distancia = $prom - $value;

        $distanciasCuadrada[] = pow(abs($distancia),2);

    }

    $sumaDistanciasCuadradas = array_sum($distanciasCuadrada);
    return $sumaDistanciasCuadradas / $total;

}

class ControladorCarpetas{

	/*=============================================
	CREAR CARPETA
	=============================================*/

	static public function ctrNuevaCarpeta($data){
        
        if($data['clasificacionCarpetaCorral'] != '' OR $data['maxGrasa'] != 0){
            
            $tabla = "carpetas";
                
            $clasificacion = ($data['clasificacionCarpetaCorral'] != '') ? $data['clasificacionCarpetaCorral'] : '';

            $cantidad = $data["animalesCarpetaCorral"];

            if($data["animalesCarpetaCorral"] == 0 AND $data["maxGrasa"] != 0){
                
                $cantidad = null;
            
            }
            
            $pesoMax = $data['pesoMaxCarpetaCorral'];
                
            if($data['pesoMaxCarpetaCorral'] == 0){

                $pesoMax = 10000;
                
            }


            if($data['pesoMaxCarpetaCorral'] < $data['pesoMinCarpetaCorral']){

                echo '<script>

                new swal({

                    icon: "error",
                    title: "Hubo un error al cargar la carpeta. El peso Min no puede ser mayor al peso Max",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"

                }).then(function(result){

                    if(result.value){
                    
                        window.location = "inicio";

                    }

                });
            

                </script>';

                die();

            }

            $fechaCarpeta = ($data['fechaCarpeta'] != '') ? $data['fechaCarpeta'] : '';

            $datos = array("destino"=>$data["perfilCarpetaCorral"],
                            "empresa"=>$_COOKIE["empresa"],
                            "tipo"=>$data["tipoCarpetaCorral"],
                            "descripcion"=>$data["descripcionCarpetaCorral"],
                            "cantidad"=>$data["animalesCarpetaCorral"],
                            "sexo"=>$data['sexoCarpetaCorral'],
                            "pesoMin"=>$data["pesoMinCarpetaCorral"],
                            "pesoMax"=>$pesoMax,
                            "prioridad"=>$data["prioridadCarpetaCorral"],
                            "clasificacion"=>$clasificacion,
                            "minGrasa"=>$data["minGrasa"],
                            "maxGrasa"=>$data["maxGrasa"],
                            'fechaCarpeta'=>$fechaCarpeta
            );

            // VALIDAR PRIORIDAD

            $priorizar = ControladorCarpetas::ctrPriorizar($datos['prioridad']);

            return $respuesta = ModeloCarpetas::mdlNuevaCarpeta($tabla, $datos);
        
        }else{

            return "errorValidacion";

        }

    }

    /*=============================================
	CREAR CARPETA SIN DESTINO
	=============================================*/
    

	static public function ctrNuevaCarpetaSD($data){
        
            
        $tabla = "carpetas";
        
        return $respuesta = ModeloCarpetas::mdlNuevaCarpetaSD($tabla, $data);

    }

    /*=============================================
	CREAR CARPETA SD Y AGREGAR ANIMAL
    =============================================*/
    static public function ctrGenerarCarpetaSDAnimal(){

        // CREAMOS NUEVA CARPETA SD
        $data = array('destino'=>null,'descripcion'=>'Sin destino', 
        'cantidad'=>0,'clasificacion'=>'*');
      
        $respuesta = ControladorCarpetas::ctrNuevaCarpetaSD($data);

        // MOSTRAMOS LOS DATOS DE LA CARPETA CREADA
        $item = 'descripcion';
      
        $valor = 'Sin Destino';
        
        $item2 = 'activa';
      
        $valor2 = 1;
        
        $respuesta = ControladorCarpetas::ctrMostrarCarpetaSDactiva($item,$valor,$item2,$valor2);
      
        // BUSCAMOS EL ANIMAL CARGADO
        $item = 'idAnimal';
      
        $ultimoAnimal = ControladorAnimales::ctrMostrarUltimoReg() ;
      
        // UBICAMOS AL ANIMAL EN LA CARPETA SD
      
        $datos = array('idCarpeta'=>$respuesta['idCarpeta']);
      
        $editarAnimal =  ControladorAnimales::ctrEditarAnimal($item,$ultimoAnimal[0],$datos);
        
        // SUMAMOS UN ANIMAL A ESA CARPETA
        $item = 'idCarpeta';
      
        $editarCarpeta =  ControladorCarpetas::ctrSumarAnimal($item,$respuesta['idCarpeta']);
      
    }

	/*=============================================
	MOSTRAR CARPETA
	=============================================*/

	static public function ctrMostrarCarpetas($item, $valor,$orden,$ascDesc){

		$tabla = "carpetas";

		$respuesta = ModeloCarpetas::mdlMostrarCarpetas($tabla, $item, $valor,$orden,$ascDesc);

		return $respuesta;

	}

    /*=============================================
	MOSTRAR CARPETAS NO DEL DIA
	=============================================*/

	static public function ctrMostrarCarpetasNoToday($item,$valor,$fecha){
        
        $tabla = 'carpetas';

        return $resultado = ModeloCarpetas::mdlMostrarCarpetasNoToday($tabla,$item,$valor,$fecha);
 
    }

	/*=============================================
	MOSTRAR CARPETA BETWEEN
	=============================================*/

	static public function ctrMostrarCarpetasBetween($item,$valor,$fecha1,$fecha2,$orden){

		$tabla = "carpetas";

		$respuesta = ModeloCarpetas::mdlMostrarCarpetasBetween($tabla,$item, $valor,$fecha1,$fecha2,$orden);

		return $respuesta;

	}

	/*=============================================
	MOSTRAR PRIORIDAD
	=============================================*/

	static public function ctrPrioridadCarpetas($orden){

		$tabla = "carpetas";

		$respuesta = ModeloCarpetas::mdlPrioridadCarpetas($tabla,$orden);

		return $respuesta;

	}

	/*=============================================
	EDITAR CARPETA
	=============================================*/

	static public function ctrEditarCarpeta($item, $valor,$datos){

		$tabla = "carpetas";

		$respuesta = ModeloCarpetas::mdlEditarCarpeta($tabla, $item, $valor,$datos);

		return $respuesta;

	}

	/*=============================================
	ELIMINAR CARPETA
	=============================================*/

	static public function ctrEliminarCarpeta($item,$valor){

            $tabla = "carpetas";

            $errors['carpeta'] = ModeloCarpetas::mdlEliminarCarpeta($tabla, $item, $valor);
            
            if($item == 'idCarpeta')    
                $errors['animales'] = ControladorAnimales::ctrEliminarAnimal($item, $valor);

            if(in_array('error',$errors)){

                return 'error';

            }else{

                return 'ok';

            }
            
        
	}

	/*=============================================
	PRIORIZAR
	=============================================*/

	static public function ctrPriorizar($prioridadSeleccionada){

            $tabla = "carpetas";

            return $respuesta = ModeloCarpetas::mdlPriorizar($tabla, $prioridadSeleccionada);
            
	}

	/*=============================================
	SUMAR ANIMAL
	=============================================*/

	static public function ctrSumarAnimal($item,$valor){

            $tabla = "carpetas";

            $errors['sumar'] =  $respuesta = ModeloCarpetas::mdlSumarAnimal($tabla,$item,$valor);
            
            $carpeta = ModeloCarpetas::mdlMostrarCarpetas($tabla,$item,$valor,'fecha','DESC');

            if($carpeta[0]['cantidad'] == $carpeta[0]['animales']){

                $item = 'idCarpeta';

                $valor = $carpeta[0]['idCarpeta'];

                $datos = 'completa';
                                
                return $resp = ControladorCarpetas::ctrEditarCarpeta($item, $valor,$datos);
            }

            if(in_array('error',$errors)){
                
                return 'error';
                
            }else{
                
                return 'ok';

            }


	}

    /*=============================================
	CARPETA COMPLETA
	=============================================*/

	static public function ctrCarpetaCompleta($item,$item2,$valor2){

            $tabla = "carpetas";

            return $respuesta = ModeloCarpetas::mdlCarpetaCompleta($tabla,$item,$item2,$valor2);

	}

    /*=============================================
	HAY CARPETA SIN DESTINO ACTIVA?
	=============================================*/


	static public function ctrMostrarCarpetaSDactiva($item,$valor,$item2,$valor2){

       $tabla = 'carpetas';

       return $respuesta = ModeloCarpetas::mdlMostrarCarpetaSDactiva($tabla,$item,$valor,$item2,$valor2);
    }

    /*=============================================
	GENERAR EXCEL CARPETA 
	=============================================*/

    static public function ctrGenerarExcelCarpeta(){
    
        if(isset($_GET['idCarpeta']) AND isset($_GET['accion'])){
            
            if($_GET['accion'] == 'carpetaExcel'){

                $item = 'idCarpeta';

                $valor = $_GET['idCarpeta'];
                
                $orden = 'fecha';
        
                $carpeta = ControladorCarpetas::ctrMostrarCarpetas($item,$valor,$orden,'ASC');
        
                $today = date('d/m/Y');
        
                $destino = $carpeta[0]['destino'];
        
                $descripcion = utf8_to_iso($carpeta[0]['descripcion']);
        
                $cabezera = "Informe de Carpeta";
                
                $perfilTmp = ($destino == 'Jorge Cornale') ? 'Barlovento SRL' : $destino;

                $perfil = "Perfil: " . $perfilTmp;        

                $destinoDescripcion = "Destino:$descripcion";
                
                $fecha = "Fecha: " . date('d-m-Y',strtotime($carpeta[0]['fecha']));
                
                //------------------------------------------------------------------------//
        
                $nombreArchivo = 'Informe_Carpeta:'.$descripcion.'.xls';
                
                $item = 'idCarpeta';
        
                $animales = ControladorAnimales::ctrMostrarAnimales($item, $valor);
        
                header('Expires: 0');
                header('Cache-control: private');
                header("Content-type: application/vnd.ms-excel"); // Archivo de Excel
                header("Cache-Control: cache, must-revalidate"); 
                header('Content-Description: File Transfer');
                header('Last-Modified: '.date('D, d M Y H:i:s'));
                header("Pragma: public"); 
                header('Content-Disposition:; filename="'.$nombreArchivo.'"');
                header("Content-Transfer-Encoding: binary");
        
                $fechaCarpeta = date('d-m-Y',strtotime($carpeta[0]['fecha']));

                $data = array('pesoMax'=>0,'pesoMin'=>($carpeta[0]['animales'] != 0) ? 9999 : 0,'pesos'=>array(),'pesoTotal'=>0, 'mmMax'=>0,'mmMin'=>($carpeta[0]['animales'] != 0) ? 9999 : 0,'mmTotal'=>0,'mm'=>array(),'totalAnimales'=>0);

                $animalesPorClasificacion = array('F'=>array(),'B'=>array(),'B+'=>array(),'MB'=>array(),'AP'=>array(),'G'=>array());

                foreach ($animales as $animal){
                    $animalesPorClasificacion[$animal['clasificacion']][] = $animal; 
                }

                foreach ($animalesPorClasificacion as $clasificacion => $animales) {
                
                    foreach ($animales as $key => $animal) {
                        $data['pesos'][] = $animal['peso'];
                        $data['pesoTotal'] += $animal['peso'];
                        $data['totalAnimales']++;
                        $data['pesoMin'] = ($animal['peso'] < $data['pesoMin']) ? $animal['peso'] : $data['pesoMin'];
                        $data['pesoMax'] = ($animal['peso'] > $data['pesoMax']) ? $animal['peso'] : $data['pesoMax'];
                        $data['mmMin'] = ($animal['mmGrasa'] < $data['mmMin']) ? $animal['mmGrasa'] : $data['mmMin'];
                        $data['mmMax'] = ($animal['mmGrasa'] > $data['mmMax']) ? $animal['mmGrasa'] : $data['mmMax'];
                        $data['mmTotal'] += $animal['mmGrasa'];
                        $data['mm'][] = $animal['mmGrasa'];

                    }
                }

                $pesoPromedio = $data['pesoTotal'] / $data['totalAnimales'];
                $mmPromedio = $data['mmTotal'] / $data['totalAnimales'];

                $desvioPeso = desvioEstandarExcel($data['pesos'],$pesoPromedio,$data['totalAnimales']);
                $desvioMm = desvioEstandarExcel($data['mm'],$mmPromedio,$data['totalAnimales']);

                $cantidad = ($carpeta[0]['cantidad'] == 0) ? "Libre" : $carpeta[0]['cantidad'];

                echo utf8_to_iso("<table border='0'> 
        
                    <tr> 
                        <td style='font-weight:bold; border:1px solid #eee;' colspan='7' align='center'>Informe de Carpeta</td>
                    </tr>
                    <tr> 
                        <td style='font-weight:bold; border:1px solid #eee;'>Perfil:</td>
                        <td style='font-weight:bold; border:1px solid #eee;'>".$destino."</td>
                        <td style='border:1px solid #eee;' colspan='5'></td>
                    </tr>
                    <tr> 
                        <td style='font-weight:bold; border:1px solid #eee;'>Destino:</td>
                        <td style='font-weight:bold; border:1px solid #eee;'>".$descripcion."</td>
                        <td style='border:1px solid #eee;' colspan='5'></td>
                    </tr>
                    <tr> 
                        <td style='font-weight:bold; border:1px solid #eee;'>Fecha:</td>
                        <td style='font-weight:bold; border:1px solid #eee;'>".$fechaCarpeta."</td>
                        <td style='border:1px solid #eee;' colspan='5'></td>
                    </tr>


                    <tr> 
                        <td style='font-weight:bold; border:1px solid #eee;'>Total Animales</td>
                        <td style='font-weight:bold; border:1px solid #eee;'>Clasificacion</td>
                        <td style='font-weight:bold; border:1px solid #eee;'>Peso Min</td>
                        <td style='font-weight:bold; border:1px solid #eee;'>Peso Max</td>
                        <td style='border:1px solid #eee;' colspan='3'></td>
                        </tr>
                        <tr> 
                        <td style='border:1px solid #eee;'>".$cantidad."</td>
                        <td style='border:1px solid #eee;'>".$carpeta[0]['clasificacion']."</td>
                        <td style='border:1px solid #eee;'>".$carpeta[0]['pesoMin']."</td>
                        <td style='border:1px solid #eee;'>".$carpeta[0]['pesoMax']."</td>
                        <td style='border:1px solid #eee;' colspan='3'></td>
                    </tr>

                    <tr>
                        <td style='font-weight:bold; border:1px solid #eee;'>Peso</td>
                        <td style='font-weight:bold; border:1px solid #eee;'>Kg</td>
                        <td></td>
                        <td style='font-weight:bold; border:1px solid #eee;'>Grasa</td>
                        <td style='font-weight:bold; border:1px solid #eee;'>mm</td>
                        <td></td>
                        <td style='font-weight:bold; border:1px solid #eee;'>Cantidad Cab</td>
                        <td style='font-weight:bold; border:1px solid #eee;'>" . $data['totalAnimales'] . "</td>
                        <td style='font-weight:bold; border:1px solid #eee;'>%</td>
                    </tr>

                    <tr>
                        <td style='border:1px solid #eee;'>MIN</td>
                        <td style='border:1px solid #eee;'>" . $data['pesoMin'] . "</td>
                        <td></td>
                        <td style='border:1px solid #eee;'>MIN</td>
                        <td style='border:1px solid #eee;'>" . $data['mmMin'] . "</td>
                        <td></td>
                        <td style='border:1px solid #eee;'>FLACAS</td>
                        <td style='border:1px solid #eee;'>" . count($animalesPorClasificacion['F']) . "</td>
                        <td style='border:1px solid #eee;'>" . (count($animalesPorClasificacion['F']) * 100) / $data['totalAnimales'] . "</td>
                    </tr>

                    <tr>
                        <td style='border:1px solid #eee;'>MAX</td>
                        <td style='border:1px solid #eee;'>" . $data['pesoMax'] . "</td>
                        <td></td>
                        <td style='border:1px solid #eee;'>MAX</td>
                        <td style='border:1px solid #eee;'>" . $data['mmMax'] . "</td>
                        <td></td>
                        <td style='border:1px solid #eee;'>BUENAS</td>
                        <td style='border:1px solid #eee;'>" . count($animalesPorClasificacion['B']) . "</td>
                        <td style='border:1px solid #eee;'>" . (count($animalesPorClasificacion['B']) * 100) / $data['totalAnimales'] . "</td>
                    </tr>

                    <tr>
                        <td style='border:1px solid #eee;'>PROM</td>
                        <td style='border:1px solid #eee;'>" . $pesoPromedio . "</td>
                        <td></td>
                        <td style='border:1px solid #eee;'>PROM</td>
                        <td style='border:1px solid #eee;'>" . $mmPromedio . "</td>
                        <td></td>
                        <td style='border:1px solid #eee;'>BUENAS+</td>
                        <td style='border:1px solid #eee;'>" . count($animalesPorClasificacion['B+']) . "</td>
                        <td style='border:1px solid #eee;'>" . (count($animalesPorClasificacion['B+']) * 100) / $data['totalAnimales'] . "</td>
                    </tr>
  
                    <tr>
                        <td style='border:1px solid #eee;'>DESVIO</td>
                        <td style='border:1px solid #eee;'>" . $desvioPeso . "</td>
                        <td></td>
                        <td style='border:1px solid #eee;'>DESVIO</td>
                        <td style='border:1px solid #eee;'>" . $desvioMm . "</td>
                        <td></td>
                        <td style='border:1px solid #eee;'>MUY BUENAS</td>
                        <td style='border:1px solid #eee;'>" . count($animalesPorClasificacion['MB']) . "</td>
                        <td style='border:1px solid #eee;'>" . (count($animalesPorClasificacion['MB']) * 100) / $data['totalAnimales'] . "</td>
                    </tr>
  
                    <tr>
                        <td style='border:1px solid #eee;'>TOTAL</td>
                        <td style='border:1px solid #eee;'>" . $data['pesoTotal'] . "</td>
                        <td colspan='4'></td>
                        <td style='border:1px solid #eee;'>APENAS GORDAS</td>
                        <td style='border:1px solid #eee;'>" . count($animalesPorClasificacion['AP']) . "</td>
                        <td style='border:1px solid #eee;'>" . (count($animalesPorClasificacion['AP']) * 100) / $data['totalAnimales'] . "</td>
                    </tr>
                    <tr>
                        <td colspan='6'> </td>
                        <td style='border:1px solid #eee;'>GORDAS</td>
                        <td style='border:1px solid #eee;'>" . count($animalesPorClasificacion['G']) . "</td>
                        <td style='border:1px solid #eee;'>" . (count($animalesPorClasificacion['G']) * 100) / $data['totalAnimales'] . "</td>
                    </tr>

                    <tr>
                        <td colspan='9'></td>
                    </tr>

                    <tr> 
                        <td style='font-weight:bold; border:1px solid #eee;'>Fecha</td>
                        <td style='font-weight:bold; border:1px solid #eee;'>RFID</td>
                        <td style='font-weight:bold; border:1px solid #eee;'>mm Grasa</td>
                        <td style='font-weight:bold; border:1px solid #eee;'>Peso</td>
                        <td style='font-weight:bold; border:1px solid #eee;'>Sexo</td>
                        <td style='font-weight:bold; border:1px solid #eee;'>Clasificacion</td>
                        <td style='font-weight:bold; border:1px solid #eee;'>AOB</td>
                        <td style='font-weight:bold; border:1px solid #eee;'>Ref. Eco</td>
                    </tr>

                    
                ");
        

                if(!empty($animalesPorClasificacion)){
        
                    foreach ($animalesPorClasificacion as $clasificacion => $animales) {

                        foreach ($animales as $key => $animal) {

                            
                            if($animal['sexo'] == 'M')
                                $sexo = 'Macho';
                            else
                                $sexo = 'Hembra';
                            
                            switch ($animal['clasificacion']) {
                                case 'F':
                                    $clasificacion = 'Flaca';
                                    break;
                
                                case 'B':
                                    $clasificacion = 'Buena';
                                    break;
                
                                case 'B+':
                                    $clasificacion = 'Buena +';
                                    break;
                
                                case 'MB':
                                    $clasificacion = 'Muy Buena';
                                    break;
                
                                case 'AP':
                                    $clasificacion = 'Apenas Gorda';
                                    break;
                
                                case 'G':
                                    $clasificacion = 'Gorda';
                                    break;
                                
                                default:
                                    # code...
                                    break;
                            }

                            $fecha = date('d-m-Y',strtotime($animal['date']));

                            echo utf8_to_iso("<tr> 
                                <td style='border:1px solid #eee;'>".$fecha."</td> 
                                <td style='border:1px solid #eee;'>".$animal['RFID']."</td> 
                                <td style='border:1px solid #eee;'>".number_format($animal['mmGrasa'],2,'.','')."</td> 
                                <td style='border:1px solid #eee;'>".$animal['peso']."</td> 
                                <td style='border:1px solid #eee;'>".$sexo."</td> 
                                <td style='border:1px solid #eee;'>".$clasificacion."</td> 
                                <td style='border:1px solid #eee;'>".$animal['aob']."</td> 
                                <td style='border:1px solid #eee;'>".$animal['ecoRef']."</td> 
                            </tr>");

                        }
                        
                    }

                }

            
                echo "</table>";
            }

        }

    }

}

