// BTNS + - SLIDERS CONFIGURACION 

const btnsMinus = document.getElementsByClassName('btn-slider-minus')

for (const btnMinus of btnsMinus) {
    
    let inputValue = btnMinus.parentNode.nextElementSibling
    
    
    btnMinus.addEventListener('click',()=>{
        
        let value = inputValue.value - 5

        inputValue.value = value

        inputValue.oninput()

        // inputValue.parentNode.parentNode.nextElementSibling.children[1].children[1].max = value - 1 
        
    })
    
}

const btnsPlus = document.getElementsByClassName('btn-slider-plus')

for (const btnPlus of btnsPlus) {
    
    let inputValue = btnPlus.parentNode.previousElementSibling
    
    btnPlus.addEventListener('click',()=>{

        let value = Number(inputValue.value) + 5

        inputValue.value = value   

        inputValue.oninput()

        // inputValue.parentNode.parentNode.nextElementSibling.children[1].children[1].max = value - 1 
        
    })

}
