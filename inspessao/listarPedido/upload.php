<?php
include '../../generalPhp/conection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_item = $_POST['id_item'];

    // Verifica se o arquivo foi enviado
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        $filename = uniqid() . '_' . $_FILES['imagem']['name'];
        $uploadPath = $uploadDir . $filename;

        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $uploadPath)) {
            $sql = "INSERT INTO imagens (id_item, pathImagem) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $id_item, $nome_do_arquivo);
            $id_item = $_POST['id_item'];
            $nome_do_arquivo = $uploadPath;

            if ($stmt->execute()) {
                echo json_encode(array(
                    'success' => true,
                    'message' => 'Imagem enviada e salva com sucesso.'
                ));
            } else {
                echo json_encode(array(
                    'success' => false,
                    'message' => 'Erro ao inserir informações no banco de dados.'
                ));
            }
        } else {
            echo json_encode(array(
                'success' => false,
                'message' => 'Erro ao salvar a imagem.'
            ));
        }
    } else {
        echo json_encode(array(
            'success' => false,
            'message' => 'Nenhuma imagem foi enviada.'
        ));
    }
} else {
    echo json_encode(array(
        'success' => false,
        'message' => 'Método de requisição inválido.'
    ));
}
?>
