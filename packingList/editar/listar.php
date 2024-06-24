<?php

include '../../generalPhp/conection.php';
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['id'])) {
    die(header("Location: ../../index.php"));

}

//consultar no banco de dados
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $chaveAcesso = $_POST['chaveAcesso'];


    $result_sql = "SELECT * FROM packing_list WHERE chaveAcesso = '$chaveAcesso' ORDER BY palet ASC";
    $resultado_sql = mysqli_query($conn, $result_sql);

    //Verificar se encontrou resultado na tabela "sqls"
    if (($resultado_sql) and ($resultado_sql->num_rows != 0)) {

        $quantidadeTotal = 0;

        while ($row = mysqli_fetch_assoc($resultado_sql)) {
           
            $fornecedor = $row['fornecedor'];
            $sql3 = "SELECT fornecedorNumero FROM pedidos_dados WHERE fornecedor = '$fornecedor' ";
            $resultado_sql3 = mysqli_query($conn, $sql3);
            if (($resultado_sql3) and ($resultado_sql3->num_rows != 0)) {
                while ($row3 = mysqli_fetch_assoc($resultado_sql3)) {
                    $numeroFornecedor = $row3["fornecedorNumero"];
                
                   // Use regex para encontrar o número na string
                        if (preg_match('/\d+/', $numeroFornecedor, $matches)) {
                            $numero = $matches[0];
                           
                        } else{
                            $numero = '-';
                        }

                  
            }
            }
            $quantidade = $row['quantidade'];
            $palet = $row['palet'];
            $id = $row['id'];


            echo '<div id="' . $id . '" class="listaPackingList">';
            echo '<div id="plt">' . $palet . '</div>';
            echo '<div id="numeroFornecedor">' . $numero . '</div>';
            echo '<div id="fornecedorCabeçalho" class="fornecedor">' . $fornecedor . '</div>';
            echo '<div id="quantidadeC"> ' . $quantidade . '</div>';
            echo '<div class="apagar" onclick="apagar(\'' . $id . '\')" id="vazioDiv"> <img src="../../assets/erase.svg" alt=""></div>';
            echo '</div>';
            $quantidadeTotal += $quantidade;
        }
        echo '<input type="hidden" id="quantidadeTotal" value="' . $quantidadeTotal . '">';
    }





}