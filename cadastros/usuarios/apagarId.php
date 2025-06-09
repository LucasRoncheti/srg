<?php
include '../../generalPhp/conection.php';

if (!isset($_SESSION)) session_start();
if (!isset($_SESSION['id'])) die(header("Location: ../../index.php"));

$id = $_GET['id'] ?? null;
$confirm = $_GET['confirm'] ?? null;
$mensagem = '';
$sucesso = false;

if ($id && $confirm === 'yes') {
    $stmt = $conn->prepare("DELETE FROM usuarios WHERE id = ?");
    $stmt->bind_param("i", $id);
    $sucesso = $stmt->execute();
    $stmt->close();
    $conn->close();

    $mensagem = $sucesso ? "Registro deletado com sucesso." : "Erro ao deletar o registro.";
} else {
    $mensagem = "ID ou confirmação não fornecidos.";
}
?>

<!DOCTYPE html>
<html lang="pt-br" class="dark">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Excluir Usuário</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 flex items-center justify-center min-h-screen p-4">

  <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl p-8 max-w-md w-full text-center space-y-6">
    <img src="../../assets/<?= $sucesso ? 'fileDeleted.svg' : 'delete.svg' ?>" alt="Status" class="w-16 mx-auto">
    <h2 class="text-xl font-semibold"><?= $mensagem ?></h2>
    <a href="cadastrodeusuarios.php" class="inline-block mt-4 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded transition">
      Voltar à Lista de Usuários
    </a>
  </div>

</body>
</html>
