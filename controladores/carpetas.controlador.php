<?php

class ControladorCarpetas{

	/*=============================================
	CREAR CARPETA
	=============================================*/

	static public function ctrNuevaCarpeta(){

        if(isset($_POST['btnCargarCarpeta'])){

                $tabla = "carpetas";

                $clasificacion = implode('/',$_POST['clasificacionCarpeta']);

                $datos = array("destino"=>$_POST["perfilCarpeta"],
                                "cantidad"=>$_POST["animalesCarpeta"],
                                "pesoMin"=>$_POST["pesoMin"],
                                "pesoMax"=>$_POST["pesoMax"],
                                "prioridad"=>$_POST["prioridad"],
                                "clasificacion"=>$clasificacion);

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

                    new     swal({

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
        }

    }


	/*=============================================
	MOSTRAR CARPETA
	=============================================*/

	static public function ctrMostrarCarpetas($item, $valor){

		$tabla = "carpetas";

		$respuesta = ModeloCarpetas::mdlMostrarCarpetas($tabla, $item, $valor);

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

	static public function ctrEditarCarpeta($item, $valor){

		$tabla = "animales";

		$respuesta = ModeloAnimales::mdlMostrarAnimales($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	ELIMINAR CARPETA
	=============================================*/

	static public function ctrEliminarCarpeta(){

        if(isset($_GET['idPerfil'])){

            $tabla = "perfiles";

            $item = 'id';

            $valor = $_GET['idPerfil'];

            $respuesta = ModeloPerfiles::mdlEliminarPerfil($tabla, $item, $valor);

            if($respuesta == "ok"){

                echo '<script>

                new swal({

                    icon: "success",
                    title: "¡El perfil ha sido eliminado correctamente!",
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

                new     swal({

                    icon: "error",
                    title: "Hubo un error al eliminar el perfil",
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

}

