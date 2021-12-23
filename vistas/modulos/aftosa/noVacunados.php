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
      
      Establecimientos NO vacunados

    </h1>

    <ol class="breadcrumb">
      
      <li><a href="estNoVacunados"><li class="active">Establecimientos no vacunados</li></a></li>
      
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-body">
        
        <table class="table table-bordered table-striped dt-responsive tablas tablaNoVacunados" width="100%">
            
            <thead>
            
                <tr>

                    <th>Propietario</th>

                    <th>R.E.N.S.P.A</th>

                    <th>Establecimiento</th>

                    <th>Departamento</th>

                    <th>Distrito</th>

                    <th>Explotacion</th>

                    <th></th>

                </tr> 

            </thead>

        </table>

      </div>

    </div>

  </section>

</div>

<?php

?>


