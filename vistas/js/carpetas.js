// BTN NUEVO PERFIL

const btnNuevaCarpeta = document.getElementById('btnNuevaCarpeta')

btnNuevaCarpeta.addEventListener('click',()=>{

    document.getElementById('modalNuevaCarpeta').classList.toggle('hideElement')
    document.getElementById('modalNuevaCarpeta').classList.toggle('showPerfilModal')

    document.getElementById('modalCarpeta').style.width = '800px'

    document.getElementById('carpetasList').style.width = '50%'

    let params = {
        fetchUrl:'cargarSelect',
        accion:'perfiles',
        value:'nombre',
        optText:'nombre',
        idSelect:'perfilCarpeta'
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
            document.getElementById('prioridad').value = Number(respuesta.prioridad) + 1         
        else
            document.getElementById('prioridad').value = 1
                     
    })
    .catch(err=>console.log(err))
    
})


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
        infoTextSpan.innerText = props.destino
        
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
        if(props.color == 'green'){
            link.setAttribute('href',`extensiones/fpdf/informesPdf.php?informe=carpeta&idCarpeta=${props.idCarpeta}`)
        }else{    
            link.setAttribute('href','')
            link.setAttribute('style','pointer-events: none;cursor:not-allow;')
        }
        link.appendChild(infoDiv)

        let li = document.createElement('LI')
        li.setAttribute('class','item')

        li.appendChild(link)

        let colDiv = document.createElement('DIV')
        colDiv.setAttribute('class','col-lg-6')

        colDiv.appendChild(li)

        return colDiv

    }

    const mostrarCarpetasActivas = ()=>{
    
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

                    let description = `${reg.animales}/${reg.cantidad}`
                    
                    let color = 'yellow'

                    if(reg.completa){

                        description = 'Completo'

                        color = 'green'

                    } 

                    let percentage = `${(reg.animales * 100) / reg.cantidad}%`
                    
                    let props = {
                        description,
                        percentage,
                        clasification:reg.clasificacion,
                        destino:reg.destino,
                        animales:reg.animales,
                        color,
                        idCarpeta:reg.idCarpeta
                    }

                    docFragment.appendChild(generarCarpeta(props))

                })

                row.appendChild(docFragment)

                document.getElementById('carpetasScroll').firstElementChild.firstElementChild.appendChild(row)

            }

        })

    }

    mostrarCarpetasActivas()

    
// ELIMINAR CARPETA

let btnsEliminarCarpetas = document.getElementsByClassName('btnEliminarCarpeta')

for (const btn of btnsEliminarCarpetas) {
    
    btn.addEventListener('click',(e)=>{

        e.preventDefault()
        let id = (e.path[0].attributes.length > 1) ? e.path[0].attributes.idcarpeta.value : e.path[1].attributes.idcarpeta.value 
        console.log(id);
        

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
    
}



