



// protege contra dois envios ao mesmo tempo 

let envioEmAndamento = false; // Variável de controle

// arraya ser enviado para o banco de dados com

const enviarDados = () => {


  if (envioEmAndamento) {
    alert("Tentativa de salvamento duplicado ");
    window.location.href="../cadastrodepedidos.php"
    return;
  }
    envioEmAndamento = true;
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
      let envioEmAndamento = false; 
        setTimeout(()=>{
          window.location.href="../cadastrodepedidos.php"
        },1000)
      
     
     })
     .catch(error => {
       document.getElementById("respostaPHP").innerHTML = "Erro: " + error; // Exibir mensagem de erro
       document.getElementById('preload').style.display='none'
       let envioEmAndamento = false; 
     });
  
  }


  let editarQuantidade=(chaveAcesso,id,elemento,valorUnit,valorTotalItem,valorTotalPedido) =>{

    let valorInput = elemento.value
    const formData = new FormData();
    formData.append('idItem',id)
    formData.append('chaveAcesso',chaveAcesso)
    formData.append('novaQuantidade',valorInput)
    formData.append('valorUnit',valorUnit)
    formData.append('valorTotalItem',valorTotalItem)
    formData.append('valorTotal',valorTotalPedido)

    fetch('editarQuantidade.php', {
      method: 'POST',
     body:formData
    })
      .then(response => {
        if(response.ok){
          response.text()
        }else{  
          alert('Não  foi possível alterar  a quantidade.')
        }
      }).then(data => {
        console.log(data)
         window.location.reload()
      })
      .catch(error => {
        document.getElementById("respostaPHP").innerHTML = "Erro: " + error; // Exibir mensagem de erro
      });

  }
  
  
  
  
  