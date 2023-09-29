// arraya ser enviado para o banco de dados com
const enviarDados = () => {
  // Criar um dicionário de cliente
  const dicionarioCliente = {};
  dicionarioCliente['cliente'] = clienteBD;
  dicionarioCliente['dataAtual'] = dataBD;
  dicionarioCliente['valortotalPedido'] = valorTotalBD;

  // Adicionar o dicionário do cliente à lista itensParaSoma
   itensParaSoma.push(dicionarioCliente);
  itensEnviados = itensParaSoma

  console.log(itensEnviados)



  fetch('cadastroPedido.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({ itensEnviados: itensEnviados })
  })
    .then(response => response.text())
    .then(data => {
      console.log(data); // Resposta do PHP
    })
    .catch(error => {
      console.error('Erro:', error);
    });
 
}






