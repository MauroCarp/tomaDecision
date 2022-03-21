  <?php
  

  if($_SESSION["perfil"] == "Especial"){
  
    echo '<script>
  
      window.location = "inicio";
  
    </script>';
  
    return;
  
  }
  
  
  
  $today = date('Y-m-d');
  
  ?>
  
  <div class="content-wrapper">

    <section class="content">

      <div class="row">

        <div class="col-lg-12 col-xs-12">
        
          <div class="row">
            <!-- INGRESO ANIMALES -->
            <div class="col-md-9 col-xs-12">
              
              <div class="box" id="ingresoAnimal">
                  
                  <div class="box-header with-border">
                  
                    <h3 class="box-title"><i class="ion-ios-download-outline"></i> Ingresar Animal</h3>
            
                  </div>
                  
                  <div class="box-body">
                  
                  <?php
                    
                    include "inicio/nuevoAnimal.php";
                  
                  ?>

                  </div>
                
              </div>

                              
              <div class="box" id="tablaIngresos">
                  
                  <div class="box-header with-border">
                  
                    <h3 class="box-title"><i class="ion-ios-list-outline"></i> Animales Ingresados</h3>
            
                  </div>
                  
                  <div class="box-body">

                    <?php
                    
                    include "inicio/ingresos.php";
                  
                    ?>

                  </div>
                
              </div>

            </div>

            <!-- CONFIGURACION EN VIVO -->
            <div class="col-md-3 col-xs-12">

              <div class="box" id="seccionDestino">
                
                <div class="box-header with-border">

                  <h3 class="box-title"><i class="fa fa-sliders"></i>Destino</h3>

                </div>
                
                <div class="box-body">

                  <div class="box box-widget widget-user">

                    <div class="widget-user-header bg-aqua-active" style="text-align:center;">                                                                         

                      <h1 class="widget-user-username" id="detino" style="font-size:4em;font-weight:bolder;line-height:80%;">DESTINO</h1>

                    </div>

                    <div class="box-footer">

                      <div class="row">

                        <div class="col-sm-4 border-right">

                          <div class="description-block">

                            <h5 class="description-header" style="font-size:2.5em;">22656</h5>

                            <span class="description-text">RFID</span>

                          </div>

                        </div>

                        <div class="col-sm-4 border-right">

                          <div class="description-block">

                          <h5 class="description-header" style="font-size:2.5em;">B+</h5>

                            <span class="description-text">CLAS</span>

                          </div>

                        </div>

                        <div class="col-sm-4">

                          <div class="description-block">

                            <h5 class="description-header" style="font-size:2.5em;">335</h5>

                            <span class="description-text">PESO</span>

                          </div>



                        </div>

                      </div>

                    </div>

                  </div>

                </div>

              </div>

            </div>

          </div>

        </div>

        <div class="col-lg-12 col-xs-12">

          <div class="row">
            <!-- CLASIFICACION -->
            <div class="col-md-9 col-xs-12">

              <div class="box"  id="seccionClasificacion">
                  
                <div class="box-header with-border">
                  
                  <div class="row"  style="font-size:1.3em">
                    
                    <div class="col-md-3">
                      
                      <i class="ion-stats-bars"></i> Clasificaci&oacute;n - <b>Total animales: <span id="totalAnimales"></span></b>
                      
                    </div>
                    
                    <div class="col-md-1">
                      
                    <b> |  </b><i class="ion-stats-bars"></i><b> Perfil: </b>
                      
                    </div>
                    
                    <div class="col-md-2">
                      
                      <select class="form-control input-md" id="perfilesClasificacion">
                        
                        </select>
                        
                    
                    </div>
                  
                  </div>

                </div>
                
                <div class="box-body">
                
                <?php
                  
                  include "inicio/clasificacion.php";
                
                ?>

                </div>

              </div>

            </div>

            <!-- CARPETAS ACTIVAS -->
            <div class="col-md-3 col-xs-12">

              <?php 

                include 'vistas/modulos/inicio/carpetasActivas.php';

              ?>

            </div>
          
          </div>

        </div>
      
      </div>
  
    </section>
  
  </div>