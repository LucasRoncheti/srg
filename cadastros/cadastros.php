    <?php
    include '../generalPhp/conection.php';


    if(!isset($_SESSION)) {
        session_start();
    }
    
    if(!isset($_SESSION['id'])) {
        die( header("Location: ../index.php"));
       
    }
    
    
    
    ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="nofollow,noindex">
    <link rel="stylesheet" href="../index/root.css">
    <link rel="stylesheet" href="../onLoad/onLoad.css">
    <link rel="stylesheet" href="../mobileMenu/css/mobileMenu.css">
    <link rel="stylesheet" href="css/cadastrosMainPage.css">
    
    <link rel="shortcut icon" href="../assets/favicon.svg" type="image/x-icon">
    <title>Cadastros</title>
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

    

    <div id="mobileMenu" class="mobileMenuContainer ">
        <button onclick="openMenu()" id="mobileMenuButtonClose" class="mobileMenuButtonClose">
            <img src="../assets/x.svg" alt="Menu mobile da página">
        </button>
            <div class="mobileMenuButtons">
                <a href="../main.php">
                    <div class="menuButtonsMobile">
                        <button class="categorieButtonMobile">
                            <div class="divImgCategorieButtonMobile"><img src="../assets/mobileIcons/🦆 icon _home_.svg" alt="icone fornecedor"></div>
                            <div class="divNameCategorieButtonMobile"><h2>INÍCIO</h2></div>
                        </button>
                    </div>
                </a>

                <a href="cadastros.php">
                    <div class="menuButtonsMobile">
                        <button class="categorieButtonMobile">
                            <div class="divImgCategorieButtonMobile"><img src="../assets/mobileIcons/🦆 icon _book_-1.svg" alt="icone fornecedor"></div>
                            <div class="divNameCategorieButtonMobile"><h2>CADASTROS</h2></div>
                        </button>
                    </div>
                </a>
                <a href="../pedidos/cadastrodepedidos.php">
                    <div class="menuButtonsMobile">
                        <button class="categorieButtonMobile">
                            <div class="divImgCategorieButtonMobile"><img src="../assets/mobileIcons/🦆 icon _list_-1.svg" alt="icone fornecedor"></div>
                            <div class="divNameCategorieButtonMobile"><h2>PEDIDOS</h2></div>
                        </button>
                    </div>
                </a>
                <a href="../relatorios/relatorios.php">
                    <div class="menuButtonsMobile">
                        <button class="categorieButtonMobile">
                            <div class="divImgCategorieButtonMobile"><img src="../assets/mobileIcons/🦆 icon _pie chart_-1.svg" alt="icone fornecedor"></div>
                            <div class="divNameCategorieButtonMobile"><h2>RELATÓRIOS</h2></div>
                        </button>
                    </div>
                </a>
                <a href="../inspessao/cadastro.php">
                    <div class="menuButtonsMobile">
                        <button class="categorieButtonMobile">
                            <div class="divImgCategorieButtonMobile"><img src="../assets/mobileIcons/🦆 icon _magnifying glass_-1.svg" alt="icone fornecedor"></div>
                            <div class="divNameCategorieButtonMobile"><h2>INSPEÇÃO</h2></div>
                        </button>
                    </div>
                </a>
                <a href="../packingList/cadastropackinglist.php">
                    <div class="menuButtonsMobile">
                        <button class="categorieButtonMobile">
                            <div class="divImgCategorieButtonMobile"><img src="../assets/mobileIcons/🦆 icon _check_-1.svg" alt="icone fornecedor"></div>
                            <div class="divNameCategorieButtonMobile"><h2>PACKING LIST</h2></div>
                        </button>
                    </div>
                </a>
             

            </div>   

    </div>


   <header>
    <button onclick="openMenu()" id="mobileMenuButton" class="mobileMenuButton">
        <img src="../assets/menu_mobile.svg" alt="Menu mobile da página">
    </button>

    <img class="topIconCategorie" src="../assets/categories/Cadastros/Cadastro.svg" alt="icone cadastro">

    <h1>CADASTROS</h1>
   
   </header>

   <section class="containerMenuButtons">
        <a href="fornecedores/cadastrodeFornecedor.php"><div class="menuButtons">
            <button class="categorieButton">
                <div class="divImgCategorieButton"><img src="../assets/categories/Cadastros/fornecedor.svg" alt="icone fornecedor"></div>
                <div class="divNameCategorieButton"><h2>FORNECEDOR</h2></div>
            </button>
        </div></a>

        <a href="produtos/cadastrodeproduto.php"><div class="menuButtons">
            <button class="categorieButton">
                <div class="divImgCategorieButton"><img src="../assets/categories/Cadastros/produto.svg" alt="icone produtos"></div>
                <div class="divNameCategorieButton"><h2>PRODUTO</h2></div>
            </button>
        </div></a>

        <a href="clientes/cadastrodecliente.php"><div class="menuButtons">
            <button class="categorieButton">
                <div class="divImgCategorieButton"><img src="../assets/categories/Cadastros/cliente.svg" alt="icone cliente"></div>
                <div class="divNameCategorieButton"><h2>CLIENTE</h2></div>
            </button>
        </div></a>

        <a href="usuarios/cadastrodeusuarios.php"><div class="menuButtons">
            <button class="categorieButton">
                <div class="divImgCategorieButton"><img src="../assets/categories/Cadastros/usuarios.svg" alt="icone usuários"></div>
                <div class="divNameCategorieButton"><h2>USUÁRIOS</h2></div>
            </button>
        </div></a>
        
        
      
   </section>

   <footer>
    <p  id="data-footer">  </p>
   </footer>
</body>

<script src="../mobileMenu/js/mobileMenu.js"></script>
<script src="../generalScripts/version.js"></script>
</html>