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
    $sql = "SELECT usuario,senha FROM usuarios WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);

    // Check if the query was successful and data was found
    if ($row = mysqli_fetch_assoc($result)) {
        $usuario = $row['usuario'];
        $senha = $row['senha'];
        
        
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
    <link rel="stylesheet" href="editar.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <title>Editar Produto</title>
</head>
<body>
    <form action="atualizar.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <div class="inputBox">
            <label for="usuario">USUÁRIO</label>
            <input placeholder="USUÁRIO" type="text" id="usuario " name="usuario" value="<?php echo $usuario; ?>" required>
        </div>

       

        <div class="inputBox">
            <label for="valor">NOVA SENHA</label>
            <input placeholder="NOVA SENHA" type="password" id="senha" name="senha" value="<?php echo $senha; ?>"  required>
        </div>
       
        

        <button type="submit" value="Atualizar">SALVAR <img src="../../assets/save.svg" alt=""></button>
    </form>
</body>
</html>
