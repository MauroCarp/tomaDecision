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
      
        Actas por Productor

    </h1>

    <ol class="breadcrumb">
      
      <li><a href="recepcion"><i class="fa fa-dashboard"></i>Actas</a></li>
      
      <li class="active">Actas por Productor</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

        <div class="box-header with-border">

            <div class="row">

                    <div class="col-lg-12">
                    
                    <h1>Actas por Productor<h1>
                    
                    </div>
            
            </div>

            <div class="row">

                    <div class="col-lg-12">
                    
                    <h3>Propietario: <span id="dataPropietarioActas"></span><h3>
                    
                    </div>
            
            </div>
            
        </div>

    </div>

    <div class="box-body">
        
      <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
        
        <thead>
        
            <tr>

                <th>Fecha Vacunaci&oacute;n</th>

                <th>Fecha Recepci&oacute;n</th>

                <th>Vacunador</th>
                
                <th>Vacunas Suministradas</th>

                <th>Marca Vacuna</th>
                
                <th>Acta</th>
                
                <th>Pago</th>
                
                <th></th>

            </tr> 

        </thead>

        <tbody id="tablaActasProductores">
 
        </tbody>

      </table>

    </div>  

  </section>

</div>
