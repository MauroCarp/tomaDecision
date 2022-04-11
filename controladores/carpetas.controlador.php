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
	MOSTRAR CARPETA
	=============================================*/

	static public function ctrMostrarCarpetas($item, $valor,$orden,$ascDesc){

		$tabla = "carpetas";

		$respuesta = ModeloCarpetas::mdlMostrarCarpetas($tabla, $item, $valor,$orden,$ascDesc);

		return $respuesta;

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

	static public function ctrEliminarCarpeta($valor){

            $tabla = "carpetas";

            $item = 'idCarpeta';

            $errors['carpeta'] = ModeloCarpetas::mdlEliminarCarpeta($tabla, $item, $valor);

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
                
                // $errors['completa'] = ControladorCarpetas::ctrEditarCarpeta($item, $valor,$datos);
                
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

}

