function imprimirPagina(){
    const containerEtiquetas = document.getElementById('containerEtiquetas')
    containerEtiquetas.style.display= 'none' 
    window.print()
    containerEtiquetas.style.display= 'block' 

   

}







function imprimirRelatorios(){
   

    let divs = document.querySelectorAll('.containerDiscItens')

    divs.forEach(function(div){
        div.style.display= 'block'
    }) 
    
    window.print()
}


let imprimirEtiquetas = () => {
    const bodyelement = document.getElementById('containerBody')
    const containerEtiquetas = document.getElementById('containerEtiquetas')
    containerEtiquetas.style.visibility= 'visible' 
    bodyelement.style.display= 'none'
    
    print()
  
    containerEtiquetas.style.visibility= 'hidden' 
    bodyelement.style.display= 'block'
    window.location.reload()
    
    



}