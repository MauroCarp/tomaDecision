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
                
                <button class="btn btn-primary" id="btnNuevoCorral"><b>Nuevo Corral</b></button>

                <div class="box-body">

                    <div class="box">
                        
                        <div class="box-body no-padding">
                        
                            <table class="table table-bordered table-striped tablaCarpetas dt-responsive nowrap">
                            
                                <thead>
                                    
                                    <th style="width: 10px">#</th>
                                
                                    <th>Perfil</th>

                                    <th>Carpeta</th>

                                    <th>Cantidad</th>
                                    
                                    <th>Fecha</th>
                                    
                                    <th>Progreso</th>

                                    <th></th>                            
                                    
                                    <th></th>                            

                                </thead>

                                <tbody>

                                </tbody>
                            
                            </table>
                        
                        </div>

                    </div>

                </div>

            </div>
        
        </div>



        <!--=====================================
         NUEVA/O CARPETA/CORRAL
        ======================================-->

        <div class="modal-content hideElement" id="modalNuevaCarpetaCorral">
    
            <!--=====================================
            CABEZA DEL MODAL
            ======================================-->
    
            <div class="modal-header" style="background:#3c8dbc; color:white">
    
                <div class="box-tools pull-right">

                    <button type="button" class="btn btn-box-tool" id="removeNuevaCarpeta"><i class="fa fa-times"></i></button>

                </div>

                <h4 class="modal-title" id="tituloModal">Nueva Carpeta</h4>

    
            </div>
    
            <div class="modal-body">
                
                <div class="box" style="border-top:none;">

                    <form method='post' id="nuevaCarpetaCorralForm">
                        
                        <div class="row">
                            
                            <div class="col-xs-12 col-lg-6">

                                <div class="form-group">
                                    
                                    <label for="perfilCarpetaCorral">Perfil</label>
                                
                                    <select class="form-control" id="perfilCarpetaCorral" name="perfilCarpetaCorral">
                                         
                                    
                                    </select>
                                
                                </div>

                            </div>

                                                        
                            <div class="col-xs-12 col-lg-6">

                                <div class="form-group">
                                    
                                    <label for="descripcionCarpetaCorral">Descripci&oacute;n</label>
                                
                                    <input type="text" class="form-control" id="descripcionCarpetaCorral" name="descripcionCarpetaCorral" required>
                                
                                </div>

                            </div>

                        </div>

                        <div class="row">
                            
                            <div class="col-md-4">

                                <div class="form-group">
                                        
                                    <label for="animalesCarpetaCorral">Cant. Animales</label>
                                
                                    <input type="number" class="form-control" name="animalesCarpetaCorral" id="animalesCarpetaCorral" value="1">          

                                </div>

                            </div>

                            <div class="col-md-4">
                                
                                <div class="form-group">
                                        
                                        <label for="pesoMinCarpetaCorral">Peso Minimo</label>
                                    
                                        <input type="number" class="form-control" name="pesoMinCarpetaCorral" id="pesoMinCarpetaCorral"  value="0">          
        
                                </div>
                                
                            </div>

                            <div class="col-md-4">

                                <div class="form-group">
                                        
                                        <label for="pesoMaxCarpetaCorral">Peso Maximo</label>
                                    
                                        <input type="number" class="form-control" name="pesoMaxCarpetaCorral" id="pesoMaxCarpetaCorral"  value="0">          
        
                                </div>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-3">
                                
                                <div class="form-group">
                                        
                                        <label for="prioridadCarpetaCorral">Prioridad</label>
                                    
                                        <input type="number" class="form-control" name="prioridadCarpetaCorral" id="prioridadCarpetaCorral">          
        
                                </div>

                            </div>

                            <div class="col-md-9">

                                <div class="form-group">
                                    
                                    <label>Calificaci&oacute;n</label><br>

                                    <label>
                                        <b>F</b>
                                    </label>
                                    <input type="checkbox" name="clasificacionCarpetaCorral[]" class="minimal cbClasificacion" value="F" style="position: absolute; opacity: 0!important;">
                                    &nbsp;
                                    <label>
                                        <b>B</b>
                                    </label>
                                    <input type="checkbox" name="clasificacionCarpetaCorral[]" class="minimal cbClasificacion" value="B" style="position: absolute; opacity: 0!important;">
                                    &nbsp;
                                    <label>
                                        <b>B+</b>
                                    </label>
                                    <input type="checkbox" name="clasificacionCarpetaCorral[]" class="minimal cbClasificacion" value="B+" style="position: absolute; opacity: 0!important;">
                                    &nbsp;
                                    <label>
                                        <b>MB</b>
                                    </label>
                                    <input type="checkbox" name="clasificacionCarpetaCorral[]" class="minimal cbClasificacion" value="MB" style="position: absolute; opacity: 0!important;">
                                    &nbsp;
                                    <label>
                                        <b>AP</b>
                                    </label>
                                    <input type="checkbox" name="clasificacionCarpetaCorral[]" class="minimal cbClasificacion" value="AP" style="position: absolute; opacity: 0!important;">
                                    &nbsp;
                                    <label>
                                        <b>G</b>
                                    </label>
                                    <input type="checkbox" name="clasificacionCarpetaCorral[]" class="minimal cbClasificacion" value="G" style="position: absolute; opacity: 0!important;">
                                    
                                </div>

                            </div>
                        </div>
                        
                        <label class="hideElement" id="tituloRangoMM">Rango MM Grasa</label>

                        <div class="row hideElement" id="inputsRangoMM">                
                            
                            <div class="col-xs-6 col-lg-3">
                                    
                                <div class="form-group">

                                    <label>Min</label><br>

                                    <input type="number" step="0.05" name="minGrasa" class="form-control" value="0">
                                    
                                </div>

                            </div>

                            <div class="col-xs-6 col-lg-3">

                                <label>Max</label><br>

                                <div class="form-group">

                                    <input type="number" step="0.05" name="maxGrasa" class="form-control" value="0">
                                    
                                </div>

                            </div>
                            
                        </div>

                        <button type="submit" form="nuevaCarpetaCorralForm" class="btn btn-block btn-success" id="btnCargarCarpetaCorral" name="btnCargarCarpetaCorral"></button>
                        
                    </form>

                </div>

            </div>
            
        </div>

    </div>
                
</div>

<?php

// $cargarCarpeta = new ControladorCarpetas();
// $cargarCarpeta -> ctrNuevaCarpeta();

// $eliminarCarpeta = new ControladorCarpetas();
// $eliminarCarpeta -> ctrEliminarCarpeta();

?>