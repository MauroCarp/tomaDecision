
<div id="<?php echo $idVentanaModal;?>" class="modal fade" role="dialog">
 
 <div class="modal-dialog">

   <div class="modal-content" id="modalPrincipal" style="width:250px">


       <!--=====================================
       CABEZA DEL MODAL
       ======================================-->

       <div class="modal-header" style="background:#3c8dbc; color:white">

         <button type="button" class="close" data-dismiss="modal">&times;</button>

         <h4 class="modal-title"><?php echo $tituloModal;?></h4>

       </div>
        
            <!--=====================================
            CUERPO DEL MODAL
            ======================================-->
            <div class='modal-body' style='padding-top:0px;margin-top:0px;'>

                    <div class='box-body' style='padding-top:0px;margin-top:0px;'>
                
                        <div class='box-header'>
                        
                                <div class="row">
                                    
                                    <div class="col-md-12">
                                    
                                        <label><h4><b>Campa&ntilde;a Aftosa</b></h4></label>
                                        
                                    </div>
                                
                                </div>
                                
                                <div class="row">
                                    
                                    <div class="col-md-12">
                                    
                                            <select name="campaniaNum" id="campaniaNum" class="form-control input-lg" style="font-size:1.3em">
                                            
                                            <?php
                                            $item = null;

                                            $valor = null;
                                            
                                            $resultado = ControladorAftosa::ctrMostrarDatosCampania($item,$valor);

                                            for ($i=0; $i < sizeof($resultado) ; $i++) {  
                                                
                                                echo "<option value='".$resultado[$i]['numero']."'>Campaña ".$resultado[$i]['numero']."</option>";

                                            }

                                            ?>
                                            
                                            </select>
                                        
                                    </div>

                                </div>
                                
                        </div>

                </div>

            </div>

            <!--=====================================
            PIE DEL MODAL
            ======================================-->

            <div class="modal-footer">

                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

                <button type="submit" class="btn btn-primary" id="<?php echo $idBtnGenerar;?>">Asignar Campa&ntilde;a</button>

            </div>

   </div>

 </div>

</div>