// BTN NUEVO PERFIL

const btnNuevaCarpeta = document.getElementById('btnNuevaCarpeta')

btnNuevaCarpeta.addEventListener('click',()=>{

    document.getElementById('modalNuevaCarpeta').classList.toggle('hideElement')
    document.getElementById('modalNuevaCarpeta').classList.toggle('showPerfilModal')

    document.getElementById('modalCarpeta').style.width = '800px'

    document.getElementById('carpetasList').style.width = '50%'

})
