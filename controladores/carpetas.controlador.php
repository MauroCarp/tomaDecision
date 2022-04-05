<?php

class ControladorCarpetas{

	/*=============================================
	CREAR CARPETA
	=============================================*/

	static public function ctrNuevaCarpeta(){

        if(isset($_POST['btnCargarCarpetaCorral'])){

            if(isset($_POST['clasificacionCarpetaCorral']) OR $_POST['maxGrasa'] != 0){
                
                $tabla = "carpetas";
                    
                $clasificacion = (isset($_POST['clasificacionCarpetaCorral'])) ? implode('/',$_POST['clasificacionCarpetaCorral']) : '';

                $cantidad = $_POST["animalesCarpetaCorral"];

                if($_POST["animalesCarpetaCorral"] == 0 AND $_POST["maxGrasa"] != 0){
                    
                    $cantidad = null;
                
                }
                    

                $datos = array("destino"=>$_POST["perfilCarpetaCorral"],
                                "descripcion"=>$_POST["descripcionCarpetaCorral"],
                                "cantidad"=>$_POST["animalesCarpetaCorral"],
                                "pesoMin"=>$_POST["pesoMinCarpetaCorral"],
                                "pesoMax"=>$_POST["pesoMaxCarpetaCorral"],
                                "prioridad"=>$_POST["prioridadCarpetaCorral"],
                                "clasificacion"=>$clasificacion,
                                "minGrasa"=>$_POST["minGrasa"],
                                "maxGrasa"=>$_POST["maxGrasa"]
                );

                // VALIDAR PRIORIDAD

                $priorizar = ControladorCarpetas::ctrPriorizar($datos['prioridad']);

                $respuesta = ModeloCarpetas::mdlNuevaCarpeta($tabla, $datos);

                if($respuesta == "ok"){

                    echo '<script>

                    new swal({

                        icon: "success",
                        title: "¡La carpeta ha sido guardada correctamente!",   
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"

                    }).then(function(result){

                        if(result.value){
                        
                            window.location = "inicio";

                        }

                    });
                

                    </script>';


                }else{

                    echo '<script>

                    new swal({

                        icon: "error",
                        title: "Hubo un error al cargar la carpeta",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"

                    }).then(function(result){

                        if(result.value){
                        
                            window.location = "inicio";

                        }

                    });
                

                    </script>';

                }
            
            }else{

                echo '<script>

                    new swal({

                        icon: "error",
                        title: "Se debe elegir al menos  clasificación de animal/Rango de mm",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"

                    }).then(function(result){

                        if(result.value){
                        
                            window.location = "inicio";

                        }

                    });
                

                    </script>';

            }

        }

    }


	/*=============================================
	MOSTRAR CARPETA
	=============================================*/

	static public function ctrMostrarCarpetas($item, $valor,$orden){

		$tabla = "carpetas";

		$respuesta = ModeloCarpetas::mdlMostrarCarpetas($tabla, $item, $valor,$orden);

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

	static public function ctrEliminarCarpeta(){

        if(isset($_GET['idCarpeta'])){

            $tabla = "carpetas";

            $item = 'idCarpeta';

            $valor = $_GET['idCarpeta'];

            $errors['carpeta'] = ModeloCarpetas::mdlEliminarCarpeta($tabla, $item, $valor);

            $errors['animales'] = ControladorAnimales::ctrEliminarAnimal($item, $valor);

            if(in_array('error',$errors)){

                echo '<script>

                new swal({

                    icon: "error",
                    title: "Hubo un error al eliminar la carpeta",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"

                }).then(function(result){

                    if(result.value){
                    
                        window.location = "inicio";

                    }

                });
            

                </script>';

            }else{

                echo '<script>

                new swal({

                    icon: "success",
                    title: "¡La carpeta ha sido eliminada correctamente!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"

                }).then(function(result){

                    if(result.value){
                    
                        window.location = "inicio";

                    }

                });
            

                </script>';

            }
            
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
            
            $carpeta = ModeloCarpetas::mdlMostrarCarpetas($tabla,$item,$valor,'fecha');

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

