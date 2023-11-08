




// arraya ser enviado para o banco de dados com

const enviarDados = () => {
  // animação quando os dadso estão sendo enviados para o servidor 
  document.getElementById('preload').style.display='block'


  // Criar um dicionário de cliente
  const dicionarioCliente = {};
  dicionarioCliente['cliente'] = clienteBD;
  dicionarioCliente['dataAtual'] = dataBD;
  dicionarioCliente['valortotalPedido'] = valorTotalBD;

  // Adicionar o dicionário do cliente à lista itensParaSoma
   itensParaSoma.push(dicionarioCliente);
  itensEnviados = itensParaSoma





fetch('cadastroPedido.php', {
  method: 'POST',
  headers: {
    'Content-Type': 'application/json'
  },
  body: JSON.stringify({ itensEnviados: itensEnviados })
})
  .then(response => response.text())
  .then(data => {
    document.getElementById("respostaPHP").style.display = "block";
    document.getElementById("respostaPHP").innerHTML = data; // Resposta do PHP
    document.getElementById('preload').style.display='none'
    setTimeout(()=>{
      document.getElementById("respostaPHP").innerHTML = "";
      document.getElementById("respostaPHP").style.display = "none";
    },10000)
  })
  .catch(error => {
    document.getElementById("respostaPHP").innerHTML = "Erro: " + erro; // Exibir mensagem de erro
    document.getElementById('preload').style.display='none'

  });

}




