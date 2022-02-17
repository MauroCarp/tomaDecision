
// CAMBIAR ESTILO ULTIMA COLUMNA TABLA CLASIFICACION

const rows = document.querySelectorAll('.tablaClasificacion tbody tr')

for (const row of rows) {
    
     row.lastElementChild.style.textAlign = 'center'

}

// ALTO SECCION CARPETAS ACTIVAS
let altoSeccionClasificacion = document.getElementById('seccionClasificacion').clientHeight

document.getElementById('seccionCarpetaAct').style.height = `${altoSeccionClasificacion}px`

// ALTO SECCION CONFIGURACION

setTimeout(() => {
     
     let altoSeccionIngresos = document.getElementById('ingresoAnimal').offsetHeight
     let altoSeccionTablaIng = document.getElementById('tablaIngresos').offsetHeight
     
     document.getElementById('seccionConfiguracion').style.height = `${altoSeccionIngresos + altoSeccionTablaIng + 20}px`

     for (const iterator of document.getElementsByClassName('sliders')) {
          
          iterator.style.height = '15%'
          
     }
     
}, 500);
