<?php
include '../../generalPhp/conection.php';

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['id'])) {
    die(header("Location: ../../index.php"));
}

// Obtendo os dados do POST
$idItem = $_POST['idItem'];

// Correção na consulta SQL para deletar um registro da tabela 'inspecao' com base no 'id'
$sql = "DELETE FROM inspecao WHERE id = ?";

$stmt = $conn->prepare($sql);

if ($stmt) {
    // Ligando os parâmetros à consulta
    $stmt->bind_param("i", $idItem);
    
    // Executando a consulta
    if ($stmt->execute()) {
        echo json_encode(["status" => "sucesso", "mensagem" => "Registro deletado com sucesso!"]);
    } else {
        echo json_encode(["status" => "erro", "mensagem" => "Erro ao deletar o registro: " . $stmt->error]);
    }

    // Fechando a declaração
    $stmt->close();
} else {
    echo json_encode(["status" => "erro", "mensagem" => "Erro na preparação da consulta: " . $conn->error]);
}

// Fechando a conexão
$conn->close();
?>
