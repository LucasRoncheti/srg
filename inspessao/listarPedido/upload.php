<?php
include '../../generalPhp/conection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_item = $_POST['id_item'];

    // Verifica se o arquivo thumbnail foi enviado
    if (isset($_FILES['imagem1']) && $_FILES['imagem1']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'thumbnails/';
        $filename = uniqid() . '_' . $_FILES['imagem1']['name'];
        $uploadPath = $uploadDir . $filename;

        if (move_uploaded_file($_FILES['imagem1']['tmp_name'], $uploadPath)) {
            $sql = "INSERT INTO imagens (id_item, pathImagem) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $id_item, $nome_do_arquivo);
            $id_item = $_POST['id_item'];
            $nome_do_arquivo = $uploadPath;

            if ($stmt->execute()) {
                echo json_encode(array(
                    'success' => true,
                    'message' => 'Imagem  enviada e salva com sucesso.'
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

        // Verifica se o arquivo em alta foi enviado 
        if (isset($_FILES['imagem2']) && $_FILES['imagem2']['error'] === UPLOAD_ERR_OK) {
            $uploadDir1 = 'imgHigh/';
            $uploadPath1 = $uploadDir1 . $filename; // Usando o mesmo nome de arquivo

            if (move_uploaded_file($_FILES['imagem2']['tmp_name'], $uploadPath1)) {
                $sql = "INSERT INTO imagensalta (id_item, pathImagem) VALUES (?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ss", $id_item, $nome_do_arquivo1);
                $nome_do_arquivo1 = $uploadPath1;

                if ($stmt->execute()) {
                    
                } else {
                   
                }
            } else {
               
            }
        }
    } else {
        
    }
} else {
    echo json_encode(array(
        'success' => false,
        'message' => 'Método de requisição inválido.'
    ));
}
?>
