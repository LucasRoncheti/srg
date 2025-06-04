<?php
// Incluir a conexão com banco de dados
include '../../generalPhp/conection.php';

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['id'])) {
    header("Location: ../index.php");
    exit();
}

// Verifica se a requisição é do tipo POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Receber os dados do formulário
    $nome = $_POST['nome'] ?? '';
    $numero_container = $_POST['numero_container'] ?? '';
    $data = $_POST['data'] ?? '';
    $uniqId  = uniqid();

    // Verificar se os campos obrigatórios estão preenchidos
    if (empty($nome) || empty($numero_container) || empty($data)) {
        echo 'Todos os campos são obrigatórios.';
        exit();
    }

    // Prepara a consulta SQL para inserir os dados
    $sql = "INSERT INTO pre_embarque (name, container, data, uniqId) VALUES (?, ?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        // Vincular os parâmetros à consulta
        $stmt->bind_param("ssss", $nome, $numero_container, $data, $uniqId);

        // Executar a consulta
        if ($stmt->execute()) {
            echo 'Pre embarque salvo com sucesso.';
        } else {
            echo 'Erro ao salvar a Pré Embarque : ' . $stmt->error;
        }

        // Fechar a declaração
        $stmt->close();
    } else {
        echo 'Erro ao preparar a consulta: ' . $conn->error;
    }

    // Fechar a conexão
    $conn->close();
} else {
    echo 'Método de requisição inválido.';
}
?>
