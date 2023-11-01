
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../index/root.css">
    <link rel="stylesheet" href="editar.css">
    <link rel="shortcut icon" href="../../assets/favicon.svg" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <title>Apagar Usuários</title>
</head>
<body>



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


          // Check if a confirmation action was triggered
          if (isset($_GET['confirm'])&& isset($_GET['id'])) {
            if ($_GET['confirm'] === 'yes') {
                // The user confirmed to delete, proceed with the deletion
                $sql = "DELETE FROM usuarios WHERE id='$id'";
                if (mysqli_query($conn, $sql)) {
                    
                    echo '<div style="height:300px;display:flex;justify-content:space-around;flex-direction:column;align-items:center;" class="popUpContainer">';
                    echo "  <img src='../../assets/fileDeleted.svg' alt='delete  image'> ";
                    echo "<h3>Registro deletado com sucesso</h3>";
                    echo "<div class='listButton'>";
                    echo "<a href='cadastrodeusuarios.php'>Lista de Usuários</a>";
                    echo "</div>";

                } else {
                    echo "Erro ao atualizar registro: " . mysqli_error($conn);
                }
                mysqli_close($conn);
                exit; // Stop execution after deletion
            }
        }
    }
        ?>

</div>
</body>
</html>