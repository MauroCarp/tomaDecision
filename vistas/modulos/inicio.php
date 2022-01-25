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
  
    <section class="content-header">
      
      <h1>
        
        Panel Principal

      </h1>
  
      <ol class="breadcrumb">
        
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Panel Principal</a></li>
              
      </ol>
  
    </section>
  
    <section class="content">

      <div class="row">

        <div class="col-lg-12 col-xs-12">
        
          <div class="row">
  
            <div class="col-md-10 col-xs-12" id="sectionAnimales">
              
              <div class="box">
                  
                  <div class="box-header with-border">
                  
                    <h3 class="box-title"><i class="ion-ios-download-outline"></i> Ingresar Animal</h3>
            
                  </div>
                  
                  <div class="box-body">
                  
                  <?php
                    
                    include "inicio/nuevoAnimal.php";
                  
                  ?>

                  </div>
                
              </div>

                              
              <div class="box">
                  
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

            <div class="col-md-2 col-xs-12">

              <?php 

                include 'vistas/modulos/inicio/carpetasActivas.php';

              ?>

            </div>

          </div>

        </div>

          <div class="row">
  
            <div class="col-md-10 col-xs-12">

              <div class="row">
    
                <div class="col-md-7 col-xs-12">
                    
                  <div class="box">
                      
                    
                    <div class="box-header with-border">

                      <h3 class="box-title"><i class="ion-stats-bars"></i> Clasificaci&oacute;n - <b>Total animales: 6 </b></h3>
                      <select class="form-control">
                        <option>Perfil 1</option>
                        <option>Perfil 2</option>
                        <option>Perfil 3</option>
                        <option>Perfil 4</option>
                        <option>Perfil 5</option>
                      </select>

                    </div>
                    
                    <div class="box-body">
                    
                    <?php
                      
                      include "inicio/clasificacion.php";
                    
                    ?>

                    </div>

                  </div>

                </div>
                
                <div class="col-md-5 col-xs-12">
                    
                  <div class="box">
                      
                      <div class="box-header with-border">
                      
                        <h3 class="box-title">
                          <i class="fa fa-pie-chart"></i>
                          <i class="fa fa-percent"></i>
                      </h3>
                
                      </div>
                      
                      <div class="box-body">

                      <?php
                      
                        include "inicio/grafico.php";
                      
                      ?>

                      </div>
                    
                  </div>

                </div>

              </div>  

            </div>

            <div class="col-md-2 col-xs-12">
            </div>
          
          </div>

        </div>
      
      </div>
        


      </div>
  
    </section>
  
  </div>