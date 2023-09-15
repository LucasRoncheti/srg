<?php
include '../../generalPhp/conection.php';

// Check if 'id' parameter is provided in the URL
if (isset($_GET['id'])) {
    // Retrieve the 'id' value from the URL
    $id = $_GET['id'];

    // Create a SQL query to fetch the data for the specified 'id'
    $sql = "SELECT produto,valor FROM produtos WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);

    // Check if the query was successful and data was found
    if ($row = mysqli_fetch_assoc($result)) {
        $produto = $row['produto'];
        $valor = $row['valor'];
        $valorFormatado= number_format($valor /100,2 ,'.','.');
        
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
            <label for="produto">PRODUTO</label>
            <input placeholder="PRODUTO" type="text" id="produto" name="produto" value="<?php echo $produto; ?>" required>
        </div>

        <div class="inputBox">
            <label for="valor">VALOR</label>
            <input placeholder="VALOR" type="text" id="valor" name="valor" onkeypress="$(this).mask('R$ ###.###.##',{ reverse: true })"  value="<?php echo $valorFormatado; ?> "  required>
        </div>
       
        

        <button type="submit" value="Atualizar">SALVAR <img src="../../assets/save.svg" alt=""></button>
    </form>
</body>
</html>
