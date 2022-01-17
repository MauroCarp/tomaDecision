const formsBuscarMatricula = document.getElementsByClassName('formBuscarMatricula')

if(formsBuscarMatricula.length > 0){

    for (const btn of formsBuscarMatricula) {
        
        btn.addEventListener('submit',(e)=>{

            e.preventDefault()
            
            let informeId = e.target[0].id
            
            let informeNum = informeId.replace('matriculaInforme','')
            
            let matricula = document.getElementById(informeId).value
                        
            if(matricula != ''){

                let matriculaValida = (matricula.match(/[0-9][-]...([\d{4}])/) && matricula.length == 6)

                if(matriculaValida){
            
                    if(informeNum == 3)
                        window.open(`extensiones/fpdf/informesPdf.php?informe=informe${informeNum}&matricula=${matricula}`)
                    else
                        window.location = `index.php?ruta=aftosa/informes/informe${informeNum}&matricula=${matricula}`
                        
                    
                }else{

                    swal({
                        type: "error",
                        title: "El formato de la matricula no es el correcto",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                        })

                }
        
            }else{

                swal({
                    type: "error",
                    title: "El campo Matricula esta Vacio",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"
                    })

            }        
            
        })
        
        
    }
}
