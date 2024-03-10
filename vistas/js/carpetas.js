/*=============================================
	DATATABLE ANIMALES
	=============================================*/
//   $.ajax({

// 	url: "fetch/datatable-carpetas.fetch.php",
// 	success:function(respuesta){
		
// 		console.log("respuesta", respuesta);

// 	}

// });

/* Storing user's device details in a variable*/
let details = navigator.userAgent;
  
/* Creating a regular expression 
containing some mobile devices keywords 
to search it in details string*/
let regexp = /android|iphone|kindle|ipad/i;

/* Using test() method to search regexp in details
it returns boolean value*/
let isMobileDevice = regexp.test(details);

if (isMobileDevice) {
    document.cookie = "mobile=true; expires=Thu, 18 Dec 2099 12:00:00 UTC; path=/";    
} else {
    document.cookie = "mobile=false; expires=Thu, 18 Dec 2099 12:00:00 UTC; path=/";
}


            
const desactivarInputsMinMax = (valueMin,valueMax)=>{

    if(valueMin != 0 || valueMax != 0){

        for (const check of document.getElementsByClassName('cbClasificacion')) {
            
            check.checked = false

            check.setAttribute('disabled','disabled')
            
        }

    }else{
        
        for (const check of document.getElementsByClassName('cbClasificacion')) {
            
            check.removeAttribute('disabled')
            
        }

    }

}

// MOSTAR CARPETAS ACTIVAS
    
const generarCarpeta = (props)=>{

    let progressDescriptionSpan = document.createElement('SPAN')
    progressDescriptionSpan.setAttribute('class','progress-description')
    progressDescriptionSpan.innerText = props.description
    
    let progressBar = document.createElement('DIV')
    progressBar.setAttribute('class','progress-bar')
    progressBar.setAttribute('style',`width:${props.percentage}`)
    
    let progressDiv = document.createElement('DIV')
    progressDiv.setAttribute('class','progress')
    
    progressDiv.appendChild(progressBar)
    
    let infoNumberSpan = document.createElement('SPAN')
    infoNumberSpan.setAttribute('class','info-box-number')
    infoNumberSpan.innerText = props.clasification
    
    let infoTextSpan = document.createElement('SPAN')
    infoTextSpan.setAttribute('class','info-box-text')
    infoTextSpan.innerText = `${props.destino} - ${props.descripcion}` 
    let infoContentDiv = document.createElement('DIV')
    infoContentDiv.setAttribute('class','info-box-content')
    
    infoContentDiv.appendChild(infoTextSpan)
    infoContentDiv.appendChild(infoNumberSpan)
    infoContentDiv.appendChild(progressDiv)
    infoContentDiv.appendChild(progressDescriptionSpan)

    let infoIconSpan = document.createElement('SPAN')
    infoIconSpan.setAttribute('class','info-box-icon')
    infoIconSpan.innerText = props.animales

    let infoDiv = document.createElement('DIV')
    infoDiv.setAttribute('class',`info-box bg-${props.color}`)

    infoDiv.appendChild(infoIconSpan)
    infoDiv.appendChild(infoContentDiv)

    let link = document.createElement('A')
    link.setAttribute('href',`#`)
    link.setAttribute('class','btnInformeCarpeta')
    link.setAttribute('idCarpeta',props.idCarpeta)
    
    if(props.descripcion == 'Sin destino')
        link.setAttribute('sinDestino','true')


    link.appendChild(infoDiv)

    let li = document.createElement('LI')
    li.setAttribute('class','item')

    li.appendChild(link)

    let colDiv = document.createElement('DIV')
    colDiv.setAttribute('class',props.colRow)

    colDiv.appendChild(li)

    return colDiv

}

const mostrarCarpetasActivas = (operario)=>{

    let url = 'fetch/carpetas.fetch.php'

    let data = 'accion=mostrarActivas'

    $.ajax({
        method:'post',
        url,
        data,
        success:(res)=>{

            let data = JSON.parse(res)
            
            let docFragment = new DocumentFragment()

            let row = document.createElement('DIV')
            row.setAttribute('class','row')
            row.setAttribute('style','width:100%')

            data.map(reg=>{
                console.log(reg)
                let today = new Date()                
                let todayDate = `${today.getFullYear()}-${String(today.getMonth() + 1).padStart(2, '0')}-${String(today.getDate()).padStart(2, '0')}`

                console.log(reg.fecha, todayDate)
                console.log(reg.fecha == todayDate)
                if(reg.fecha == todayDate){
                    console.log('Entro a if')

                    let description = (reg.cantidad != 0) ? `${reg.animales}/${reg.cantidad}` : 'Indefinido'
                    
                    let color = 'yellow'

                    if(reg.completa){

                        description = 'Completo'

                        color = 'green'

                    } 

                    let percentage = (reg.cantidad != 0) ? `${(reg.animales * 100) / reg.cantidad}%` : '0%'
                    
                    let clasification = '*'

                    if(reg.clasificacion != null){

                        clasification = (reg.clasificacion != '') ? reg.clasificacion : `${reg.minGrasa} mm / ${reg.maxGrasa} mm`
                    
                    }

                    let sexo = 'M/H'

                    if(reg.sexo == 'M')
                        sexo = 'MACHO'

                    if(reg.sexo == 'H')
                        sexo = 'HEMBRA'

                    clasification +=  ` - ${sexo}` 

                    let props = {
                        description,
                        percentage,
                        clasification,
                        destino:reg.destino,
                        descripcion:reg.descripcion,
                        animales:reg.animales,
                        color,
                        idCarpeta:reg.idCarpeta,
                        colRow:'col-lg-12'
                    }

                    if(operario){
                        
                        props.colRow = 'col-lg-3'

                    }

                    console.log('GENERO CARPETA')
                    docFragment.appendChild(generarCarpeta(props))

                    setTimeout(() => {
                        
                        let hrefInformes = document.getElementsByClassName('btnInformeCarpeta')
                        
                        for (const iterator of hrefInformes) {
                                
                        iterator.addEventListener('click',(e)=>{
                    
                                e.preventDefault()

                                let idCarpeta = iterator.getAttribute('idCarpeta')

                                let sinDestinoValido = iterator.getAttribute('sindestino')

                                if(sinDestinoValido == null){
                                
                                    let title = '¿Cerrar Carpeta?' 
                                    
                                    let eliminar = false
                                    
                                    let cantidadTotal = iterator.firstElementChild.lastElementChild.lastElementChild.innerText
                                    
                                    if(cantidadTotal != 'Indefinido' && cantidadTotal != 'Completo'){
                                        
                                        cantidadTotal.split('/')
                                        
                                        if(cantidadTotal[0] != cantidadTotal[1])
                                            title = '¿Cerrar Carpeta? La carpeta esta INCOMPLETA'
                                            
                                        if(cantidadTotal[0] == 0){

                                            title = 'La carpeta no contiene ningun animal. Si confirma, la carpeta se eliminará.'
                                            
                                            eliminar = true
                                        
                                        }

                                    }else{

                                        if(cantidadTotal == 0){

                                            title = 'La carpeta no contiene ningun animal. Si confirma, la carpeta se eliminará.'
                                            
                                            eliminar = true

                                        }

                                    }
                                        
                                    new swal({
                                        title,
                                        text: "¡Si no,puede cancelar la accíón!",
                                        icon: 'warning',
                                        showCancelButton: true,
                                        confirmButtonColor: '#3085d6',
                                            cancelButtonColor: '#d33',
                                            cancelButtonText: 'Cancelar',
                                            confirmButtonText: 'Si, cerrar carpeta!'
                                        }).then(function(result){
                                        
                                            if(result.value){

                                                iterator.parentElement.parentElement.style.display = 'none'

                                                if(eliminar){

                                                    eliminarCarpeta(null,idCarpeta)

                                                }else{

                                                    window.open(`extensiones/fpdf/informesPdf.php?informe=carpeta&verInforme=false&idCarpeta=${idCarpeta}`, '_blank');
                                                
                                                }

                                            }
                                            
                                        })
                                    
                                }else{

                                    new swal({
                                        title: '¿Asignar destino a animales sin clasificación?',
                                        text: "¡Si no,puede cancelar la accíón!",
                                        icon: 'warning',
                                        showCancelButton: true,
                                        confirmButtonColor: '#3085d6',
                                            cancelButtonColor: '#d33',
                                            cancelButtonText: 'Cancelar',
                                            confirmButtonText: 'Si, asignar destinos!'
                                        }).then(function(result){
                                        
                                            if(result.value){
                                                
                                                $('#ventanaModalAsignarDestino').modal('show'); // abrir

                                                document.getElementById('perfilAsignarDestino').value = document.getElementById('perfilSD').value  
                                                
                                                document.getElementById('animalesSDList').innerHTML = ''
                                                console.log('hola');
                                                cargarAnimalesSD()

                                            }
                                            
                                        })

                                }

                            
                        })
                            
                        }
                        
                    }, 600);
                }

            })
                
            row.appendChild(docFragment)

            if(document.getElementById('carpetasScroll') != null){

                document.getElementById('carpetasScroll').firstElementChild.firstElementChild.appendChild(row)
                
            }else{
                
                document.getElementById('carpetasScrollOperario').firstElementChild.firstElementChild.appendChild(row)
            
            }

        }

    })

}

// BTN NUEVA CARPETA

    const btnNuevaCarpeta = document.getElementById('btnNuevaCarpeta')

    if(btnNuevaCarpeta != null){

        btnNuevaCarpeta.addEventListener('click',()=>{ 

            document.getElementById('tipoCarpetaCorral').value = 'Gordos'
            document.getElementById('modalNuevaCarpetaCorral').classList.add('showPerfilModal')
            document.getElementById('modalNuevaCarpetaCorral').classList.remove('hideElement')

            document.getElementById('btnCargarCarpetaCorral').innerText = 'Cargar Carpeta'
            document.getElementById('tituloRangoMM').classList.add('hideElement')
            document.getElementById('inputsRangoMM').classList.add('hideElement')
            

            document.getElementById('modalCarpeta').style.width = '1250px'

            document.getElementById('carpetasList').style.width = '60%'

            document.getElementById('DataTables_Table_1').style.width = '100%'

            let params = {
                fetchUrl:'cargarSelect',
                accion:'perfiles',
                value:'nombre',
                optText:'nombre',
                idSelect:'perfilCarpetaCorral'
            }

            cargarSelect(params)

                    // ACTIVAR CHECKS CLASIFICACION 

            document.querySelector('input[name="minGrasa"]').value = 0
            document.querySelector('input[name="maxGrasa"]').value = 0
        
            desactivarInputsMinMax(0,0)
            // CARGAR PRIORIDAD

            let url = 'fetch/cargarSelect.fetch.php'

            let formData = new FormData()

            formData.append('accion','prioridad')

            fetch(url,{
                method:'post',
                body:formData
            }).then(resp=>resp.json())
            .then(respuesta=>{
                
                if(respuesta)
                    document.getElementById('prioridadCarpetaCorral').value = Number(respuesta.prioridad) + 1         
                else
                    document.getElementById('prioridadCarpetaCorral').value = 1
                            
            })
            .catch(err=>console.log(err))
            
        })

        //------------------------------
        
        let removeModalNueva = document.getElementById('removeNuevaCarpeta')
        
        removeModalNueva.addEventListener('click',()=>{

            document.getElementById('modalNuevaCarpetaCorral').classList.remove('showPerfilModal')
            document.getElementById('modalNuevaCarpetaCorral').classList.add('hideElement')

            document.getElementById('modalCarpeta').style.width = '700px'

            document.getElementById('carpetasList').style.width = '100%'

        })

        // BTN NUEVO CORRAL

        const btnNuevoCorral = document.getElementById('btnNuevoCorral')

        btnNuevoCorral.addEventListener('click',()=>{

        document.getElementById('tipoCarpetaCorral').value = 'Corral'

        document.getElementById('modalNuevaCarpetaCorral').classList.add('showPerfilModal')
        document.getElementById('modalNuevaCarpetaCorral').classList.remove('hideElement')

        document.getElementById('btnCargarCarpetaCorral').innerText = 'Cargar Corral'
        document.getElementById('tituloRangoMM').classList.remove('hideElement')
        document.getElementById('inputsRangoMM').classList.remove('hideElement')

        document.getElementById('modalCarpeta').style.width = '1250px'

        document.getElementById('carpetasList').style.width = '60%'

        document.getElementById('DataTables_Table_1').style.width = '100%'

        let params = {
            fetchUrl:'cargarSelect',
            accion:'perfiles',
            value:'nombre',
            optText:'nombre',
            idSelect:'perfilCarpetaCorral'
        }

        cargarSelect(params)

        // CARGAR PRIORIDAD

        let url = 'fetch/cargarSelect.fetch.php'

        let formData = new FormData()

        formData.append('accion','prioridad')

        fetch(url,{
            method:'post',
            body:formData
        }).then(resp=>resp.json())
        .then(respuesta=>{
            
            if(respuesta)
                document.getElementById('prioridadCarpetaCorral').value = Number(respuesta.prioridad) + 1         
            else
                document.getElementById('prioridadCarpetaCorral').value = 1
                            
        })
        .catch(err=>console.log(err))

        })


    /*-------------------------------------------------------------*/

        let inputMinGrasa = document.querySelector('input[name="minGrasa"]')
        let inputMaxGrasa = document.querySelector('input[name="maxGrasa"]')
        // AL SELECCIONAR MINMAX DESCARTIVAR CHECKS

        inputMaxGrasa.addEventListener('change',()=>{

            desactivarInputsMinMax(inputMinGrasa.value,inputMaxGrasa.value)
        
        })

        inputMinGrasa.addEventListener('change',()=>{

            desactivarInputsMinMax(inputMinGrasa.value,inputMaxGrasa.value)
        
        })

        // AL SELECCIONAR CHECK DESACTIVAR MINMAX
        let checkboxClasif = document.getElementsByClassName("cbClasificacion")
        
        let checkeds = 0

        for (const checkbox of checkboxClasif) {

            checkbox.addEventListener('change',()=>{
            
                if(checkbox.checked){

                    checkeds++
                    inputMinGrasa.setAttribute('readOnly','readOnly')
                    inputMaxGrasa.setAttribute('readOnly','readOnly')

                    
                }else{
                    
                    checkeds--
                    if(checkeds == 0){

                        inputMinGrasa.removeAttribute('readOnly')
                        inputMaxGrasa.removeAttribute('readOnly')
                    
                    }


                }

            })
            
        }


        /****** 
        CARGAR NUEVA CARPETA
                                                        ***** */

        document.getElementById('nuevaCarpetaCorralForm')
        .addEventListener('submit',(e)=>{
            
            e.preventDefault()
            
            let clasificacionCarpetaCorral = []
            
            document.getElementById('btnCargarCarpetaCorral').setAttribute('disabled','disabled')

            let buttonText = document.getElementById('btnCargarCarpetaCorral').innerText

            document.getElementById('btnCargarCarpetaCorral').innerText = 'Cargando'

            const data = Object.fromEntries(
                
                new FormData(e.target)

            )

            for (const iterator of document.querySelectorAll("input[name='clasificacionCarpetaCorral']")) {

                if(iterator.checked){
                    
                    clasificacionCarpetaCorral.push(iterator.value)

                };
                    
            }

            data.clasificacionCarpetaCorral = clasificacionCarpetaCorral.join('/');

            data.accion = 'nuevaCarpeta'

            let url = 'fetch/carpetas.fetch.php'

            $.ajax({
                method:'post',
                url,
                data,
                success:(respuesta)=>{
                    
                    let data = JSON.parse(respuesta)
                    
                    if(data == 'errorValidacion'){

                        new swal({
        
                            icon: "error",
                            title: "Se debe elegir al menos  clasificación de animal/Rango de mm",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
        
                        })
                        
                        document.getElementById('btnCargarCarpetaCorral').removeAttribute('disabled')
                        document.getElementById('btnCargarCarpetaCorral').innerText = buttonText

                        return 

                    }
        
                    if(data == "ok"){
        
                        new swal({
        
                            icon: "success",
                            title: "¡La carpeta ha sido guardada correctamente!",   
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
        
                        })

                        document.getElementById('descripcionCarpetaCorral').value = ''
                        document.getElementById('pesoMinCarpetaCorral').value = 0
                        document.getElementById('pesoMaxCarpetaCorral').value = 0
                        document.querySelector('input[name="minGrasa"]').value = 0
                        document.querySelector('input[name="maxGrasa"]').value = 0
                        document.querySelector('input[name="minGrasa"]').removeAttribute('readOnly')
                        document.querySelector('input[name="maxGrasa"]').removeAttribute('readOnly')


                        let checks = document.getElementsByClassName('cbClasificacion')
                            
                        for (const check of checks) {
                            
                            check.checked = false

                        }
                        
                        $('.tablaCarpetas').DataTable().ajax.reload();

                        let idSeccionCarpetas = 'carpetasScrollOperario'

                        let operarioValido = true
    
                        if(document.getElementById('seccionCarpetaAct') != null){
    
                        idSeccionCarpetas =  'carpetasScroll' 
    
                        operarioValido = false
    
                        } 
    
                        document.getElementById(idSeccionCarpetas).firstElementChild.firstElementChild.innerHTML = ''
                        
                        mostrarCarpetasActivas(operarioValido)

                        document.getElementById('btnCargarCarpetaCorral').removeAttribute('disabled')
                        document.getElementById('btnCargarCarpetaCorral').innerText = buttonText
                        
                    }else{
        
                        new swal({
        
                            icon: "error",
                            title: "Hubo un error al cargar la carpeta",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
        
                        })

                        document.getElementById('btnCargarCarpetaCorral').removeAttribute('disabled')
                        document.getElementById('btnCargarCarpetaCorral').innerText = buttonText
        
                    }
                        
                }

            })
                    
        })


        // CARGAR VER CARPETA MODAL

        $('.tablaCarpetas').on('click','.btnVerCarpeta',function(){

            document.getElementById('pesoMinVerModal').innerText = ''
            document.getElementById('pesoMaxVerModal').innerText = ''
            document.getElementById('clasVerModal').innerText = ''
            document.getElementById('mmMinVerModal').innerText = ''
            document.getElementById('mmMaxVerModal').innerText = ''
            document.getElementById('sexoVerModal').innerText = ''

            let value = $(this).attr('idCarpeta')
            
            let data = new FormData()
            data.append('accion','verCarpeta')
            data.append('idCarpeta',value)

            let url = 'fetch/carpetas.fetch.php'
            
            fetch(url,{
                method:'post',
                body:data
            }).then(resp => resp.json())
            .then(respuesta=> {

                let pesoMin = respuesta[0].pesoMin
                let pesoMax = respuesta[0].pesoMax
                
                if(respuesta[0].pesoMax == 10000){
            
                    pesoMin = 'Libre'
                    pesoMax = 'Libre'

                }
                
                document.getElementById('pesoMinVerModal').innerText = pesoMin
                document.getElementById('pesoMaxVerModal').innerText = pesoMax

                document.getElementById('clasVerModal').innerText = respuesta[0].clasificacion
                document.getElementById('mmMinVerModal').innerText = respuesta[0].minGrasa
                document.getElementById('mmMaxVerModal').innerText = respuesta[0].maxGrasa
                document.getElementById('sexoVerModal').innerText = (respuesta[0].sexo != '') ? respuesta[0].sexo : '-'

            })
            .catch(err=>console.log(err))

        })

    }


    let url = window.location.href

    
    if(url.includes('inicio') && document.getElementById('carpetasScroll') != null){

        mostrarCarpetasActivas(false)

    }else if(!url.includes('usuario') && !url.includes('analisis')){
        
        mostrarCarpetasActivas(true)

    }



    // ELIMINAR CARPETA
    
    $('.tablaCarpetas').on('click','.btnEliminarCarpeta',function(e){

        e.preventDefault()
            
        let id = $(this).attr('idcarpeta')

        let button = $(this)

        new swal({
            title: '¿Eliminar Carpeta?',
            text: "¡Si no lo está puede cancelar la accíón!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Si, eliminar carpeta!'
            }).then(function(result){
        
            if(result.value){

                eliminarCarpeta(button,id)

            }

        });

    })

    const eliminarCarpeta = (button,idCarpeta)=>{

        if(button != null)
            button.attr('disabled','disabled')

        let url = 'fetch/carpetas.fetch.php'

        let data  = new FormData()
        data.append('accion','eliminarCarpeta')
        data.append('idCarpeta',idCarpeta)

        fetch(url,{
            method:'post',
            body:data
        })
        .then(resp => resp.json())
        .then(respuesta=>{

            if(respuesta == 'ok'){

                new swal({

                    icon: "success",
                    title: "¡La carpeta ha sido eliminada correctamente!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"

                })


                let idSeccionCarpetas = 'carpetasScrollOperario'

                let operarioValido = true

                if(document.getElementById('seccionCarpetaAct') != null){

                    idSeccionCarpetas =  'carpetasScroll' 

                    operarioValido = false

                } 

                document.getElementById(idSeccionCarpetas).firstElementChild.firstElementChild.innerHTML = ''
                
                mostrarCarpetasActivas(operarioValido)

                $('.tablaCarpetas').DataTable().ajax.reload();
                $('.tablaIngresos').DataTable().ajax.reload();

                if(button != null)
                    button.removeAttr('disabled')

            }else{

                new swal({

                    icon: "error",
                    title: "Hubo un error al eliminar la carpeta",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"

                })

                if(button != null)
                    button.removeAttr('disabled')

            
            }

        })
        .catch(err=>console.log(err))

    }

    // DESCARGAR EXCEL
    
    $('.tablaCarpetas').on('click','.btnExcelCarpeta',function(e){

        let id = $(this).attr('idCarpeta')

        new swal({
            title: '¿Desea descargar informe en Excel?',
            text: "¡Puede cancelar la accíón!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Si, descargar Informe en Excel'
            }).then(function(result){
        
            if(result.value){

                window.open(`vistas/modulos/excelCarpeta.php?idCarpeta=${id}&accion=carpetaExcel`, '_blank');

            }

        });

    });




    // MOBILE --------

    let btnNuevaCarpetaMobile = document.getElementById('btnNuevaCarpetaMobile')

    if(btnNuevaCarpetaMobile != null){   
        $('.tablaCarpetas').DataTable( {
            "ajax": "fetch/datatable-carpetas.fetch.php",
            "bSort" : false,
            "deferRender": true,
            "retrieve": true,
            "processing": true,
            "ordering": false,
            "responsive":true,
            "searching": false,
            "info":     false,
            "bLengthChange": false,
            "pageLength": 5,
            // "order": [[ 4, "asc" ]],
            "columnDefs": [
                { "visible": false, "targets": 5 }
              ],
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
          
        });        
            

        $('#menuCarpetas').on('click',function(){
            $('body').removeClass('sidebar-open')
        })

        btnNuevaCarpetaMobile.addEventListener('click',()=>{ 

            document.getElementById('tipoCarpetaCorral').value = 'Gordos'
            document.getElementById('modalNuevaCarpetaCorral').classList.remove('hideElement')
            document.getElementById('tablaCarpetasMobile').classList.add('hideElement')
            document.getElementById('btnCargarCarpetaCorral').innerText = 'Cargar Carpeta'
            document.getElementById('tituloRangoMM').classList.add('hideElement')
            document.getElementById('inputsRangoMM').classList.add('hideElement')
            
            let params = {
                fetchUrl:'cargarSelect',
                accion:'perfiles',
                value:'nombre',
                optText:'nombre',
                idSelect:'perfilCarpetaCorral'
            }

            cargarSelect(params)

                    // ACTIVAR CHECKS CLASIFICACION 

            document.querySelector('input[name="minGrasa"]').value = 0
            document.querySelector('input[name="maxGrasa"]').value = 0
        
            desactivarInputsMinMax(0,0)
            // CARGAR PRIORIDAD

            let url = 'fetch/cargarSelect.fetch.php'

            let formData = new FormData()

            formData.append('accion','prioridad')

            fetch(url,{
                method:'post',
                body:formData
            }).then(resp=>resp.json())
            .then(respuesta=>{
                
                if(respuesta)
                    document.getElementById('prioridadCarpetaCorral').value = Number(respuesta.prioridad) + 1         
                else
                    document.getElementById('prioridadCarpetaCorral').value = 1
                            
            })
            .catch(err=>console.log(err))
            
        })

        //------------------------------
        

        // BTN NUEVO CORRAL

        const btnNuevoCorralMobile = document.getElementById('btnNuevoCorralMobile')

        btnNuevoCorralMobile.addEventListener('click',()=>{

            document.getElementById('tipoCarpetaCorral').value = 'Corral'

            document.getElementById('modalNuevaCarpetaCorral').classList.remove('hideElement')
            document.getElementById('tablaCarpetasMobile').classList.add('hideElement')
            document.getElementById('btnCargarCarpetaCorral').innerText = 'Cargar Corral'

            document.getElementById('tituloRangoMM').classList.remove('hideElement')
            document.getElementById('inputsRangoMM').classList.remove('hideElement')

            let params = {
                fetchUrl:'cargarSelect',
                accion:'perfiles',
                value:'nombre',
                optText:'nombre',
                idSelect:'perfilCarpetaCorral'
            }

            cargarSelect(params)

            // CARGAR PRIORIDAD

            let url = 'fetch/cargarSelect.fetch.php'

            let formData = new FormData()

            formData.append('accion','prioridad')

            fetch(url,{
                method:'post',
                body:formData
            }).then(resp=>resp.json())
            .then(respuesta=>{
                
                if(respuesta)
                    document.getElementById('prioridadCarpetaCorral').value = Number(respuesta.prioridad) + 1         
                else
                    document.getElementById('prioridadCarpetaCorral').value = 1
                                
            })
            .catch(err=>console.log(err))

        })

        // CARPETAS

        const btnCarpetasMobile = document.getElementById('btnCarpetasMobile')

        btnCarpetasMobile.addEventListener('click',()=>{
            document.getElementById('modalNuevaCarpetaCorral').classList.add('hideElement')
            document.getElementById('tablaCarpetasMobile').classList.remove('hideElement')
            
        })
    }else{
        $('.tablaCarpetas').DataTable( {
            "ajax": "fetch/datatable-carpetas.fetch.php",
            "bSort" : false,
            "deferRender": true,
            "retrieve": true,
            "processing": true,
            "ordering": false,
            "responsive":true,
            "searching": false,
            "info":     false,
            "bLengthChange": false,
            "pageLength": 5,
            // "order": [[ 4, "asc" ]],
            
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
          
        });
    }

