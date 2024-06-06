<?php
include '../../generalPhp/conection.php';

if (isset($_POST['idItem'])) {
    $idItem = $_POST['idItem'];
    $chaveAcesso = $_POST['chaveAcesso'];
    $quantidade = $_POST['novaQuantidade'];
    $valorUnit = $_POST['valorUnit'];
    $valorTotalItem = $_POST['valorTotalItem'];
    $valorTotal = $_POST['valorTotal'];

    // Calcula o valor total resetado e o valor do novo item
    $valorTotalResetado = $valorTotal - $valorTotalItem;
    $valorItemNovo = $quantidade * $valorUnit;

    // Atualiza o valor total
    $valorAtualizado = $valorTotalResetado + $valorItemNovo;

    // Atualiza a tabela pedidos_dados
    $sql = $conn->prepare('UPDATE pedidos_dados SET quantidade = ?, valor_total = ? WHERE id = ?');
    $sql->bind_param('iii', $quantidade, $valorItemNovo, $idItem);

    if ($sql->execute()) {
        echo 'Quantidade alterada com sucesso.';

        // Atualiza a tabela pedidoscadastro
        $sql1 = $conn->prepare('UPDATE pedidoscadastro SET valor_total = ? WHERE chaveAcesso = ?');
        $sql1->bind_param('is', $valorAtualizado, $chaveAcesso);

        if ($sql1->execute()) {
            echo 'Valor total atualizado com sucesso.';
        } else {
            echo 'Não foi possível atualizar o valor total.';
        }
    } else {
        echo 'Não foi possível alterar a quantidade.';
    }
}
?>



