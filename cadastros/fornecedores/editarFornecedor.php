<?php
include '../../generalPhp/conection.php';

if(!isset($_SESSION)) {
    session_start();
}

if(!isset($_SESSION['id'])) {
   die( header("Location: ../../index.php"));
   
}

// Check if 'id' parameter is provided in the URL
if (isset($_GET['id'])) {
    // Retrieve the 'id' value from the URL
    $id = $_GET['id'];

    // Create a SQL query to fetch the data for the specified 'id'
    $sql = "SELECT numero, nome FROM fornecedores WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);

    // Check if the query was successful and data was found
    if ($row = mysqli_fetch_assoc($result)) {
        $numero = $row['numero'];
        $nome = $row['nome'];
    } else {
        echo 'Registro não encontrado!';
    }
} else {
    echo 'ID não fornecido na URL!';
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../index/root.css">
    <link rel="stylesheet" href="editarFornecedores.css">
    <link rel="shortcut icon" href="../../assets/favicon.svg" type="image/x-icon">
    <title>Editar Fornecedor</title>
</head>
<body>
    <form action="atualizar.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <div class="inputBox">
            <label for="numero">NÚMERO</label>
            <input placeholder="NÚMERO" type="number" id="numero" name="numero" value="<?php echo $numero; ?>" required>
        </div>

        <div class="inputBox">
            <label for="nome">NOME</label>
            <input placeholder="NOME" type="text" id="nome" name="nome" value="<?php echo $nome; ?>" required>
        </div>

        <button type="submit" value="Atualizar">SALVAR <img src="../../assets/save.svg" alt=""></button>
    </form>
</body>
</html>
