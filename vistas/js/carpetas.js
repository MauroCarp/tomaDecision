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

