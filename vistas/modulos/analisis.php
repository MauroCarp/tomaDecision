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
        
        <div class="col-lg-6">

          <div class="card">

              <table class="table table-hover table-bordered table-lg tablaAnalisis" id="table">
                  <thead>
                      <tr>
                          <th>
                              RFID
                          </th>
                          <th style="width:150px;">
                            Paso por balanza
                          </th>
                          <th style="width:150px;">
                            Peso
                          </th>
                          <th style="width:150px;">
                            mm Grasa
                          </th>
                          <!-- <th style="width:150px;">
                              ADPV
                          </th>
                        -->
                          <th></th>
                      </tr>
                  </thead>

                  <tbody>

                    <?php

                      $animales = ControladorAnalisis::ctrMostrarAnimales();
 
                      foreach ($animales as $key => $value) { ?>
                        <tr style="font-weight:lighter">
                          <th>
                            <?=$value['RFID']?>
                          </th>
                          <th>
                            <?=$value['date']?>
                          </th>
                          <th>
                            <?=$value['peso']?>  
                          </th>
                          <th>
                            <?=$value['mmGrasa']?>
                          </th>
                          <th>
                            <button type="button" class="btn btn-danger btnEliminarRegistro" idRfid="<?=$value['idAnimal']?>"><i class="fa fa-trash"></i></button>
                          </th> 
                      </tr>

                    <?php  }
                    ?>

                  </tbody>

              </table>

          </div>

        </div>
      
      </div>

    </section>

  </div>
</body>


  <script>

$(document).ready(function() {
  let defColumn = [{'bSorteable':false,'visible':false},{'bSorteable':true},{'bSorteable':false},{'bSorteable':false},{'bSorteable':false}]
            $('#table').DataTable({
              'columns':defColumn,
              'order':[[0,'desc']],
              'displayLength':25,
              drawCallback:function(settings){
                let api =this.api()
                let rows =  api.rows({page:'current'}).nodes()
                let last = null

                api
                .column(0,{page:'current'})
                .data()
                .each(function(group,i){
                  if(last != group){
                    $(rows)
                    .eq(i)
                    .before(`<tr class="group" style="background-color:#dadada"><td colspan="5" style="font-weight:bolder;color:blue;">${group} <button class="btn btn-info btnEliminarRfid" style="float:right;" rfid="${group}"><i class="fa fa-trash"></i></button></td></tr>`)
                    last = group
                  }
                })

              }
            });
        });


    // $(document).ready(function () {

    //     var collapsedGroups = {};
    //     $('#table').DataTable()

    //     var table = $('#report-table').DataTable({
    //         orderFixed: [[2, 'desc'], [3, 'desc']],
    //         columnDefs: [{
    //             targets: [0],
    //             visible: false
    //         }],
    //         rowGroup: {
    //             dataSrc: [0],
    //             startRender: function (rows, group, level) {

    //               let countRows = 0;

    //               let pesoAvg = rows
    //                 .data()
    //                 .pluck(2)
    //                 .reduce(function (a, b) {

    //                   countRows++

    //                   return parseFloat(a) + parseFloat(b);

    //               }, 0);
                    
    //               var mmGrasaAvg = rows
    //                 .data()
    //                 .pluck(3)
    //                 .reduce(function (a, b) {

    //                   return parseFloat(a) + parseFloat(b);

    //               }, 0);

    //               let totalRows = rows.data().pluck(1).length

    //               let firstDate = moment(rows.data().pluck(1)[0],'DD-MM-YYYY')
    //               let lastDate = moment(rows.data().pluck(1)[totalRows - 1],'DD-MM-YYYY')

    //               let fechasIguales = (firstDate['_i'] == lastDate['_i']) ? true : false

    //               let diffDays = (fechasIguales) ? 1 : lastDate.diff(firstDate,'days')
                  
    //               let firstWeight = rows.data().pluck(2)[0]
    //               let lastWeight = rows.data().pluck(2)[totalRows - 1]

    //               let diffWeight = lastWeight - firstWeight

    //               let adpv = diffWeight / diffDays

    //               pesoAvg = (pesoAvg / countRows).toFixed(2)
    //               mmGrasaAvg = (mmGrasaAvg / countRows).toFixed(2)

    //               var all;

    //               if (level === 0) {
    //                   top = group;
    //                   all = group;
    //               } else if (level === 1) {
    //                   parent = top + group;
    //                   all = parent;
    //                   // if parent collapsed, nothing to do
    //                   if (!collapsedGroups[top]) {
    //                       return;
    //                   }
    //               } else {
    //                   // if parent collapsed, nothing to do
    //                   if (!collapsedGroups[parent]) {
    //                       return;
    //                   }
    //                   all = top + parent + group;
    //               }

    //               var collapsed = !collapsedGroups[all];

    //               rows.nodes().each(function (r) {
    //                   r.style.display = collapsed ? 'none' : '';
    //               });

    //               return $('<tr style="font-weight:bold"/>')
    //                   .append(`<td>${group}</td>
    //                             <td>${pesoAvg}</td>
    //                             <td>${mmGrasaAvg}</td>
    //                             <td>${adpv.toFixed(1)}</td>`)
    //                   .attr('data-name', all).toggleClass('collapsed', collapsed);

    //             }
    //         },
    //         paging: true,
    //         responsive: false,
    //         ordering: false,
    //         pageLength: 25,
    //         language: {

    //           sProcessing:     "Procesando...",
    //           sLengthMenu:     "Mostrar _MENU_ registros",
    //           sZeroRecords:    "No se encontraron resultados",
    //           sEmptyTable:     "Ningún dato disponible en esta tabla",
    //           sInfo:           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
    //           sInfoEmpty:      "Mostrando registros del 0 al 0 de un total de 0",
    //           sInfoFiltered:   "(filtrado de un total de _MAX_ registros)",
    //           sInfoPostFix:    "",
    //           sSearch:         "Buscar:",
    //           sUrl:            "",
    //           sInfoThousands:  ",",
    //           sLoadingRecords: "Cargando...",
    //           oPaginate: {
    //           sFirst:    "Primero",
    //           sLast:     "Último",
    //           sNext:     "Siguiente",
    //           sPrevious: "Anterior"
    //           }
    //         }

    //     });

    //     $('#report-table tbody').on('click', 'tr.dtrg-start', function () {
    //         var name = $(this).data('name');
    //         collapsedGroups[name] = !collapsedGroups[name];
    //         table.draw(false);
    //     });

    // });
    
    
  </script>
    
  
    </section>
  
  </div>

  <!-- <script>

   $(document).ready(function() {

      $('#example').DataTable({
          // "columnDefs": [
          //     { "visible": false, "targets": 0 }
          // ],
          // "order": [[ 0, 'asc' ]],
          "rowGroup": {
              "dataSrc":'RFID'
          },
          startRender: function(rows, group) {
          // Función de devolución de llamada para iniciar el renderizado del grupo de filas
          return $('<tr/>')
              .append('<td colspan="6">' + group + ' - Total: ' + rows.count() + '</td>');
          },
          endRender: function(group, collapsed, rows) {
              // Función de devolución de llamada para realizar acciones después de renderizar el grupo de filas
              console.log("Renderizado del grupo de filas completado:", group);
          }
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

</script> -->
