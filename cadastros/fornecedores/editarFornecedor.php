<?php
include '../../generalPhp/conection.php';

if(!isset($_SESSION)) {
    session_start();
}

if(!isset($_SESSION['id'])) {
   die(header("Location: ../../index.php"));
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT numero, nome FROM fornecedores WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
        $numero = $row['numero'];
        $nome = $row['nome'];
    } else {
        die('Registro não encontrado!');
    }
} else {
    die('ID não fornecido na URL!');
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Fornecedor</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="shortcut icon" href="../../assets/favicon.svg" type="image/x-icon">
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-white px-4">

    <form action="atualizar.php" method="POST" class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md w-full max-w-md space-y-4">
        <h1 class="text-xl font-semibold text-center">Editar Fornecedor</h1>

        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <div>
            <label for="numero" class="block text-sm font-medium mb-1">NÚMERO</label>
            <input type="number" id="numero" name="numero" value="<?php echo $numero; ?>" required
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
        </div>

        <div>
            <label for="nome" class="block text-sm font-medium mb-1">NOME</label>
            <input type="text" id="nome" name="nome" value="<?php echo $nome; ?>" required
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
        </div>

        <button type="submit"
                class="w-full flex justify-center items-center gap-2 bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-md transition">
            SALVAR <img src="../../assets/save.svg" alt="Salvar" class="w-5 h-5">
        </button>
    </form>

</body>
</html>
