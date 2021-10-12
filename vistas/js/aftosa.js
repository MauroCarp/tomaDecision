/*=============================================
CARGAR ACTA
=============================================*/
const btnCargarActa = document.getElementById('btnCargarActa');

btnCargarActa.addEventListener('click',()=>{


    let campania = localStorage.getItem('campania');
    
    let renspa = $('#renspaAftosa').val();
    
    let intercampania = $('#interCampania').is(':checked') ? true : false;

    window.location = `index.php?ruta=aftosa/acta&renspa=${renspa}&campania=${campania}&intercampania=${intercampania}`

});