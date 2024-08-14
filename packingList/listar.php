<?php

include '../generalPhp/conection.php';

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['id'])) {
    header("Location: ../index.php");
    exit();
}

// Paginação
$pagina = filter_input(INPUT_POST, 'pagina', FILTER_SANITIZE_NUMBER_INT) ?: 1;
$qnt_result_pg = filter_input(INPUT_POST, 'qnt_result_pg', FILTER_SANITIZE_NUMBER_INT) ?: 10;
$inicio = ($pagina - 1) * $qnt_result_pg;

// Consultar no banco de dados
$sql = "SELECT * FROM listpack ORDER BY id DESC LIMIT ?, ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $inicio, $qnt_result_pg);
$stmt->execute();
$resultado_sql = $stmt->get_result();

// Verificar se encontrou resultado na tabela "listpack"
if ($resultado_sql && $resultado_sql->num_rows > 0) {
    ob_start(); // Inicia o buffer de saída

    while ($row_sql = $resultado_sql->fetch_assoc()) {
        $dataFormatada = date('d/m/Y', strtotime($row_sql['data_packingList']));
        echo '
        <div class="containerDadosPedidos">
            <div class="numberDate">
                <div style="font-size:0.7em;" class="numeroPedido">N° Cont. ' . htmlspecialchars($row_sql['numero_container']) . ' </div>
                <div class="dataPedido">Data ' . htmlspecialchars($dataFormatada) . '</div>
            </div>
            <div class="dadosPedidos">
                <div class="nomeClientePedido">' . htmlspecialchars($row_sql['nome']) . '</div>
            </div>
            <div class="apagarImprimir">
                <a href="../packingList/editar/editar.php?id=' . urlencode($row_sql['id']) . '&numero=' . urlencode($row_sql['id']) . '&cliente=' . urlencode($row_sql['nome']) . '&numero_container=' . urlencode($row_sql['numero_container']) . '"><img src="../assets/file_green.svg"></a>
                <img style="cursor:pointer;" onclick="deletarPackingList(' . (int)$row_sql['id'] . ')" src="../assets/erase.svg">
                <img style="cursor:pointer;" onclick="editarPackingList(' . (int)$row_sql['id'] . ',\'' . addslashes($row_sql['nome']) . '\',' . (int)$row_sql['numero_container'] . ',\'' . addslashes($row_sql['data_packingList']) . '\')" src="../assets/edit.svg">
            </div>
        </div>';
    }

    // Paginação - Somar a quantidade de registros
    $sql_pg = "SELECT COUNT(id) AS num_result FROM listpack";
    $result_pg = $conn->query($sql_pg);
    $row_pg = $result_pg->fetch_assoc();
    $quantidade_pg = ceil($row_pg['num_result'] / $qnt_result_pg);

    // Limitar os links antes e depois
    $max_links = 2;
    echo "<div class='divPagina'>";
    echo "<a href='#' onclick='listar(1, $qnt_result_pg)'>&lt;PRIMEIRA</a> ";

    for ($pag_ant = max(1, $pagina - $max_links); $pag_ant < $pagina; $pag_ant++) {
        echo " <a href='#' onclick='listar($pag_ant, $qnt_result_pg)'>$pag_ant </a> ";
    }

    echo " $pagina ";

    for ($pag_dep = $pagina + 1; $pag_dep <= min($pagina + $max_links, $quantidade_pg); $pag_dep++) {
        echo " <a href='#' onclick='listar($pag_dep, $qnt_result_pg)'>$pag_dep</a> ";
    }

    echo " <a href='#' onclick='listar($quantidade_pg, $qnt_result_pg)'>ÚLTIMA></a>";
    echo '</div>';

    ob_end_flush(); // Libera o conteúdo do buffer de saída

} else {
    echo '
    <div class="notFound">
        <img class="notFoundImg" src="../assets/notFound.svg" alt="">
        <h3>NENHUM PEDIDO SALVO</h3>
    </div>';
}

// Fechar a conexão
$conn->close();
?>
