
// evita de enviar dois pedidos 
let envioEmAndamento = false;
// arraya ser enviado para o banco de dados com


function recuperarDados(){
    fornecedor = document.getElementById("fornecedor").options[0].value;
    fornecedorNumero = document.getElementById("fornecedor").options[0].textContent;
    produto = document.getElementById("produto").options[0].text;
    valorUnit = document.getElementById("valorUnit").value
    valorUnitFormatado = parseFloat(valorUnit.replace("R$", "").replace(",", ""))
    valorTotal = document.getElementById("valorTotal").textContent
    valorTotalFormatado = parseFloat(valorTotal.replace("R$", "").replace(",", ""))
    quantidade = document.getElementById("quantidade").value
    quantidadeFormatada = parseFloat(quantidade.replace("R$", "").replace(",", ""))

    
    const chaveAcesso = document.getElementById('chaveAcesso').value
    const DataAtual = document.getElementById('DataAtual').value

    let dataRetirada =  document.getElementById('dataRetirada').value
    let campovazio = false

    if (!fornecedor || produto === "" || fornecedor === " Fornecedor não encontrado " || produto === "Produto não encontrado" || dataRetirada === ''||dataRetirada === undefined) {

        campovazio = true
      }

      return {
        fornecedor:fornecedor,
        fornecedorNumero:fornecedorNumero,
        produto:produto,
        valorUnit:valorUnitFormatado,
        valorTotal:valorTotalFormatado,
        quantidade:quantidade,
        dataRetirada:dataRetirada,
        campovazio:campovazio,
        chaveAcesso:chaveAcesso,
        dataAtual:DataAtual
      }
}

const salvarEdicao = () => {

  const dadosEnvio = recuperarDados()

  if(dadosEnvio.campovazio){
    toastifyMessage("Preencha o campo vazio ! ",'error')
    return
  }

  if (envioEmAndamento) {
    alert("Tentativa de salvamento duplicado ");
    window.location.href = "../cadastrodepedidos.php";
    return;
  }
  envioEmAndamento = true;

  // animação quando os dadso estão sendo enviados para o servidor 
  document.getElementById('preload').style.display='block'



  console.log(dadosEnvio)




fetch('salvarEdicao.php', {
  method: 'POST',
  headers: {
    'Content-Type': 'application/json'
  },
  body: JSON.stringify({ itensEnviados: dadosEnvio })
})
  .then(response => response.text())
  .then(data => {
    document.getElementById("respostaPHP").style.display = "block";
    document.getElementById("respostaPHP").innerHTML = data; // Resposta do PHP
    document.getElementById('preload').style.display='none'
    setTimeout(()=>{
      let envioEmAndamento = false;
      window.location.reload()
    },1000)
    toastifyMessage(data)
  })
  .catch(error => {
    document.getElementById("respostaPHP").innerHTML = "Erro: " + erro; // Exibir mensagem de erro
    document.getElementById('preload').style.display='none'
    let envioEmAndamento = false;
     toastifyMessage(data,"error")

  });

}

function editarQuantidade(){
  
}




