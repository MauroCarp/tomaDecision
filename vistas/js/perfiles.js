// BTN NUEVO PERFIL

const btnNuevoPerfil = document.getElementById('btnNuevoPerfil')

btnNuevoPerfil.addEventListener('click',()=>{

    let ventana = document.getElementById('nuevoPerfil')

    let display = (ventana.style.display == 'none') ? 'block' : 'none'

    ventana.style.display = display

})

// BTN EDITAR PERFIL

const btnsEditar = document.getElementsByClassName('btnEditarPerfil')

for (const btn of btnsEditar) {
    
    btn.addEventListener('click',(e)=>{
        
        let idPerfil = (e.path[0].attributes.length > 1) ? e.path[0].attributes.idperfil.nodeValue : e.path[1].attributes.idperfil.nodeValue
        
        let ventanaNuevoPerfil = document.getElementById('nuevoPerfil')

        ventanaNuevoPerfil.style.display = 'none'

        let ventanaEditarPerfil = document.getElementById('editarPerfil')

        let toggle = (ventanaEditarPerfil.style.display == 'none') ? 'block' : 'none'

        ventanaEditarPerfil.style.display = toggle
    
    })

}