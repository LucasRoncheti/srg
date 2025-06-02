<?php
include '../../generalPhp/conection.php';

if (!isset($_SESSION)) session_start();

if (!isset($_SESSION['id'])) {
    die(header("Location: ../../index.php"));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uniqId = $_POST['uniqId'] ?? null;

    if (!$uniqId) {
        echo 'Erro: uniqId não informado.';
        exit;
    }

    $uploadDir = 'uploadedFiles/';
    $respostas = [];
    $resposta  = $_POST['resposta'];

    foreach ($_FILES as $campo => $arquivo) {
        $nomeCampo = $_POST[$campo . '_nome'] ?? $campo;
        if ($arquivo['error'] === UPLOAD_ERR_OK) {
            $extensao = pathinfo($arquivo['name'], PATHINFO_EXTENSION);
            $novoNome = $uniqId . '_' . $campo . '.' . $extensao;
            $uploadPath = $uploadDir . $novoNome;
          

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            if (move_uploaded_file($arquivo['tmp_name'], $uploadPath)) {
                // Salvar no banco
                $stmt = $conn->prepare("INSERT INTO pre_embarque_files (uniqId, nomeCampo, caminho,resposta) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $uniqId, $campo, $uploadPath,$resposta);

                if ($stmt->execute()) {
                    $respostas[] = "Arquivo $campo salvo com sucesso.";
                } else {
                    $respostas[] = "Erro ao salvar $campo no banco: " . $stmt->error;
                }
            } else {
                $respostas[] = "Erro ao mover o arquivo $campo.";
            }
        } else {
            $respostas[] = "Erro no upload do campo $campo.";
        }
    }

    echo implode("<br>", $respostas);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Método de requisição inválido.'
    ]);
}
