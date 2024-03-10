<div id="ventanaModalAsignarDestino" class="modal fade" role="dialog">
        
    <div class="modal-dialog modalAsignarDestino" id="modalAsignarDestino">
    
        <!--=====================================
         Animales
        ======================================-->

        <div class="modal-content animalesList" id="animalesList">

            <!--=====================================
            CABEZA DEL MODAL
            ======================================-->

            <div class="modal-header" style="background:#3c8dbc; color:white">

            <button type="button" class="close" data-dismiss="modal">&times;</button>

            <h4 class="modal-title">Animales</h4>
    
            </div>

            <!--=====================================
            CUERPO DEL MODAL
            ======================================-->

            <div class="modal-body">

                <div class="box-body">
                    
                    <div class="row">
                    
                        <div class="col-lg-4">
        
                            <div class="form-group">
        
                                <label for="perfilSD">Perfil:</label>
            
                                <select name="perfilSD" id="perfilSD" class="form-control"></select>
        
                            </div>
                    
                        </div>
                    
                    </div>

                    <div class="box">
                        
                        <div class="box-body no-padding">
                            
                            <form method="post" id="formAsignarDestino">
                                <input type="hidden" name="asignarDestino" value="true">
                                <input type="hidden" name="perfilAsignarDestino" id="perfilAsignarDestino">

                                <!-- CUANDO SE DESCTIVAN LAS CARPETAS EN EL PRIMER INIICIO ELIMINAR ANIMALES SIN DESTINO⁄ -->

                                <div class="row" style="background-color:rgb(250,250,250)">

                                    <div class="col-lg-2">
                                        
                                        <b>RFID</b>
                                        
                                    </div>

                                    <div class="col-lg-2">
                                        
                                        <b>mm Grasa</b>
                                        
                                    </div>

                                    <div class="col-lg-2">
                                        
                                        <b>Peso</b>
                                        
                                    </div>

                                    <div class="col-lg-2">
                                        
                                        <b>Sexo</b>
                                        
                                    </div>

                                    <div class="col-lg-2">
                                        
                                        <b>Destino</b>                                  
                                        
                                    </div>
                                    
                                    <div class="col-lg-2">
                                        
                                        <b>Clasif</b>
                                        
                                    </div>

                                </div>                                

                                <div id="animalesSDList"></div>
                                
                                <button type="submit" id="btnAsignarAnimales" class="btn btn-primary"><b>Asignar Animales</b></button>

                            </form>
                            <br>
                        </div>

                    </div>

                </div>

            </div>
        
        </div>

    </div>
                
</div>
