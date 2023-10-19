<?php
include '../../generalPhp/conection.php';

// Check if 'id' parameter is provided in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Use uma consulta preparada para evitar injeção de SQL
    $stmt = $conn->prepare("SELECT * FROM pedidos_dados WHERE chaveAcesso = ?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();

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
    <title>Editar Pedidos</title>

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
            <img src="../../assets/x.svg" alt="Menu mobile da página">
        </button>
        <div class="mobileMenuButtons">
            <a href="../../index.html">
                <div class="menuButtonsMobile">
                    <button class="categorieButtonMobile">
                        <div class="divImgCategorieButtonMobile"><img src="../../assets/mobileIcons/🦆 icon _home_.svg"
                                alt="icone fornecedor"></div>
                        <div class="divNameCategorieButtonMobile">
                            <h2>INÍCIO</h2>
                        </div>
                    </button>
                </div>
            </a>

            <a href="../../cadastros/cadastros.html">
                <div class="menuButtonsMobile">
                    <button class="categorieButtonMobile">
                        <div class="divImgCategorieButtonMobile"><img
                                src="../../assets/mobileIcons/🦆 icon _book_-1.svg" alt="icone fornecedor"></div>
                        <div class="divNameCategorieButtonMobile">
                            <h2>CADASTROS</h2>
                        </div>
                    </button>
                </div>
            </a>
            <a href="../../pedidos/cadastro.html">
                <div class="menuButtonsMobile">
                    <button class="categorieButtonMobile">
                        <div class="divImgCategorieButtonMobile"><img
                                src="../../assets/mobileIcons/🦆 icon _list_-1.svg" alt="icone fornecedor"></div>
                        <div class="divNameCategorieButtonMobile">
                            <h2>PEDIDOS</h2>
                        </div>
                    </button>
                </div>
            </a>
            <a href="#">
                <div class="menuButtonsMobile">
                    <button class="categorieButtonMobile">
                        <div class="divImgCategorieButtonMobile"><img
                                src="../../assets/mobileIcons/🦆 icon _pie chart_-1.svg" alt="icone fornecedor"></div>
                        <div class="divNameCategorieButtonMobile">
                            <h2>RELATÓRIOS</h2>
                        </div>
                    </button>
                </div>
            </a>
            <a href="#">
                <div class="menuButtonsMobile">
                    <button class="categorieButtonMobile">
                        <div class="divImgCategorieButtonMobile"><img
                                src="../../assets/mobileIcons/🦆 icon _magnifying glass_-1.svg" alt="icone fornecedor">
                        </div>
                        <div class="divNameCategorieButtonMobile">
                            <h2>INSPESSÃO</h2>
                        </div>
                    </button>
                </div>
            </a>
            <a href="#">
                <div class="menuButtonsMobile">
                    <button class="categorieButtonMobile">
                        <div class="divImgCategorieButtonMobile"><img
                                src="../../assets/mobileIcons/🦆 icon _check_-1.svg" alt="icone fornecedor"></div>
                        <div class="divNameCategorieButtonMobile">
                            <h2>PACKING LIST</h2>
                        </div>
                    </button>
                </div>
            </a>


        </div>

    </div>


        <header>

            <a href="../cadastro.html"><button id="backButton" class="backButton">
                    <img src="../../assets/backArrow.svg" alt="Botão para voltar a página anterior">
                </button>
            </a>

            <button onclick="openMenu()" id="mobileMenuButton" class="mobileMenuButton">
                <img src="../../assets/menu_mobile.svg" alt="Menu mobile da página">
            </button>

            <div style="display:none;">
                <input  id="dataAtual" class="dataPedido" type="date">
            </div> 

        </header>

       
        <div class="containerList">
                       
                <?php
                        // Check if the query was successful and data was found
                        if ($result && $result->num_rows != 0) {

                            while ($row = mysqli_fetch_assoc($result)) {
                                $fornecedor = $row['fornecedor'];
                                

                            }
                        } else {
                            echo 'Registro não encontrado!';
                        }
                        } else {
                        echo 'ID não fornecido na URL!';
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

<script src="../../generalScripts/atualDate.js"></script>


