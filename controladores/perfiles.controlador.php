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
                                "empresa"=>$_COOKIE["empresa"],
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

                    new swal({

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
	MOSTRAR PERFILES NEUTROS
	=============================================*/

	static public function ctrMostrarPerfilesNeutros($item, $valor){

		$tabla = "perfiles";

		$respuesta = ModeloPerfiles::mdlMostrarPerfilesNeutros($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	EDITAR PERFIL
	=============================================*/

	static public function ctrEditarPerfil(){

        if(isset($_POST['editarPerfil'])){

            $idPerfil = $_POST['idPerfilEdit'];

            $item = 'id';

            $perfil = ControladorPerfiles::ctrMostrarPerfiles($item,$idPerfil);

            $nombrePerfil = $perfil['nombre'];

            $item = 'completa';

            $item2 = 'destino';

            $carpetaValida = ControladorCarpetas::ctrCarpetaCompleta($item,$item2,$nombrePerfil);

            if($carpetaValida[0] == 0){
    
                $tabla = "perfiles";
                
                $datos = array('idPerfil'=>$_POST['idPerfilEdit'],
                'flacas'=>$_POST['flacasConfEditInput'],
                'buenas'=>$_POST['buenasConfEditInput'],
                'buenasMas'=>$_POST['buenasPlusConfEditInput'],
                'muyBuenas'=>$_POST['muyBuenasConfEditInput'],
                'apenasGordas'=>$_POST['apenasGordasConfEditInput']);

                $respuesta = ModeloPerfiles::mdlEditarPerfil($tabla, $datos);

                if($respuesta == "ok"){

                    echo '<script>
    
                    new swal({
    
                        icon: "success",
                        title: "¡El Perfil ha sido editado correctamente!",
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
                        title: "Hubo un error al editar el perfil",
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
                    title: "El perfil esta asociado a una carpeta ACTIVA.",
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
	ELIMINAR PERFIL
	=============================================*/

	static public function ctrEliminarPerfil(){

        if(isset($_GET['idPerfil'])){

            $tabla = "perfiles";
            
            $item = 'id';

            $valor = $_GET['idPerfil'];
            
            $perfil = ControladorPerfiles::ctrMostrarPerfiles($item,$valor);

            $nombrePerfil = $perfil['nombre'];

            $item = 'completa';

            $item2 = 'destino';

            $carpetaValida = ControladorCarpetas::ctrCarpetaCompleta($item,$item2,$nombrePerfil);
            
            if($carpetaValida[0] == 0){
                
                $item = 'id';

                $respuesta = ModeloPerfiles::mdlEliminarPerfil($tabla, $item, $valor);

                if($respuesta == "ok"){

                    echo '<script>
    
                    new swal({
    
                        icon: "success",
                        title: "¡El Perfil ha sido eliminado correctamente!",
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

            }else{
                
                echo '<script>
                    
                new swal({
    
                    icon: "error",
                    title: "El perfil esta asociado a una carpeta ACTIVA.",
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
	ACTIVAR/DESCATIVAR PERFIL
	=============================================*/

	static public function ctrActivarDesactivarPerfil($item, $valor){

            $tabla = "perfiles";

            $perfil = ControladorPerfiles::ctrMostrarPerfiles($item,$valor);

            $nombrePerfil = $perfil['nombre'];

            $item = 'completa';

            $item2 = 'destino';

            $carpetaValida = ControladorCarpetas::ctrCarpetaCompleta($item,$item2,$nombrePerfil);
            
            if($carpetaValida[0] == 0){
    
                $item = 'id';

                $data['state'] = ModeloPerfiles::mdlActivarDesactivarPerfil($tabla, $item, $valor);

                $activo = ModeloPerfiles::mdlMostrarPerfiles($tabla,$item,$valor);

                $data['activo'] = $activo['activo'];

                return $data;

            }else{
                
                $data['state'] = 'carpetaActiva';

                return $data;

            }

        }
}


