

//essa função mostra as informações abaixo do produto  como valor unit e nome do produto 

let trocarDisplay = (id) => {
    let div = document.getElementById(id)
  
    if (div.style.display == "none") {
        div.style.display = "block"
       
    } else {
        div.style.display = "none"
  
    }
}