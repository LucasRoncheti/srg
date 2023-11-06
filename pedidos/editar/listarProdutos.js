//script responsável por mostrar o produto  na lista de pedidos  abaixo 

//quantidade
valores = [{}]
//valores que serão usados para fazer a soma total dos valores e quantidade de produtos
var itensParaSoma = []

//variavel que armazena a quantidade de caixas que serão calculadas no pedido
var  caixasTotais = 1400;

var  valorTotalBD;

key =  0


//pega o valor total para fazer a soma e converte em inteiro 
valorTotaldoPedido = document.getElementById('valorTotalPedido').textContent
valorTotaldoPedidoSemSimbolos = valorTotaldoPedido.replace(/[^\d,]/g, '')
var valorInteiro = parseInt(valorTotaldoPedidoSemSimbolos.replace(',', ''), 10);
//pega a quantidade de caixas já salva no banco de dados 

quantidadeCaixas = document.getElementById("Ncaixas").textContent
var quantidadeCaixasInterio = parseInt(quantidadeCaixas.replace(',', ''), 10);

let listar = () => {
    fornecedor = document.getElementById("fornecedor").options[0].value;
    produto = document.getElementById("produto").options[0].text;
    valorUnit = document.getElementById("valorUnit").textContent
    valorUnitFormatado = parseFloat(valorUnit.replace("R$", "").replace(",", ""))
    valorTotal = document.getElementById("valorTotal").textContent
    valorTotalFormatado = parseFloat(valorTotal.replace("R$", "").replace(",", ""))
    quantidade = document.getElementById("quantidade").value
    quantidadeFormatada = parseFloat(quantidade.replace("R$", "").replace(",", ""))

    //recupera a data a ser salvo no banco de dados para conseguir ser achada nos relatórios
    dataAtual = document.getElementById("DataAtual").value
    
    

     
   

    //chave de acesso gerada na hora de salvar o pedido pela primeira vez 
    let chaveAcessoCliente = document.getElementById("chaveAcesso").value

   
    if (!fornecedor || produto === "" || fornecedor === " Fornecedor não encontrado " || produto === "Produto não encontrado" ) {
        alert("Preencha o campo vazio ! ")
        
    } else {

        calcularTotal()

        //recuperaos valores a serem mapeados na função adicionarItemPedido()
        valores[0].nome = fornecedor
        valores[0].produto = produto
        valores[0].valorUnit = valorUnitFormatado
        valores[0].valorUnitString = valorUnit
        valores[0].valorTotal = valorTotalFormatado
        valores[0].valorTotalString = valorTotal
        valores[0].quantidade = quantidadeFormatada
        valores[0].id = key++

        //recupera os valores para fazer a soma total de caixas e valor total 
        novoDicionarioItens = {}
        novoDicionarioItens['id'] = key 
        novoDicionarioItens['fornecedor'] = fornecedor 
        novoDicionarioItens['produto'] = produto 
        novoDicionarioItens['valorUnit'] = valorUnitFormatado 
        novoDicionarioItens['valorTotal'] = valorTotalFormatado
        novoDicionarioItens['quantidade'] = quantidadeFormatada
        novoDicionarioItens['chaveAcesso'] = chaveAcessoCliente
        novoDicionarioItens['dataAtual'] = dataAtual
        itensParaSoma.push(novoDicionarioItens)

        //fazer a soma dos valores e colocar em variáveis 

        var somaQuantidade = quantidadeCaixasInterio
        var somaValortotalPedido = 0

        for (var i = 0; i < itensParaSoma.length; i++) {
            somaQuantidade = somaQuantidade + itensParaSoma[i].quantidade
        }

        for (var i = 0; i < itensParaSoma.length; i++) {
            somaValortotalPedido = somaValortotalPedido + itensParaSoma[i].valorTotal
        }

        somaValortotalPedido = somaValortotalPedido + valorInteiro
        valorTotalBD = somaValortotalPedido

        //converte o  valor para string e  formata para real brasileiro
        somaValortotalPedidoSTRING = somaValortotalPedido.toString()
        if(somaValortotalPedidoSTRING.length == 2){
            $("#valorTotalPedido").html("R$ 0," + somaValortotalPedidoSTRING)
        }

        if(somaValortotalPedidoSTRING.length>=3){
            valorTotalFormatadoPedido = somaValortotalPedidoSTRING  / 100
            $("#valorTotalPedido").html("R$ " + valorTotalFormatadoPedido.toFixed(2).replace(".", ","))
        }

        
        //calcula o valor das caicas restantes 
        var quantiadeDeCaixasRestantes = caixasTotais - somaQuantidade
        document.getElementById("Ncaixas").innerHTML = somaQuantidade
        document.getElementById("CxRest").innerHTML = quantiadeDeCaixasRestantes

      
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
    return (Item.innerHTML += valores.map((x) => {
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


                <div style="display: none;" id="info${id}" class="dadosPedidoSecundario">
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
    //pega o id da  div 
    let div = document.getElementById(id)

    //seleciona o dicionario do  array a ser apagado usando como parametro o id da div 
    itensParaSoma.splice(id,1)
   

    // faz todo o calculo novamente para as quantidades 
    var somaQuantidade = 0
    var somaValortotalPedido = 0

    for (var i = 0; i < itensParaSoma.length; i++) {
        somaQuantidade = somaQuantidade + itensParaSoma[i].quantidade
    }

    for (var i = 0; i < itensParaSoma.length; i++) {
        somaValortotalPedido = somaValortotalPedido + itensParaSoma[i].valorTotal
    }
    
    somaValortotalPedido = somaValortotalPedido + valorInteiro
    valorTotalBD = somaValortotalPedido

    //converte o  valor para string e  formata para real brasileiro
    somaValortotalPedidoSTRING = somaValortotalPedido.toString()
    if(somaValortotalPedidoSTRING.length == 2){
        $("#valorTotalPedido").html("R$ 0," + somaValortotalPedidoSTRING)
    }

    if(somaValortotalPedidoSTRING.length>=3){
        valorTotalFormatadoPedido = somaValortotalPedidoSTRING  / 100
        $("#valorTotalPedido").html("R$ " + valorTotalFormatadoPedido.toFixed(2).replace(".", ","))
    }

    
    //calcula o valor das caicas restantes 
    var quantiadeDeCaixasRestantes = caixasTotais - somaQuantidade
    document.getElementById("Ncaixas").innerHTML = somaQuantidade
    document.getElementById("CxRest").innerHTML = quantiadeDeCaixasRestantes
    
    // remove a div do html 
    div.remove()
}

