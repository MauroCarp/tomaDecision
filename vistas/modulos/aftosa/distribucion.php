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
      
      Distribuci&oacute;n de Vacunas

    </h1>

    <ol class="breadcrumb">
      
      <li><a href="recepcion"><i class="fa fa-dashboard"></i>Vacunas</a></li>
      
      <li class="active">Distribuci&oacute;n</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

        <div class="box-header with-border">

          <div class="row">

            <div class="col-lg-2">
            
              <div class="form-group">

                <label>Seleccionar Vacunador</label>

                <select name="vacunadorDistri" id="vacunadorDistri" class="form-control">
                
                  <option value="">Seleccionar Vacunador</option>
               
                </select>

              </div>
            
            </div>
            
            <div class="col-lg-1">

              <div class="form-group">
      
                  <br>

                  <div class="btn-group" style="margin-top:5px">
      
                      <button class="btn btn-success" id="cargarDistribuciones"><i class="fa fa-check"></i></button>
      
                  </div>  
      
              </div>

            </div>

          </div>
          
        </div>

    </div>

    <div class="box-body">
        
      <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
        
        <thead>
        
            <tr>

                <th>Matricula</th>

                <th>U.E.L</th>

                <th>Marca</th>
                
                <th>Cantidad</th>

                <th>Fecha Entrega</th>

                <th></th>

            </tr> 

        </thead>

        <tbody id="tablaDistribucion">
 
        </tbody>

      </table>

    </div>  

  </section>

</div>

<?php

// $item = 'matricula';

// $valor = '2-1156';

// $item2 = 'campania';

// $valor2 = $_COOKIE['campania'];

// $respuesta = ControladorAftosa::ctrMostrarDistribucion($item,$valor,$item2,$valor2);

// $eliminarDistribucion = new ControladorAftosa();
// $eliminarDistribucion -> ctrEliminarDistribucion();

?>


