<?php
include '../../generalPhp/conection.php';



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
    <link rel="shortcut icon" href="../../assets/favicon.svg" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <title>Editar Usuários</title>
</head>
<body>
    <form action="atualizarSenha.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="hidden" name="usuario" value="<?php echo $usuario; ?>">

        <div class="inputBox">

            
            <label for="valor">SENHA</label>
            <input placeholder="INSIRA A SENHA" type="text" id="senha" name="senha" value=""  required>
            </div>
       
        

        <button type="submit" value="Atualizar">CONTINUAR></button>
        <a  href="cadastrodeusuarios.php">CANCELAR<img style="width:20px;heigth:20px;" src="../../assets/delete.svg" alt=""></a>
      

    </form>
</body>
</html>
