<?php
include '../../generalPhp/conection.php';

if (!isset($_SESSION)) {
    session_start();
}

// if (!isset($_SESSION['id'])) {
//     die(header("Location: ../../index.php"));

// }

//variáveis que serão alocadas em outra tabela 
$cliente = "";
$valortotalPedido = 0;

// Receber os dados do JavaScript
$data = json_decode(file_get_contents("php://input"), true);
$itensEnviados = $data['itensEnviados'];

// Primeiro loop para inserir os itens principais na tabela pedidos_dados


if (isset($itensEnviados['chaveAcesso']) || isset($itensEnviados['produto']) || isset($itensEnviados['fornecedor'])) {
    $chaveAcesso = $itensEnviados['chaveAcesso'];
    $fornecedorNumero = $itensEnviados['fornecedorNumero'];
    $fornecedor = $itensEnviados['fornecedor'];
    $produto = $itensEnviados['produto'];
    $quantidade = $itensEnviados['quantidade'];
    $valorTotal = $itensEnviados['valorTotal'];
    $valorUnit = $itensEnviados['valorUnit'];
    $dataRetirada = $itensEnviados['dataRetirada'];
    $dataAtual = $itensEnviados['dataAtual'];


    $sql1 = "INSERT INTO pedidos_dados (chaveAcesso, fornecedor, fornecedorNumero, dataAtual, produto, valor_unit, valor_total, quantidade, data_retirada) 
             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql1);
    if ($stmt) {
        $stmt->bind_param(
            "sssssiiis",
            $chaveAcesso,
            $fornecedor,
            $fornecedorNumero,
            $dataAtual,
            $produto,
            $valorUnit,
            $valorTotal,
            $quantidade,
            $dataRetirada
        );
        if (!$stmt->execute()) {
            echo json_encode('Erro ao  inserir item!');
        }else{
              echo json_encode('Item inserido com sucesso!');
        }
        $stmt->close();
    } else {
        echo json_encode('Erro ao fazer a consulta no banco de dados!');
    }
}
 else {
    echo '<p  style="padding:5px;width:100%;height:30px;background-color: #E55933;text-align:center;">Sem dados!</p>';
}


// Fechar a conexão
$conn->close();
?>