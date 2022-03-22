/*=============================================
	DATATABLE ANIMALES
	=============================================*/
//   $.ajax({

// 	url: "fetch/datatable-ingresos.fetch.php",
// 	success:function(respuesta){
		
// 		console.log("respuesta", respuesta);

// 	}

// });


$('.tablaIngresos').DataTable( {
  "ajax": "fetch/datatable-ingresos.fetch.php",
  "deferRender": true,
  "retrieve": true,
  "processing": true,
	"ordering": false,
  "searching": false,
  "info":     false,
  "bLengthChange": false,
  "pageLength": 5,
  // "order": [[ 0, "desc" ]],
  
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

    formNuevoAnimal.addEventListener('submit',(e)=>{

        e.preventDefault();

        let rfid = document.getElementById('rfid').value
        let mmGrasa = document.getElementById('mmGrasa').value
        let peso = document.getElementById('peso').value
        let sexo = document.querySelector('input[name="sexo"]:checked').value
        let refEco = document.getElementById('refEco').value

        let validacion = [rfid,mmGrasa,peso]

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

            if(respuesta.status == 'ok'){

                  Toast.fire({

                    icon: 'success',
                    title: 'Animal Ingresado'

                })

                
                $('.tablaIngresos').DataTable().ajax.reload();


                $('#rfid').focus()
                document.getElementById('rfid').value = ''
                document.getElementById('mmGrasa').value = ''
                document.getElementById('peso').value = ''
                document.getElementById('refEco').value = ''

                let idPerfil = document.getElementById('perfilesClasificacion').value
            
                actualizarClasificacion(idPerfil)

                document.getElementById('carpetasScroll').firstElementChild.firstElementChild.innerHTML = ''
                
                mostrarCarpetasActivas()

                document.getElementById('destinoAnimal').innerText = respuesta.carpeta
                document.getElementById('clasificacionAnimal').innerText = respuesta.clasificacion
                document.getElementById('rfidAnimal').innerText = respuesta.rfid
                document.getElementById('pesoAnimal').innerText = respuesta.peso

              
            }else{            
                
                  Toast.fire({

                    icon: 'error',
                    title: 'Hubo un error al cargar el animal.'

                })


            }

        })
        .catch(err=>console.log(err))


        // console.log(e);
        
    })