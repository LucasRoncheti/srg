




// arraya ser enviado para o banco de dados com

const enviarDados = () => {
    // animação quando os dadso estão sendo enviados para o servidor 
    document.getElementById('preload').style.display='block'
  
  
    // Criar um dicionário de cliente
    const dicionarioCliente = {};
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
      document.getElementById("respostaPHP").style.display = "flex";
      document.getElementById("respostaPHP").innerHTML = data; // Resposta do PHP
      document.getElementById('preload').style.display='none'
      document.getElementById('preload').textContent=''
      setTimeout(()=>{
        document.getElementById("respostaPHP").innerHTML = "";
        document.getElementById("respostaPHP").style.display = "none";
      },2500)
     })
     .catch(error => {
       document.getElementById("respostaPHP").innerHTML = "Erro: " + error; // Exibir mensagem de erro
       document.getElementById('preload').style.display='none'
     });
  
  }
  
  
  
  
  