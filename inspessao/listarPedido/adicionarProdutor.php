<?php
include '../../generalPhp/conection.php';
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['id'])) {
    die(header("Location: ../../index.php"));

}
// Obtendo os dados do POST
$chaveAcesso = $_POST['chaveAcesso'];
$fornecedor = $_POST['fornecedor'];

// Preparando a consulta SQL para inserir os dados na tabela
$sql = "INSERT INTO inspecao (chaveAcesso, fornecedor) VALUES (?, ?)";

$stmt = $conn->prepare($sql);

if ($stmt) {
    // Ligando os parâmetros à consulta
    $stmt->bind_param("ss", $chaveAcesso, $fornecedor);
    
    // Executando a consulta
    if ($stmt->execute()) {
        echo json_encode(["status" => "sucesso", "mensagem" => "Dados inseridos com sucesso!"]);
    } else {
        echo json_encode(["status" => "erro", "mensagem" => "Erro ao inserir os dados: " . $stmt->error]);
    }

    // Fechando a declaração
    $stmt->close();
} else {
    echo json_encode(["status" => "erro", "mensagem" => "Erro na preparação da consulta: " . $conn->error]);
}

// Fechando a conexão
$conn->close();
?>
