<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="apagar.css">
    <link rel="stylesheet" href="../onLoad/onLoad.css">
    <link rel="stylesheet" href="../index/root.css">
    <title>Apagar Registro</title>
</head>
<script src="../onLoad/onLoad.js"></script>
<div class="overflow white" id="preload"> 
    <div class="circle-line">
        <div class="circle-red">&nbsp;</div>
        <div class="circle-blue">&nbsp;</div>
        <div class="circle-green">&nbsp;</div>
        <div class="circle-yellow">&nbsp;</div>
    </div>
</div>

<body onload="onLoad()">

    <div class="popUpContainer">
        <!-- The confirmation messages will be displayed here -->
        <?php
        include '../generalPhp/conection.php';

        // Check if 'id' parameter is provided in the URL
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        
     // Check if a confirmation action was triggered
        if (isset($_GET['confirm'])) {
            if ($_GET['confirm'] === 'yes') {
                // O usuário confirmou a exclusão, prossiga com a exclusão

                // Exclua os registros da tabela 'pedidos_dados'
                $sqlDeleteItens = "DELETE FROM pedidos_dados WHERE chaveAcesso='$id'";
                if (mysqli_query($conn, $sqlDeleteItens)) {
                    // Exclua o registro da tabela 'pedidoscadastro'
                    $sqlDeleteCadastro = "DELETE FROM pedidoscadastro WHERE chaveAcesso='$id'";
                    if (mysqli_query($conn, $sqlDeleteCadastro)) {
                        echo "<img src='../assets/fileDeleted.svg' alt='delete image'>";
                        echo "<h3>Registro deletado com sucesso</h3>";
                        echo "<div class='listButton'>";
                        echo "<a href='cadastro.html'>Lista de Fornecedores</a>";
                        echo "</div>";
                    } else {
                        echo "Erro ao excluir registro de pedidoscadastro: " . mysqli_error($conn);
                    }
                } else {
                    echo "Erro ao excluir registros de pedidos_dados: " . mysqli_error($conn);
                }
                mysqli_close($conn);
                exit; // Pare a execução após a exclusão
            }
        }


            // If no confirmation action was triggered, show the confirmation dialog
            echo"  <img src='../assets/delete.svg' alt='delete  image'> ";
            echo "<h3>Deseja realmente apagar esse registro?</h3> ";
            echo"<div class='deleteButtons'>";
            echo "<div class='yesButton'>";
            echo "<a href='apagar.php?id=$id&confirm=yes'>Sim</a>  ";
            echo "</div>";
            echo "<div class='cancelButton'>";
            echo "<a href='cadastro.html'>Cancelar</a>";
            echo "</div>";
            echo"</div>";
        } else {
            echo '<h3>Chave de acesso não fornecido na URL!</h3>';
        }
        ?>
    </div>
    
</body>
</html>



