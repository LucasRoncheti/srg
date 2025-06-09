<?php
include '../../generalPhp/conection.php';

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['id'])) {
    die(header("Location: ../../index.php"));
}

// Paginação
$pagina = filter_input(INPUT_POST, 'pagina', FILTER_SANITIZE_NUMBER_INT) ?: 1;
$qnt_result_pg = filter_input(INPUT_POST, 'qnt_result_pg', FILTER_SANITIZE_NUMBER_INT) ?: 10;
$inicio = ($pagina * $qnt_result_pg) - $qnt_result_pg;

// Consulta
$result_fornecedor = "SELECT * FROM fornecedores ORDER BY id DESC LIMIT $inicio, $qnt_result_pg";
$resultado_fornecedor = mysqli_query($conn, $result_fornecedor);

if ($resultado_fornecedor && $resultado_fornecedor->num_rows > 0) {
    echo '<div class="overflow-x-auto rounded-md shadow-md">';
    echo '<table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">';
    echo '<thead class="bg-gray-100 dark:bg-gray-800">';
    echo '<tr>';
    echo '<th class="px-4 py-2 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase tracking-wider">N°</th>';
    echo '<th class="px-4 py-2 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase tracking-wider">Nome</th>';
    echo '<th class="px-4 py-2 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase tracking-wider">Edit.</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">';

    while ($row = mysqli_fetch_assoc($resultado_fornecedor)) {
        echo '<tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition">';
        echo '<td class="px-4 py-2 text-sm text-gray-800 dark:text-gray-200">' . $row['numero'] . '</td>';
        echo '<td class="px-4 py-2 text-sm text-gray-800 dark:text-gray-200">' . $row['nome'] . '</td>';
        echo '<td class="px-4 py-2 flex gap-2">';
        echo '<a href="editarFornecedor.php?id=' . $row['id'] . '"><img src="../../assets/edit.svg" alt="Editar" class="w-4 h-4"></a>';
        echo '<a href="apagarFornecedor.php?id=' . $row['id'] . '"><img src="../../assets/erase.svg" alt="Apagar" class="w-4 h-4"></a>';
        echo '</td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
    echo '</div>';

    // Paginação
    $result_pg = "SELECT COUNT(id) AS num_result FROM fornecedores";
    $resultado_pg = mysqli_query($conn, $result_pg);
    $row_pg = mysqli_fetch_assoc($resultado_pg);
    $quantidade_pg = ceil($row_pg['num_result'] / $qnt_result_pg);

    $max_links = 2;
    echo '<div class="flex justify-center items-center gap-2 mt-4 text-sm text-gray-700 dark:text-gray-300">';
    echo "<a href='#' onclick='carregarFornecedores(1, $qnt_result_pg)' class='px-3 py-1 rounded hover:bg-gray-200 dark:hover:bg-gray-700'>&lt;Primeira</a>";

    for ($pag_ant = max(1, $pagina - $max_links); $pag_ant < $pagina; $pag_ant++) {
        echo "<a href='#' onclick='carregarFornecedores($pag_ant, $qnt_result_pg)' class='px-3 py-1 rounded hover:bg-gray-200 dark:hover:bg-gray-700'>$pag_ant</a>";
    }

    echo "<span class='px-3 py-1 font-semibold text-white bg-blue-600 rounded'>$pagina</span>";

    for ($pag_dep = $pagina + 1; $pag_dep <= min($pagina + $max_links, $quantidade_pg); $pag_dep++) {
        echo "<a href='#' onclick='carregarFornecedores($pag_dep, $qnt_result_pg)' class='px-3 py-1 rounded hover:bg-gray-200 dark:hover:bg-gray-700'>$pag_dep</a>";
    }

    echo "<a href='#' onclick='carregarFornecedores($quantidade_pg, $qnt_result_pg)' class='px-3 py-1 rounded hover:bg-gray-200 dark:hover:bg-gray-700'>Última&gt;</a>";
    echo '</div>';
} else {
    echo '
    <div class="flex flex-col items-center justify-center text-center p-6 text-gray-600 dark:text-gray-300">
        <img src="../../assets/notFound.svg" alt="Sem resultados" class="w-20 h-20 mb-4">
        <h3 class="text-lg font-semibold">NÃO HÁ REGISTROS</h3>
    </div>';
}
?>
