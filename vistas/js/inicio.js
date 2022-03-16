
// CAMBIAR ESTILO ULTIMA COLUMNA TABLA CLASIFICACION

const rows = document.querySelectorAll('.tablaClasificacion tbody tr')

for (const row of rows) {
    
     row.lastElementChild.style.textAlign = 'center'

}

// ALTO SECCION CARPETAS ACTIVAS
let altoSeccionClasificacion = document.getElementById('seccionClasificacion').clientHeight

document.getElementById('seccionCarpetaAct').style.height = `${altoSeccionClasificacion}px`


setTimeout(()=>{

     let altoSeccionIngresos = document.getElementById('ingresoAnimal').offsetHeight
     let altoSeccionTablaIng = document.getElementById('tablaIngresos').offsetHeight
     
     document.getElementById('seccionConfiguracion').style.height = `${altoSeccionIngresos + altoSeccionTablaIng + 20}px`
     
     for (const iterator of document.getElementsByClassName('sliders')) {
          
          iterator.style.height = '15%'
          
     }

},300)


let value = document.getElementById('flacasInputId').value
document.getElementById('flacasOutputId').innerHTML = value    

value = document.getElementById('buenasInputId').value
document.getElementById('buenasOutputId').innerHTML = value    

value = document.getElementById('buenasPlusInputId').value
document.getElementById('buenasPlusOutputId').innerHTML = value    

value = document.getElementById('muyBuenasInputId').value
document.getElementById('muyBuenasOutputId').innerHTML = value    

value = document.getElementById('apenasGordasInputId').value
document.getElementById('apenasGordasIutputId').innerHTML = value    
