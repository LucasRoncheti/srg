<?php
include '../../generalPhp/conection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_img = $_POST['id_image'];
    $path = $_POST['path'];
    $pathHD = $_POST['pathHD'];

    // Corrected SQL query
    $stmt = "DELETE FROM imagens WHERE id = ?";
    $stmt = $conn->prepare($stmt);

    if ($stmt) {
        $stmt->bind_param("i", $id_img);
        if ($stmt->execute()) {
            echo json_encode(array(
                'success' => true,
                'message' => 'Imagem apagada com sucesso.'
            ));


            //apaga a imagem thumb nail  na pasta
            $caminhoDoArquivo = $path;

            if (file_exists($caminhoDoArquivo)) {
                if (unlink($caminhoDoArquivo)) {
                   
                }
            }
             //apaga a imagem high na pasta
             $caminhoDoArquivo1 = $pathHD;

             if (file_exists($caminhoDoArquivo1)) {
                 if (unlink($caminhoDoArquivo1)) {
                   
                 }
             }

        } else {
            echo json_encode(array(
                'success' => false,
                'message' => 'Erro ao apagar a imagem no banco de dados.'
            ));
        }
        $stmt->close();
    } else {
        echo json_encode(array(
            'success' => false,
            'message' => 'Erro na preparação da declaração SQL.'
        ));
    }
}
?>


