<?php
include '../../generalPhp/conection.php';

if (!isset($_SESSION)) session_start();
if (!isset($_SESSION['id'])) die(header("Location: ../../index.php"));

$id = $_GET['id'] ?? null;
$senha = $_GET['senha'] ?? null;
$erro = '';
$usuario = '';

if ($id && $senha) {
    $stmt = $conn->prepare("SELECT usuario, senha FROM usuarios WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if ($senha === $row['senha']) {
            $usuario = htmlspecialchars($row['usuario']);
        } else {
            $erro = "Senha incorreta!";
        }
    } else {
        $erro = "Usuário não encontrado.";
    }

    $stmt->close();
    $conn->close();
} else {
    $erro = "Parâmetros não fornecidos.";
}
?>

<!DOCTYPE html>
<html lang="pt-br" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 flex items-center justify-center min-h-screen p-4">

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8 max-w-md w-full text-center space-y-6">
        <?php if ($erro): ?>
            <h2 class="text-xl font-bold text-red-600"><?= $erro ?></h2>
            <a href="cadastrodeusuarios.php" class="text-green-600 hover:underline">Voltar para lista de usuários</a>
        <?php else: ?>
            <img src="../../assets/delete.svg" alt="Deletar" class="w-16 mx-auto">
            <h2 class="text-lg font-semibold">Deseja realmente apagar o usuário <strong><?= $usuario ?></strong>?</h2>
            <div class="flex justify-center gap-4 mt-4">
                <a href="apagarId.php?id=<?= $id ?>&confirm=yes"
                   class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">Sim</a>
                <a href="cadastrodeusuarios.php"
                   class="bg-gray-300 hover:bg-gray-400 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-white px-4 py-2 rounded">Cancelar</a>
            </div>
        <?php endif; ?>
    </div>

</body>
</html>
