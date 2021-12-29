

/*=============================================
ACTAS
=============================================*/

// FUNCION SUMAR ANIMALES

const sumaParcialTotal = (tipoSuma)=>{

    let cantidades = document.getElementsByClassName(tipoSuma)

    let total = 0;

    for (const cantidad of cantidades) {

        total += Number(cantidad.value)
        
    }

    return total

}

if(seccionURL == 'aftosa/acta'){

    // SUMAR TOTALES Y PARCIALES

    let cantidadesTotal = document.getElementsByClassName('sumTotal')

    for (const cantidad of cantidadesTotal) {
        
        cantidad.addEventListener('change',()=>{

            document.getElementById('campoTotal').value = sumaParcialTotal('sumTotal')

        })  
              
    }

    let cantidadesParcial = document.getElementsByClassName('sumParcial')

    for (const cantidad of cantidadesParcial) {
        
        cantidad.addEventListener('change',()=>{

            document.getElementById('campoParcial').value = sumaParcialTotal('sumParcial')

        })  

    }

    // CARGAR SELECT VETERINARIOS

    let params = {
        idSelect:'vacunador',
        accion:'listarVeterinarios',
        ajax:'veterinarios',
        value:'matricula',
        optText:'nombre'
    }
    
    cargarSelect(params)



}

// CARGAR ACTAS
const btnCargarActa = document.getElementById('btnCargarActa');

btnCargarActa.addEventListener('click',(e)=>{

    e.preventDefault()

    let campania = getCookie('campania');
    
    let renspa = $('#renspaAftosa').val();
    
    // CHECKEAR SI EL PRODUCTOR EXISTE
    let url = 'ajax/productores.ajax.php'

    let data = new FormData()
    data.append('renspa',renspa)

    fetch(url,{
        method:'post',
        body:data
    }).then(resp => resp.json())
    .then(respuesta => {

        if(!respuesta){
            
           swal({
            type: "error",
            title: "El Productor no Existe",
            showConfirmButton: true,
            confirmButtonText: "Cerrar"
            })

        }else{

                let urlActa = 'ajax/actas.ajax.php'

                let dataActa = new FormData()
                dataActa.append('accion','validarActa')
                dataActa.append('renspa',renspa)
                dataActa.append('campania',campania)
            
                fetch(urlActa,{
                    method:'post',
                    body:dataActa
                }).then(resp => resp.json())
                .then(respuesta => {
            
                    if(respuesta.valida != 0){
                        
                        swal({
                            title: "El acta ya ha sido cargada. ¿Desea modificarla?",
                            text: "¡Si no puede cancelar la acción!",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            cancelButtonText: "Cancelar",
                            confirmButtonText: "Si, modificar Acta!"
                          }).then(result=>{
                              
                            if(result.value){

                                // ENVIAR A MODIFICAR ACTA}

                            }

                          })
            
                    }else{

                        let intercampania = $('#interCampania').is(':checked') ? true : false;

                        window.location = `index.php?ruta=aftosa/acta&renspa=${renspa}&campania=${campania}&intercampania=${intercampania}`

                    }
            
                })

        }

    })
    
  

});

// ACTAS POR PRODUCTOR

const btnBuscarActasProductor = document.getElementById('btnBuscarActasProductor')

btnBuscarActasProductor.addEventListener('click',(e)=>{

    e.preventDefault()

    let renspa = document.getElementById('renspaActasProductor').value

    renspa.trim()

    if(renspa.length == 17){

        let ruta = `index.php?ruta=aftosa/actasProductor&renspa=${renspa}`

        productorExistente(renspa,ruta,false)
        
    }else{
        
        swal({

            type: "error",
            title: "R.E.N.S.P.A Incorrecto",
            showConfirmButton: true,
            confirmButtonText: "Cerrar"

         })
            
    }
    
})

if(seccionURL == 'aftosa/actasProductor'){
    
    let renspa = getQueryVariable('renspa')
    
    // CARGAR PROPIETARIO Y RENSPA

    let url = 'ajax/productores.ajax.php'

    let data = new FormData()
    data.append('renspa',renspa)

    fetch(url,{
        method:'post',
        body:data
    })
    .then(resp => resp.json())
    .then(respuesta => {

        document.getElementById('dataPropietarioActas').innerText = `${respuesta.propietario} || ${respuesta.renspa}`

    })

}