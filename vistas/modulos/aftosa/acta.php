<div class="content-wrapper">

    <section class="content-header">

        <h1>

        Productores / Establecimientos

        </h1>

        <ol class="breadcrumb">

            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

            <li class="active">Productores / Establecimientos</li>

        </ol>

    </section>

    <section class="content" style="font-size:1.4em;">

    <form method="POST" role="form">
      
      <!-- DATOS PRODUCTOR -->

      <?php

        $item = 'renspa';

        $valor = $_GET['renspa'];

        $resultado = ControladorProductores::ctrMostrarProductores($item,$valor);
      
      ?>
      <div class="row">
    
        <div class="col-md-3">

          <div class="form-group">
              
              <label for="renspa"><b>R.E.N.S.P.A: </b></label>
              
              <input type="text" class="form-control"  style="font-size:1.2em;" id="renspaProductor" value="<?php echo $resultado['renspa'];?>" readOnly>
            
          </div>
        
        </div>
        
        <div class="col-md-4">

          <div class="form-group">
              
              <label for="propietario"><b>Propietario: </b></label>
              
              <input type="text" class="form-control" style="font-size:1.2em;"  id="propietario" value="<?php echo $resultado['propietario'];?>" readOnly>
            
          </div>
        
        </div>
  
        <div class="col-md-4">
        
          <div class="form-group">
                
                <label for="establecimiento"><b>Establecimiento: </b></label>
                
                <input type="text" class="form-control" style="font-size:1.2em;"  id="establecimiento"  value="<?php echo $resultado['establecimiento'];?>" readOnly>
              
          </div>
           
        </div>

        <div class="col-md-1">
          
          <div class="form-group">
                
            <br>
               
            <button class="btn btn-success btnVerProductor" data-toggle="modal" data-target="#modalVerProductor" renspa=""><i class="fa fa-eye"></i></button>
          
          </div>
           

        </div>

      </div>
      
      <div class="lineaSeparadora"></div>

      <!-- CARGAR DATOS ACTA -->
      <div class="row">

        <div class="col-md-2">

          <div class="form-group">
            
            <label for="fechaVacunacion">Fecha de Vacunaci&oacute;n</label>
            
            <input type="date" class="form-control" id="fechaVacunacion">
          
          </div>

        </div>

        <div class="col-md-2">

          <div class="form-group">
            
            <label for="fechaRecepcion">Fecha de Recepci&oacute;n</label>
            
            <input type="date" class="form-control" id="fechaRecepcion">
          
          </div>

        </div>

        <div class="col-md-2">

          <div class="form-group">
            
            <label for="vacunador">Vacunador</label>
            
            <select name="matricula" id="vacunador" class="form-control">

            </select>

          </div>
          
        </div>

        <div class="col-md-2">

          <div class="form-group">
            
            <label for="cantidadVacunas">Vacunas Suministradas</label>
            
            <input type="number" class="form-control" id="cantidadVacunas">
          
          </div>

        </div>

        <div class="col-md-2">

          <div class="form-group">
            
            <label for="actaNumero">Acta</label>
            
            <input type="text" class="form-control" id="actaNumero">
          
          </div>

        </div>

        <div class="col-md-1">
          
          <div class="form-group">
            
            <label for="pago">Pag&oacute;</label>
            <br>
            <input type="checkbox" class="checkbox" id="pago">
          
          </div>

        </div>

        <div class="col-md-1"> 
          
          <div class="form-group">
            
            <label for="monto">Monto</label>
            
            <br>
            
            <span id="monto" style="color:#00A00F;font-size: 30px;font-weight: bold;cursor: pointer;" class="fa fa-file-text-o" data-toggle="modal" data-target="#ventanaModalMonto">
          
          </div>

        </div>

      </div>

      <div class="lineaSeparadora"></div>

      <!-- CANTIDAD ANIMALES -->
      <div class="row">

        <div class="col-md-1"></div>

        <div class="col-md-1"> 
          
          <h4 style="line-height:35px;"><b>Vacas</b>:</h6>
          <input type="number" min="0" class="form-control sumTotal" name="vacas" value="0">
        
        </div>

        <div class="col-md-1">
        
          <h4 style="line-height:35px;"><b>Toros</b>:</h6>
          <input type="number" min="0" class="form-control sumTotal" name="toros" value="0">
          
        </div>

        <div class="col-md-1">
        
          <h4 style="line-height:35px;"><b>Toritos</b>:</h6>
          <input type="number" min="0" class="form-control sumTotal sumParcial" name="toritos" value="0">
          
        </div>
        
        <div class="col-md-1">
        
          <h4 style="line-height:35px;"><b>Novillos</b></h6>
          <input type="number" min="0" class="form-control sumTotal sumParcial" name="novillos" value="0">
          
        </div>

        <div class="col-md-1">
  
          <h4 style="line-height:35px;"><b>Novillitos</b></h6>
          <input type="number" min="0" class="form-control sumTotal sumParcial" name="novillitos" value="0">
  
        </div>
  
        <div class="col-md-1">
        
          <h4 style="line-height:35px;"><b>Vaquillonas</b></h6>
          <input type="number" min="0" class="form-control sumTotal sumParcial" name="vaquillonas" value="0">
          
        </div>
        
        <div class="col-md-1">
        
          <h4 style="line-height:35px;"><b>Terneras</b></h6>
          <input type="number" min="0" class="form-control sumTotal sumParcial" name="terneras" value="0">
          
        </div>
        
        <div class="col-md-1">

          <h4 style="line-height:35px;"><b>Terneros</b></h6>
          <input type="number" min="0" class="form-control sumTotal sumParcial" name="terneros" value="0">
        
        </div>
        
        <div class="col-md-1">

          <h4 style="line-height:35px;"><b>Parcial</b></h6>        
          <input type="text" class="form-control" id="campoParcial" value="0" disabled>
        
        </div>
        
        <div class="col-md-1">
        
          <h4 style="line-height:35px;"><b>Total</b></h6>
          <input type="text" class="form-control" id="campoTotal" value="0" disabled>
        
        </div>
      
        <div class="col-md-1"></div>

      </div>

      <div class="row">
        
        <div class="col-md-3"></div>
        
        <div class="col-md-1">

          <h4 style="line-height:35px;"><b>B&uacute;f. May.:</b></h4>
          <input type="number" min="0" class="form-control sumTotal" name="bufaloMay" value="0">
        
        </div>
        
        <div class="col-md-1">
          
          <h4 style="line-height:35px;"><b>B&uacute;f. Men.:</b></h4>
          <input type="number" min="0" class="form-control sumTotal" name="bufaloMen" value="0">
        
        </div>
        
        <div class="col-md-1">
        
          <h4 style="line-height:35px;"><b>Caprinos</b>:</h4>
          <input type="number" min="0" class="form-control sumTotal" name="caprinos" value="0">
        
        </div>
        
        <div class="col-md-1">
        
          <h4 style="line-height:35px;"><b>Ovinos</b></h4>
          <input type="number" min="0" class="form-control sumTotal" name="ovinos" value="0">
        
        </div>
        
        <div class="col-md-1">
        
          <h4 style="line-height:35px;"><b>Porcinos</b></h4>
          <input type="number" min="0" class="form-control sumTotal" name="porcinos" value="0">
        
        </div>
        
        <div class="col-md-1">
        
          <h4 style="line-height:35px;"><b>Equinos</b></h4>
          <input type="number" min="0" class="form-control sumTotal" name="equinos" value="0">
        
        </div>
      
      </div>

      <div class="lineaSeparadora"></div>

      <!-- CARBUNCLO / BRUCELOSIS -->
      <div class="row">

        <div class="col-md-4"></div>

        <div class="col-md-2">
        
          <div class="form-group">
              
              <label><b>Carbunclo</b></label>
              
              <div class="row">
              
                <div class="col-md-2">
                
                  <input type="checkbox" class="checkbox" id="vacunoCarbunclo">
                
                </div>

                <div class="col-md-5">
                
                  <input type="number" class="form-control" id="cantidadCarbunclo">
                
                </div>
            
              </div>
            
          </div>

        </div>

        <div class="col-md-2">
          
          <div class="form-group">
              
              <label><b>Brucelosis</b></label>
              
              <div class="row">
              
                <div class="col-md-2">
                
                  <input type="checkbox" class="checkbox" id="vacunoBrucelosis">
                
                </div>

                <div class="col-md-5">
                
                  <input type="number" class="form-control" id="cantidadBrucelosis">
                
                </div>
              
              </div>
            
          </div>
        
        </div>
      
        <div class="col-md-4"></div>

      </div>
      
      <div class="lineaSeparadora"></div>

      <!-- BOTON CARGAR ACTA -->
      <div class="row">

        <div class="col-md-4"></div>
        <div class="col-md-4"><button type="submit" class="btn btn-primary btn-lg btn-block">Cargar Acta</button></div>
        <div class="col-md-4"></div>
      
      </div>

    </form>

  </section>
    
</div>


<!-- MODAL MONTO  -->
<div id="ventanaModalMonto" class="modal fade" role="dialog">
 
 <div class="modal-dialog">

   <div class="modal-content" id="modalPrincipal" style="width:250px;left:200px">


       <!--=====================================
       CABEZA DEL MODAL
       ======================================-->

       <div class="modal-header" style="background:#3c8dbc; color:white">

         <button type="button" class="close" data-dismiss="modal">&times;</button>

         <h4 class="modal-title">Montos</h4>

       </div>
         
             <!--=====================================
             CUERPO DEL MODAL
             ======================================-->
             <div class='modal-body' style='padding-top:0px;margin-top:0px;'>

               <div class='box-body' style='padding-top:0px;margin-top:0px;'>
           
                   <div class='box-header'>
                       
                     <h3>Montos</h3>

                     <div class="form-group">
 
                       <label><b>Redondeo Aftosa:</b></label>
                       
                       <div class="row">
                         
                         <div class="col-xs-7">
                         
                           <input type="number" step="0.01" name="montoRedondeoCar" class="form-control input-xs" value="0">
                         
                         </div>
                       
                       </div>
                     
                     </div>

                     <div class="form-group">
 
                       <label><b>Redondeo Carbunclo:</b></label>
                       
                       <div class="row">
                         
                         <div class="col-xs-7">
                         
                           <input type="number" step="0.01" name="montoRedondeoBru" class="form-control input-xs" value="0">
                         
                         </div>
                       
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

             </div>

   </div>

 </div>

</div>

<!-- MODAL DATOS PRODUCTOR -->
<div id="modalVerProductor" class="modal fade" role="dialog">
  
  <div class="modal-dialog" style="width:1500px;">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Productor/Establecimiento</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <div class="row">

                <div class="col-md-2">
            
                    <div class="form-group">

                        <label>RENSPA</label>
                    
                        <div class="input-group">
                        
                            <span class="input-group-addon"><i class="fa fa-barcode"></i></span> 

                            <input type="hidden" class="form-control input-lg" name="idEdit" id="idEdit">
                            
                            <input type="text" class="form-control input-lg" name="renspaEdit" id="renspaEdit" required>

                        </div>

                    </div>
                
                </div>

                <div class="col-md-3">
            
                    <div class="form-group">

                        <label>Propietario</label>
                    
                        <div class="input-group">
                        
                            <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                            <input type="text" class="form-control input-lg" name="propietarioEdit" id="propietarioEdit" placeholder="Propietario" required>

                        </div>

                    </div>
                
                </div>

                <div class="col-md-3">
            
                    <div class="form-group">

                        <label>Establecimiento</label>

                        <div class="input-group">
                        
                            <span class="input-group-addon"><i class="fa fa-home"></i></span> 

                            <input type="text" class="form-control input-lg" name="establecimientoEdit" id="establecimientoEdit" placeholder="Establecimiento" required>

                        </div>

                    </div>
                
                </div>

                <div class="col-md-2">
            
                    <div class="form-group">

                        <label>Tipo Explotaci&oacute;n</label>
                    
                        <div class="input-group">
                        
                            <span class="input-group-addon"><i class="fa fa-list-ul"></i></span> 

                            <select name="tipoExplotacionEdit" id="tipoExplotacionEdit" id="tipoExplotacion" class="form-control input-lg" required>
                            
                            </select>

                        </div>

                    </div>
                
                </div>

                <div class="col-md-2">
            
                    <div class="form-group">

                        <label>Regimen</label>
                    
                        <div class="input-group">
                        
                            <span class="input-group-addon"><i class="fa fa-list-ul"></i></span> 

                            <select name="regimenEdit" id="regimenEdit" id="regimen" class="form-control input-lg" required>
                            
                            </select>

                        </div>

                    </div>
                
                </div>
            
            </div>

            <div class="row">

                <div class="col-md-2">
            
                    <div class="form-group">

                        <label>Tipo Doc.</label>
                    
                        <div class="input-group">
                        
                            <span class="input-group-addon"><i class="fa fa-address-card"></i></span> 

                            <select name="tipoDocEdit" id="tipoDocEdit" id="tipoDoc" class="form-control input-lg" required>
                            
                            </select>

                        </div>

                    </div>
                
                </div>

                <div class="col-md-3">
            
                    <div class="form-group">

                        <label>N° Documento</label>
                    
                        <div class="input-group">
                        
                            <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                            <input type="text" class="form-control input-lg" name="numDocEdit" id="numDocEdit" placeholder="N° Documento" required>

                        </div>

                    </div>
                
                </div>

                <div class="col-md-3">
            
                    <div class="form-group">

                        <label>IVA</label>
                    
                        <div class="input-group">
                        
                            <span class="input-group-addon"><i class="fa fa-list-ul"></i></span> 

                            <select name="ivaEdit" id="ivaEdit" id="iva" class="form-control input-lg" required>
                            
                            </select>

                        </div>

                    </div>
                
                </div>

                <div class="col-md-2">
            
                    <div class="form-group">

                        <label>Telefono</label>
                    
                        <div class="input-group">
                        
                            <span class="input-group-addon"><i class="fa fa-phone"></i></span> 

                            <input type="text" class="form-control input-lg" name="telefonoEdit" id="telefonoEdit" placeholder="Telefono">

                        </div>

                    </div>
                
                </div>

                <div class="col-md-2">
            
                    <div class="form-group">

                        <label>E-mail</label>
                    
                        <div class="input-group">
                        
                            <span class="input-group-addon"><i class="fa fa-at"></i></span> 

                            <input type="text" class="form-control input-lg" name="mailEdit" id="mailEdit" placeholder="E-mail">

                        </div>

                    </div>
                
                </div>
            
            </div>

            <div class="row">

                <div class="col-md-2">
            
                    <div class="form-group">

                        <label>Domicilio</label>
                    
                        <div class="input-group">
                        
                            <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                            <input type="text" class="form-control input-lg" name="domicilioEdit" id="domicilioEdit" placeholder="Domicilio" required>

                        </div>

                    </div>
                
                </div>

                <div class="col-md-3">
            
                    <div class="form-group">

                        <label>Localidad</label>
                    
                        <div class="input-group">
                        
                            <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                            <input type="text" class="form-control input-lg" name="localidadEdit" id="localidadEdit" placeholder="Localidad" required>

                        </div>

                    </div>
                
                </div>

                <div class="col-md-3">
            
                    <div class="form-group">

                        <label>Provincia</label>
                    
                        <div class="input-group">
                        
                            <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 
                            
                            <input type="text" class="form-control input-lg" name="provinciaEdit" id="provinciaEdit" placeholder="Provincia" required>

                        </div>

                    </div>
                
                </div>

                <div class="col-md-2">
            
                    <div class="form-group">

                        <label>Departamento</label>
                    
                        <div class="input-group">
                        
                            <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                            <input type="text" class="form-control input-lg" name="departamentoEdit" id="departamentoEdit" value="<?php echo $departamento;?>" readonly>

                        </div>

                    </div>
                
                </div>

                <div class="col-md-2">
            
                    <div class="form-group">
    
                        <label>Distrito</label>

                        <div class="input-group">
                        
                            <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 
                            
                            <select name="distritoEdit" id="distritoEdit" id="distrito" class="form-control input-lg" required>
                            
                            </select>

                        </div>

                    </div>
                
                </div>
            
            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="submit" class="btn btn-primary">Guardar cambios</button>

        </div>

      </form>

      <?php

        // $editarProductor = new ControladorProductores();
        // $editarProductor -> ctrEditarProductor();

      ?>

    

    </div>

  </div>

</div>
