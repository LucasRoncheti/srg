<?php
include '../generalPhp/conection.php';

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['id'])) {
    die(header("Location: ../index.php"));
}

$busca = $_POST['palavra'];

$sql = "SELECT * FROM pedidoscadastro WHERE cliente LIKE '%$busca%'";
$resultado_sql = mysqli_query($conn, $sql);

if (mysqli_num_rows($resultado_sql) <= 0) {
    echo '
        <div class="flex flex-col items-center justify-center text-center p-6 text-gray-500 dark:text-gray-400">
            <img src="../assets/notFound.svg" alt="Não encontrado" class="w-24 h-24 mb-4">
            <h3 class="text-lg font-semibold">PEDIDO NÃO ENCONTRADO</h3>
        </div>
    ';
} else {
    while ($row_sql = mysqli_fetch_assoc($resultado_sql)) {
        $dataFormatada = date('d/m/y', strtotime($row_sql['dataAtual']));
        $valorFormatado = 'R$ ' . number_format($row_sql['valor_total'] / 100, 2, ',', '.');

        echo '<div class="bg-white dark:bg-gray-800 border dark:border-gray-700 rounded-md p-4 mb-4 shadow hover:shadow-lg transition">';
        echo '    <div class="flex items-center justify-between text-sm text-gray-600 dark:text-gray-400 mb-2">';
        echo '        <div class="font-semibold text-black dark:text-white">Pedido Nº ' . $row_sql['id'] . '</div>';
        echo '        <div>' . $dataFormatada . '</div>';
        echo '    </div>';
        echo '    <div class="flex items-center justify-between mb-2">';
        echo '        <div class="text-lg font-medium text-black dark:text-white">' . $row_sql['cliente'] . '</div>';
        echo '        <div class="text-green-600 dark:text-green-400 font-semibold">' . $valorFormatado . '</div>';
        echo '    </div>';
        echo '    <div class="flex gap-4 justify-end mt-2">';
        echo '        <a href="print.php?id=' . $row_sql['chaveAcesso'] . '" title="Imprimir">';
        echo '            <img src="../assets/print.svg" class="w-5 h-5 hover:opacity-80 transition">';
        echo '        </a>';
        echo '        <a href="editar/editar.php?id=' . $row_sql['chaveAcesso'] . '" title="Editar">';
        echo '            <img src="../assets/edit.svg" class="w-5 h-5 hover:opacity-80 transition">';
        echo '        </a>';
        echo '        <a href="apagar.php?id=' . $row_sql['chaveAcesso'] . '" title="Apagar">';
        echo '            <img src="../assets/erase.svg" class="w-5 h-5 hover:opacity-80 transition">';
        echo '        </a>';
        echo '    </div>';
        echo '</div>';
    }
}
?>
