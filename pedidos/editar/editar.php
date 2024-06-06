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
    $sql = "SELECT * FROM pedidos_dados WHERE chaveAcesso = '$id'";
    $result = mysqli_query($conn, $sql);

    $sql1 = "SELECT * FROM pedidoscadastro WHERE chaveAcesso ='$id'";
    $resultSql1 = mysqli_query($conn,$sql1);

    if($resultSql1 && $resultSql1->num_rows !=0){
        while($row = mysqli_fetch_assoc($resultSql1)){
            $valorTotalSalvoPedido = $row['valor_total'];
            $dataAtual = $row['dataAtual'];
        }
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
    <link rel="stylesheet" href="../pedidos/cadastro.css">

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
            <img style="width:35px" src="../../assets/x.svg" alt="Menu mobile da p�gina">
        </button>
            <div class="mobileMenuButtons">
                <a href="../../main.php">
                    <div class="menuButtonsMobile">
                        <button class="categorieButtonMobile">
                            <div class="divImgCategorieButtonMobile"><img style="width:20px" src="../../assets/mobileIcons/icon _home_.svg" alt="icone fornecedor"></div>
                            <div class="divNameCategorieButtonMobile"><h2>INÍCIO</h2></div>
                        </button>
                    </div>
                </a>

                <a href="../../cadastros/cadastros.php">
                    <div class="menuButtonsMobile">
                        <button class="categorieButtonMobile">
                            <div class="divImgCategorieButtonMobile"><img  style="width:20px" src="../../assets/mobileIcons/icon _book_-1.svg" alt="icone fornecedor"></div>
                            <div class="divNameCategorieButtonMobile"><h2>CADASTROS</h2></div>
                        </button>
                    </div>
                </a>
                <a href="../../pedidos/cadastrodepedidos.php">
                    <div class="menuButtonsMobile">
                        <button class="categorieButtonMobile">
                            <div class="divImgCategorieButtonMobile"><img  style="width:20px" src="../../assets/mobileIcons/icon _list_-1.svg" alt="icone fornecedor"></div>
                            <div class="divNameCategorieButtonMobile"><h2>PEDIDOS</h2></div>
                        </button>
                    </div>
                </a>
                <a href="../../relatorios/relatorios.php">
                    <div class="menuButtonsMobile">
                        <button class="categorieButtonMobile">
                            <div class="divImgCategorieButtonMobile"><img  style="width:20px" src="../../assets/mobileIcons/icon _pie chart_-1.svg" alt="icone fornecedor"></div>
                            <div class="divNameCategorieButtonMobile"><h2>RELAT�RIOS</h2></div>
                        </button>
                    </div>
                </a>
                <a href="../../inspessao/cadastro.php">
                    <div class="menuButtonsMobile">
                        <button class="categorieButtonMobile">
                            <div class="divImgCategorieButtonMobile"><img  style="width:20px" src="../../assets/mobileIcons/icon _magnifying glass_-1.svg" alt="icone fornecedor"></div>
                            <div class="divNameCategorieButtonMobile"><h2>INSPE��O</h2></div>
                        </button>
                    </div>
                </a>
                <a href="../../packingList/cadastropackinglist.php">
                    <div class="menuButtonsMobile">
                        <button class="categorieButtonMobile">
                            <div class="divImgCategorieButtonMobile"><img  style="width:20px" src="../../assets/mobileIcons/icon _check_-1.svg" alt="icone fornecedor"></div>
                            <div class="divNameCategorieButtonMobile"><h2>PACKING LIST</h2></div>
                        </button>
                    </div>
                </a>
             

            </div>   

    </div>

    <div id="respostaPHP">
        
    </div>

    <header>

       <button onclick="avisoSalvar()" id="backButton" class="backButton">
                <img style='width:25px' src="../../assets/backArrow.svg" alt="Bot�o para voltar a p�gina anterior">
            </button>
    

        <button onclick="openMenu(),avisoSalvar2()" id="mobileMenuButton" class="mobileMenuButton">
            <img src="../../assets/menu_mobile.svg" alt="Menu mobile da p�gina">
        </button>

        <div style="display:none;">
            <input  id="dataAtual" class="dataPedido" type="date">
        </div> 



        <form method="POST" class="inputSearchHeader" id="form-pesquisa2" action="">
            <input id="pesquisaFornecedor" class="inputSearchHeader-input" type="text" name="pesquisaFornecedor"
                placeholder="FORNECEDOR">
            <select placeholder="FORNECEDOR" name="fornecedor" id="fornecedor">
                <option value=""></option>
            </select>
        </form>

        <input id="DataAtual" type="hidden" value=" <?php echo $dataAtual ?> ">

        <form method="POST" class="inputSearchHeader" id="form-pesquisa3" action="">
            <input id="pesquisaProduto" class="inputSearchHeader-input" type="text" name="pesquisaproduto"
                placeholder="PRODUTO">
            <select onchange="calcularMudan�aSelect()" placeholder="PRODUTO" name="produto" id="produto">
                <option value=""></option>
            </select>

        </form>

        <div class="quantidadeContainer">
            <div class="valoresContainer">
                <div class="valores">
                    <div class="valorUnit">Unit.</div>
                    <div id="valorUnit" class="valorUnit">R$ 0,00</div>
                </div>
                <div class="valores">
                    <div class="valorTotal"> Total</div>
                    <div id="valorTotal" class="valorTotal">R$ 0,00</div>
                </div>
            </div>

            <div class="aumentaQuantidade">
                <div onclick="subtrairValor()" class="botaoQuantidadeMenos">-</div>
                <input id="quantidade" class="quantidade" value="1" type="number">
                <div></div>
                <div onclick="aumentarValor()" class="botaoQuantidadeMais">+</div>
            </div>
        </div>

        <button onclick="listar()"><img style="height: 30px;" src="../../assets/arowDown.svg"
                alt="Arrow Down ">ADIOCIONAR <img style="height: 30px;" src="../../assets/arowDown.svg"
                alt="Arrow Down "></button>



      




    </header>

    
    
    <!-- cabecalho da lista de produtos -->
    <div class="cabecalhoProdutos">
        <div id="fornecedorCabe�alho" class="fornecedor">FORNECEDOR</div>
        <div class="quantidades">
            <div id="qnt">QNT</div>
            <div id="vlr">VLR T.</div>
            <div id="verMais"> MAIS</div>
        </div>

    </div>


    <form  style="height:auto;" id="containerList" class="containerList">
            <!-- aqui entra a lista dos intens no pedido -->
    </form>
   

    
    <div class="containerList">
       
    
    <?php




            if ($result && $result->num_rows != 0) {

                $somaQuantidadeTotal = 0;

                while ($row = mysqli_fetch_assoc($result)) {
                    $fornecedor = $row['fornecedor'];
                    $quantidade = $row['quantidade'];
                    $valor_unit = $row['valor_unit'];
                    $valor_total = $row['valor_total'];
                    $produto = $row['produto'];
                    $idItem = $row['id'];
                    $chaveAcesso = $row['chaveAcesso'];


                    $somaQuantidadeTotal += $quantidade;
                    ?>

                    <input id="chaveAcesso" type="hidden" value="<?=$chaveAcesso?>">
                    <div id="<?=$idItem?>" class="containerProdutoPedido">
                    <div class="dadosPedido">
                        <div id="fornecedorNome" class="fornecedor"><?=$fornecedor?></div>
                        <div class="quantidades2">
                            <input style="width:50px;height:20px;background-color:transparent;" type="number" onchange="editarQuantidade('<?=$chaveAcesso?>','<?=$idItem?>',this,'<?=$valor_unit?>','<?=$valor_total?>','<?=$valorTotalSalvoPedido?>')" value="<?=$quantidade?>" class="quantidadeEditar" id="qnt">
                            <div id="vlr"> R$ <?=number_format($valor_total / 100, 2, ",", ".")?></div>
                            <div onclick="trocarDisplay('info<?=$idItem?>', 'img<?=$idItem?>')" id="verMais">
                                <img id="img<?=$idItem?>" src="../../assets/eye.svg" alt="Olho vetor">
                            </div>
                        </div>
                    </div>
                    <div style="display: none;" id="info<?=$idItem?>" class="dadosPedidoSecundario">
                        <div id="produtoLista" class="produtoLista"><?=$produto?></div>
                        <div class="quantidades3">
                            <div id="vlr">Unit R$ <?=number_format($valor_unit / 100, 2, ",", ".")?></div>
                            <a href="apagar.php?id=<?=$idItem?>&valorPedidoSalvo=<?=$valorTotalSalvoPedido?>&valorTotal=<?=$valor_total?>&chaveAcesso=<?=$chaveAcesso?>">
                                <div id="verMais<?=$idItem?>">
                                    <img src="../../assets/erase.svg" alt="Olho vetor">
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <?php
                }
            } else {
                echo 'Registro n�o encontrado!';
            }
            } else {
            echo 'ID n�o fornecido na URL!';
            }
    ?>
     
    </div>


<button onclick="enviarDados()" id="salvarPedido" class="salvarPedido" > <img src="../../assets/save.svg" alt=""></button>

<div id="containerValoresFinais"   class="containerValoresFinais">
    <div id="containerInternoValoresFinais"  class="containerInternoValoresFinais">
        <div id="" class="headValores">
            <p>N&deg; CAIXAS</p>
            <p id="Ncaixas"><?php echo $somaQuantidadeTotal?></p>
        </div>
        <div id="" class="headValores">
            <p>CX. REST.</p>
            <div class="CxDiv">
                <p id="CxRest">0</p> de
                <input id="inputCxRest" type="number">
            </div>
        </div>
        <div id="" class="headValores">
            <p>VALOR TOTAL</p>
            <p id="valorTotalPedido">R$ <?php echo number_format($valorTotalSalvoPedido / 100, 2, ",", "."); ?></p>

        </div>
    </div>
</div>



<footer>
    <p id="data-footer"> </p>
</footer>
</body>

<script src="../../mobileMenu/js/mobileMenu.js"></script>

<script src="../../generalScripts/version.js"></script>

<script src="../../generalScripts/backPage.js"></script>



<script src="../pedidos/buscaCliente.js"></script>

<script src="../pedidos/pedidos.js"></script>

<script src="../pedidos/buscaFornecedor.js"></script>

<script src="../pedidos/buscaProduto.js"></script>

<script src="../../generalScripts/atualDate.js"></script>

<script src="../pedidos/aumentarQuantidade.js"></script>

<script src="../pedidos/mostrarInfo.js"></script>
<!-- 
lista o produto adicionado na lista do pedido -->
<script src="listarProdutos.js"></script>
<script src="cadastro.js"></script>
<script src="../../generalScripts/deleteDiv.js"></script>

<script src="validarBotaoSalvar.js"></script>

<script src="avisoSalvar.js"></script>



</html>



