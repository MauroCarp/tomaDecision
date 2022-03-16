// MOSTRAR MODAL

const showPerfilModal = (idShow,idHide)=>{

    let modalHide = document.getElementById(idHide)

    modalHide.classList.remove('showPerfilModal')
    
    modalHide.classList.add('hideElement')

    let modalShow = document.getElementById(idShow)

    modalShow.classList.remove('hideElement')

    modalShow.classList.add('showPerfilModal')

    document.getElementById('modalPerfil').style.width = '800px'

    document.getElementById('perfilesList').style.width = '50%'
}

// TOGGLE FUNCTION
const toggleModal = (idShow,idHide)=>{

    let modalPerfil = document.getElementById(idShow)
    

    if(modalPerfil.classList[1] == 'showPerfilModal' && idShow != 'modalEditarPerfil'){
        
        modalPerfil.classList.add('hideElement')
        modalPerfil.classList.remove('showPerfilModal')
        
    }else{
        
        showPerfilModal(idShow,idHide)

    }

}

// BTN NUEVO PERFIL

const btnNuevoPerfil = document.getElementById('btnNuevoPerfil')

btnNuevoPerfil.addEventListener('click',()=>{

    toggleModal('modalNuevoPerfil','modalEditarPerfil')

    let value = document.getElementById('flacasConfInputId').value
    document.getElementById('flacasConfOutputId').innerHTML = value    
    
    value = document.getElementById('buenasConfInputId').value
    document.getElementById('buenasConfOutputId').innerHTML = value    
    
    value = document.getElementById('buenasPlusConfInputId').value
    document.getElementById('buenasPlusConfOutputId').innerHTML = value    
    
    value = document.getElementById('muyBuenasConfInputId').value
    document.getElementById('muyBuenasConfOutputId').innerHTML = value    
    
    value = document.getElementById('apenasGordasConfInputId').value
    document.getElementById('apenasGordasConfIutputId').innerHTML = value    
    


})

// BTN EDITAR PERFIL

const btnsEditar = document.getElementsByClassName('btnEditarPerfil')

for (const btn of btnsEditar) {
    
    btn.addEventListener('click',(e)=>{
        
        let idPerfil = (e.path[0].attributes.length > 1) ? e.path[0].attributes.idperfil.nodeValue : e.path[1].attributes.idperfil.nodeValue
        
        let modal = document.getElementById('modalEditarPerfil')
        
        if(modal.classList[1] != 'showPerfilModal')
            showPerfilModal('modalEditarPerfil','modalNuevoPerfil')

        let url = 'fetch/perfiles.fetch.php'
        
        let formData = new FormData()
        formData.append('accion','mostrarPerfil')
        formData.append('idPerfil',idPerfil)

        fetch(url,{
            method:'post',
            body:formData
        })
        .then(resp=>resp.json())
        .then(respuesta=>{

            document.getElementById('nombrePerfilEdit').value = respuesta.nombre
            document.getElementById('idPerfilEdit').value = respuesta.id

            document.getElementById('flacasConfEditInputId').value = respuesta.flacas
            document.getElementById('buenasConfEditInputId').value = respuesta.buenas
            document.getElementById('buenasPlusConfEditInputId').value = respuesta.buenasMas
            document.getElementById('muyBuenasConfEditInputId').value = respuesta.muyBuenas
            document.getElementById('apenasGordasConfEditInputId').value = respuesta.apenasGordas

            document.querySelector('output[name=flacasConfEditOutput]').innerHTML = respuesta.flacas
            document.querySelector('output[name=buenasConfEditOutput]').innerHTML = respuesta.buenas
            document.querySelector('output[name=buenasPlusConfEditOutput]').innerHTML = respuesta.buenasMas
            document.querySelector('output[name=muyBuenasConfEditOutput]').innerHTML = respuesta.muyBuenas
            document.querySelector('output[name=apenasGordasConfEditOutput]').innerHTML = respuesta.apenasGordas


        })
        .catch(err=>console.error(err))


    })

}


// ELIMINAR PERFILES
const btnsEliminar = document.getElementsByClassName('btnEliminarPerfil')

for (const btn of btnsEliminar) {
    
    btn.addEventListener('click',(e)=>{
        
        e.preventDefault()

        let id = (e.path[0].attributes.length > 1) ? e.path[0].attributes.idPerfil.value : e.path[1].attributes.idPerfil.value 

        new swal({
            title: '¿Eliminar Perfil?',
            text: "¡Si no lo está puede cancelar la accíón!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              cancelButtonText: 'Cancelar',
              confirmButtonText: 'Si, eliminar perfil!'
          }).then(function(result){
        
            if(result.value){
        
            
                window.location = `index.php?ruta=inicio&idPerfil=${id}`

            }

        });

    })
}

// DESCATIVAR ACTIVAR PERFILES

const btnsActDesac = document.getElementsByClassName('btnActDesacPerfil')

for (const btn of btnsActDesac) {
    
    btn.addEventListener('click',(e)=>{
        
        e.preventDefault()

        let id = (e.path[0].attributes.length > 1) ? e.path[0].attributes.idPerfil.value : e.path[1].attributes.idPerfil.value 

        new swal({
            title: '¿Cambiar estado de Perfil?',
            text: "¡Si no lo está puede cancelar la accíón!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              cancelButtonText: 'Cancelar',
              confirmButtonText: 'Si, cambiar estado!'
          }).then(function(result){
        
            if(result.value){
        
            
                let url = 'fetch/perfiles.fetch.php'

                let formData = new FormData()
                formData.append('accion','cambiarEstado')
                formData.append('idPerfil',id)

                fetch(url,{
                    method:'post',
                    body:formData
                })
                .then(resp=>resp.json())
                .then(respuesta=>{

                    let Toast =  swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                        });
                    
                        console.log(respuesta);
                        
                    if(respuesta.state == 'carpetaActiva'){                        
                        
                        Toast.fire({
    
                            icon: 'error',
                            title:'El perfil esta asignado en una carpeta ACTIVA'

                        })
                        
                        return 

                    }

                    if(respuesta.state == 'ok'){
                                            
                        let btn = e.path[1]
                        
                        let icon = e.path[0]

                        if(e.path[0].attributes.length > 1){
                            
                            btn = e.path[0]
                            
                            icon = btn.firstElementChild

                        }

                        let title = 'Desactivado'
                        
                        console.log(respuesta.activo);
                        
                        if(respuesta.activo == 1){
                                
                            title = 'Activado'
                                                        
                            btn.classList.replace('btn-danger','btn-success')
                            icon.classList.replace('fa-ban','fa-check')
                            
                        }else{
                            
                            btn.classList.replace('btn-success','btn-danger')
                            icon.classList.replace('fa-check','fa-ban')
                            
                        }

                        Toast.fire({
    
                            icon: 'success',
                            title

                        })
                                
                    }else{

                        Toast.fire({
    
                            icon: 'error',
                            title: 'Error'
        
                        })

                    }

                })
                .catch(err=>console.log('Error:' + err))


            }

        });

    })
}