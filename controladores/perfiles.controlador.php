<?php

class ControladorPerfiles{

	/*=============================================
	CREAR PERFIL
	=============================================*/

	static public function ctrNuevoPerfil(){

        if(isset($_POST['btnCargarPerfil'])){

            // VALIDAR NOMBRE
            $item = 'nombre';

            $valor = $_POST['nombrePerfil'];

            if($_POST['nombrePerfil'] == ''){

                echo '<script>

                new swal({

                    icon: "error",
                    title: "¡Debe completar el campo Nombre!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"

                })           

                </script>';

                die();
                
            }

            $nombreValido = ControladorPerfiles::ctrMostrarPerfiles($item,$valor);
            
            if(!$nombreValido){

                $tabla = "perfiles";

                $datos = array("nombre"=>$_POST["nombrePerfil"],
                                "flacas"=>$_POST["flacasConfInput"],
                                "buenas"=>$_POST["buenasConfInput"],
                                "buenasMas"=>$_POST["buenasPlusConfInput"],
                                "muyBuenas"=>$_POST["muyBuenasConfInput"],
                                "apenasGordas"=>$_POST["apenasGordasConfInput"]);

                $respuesta = ModeloPerfiles::mdlNuevoPerfil($tabla, $datos);

                if($respuesta == "ok"){

                    echo '<script>

                    new swal({

                        icon: "success",
                        title: "¡El perfil ha sido guardado correctamente!",
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
                        title: "Hubo un error al cargar el perfil",
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
                    title: "Ya hay un perfil con ese nombre.",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"

                })

                </script>';

                
            }   

        }

    }


	/*=============================================
	MOSTRAR PERFILES
	=============================================*/

	static public function ctrMostrarPerfiles($item, $valor){

		$tabla = "perfiles";

		$respuesta = ModeloPerfiles::mdlMostrarPerfiles($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	EDITAR PERFIL
	=============================================*/

	static public function ctrEditarPerfil($item, $valor){

		$tabla = "animales";

		$respuesta = ModeloAnimales::mdlMostrarAnimales($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	ELIMINAR PERFIL
	=============================================*/

	static public function ctrEliminarPerfil(){

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

}

