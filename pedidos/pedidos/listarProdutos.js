//script responsável por mostrar o produto  na lista de pedidos  abaixo 

//quantidade
valores = [{}]

key = 1

let listar = () => {
    fornecedor = document.getElementById("fornecedor").options[0].value;
    produto = document.getElementById("produto").options[0].text;
    valorUnit = document.getElementById("valorUnit").textContent
    valorUnitFormatado = parseFloat(valorUnit.replace("R$", "").replace(",", ""))
    valorTotal = document.getElementById("valorTotal").textContent
    valorTotalFormatado = parseFloat(valorTotal.replace("R$", "").replace(",", ""))
    quantidade = document.getElementById("quantidade").value
    quantidadeFormatada = parseFloat(quantidade.replace("R$", "").replace(",", ""))

    if (fornecedor === "" || produto === "") {
        alert("Preencha o  campo vazio  ")
    } else {


        //recuperaos valores 
        valores[0].nome = fornecedor
        valores[0].produto = produto
        valores[0].valorUnit = valorUnitFormatado
        valores[0].valorUnitString = valorUnit
        valores[0].valorTotal = valorTotalFormatado
        valores[0].valorTotalString = valorTotal
        valores[0].quantidade = quantidadeFormatada
        valores[0].id = key++


        adicionarItemPedido()
        quantidade = document.getElementById("quantidade").value = 1

        document.getElementById("pesquisaFornecedor").value = ""
        document.getElementById("pesquisaProduto").value = ""
        document.getElementById("valorTotal").textContent = valorUnit



    }
    // Reatribuir eventos dos botões de aumentar e diminuir quantidade
    quantidade = document.getElementById("quantidade");
    valorUnit = document.getElementById("valorUnit");

    quantidadeInicial = 1;
    quantidadeAtual = quantidadeInicial;



}

let adicionarItemPedido = () => {
    Item = document.getElementById("containerList")
    return (Item.innerHTML += valores.map((x, index) => {
        let { nome, produto, id, valorUnit, valorTotal, valorUnitString, valorTotalString, quantidade } = x
        return `
            
            <div id="${id}" class="containerProdutoPedido">

                <div class="dadosPedido">
                    <div id="fornecedorNome" class="fornecedor" >${nome}</div>
                    <div class="quantidades2" >
                        <div  id="qnt" >${quantidade}</div>
                        <div id="vlr">${valorTotalString}</div>
                        <div onclick="trocarDisplay('info${id}' , 'img${id}'  )"  id="verMais"><img id="img${id}" src="../../assets/eye.svg" alt="Olho vetor"></div>
                    </div>
                </div>


                <div id="info${id}" class="dadosPedidoSecundario">
                    <div id="produtoLista" class="produtoLista" >${produto}</div>
                    <div class="quantidades3" >

                        <div id="vlr">Unit ${valorUnitString}</div>
                        <div onclick="apagarItem(${id})" id="verMais${id}"><img src="../../assets/erase.svg" alt="Olho vetor"></div>
                    </div>
                </div>
            </div>
            
            `
    }))
}


var apagarItem = (id) => {
    let div = document.getElementById(id)
    div.remove()
}