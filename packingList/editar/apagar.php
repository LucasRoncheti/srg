<?php
include '../../generalPhp/conection.php';


if(!isset($_SESSION)) {
    session_start();
}

if(!isset($_SESSION['id'])) {
    die( header("Location: ../../index.php"));
   
}

if($_SERVER['REQUEST_METHOD']==="POST"){
    $id = $_POST['id'];
      // Exclua os registros da tabela 'pedidos_dados'
      $sqlDeleteItens = "DELETE FROM packing_list WHERE id ='$id'";
      if (mysqli_query($conn, $sqlDeleteItens)) {
        
        echo '';
          } 
       else {
          echo "Erro ao excluir registros de pedidos_dados: " . mysqli_error($conn);
      
      }
      mysqli_close($conn);
    }
     
