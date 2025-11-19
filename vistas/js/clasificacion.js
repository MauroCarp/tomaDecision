// CARGAR CONFIG SLIDERS INICIO

const actualizarSliders = (idPerfil)=>{

    // Obtener datos del perfil

    let url = 'fetch/perfiles.fetch.php'

    let formData = new FormData()
    formData.append('accion','mostrarPerfil')
    formData.append('idPerfil',idPerfil)

    fetch(url,{
        method : 'post',
        body : formData
    })
    .then(resp=>resp.json())
    .then(respuesta=>{

        document.getElementById('flacasInputId').value = respuesta.flacas
        document.getElementById('buenasInputId').value = respuesta.buenas
        document.getElementById('buenasPlusInputId').value = respuesta.buenasMas
        document.getElementById('muyBuenasInputId').value = respuesta.muyBuenas
        document.getElementById('apenasGordasInputId').value = respuesta.apenasGordas

        document.querySelector('output[name=flacasOutput]').innerHTML = respuesta.flacas
        document.querySelector('output[name=buenasOutput]').innerHTML = respuesta.buenas
        document.querySelector('output[name=buenasPlusOutput]').innerHTML = respuesta.buenasMas
        document.querySelector('output[name=muyBuenasOutput]').innerHTML = respuesta.muyBuenas
        document.querySelector('output[name=apenasGordasOutput]').innerHTML = respuesta.apenasGordas

        
    })
    .catch(err=>console.log(err))

}

// ACTUALIZAR CLASIFICACION

const actualizarClasificacion = (idPerfilClas)=>{

    let url = 'fetch/animales.fetch.php'

    let formData = new FormData()
    formData.append('accion','actualizarClasificacion')
    formData.append('idPerfil',idPerfilClas)
    
    fetch(url,{
        method:'post',
        body:formData
    })
    .then(resp=>resp.json())
    .then(respuesta=>{

        let tipo = 'Gordos'

        for (let index = 0; index < 2; index++) {
            if(index == 1)
                tipo = 'Corral'

            document.getElementById(`totalAnimales${tipo}`).innerText = respuesta[tipo].total
            document.getElementById(`cantGeneralFlacas${tipo}`).innerText = respuesta[tipo].flacas
            document.getElementById(`cantGeneralBuenas${tipo}`).innerText = respuesta[tipo].buenas
            document.getElementById(`cantGeneralBuenasMas${tipo}`).innerText = respuesta[tipo].buenasMas
            document.getElementById(`cantGeneralMuyBuenas${tipo}`).innerText = respuesta[tipo].muyBuenas
            document.getElementById(`cantGeneralAP${tipo}`).innerText = respuesta[tipo].apenasGordas
            document.getElementById(`cantGeneralGordas${tipo}`).innerText = respuesta[tipo].gordas
    
            let barGeneralFlacas = Math.round((respuesta[tipo].flacas*100) / respuesta[tipo].total) 
            let barGeneralBuenas = Math.round((respuesta[tipo].buenas*100) / respuesta[tipo].total) 
            let barGeneralBuenasMas = Math.round((respuesta[tipo].buenasMas*100) / respuesta[tipo].total) 
            let barGeneralMuyBuenas = Math.round((respuesta[tipo].muyBuenas*100) / respuesta[tipo].total) 
            let barGeneralAP = Math.round((respuesta[tipo].apenasGordas*100) / respuesta[tipo].total) 
            let barGeneralGordas = Math.round((respuesta[tipo].gordas*100) / respuesta[tipo].total) 
    
            document.getElementById(`barGeneralFlacas${tipo}`).style.width = `${barGeneralFlacas}%`
            document.getElementById(`barGeneralBuenas${tipo}`).style.width = `${barGeneralBuenas}%`
            document.getElementById(`barGeneralBuenasMas${tipo}`).style.width = `${barGeneralBuenasMas}%`
            document.getElementById(`barGeneralMuyBuenas${tipo}`).style.width = `${barGeneralMuyBuenas}%`
            document.getElementById(`barGeneralAP${tipo}`).style.width = `${barGeneralAP}%`
            document.getElementById(`barGeneralGordas${tipo}`).style.width = `${barGeneralGordas}%`
            
            document.getElementById(`porcGeneralFlacas${tipo}`).innerText = (respuesta[tipo].flacas != 0) ? `${barGeneralFlacas}%` : '0%'
            document.getElementById(`porcGeneralBuenas${tipo}`).innerText = (respuesta[tipo].buenas != 0) ?  `${barGeneralBuenas}%`  : '0%'
            document.getElementById(`porcGeneralBuenasMas${tipo}`).innerText = (respuesta[tipo].buenasMas != 0) ?  `${barGeneralBuenasMas}%` : '0%'
            document.getElementById(`porcGeneralMuyBuenas${tipo}`).innerText = (respuesta[tipo].muyBuenas != 0) ?  `${barGeneralMuyBuenas}%` : '0%'
            document.getElementById(`porcGeneralAP${tipo}`).innerText = (respuesta[tipo].apenasGordas != 0) ?  `${barGeneralAP}%` : '0%'
            document.getElementById(`porcGeneralGordas${tipo}`).innerText = (respuesta[tipo].gordas != 0) ?  `${barGeneralGordas}%` : '0%'
        }


    })
    .catch(err=>console.log(err))

}

if(document.getElementById('perfilesClasificacion') != null){

    document.getElementById('perfilesClasificacion').addEventListener('change',(e)=>{

    let idPerfil = e.target.value

    // actualizarSliders(idPerfil)

    actualizarClasificacion(idPerfil)

    })
    
    setTimeout(() => {
    
        let idPerfilClas = document.getElementById('perfilesClasificacion').value

        actualizarClasificacion(idPerfilClas)

    }, 800);    

    let params = {
        fetchUrl:'cargarSelect',
        accion:'perfiles',
        value:'id',
        optText:'nombre',
        idSelect:'perfilesClasificacion'
    }
    
    cargarSelect(params)

}

