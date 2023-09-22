
//div  que será escondida
const  div = document.getElementById('searchClient')
//select com o  valor do nome do cliente
const select=document.getElementById('select')
//input que receberá o valor 
const input = document.getElementById('cliente')


let ContinuarParaPedidos =()=>{

    div.style.display = 'none'

    const primeiroOption= select.options[0]
    const valorPrimeiroOption = primeiroOption.value

     input.value  = valorPrimeiroOption
  
}

