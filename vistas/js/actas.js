const sumaParcialTotal = (tipoSuma)=>{

    let cantidades = document.getElementsByClassName(tipoSuma)

    let total = 0;

    for (const cantidad of cantidades) {

        total += Number(cantidad.value)
        
    }

    return total

}

if(seccionURL == 'aftosa/acta'){

    // SUMAR TOTALES Y PARCIALES

    let cantidadesTotal = document.getElementsByClassName('sumTotal')

    for (const cantidad of cantidadesTotal) {
        
        cantidad.addEventListener('change',()=>{

            document.getElementById('campoTotal').value = sumaParcialTotal('sumTotal')

        })  
              
    }

    let cantidadesParcial = document.getElementsByClassName('sumParcial')

    for (const cantidad of cantidadesParcial) {
        
        cantidad.addEventListener('change',()=>{

            document.getElementById('campoParcial').value = sumaParcialTotal('sumParcial')

        })  

    }

    // CARGAR SELECT VETERINARIOS

    let params = {
        idSelect:'vacunador',
        accion:'listarVeterinarios',
        ajax:'veterinarios',
        value:'matricula',
        optText:'nombre'
    }
    
    cargarSelect(params)



}