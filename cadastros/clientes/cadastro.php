<?php

     include '../../generalPhp/conection.php';

    
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
