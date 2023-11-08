

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="apagarFornecedor.css">
    <link rel="stylesheet" href="../../index/root.css">
    <link rel="shortcut icon" href="../../assets/favicon.svg" type="image/x-icon">
   <title>Registro atualizado</title>
</head>
<body>


         <div class ="popUpContainer">

            <?php
               include '../../generalPhp/conection.php';

            //    if(!isset($_SESSION)) {
            //       session_start();
            //   }
              
            //   if(!isset($_SESSION['id'])) {
            //      die( header("Location: ../../index.php"));
                 
            //   }


               //recebe os dados pelo metodo post

               $id=$_POST['id'];
               $numero=$_POST['numero'];
               $nome=$_POST['nome'];

               //consulta sql

               $sql = " UPDATE fornecedores SET numero='$numero', nome='$nome' WHERE id='$id'";

               if(mysqli_query($conn,$sql)){
                  echo"  <img src='../../assets/refresh.svg' alt='delete  image'> ";
                  echo "<h3>Registro atualizado  com sucesso </h3>";
                  echo "<div class='listButton'>";
                  echo "<a href='cadastrodeFornecedor.php'>Lista de Fornecedores</a>";
                  echo "</div>";
               }else{
               echo" Erro ao atualizar fornecedor" . msqli_error($conn);
               }

               mysqli_close($conn)
            ?>

         </div>
   
</body>
</html>