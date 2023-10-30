<?php

     include '../../generalPhp/conection.php';
     if(!isset($_SESSION)) {
        session_start();
    }
    
    if(!isset($_SESSION['id'])) {
       die( header("Location: ../../index.php"));
       
    }
    
     if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $usuario = $_POST["usuario"];
        $senha = $_POST["senha"];
    
      
    
        $sql = "INSERT INTO usuarios (usuario, senha) VALUES ('$usuario', '$senha')";
    
        if ($conn->query($sql) === TRUE) {
            echo "Usuário cadastrado com sucesso!";
        } else {
            echo "Erro no cadastro: " . $conn->error;
        }
    
        $conn->close();
    }
    
?>
