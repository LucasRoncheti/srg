document.getElementById('filtrarButton').addEventListener('click', function (e) {
    e.preventDefault();
    
    // Capturar as datas selecionadas e o nome selecionado
    const dataInicial = document.getElementById('dataInicial').value;
    const dataFinal = document.getElementById('dataFinal').value;
    const fornecedor = document.getElementById('fornecedor').value;


   
    
    // console.log(dataFinal,dataInicial,fornecedor)
    
    // Enviar uma solicitação Fetch para o servidor
fetch('filtrarPedidos.php', {
    method: 'POST',
    body: JSON.stringify({ dataInicial, dataFinal, fornecedor }),
    headers: {
        'Content-Type': 'application/json'
    }
})
.then(response => response.text()) // Manter como text
.then(data => {
    const resultadosDiv = document.getElementById('containerList');

     //div que receberão as somas de todas quantidades 

     const quantidadeTotalPedidos = document.getElementById('quantidadePedidos')
     const quantidadeTotalCaixas = document.getElementById('totalCaixas')
     const valorSomadoUnificado = document.getElementById('ValorUnificado')
     
    resultadosDiv.innerHTML = ''; // Limpar resultados anteriores
     quantidadeTotalPedidos.innerHTML = 0
     quantidadeTotalCaixas.innerHTML = 0
     valorSomadoUnificado.innerHTML =" R$ 0,00"

    if (data.length === 0) {
        resultadosDiv.innerHTML = 'Nenhum resultado encontrado.';
    } else {
        resultadosDiv.innerHTML = data; // Inserir a resposta como texto direto
        quantidadeTotalPedidos.innerHTML = document.getElementById('nPedidos').value
        quantidadeTotalCaixas.innerHTML = document.getElementById('somaQuantidade').value
        valorSomadoUnificado.innerHTML = document.getElementById('valorTotalUnif').value
        
       
    }
})
.catch(error => {
    console.error('Erro:', error);
});

});
