function imprimirPagina(){
    window.print()
}


function imprimirRelatorios(){
   

    let divs = document.querySelectorAll('.containerDiscItens')

    divs.forEach(function(div){
        div.style.display= 'block'
    }) 
    
    window.print()
}