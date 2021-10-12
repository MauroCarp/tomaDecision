<?php

if($_SESSION["perfil"] == "Especial"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

?>

<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Brucelosis / Tuberculosis - Pendientes
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Brucelosis / Tuberculosis - Pendientes</li>
    
    </ol>

  </section>
  
  <section class="content">
   
    <div class="box">
  
      <div class="box-body">

          
          <button class="btn btn-primary" id="btnEnviarSenasa">Enviar a Senasa</button>
       

        <hr>
        <table class="table table-bordered table-striped dt-responsive tablas tablaPendientes" width="100%">
          
          <thead>
          
          <tr>
            
            <th>Renspa</th>
            <th>Establecimiento</th>
            <th>Protocolo</th>
            <th>Campa&ntilde;a</th>
            <th>Fecha Cargado</th>
            <th>Fecha Muestra</th>
            
          </tr> 
  
          </thead>      
  
          <tbody>
  
          <?php
  
            $respuesta = ControladorBruTur::ctrMostrarPendientes('brucelosis');

            if(!empty($respuesta)){
             
              for ($i=0; $i < sizeof($respuesta) ; $i++) { 
              
                echo "            
                <tr>
    
                  <td>".$respuesta[$i]['renspa']."</td>
                  
                  <td>".$respuesta[$i]['establecimiento']."</td>
                  
                  <td>".$respuesta[$i]['protocolo']."</td>
                  
                  <td>Brucelosis</td>
                  
                  <td>".formatearFecha($respuesta[$i]['fechaCarga'])."</td>
                  
                  <td>".formatearFecha($respuesta[$i]['fechaEstado'])."</td>
                  
                </tr>";
    
              }
    
            }
           
            $respuesta = ControladorBruTur::ctrMostrarPendientes('tuberculosis');
            if(!empty($respuesta)){

              for ($i=0; $i < sizeof($respuesta) ; $i++) { 
                              
                echo "            
                <tr>
    
                  <td>".$respuesta[$i]['renspa']."</td>
                  
                  <td>".$respuesta[$i]['establecimiento']."</td>
                  
                  <td>".$respuesta[$i]['protocolo']."</td>
                  
                  <td>Tuberculosis</td>
                  
                  <td>".formatearFecha($respuesta[$i]['fechaCarga'])."</td>
                  
                  <td>".formatearFecha($respuesta[$i]['fechaEstado'])."</td>
                  
                </tr>";
                
              }

            }
          ?>
          
          </tbody>

        </table>


      </div>
  
    </div>
  
  </section>

</div>