const btnBuscarMatricula = document.getElementsByClassName('buscarMatricula')

if(btnBuscarMatricula.length > 0){

    for (const btn of btnBuscarMatricula) {

        btn.addEventListener('click',(e)=>{

            e.preventDefault()
            
            let informeNum = e.target.attributes[3].nodeValue

            let matricula = document.getElementById(`matriculaInforme${informeNum}`).value

            if(matricula != ''){

                let matriculaValida = (matricula.match(/[0-9][-]...([\d{4}])/) && matricula.length == 6)

                if(matriculaValida){

                    window.open(`extensiones/fpdf/informesPdf.php?informe=informe${informeNum}&matricula=${matricula}`)

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
