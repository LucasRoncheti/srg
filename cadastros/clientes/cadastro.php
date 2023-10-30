<?php

     include '../../generalPhp/conection.php';


     if(!isset($_SESSION)) {
        session_start();
    }
    
    if(!isset($_SESSION['id'])) {
       die( header("Location: ../../index.php"));
       
    }
    
     if ($_SERVER["REQUEST_METHOD"] === "POST") {
        
        $nome = $_POST["nome"];
    
       
    
        $sql = "INSERT INTO clientes (nome) VALUES ('$nome')";
    
        if ($conn->query($sql) === TRUE) {
            echo "Cliente cadastrado com sucesso!";
        } else {
            echo "Erro no cadastro: " . $conn->error;
        }
    
        $conn->close();
    }
    
?>
