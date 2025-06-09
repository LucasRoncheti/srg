<?php
//Incluir a conexão com banco de dados
include '../generalPhp/conection.php';
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['id'])) {
    die(header("Location: ../index.php"));
}

// Recuperar o valor da palavra
$busca = $_POST['palavra'];

// Buscar no banco de dados
$sql = "SELECT * FROM inspecoes WHERE nome LIKE '%$busca%'";
$resultado_sql = mysqli_query($conn, $sql);

if (mysqli_num_rows($resultado_sql) <= 0) {
    echo '
    <div class="flex flex-col items-center justify-center p-6 text-center text-gray-600 dark:text-gray-300">
        <img src="../assets/notFound.svg" alt="Não encontrado" class="w-32 mb-4">
        <h3 class="text-lg font-semibold">PEDIDO NÃO ENCONTRADO</h3>
    </div>';
} else {
    while ($row_sql = mysqli_fetch_assoc($resultado_sql)) {
        $dataFormatada = date('d/m/y', strtotime($row_sql['data_inspecao']));

        echo '
        <div class="flex flex-col md:flex-row justify-between items-center gap-4 bg-white dark:bg-gray-800 rounded-lg shadow-md p-4 mb-4">
            <div class="flex flex-col text-sm text-gray-700 dark:text-gray-200">
                <span class="text-xs font-semibold">N° Cont. ' . htmlspecialchars($row_sql['numero_container']) . '</span>
                <span class="text-xs">Data: ' . $dataFormatada . '</span>
            </div>
            <div class="text-base font-medium text-gray-900 dark:text-white">' . htmlspecialchars($row_sql['nome']) . '</div>
            <div class="flex items-center gap-3">
                <a href="../inspessao/listarPedido/salvarInspessao.php?id=' . urlencode($row_sql['id']) . '&numero=' . urlencode($row_sql['id']) . '&cliente=' . urlencode($row_sql['nome']) . '&numero_container=' . urlencode($row_sql['numero_container']) . '">
                    <img src="../assets/file_green.svg" alt="Arquivo" class="w-5 h-5">
                </a>
                <img src="../assets/erase.svg" alt="Excluir" class="w-5 h-5 cursor-pointer" onclick="deletarInspecao(' . $row_sql['id'] . ')">
                <img src="../assets/edit.svg" alt="Editar" class="w-5 h-5 cursor-pointer" onclick="editarInspecao(' . $row_sql['id'] . ', \'' . $row_sql['nome'] . '\', ' . $row_sql['numero_container'] . ', \'' . $row_sql['data_inspecao'] . '\')">
            </div>
        </div>';
    }
}
?>
