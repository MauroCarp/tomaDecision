const ruta = getQueryVariable('ruta')

/*=============================================
EDITAR CAMPANIA
=============================================*/

// CARGAR DATA CAMPANIA 
const btnMenuCampania = document.getElementById('btnMenuCampania')

btnMenuCampania.addEventListener('click',()=>{

    let url = 'ajax/aftosa.ajax.php'

    let data = new FormData()
    data.append('accion','dataCampania')

    fetch(url,{
        method:'post',
        body:data
    }).then(resp => resp.json())
    .then(respuesta => {
        console.log(respuesta);
        
        document.getElementById('campaniaNumero').value = respuesta.numero 
        document.getElementById('fechaInicio').value = respuesta.inicio 
        document.getElementById('fechaCierre').value = respuesta.final 
        document.getElementById('precioAdmAftosa').value = respuesta.admA 
        document.getElementById('precioVacunaAftosa').value = respuesta.vacunaA 
        document.getElementById('precioVeterinarioAftosa').value = respuesta.vacunadorA 
        document.getElementById('precioAdmCarb').value = respuesta.admC
        document.getElementById('precioVacunaCarb').value = respuesta.vacunaC 
        document.getElementById('precioVeterinarioCarb').value = respuesta.vacunadorC 

    })
    .catch(err=>console.log(err))



})


/*=============================================
NUEVA CAMPANIA
=============================================*/
const btnNuevaCampania = document.getElementById('nuevaCampania')

btnNuevaCampania.addEventListener('click',()=>{

    document.getElementById('inputNuevaCampania').style.display = 'block'

    const btnCargarCampania = document.getElementById('cargarNuevaCampania')

    btnCargarCampania.addEventListener('click',()=>{

        swal({
            title: "¿Cargar nueva campaña?",
            text: "¡Si no puede cancelar la acción!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            cancelButtonText: "Cancelar",
            confirmButtonText: "Si, cargar Campaña"
          })
        .then(function(result){
                
            if (result.value) {
              
                let campania = document.getElementById('nuevaCampaniaNumero').value
        
                window.location = `index.php?ruta=inicio&campania=${campania}`
                        
            }

        })
        
    })

})

/*=============================================
ACTAS
=============================================*/

// CARGAR ACTAS
const btnCargarActa = document.getElementById('btnCargarActa');

btnCargarActa.addEventListener('click',()=>{


    let campania = getCookie('campania');
    
    let renspa = $('#renspaAftosa').val();
    
    let intercampania = $('#interCampania').is(':checked') ? true : false;

    window.location = `index.php?ruta=aftosa/acta&renspa=${renspa}&campania=${campania}&intercampania=${intercampania}`

});

// ACTAS POR PRODUCTOR

const btnBuscarActasProductor = document.getElementById('btnBuscarActasProductor')

btnBuscarActasProductor.addEventListener('click',(e)=>{

    e.preventDefault()

    let renspa = document.getElementById('renspaActasProductor').value

    renspa.trim()
    console.log(renspa);
    
    if(renspa.length == 17){

        productorExistente(renspa)
        
    }else{
        
        swal({
            type: "error",
            title: "R.E.N.S.P.A Incorrecto",
            showConfirmButton: true,
            confirmButtonText: "Cerrar"
            })
            
    }
    
})

if(ruta == 'aftosa/actasProductor'){
    
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

/*=============================================
RECEPCION
=============================================*/

// GENERAR INPUT RECEPCION

const generarInputRecepcion = ()=>{
    let form = document.createElement('POST')

    let trInput = document.createElement('TR')
    
    let tdFechaIng = document.createElement('TD')

    let tdUel = tdFechaIng.cloneNode(true)
    
    let tdCantidad = tdFechaIng.cloneNode(true)
    
    let tdMarca = tdFechaIng.cloneNode(true)
    
    let tdSerie = tdFechaIng.cloneNode(true)
    
    let tdFechaVenc = tdFechaIng.cloneNode(true)

    let inputFechaIng = document.createElement('INPUT')
    inputFechaIng.setAttribute('class','form-control')

    let inputUel = inputFechaIng.cloneNode(true)
    
    let inputCantidad =  inputFechaIng.cloneNode(true) 
    
    let inputMarca =  inputFechaIng.cloneNode(true) 
    
    let inputSerie =  inputFechaIng.cloneNode(true) 
    
    let inputFechaVenc =  inputFechaIng.cloneNode(true) 

    inputFechaIng.setAttribute('type','date')
    inputFechaIng.setAttribute('name','fechaIngRecepcion')
    tdFechaIng.appendChild(inputFechaIng)

    inputUel.setAttribute('type','text')
    inputUel.setAttribute('name','uelRecepcion')
    inputUel.setAttribute('value','F.I.S.S.A')
    inputUel.setAttribute('readOnly','readOnly')
    tdUel.appendChild(inputUel)

    inputCantidad.setAttribute('type','number')
    inputCantidad.setAttribute('name','cantidadRecepcion')
    tdCantidad.appendChild(inputCantidad)

    inputMarca.setAttribute('type','select')
    inputMarca.setAttribute('name','marcaRecepcion')
    tdMarca.appendChild(inputMarca)

    inputSerie.setAttribute('type','text')
    inputSerie.setAttribute('name','serieRecepcion')
    tdSerie.appendChild(inputSerie)

    inputFechaVenc.setAttribute('type','date')
    inputFechaVenc.setAttribute('name','fechaVenRepecion')
    tdFechaVenc.appendChild(inputFechaVenc)

    trInput.appendChild(tdFechaIng)
    trInput.appendChild(tdUel)
    trInput.appendChild(tdCantidad)
    trInput.appendChild(tdMarca)
    trInput.appendChild(tdSerie)
    trInput.appendChild(tdFechaVenc)

    let btnAgregar = document.createElement('BUTTON')
    btnAgregar.setAttribute('class','btn btn-primary')
    btnAgregar.setAttribute('type','button')
    btnAgregar.setAttribute('id','agregarRecepcion')
    btnAgregar.style.marginTop = '10px'
    btnAgregar.style.marginLeft = '10px'
    btnAgregar.textContent = 'Cargar Recepción'
    trInput.appendChild(btnAgregar)
    form.appendChild(trInput)

    return trInput

}

// ELIMINAR RECEPCION

const eliminarRegistro = (id,ruta)=>{

    swal({
        title: `¿Eliminar ${capitalizarPrimeraLetra(ruta)}?`,
        text: "¡Si no puede cancelar la acción!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Si, Eliminar"
        })
    .then(function(result){
            
        if (result.value) {
                
            window.location = `index.php?ruta=aftosa/${ruta}&id=${id}`
                    
        }

    })

}

if(ruta == 'aftosa/recepcion'){

// MOSTRAR INPUT RECEPCION

let btnAgregarRecepcion = document.getElementById('btnAgregarRecepcion')

if(isInPage(btnAgregarRecepcion))
    btnAgregarRecepcion.addEventListener('click',function(){

        let tbody = document.getElementById('tablaRecepcion')
        
        let input = generarInputRecepcion()
        
        tbody.prepend(input)
        
        // CARGAR RECEPCION
        document.getElementById('agregarRecepcion').addEventListener('click',()=>{
        
            let fechaIng = document.querySelector('input[name="fechaIngRecepcion"]').value
            let uel = document.querySelector('input[name="uelRecepcion"]').value
            let cantidad = document.querySelector('input[name="cantidadRecepcion"]').value
            let marca = document.querySelector('input[name="marcaRecepcion"]').value
            let serie = document.querySelector('input[name="serieRecepcion"]').value
            let fechaVenc = document.querySelector('input[name="fechaVenRepecion"]').value
            
            if(fechaIng != '' && uel != '' && cantidad != '' && marca != '' && serie != '' && fechaVenc != ''){

                let  url = 'ajax/aftosa.ajax.php';

                let accion = 'cargarRecepcion'

                let campania = getCookie('campania') 

                console.log(campania);
                
                let  formData = new FormData()
                
                formData.append('accion',accion)
                formData.append('campania',campania)
                formData.append('fechaIng',fechaIng)
                formData.append('uel',uel)
                formData.append('cantidad',cantidad)
                formData.append('marca',marca)
                formData.append('serie',serie)
                formData.append('fechaVenc',fechaVenc)

                console.log(formData.get('accion'));
                

                fetch(url, {
                    method: 'POST', 
                    body: formData,

                }).then(respuesta => respuesta.json())
                .then(response => {
                    
                    if(response == 'ok'){
                        window.location = 'index.php?ruta=aftosa/recepcion'
                    }

                })
                .catch(error => console.error('Error:', error))

            }else{

                swal({
                    title: "Hay campos vacios",
                    type: "error",
                    confirmButtonText: "¡Cerrar!"
                    })

            }   

                
        })

        this.setAttribute('disabled','disabled')

    })

}

/*=============================================
DISTRIBUCION
=============================================*/
const cargarSelectVeterinarios = (idSelect)=>{

        let data = new FormData()
        data.append("accion","listarVeterinarios");
      
        let url = 'ajax/veterinarios.ajax.php';
      
        fetch(url,{
            method:'POST',
            body:data
        })
        .then(resp => resp.json())
        .then(response=> {

            let options = document.createDocumentFragment()
            response.map(vet => {

                let opt = document.createElement('OPTION')
                opt.setAttribute('value',vet.matricula)
                opt.textContent = vet.nombre

                options.append(opt)

            })

            const selectVet = document.getElementById(idSelect)
            if(isInPage(selectVet))
                selectVet.appendChild(options)

        })
        .catch(err=>console.log(err))

}

cargarSelectVeterinarios('vacunadorDistri')

const cargarDistribuciones = (matricula,idTBody)=>{

    let url = 'ajax/aftosa.ajax.php'

    let data = new FormData()
    data.append('matricula',matricula)
    data.append('accion','mostrarDistribucion')

    fetch(url,{
        method:'post',
        body:data
    })
    .then(resp => resp.json())
    .then(respuesta =>{
        console.log(respuesta);
        
        if(respuesta.length > 0){
            let tbody = document.getElementById(idTBody)

            let emptyRow = tbody.firstElementChild
            
            if(isInPage(emptyRow))
                tbody.removeChild(emptyRow)

            tbody.innerHTML = ''

            let rows = document.createDocumentFragment()

            respuesta.map(registro =>{
                
                let row = document.createElement('TR')
                
                let marca = document.createElement('TD')
                let uel = marca.cloneNode(true)
                let tdMatricula = marca.cloneNode(true)
                let cantidad = marca.cloneNode(true)
                let fechaEntrega = marca.cloneNode(true)
                
                uel.textContent = 'F.I.S.S.A'
                tdMatricula.textContent = matricula
                marca.textContent = registro.marca
                cantidad.textContent = registro.cantidad
                fechaEntrega.textContent = formatearFecha(registro.fechaEntrega)

                row.appendChild(tdMatricula)
                row.appendChild(uel)
                row.appendChild(marca)
                row.appendChild(cantidad)
                row.appendChild(fechaEntrega)
                
                let btnEliminar = document.createElement('BUTTON')
                btnEliminar.setAttribute('class','btn btn-danger btnEliminarDistribucion')
                btnEliminar.setAttribute('id',registro.distri_id)
                btnEliminar.setAttribute('style','margin:5px 0')

                let crossIcon = document.createElement('I')
                crossIcon.setAttribute('class','fa fa-times')

                btnEliminar.appendChild(crossIcon)
                row.appendChild(btnEliminar)

                rows.appendChild(row)

            })

            tbody.appendChild(rows)

            
        }else{
            
            let tr = document.createElement('TR')
            tr.setAttribute('class','odd')

            let td  = document.createElement('TD')
            td.setAttribute('valign','top')
            td.setAttribute('colspan','6')
            td.setAttribute('class','dataTables_empty')
            td.innerText = 'Ningún dato disponible en esta tabla'

            tr.appendChild(td)

            document.getElementById(idTBody).innerHTML = ''
            document.getElementById(idTBody).appendChild(tr)
            
        }
    
        $('.btnEliminarDistribucion').on('click',function(){
            
            let id = $(this).attr('id')
        
            eliminarRegistro(id,'distribucion')
        
        })            
                
    })
    .catch(err=>console.log(err))
    

}

const btnCargarDistribuciones = document.querySelector('#cargarDistribuciones')

if(isInPage(btnCargarDistribuciones)){
    console.log('hola');
    
    btnCargarDistribuciones.addEventListener('click',()=>{

    let matricula = document.getElementById('vacunadorDistri').value

    cargarDistribuciones(matricula,'tablaDistribucion')
   
    })

  

}



// // GENERAR INPUT DISTRIBUCION

// const generarInputDistribucion = ()=>{
//     let form = document.createElement('POST')

//     let trInput = document.createElement('TR')
    
//     let tdFechaIng = document.createElement('TD')

//     let tdUel = tdFechaIng.cloneNode(true)
    
//     let tdCantidad = tdFechaIng.cloneNode(true)
    
//     let tdMarca = tdFechaIng.cloneNode(true)
    
//     let tdSerie = tdFechaIng.cloneNode(true)
    
//     let tdFechaVenc = tdFechaIng.cloneNode(true)

//     let inputFechaIng = document.createElement('INPUT')
//     inputFechaIng.setAttribute('class','form-control')

//     let inputUel = inputFechaIng.cloneNode(true)
    
//     let inputCantidad =  inputFechaIng.cloneNode(true) 
    
//     let inputMarca =  inputFechaIng.cloneNode(true) 
    
//     let inputSerie =  inputFechaIng.cloneNode(true) 
    
//     let inputFechaVenc =  inputFechaIng.cloneNode(true) 

//     inputFechaIng.setAttribute('type','date')
//     inputFechaIng.setAttribute('name','fechaIngRecepcion')
//     tdFechaIng.appendChild(inputFechaIng)

//     inputUel.setAttribute('type','text')
//     inputUel.setAttribute('name','uelRecepcion')
//     inputUel.setAttribute('value','F.I.S.S.A')
//     inputUel.setAttribute('readOnly','readOnly')
//     tdUel.appendChild(inputUel)

//     inputCantidad.setAttribute('type','number')
//     inputCantidad.setAttribute('name','cantidadRecepcion')
//     tdCantidad.appendChild(inputCantidad)

//     inputMarca.setAttribute('type','select')
//     inputMarca.setAttribute('name','marcaRecepcion')
//     tdMarca.appendChild(inputMarca)

//     inputSerie.setAttribute('type','text')
//     inputSerie.setAttribute('name','serieRecepcion')
//     tdSerie.appendChild(inputSerie)

//     inputFechaVenc.setAttribute('type','date')
//     inputFechaVenc.setAttribute('name','fechaVenRepecion')
//     tdFechaVenc.appendChild(inputFechaVenc)

//     trInput.appendChild(tdFechaIng)
//     trInput.appendChild(tdUel)
//     trInput.appendChild(tdCantidad)
//     trInput.appendChild(tdMarca)
//     trInput.appendChild(tdSerie)
//     trInput.appendChild(tdFechaVenc)

//     let btnAgregar = document.createElement('BUTTON')
//     btnAgregar.setAttribute('class','btn btn-primary')
//     btnAgregar.setAttribute('type','button')
//     btnAgregar.setAttribute('id','agregarRecepcion')
//     btnAgregar.style.marginTop = '10px'
//     btnAgregar.style.marginLeft = '10px'
//     btnAgregar.textContent = 'Cargar Recepción'
//     trInput.appendChild(btnAgregar)
//     form.appendChild(trInput)

//     return trInput

// }

// // MOSTRAR INPUT DISTRIBUCION

// let btnAgregarRecepcion = document.getElementById('btnAgregarRecepcion')

// btnAgregarRecepcion.addEventListener('click',function(){

//         let tbody = document.getElementById('tablaRecepcion')
        
//         let input = generarInputRecepcion()
        
//         tbody.prepend(input)
        
//         // CARGAR RECEPCION
//         document.getElementById('agregarRecepcion').addEventListener('click',()=>{
        
//             let fechaIng = document.querySelector('input[name="fechaIngRecepcion"]').value
//             let uel = document.querySelector('input[name="uelRecepcion"]').value
//             let cantidad = document.querySelector('input[name="cantidadRecepcion"]').value
//             let marca = document.querySelector('input[name="marcaRecepcion"]').value
//             let serie = document.querySelector('input[name="serieRecepcion"]').value
//             let fechaVenc = document.querySelector('input[name="fechaVenRepecion"]').value
            
//             if(fechaIng != '' && uel != '' && cantidad != '' && marca != '' && serie != '' && fechaVenc != ''){

//                 let  url = 'ajax/aftosa.ajax.php';

//                 let accion = 'cargarRecepcion'

//                 let campania = getCookie('campania') 

//                 console.log(campania);
                
//                 let  formData = new FormData()
                
//                 formData.append('accion',accion)
//                 formData.append('campania',campania)
//                 formData.append('fechaIng',fechaIng)
//                 formData.append('uel',uel)
//                 formData.append('cantidad',cantidad)
//                 formData.append('marca',marca)
//                 formData.append('serie',serie)
//                 formData.append('fechaVenc',fechaVenc)

//                 console.log(formData.get('accion'));
                

//                 fetch(url, {
//                     method: 'POST', 
//                     body: formData,

//                 }).then(respuesta => respuesta.json())
//                 .then(response => {
                    
//                     if(response == 'ok'){
//                         window.location = 'index.php?ruta=aftosa/recepcion'
//                     }

//                 })
//                 .catch(error => console.error('Error:', error))

//             }else{

//                 swal({
//                     title: "Hay campos vacios",
//                     type: "error",
//                     confirmButtonText: "¡Cerrar!"
//                     })

//             }   

                
//         })

//         this.setAttribute('disabled','disabled')

// })


// document.querySelector('.btnEliminarRecepcion').addEventListener('click',function(){

//     let idRecepcion = this.id

//     console.log(idRecepcion);
    
//     swal({
//         title: "¿Eliminar Recepción?",
//         text: "¡Si no puede cancelar la acción!",
//         type: "warning",
//         showCancelButton: true,
//         confirmButtonColor: "#3085d6",
//         cancelButtonColor: "#d33",
//         cancelButtonText: "Cancelar",
//         confirmButtonText: "Si, Eliminar"
//       })
//     .then(function(result){
            
//         if (result.value) {
              
//             window.location = `index.php?ruta=aftosa/recepcion&id=${idRecepcion}`
                    
//         }

//     })
// })
