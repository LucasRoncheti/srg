<?php
    include '../../generalPhp/conection.php';

    if(isset($_POST['idItem'])){
        $idItem  = $_POST['idItem'];
        $quantidade  = $_POST['novaQuantidade'];
        $sql = $conn->prepare('UPDATE pedidos_dados SET quantidade  = ? WHERE id  = ? ');
        $sql->bind_param('ii', $quantidade,$idItem);
        if($sql->execute()){
            echo 'Quantidade alterada com sucesso.';
        }else{
            echo 'Não foi possível alterar a quantidade.';
        }
    }

        