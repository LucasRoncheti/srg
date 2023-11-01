<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="apagar.css">
    <link rel="stylesheet" href="../../index/root.css">
    <title>Apagar Registro</title>
</head>

<body>

    <div class="popUpContainer">
        <!-- The confirmation messages will be displayed here -->
        <?php
        include '../../generalPhp/conection.php';
        if (!isset($_SESSION)) {
            session_start();
        }

        if (!isset($_SESSION['id'])) {
            die(header("Location: ../../index.php"));

        }

  // Check if 'id' parameter is provided in the URL
  if (isset($_GET['id']) && isset($_GET['senha'])) {
    // Os parâmetros 'id' e 'senha' estão presentes na URL, você pode prosseguir com a exclusão.
    $id = $_GET['id'];
    $senha = $_GET['senha'];

        //consulta sql
        
        $sql = " SELECT * FROM usuarios WHERE id='$id'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $senhaAtual = $row["senha"];
            $usuario = $row['usuario'];
          

            if ($senhaAtual == $senha) {

                    // If no confirmation action was triggered, show the confirmation dialog
                    echo "  <img src='../../assets/delete.svg' alt='delete  image'> ";
                    echo "<h3>Deseja realmente apagar esse registro?</h3> ";
                    echo "<div class='deleteButtons'>";
                    echo "<div class='yesButton'>";
                    echo "<a href='apagarId.php?id=$id&confirm=yes'>Sim</a> ";
                    echo "</div>";
                    echo "<div class='cancelButton'>";
                    echo "<a href='cadastrodeusuarios.php'>Cancelar</a>";
                    echo "</div>";
                    echo "</div>";
               

            } else {
                echo "<h3>Senha Incorreta </h3>";
                echo "<div class='listButton'>";
                echo "<a href='cadastrodeusuarios.php'>Lista de Usuários</a>";
                echo "</div>" . mysqli_error($conn);
            }
        }

        mysqli_close($conn);

    } else {
        echo 'Id não fornecido na URL';
    }

        ?>
    </div>

</body>

</html>