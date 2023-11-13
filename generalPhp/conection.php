<?php

//dados do servidor para conexão



    $serverName = "localhost";
     $username = "srgapp32_lucasroncheti27";
    $password ="skinzerferida";
     $dbname = "srgapp32_sistemacadastro";

//  $serverName = "localhost";
//  $username = "root";
//  $password = "";
//  $dbname = "sistemacadastro";



$conn = new mysqli($serverName, $username ,$password, $dbname);

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}