<?php

     include '../../generalPhp/conection.php';

    
     
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $numero = $_POST["numero"];
    $nome = $_POST["nome"];
    
    
    $sql = "INSERT INTO fornecedores (numero, nome) VALUES ('$numero', '$nome')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Fornecedor cadastrado com sucesso!";
       
     
    } else {
        echo "Erro no cadastro: " . $conn->error;
    }
    
    $conn->close();
}
?>
