let params = {
    fetchUrl:'cargarSelect',
    accion:'perfiles',
    value:'id',
    optText:'nombre',
    idSelect:'perfilesClasificacion'
}

cargarSelect(params)

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

document.getElementById('perfilesClasificacion').addEventListener('change',(e)=>{

    let idPerfil = e.target.value

    // actualizarSliders(idPerfil)

    actualizarClasificacion(idPerfil)

})

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
                
        document.getElementById('totalAnimales').innerText = respuesta.total
        document.getElementById('cantGeneralFlacas').innerText = respuesta.flacas
        document.getElementById('cantGeneralBuenas').innerText = respuesta.buenas
        document.getElementById('cantGeneralBuenasMas').innerText = respuesta.buenasMas
        document.getElementById('cantGeneralMuyBuenas').innerText = respuesta.muyBuenas
        document.getElementById('cantGeneralAP').innerText = respuesta.apenasGordas
        document.getElementById('cantGeneralGordas').innerText = respuesta.gordas

        let barGeneralFlacas = Math.round((respuesta.flacas*100) / respuesta.total) 
        let barGeneralBuenas = Math.round((respuesta.buenas*100) / respuesta.total) 
        let barGeneralBuenasMas = Math.round((respuesta.buenasMas*100) / respuesta.total) 
        let barGeneralMuyBuenas = Math.round((respuesta.muyBuenas*100) / respuesta.total) 
        let barGeneralAP = Math.round((respuesta.apenasGordas*100) / respuesta.total) 
        let barGeneralGordas = Math.round((respuesta.gordas*100) / respuesta.total) 

        document.getElementById('barGeneralFlacas').style.width = `${barGeneralFlacas}%`
        document.getElementById('barGeneralBuenas').style.width = `${barGeneralBuenas}%`
        document.getElementById('barGeneralBuenasMas').style.width = `${barGeneralBuenasMas}%`
        document.getElementById('barGeneralMuyBuenas').style.width = `${barGeneralMuyBuenas}%`
        document.getElementById('barGeneralAP').style.width = `${barGeneralAP}%`
        document.getElementById('barGeneralGordas').style.width = `${barGeneralGordas}%`
        
        document.getElementById('porcGeneralFlacas').innerText = (respuesta.flacas != 0) ? `${barGeneralFlacas}%` : '0%'
        document.getElementById('porcGeneralBuenas').innerText = (respuesta.buenas != 0) ?  `${barGeneralBuenas}%`  : '0%'
        document.getElementById('porcGeneralBuenasMas').innerText = (respuesta.buenasMas != 0) ?  `${barGeneralBuenasMas}%` : '0%'
        document.getElementById('porcGeneralMuyBuenas').innerText = (respuesta.muyBuenas != 0) ?  `${barGeneralMuyBuenas}%` : '0%'
        document.getElementById('porcGeneralAP').innerText = (respuesta.apenasGordas != 0) ?  `${barGeneralAP}%` : '0%'
        document.getElementById('porcGeneralGordas').innerText = (respuesta.gordas != 0) ?  `${barGeneralGordas}%` : '0%'


    })
    .catch(err=>console.log(err))

}

setTimeout(() => {
    
        let idPerfilClas = document.getElementById('perfilesClasificacion').value

        // actualizarSliders(idPerfilClas)
            
        actualizarClasificacion(idPerfilClas)

}, 300);    

