// BTN NUEVO PERFIL

const btnNuevoPerfil = document.getElementById('btnNuevoPerfil')

btnNuevoPerfil.addEventListener('click',()=>{
    
    // OCULTAR EDITAR
    
    document.getElementById('editarPerfil').style.display = 'none'

    // MOSTRAR NUEVO

    let ventana = document.getElementById('nuevoPerfil')

    let display = (ventana.style.display == 'none') ? 'block' : 'none'

    ventana.style.display = display

})

// BTN EDITAR PERFIL

const btnsEditar = document.getElementsByClassName('btnEditarPerfil')

for (const btn of btnsEditar) {
    
    btn.addEventListener('click',(e)=>{
        
        let idPerfil = (e.path[0].attributes.length > 1) ? e.path[0].attributes.idperfil.nodeValue : e.path[1].attributes.idperfil.nodeValue
        
        // OCULTAR NUEVO

        document.getElementById('nuevoPerfil').style.display = 'none'

        // MOSTRAR EDITAR

        let ventanaEditarPerfil = document.getElementById('editarPerfil')

        let toggle = (ventanaEditarPerfil.style.display == 'none') ? 'block' : 'none'

        ventanaEditarPerfil.style.display = toggle
    
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
