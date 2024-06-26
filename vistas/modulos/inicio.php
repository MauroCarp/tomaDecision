  <?php

  if($_SESSION["perfil"] == "Especial"){
  
    echo '<script>
  
      window.location = "inicio";
  
    </script>';
  
    return;
  
  }
  $today = date('Y-m-d');

  $tomorrow = date('Y-m-d',strtotime($today."+ 1 days"));

  ?>
  
  <div class="content-wrapper">

    <section class="content">

      <div class="row">

        <div class="col-lg-9 col-xs-12">
        

            <!-- INGRESO ANIMALES -->

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

              <?php
              if($_SESSION['perfil'] == 'Administrador'){
              ?>
                              
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

              <div class="box collapsed-box"  id="seccionClasificacion">
                  
                <div class="box-header with-border">
                  
                  <div class="box-tools pull-right">
                  
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                  
                  </div>

                  <div class="row"  style="font-size:1.3em">
                    
                    <div class="col-md-5">
                      
                      <i class="ion-stats-bars"></i> Clasificaci&oacute;n - <b>Total Gordos: <span id="totalAnimalesGordos"></span> - <b>Total Corral: <span id="totalAnimalesCorral"></span></b>
                      
                    </div>
                    
                    <div class="col-md-2">
                      
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

              <?php

              }

              if($_SESSION['perfil'] == 'Operario'){
                
                include 'vistas/modulos/inicio/carpetasActivasOperario.php';
                
              ?>

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

              <?php
              }
              ?>

        </div>

        <div class="col-lg-3 col-xs-12">

          <?php
            
            include('inicio/animalCargado.php');
            
            if($_SESSION['perfil'] == 'Administrador'){
              
              include 'vistas/modulos/inicio/carpetasActivas.php';
              
              
            }

          ?>
      
          </div>

        </div>
      
      </div>
  
    </section>
  
  </div>

  <?php
    
    include('modales/asignarDestino.php');
  
    $asignarDestino = new ControladorAnimales;
    $asignarDestino-> ctrAsignarDestino();
  ?>