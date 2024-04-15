$('.tablaAnalisis').on('click','.btnEliminarRegistro',function(){
  
    let idRfid = $(this).attr('idRfid')

    let row = $(this).parent().parent()

    new swal({
      title: '¿Eliminar Registro?',
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

        let url = 'fetch/animales.fetch.php'

        let data = new FormData()
        data.append('accion','eliminarAnimal')
        data.append('idAnimal',idRfid)
        data.append('analisis',true)
        $.ajax({
            method:'POST',
            url,
            data:{accion:'eliminarAnimal',
                  idAnimal:idRfid,
                analisis:true},
            success:function(resp){

                if(resp != 'error'){

                        new swal({
            
                          icon: "success",
                          title: "¡El animal ha sido eliminado correctamente!",
                          showConfirmButton: true,
                          confirmButtonText: "Cerrar"
            
                        }).then(()=>{
                            row.remove()
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
        // fetch(url,{
        //   method:'post',
        //   body:data
        // })
        // .then(resp=>resp.json())
        // .then(respuesta=>{
           
        //   if(respuesta != 'error'){

        //     new swal({

        //       icon: "success",
        //       title: "¡El animal ha sido eliminado correctamente!",
        //       showConfirmButton: true,
        //       confirmButtonText: "Cerrar"

        //     }).then(()=>{
        //         row.delete()
        //     });

        //   }else{

        //     new swal({

        //       icon: "error",
        //       title: "¡Hubo un error, el animal no ha sido eliminado!",
        //       showConfirmButton: true,
        //       confirmButtonText: "Cerrar"

        //     })

        //   }
        
        // })

        // .catch(err=>console.log(err))

          // eliminar Animal y restar uno a la correspondiente carpeta

      }

    });
})