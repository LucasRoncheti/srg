<?php

include '../generalPhp/conection.php';
if(!isset($_SESSION)) {
    session_start();
}

if(!isset($_SESSION['id'])) {
    die( header("Location: ../index.php"));
}

$pagina = filter_input(INPUT_POST, 'pagina', FILTER_SANITIZE_NUMBER_INT);
$qnt_result_pg = filter_input(INPUT_POST, 'qnt_result_pg', FILTER_SANITIZE_NUMBER_INT);
$inicio = ($pagina * $qnt_result_pg) - $qnt_result_pg;

$result_sql = "SELECT * FROM inspecoes ORDER BY id DESC LIMIT $inicio, $qnt_result_pg";
$resultado_sql = mysqli_query($conn, $result_sql);

if(($resultado_sql) && ($resultado_sql->num_rows != 0)){
    while ($row_sql = mysqli_fetch_assoc($resultado_sql)) {
        $dataFormatada = date('d/m/y', strtotime($row_sql['data_inspecao']));
        echo '<div class="flex flex-col md:flex-row justify-between items-center border rounded-lg p-4 shadow-md mb-4 bg-white dark:bg-gray-800">';
        echo '  <div class="text-sm text-gray-700 dark:text-gray-300">';
        echo '    <div class="font-bold">Nº Cont. ' . $row_sql['numero_container'] . '</div>';
        echo '    <div>Data: ' . $dataFormatada . '</div>';
        echo '  </div>';
        echo '  <div class="text-lg font-semibold text-green-700 dark:text-green-400">' . $row_sql['nome'] . '</div>';
        echo '  <div class="flex gap-4">';
        echo '    <a href="../inspessao/listarPedido/salvarInspessao.php?id=' . urlencode($row_sql['id']) . '&numero=' . urlencode($row_sql['id']) . '&cliente=' . urlencode($row_sql['nome']) . '&numero_container=' . urlencode($row_sql['numero_container']) . '" class="hover:opacity-80">';
        echo '      <img class="w-5 h-5" src="../assets/file_green.svg" alt="Salvar">';
        echo '    </a>';
        echo '    <img class="w-5 h-5 cursor-pointer" onclick="deletarInspecao(' . $row_sql['id'] . ')" src="../assets/erase.svg" alt="Deletar">';
        echo '    <img class="w-5 h-5 cursor-pointer" onclick="editarInspecao(' . $row_sql['id'] . ',\'' . $row_sql['nome'] . '\',' . $row_sql['numero_container'] . ',\'' . $row_sql['data_inspecao'] . '\')" src="../assets/edit.svg" alt="Editar">';
        echo '  </div>';
        echo '</div>';
    }

    $result_pg = "SELECT COUNT(id) AS num_result FROM inspecoes";
    $resultado_pg = mysqli_query($conn, $result_pg);
    $row_pg = mysqli_fetch_assoc($resultado_pg);

    $quantidade_pg = ceil($row_pg['num_result'] / $qnt_result_pg);
    $max_links = 2;
    echo "<div class='flex flex-wrap justify-center gap-2 mt-4'>";
    echo "<a class='text-blue-600 hover:underline' href='#' onclick='listar(1, $qnt_result_pg)'>&lt;Primeira</a> ";

    for($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++){
        if($pag_ant >= 1){
            echo "<a class='text-gray-600 dark:text-gray-300 hover:underline' href='#' onclick='listar($pag_ant, $qnt_result_pg)'>$pag_ant</a> ";
        }
    }

    echo "<span class='font-bold text-black dark:text-white'>$pagina</span> ";

    for ($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++) {
        if($pag_dep <= $quantidade_pg){
            echo "<a class='text-gray-600 dark:text-gray-300 hover:underline' href='#' onclick='listar($pag_dep, $qnt_result_pg)'>$pag_dep</a> ";
        }
    }

    echo "<a class='text-blue-600 hover:underline' href='#' onclick='listar($quantidade_pg, $qnt_result_pg)'>Última&gt;</a>";
    echo "</div>";
} else {
    echo '  <div class="text-center py-12">';
    echo '    <img class="mx-auto w-32 h-32" src="../assets/notFound.svg" alt="Nenhum dado encontrado">';
    echo '    <h3 class="text-lg text-gray-700 dark:text-gray-300 mt-4">Nenhum pedido salvo</h3>';
    echo '  </div>';
}
