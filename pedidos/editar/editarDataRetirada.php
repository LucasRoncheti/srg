<?php
include '../../generalPhp/conection.php';

// Get POST data
$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$data_retirada = isset($_POST['data_retirada']) ? $_POST['data_retirada'] : '';

if ($id > 0 && !empty($data_retirada)) {
    try {
        // Prepared statement for update
        $stmt = $conn->prepare("UPDATE pedidos_dados SET data_retirada = ? WHERE id = ?");
        if ($stmt->execute([$data_retirada, $id])) {
            echo "Data de retirada atualizada com sucesso.";
        } else {
            echo "Erro ao atualizar a data de retirada.";
        }
    } catch (PDOException $e) {
        echo "Erro de conexão: " . $e->getMessage();
    }
} else {
    echo "Dados inválidos.";
}
?>