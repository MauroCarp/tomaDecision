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
        console.log(respuesta);
        
        document.getElementById('flacasInputId').value = respuesta.flacas
        document.getElementById('buenasInputId').value = respuesta.buenas
        document.getElementById('buenasPlusInputId').value = respuesta.buenasMas
        document.getElementById('muyBuenasInputId').value = respuesta.muyBuenas
        document.getElementById('apenasGordasInputId').value = respuesta.apenasGordas
    
    })
    .catch(err=>console.log(err))

}

setTimeout(() => {
    
    let idPerfilClas = document.getElementById('perfilesClasificacion').value

    actualizarSliders(idPerfilClas)

}, 500);

document.getElementById('perfilesClasificacion').addEventListener('change',(e)=>{

    let idPerfil = e.target.value

    actualizarSliders(idPerfil)

})


