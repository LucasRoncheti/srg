<?php
include '../../generalPhp/conection.php';

//variáveis que serão alocadas em outra tabela 
$cliente = "";
$valortotalPedido = 0;

// Receber os dados do JavaScript
$data = json_decode(file_get_contents("php://input"), true);
$itensEnviados = $data['itensEnviados'];

// Separar os dados do dicionário específico
$dadosEspecificos = null;

foreach ($itensEnviados as $key => $item) {
    if (isset($item['cliente']) && isset($item['dataAtual']) && isset($item['valortotalPedido'])) {
        $dadosEspecificos = $item;
        unset($itensEnviados[$key]); // Remover os dados do dicionário específico do array principal
        break;
    }
}

// Primeiro loop para inserir os itens principais na tabela pedidos_dados
foreach ($itensEnviados as $item) {
    $chaveAcesso = $item['chaveAcesso'];
    $fornecedor = $item['fornecedor'];
    $produto = $item['produto'];
    $quantidade = $item['quantidade'];
    $valorTotal = $item['valorTotal'];
    $valorUnit = $item['valorUnit'];
    $dataAtual = $dadosEspecificos['dataAtual'];

    $sql1 = "INSERT INTO pedidos_dados (chaveAcesso, fornecedor, dataAtual, produto, valor_unit, valor_total, quantidade) VALUES ('$chaveAcesso', '$fornecedor', '$dataAtual', '$produto', '$valorUnit', '$valorTotal', '$quantidade') ";

    if ($conn->query($sql1) !== TRUE) {
        echo "Erro na inserção em pedidos_dados: " . $conn->error;
        break; // Para o loop se houver erro
    }
}

// Inserir os dados do dicionário específico em uma tabela separada
if ($dadosEspecificos) {
    $chaveAcesso = $item['chaveAcesso'];
    $cliente = $dadosEspecificos['cliente'];
    $dataAtual = $dadosEspecificos['dataAtual'];
    $valortotalPedido = $dadosEspecificos['valortotalPedido'];

    $sql2 = "INSERT INTO pedidoscadastro (cliente, dataAtual, valor_total, chaveAcesso) VALUES ('$cliente', '$dataAtual', '$valortotalPedido','$chaveAcesso')";

    if ($conn->query($sql2) !== TRUE) {
        echo "Erro na inserção dos dados específicos: " . $conn->error;
    }
}

// Fechar a conexão
$conn->close();
?>
