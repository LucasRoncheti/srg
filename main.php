<?php
    include 'generalPhp/conection.php';
    include 'protect.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="nofollow,noindex">
    <link rel="stylesheet" href="onLoad/onLoad.css">
    <link rel="stylesheet" href="index/root.css">
    <link rel="stylesheet" href="index/mainPage.css">
    <link rel="stylesheet" href="index/pcversion.css">

    <link rel="shortcut icon" href="assets/favicon.svg" type="image/x-icon">
    <title>Sistema de cadastro Reinholz Ginger</title>
</head>

<script src="onLoad/onLoad.js"></script>


<div class="overflow white" id="preload">
    <div class="circle-line">
        <div class="circle-red">&nbsp;</div>
        <div class="circle-blue">&nbsp;</div>
        <div class="circle-green">&nbsp;</div>
        <div class="circle-yellow">&nbsp;</div>
    </div>
</div>


<body onload="onLoad()">
    
    <header>

        <a href="logout.php" class="logoutButton">
            <img src="assets/logoutIcon.svg" alt="Icone de fazer logout da página">
        </a>


        <img src="assets/logoMainPage.svg" alt="Imagem  página inicial sistema de cadastro">

        <h1>Sistema de Cadastros e Relatórios</h1>
        <p id="data-hora"> </p>
    </header>

    <section class="containerMenuButtons">
        <a href="cadastros/cadastros.php">
            <div class="menuButtons">
                <button class="categorieButton">
                    <div class="divImgCategorieButton"><img src="assets/categories/cadastro.svg" alt="icone Cadastro">
                    </div>
                    <div class="divNameCategorieButton">
                        <h2>CADASTROS</h2>
                    </div>
                </button>
            </div>
        </a>

        <a href="pedidos/cadastrodepedidos.php">
            <div class="menuButtons">
                <button class="categorieButton">
                    <div class="divImgCategorieButton"><img src="assets/categories/pedidos.svg" alt="icone pedidos">
                    </div>
                    <div class="divNameCategorieButton">
                        <h2>PEDIDOS</h2>
                    </div>
                </button>
            </div>
        </a>

        <a href="relatorios/relatorios.php">
            <div class="menuButtons">
                <button class="categorieButton">
                    <div class="divImgCategorieButton"><img src="assets/categories/relatorios.svg"
                            alt="icone relatorios"></div>
                    <div class="divNameCategorieButton">
                        <h2>RELATÓRIOS</h2>
                    </div>
                </button>
            </div>
        </a>

        <a href="inspessao/cadastro.php">
            <div class="menuButtons">
                <button class="categorieButton">
                    <div class="divImgCategorieButton"><img src="assets/categories/inspessao.svg" alt="icone inspessao">
                    </div>
                    <div class="divNameCategorieButton">
                        <h2>INSPEÇÃO</h2>
                    </div>
                </button>
            </div>
        </a>

        <a href="packingList/cadastropackinglist.php">
            <div class="menuButtons">
                <button class="categorieButton">
                    <div class="divImgCategorieButton"><img src="assets/categories/packing_list.svg"
                            alt="icone packing_list"></div>
                    <div class="divNameCategorieButton">
                        <h2>PACKING LIST</h2>
                    </div>
                </button>
            </div>
        </a>

    </section>
  
    <footer>
        <p id="data-footer"> </p>
    </footer>
</body>



<script src="generalScripts/version.js"></script>
<script src="generalScripts/timeFormat.js"></script>

</html>