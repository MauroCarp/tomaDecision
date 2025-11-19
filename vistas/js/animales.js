/*=============================================
	DATATABLE ANIMALES
	=============================================*/
//   $.ajax({

// 	url: "fetch/datatable-ingresos.fetch.php",
// 	success:function(respuesta){
		
// 		console.log("respuesta", respuesta);

// 	}

// });

const labelClasificacion = (clas)=>{

  let text, color
  let style = ''

  switch (clas) {

    case 'F':
      text = 'Flaca';
      color = 'danger';
      break;
    
    case 'G':
      text = 'Gorda';
      color = 'danger';
      break;

      
    case 'B':
      color = 'success';
      text = 'Buena';
      style = 'background-color: rgb(137 221 113);';
      break;
      
    case 'B+':
      color = 'success';
      text = 'Buena+';
      break;
        
    case 'MB':
      color = 'success';
      text = 'Muy Buena';
      break;

    case 'AP':
      text = 'Apenas Gorda';
      color = 'warning';
      break;
  
    default:
      break;
  }

  let label = document.createElement('SPAN')
  label.setAttribute('class',`label label-${color}`)
  label.setAttribute('style',style)
  label.innerText = text

  return label

}

const cargarAnimalesSD = ()=>{
  
  document.getElementById('animalesList').style.width = '900px'

  let perfil = document.getElementById('perfilSD').value

  let url = 'fetch/animales.fetch.php'

  let data = new FormData()
  data.append('accion','animalesSD')
  data.append('perfil',perfil)

  fetch(url,{
    method:'post',
    body:data
  })
  .then(resp=>(resp.json()))
  .then(respuesta=>{
    
    console.log(respuesta);

    document.getElementById('animalesSDList').innerText = ''

    let docFragment = document.createDocumentFragment()

    respuesta.map(reg=>{

      let row = document.createElement('DIV')
      row.setAttribute('class','row')
      row.setAttribute('style','margin-bottom:1px;padding:5px 0;border-bottom:1px solid #E1E1E1')
      
      let rfidDiv = document.createElement('DIV')
      rfidDiv.setAttribute('class','col-lg-2')

      let mmGrasaDiv = rfidDiv.cloneNode(true)
      mmGrasaDiv.innerText = reg.mmGrasa + ' mm'

      let pesoDiv = rfidDiv.cloneNode(true)
      pesoDiv.innerText = reg.peso + ' kg'

      let sexoDiv = rfidDiv.cloneNode(true)
      sexoDiv.innerText = (reg.sexo == 'M') ? 'Macho' : 'Hembra'

      let destinoDiv = rfidDiv.cloneNode(true)

      let selectDestino = document.createElement('SELECT')
      selectDestino.setAttribute('name',`${reg.idAnimal}-${reg.sexo}-${reg.tas3}`)
      selectDestino.setAttribute('class',`selectCarpetasActivas`)
      
      destinoDiv.appendChild(selectDestino)

      rfid.innerText = reg.RFID

      let clasifDiv = document.createElement('DIV')
      clasifDiv.setAttribute('class','col-lg-2')
      clasifDiv.appendChild(labelClasificacion(reg.clasificacion))  
          
      row.appendChild(rfidDiv)
      row.appendChild(mmGrasaDiv)
      row.appendChild(pesoDiv)
      row.appendChild(sexoDiv)
      row.appendChild(destinoDiv)
      row.appendChild(clasifDiv)

      docFragment.appendChild(row)

    })

    document.getElementById('animalesSDList').appendChild(docFragment)

    selectCarpetas()

  })
  .catch(err=>console.log(err))

}


$('.tablaIngresos').DataTable( {
  "ajax": "fetch/datatable-ingresos.fetch.php",
  "bSort" : false,
  "deferRender": true,
  "retrieve": true,
  "processing": true,
	"ordering": false,
  "searching": false,
  "info":     false,
  "bLengthChange": false,
  "pageLength": 5,
  
  "language": {

      "sProcessing":     "Procesando...",
      "sLengthMenu":     "Mostrar _MENU_ registros",
      "sZeroRecords":    "No se encontraron resultados",
      "sEmptyTable":     "Ningún dato disponible en esta tabla",
      "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
      "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
      "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
      "sInfoPostFix":    "",
      "sSearch":         "Buscar:",
      "sUrl":            "",
      "sInfoThousands":  ",",
      "sLoadingRecords": "Cargando...",
      "oPaginate": {
      "sFirst":    "Primero",
      "sLast":     "Último",
      "sNext":     "Siguiente",
      "sPrevious": "Anterior"
      }

}

} );

/*=============================================
	NUEVO ANIMAL
	=============================================*/

    const formNuevoAnimal = document.getElementById('formNuevoAnimal')

    if(formNuevoAnimal != null){
      
      formNuevoAnimal.addEventListener('submit',(e)=>{

          e.preventDefault();

          document.querySelector('button[name="nuevoAnimal"]').setAttribute('disabled','disabled')
          document.querySelector('button[name="nuevoAnimal"]').innerText = 'Cargando'

          let rfid = document.getElementById('rfid').value
          let mmGrasa = document.getElementById('mmGrasa').value
          let peso = document.getElementById('peso').value
          let sexo = document.querySelector('input[name="sexo"]:checked').value
          let refEco = document.getElementById('refEco').value
          let aob = document.getElementById('aob').value

          let validacion = [mmGrasa,peso]

          if(validacion.includes('')){
              
              const swalWithBootstrapButtons = Swal.mixin({
                  customClass: {
                    successlButtonText: 'btn btn-success',
                  },
                  buttonsStyling: false
                })
                
                swalWithBootstrapButtons.fire({
                  title: 'Hay campos que no pueden ir vacios.',
                  icon: 'warning',
                  reverseButtons: true
                })

                document.querySelector('button[name="nuevoAnimal"]').removeAttribute('disabled')
                document.querySelector('button[name="nuevoAnimal"]').innerText = 'Cargar'

                return

          }
          
          let url = 'fetch/animales.fetch.php'

          let data = new FormData()
          data.append('accion','nuevo')
          data.append('rfid',rfid)
          data.append('mmGrasa',mmGrasa)
          data.append('peso',peso)
          data.append('sexo',sexo)
          data.append('refEco',refEco)
          data.append('aob',aob)

          fetch(url,{
              method:'post',
              body:data
          })

          .then(resp=>resp.json())
          .then(respuesta=> {

            let Toast =  swal.mixin({
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 3000
              });
              
              if(respuesta?.status == 'ok'){

                    Toast.fire({

                      icon: 'success',
                      title: 'Animal Ingresado'

                  })
                  
                  
                  $('.tablaIngresos').DataTable().ajax.reload();


                  $('#rfid').focus()
                  document.getElementById('rfid').value = ''
                  document.getElementById('mmGrasa').value = ''
                  document.getElementById('peso').value = ''
                  document.getElementById('aob').value = ''
                  document.getElementById('refEco').value = ''

                  if(document.getElementById('seccionClasificacion') != null){

                    let idPerfil = document.getElementById('perfilesClasificacion').value

                    actualizarClasificacion(idPerfil)
                  
                  }

                  let idSeccionCarpetas = 'carpetasScrollOperario'

                  let operarioValido = true

                  if(document.getElementById('seccionCarpetaAct') != null){

                    idSeccionCarpetas =  'carpetasScroll' 

                    operarioValido = false

                  } 

                  document.getElementById(idSeccionCarpetas).firstElementChild.firstElementChild.innerHTML = ''
                  
                  mostrarCarpetasActivas(operarioValido)

                  document.getElementById('destinoAnimal').innerText = respuesta.descripcion
                  document.getElementById('clasificacionAnimal').innerText = respuesta.clasificacion
                  document.getElementById('rfidAnimal').innerText = respuesta.rfid
                  document.getElementById('pesoAnimal').innerText = respuesta.peso

                  document.querySelector('button[name="nuevoAnimal"]').removeAttribute('disabled')
                  document.querySelector('button[name="nuevoAnimal"]').innerText = 'Cargar'

                
              }else{            
                  
                if(respuesta?.motivo == 'noCarpeta'){

                  new swal({

                      icon: "error",
                      title: "No hay ninguna carpeta ACTIVA",
                      showConfirmButton: true,
                      confirmButtonText: "Cerrar"

                  })

                }else{

                    Toast.fire({

                      icon: 'error',
                      title:'Hubo un error al cargar el animal'

                  })

                }

                document.querySelector('button[name="nuevoAnimal"]').removeAttribute('disabled')
                document.querySelector('button[name="nuevoAnimal"]').innerText = 'Cargar'


              }

          })
          .catch(err=>console.log(err))
          
      })


      /*=============================================
        CARGAR ANIMALES SD
      =============================================*/  

      let params = {
        fetchUrl:'cargarSelect',
        accion:'perfiles',
        value:'nombre',
        optText:'nombre',
        idSelect:'perfilSD'
      }

      cargarSelect(params)

      document.getElementById('perfilSD').addEventListener('change',()=>cargarAnimalesSD())
      
    }

/*=============================================
	ELIMINAR ANIMAL
	=============================================*/

  $('.tablaIngresos').on('click','.btnEliminarAnimal',function(){

    let id = $(this).attr('idanimal')

    new swal({
      title: '¿Eliminar Animal?',
      text: "¡Puede cancelar la accíón!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          cancelButtonText: 'Cancelar',
          confirmButtonText: 'Si, eliminar animal!'
    })
    .then(function(result){

      if(result.value){

        let url = 'fetch/animales.fetch.php'

        let data = new FormData()
        data.append('accion','eliminarAnimal')
        data.append('idAnimal',id)

        fetch(url,{
          method:'post',
          body:data
        })
        .then(resp=>resp.json())
        .then(respuesta=>{
           
          if(respuesta.eliminar != 'error' && respuesta.restar != 'error'){

            new swal({

              icon: "success",
              title: "¡El animal ha sido eliminado correctamente!",
              showConfirmButton: true,
              confirmButtonText: "Cerrar"

            }).then(()=>{

              $('.tablaIngresos').DataTable().ajax.reload();

              let idPerfil = document.getElementById('perfilesClasificacion').value
              
              actualizarClasificacion(idPerfil)

              let idSeccionCarpetas = 'carpetasScrollOperario'

              let operarioValido = true

              if(document.getElementById('seccionCarpetaAct') != null){

                idSeccionCarpetas =  'carpetasScroll' 

                operarioValido = false

              } 

              document.getElementById(idSeccionCarpetas).firstElementChild.firstElementChild.innerHTML = ''
              
              mostrarCarpetasActivas(operarioValido)

            });

          }else{

            new swal({

              icon: "error",
              title: "¡Hubo un error, el animal no ha sido eliminado!",
              showConfirmButton: true,
              confirmButtonText: "Cerrar"

            })

          }
        
        })

        .catch(err=>console.log(err))

          // eliminar Animal y restar uno a la correspondiente carpeta

      }

    });
  })
  

