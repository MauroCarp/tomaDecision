<?php

class ControladorAftosa{
    
    /*=============================================
	CARGAR NUEVA CAMPANIA
	=============================================*/

	static public function ctrCargarCampania(){
    
        if(isset($_GET['campania'])){
            
            $tabla = "campanias";
            
            $item = 'numero';

            $valor = $_GET['campania'];

            $respuesta = ModeloAftosa::mdlCargarCampania($tabla, $item, $valor);

            if($respuesta == "ok"){

                echo'<script>

                swal({
                      type: "success",
                      title: "La campaña fue cargada correctamente",
                      showConfirmButton: true,
                      confirmButtonText: "Cerrar"
                      }).then(function(result){
                                if (result.value) {

                                document.cookie = "campania='.$valor.'"

                                window.location = "inicio";

                                }
                            })

                </script>';

            }else{

                echo'<script>

                swal({
                      type: "error",
                      title: "Hubo un error. El registro no fue guardado",
                      showConfirmButton: true,
                      confirmButtonText: "Cerrar"
                      }).then(function(result){
                                if (result.value) {

                                window.location = "inicio";

                                }
                            })

                </script>';

            }

        }
    
    }

    /*=============================================
    MOSTRAR DATOS CAMPANIA
	=============================================*/

	static public function ctrMostrarDatosCampania($item,$valor){
    
        $tabla = "campanias";
		
        $respuesta = ModeloAftosa::mdlMostrarDatosCampania($tabla, $item, $valor);

		return $respuesta;
    
    }

    /*=============================================
    EDITAR DATOS CAMPANIA
	=============================================*/

	static public function ctrEditarDatosCampania(){
    
        if(isset($_POST['editarCampania'])){
            
            $tabla = "campanias";

            $datos = array('numero' => $_POST['campaniaNumero'],'fechaInicio' => $_POST['fechaInicio'],'fechaCierre' => $_POST['fechaCierre'],'precioAdmAftosa' => $_POST['precioAdmAftosa'],'precioVacunaAftosa' => $_POST['precioVacunaAftosa'],'precioVeterinarioAftosa' => $_POST['precioVacunaAftosa'],'precioAdmCarb' => $_POST['precioAdmCarb'],'precioVacunaCarb' => $_POST['precioVacunaCarb'],'precioVeterinarioCarb' => $_POST['precioVacunaCarb']);
            
            $respuesta = ModeloAftosa::mdlEditarDatosCampania($tabla,$datos);

            if($respuesta == "ok"){

                echo'<script>

                swal({
                      type: "success",
                      title: "La campaña fue modificada correctamente",
                      showConfirmButton: true,
                      confirmButtonText: "Cerrar"
                      }).then(function(result){
                                if (result.value) {

                                window.location = "inicio";

                                }
                            })

                </script>';

            }else{

                echo'<script>

                swal({
                      type: "error",
                      title: "Hubo un error. El registro no fue guardado",
                      showConfirmButton: true,
                      confirmButtonText: "Cerrar"
                      }).then(function(result){
                                if (result.value) {

                                window.location = "inicio";

                                }
                            })

                </script>';

            }
        
        }
    
    }

    /*=============================================
    MOSTRAR DATOS
    =============================================*/

	static public function ctrMostrarDatos($tabla,$item,$valor,$orden){
    
        return $respuesta = ModeloAftosa::mdlMostrarDatos($tabla, $item, $valor, $orden);

    }

    /*=============================================
    ELIMINAR DATOS
    =============================================*/

	static public function ctrEliminarRecepcion(){
    
        if(isset($_GET['id'])){

            $tabla = 'recepcion';

            $item = 'recepcion_id';

            $valor = $_GET['id'];

            $respuesta = ModeloAftosa::mdlEliminarDato($tabla, $item, $valor);
        
            if($respuesta == "ok"){

                echo'<script>

                swal({
                      type: "success",
                      title: "La Recepcion fue eliminada correctamente",
                      showConfirmButton: true,
                      confirmButtonText: "Cerrar"
                      }).then(function(result){
                                if (result.value) {

                                window.location = "index.php?ruta=aftosa/recepcion";

                                }
                            })

                </script>';

            }else{

                echo'<script>

                swal({
                      type: "error",
                      title: "Hubo un error. El registro no fue guardado",
                      showConfirmButton: true,
                      confirmButtonText: "Cerrar"
                      }).then(function(result){
                                if (result.value) {

                                    window.location = "index.php?ruta=aftosa/recepcion";

                                }
                            })

                </script>';

            }
        }

    }

    /*=============================================
    CARGAR RECEPCION
    =============================================*/

	static public function ctrCargarRecepcion($datos){
    
        $tabla = 'recepcion'; 

        return $respuesta = ModeloAftosa::mdlCargarRecepcion($tabla, $datos);

    }

    /*=============================================
    MOSTRAR DISTRIBUCION
    =============================================*/

	static public function ctrMostrarDistribucion($item,$valor,$item2,$valor2){
    
        $tabla = 'distribucion'; 

        return $respuesta = ModeloAftosa::mdlMostrarDistribucion($tabla, $item,$valor,$item2,$valor2);

    }




}

