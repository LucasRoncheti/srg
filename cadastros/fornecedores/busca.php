<?php
include '../../generalPhp/conection.php';

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['id'])) {
    die(header("Location: ../../index.php"));
}

$palavra = $_POST['palavra'];
$query = "SELECT * FROM fornecedores WHERE nome LIKE '%$palavra%'";
$resultado = mysqli_query($conn, $query);

if (mysqli_num_rows($resultado) <= 0) {
    echo '
        <div class="flex flex-col items-center justify-center text-center p-6 text-gray-600 dark:text-gray-300">
            <img src="../../assets/notFound.svg" alt="Não encontrado" class="w-20 h-20 mb-4">
            <h3 class="text-lg font-semibold">FORNECEDOR NÃO ENCONTRADO</h3>
        </div>
    ';
} else {
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

    while ($row = mysqli_fetch_assoc($resultado)) {
        echo '<tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition">';
        echo '<td class="px-4 py-2 text-sm text-gray-800 dark:text-gray-200">' . $row['numero'] . '</td>';
        echo '<td class="px-4 py-2 text-sm text-gray-800 dark:text-gray-200">' . $row['nome'] . '</td>';
        echo '<td class="px-4 py-2 flex gap-2">';
        echo '<a href="editarFornecedor.php?id=' . $row['id'] . '"><img src="../../assets/edit.svg" alt="Editar" class="w-5 h-5"></a>';
        echo '<a href="apagarFornecedor.php?id=' . $row['id'] . '"><img src="../../assets/erase.svg" alt="Apagar" class="w-5 h-5"></a>';
        echo '</td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
    echo '</div>';
}
?>
