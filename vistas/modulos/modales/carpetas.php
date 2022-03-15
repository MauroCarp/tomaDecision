<div id="ventanaModalCarpetas" class="modal fade" role="dialog">
        
    <div class="modal-dialog modalCarpeta" id="modalCarpeta">
    
        <!--=====================================
         CARPETAS
        ======================================-->

        <div class="modal-content carpetasList" id="carpetasList">

            <!--=====================================
            CABEZA DEL MODAL
            ======================================-->

            <div class="modal-header" style="background:#3c8dbc; color:white">

            <button type="button" class="close" data-dismiss="modal">&times;</button>

            <h4 class="modal-title">Carpetas</h4>
    
            </div>

            <!--=====================================
            CUERPO DEL MODAL
            ======================================-->

            <div class="modal-body">

                <button class="btn btn-primary" id="btnNuevaCarpeta"><b>Nueva Carpeta</b></button>

                <div class="box-body">

                    <div class="box">
                        
                        <div class="box-body no-padding">
                        
                            <table class="table">
                            
                                <thead>
                                    
                                    <th style="width: 10px">#</th>
                                
                                    <th>Carpeta</th>

                                    <th>Cantidad</th>
                                    
                                    <th>Progreso</th>

                                    <th></th>                            
                                    
                                    <th></th>                            

                                </thead>

                                <tbody>

                                <?php
                                
                                    $item = null;

                                    $valor = null;

                                    $carpetas = ControladorCarpetas::ctrMostrarCarpetas($item,$valor,'fecha');

                                    for ($i=0; $i < sizeof($carpetas); $i++) { 
                                    
                                        $color =  'yellow';
                                        $boton =  'disabled';

                                        if($carpetas[$i]['completa']){
                                            
                                            $color =  'green';
                                            $boton =  '';

                                        }

                                        $porcentaje = (($carpetas[$i]['animales'] * 100) / $carpetas[$i]['cantidad'])."%";

                                        echo "<tr>
                                
                                            <td>1.</td>
                                        
                                            <td>".$carpetas[$i]['destino']."</td>
                                        
                                            <td>10</td>
                                        
                                            <td>
                                                
                                                <div class='progress progress-xs progress-striped active'>
                                                
                                                    <div class='progress-bar progress-bar-".$color."' style='width: ".$porcentaje."'></div>
                                        
                                                </div>
            
                                            </td>
                                        
                                            <td>
                                                
                                                <button class='btn btn-primary' ".$boton.">Informe</button>

                                            </td>
                                        
                                            <td>                                       
                                                
                                                <div class='btn-group'>
                                                                            
                                                    <button class='btn btn-danger btnEliminarCarpeta' idCarpeta='".$carpetas[$i]['idCarpeta']."'><i class='fa fa-times'></i></button>
                                        
                                                </div>
                                            
                                            </td>
                                        
                                        </tr>";

                                    }

                                ?>

                                </tbody>
                            
                            </table>
                        
                        </div>

                    </div>

                </div>

            </div>
        
        </div>

            
        <!--=====================================
         NUEVA CARPETA
        ======================================-->

        <div class="modal-content hideElement" id="modalNuevaCarpeta">
    
            <!--=====================================
            CABEZA DEL MODAL
            ======================================-->
    
            <div class="modal-header" style="background:#3c8dbc; color:white">
    
                <h4 class="modal-title">Nueva Carpeta</h4>
    
            </div>
    
            <div class="modal-body">
                
                <div class="box" style="border-top:none;">

                    <form method='post' id="nuevaCarpetaForm">
                        
                        <div class="row">
                            
                            <div class="col-md-12">

                                <div class="form-group">
                                    
                                    <label for="perfilCarpeta">Perfil</label>
                                
                                    <select class="form-control" id="perfilCarpeta" name="perfilCarpeta">
                                         
                                    
                                    </select>
                                
                                </div>

                            </div>

                        </div>
                        
                        <div class="row">
                            
                            <div class="col-md-4">

                                <div class="form-group">
                                        
                                    <label for="animalesCarpeta">Cant. Animales</label>
                                
                                    <input type="number" class="form-control" name="animalesCarpeta" id="animalesCarpeta" value="0">          

                                </div>

                            </div>

                            <div class="col-md-4">
                                
                                <div class="form-group">
                                        
                                        <label for="pesoMin">Peso Minimo</label>
                                    
                                        <input type="number" class="form-control" name="pesoMin" id="pesoMin"  value="0">          
        
                                </div>
                                
                            </div>

                            <div class="col-md-4">

                                <div class="form-group">
                                        
                                        <label for="pesoMin">Peso Maximo</label>
                                    
                                        <input type="number" class="form-control" name="pesoMax" id="pesoMax"  value="0">          
        
                                </div>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-3">
                                
                                <div class="form-group">
                                        
                                        <label for="prioridad">Prioridad</label>
                                    
                                        <input type="number" class="form-control" name="prioridad" id="prioridad">          
        
                                </div>

                            </div>

                            <div class="col-md-9">

                                <div class="form-group">
                                    
                                    <label>Calificaci&oacute;n</label><br>

                                    <label>
                                        <b>F</b>
                                    </label>
                                    <input type="checkbox" name="clasificacionCarpeta[]" class="minimal" value="F" style="position: absolute; opacity: 0!important;">
                                    &nbsp;
                                    <label>
                                        <b>B</b>
                                    </label>
                                    <input type="checkbox" name="clasificacionCarpeta[]" class="minimal" value="B" style="position: absolute; opacity: 0!important;">
                                    &nbsp;
                                    <label>
                                        <b>B+</b>
                                    </label>
                                    <input type="checkbox" name="clasificacionCarpeta[]" class="minimal" value="B+" style="position: absolute; opacity: 0!important;">
                                    &nbsp;
                                    <label>
                                        <b>MB</b>
                                    </label>
                                    <input type="checkbox" name="clasificacionCarpeta[]" class="minimal" value="MB" style="position: absolute; opacity: 0!important;">
                                    &nbsp;
                                    <label>
                                        <b>AP</b>
                                    </label>
                                    <input type="checkbox" name="clasificacionCarpeta[]" class="minimal" value="AP" style="position: absolute; opacity: 0!important;">
                                    &nbsp;
                                    <label>
                                        <b>G</b>
                                    </label>
                                    <input type="checkbox" name="clasificacionCarpeta[]" class="minimal" value="G" style="position: absolute; opacity: 0!important;">
                                    
                                </div>

                            </div>
                        </div>

                        <button type="submit" form="nuevaCarpetaForm" class="btn btn-block btn-success" id="btnCargarCarpeta" name="btnCargarCarpeta">Cargar Carpeta</button>
                        
                    </form>

                </div>

            </div>
            
        </div>

    </div>
                
</div>

<?php

$cargarCarpeta = new ControladorCarpetas();
$cargarCarpeta -> ctrNuevaCarpeta();

$eliminarCarpeta = new ControladorCarpetas();
$eliminarCarpeta -> ctrEliminarCarpeta();

?>