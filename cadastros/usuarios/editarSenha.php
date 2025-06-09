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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Senha</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="../../assets/favicon.svg" type="image/x-icon">
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 flex items-center justify-center min-h-screen">

    <form action="atualizarSenha.php" method="POST" class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg w-full max-w-md space-y-6">
        <h1 class="text-xl font-bold text-center">Atualizar Senha</h1>

        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="hidden" name="usuario" value="<?php echo htmlspecialchars($usuario); ?>">

        <div>
            <label for="senha" class="block text-sm font-medium mb-1">Senha</label>
            <input type="text" id="senha" name="senha" placeholder="Insira a nova senha"
                   class="w-full px-4 py-2 rounded border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500" required>
        </div>

        <div class="flex justify-between items-center gap-4">
            <button type="submit"
                class="flex-1 flex items-center justify-center gap-2 bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded transition">
                Continuar &gt;
            </button>
            <a href="cadastrodeusuarios.php"
               class="flex items-center gap-2 text-red-500 hover:text-red-600 font-semibold transition">
                <img src="../../assets/delete.svg" alt="Cancelar" class="w-5 h-5"> Cancelar
            </a>
        </div>
    </form>

</body>
</html>
