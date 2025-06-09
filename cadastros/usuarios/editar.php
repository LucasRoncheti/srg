<?php
include '../../generalPhp/conection.php';

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['id'])) {
    die(header("Location: ../../index.php"));
}

$usuario = '';
$senha = '';
$id = '';

// Verifica se o ID foi passado
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT usuario, senha FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $usuario = $row['usuario'];
        $senha = $row['senha'];
    } else {
        echo 'Registro não encontrado!';
        exit;
    }
} else {
    echo 'ID não fornecido!';
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br" class="dark">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Editar Usuário</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" />
    <link rel="shortcut icon" href="../../assets/favicon.svg" type="image/x-icon">
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 min-h-screen flex items-center justify-center">

    <form action="atualizar.php" method="POST" class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-md w-full max-w-md space-y-6">
        <h1 class="text-2xl font-bold text-center mb-4">Editar Usuário</h1>

        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <div class="space-y-2">
            <label for="usuario" class="block text-sm font-medium">Usuário</label>
            <input type="text" id="usuario" name="usuario" value="<?php echo htmlspecialchars($usuario); ?>" required
                class="w-full px-4 py-2 rounded border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500" />
        </div>

        <div class="space-y-2">
            <label for="senha" class="block text-sm font-medium">Nova Senha</label>
            <input type="text" id="senha" name="senha" value="<?php echo htmlspecialchars($senha); ?>" required
                class="w-full px-4 py-2 rounded border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500" />
        </div>

        <button type="submit"
            class="w-full flex items-center justify-center gap-2 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded font-semibold transition">
            Salvar
            <img src="../../assets/save.svg" alt="Salvar" class="w-5 h-5" />
        </button>
    </form>

</body>
</html>
