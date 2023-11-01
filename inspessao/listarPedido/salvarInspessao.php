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
    $id = $_GET['id'];
    $numero = $_GET['numero'];
    $cliente = $_GET['cliente'];
    
    // Use uma consulta preparada para evitar injeção de SQL
    $stmt = $conn->prepare("SELECT * FROM pedidos_dados WHERE chaveAcesso = ?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="nofollow,noindex">
    <link rel="stylesheet" href="../../index/root.css">
    <link rel="stylesheet" href="../../onLoad/onLoad.css">
    <link rel="stylesheet" href="../../mobileMenu/css/mobileMenu.css">
    <link rel="stylesheet" href="salvarInspessao.css">

    <link rel="shortcut icon" href="../../assets/favicon.svg" type="image/x-icon">
    <title>Inspeção</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
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




<body id="body" onload="onLoad()">

    <!--Menu mobile   -->

    <div id="mobileMenu" class="mobileMenuContainer ">
        <button style="width: 50px;" onclick="openMenu()" id="mobileMenuButtonClose" class="mobileMenuButtonClose">
            <img style="width:35px" src="../../assets/x.svg" alt="Menu mobile da página">
        </button>
            <div class="mobileMenuButtons">
                <a href="../../main.php">
                    <div class="menuButtonsMobile">
                        <button class="categorieButtonMobile">
                            <div class="divImgCategorieButtonMobile"><img style="width:20px" src="../../assets/mobileIcons/🦆 icon _home_.svg" alt="icone fornecedor"></div>
                            <div class="divNameCategorieButtonMobile"><h2>INÍCIO</h2></div>
                        </button>
                    </div>
                </a>

                <a href="../../cadastros/cadastros.php">
                    <div class="menuButtonsMobile">
                        <button class="categorieButtonMobile">
                            <div class="divImgCategorieButtonMobile"><img  style="width:20px" src="../../assets/mobileIcons/🦆 icon _book_-1.svg" alt="icone fornecedor"></div>
                            <div class="divNameCategorieButtonMobile"><h2>CADASTROS</h2></div>
                        </button>
                    </div>
                </a>
                <a href="../../pedidos/cadastrodepedidos.php">
                    <div class="menuButtonsMobile">
                        <button class="categorieButtonMobile">
                            <div class="divImgCategorieButtonMobile"><img  style="width:20px" src="../../assets/mobileIcons/🦆 icon _list_-1.svg" alt="icone fornecedor"></div>
                            <div class="divNameCategorieButtonMobile"><h2>PEDIDOS</h2></div>
                        </button>
                    </div>
                </a>
                <a href="../../relatorios/relatorios.php">
                    <div class="menuButtonsMobile">
                        <button class="categorieButtonMobile">
                            <div class="divImgCategorieButtonMobile"><img  style="width:20px" src="../../assets/mobileIcons/🦆 icon _pie chart_-1.svg" alt="icone fornecedor"></div>
                            <div class="divNameCategorieButtonMobile"><h2>RELATÓRIOS</h2></div>
                        </button>
                    </div>
                </a>
                <a href="../../inspessao/cadastro.php">
                    <div class="menuButtonsMobile">
                        <button class="categorieButtonMobile">
                            <div class="divImgCategorieButtonMobile"><img  style="width:20px" src="../../assets/mobileIcons/🦆 icon _magnifying glass_-1.svg" alt="icone fornecedor"></div>
                            <div class="divNameCategorieButtonMobile"><h2>INSPEÇÃO</h2></div>
                        </button>
                    </div>
                </a>
                <a href="../../packingList/cadastropackinglist.php">
                    <div class="menuButtonsMobile">
                        <button class="categorieButtonMobile">
                            <div class="divImgCategorieButtonMobile"><img  style="width:20px" src="../../assets/mobileIcons/🦆 icon _check_-1.svg" alt="icone fornecedor"></div>
                            <div class="divNameCategorieButtonMobile"><h2>PACKING LIST</h2></div>
                        </button>
                    </div>
                </a>
             

            </div>   

    </div>


        <header>

            <a href="../cadastro.php"><button id="backButton" class="backButton">
                    <img src="../../assets/backArrow.svg" alt="Botão para voltar a página anterior">
                </button>
            </a>

            <button onclick="openMenu()" id="mobileMenuButton" class="mobileMenuButton">
                <img src="../../assets/menu_mobile.svg" alt="Menu mobile da página">
            </button>

           <div class="cabecalhoNome">
           <img src="../../assets/categories/inspessao.svg" alt=""> <H3>N° <?php echo $numero;?> <?php echo $cliente;?></H3>
           <img onclick="teste(window.print())" style = "width:25px;margin-left:15px" src="../../assets/print.svg" alt="">
           </div>

        </header>

       
        <div class="containerList">
          
            <?php 
               if ($result && $result->num_rows != 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $fornecedor = $row['fornecedor'];
                    $id_item = $row['id'];
            
                    $stmt1 = $conn->prepare("SELECT numero FROM fornecedores WHERE nome = ?");
                    $stmt1->bind_param("s", $fornecedor);
                    $stmt1->execute();
                    $resultado = $stmt1->get_result();
            
                    if ($resultado->num_rows > 0) {
                        $row = $resultado->fetch_assoc();
                        $numero = $row['numero'];
                    }
            
                    echo ' 
                    <form class="formImgens" action="upload.php" method="post" enctype="multipart/form-data">
                        <div class="dadosFornecedor">
                            <div class="forncedorNum">N° ' . $numero . '</div>
                            <div class="nomeFornecedor"> ' . $fornecedor . '</div>
                        </div>
                        <div class="inputContainer">';
                        
                        // Agora, dentro do loop do fornecedor, você pode listar registros de imagens associados a esse fornecedor
                        $stmt0 = $conn->prepare("SELECT * FROM imagens WHERE id_item = ?");
                        $stmt0->bind_param("i", $id_item);
                        $stmt0->execute();
                        $resultado0 = $stmt0->get_result();
                
                        if ($resultado0 && $resultado0->num_rows != 0) {
                            while ($rows0 = mysqli_fetch_assoc($resultado0)) {
                                $path = $rows0['pathImagem'];
                                $id_image = $rows0['id'];

                                $slq2 = "SELECT pathimagem FROM imagensalta WHERE id = '$id_image' ";
                                $resultadoSql2 = mysqli_query($conn,$slq2);

                                if($resultadoSql2&&$resultadoSql2->num_rows != 0){
                                    $rows1 = mysqli_fetch_assoc($resultadoSql2);
                                        $pathHD = $rows1['pathimagem'];
                                    
                                echo '
                                <div id="'.$id_image.'thumb" class="thumbnailImageLoaded">
                                    <div class="apagarImagem" onclick="apagarImagem(\''.$id_image.'\')"><img   src="../../assets/erase1.svg"></div>
                                    <div class="buttonUploadImg"  > <img src="'.$path.'"> </div>
                                    <input id="'.$id_image.'inputThumb"  type="hidden" value="'. $path.'">
                                    <input id="'.$id_image.'input"  type="hidden" value="'. $pathHD.'">

                                       
                                </div>

                                
                                ';
                            }
                            }
                        } else {
                            echo "";
                        }

                        echo '
                        
                            <div class="inputThumbnail">
                                <input type="file" accept="image/*" capture="environment" id="' . $id_item . '" style="display: none;" onchange="enviarImagem(this)">
                                <div class="buttonUploadImg" onclick="teste(\'' . $id_item . '\')"> <img src="../../assets/photo.svg"> </div>
                            </div>
                        </div>
                    </form>';
            
                   
                }
            }

            ?>

        </div>

        <footer>
            <p id="data-footer"> </p>
        </footer>

</body>

</html>

<script src="../../mobileMenu/js/mobileMenu.js"></script>

<script src="../../generalScripts/version.js"></script>

<script src="../../generalScripts/backPage.js"></script>
<script src="upload.js"></script>
<script src="apagarImg.js"></script>
<script src="abrirImgHD.js"></script>
<script>
    function reload(){
        window.location.reload()
    }
</script>
<script>
    function teste(id){
        document.getElementById(id).click()
        console.log(id)
    }
</script>


