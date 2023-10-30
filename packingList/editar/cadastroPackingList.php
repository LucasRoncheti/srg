<?php
include '../../generalPhp/conection.php';

if(!isset($_SESSION)) {
    session_start();
}

if(!isset($_SESSION['id'])) {
    die( header("Location: ../../index.php"));
   
}

if($_SERVER['REQUEST_METHOD']==="POST"){
    $fornecedor = $_POST['fornecedor'];
    $palet = $_POST['palet'];
    $quantidade = $_POST['quantidade'];
    $chaveAcesso = $_POST['chaveAcesso'];

    $stmt = $conn->prepare("INSERT INTO packing_list (fornecedor,quantidade,palet,chaveAcesso)  VALUES (?, ?, ?, ?) ");
    $stmt->bind_param("siis", $fornecedor,$quantidade,$palet,$chaveAcesso);
    $stmt->execute();
    $result = $stmt->get_result(); 
}

// Fechar a conexão
$conn->close();
?>
