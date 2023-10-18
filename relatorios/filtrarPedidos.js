document.getElementById('filtrarButton').addEventListener('click', function (e) {
    e.preventDefault();
    
    // Capturar as datas selecionadas e o nome selecionado
    const dataInicial = document.getElementById('dataInicial').value;
    const dataFinal = document.getElementById('dataFinal').value;
    const fornecedor = document.getElementById('fornecedor').value;

    console.log(dataFinal,dataInicial,fornecedor)
    
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
    resultadosDiv.innerHTML = ''; // Limpar resultados anteriores

    if (data.length === 0) {
        resultadosDiv.innerHTML = 'Nenhum resultado encontrado.';
    } else {
        resultadosDiv.innerHTML = data; // Inserir a resposta como texto direto
    }
})
.catch(error => {
    console.error('Erro:', error);
});

});
