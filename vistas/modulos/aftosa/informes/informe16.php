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
       
        Cronograma Actual por Vacunador
        
    </h1>

    <?php 

        $item = 'matricula';

        $matricula = $_GET['matricula'];
        
        $veterinario = ControladorVeterinarios::ctrMostrarVeterinarios($item,$matricula);

    ?>
    <h3>
        
        Vacunador: <?php echo $veterinario['nombre'];?>
    
    </h3>

    <ol class="breadcrumb">
      
    <li><a href="informes"><i class="fa fa-dashboard"></i>Informes</a></li>
      
      <li class="active">Cronograma Actual por Vacunador</li>
      
    </ol>

    <div class="box-header with-border">

      <div class="box-tools pull-right">
        
        <a href="extensiones/fpdf/informesPdf.php?informe=informe16&matricula=<?php echo $matricula;?>">
        
          <button class="btn btn-success" style="margin-top:5px"><b>Imprimir Cronograma</b></button>

        </a>

        <a href="vistas/modulos/excelVeterinarios.php">
        
          <button class="btn btn-success" style="margin-top:5px"><b>Enviar por E-mail</b></button>

        </a>

      </div>
        
    </div>

  </section>

  <br>

  <section class="content">

    <div class="box">

      <div class="box-body">
        
        <table class="table table-bordered table-striped dt-responsive tablas tablaNoVacunados" width="100%">
            
            <thead>
            
                <tr>

                  <th>Renspa</th>
                  
                  <th>Nombre/Apellido</th>
                  
                  <th>Parcial</th>
                  
                  <th>Total</th>
                  
                </tr> 

            </thead>

            <tbody>

            <?php

              // MOSTRAR LOS LOS ANIMALES A VACUNAR

              
            $item2 =  'campania';
		
            $valor2 = $_COOKIE['campania'];
                    
            $animalesCronograma = ControladorAnimales::ctrMostrarAnimales(null,null,$item2,$valor2);

            foreach ($animalesCronograma as $key => $value) {

                $parcial = $value['terneros'] + $value['terneras'] + $value['novillos'] + $value['novillitos'] + $value['toritos'] + $value['vaquillonas'];

                $totalAnimales = $parcial + $value['vacas'] + $value['toros'];

                $item = 'renspa';

                $propietario = ControladorProductores::ctrMostrarProductores($item,$value['renspa']);

                echo "
                <tr>
                <td>".$value['renspa']."</td>
                <td>".$propietario['propietario']."</td>
                <td>".$parcial."</td>
                <td>".$totalAnimales."</td>
                </tr>
                ";

              }

            ?>

            </tbody>

        </table>

      </div>

    </div>

  </section>

</div>

<?php

?>


