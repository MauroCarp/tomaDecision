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

                                let date = new Date()

                                date.setTime(date.getTime()+(30*24*60*60*1000))
    
                                let expires = date.toGMTString()
                                
                                document.cookie = `campania = '.$valor.'";path=/sanidadAnimal;Expires=${expires}`

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

            $errores = array();
            
            $errores[] = $respuesta;


            if($_FILES["existenciaAnimal"]['size'] > 0){

                require_once 'extensiones/excel/php-excel-reader/excel_reader2.php';

                require_once 'extensiones/excel/SpreadsheetReader.php';
                
                $productores = ControladorProductores::ctrMostrarProductores(null,null);

                $renspasExistentes = array();
    
                foreach ($productores as $key => $value) {
                    
                    $renspasExistentes[] = $value['renspa'];

                }

                $error = false;
            
                $allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
            
                if(in_array($_FILES["existenciaAnimal"]["type"],$allowedFileType)){
            
                    $ruta = "cargas/" . $_FILES['existenciaAnimal']['name'];
            
                    move_uploaded_file($_FILES['existenciaAnimal']['tmp_name'], $ruta);
            
                    $nombreArchivo = str_replace(' ', '',$_FILES['existenciaAnimal']['name']);
            
                    $rowNumber = 0;
            
                    $rowValida = FALSE;
                    
                    $rowValidaTemp = FALSE;
                                
                    $Reader = new SpreadsheetReader($ruta);	
            
                    $sheetCount = count($Reader->sheets());
            
                    for($i=0;$i<$sheetCount;$i++){
            
                        $Reader->ChangeSheet($i);
            
                            foreach ($Reader as $Row){
                                
                                $rowNumber++;
                                
                                
                                if($rowValida){   
                                    
                                    if(!in_array($Row[0], $renspasExistentes)) {
                        
                                        $respuesta = ControladorProductores::ctrCrearProductorExistencia($Row[0],$Row[1]);
                                    
                                    }

                                    $data = array(
                                        'renspa' => $Row[0],
                                        'vacas' => $Row[3],
                                        'vaquillonas' => $Row[4],
                                        'novillos' => $Row[5],
                                        'novillitos' => $Row[6],
                                        'terneras' => $Row[7],
                                        'terneros' => $Row[8],
                                        'toros' => $Row[9],
                                        'toritos' => $Row[10]
                                    );
            
                                    $respuesta = ControladorAnimales::ctrCargarExistencia($data);

                                }
                                
                                if ($rowNumber == 1){
                                    
                                    $rowValida = TRUE;
                                
                                }
            

                            }		
                    }
            
                }

            }

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
    MOSTRAR DATOS
    =============================================*/

	static public function ctrMostrarMarcas($item){
    
        $tabla = 'recepcion';

        return $respuesta = ModeloAftosa::mdlMostrarMarcas($tabla, $item);

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

    /*=============================================
    CARGAR DISTRIBUCION
    =============================================*/

	static public function ctrCargarDistribucion($datos){
    
        $tabla = 'distribucion'; 

        return $respuesta = ModeloAftosa::mdlCargarDistribucion($tabla, $datos);

    }



}

