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

if ($resultado_sql && $resultado_sql->num_rows > 0) {
    ob_start();

    while ($row_sql = $resultado_sql->fetch_assoc()) {
        $dataFormatada = date('d/m/Y', strtotime($row_sql['data_packingList']));
        echo '
        <div class="flex flex-col md:flex-row justify-between items-center gap-4 bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-100 rounded shadow p-4 mb-4">
            <div class="text-sm md:text-base">
                <div class="font-semibold">N° Cont.: ' . htmlspecialchars($row_sql['numero_container']) . '</div>
                <div class="text-gray-500 dark:text-gray-400">Data: ' . htmlspecialchars($dataFormatada) . '</div>
            </div>
            <div class="font-medium text-green-700 dark:text-green-400 text-center md:text-left">
                ' . htmlspecialchars($row_sql['nome']) . '
            </div>
            <div class="flex gap-3">
                <a href="../packingList/editar/editar.php?id=' . urlencode($row_sql['id']) . '&numero=' . urlencode($row_sql['id']) . '&cliente=' . urlencode($row_sql['nome']) . '&numero_container=' . urlencode($row_sql['numero_container']) . '" title="Visualizar">
                    <img src="../assets/file_green.svg" class="w-6 h-6">
                </a>
                <button onclick="deletarPackingList(' . (int)$row_sql['id'] . ')" title="Deletar">
                    <img src="../assets/erase.svg" class="w-6 h-6">
                </button>
                <button onclick="editarPackingList(' . (int)$row_sql['id'] . ',\'' . addslashes($row_sql['nome']) . '\',' . (int)$row_sql['numero_container'] . ',\'' . addslashes($row_sql['data_packingList']) . '\')" title="Editar">
                    <img src="../assets/edit.svg" class="w-6 h-6">
                </button>
            </div>
        </div>';
    }

    // Paginação
    $sql_pg = "SELECT COUNT(id) AS num_result FROM listpack";
    $result_pg = $conn->query($sql_pg);
    $row_pg = $result_pg->fetch_assoc();
    $quantidade_pg = ceil($row_pg['num_result'] / $qnt_result_pg);

    // Navegação
    $max_links = 2;
    echo "<div class='flex flex-wrap justify-center gap-2 text-sm text-gray-700 dark:text-gray-200 mt-6'>";
    echo "<a href='#' onclick='listar(1, $qnt_result_pg)' class='px-3 py-1 border rounded hover:bg-gray-200 dark:hover:bg-gray-700'>&lt; PRIMEIRA</a>";

    for ($pag_ant = max(1, $pagina - $max_links); $pag_ant < $pagina; $pag_ant++) {
        echo "<a href='#' onclick='listar($pag_ant, $qnt_result_pg)' class='px-3 py-1 border rounded hover:bg-gray-200 dark:hover:bg-gray-700'>$pag_ant</a>";
    }

    echo "<span class='px-3 py-1 font-bold border rounded bg-gray-100 dark:bg-gray-700'>$pagina</span>";

    for ($pag_dep = $pagina + 1; $pag_dep <= min($pagina + $max_links, $quantidade_pg); $pag_dep++) {
        echo "<a href='#' onclick='listar($pag_dep, $qnt_result_pg)' class='px-3 py-1 border rounded hover:bg-gray-200 dark:hover:bg-gray-700'>$pag_dep</a>";
    }

    echo "<a href='#' onclick='listar($quantidade_pg, $qnt_result_pg)' class='px-3 py-1 border rounded hover:bg-gray-200 dark:hover:bg-gray-700'>ÚLTIMA ></a>";
    echo '</div>';

    ob_end_flush();
} else {
    echo '
    <div class="text-center py-12">
        <img src="../assets/notFound.svg" alt="Nada encontrado" class="mx-auto mb-4 w-32">
        <h3 class="text-xl font-medium text-gray-700 dark:text-white">NENHUM PEDIDO SALVO</h3>
    </div>';
}

$conn->close();
?>
