<div id="ventanaModalCarpetas" class="modal fade" role="dialog">
        
    <div class="modal-dialog modalCarpeta" id="modalCarpeta" style="width:100%;">
    
        <!--=====================================
         CARPETAS
        ======================================-->

        <div class="modal-content carpetasList" id="carpetasList" style="width:95%;">

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

                <button class="btn btn-primary" id="btnCarpetasMobile"><b>Carpetas</b></button>

                <button class="btn btn-primary" id="btnNuevaCarpetaMobile"><b>Nueva Carpeta</b></button>
                
                <button class="btn btn-primary" id="btnNuevoCorralMobile"><b>Nuevo Corral</b></button>

                <div class="box-body">

                    <div class="box">
                        
                        <div class="box-body no-padding" id="tablaCarpetasMobile" style="width:100%;">
                        
                            <table id="tableCarpetasMobile" class="table-bordered table-striped tablaCarpetas display responsive no-wrap" width="100%">

                                <thead>
                                    
                                    <th style="width: 10px">#</th>
                                
                                    <th>Perfil</th>

                                    <th>Carpeta</th>

                                    <th>Cantidad</th>
                                    
                                    <th>Fecha</th>
                                    
                                    <th>Progreso</th>

                                    <th></th>      
                                                          
                                    <th></th>                            
                                    
                                    <th></th>         
                                                       
                                    <th></th>                            

                                </thead>

                                <tbody>

                                </tbody>
                            
                            </table>
                        
                        </div>

                        <div class="box-body hideElement" id="modalNuevaCarpetaCorral">

                            <form method='post' id="nuevaCarpetaCorralForm">
                                
                                <input type="hidden" name="tipoCarpetaCorral" id="tipoCarpetaCorral">

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
                                    
                                    <div class="col-md-3">

                                        <div class="form-group">
                                                
                                            <label for="animalesCarpetaCorral">Cant. Animales</label>
                                        
                                            <input type="number" class="form-control" name="animalesCarpetaCorral" id="animalesCarpetaCorral" value="1">          

                                        </div>

                                    </div>

                                    <div class="col-md-3">
                                        
                                        <div class="form-group">
                                                
                                                <label for="prioridadCarpetaCorral">Prioridad <br>N°</label>
                                            
                                                <input type="number" class="form-control" name="prioridadCarpetaCorral" id="prioridadCarpetaCorral">          

                                        </div>

                                    </div>
                                    
                                    <div class="col-md-3">
                                        
                                        <div class="form-group">
                                                
                                                <label for="pesoMinCarpetaCorral">Peso Minimo</label>
                                            
                                                <input type="number" class="form-control" name="pesoMinCarpetaCorral" id="pesoMinCarpetaCorral"  value="0">          

                                        </div>
                                        
                                    </div>

                                    <div class="col-md-3">

                                        <div class="form-group">
                                                
                                                <label for="pesoMaxCarpetaCorral">Peso Maximo</label>
                                            
                                                <input type="number" class="form-control" name="pesoMaxCarpetaCorral" id="pesoMaxCarpetaCorral"  value="0">          

                                        </div>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-5">

                                        <div class="form-group">
                                            
                                            <label>Sexo</label><br>

                                            <label>
                                                <b>M/H</b>
                                            </label>
                                            &nbsp;
                                            <input type="radio" name="sexoCarpetaCorral" value="" checked>
                                            &nbsp;
                                            <label>
                                                <b>M</b>
                                            </label>
                                            &nbsp;
                                            <input type="radio" name="sexoCarpetaCorral" value="M">
                                            &nbsp;
                                            <label>
                                                <b>H</b>
                                            </label>
                                            &nbsp;
                                            <input type="radio" name="sexoCarpetaCorral" value="H">
                                            &nbsp;
                                        
                                        </div>

                                    </div>


                                    <div class="col-md-7">

                                        <div class="form-group">
                                            
                                            <label>Calificaci&oacute;n</label><br>

                                            <label>
                                                <b>F</b>
                                            </label>
                                            <input type="checkbox" name="clasificacionCarpetaCorral" class="cbClasificacion" value="F">
                                            &nbsp;
                                            <label>
                                                <b>B</b>
                                            </label>
                                            <input type="checkbox" name="clasificacionCarpetaCorral" class="cbClasificacion" value="B">
                                            &nbsp;
                                            <label>
                                                <b>B+</b>
                                            </label>
                                            <input type="checkbox" name="clasificacionCarpetaCorral" class="cbClasificacion" value="B+">
                                            &nbsp;
                                            <label>
                                                <b>MB</b>
                                            </label>
                                            <input type="checkbox" name="clasificacionCarpetaCorral" class="cbClasificacion" value="MB">
                                            &nbsp;
                                            <label>
                                                <b>AP</b>
                                            </label>
                                            <input type="checkbox" name="clasificacionCarpetaCorral" class="cbClasificacion" value="AP">
                                            &nbsp;
                                            <label>
                                                <b>G</b>
                                            </label>
                                            <input type="checkbox" name="clasificacionCarpetaCorral" class="cbClasificacion" value="G">
                                            
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

                                                        
                
                                <div class="row" id="inputFechaCarpeta">                
                                    
                                    <div class="col-xs-12 col-lg-12">
                                            
                                        <div class="form-group">

                                            <label>Fecha</label><br>

                                            <input type="date" name="fechaCarpeta" class="form-control">
                                            
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


    </div>
                
</div>