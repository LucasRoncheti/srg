<?php
include '../generalPhp/conection.php';


if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['id'])) {
    die(header("Location: ../index.php"));

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
    <link rel="stylesheet" href="relatorios.css">
    <link rel="stylesheet" href="stylePrint.css">
    <link rel="shortcut icon" href="../assets/favicon.svg" type="image/x-icon">


    <title>Relatórios</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
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
                        <div class="divImgCategorieButtonMobile"><img src="../assets/mobileIcons/icon _home_.svg"
                                alt="icone fornecedor"></div>
                        <div class="divNameCategorieButtonMobile">
                            <h2>INÍCIO</h2>
                        </div>
                    </button>
                </div>
            </a>

            <a href="../cadastros/cadastros.php">
                <div class="menuButtonsMobile">
                    <button class="categorieButtonMobile">
                        <div class="divImgCategorieButtonMobile"><img src="../assets/mobileIcons/icon _book_-1.svg"
                                alt="icone fornecedor"></div>
                        <div class="divNameCategorieButtonMobile">
                            <h2>CADASTROS</h2>
                        </div>
                    </button>
                </div>
            </a>
            <a href="../pedidos/cadastrodepedidos.php">
                <div class="menuButtonsMobile">
                    <button class="categorieButtonMobile">
                        <div class="divImgCategorieButtonMobile"><img src="../assets/mobileIcons/icon _list_-1.svg"
                                alt="icone fornecedor"></div>
                        <div class="divNameCategorieButtonMobile">
                            <h2>PEDIDOS</h2>
                        </div>
                    </button>
                </div>
            </a>
            <a href="relatorios.php">
                <div class="menuButtonsMobile">
                    <button class="categorieButtonMobile">
                        <div class="divImgCategorieButtonMobile"><img
                                src="../assets/mobileIcons/icon _pie chart_-1.svg" alt="icone fornecedor"></div>
                        <div class="divNameCategorieButtonMobile">
                            <h2>RELATÓRIOS</h2>
                        </div>
                    </button>
                </div>
            </a>
            <a href="../inspessao/cadastro.php">
                <div class="menuButtonsMobile">
                    <button class="categorieButtonMobile">
                        <div class="divImgCategorieButtonMobile"><img
                                src="../assets/mobileIcons/icon _magnifying glass_-1.svg" alt="icone fornecedor">
                        </div>
                        <div class="divNameCategorieButtonMobile">
                            <h2>INSPEÇÃO</h2>
                        </div>
                    </button>
                </div>
            </a>
            <a href="../packingList/cadastropackinglist.php">
                <div class="menuButtonsMobile">
                    <button class="categorieButtonMobile">
                        <div class="divImgCategorieButtonMobile"><img src="../assets/mobileIcons/icon _check_-1.svg"
                                alt="icone fornecedor"></div>
                        <div class="divNameCategorieButtonMobile">
                            <h2>PACKING LIST</h2>
                        </div>
                    </button>
                </div>
            </a>


        </div>

    </div>

    <section class="headerPrint" >

        <div class="logoGinger">
            <img src="../assets/logoLogin.png" alt="Logo Reinholz Ginger">
        </div>

        <div class="dadosEmpresa">
            <p id="nomeEmpresa">REINHOLZ GINGER COMERCIO DE RAIZES LTDA</p>
            <p> <img src="../assets/cnpj.svg"> 50.688.819/0001-61</p>
            <p> <img src="../assets/local.svg"> AE ZONA RURAL, S/N GALO-DOMINGOS MARTINS ES- CEP:29260-000</p>
            <p><img src="../assets/email.svg"> reinholzginger0@outlook.com</p>
        </div>

        <!-- <div class="dadosPedidos">
        <div> N&deg; PEDIDO <STRONg> <?php echo $idPedido ?></STRONg></div>
        <div> EMISSÃO: <strong><?php echo date('d/m/y',strtotime($dataAtual)) ?></strong></div>
        </div> -->


    </section>
    <div id="relatoriosH3">RELATÓRIOS</div>
    <header>

        <a href="../main.php"><button id="backButton" class="backButton">
                <img src="../assets/backArrow.svg" alt="Botão para voltar a página anterior">
            </button>
        </a>

        <button onclick="openMenu()" id="mobileMenuButton" class="mobileMenuButton">
            <img src="../assets/menu_mobile.svg" alt="Menu mobile da página">
        </button>
       
        <form id="cadastroForm">
            <img class="imgCategoria" style="width:40px" src="../assets/categories/relatorios.svg" alt="">
    
            <h2  id="relatoriosH2" >RELATÓRIOS</h2>
            
            
            <div class="inputSearch">
                <input id="pesquisaFornecedor" class="inputSearchHeader-input" type="text" name="pesquisaFornecedor"
                    placeholder="FORNECEDOR">

                <select placeholder="FORNECEDOR" name="fornecedor" id="fornecedor">
                    <option value=""></option>
                </select>
            </div>


            <div class="inputSearchData">
                <div class="inputDate">
                    <p>Data Incial</p>
                    <input id="dataInicial" type="date">
                </div>

                <div class="inputDate">
                    <p>Data Final</p>
                    <input id="dataFinal" type="date">
                </div>
            </div>

            <a href="#">
                <div id="filtrarButton" class="buttonAction"> FILTRAR <img src="../assets/filtrar.svg" alt=""></div>
            </a>
        </form>

    </header>


    <div class="cabecalhoFiltro">
        <div>Quantidade <br> de pedidos</div>
        <div>Total Caixas</div>
        <div> Valor total <br> unificado</div>
    </div>


    <div class="cabeçalhoValores">
        <div id="quantidadePedidos">0</div>
        <div id="totalCaixas">0</div>
        <div id="ValorUnificado"> R$ 0,00</div>
    </div>

    <div class="cabeçalhoItens">
        <div> N° P</div>
        <div>DATA</div>
        <div> CLIENTE</div>
        <div>QNT</div>
        <div id="printT" onclick="imprimirRelatorios()"> <img style="height: 70%;" src="../assets/print.svg" alt=""></div>
    </div>





    <section id="containerList" class="containerList">

















    </section>



    <footer>
        <p id="data-footer"> </p>
    </footer>
</body>

<script src="../mobileMenu/js/mobileMenu.js"></script>

<script src="../generalScripts/version.js"></script>

<script src="../generalScripts/backPage.js"></script>

<script src="buscaFornecedor.js"></script>

<script src="filtrarPedidos.js"></script>

<script src="mostrarInfo.js"></script>


<!-- script para definir as datas iniciais nos campos de input da busca -->
<script>


    var today = new Date();
    var day = today.getDate();
    var month = today.getMonth() + 1; // Os meses começam em 0 (janeiro), então somamos 1.
    var year = today.getFullYear();

    if (day < 10) {
        day = "0" + day;
    }

    if (month < 10) {
        month = "0" + month;
    }

    var formattedDate = year + "-" + month + "-" + day;


    document.getElementById("dataInicial").value = formattedDate
    document.getElementById("dataFinal").value = formattedDate
</script>

<script src="../generalScripts/print.js"></script>



<script>
//   imprimirPagina()
</script>


</html>