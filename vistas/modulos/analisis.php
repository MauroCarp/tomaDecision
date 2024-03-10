  <?php

  if($_SESSION["perfil"] == "Especial"){
  
    echo '<script>
  
      window.location = "inicio";
  
    </script>';
  
    return;
  
  }

  ?>
  
  <div class="content-wrapper">

    <section class="content">

      <div class="row">


        <div class="col-lg-4 col-xs-4">

        <table id="example" class="display" style="width:100%">

          <thead>
            
              <tr>
                  <th>RFID</th>
                  <th>Paso por Balanza</th>
                  <th>mm Grasa</th>
                  <th>Peso</th>
              </tr>

          </thead>
            
          <tbody>

            <?php 

              $animales = ControladorAnalisis::ctrMostrarAnimales();

              foreach ($animales as $key => $value) { ?>
              
              <tr>
                <td><b><?=$value['RFID']?></b></td>
                <td><?=$value['date']?></td>
                <td><?=$value['mmGrasa']?></td>
                <td><?=$value['peso']?></td>
              </tr>

            <?php }

            ?>

          </tbody>

        </table>
        
        </div>

        <div class="col-lg-2 col-xs-12" >

          <form class="form-horizontal">

              <div class="control-group">

                  <label class="control-label" for="dateRange">Rango de Fechas</label>

                  <div class="controls">

                      <input type="text" id="dateRange" name="dateRange">

                  </div>

              </div>
              <hr>
              <div class="control-group">

                  <label class="control-label" for="kgRange">Rango de Kg</label>

                  <div class="controls">

                  <input type="text" class="rangeSlider" id="kgRange" name="kgRange" value="" />
                  </div>

              </div>
              <hr>
              <div class="control-group">

                  <label class="control-label" for="adpvRange">Rango ADPV</label>

                  <div class="controls">

                  <input type="text" class="rangeSlider" id="adpvRange" name="adpvRange" value="" />
                  </div>

              </div>

              </div>

          </form>

        </div>

      
      </div>
  
    </section>
  
  </div>

  <script>

   $(document).ready(function() {

    $(document).ready(function() {
            $('#example').DataTable({
                "columnDefs": [
                    { "visible": false, "targets": 0 }
                ],
                "order": [[ 0, 'asc' ]],
                "rowGroup": {
                    "dataSrc": 0
                },
                "footerCallback": function ( row, data, start, end, display ) {
                  var api = this.api();
                  var columnIdx = 2; // Cambia esto al índice de la columna que quieras sumarizar

                  // Totalizar los valores en la columna especificada
                  var total = api.column(columnIdx, { page: 'current' }).data().reduce(function (a, b) {
                      return parseFloat(a) + parseFloat(b);
                  }, 0);

                  // Agregar la fila de resumen
                  $(api.column(columnIdx).footer()).html('Total: ' + total);
              }
            });
        });

      $('#dateRange').daterangepicker({
          opens: 'left'
      });

      $("#kgRange").ionRangeSlider({
        type: "double",
        min: 150,
        max: 600,
        from: 150,
        to: 600,
        grid: true,
        skin:'big'
      });

      $("#adpvRange").ionRangeSlider({
        type: "double",
        min: 0,
        max: 3,
        from: 0.5,
        to: 1.5,
        grid: true,
        step:0.1,
        skin:'big'
      });

    })      

</script>
