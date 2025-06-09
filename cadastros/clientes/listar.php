<?php
include '../../generalPhp/conection.php';

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['id'])) {
    die(header("Location: ../../index.php"));
}

// Paginação
$pagina = filter_input(INPUT_POST, 'pagina', FILTER_SANITIZE_NUMBER_INT);
$qnt_result_pg = filter_input(INPUT_POST, 'qnt_result_pg', FILTER_SANITIZE_NUMBER_INT);
$inicio = ($pagina * $qnt_result_pg) - $qnt_result_pg;

// Consulta
$result_sql = "SELECT * FROM clientes ORDER BY id DESC LIMIT $inicio, $qnt_result_pg";
$resultado_sql = mysqli_query($conn, $result_sql);

if (($resultado_sql) && ($resultado_sql->num_rows != 0)) {
    echo '<div class="overflow-x-auto">';
    echo '<table class="min-w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-sm">';
    echo '<thead class="bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
            <tr>
                <th class="px-4 py-2 text-left">N°</th>
                <th class="px-4 py-2 text-left">NOME CLIENTE</th>
                <th class="px-4 py-2 text-center">EDITAR</th>
            </tr>
          </thead>
          <tbody>';

    while ($row_sql = mysqli_fetch_assoc($resultado_sql)) {
        echo '<tr class="border-t border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">';
        echo '<td class="px-4 py-2">' . $row_sql['id'] . '</td>';
        echo '<td class="px-4 py-2">' . htmlspecialchars($row_sql['nome']) . '</td>';
        echo '<td class="px-4 py-2 text-center space-x-2">
                <a href="editar.php?id=' . $row_sql['id'] . '" class="inline-block">
                    <img src="../../assets/edit.svg" alt="Editar" class="w-5 h-5 inline">
                </a>
                <a href="apagar.php?id=' . $row_sql['id'] . '" class="inline-block">
                    <img src="../../assets/erase.svg" alt="Apagar" class="w-5 h-5 inline">
                </a>
              </td>';
        echo '</tr>';
    }

    echo '</tbody></table></div>';

    // Paginação
    $result_pg = "SELECT COUNT(id) AS num_result FROM clientes";
    $resultado_pg = mysqli_query($conn, $result_pg);
    $row_pg = mysqli_fetch_assoc($resultado_pg);
    $quantidade_pg = ceil($row_pg['num_result'] / $qnt_result_pg);
    $max_links = 2;

    echo '<div class="mt-4 flex justify-center flex-wrap gap-2 text-sm">';
    echo "<a href='#' onclick='listar(1, $qnt_result_pg)' class='px-3 py-1 rounded bg-gray-300 dark:bg-gray-600 hover:bg-gray-400 dark:hover:bg-gray-500'>« PRIMEIRA</a>";

    for ($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++) {
        if ($pag_ant >= 1) {
            echo "<a href='#' onclick='listar($pag_ant, $qnt_result_pg)' class='px-3 py-1 rounded bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600'>$pag_ant</a>";
        }
    }

    echo "<span class='px-3 py-1 font-semibold bg-green-500 text-white rounded'>$pagina</span>";

    for ($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++) {
        if ($pag_dep <= $quantidade_pg) {
            echo "<a href='#' onclick='listar($pag_dep, $qnt_result_pg)' class='px-3 py-1 rounded bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600'>$pag_dep</a>";
        }
    }

    echo "<a href='#' onclick='listar($quantidade_pg, $qnt_result_pg)' class='px-3 py-1 rounded bg-gray-300 dark:bg-gray-600 hover:bg-gray-400 dark:hover:bg-gray-500'>ÚLTIMA »</a>";
    echo '</div>';
} else {
    echo '
    <div class="text-center mt-8 text-gray-600 dark:text-gray-300">
        <img src="../../assets/notFound.svg" alt="Nenhum resultado" class="mx-auto mb-4 w-32 h-32">
        <h3 class="text-lg font-semibold">NÃO HÁ REGISTROS</h3>
    </div>';
}
