quantidade = document.getElementById("quantidade");
valorUnit = document.getElementById("valorUnit");

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
