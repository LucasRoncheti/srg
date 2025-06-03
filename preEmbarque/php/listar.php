<?php

include '../../generalPhp/conection.php';
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['id'])) {
    die(header("Location: ../index.php"));
}

// Paginação
$pagina = filter_input(INPUT_POST, 'pagina', FILTER_SANITIZE_NUMBER_INT);
$qnt_result_pg = filter_input(INPUT_POST, 'qnt_result_pg', FILTER_SANITIZE_NUMBER_INT);
$inicio = ($pagina * $qnt_result_pg) - $qnt_result_pg;

// Consulta
$result_sql = "SELECT * FROM pre_embarque ORDER BY id DESC LIMIT $inicio, $qnt_result_pg";
$resultado_sql = mysqli_query($conn, $result_sql);

if ($resultado_sql && $resultado_sql->num_rows != 0) :

    while ($row_sql = mysqli_fetch_assoc($resultado_sql)) :
        $dataFormatada = date('d/m/y', strtotime($row_sql['data']));
        $id = $row_sql['id'];
        $container = $row_sql['container'];
        $nome = $row_sql['name'];
        $dataOriginal = $row_sql['data'];
                $uniqID = $row_sql['uniqId'];
?>
        <div class="flex justify-between items-center bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-4 mb-4 shadow-sm">
            <div class="flex flex-col text-sm text-gray-700 dark:text-gray-300">
                <span class="text-xs">N° Cont. <?= htmlspecialchars($container) ?></span>
                <span>Data <?= $dataFormatada ?></span>
            </div>

            <div class="flex-1 text-center text-green-800 dark:text-green-400 font-semibold">
                <?= htmlspecialchars($nome) ?>
            </div>

            <div class="flex gap-3 items-center">
                <button onclick="copiarLink(this)" title="Copiar para área de transferência." data-link="https://srg.app.br/srg/preEmbarque/visualizarPreEmbarque.php?id=<?= urlencode($uniqID)?>">
                <i class="fas fa-share-alt text-green-700"></i>
                </button>
                <a title="Abrir" href="../preEmbarque/listarPreembarque/abrirPreEmbarque.php?id=<?= urlencode($uniqID) ?>&nome=<?= urlencode($nome) ?>&numero_container=<?= urlencode($container) ?>">
                    <img src="../assets/file_green.svg" alt="Visualizar">
                </a>
                <img title="Deletar" src="../assets/erase.svg"
                     alt="Apagar"
                     class="cursor-pointer hover:opacity-75"
                     onclick="deletar('<?= $id ?>')">

                <img title="Editar" src="../assets/edit.svg"
                     alt="Editar"
                     class="cursor-pointer hover:opacity-75"
                     onclick="editarPreEmbarque('<?= $id ?>', '<?= addslashes($nome) ?>', '<?= addslashes($container) ?>', '<?= $dataOriginal ?>')">
            </div>
        </div>
<?php
    endwhile;

    // Paginação
    $result_pg = "SELECT COUNT(id) AS num_result FROM pre_embarque";
    $resultado_pg = mysqli_query($conn, $result_pg);
    $row_pg = mysqli_fetch_assoc($resultado_pg);

    $quantidade_pg = ceil($row_pg['num_result'] / $qnt_result_pg);
    $max_links = 2;

    echo "<div class='flex flex-wrap gap-2 justify-center items-center my-6 text-sm text-gray-700 dark:text-gray-300'>";

    echo "<a href='#' onclick='listar(1, $qnt_result_pg)' class='hover:underline'>&lt; PRIMEIRA</a>";

    for ($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++) {
        if ($pag_ant >= 1) {
            echo "<a href='#' onclick='listar($pag_ant, $qnt_result_pg)' class='hover:underline'>$pag_ant</a>";
        }
    }

    echo "<span class='font-bold text-green-600 dark:text-green-400'>$pagina</span>";

    for ($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++) {
        if ($pag_dep <= $quantidade_pg) {
            echo "<a href='#' onclick='listar($pag_dep, $qnt_result_pg)' class='hover:underline'>$pag_dep</a>";
        }
    }

    echo "<a href='#' onclick='listar($quantidade_pg, $qnt_result_pg)' class='hover:underline'>ÚLTIMA &gt;</a>";
    echo "</div>";

else :
?>

    <div class="flex flex-col items-center justify-center text-center text-gray-700 dark:text-gray-300 my-12">
        <img src="../assets/notFound.svg" alt="Nenhum resultado" class="w-24 h-24 mb-4">
        <h3 class="text-lg font-semibold">NENHUM PEDIDO SALVO</h3>
    </div>

<?php
endif;
?>
