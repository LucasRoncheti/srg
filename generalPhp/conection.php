<?php

// Verifica se está rodando em ambiente local
$isLocal = in_array($_SERVER['HTTP_HOST'], ['localhost', '127.0.0.1']);

// Configurações de conexão
if ($isLocal) {
    // Ambiente local
    $serverName = "localhost";
    $username = "root";
    $password = "";
    $dbname = "reinholzGingerSystem";
} else {
    // Ambiente de produção (servidor)
    $serverName = "localhost";
    $username = "srgapp32_lucasroncheti27";
    $password = "skinzerferida";
    $dbname = "srgapp32_sistemacadastro";
}

// Cria conexão
$conn = new mysqli($serverName, $username, $password, $dbname);

// Verifica erro
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}
