
// CAMBIAR ESTILO ULTIMA COLUMNA TABLA CLASIFICACION

const rows = document.querySelectorAll('.tablaClasificacion tbody tr')

for (const row of rows) {
    
     row.lastElementChild.style.textAlign = 'center'

}

// ALTO SECCION CARPETAS ACTIVAS

let altoSeccionDestino = document.getElementById('seccionDestino').clientHeight

let altoPantalla = window.innerHeight

document.getElementById('divCarpetas').style.height = `${altoPantalla - altoSeccionDestino - 280}px`


