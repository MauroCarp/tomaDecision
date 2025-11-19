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
        <div class="col-lg-3">
          <a href="analisisCheck" class="btn btn-primary btn-block" style="background-color:blue">CHECKEADOS</a><br> <br>
        </div>
        <div class="col-lg-3">
          <button id="btnExportAnalisis" class="btn btn-success btn-block">Exportar Excel</button><br> <br>
        </div>
      </div>
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
                          <th style="width:150px;">
                            Sexo
                          </th>
                          <th style="width:150px;">
                            GDP
                          </th>
                          <th style="width:150px;">
                            GDG
                          </th>
  
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
                            <?=$value['sexo']?>
                          </th>
                          <th>
                          </th>
                          <th>
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
  let defColumn = [{'bSorteable':false,'visible':false},{'bSorteable':true},{'bSorteable':false},{'bSorteable':false},{'bSorteable':false},{'bSorteable':false},{'bSorteable':false},{'bSorteable':false}]

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

          let groupData = api.rows({page:'current'}).data().filter(row => row[0] === group);
          let arr = {};

          for (let clave in groupData) {
              if (!isNaN(clave)) {
                arr[clave] = groupData[clave];
              }
          }
          let firstWeight = arr[0][2]

          let adpv = arr[0][5]

          let lastWeight = (arr[Object.keys(arr).length - 1] == undefined) ? firstWeight : arr[Object.keys(arr).length - 1][2]
          let diff = firstWeight - lastWeight
          
          let firstDate = new Date(arr[0][1])

          let lastDate = new Date(arr[Object.keys(arr).length - 1][1])
          let diffDays = Math.ceil((firstDate - lastDate) / (1000 * 60 * 60 * 24));

          let adpvGroup = diff / diffDays

          let regex = /(\d{4})-(\d{2})-(\d{2})/;

          let match = regex.exec(arr[0][1]);

          let fechaFormateada = match[3] + '-' + match[2] + '-' + match[1];


          $(rows).eq(i)[0].children[0].innerText = fechaFormateada
          
          for (let j = 1; j < Object.keys(arr).length; j++) {

              let fechaActual = new Date(arr[j][1]);
            
              let fechaAnterior = new Date(arr[j - 1][1]);

              let pesoActual = arr[j][2]
              let pesoAnterior = arr[j - 1][2]
              let diferenciaPesos = (pesoAnterior - pesoActual)

              let grasaActual = arr[j][3]
              let grasaAnterior = arr[j -1][3]
              let diferenciaGrasa = (grasaAnterior - grasaActual)


               let diferenciaDias = Math.ceil((fechaAnterior - fechaActual) / (1000 * 60 * 60 * 24));
          

              let adpv = (diferenciaDias > 0) ? diferenciaPesos / diferenciaDias : 0
              let gdg = (diferenciaDias > 0) ? diferenciaGrasa / diferenciaDias : 0
              // Puedes modificar los valores de las filas aquí
              // Por ejemplo, para modificar una celda en la columna 3

              let row = $(rows).eq(i + j - 1)
              row[0].children[5].innerText = adpv.toFixed(2)
              row[0].children[6].innerText = gdg.toFixed(2)

              let match = regex.exec(arr[j][1]);
              let fechaFormateada = match[3] + '-' + match[2] + '-' + match[1];


              $(rows).eq(i + j)[0].children[0].innerText = fechaFormateada


              // console.log(row[0].children[4].text(adpv))
          }

          $(rows)
          .eq(i)
          .before(`<tr class="group" style="background-color:#dadada;font-weight:bolder;color:blue;"">

                    <td>
                    
                      RFID: ${group} 
                    </td>
                    <td>
                      Dif. Peso: ${diff}
                    </td>
                    <td colspan="2"> 
                    </td>
                    <td>
                      ${adpvGroup.toFixed(2)}
                    </td> 
                    <td colspan="2">

                      <button class="btn btn-success checkRfid" data-grupo="${group}" style="float:right;margin-left:5px;" rfid="${group}">
                        <i class="fa fa-check"></i>
                      </button>

                      <button class="btn btn-info btnEliminarRfid" data-grupo="${group}" style="float:right;" rfid="${group}">
                        <i class="fa fa-trash"></i>
                      </button>


                    </td>

                  </tr>`)

          // Calcular la diferencia de peso dentro del grupo

          last = group

        }

        return
      })

      $('#table').on('click','.checkRfid',function(){

        let rfid = $(this).attr('rfid');

        let url  = '/fetch/analisis.fetch.php'

        let grupo = $(this).data('grupo');

        let button = $(this)

        $.ajax({

          method:'post',
          url,
          data:{rfid,check:1,accion:'check'},
          beforeSend:function(){
            button.find('i').removeClass('fa-check')
            button.find('i').addClass('fa-spinner')
          },
          success:function(resp){

            const Toast = Swal.mixin({
              toast: true,
              position: "top-end",
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
              didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
                }
            });

            Toast.fire({
              icon: "success",
              title: "Chequeado"
            });
            
            // Eliminar las filas del grupo
            api.rows(function(idx, data, node) {
                console.log(data[0] == grupo)
                return data[0] == grupo;

            }).remove().draw()

            $('#table thead tr th').each(function() {

              $(this).removeClass('sorting')

            });  
          
          }

        })

      })  

      $('.tablaAnalisis').on('click','.btnEliminarRfid',function(){
  
          let rfid = $(this).attr('rfid')

          let grupo = $(this).data('grupo');

          let button = $(this)
          
          new swal({
            title: '¿Eliminar RFID?',
            text: "¡Puede cancelar la accíón!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Si, eliminar registro'
          })
          .then(function(result){

            if(result.value){

              let url = 'fetch/analisis.fetch.php'
              $.ajax({
                  method:'POST',
                  url,
                  data:{accion:'eliminarAnimal',
                        idAnimal:rfid
                      },
                  beforeSend:function(){
                    button.find('i').removeClass('fa-check')
                    button.find('i').addClass('fa-spinner')
                  },
                  success:function(resp){
              
                    if(resp != 'error'){

                              new swal({
                  
                                icon: "success",
                                title: "¡El animal ha sido eliminado correctamente!",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
                  
                              }).then(()=>{
                                api.rows(function(idx, data, node) {
                                    return data[0] == grupo;

                                }).remove().draw()

                                $('#table thead tr th').each(function() {

                                  $(this).removeClass('sorting')

                                });  
                                return

                              });
                  
                      }else{
              
                          new swal({
              
                              icon: "error",
                              title: "¡Hubo un error, el animal no ha sido eliminado!",
                              showConfirmButton: true,
                              confirmButtonText: "Cerrar"
              
                          })
                              
                      }

                  }

              })
            
            }

          });
        })

    }
  });


    
    $('.sorting').each(function(){
  
      $(this).css('cursor','default')
     
    })

    $('#table thead tr th').each(function() {

      $(this).off('click');
      $(this).removeClass('sorting')

    });  

} );


    // Exportación completa a Excel (XLSX) vía servidor
    $(document).on('click','#btnExportAnalisis',function(){
      window.location.href = 'fetch/analisis_export.php'
    })

  </script>
    
  
    </section>
  
  </div>

