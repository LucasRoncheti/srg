<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="apagar.css">
    <link rel="stylesheet" href="../../onLoad/onLoad.css">
    <link rel="stylesheet" href="../../index/root.css">
    <title>Apagar Registro</title>
</head>
<script src="../../onLoad/onLoad.js"></script>
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
        include '../../generalPhp/conection.php';
      

        // Check if 'id' parameter is provided in the URL
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $valorTotalSalvo = intval($_GET['valorPedidoSalvo']);
            $valorTotaldoItem =intval($_GET['valorTotal']);
            $chaveAcesso = $_GET['chaveAcesso'];

            $valorSomadoNovamente = $valorTotalSalvo - $valorTotaldoItem;
         
           
            // Check if a confirmation action was triggered
            if (isset($_GET['confirm'])) {
                if ($_GET['confirm'] === 'yes') {
                    // The user confirmed to delete, proceed with the deletion
                    $sqlDelete = "DELETE FROM pedidos_dados WHERE id='$id'";

                    if (mysqli_query($conn, $sqlDelete)) {
                        // Atualize o valor total usando uma prepared statement
                        $sqlUpdate = "UPDATE pedidoscadastro SET valor_total = ? WHERE chaveAcesso = ?";
                        $stmt = mysqli_prepare($conn, $sqlUpdate);
                        mysqli_stmt_bind_param($stmt, "ds", $valorSomadoNovamente, $chaveAcesso);
                        
                        if (mysqli_stmt_execute($stmt)) {
                            echo "<img src='../../assets/fileDeleted.svg' alt='delete image'>";
                            echo "<h3>Registro deletado com sucesso</h3>";
                            echo "<div class='listButton'>";
                            echo "<a href='../cadastrodepedidos.php'>Lista de Pedidos</a>";
                            echo "</div>";
                        } else {
                            echo "Erro ao atualizar registro: " . mysqli_error($conn);
                        }
                        mysqli_stmt_close($stmt);
                    } else {
                        echo "Erro ao excluir registro: " . mysqli_error($conn);
                    }
                    mysqli_close($conn);
                    exit; // Stop execution after deletion
                }
            }

            // If no confirmation action was triggered, show the confirmation dialog
            echo "<img src='../../assets/delete.svg' alt='delete image'>";
            echo "<h3>Deseja realmente apagar esse registro?</h3>";
            echo "<div class='deleteButtons'>";
            echo "<div class='yesButton'>";
            echo "<a href='apagar.php?id=$id&valorTotal=$valorTotaldoItem&valorPedidoSalvo=$valorTotalSalvo&chaveAcesso=$chaveAcesso&confirm=yes'>Sim</a> ";
            echo "</div>";
            echo "<div class='cancelButton'>";
            echo "<a href='../cadastrodepedidos.php'>Cancelar</a>";
            echo "</div>";
            echo "</div>";
        } else {
            echo '<h3>Chave de acesso não fornecida na URL!</h3>';
        }
        ?>
    </div>
    
</body>
</html>
