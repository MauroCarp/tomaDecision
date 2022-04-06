/*=============================================
	DATATABLE ANIMALES
	=============================================*/
//   $.ajax({

// 	url: "fetch/datatable-carpetas.fetch.php",
// 	success:function(respuesta){
		
// 		console.log("respuesta", respuesta);

// 	}

// });


$('.tablaCarpetas').DataTable( {
    "ajax": "fetch/datatable-carpetas.fetch.php",
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
  
});

// BTN NUEVA CARPETA

const btnNuevaCarpeta = document.getElementById('btnNuevaCarpeta')

if(btnNuevaCarpeta != null){

    btnNuevaCarpeta.addEventListener('click',()=>{

        document.getElementById('modalNuevaCarpetaCorral').classList.add('showPerfilModal')
        document.getElementById('modalNuevaCarpetaCorral').classList.remove('hideElement')

        document.getElementById('btnCargarCarpetaCorral').innerText = 'Cargar Carpeta'
        document.getElementById('tituloRangoMM').classList.add('hideElement')
        document.getElementById('inputsRangoMM').classList.add('hideElement')
        

        document.getElementById('modalCarpeta').style.width = '1100px'

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


    let removeModalNueva = document.getElementById('removeNuevaCarpeta')
    
    removeModalNueva.addEventListener('click',()=>{

        document.getElementById('modalNuevaCarpetaCorral').classList.remove('showPerfilModal')
        document.getElementById('modalNuevaCarpetaCorral').classList.add('hideElement')

        document.getElementById('modalCarpeta').style.width = '600px'

        document.getElementById('carpetasList').style.width = '100%'

    })




    // BTN NUEVO CORRAL

    const btnNuevoCorral = document.getElementById('btnNuevoCorral')

    btnNuevoCorral.addEventListener('click',()=>{

    document.getElementById('modalNuevaCarpetaCorral').classList.add('showPerfilModal')
    document.getElementById('modalNuevaCarpetaCorral').classList.remove('hideElement')

    document.getElementById('btnCargarCarpetaCorral').innerText = 'Cargar Corral'
    document.getElementById('tituloRangoMM').classList.remove('hideElement')
    document.getElementById('inputsRangoMM').classList.remove('hideElement')

    document.getElementById('modalCarpeta').style.width = '1100px'

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

    const desactivarInputsMinMax = (valueMin,valueMax)=>{

        if(valueMin != 0 || valueMax != 0){

            for (const check of document.getElementsByClassName('icheckbox_minimal-blue')) {
                
                check.classList.remove('checked')

                check.setAttribute('aria-checked','false')

                check.style.cursor = 'not-allow'
                check.style.pointerEvents = 'none'
                check.style.backgroundColor = 'rgba(200,200,200,.9)'

                check.firstElementChild.setAttribute('disabled','disabled')
                
            }

        }else{
            
            for (const check of document.getElementsByClassName('icheckbox_minimal-blue')) {
                
                check.style.cursor = 'pointer'
                check.style.pointerEvents = 'auto'
                check.style.backgroundColor = 'rgb(255,255,255)'

                check.firstElementChild.removeAttribute('disabled')
                
            }

        }

    }
    // AL SELECCIONAR MINMAX DESCARTIVAR CHECKS

    inputMaxGrasa.addEventListener('change',()=>{

        desactivarInputsMinMax(inputMinGrasa.value,inputMaxGrasa.value)
       
    })

    inputMinGrasa.addEventListener('change',()=>{

        desactivarInputsMinMax(inputMinGrasa.value,inputMaxGrasa.value)
       
    })

    // AL SELECCIONAR CHECK DESACTIVAR MINMAX
    let checkboxClasif = document.getElementsByClassName("iCheck-helper")
    
    let checkeds = 0

    for (const checkbox of checkboxClasif) {

        checkbox.addEventListener('click',()=>{
           
            if(checkbox.previousElementSibling.checked){

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

        if(props.color == 'green' || props.description == 'Indefinido'){

            link.setAttribute('href',`extensiones/fpdf/informesPdf.php?informe=carpeta&idCarpeta=${props.idCarpeta}`)
            link.setAttribute('target','_blank')
            link.setAttribute('class','btnInformeCarpeta')

        }else{    
            link.setAttribute('href','')
            link.setAttribute('style','pointer-events: none;cursor:not-allow;')
        }
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

                    let description = (reg.cantidad != 0) ? `${reg.animales}/${reg.cantidad}` : 'Indefinido'
                    
                    let color = 'yellow'

                    if(reg.completa){

                        description = 'Completo'

                        color = 'green'

                    } 

                    let percentage = (reg.cantidad != 0) ? `${(reg.animales * 100) / reg.cantidad}%` : '0%'
                    
                    let clasification = (reg.clasificacion != '') ? reg.clasificacion : `${reg.minGrasa} mm / ${reg.maxGrasa} mm`

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

                    docFragment.appendChild(generarCarpeta(props))

                    setTimeout(() => {
                        
                        let hrefInformes = document.getElementsByClassName('btnInformeCarpeta')
                        
                        for (const iterator of hrefInformes) {
                                
                           iterator.addEventListener('click',()=>{
                    
                               iterator.style.display = 'none'
                               
                           })
                            
                        }
                        
                    }, 600);

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

    let url = window.location.href

    if(url.includes('inicio') && document.getElementById('carpetasScroll') != null)
        mostrarCarpetasActivas(false)
    else
        mostrarCarpetasActivas(true)

    
        // ELIMINAR CARPETA
        
        $('.tablaCarpetas').on('click','.btnEliminarCarpeta',function(e){

            e.preventDefault()
                
            let id = $(this).attr('idcarpeta')
                
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
            
                    window.location = `index.php?ruta=inicio&idCarpeta=${id}`
    
                }
    
            });

        })




