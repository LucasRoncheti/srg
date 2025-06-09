<?php
include '../../generalPhp/conection.php';

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['id'])) {
    die(header("Location: ../../index.php"));
}

$busca = $_POST['palavra'] ?? '';

$stmt = $conn->prepare("SELECT * FROM produtos WHERE produto LIKE CONCAT('%', ?, '%')");
$stmt->bind_param("s", $busca);
$stmt->execute();
$resultado_sql = $stmt->get_result();

if ($resultado_sql->num_rows === 0) {
    echo '
        <div class="text-center mt-10">
            <img src="../../assets/notFound.svg" alt="Não encontrado" class="mx-auto w-24 h-24">
            <h3 class="text-lg font-semibold mt-4 text-gray-700 dark:text-white">PRODUTO NÃO ENCONTRADO</h3>
        </div>
    ';
} else {
    echo '
    <div class="overflow-x-auto mt-6">
        <table class="min-w-full border border-gray-300 dark:border-gray-600 text-sm text-left">
            <thead class="bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-white">
                <tr>
                    <th class="py-2 px-4 border-b">N°</th>
                    <th class="py-2 px-4 border-b">NOME PRODUTO</th>
                    <th class="py-2 px-4 border-b">VALOR</th>
                    <th class="py-2 px-4 border-b text-center">AÇÕES</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100">
    ';

    while ($row_sql = $resultado_sql->fetch_assoc()) {
        echo '
            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                <td class="py-2 px-4 border-b">' . $row_sql['id'] . '</td>
                <td class="py-2 px-4 border-b">' . htmlspecialchars($row_sql['produto']) . '</td>
                <td class="py-2 px-4 border-b">R$ ' . number_format($row_sql['valor'] / 100, 2, ",", ".") . '</td>
                <td class="py-2 px-4 border-b text-center space-x-2">
                    <a href="editar.php?id=' . $row_sql['id'] . '" class="inline-block">
                        <img src="../../assets/edit.svg" alt="Editar" class="w-5 h-5 inline-block">
                    </a>
                    <a href="apagar.php?id=' . $row_sql['id'] . '" class="inline-block">
                        <img src="../../assets/erase.svg" alt="Apagar" class="w-5 h-5 inline-block">
                    </a>
                </td>
            </tr>
        ';
    }

    echo '
            </tbody>
        </table>
    </div>';
}

$stmt->close();
$conn->close();
?>
