

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="apagar.css">
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
               $senha=$_POST['senha'];
           

              

               //consulta sql

               $sql = " SELECT * FROM usuarios WHERE id='$id'";
               $result = mysqli_query($conn, $sql);

               if($result){
                  $row = mysqli_fetch_assoc($result);
                  $senhaAtual = $row["senha"];
                  $usuario = $row['usuario'];

                  if($senhaAtual == $senha) {
                     echo ' <!DOCTYPE html>
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
                         <form action="atualizar.php" method="POST">
                             <input type="hidden" name="id" value="'. $id.'">
                     
                             <div class="inputBox">
                                 <label for="usuario">USUÁRIO</label>
                                 <input placeholder="USUÁRIO" type="text" id="usuario " name="usuario" value="'. $usuario.'" required>
                             </div>
                         
                            
                     
                             <div class="inputBox">
                                 <label for="valor">NOVA SENHA</label>
                                 <input placeholder="NOVA SENHA" type="text" id="senha" name="senha" value="'. $senha.'"  required>
                             </div>
                            
                             
                     
                             <button type="submit" value="Atualizar">SALVAR <img style="width:30px" src="../../assets/save.svg" alt=""></button>
                         </form>
                     </body>
                     </html>';
               }else{
                  echo "<h3>Senha Incorreta </h3>";
                  echo "<div class='listButton'>";
                  echo "<a href='cadastrodeusuarios.php'>Lista de Usuários</a>";
                  echo "</div>". mysqli_error($conn);
               }
            }

               mysqli_close($conn)
            ?>

         </div>
   
</body>
</html>