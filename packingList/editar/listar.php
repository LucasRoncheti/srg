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


    $result_sql = "SELECT * FROM packing_list WHERE chaveAcesso = '$chaveAcesso' ";
    $resultado_sql = mysqli_query($conn, $result_sql);

    //Verificar se encontrou resultado na tabela "sqls"
    if (($resultado_sql) and ($resultado_sql->num_rows != 0)) {

        $quantidadeTotal = 0;

        while ($row = mysqli_fetch_assoc($resultado_sql)) {

            $fornecedor = $row['fornecedor'];
            $quantidade = $row['quantidade'];
            $palet = $row['palet'];
            $id = $row['id'];


            echo '<div id="' . $id . '" class="listaPackingList">';
            echo '<div id="plt">' . $palet . '</div>';
            echo '<div id="fornecedorCabeçalho" class="fornecedor">' . $fornecedor . '</div>';
            echo '<div id="quantidadeC"> ' . $quantidade . '</div>';
            echo '<div onclick="apagar(\'' . $id . '\')" id="vazioDiv"> <img src="../../assets/erase.svg" alt=""></div>';
            echo '</div>';
            $quantidadeTotal += $quantidade;
        }
        echo '<input type="hidden" id="quantidadeTotal" value="' . $quantidadeTotal . '">';
    }




}