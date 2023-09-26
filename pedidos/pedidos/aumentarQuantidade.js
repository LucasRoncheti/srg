quantidade = document.getElementById("quantidade");

InputAumentarCaixasRestantes = document.getElementById("inputCxRest")


let quantidadeInicial = 1;
let quantidadeAtual = quantidadeInicial;

var aumentarValor = () => {
    quantidade.value = ++quantidadeAtual;
    calcularTotal();
};

var subtrairValor = () => {
    if (quantidadeAtual > 1) {
        quantidade.value = --quantidadeAtual;
    }
    calcularTotal();
};

var zerarValor = () => {
    if (quantidadeAtual > 1) {
        quantidade.value = 0;
    }
    calcularTotal();
};

//atualiza a quantidade digitando o numero 
quantidade.addEventListener('change',function(){
    quantidadeAtual = parseFloat(quantidade.value)
    calcularTotal()
})

InputAumentarCaixasRestantes.addEventListener('input', function(){

    caixasTotais = parseFloat(InputAumentarCaixasRestantes.value)
    document.getElementById("CxRest").innerHTML =  caixasTotais
    calcularTotal()
})
