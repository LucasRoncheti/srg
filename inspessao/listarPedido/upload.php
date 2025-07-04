<?php
include '../../generalPhp/conection.php';
if(!isset($_SESSION)) {
    session_start();
}

if(!isset($_SESSION['id'])) {
    die( header("Location: ../../index.php"));
   
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_item = $_POST['id_item'];

    // Verifica se o arquivo thumbnail foi enviado
    if (isset($_FILES['imagem1']) && $_FILES['imagem1']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'thumbnails/';
        $filename = uniqid() . '_' . $_FILES['imagem1']['name'];
        $uploadPath = $uploadDir . $filename;

        $Idimagem =  uniqid();
        

        if (move_uploaded_file($_FILES['imagem1']['tmp_name'], $uploadPath)) {
            $sql = "INSERT INTO imagens (id,id_item, pathImagem) VALUES (?, ?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $Idimagem ,$id_item, $nome_do_arquivo);
            $id_item = $_POST['id_item'];
            $nome_do_arquivo = $uploadPath;

            if ($stmt->execute()) {
                echo 'Imagem Thumb salva com sucesso.';
                
            } else {
                echo 'ERRO ao inserir imagem Thumb no banco de dados.';
               
            }
        } else {
            echo 'ERRO ao salvar a  imagem Thumb no banco de dados.';
           
        }

        // Verifica se o arquivo em alta foi enviado 
        if (isset($_FILES['imagem2']) && $_FILES['imagem2']['error'] === UPLOAD_ERR_OK) {
            $uploadDir1 = 'imgHigh/';
            $uploadPath1 = $uploadDir1 . $filename; // Usando o mesmo nome de arquivo

            if (move_uploaded_file($_FILES['imagem2']['tmp_name'], $uploadPath1)) {
                $sql = "INSERT INTO imagensalta (id,id_item, pathImagem) VALUES (?, ?,?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sss", $Idimagem,$id_item, $nome_do_arquivo1);
                $nome_do_arquivo1 = $uploadPath1;

                if ($stmt->execute()) {
                    echo 'Imagem HD salva com sucesso.';
                    
                } else {
                    echo 'ERRO ao inserir imagem HD no banco de dados.';
                   
                }
            } else {
                echo 'ERRO ao salvar a  imagem HD no banco de dados.';
               
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
