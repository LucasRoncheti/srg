const enviarDados = () => {
  document.getElementById('preload').style.display = 'block';

  var fornecedor = document.getElementById('fornecedor').value;
  var palet = document.getElementById('palet').value;
  var quantidade = document.getElementById('quantidade').value;
  var chaveAcesso = document.getElementById("chaveAcesso").value;

  console.log(fornecedor, palet, quantidade);

  if (!fornecedor || !palet || !quantidade) {
    alert("Preencha todos os campos antes de enviar os dados.");
    document.getElementById('preload').style.display = 'none';
    return;
  }

  fetch('cadastroPackingList.php', {
    method: 'POST',
    body: new URLSearchParams({ fornecedor, palet, quantidade, chaveAcesso })
  })
    .then(response => response.text())
    .then(data => {
      Listar(); // Chame a função listar após o cadastro ser bem-sucedido
      document.getElementById("respostaPHP").innerHTML = data;
      document.getElementById('preload').style.display = 'none';
    })
    .catch(error => {
      document.getElementById("respostaPHP").innerHTML = "Erro: " + error;
      document.getElementById('preload').style.display = 'none';
    });
}
