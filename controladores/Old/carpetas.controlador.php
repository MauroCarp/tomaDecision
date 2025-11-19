<?php

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


            $datos = array("destino"=>$data["perfilCarpetaCorral"],
                            "tipo"=>$data["tipoCarpetaCorral"],
                            "descripcion"=>$data["descripcionCarpetaCorral"],
                            "cantidad"=>$data["animalesCarpetaCorral"],
                            "sexo"=>$data['sexoCarpetaCorral'],
                            "pesoMin"=>$data["pesoMinCarpetaCorral"],
                            "pesoMax"=>$pesoMax,
                            "prioridad"=>$data["prioridadCarpetaCorral"],
                            "clasificacion"=>$clasificacion,
                            "minGrasa"=>$data["minGrasa"],
                            "maxGrasa"=>$data["maxGrasa"]
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
        $data = array('destino'=>'*','descripcion'=>'Sin destino', 
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

	static public function ctrMostrarCarpetasBetween($item, $valor,$fecha1,$fecha2,$orden){

		$tabla = "carpetas";

		$respuesta = ModeloCarpetas::mdlMostrarCarpetasBetween($tabla, $item, $valor,$fecha1,$fecha2,$orden);

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
        
                $descripcion = utf8_decode($carpeta[0]['descripcion']);
        
                $cabezera = "Informe de Carpeta";
                
                $perfil = "Perfil: $destino";
        
                $destinoDescripcion = "Destino:$descripcion";
                
                $fecha = "Fecha: $today";
                
                //------------------------------------------------------------------------//
        
                $nombreArchivo = 'Informe_Carpeta:'.$descripcion.'.xls';
        
                $Name = 'hola.xls';
        
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
        
                echo utf8_decode("<table border='0'> 
        
                        <tr> 
                            <td style='font-weight:bold; border:1px solid #eee;' colspan='5' align='center'>Informe de Carpeta</td>
                        </tr>
                        <tr> 
                            <td style='font-weight:bold; border:1px solid #eee;'>Perfil:</td>
                            <td style='font-weight:bold; border:1px solid #eee;'>".$destino."</td>
                            <td style='border:1px solid #eee;' colspan='3'></td>
                        </tr>
                        <tr> 
                            <td style='font-weight:bold; border:1px solid #eee;'>Destino:</td>
                            <td style='font-weight:bold; border:1px solid #eee;'>".$descripcion."</td>
                            <td style='border:1px solid #eee;' colspan='3'></td>
                        </tr>
                        <tr> 
                            <td style='font-weight:bold; border:1px solid #eee;'>Fecha:</td>
                            <td style='font-weight:bold; border:1px solid #eee;'>".$today."</td>
                            <td style='border:1px solid #eee;' colspan='3'></td>
                        </tr>
                        <tr> 
                            <td style='font-weight:bold; border:1px solid #eee;'>Total Animales</td>
                            <td style='font-weight:bold; border:1px solid #eee;'>Clasificacion</td>
                            <td style='font-weight:bold; border:1px solid #eee;'>Peso Min</td>
                            <td style='font-weight:bold; border:1px solid #eee;'>Peso Max</td>
                        </tr>
                        <tr> 
                            <td style='border:1px solid #eee;'>".$carpeta[0]['cantidad']."</td>
                            <td style='border:1px solid #eee;'>".$carpeta[0]['clasificacion']."</td>
                            <td style='border:1px solid #eee;'>".$carpeta[0]['pesoMin']."</td>
                            <td style='border:1px solid #eee;'>".$carpeta[0]['pesoMax']."</td>
                        </tr>
                        <tr> 
                            <td style='font-weight:bold; border:1px solid #eee;'>RFID</td>
                            <td style='font-weight:bold; border:1px solid #eee;'>mm Grasa</td>
                            <td style='font-weight:bold; border:1px solid #eee;'>Peso</td>
                            <td style='font-weight:bold; border:1px solid #eee;'>Sexo</td>
                            <td style='font-weight:bold; border:1px solid #eee;'>Clasificacion</td>
                        </tr>
                        ");
        
                $pesoTotal = 0;
                $totalAnimales = 0;
                $pesoMin = ($carpeta[0]['animales'] != 0) ? 9999 : 0;
                $pesoMax = 0;

                $pesos = array();


                if(!empty($animales)){
        
                    for ($i=0; $i < sizeof($animales) ; $i++) { 
                        
                        $pesos[] = $animales[$i]['peso'];
    
                        if($animales[$i]['sexo'] == 'M')
                            $sexo = 'Macho';
                        else
                            $sexo = 'Hembra';
                        
                        switch ($animales[$i]['clasificacion']) {
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

                        echo utf8_decode("<tr> 
                        <td style='border:1px solid #eee;'>".$animales[$i]['RFID']."</td> 
                        <td style='border:1px solid #eee;'>".$animales[$i]['mmGrasa']." mm</td> 
                        <td style='border:1px solid #eee;'>".$animales[$i]['peso']."</td> 
                        <td style='border:1px solid #eee;'>".$sexo."</td> 
                        <td style='border:1px solid #eee;'>".$clasificacion."</td> 
                        </tr>");

                        $pesoTotal += $animales[$i]['peso'];
                        $totalAnimales++;
                        $pesoMin = ($animales[$i]['peso'] < $pesoMin) ? $animales[$i]['peso'] : $pesoMin;
                        $pesoMax = ($animales[$i]['peso'] > $pesoMax) ? $animales[$i]['peso'] : $pesoMax;
     
                    }

                }

                $pesoPromedio = $pesoTotal / $totalAnimales;

                $distanciasCuadrada = array();

                foreach ($pesos as $key => $value) {

                    $distancia = $pesoPromedio - $value;

                    $distanciasCuadrada[] = pow(abs($distancia),2);

                }

                $sumaDistanciasCuadradas = array_sum($distanciasCuadrada);

                $desvioEstandar  = $sumaDistanciasCuadradas / $totalAnimales;               

                echo utf8_decode("
                <tr> 
                <td style='font-weight:bold;border:1px solid #eee;'>KG TOTAL</td> 
                <td style='font-weight:bold;border:1px solid #eee;'>KG PROMEDIO</td> 
                <td style='font-weight:bold;border:1px solid #eee;'>Peso Min</td> 
                <td style='font-weight:bold;border:1px solid #eee;'>Peso Max</td> 
                <td style='font-weight:bold;border:1px solid #eee;'>Desv. Est.</td> 
                </tr>
                <tr> 
                <td style='border:1px solid #eee;'>".$pesoTotal."</td> 
                <td style='border:1px solid #eee;'>".$pesoPromedio."</td> 
                <td style='border:1px solid #eee;'>".$pesoMin."</td> 
                <td style='border:1px solid #eee;'>".$pesoMax."</td> 
                <td style='border:1px solid #eee;'>".number_format(sqrt($desvioEstandar),2)."</td> 
                </tr>
                ");
        
                echo "</table>";
            }

        }

    }

}

