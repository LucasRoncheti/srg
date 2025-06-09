<?php
include '../../generalPhp/conection.php';

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['id'])) {
    die(header("Location: ../../index.php"));
}

$id = $_POST['id'] ?? null;
$senha = $_POST['senha'] ?? null;

if (!$id || !$senha) {
    echo 'Dados incompletos!';
    exit;
}

$sql = "SELECT usuario, senha FROM usuarios WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    if ($row['senha'] === $senha) {
        // Exibe o formulário de alteração com Tailwind
        $usuario = htmlspecialchars($row['usuario']);
        echo <<<HTML
        <!DOCTYPE html>
        <html lang="pt-br" class="dark">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Editar Usuário</title>
            <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        </head>
        <body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 flex items-center justify-center min-h-screen">
            <form action="atualizar.php" method="POST" class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg w-full max-w-md space-y-6">
                <h2 class="text-xl font-bold text-center">Atualizar Usuário</h2>
                <input type="hidden" name="id" value="{$id}">

                <div>
                    <label class="block text-sm font-medium mb-1">Usuário</label>
                    <input type="text" name="usuario" value="{$usuario}" required
                        class="w-full px-4 py-2 rounded border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Nova Senha</label>
                    <input type="text" name="senha" placeholder="Nova Senha" required
                        class="w-full px-4 py-2 rounded border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>

                <button type="submit"
                    class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded transition flex items-center justify-center gap-2">
                    SALVAR <img src="../../assets/save.svg" class="w-5 h-5" alt="">
                </button>
            </form>
        </body>
        </html>
        HTML;
    } else {
        echo <<<HTML
        <div class="min-h-screen flex items-center justify-center bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-white p-4">
            <div class="text-center">
                <h3 class="text-xl font-semibold mb-4">Senha incorreta!</h3>
                <a href="cadastrodeusuarios.php"
                   class="text-green-600 hover:underline font-semibold text-lg">
                   Voltar para lista de usuários
                </a>
            </div>
        </div>
        HTML;
    }
} else {
    echo 'Usuário não encontrado.';
}

$conn->close();
?>
