<?php

    
if(!isset($_SESSION)) {
    session_start();
}

if(!isset($_SESSION['id'])) {
    die( header("Location: ../../index.php"));
   
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
    <link rel="stylesheet" href="../usuarios/cadastro.css">
    
    <link rel="shortcut icon" href="../../assets/favicon.svg" type="image/x-icon">
    <title>Cadastro Usuários</title>

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

<body onload="onLoad()">

    

    <div id="mobileMenu" class="mobileMenuContainer ">
        <button style="width: 50px;" onclick="openMenu()" id="mobileMenuButtonClose" class="mobileMenuButtonClose">
            <img src="../../assets/x.svg" alt="Menu mobile da página">
        </button>
            <div class="mobileMenuButtons">
                <a href="../../index.html">
                    <div class="menuButtonsMobile">
                        <button class="categorieButtonMobile">
                            <div class="divImgCategorieButtonMobile"><img src="../../assets/mobileIcons/🦆 icon _home_.svg" alt="icone fornecedor"></div>
                            <div class="divNameCategorieButtonMobile"><h2>INÍCIO</h2></div>
                        </button>
                    </div>
                </a>

                <a href="../cadastros.html">
                    <div class="menuButtonsMobile">
                        <button class="categorieButtonMobile">
                            <div class="divImgCategorieButtonMobile"><img src="../../assets/mobileIcons/🦆 icon _book_-1.svg" alt="icone fornecedor"></div>
                            <div class="divNameCategorieButtonMobile"><h2>CADASTROS</h2></div>
                        </button>
                    </div>
                </a>
                <a href="#">
                    <div class="menuButtonsMobile">
                        <button class="categorieButtonMobile">
                            <div class="divImgCategorieButtonMobile"><img src="../../assets/mobileIcons/🦆 icon _list_-1.svg" alt="icone fornecedor"></div>
                            <div class="divNameCategorieButtonMobile"><h2>PEDIDOS</h2></div>
                        </button>
                    </div>
                </a>
                <a href="#">
                    <div class="menuButtonsMobile">
                        <button class="categorieButtonMobile">
                            <div class="divImgCategorieButtonMobile"><img src="../../assets/mobileIcons/🦆 icon _pie chart_-1.svg" alt="icone fornecedor"></div>
                            <div class="divNameCategorieButtonMobile"><h2>RELATÓRIOS</h2></div>
                        </button>
                    </div>
                </a>
                <a href="#">
                    <div class="menuButtonsMobile">
                        <button class="categorieButtonMobile">
                            <div class="divImgCategorieButtonMobile"><img src="../../assets/mobileIcons/🦆 icon _magnifying glass_-1.svg" alt="icone fornecedor"></div>
                            <div class="divNameCategorieButtonMobile"><h2>INSPESSÃO</h2></div>
                        </button>
                    </div>
                </a>
                <a href="#">
                    <div class="menuButtonsMobile">
                        <button class="categorieButtonMobile">
                            <div class="divImgCategorieButtonMobile"><img src="../../assets/mobileIcons/🦆 icon _check_-1.svg" alt="icone fornecedor"></div>
                            <div class="divNameCategorieButtonMobile"><h2>PACKING LIST</h2></div>
                        </button>
                    </div>
                </a>
             

            </div>   

    </div>


   <header>

    <a href="../cadastros.php"><button  id="backButton" class="backButton">
        <img src="../../assets/backArrow.svg" alt="Botão para voltar a página anterior">
    </button>
    </a>

    <button onclick="openMenu()" id="mobileMenuButton" class="mobileMenuButton">
        <img src="../../assets/menu_mobile.svg" alt="Menu mobile da página">
    </button>
    
    <form id="cadastroForm">
        <div class="inputBox">
            <label for="produto">USUÁRIO</label>
            <input placeholder="USUÁRIO" type="text" id="nome" name="nome" required>
        </div>

        <div class="inputBox">
            <label for="senha">SENHA</label>
            <input placeholder="SENHA" type="password" id="senha"  name="senha" required>
           
        </div>

        <div class="inputBox">
            <label for="senha">SENHA</label>
            <input placeholder="REPITA A SENHA" type="password" id="senha1"  name="senha" required>
           
        </div>

        <button type="submit">SALVAR <img src="../../assets/save.svg" alt=""></button> 
    </form>
   
   </header>
   
		<form method="POST" class="inputSearch" id="form-pesquisa" action="">
			<input type="text" name="pesquisa" id="pesquisa" placeholder="Buscar">
			
		</form>
	

      

 
  
   <section id="containerList" class="containerList">
    
    
       
    
 

   
      
   </section> 

  

   <footer>
    <p  id="data-footer">  </p>
   </footer>
</body>

<script src="../../mobileMenu/js/mobileMenu.js"></script>

<script src="../../generalScripts/version.js"></script>

<script src="../../generalScripts/backPage.js"></script>

<script src="cadastro.js"></script>

<script src="listar.js"></script>

<script src="busca.js"></script>




</html>