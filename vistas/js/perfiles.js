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

})

// BTN EDITAR PERFIL

const btnsEditar = document.getElementsByClassName('btnEditarPerfil')

for (const btn of btnsEditar) {
    
    btn.addEventListener('click',(e)=>{
        
    //     let idPerfil = (e.path[0].attributes.length > 1) ? e.path[0].attributes.idperfil.nodeValue : e.path[1].attributes.idperfil.nodeValue
        let modal = document.getElementById('modalEditarPerfil')
        // console.log(modal.classList);
        
        if(modal.classList[1] != 'showPerfilModal')
            showPerfilModal('modalEditarPerfil','modalNuevoPerfil')

    })


}

// BTNS + - SLIDERS CONFIGURACION 

const btnsMinus = document.getElementsByClassName('btn-slider-minus')

for (const btnMinus of btnsMinus) {
    
    let inputValue = btnMinus.parentNode.nextElementSibling
    
    
    btnMinus.addEventListener('click',()=>{
        
        let min = Number(inputValue.min)

        inputValue.value = (inputValue.value == min)  ? 0 : inputValue.value - 1

        inputValue.oninput()
        
    })
    
}

const btnsPlus = document.getElementsByClassName('btn-slider-plus')

for (const btnPlus of btnsPlus) {
    
    let inputValue = btnPlus.parentNode.previousElementSibling
    
    btnPlus.addEventListener('click',()=>{

        let max = Number(inputValue.max)

        inputValue.value = (inputValue.value == max) ? max : Number(inputValue.value) + 1

        inputValue.oninput()
        
    })

}
