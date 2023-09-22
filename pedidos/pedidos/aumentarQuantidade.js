quantidade = document.getElementById("quantidade");
valorUnit = document.getElementById("valorUnit");

let quantidadeInicial = 1;
let quantidadeAtual = quantidadeInicial;

const aumentarValor = () => {
    quantidade.value = ++quantidadeAtual;
    calcularTotal();
};

const subtrairValor = () => {
    if (quantidadeAtual > 1) {
        quantidade.value = --quantidadeAtual;
    }
    calcularTotal();
};
