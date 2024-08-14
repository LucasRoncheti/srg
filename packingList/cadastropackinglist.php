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
    <link rel="stylesheet" href="../pedidos/cadastro.css">
    <link rel="stylesheet" href="packingListCabecalho.css">
    <link rel="shortcut icon" href="../assets/favicon.svg" type="image/x-icon">


    <title>Packing List</title>

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
            <a href="../relatorios/relatorios.php">
                <div class="menuButtonsMobile">
                    <button class="categorieButtonMobile">
                        <div class="divImgCategorieButtonMobile"><img src="../assets/mobileIcons/icon _pie chart_-1.svg"
                                alt="icone fornecedor"></div>
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
            <a href="cadastropackinglist.php">
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


    <header>

        <a href="../main.php"><button id="backButton" class="backButton">
                <img style="width: 30px;" src="../assets/backArrow.svg" alt="Botão para voltar a página anterior">
            </button>
        </a>

        <button onclick="openMenu()" id="mobileMenuButton" class="mobileMenuButton">
            <img style="width: 34px;" src="../assets/menu_mobile.svg" alt="Menu mobile da página">
        </button>

        <form id="cadastroForm">



            <h2 style="color:white;font-size: 1.6em;margin-bottom: 10px;">PACKING LIST</h2>
        </form>

        <form class="formCadastroPackingList" action="">
            <p class="nomePackingListMobile">Packing List</p>
            <input name="nome" placeholder="Nome" type="text">
            <input name="numero_container" placeholder="N° Container" type="number">
            <input name="data_PackingList" type="date">
            <button type="button" onclick="salvarPackingList()">Salvar</button>
        </form>


    </header>



    <!-- campo para busca dos pedidos  -->
    <form method="POST" class="inputSearch" id="form-pesquisa" action="">
        <input type="text" name="pesquisa" id="pesquisa" placeholder="Buscar">
    </form>

    <div id="divEditarPackingList" style="display:none;" class="divEditarPackingList">
        <h4>Editar Packing List</h4>
        <form class="formEditarPackingList" action="">

            <p>Nome</p>
            <input id="editarNome" name="nome" placeholder="Nome" type="text">
            <p>Numero Container</p>
            <input id="editarNumero_container" name="numero_container" placeholder="N° Container" type="number">
            <p>Data</p>
            <input id="editarData" name="data_PackingList" type="date">
            <button type="button" onclick="salvarEdicaoPackingList()">Salvar</button>
            <button style="background-color:red;" type="button" onclick="fecharDivEdicao()">Cancelar</button>

        </form>
    </div>

    <section id="containerList" class="containerList">

        <?php


        // Paginação
        $pagina = filter_input(INPUT_POST, 'pagina', FILTER_SANITIZE_NUMBER_INT) ?: 1;
        $qnt_result_pg = filter_input(INPUT_POST, 'qnt_result_pg', FILTER_SANITIZE_NUMBER_INT) ?: 10;
        $inicio = ($pagina - 1) * $qnt_result_pg;

        // Consultar no banco de dados
        $sql = "SELECT * FROM listpack ORDER BY id DESC LIMIT ?, ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $inicio, $qnt_result_pg);
        $stmt->execute();
        $resultado_sql = $stmt->get_result();

        // Verificar se encontrou resultado na tabela "listpack"
        if ($resultado_sql && $resultado_sql->num_rows > 0) {
            ob_start(); // Inicia o buffer de saída
        
            while ($row_sql = $resultado_sql->fetch_assoc()) {
                $dataFormatada = date('d/m/Y', strtotime($row_sql['data_packingList']));
                echo '
        <div class="containerDadosPedidos">
            <div class="numberDate">
                <div style="font-size:0.7em;" class="numeroPedido">N° Cont. ' . htmlspecialchars($row_sql['numero_container']) . ' </div>
                <div class="dataPedido">Data ' . htmlspecialchars($dataFormatada) . '</div>
            </div>
            <div class="dadosPedidos">
                <div class="nomeClientePedido">' . htmlspecialchars($row_sql['nome']) . '</div>
            </div>
            <div class="apagarImprimir">
                <a href="../packingList/editar/editar.php?id=' . urlencode($row_sql['id']) . '&numero=' . urlencode($row_sql['id']) . '&cliente=' . urlencode($row_sql['nome']) . '&numero_container=' . urlencode($row_sql['numero_container']) . '"><img src="../assets/file_green.svg"></a>
                <img style="cursor:pointer;" onclick="deletarPackingList(' . (int) $row_sql['id'] . ')" src="../assets/erase.svg">
                <img style="cursor:pointer;" onclick="editarPackingList(' . (int) $row_sql['id'] . ',\'' . addslashes($row_sql['nome']) . '\',' . (int) $row_sql['numero_container'] . ',\'' . addslashes($row_sql['data_packingList']) . '\')" src="../assets/edit.svg">
            </div>
        </div>';
            }

            // Paginação - Somar a quantidade de registros
            $sql_pg = "SELECT COUNT(id) AS num_result FROM listpack";
            $result_pg = $conn->query($sql_pg);
            $row_pg = $result_pg->fetch_assoc();
            $quantidade_pg = ceil($row_pg['num_result'] / $qnt_result_pg);

            // Limitar os links antes e depois
            $max_links = 2;
            echo "<div class='divPagina'>";
            echo "<a href='#' onclick='listar(1, $qnt_result_pg)'>&lt;PRIMEIRA</a> ";

            for ($pag_ant = max(1, $pagina - $max_links); $pag_ant < $pagina; $pag_ant++) {
                echo " <a href='#' onclick='listar($pag_ant, $qnt_result_pg)'>$pag_ant </a> ";
            }

            echo " $pagina ";

            for ($pag_dep = $pagina + 1; $pag_dep <= min($pagina + $max_links, $quantidade_pg); $pag_dep++) {
                echo " <a href='#' onclick='listar($pag_dep, $qnt_result_pg)'>$pag_dep</a> ";
            }

            echo " <a href='#' onclick='listar($quantidade_pg, $qnt_result_pg)'>ÚLTIMA></a>";
            echo '</div>';

            ob_end_flush(); // Libera o conteúdo do buffer de saída
        
        } else {
            echo '
    <div class="notFound">
        <img class="notFoundImg" src="../assets/notFound.svg" alt="">
        <h3>NENHUM PEDIDO SALVO</h3>
    </div>';
        }
        ?>






    </section>



    <footer>
        <p id="data-footer"> </p>
    </footer>
</body>

<script src="../mobileMenu/js/mobileMenu.js"></script>

<script src="../generalScripts/version.js"></script>

<script src="../generalScripts/backPage.js"></script>



<script src="listar.js"></script>

<script src="../pedidos/busca.js"></script>




</html>