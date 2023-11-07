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
            $cliente = $row['cliente'];
            $dataDoPedido = $row['dataAtual'];
            $idPedido = $row['id'];
        }
    }

    // converte a data para formato brasil 
    $dataOriginal = $dataDoPedido; // Data no formato "aaaa-mm-dd"

    // Converter a data para um objeto DateTime
    $dataConvertida = date_create_from_format('Y-m-d', $dataOriginal);
    
    if ($dataConvertida !== false) {
        // Formatar a data no formato desejado (dd/mm/aa)
        $dataFormatada = date_format($dataConvertida, 'd/m/y');
        
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
    <link rel="stylesheet" href="cadastro.css">
    <link rel="shortcut icon" href="../../assets/favicon.svg" type="image/x-icon">
    <title>Packing List</title>

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
    <div id="respostaPHP">
        
    </div>

    <header>

        <a href="../cadastropackinglist.php"><button id="backButton" class="backButton">
                <img src="../../assets/backArrow.svg" alt="Botão para voltar a página anterior">
            </button>
        </a>

        <button onclick="openMenu()" id="mobileMenuButton" class="mobileMenuButton">
            <img src="../../assets/menu_mobile.svg" alt="Menu mobile da página">
        </button>

        <div class="cabeçalhoNome" >
                <img src="../../assets/categories/packing_list.svg" alt=""> <p> Nº <?php echo $idPedido ?></p> <p class="nomeCliente"><?php echo strtoupper($cliente);?> </p> <p><?php echo $dataFormatada ;?></p>
        </div> 



        <form method="POST" class="inputSearchHeader" id="form-pesquisa2" action="">
            <h2 style="color:white;">FORNECEDOR</h2>
            <input id="chaveAcesso" type="hidden" value= "<?php echo $id;?>">
            <select placeholder="FORNECEDOR" name="fornecedor" id="fornecedor">

                <?php
                $stmt = $conn->prepare("SELECT fornecedor FROM pedidos_dados WHERE chaveAcesso = ?");
                $stmt->bind_param("s",$id);
                $stmt->execute();
                $result = $stmt->get_result();

                if(($result) AND ($result->num_rows!=0)){
                    while($row = mysqli_fetch_assoc($result)){
                        $fornecedor = $row['fornecedor'];
                       echo' <option value="'.$fornecedor.'">'.strtoupper($fornecedor).'</option>';
                    }
                }
               
            }
            ?>

            </select>
        </form>

       <div  class="paletContainer">
            <div>
                <input id="palet" placeholder="PALET" type="number" require>
            </div>
            <div>
                <input id="quantidade" placeholder=" QUANTIDADE" type="number" require>
            </div>
       </div>

      

        <button onclick="enviarDados()"><img style="height: 30px;" src="../../assets/arowDown.svg"
                alt="Arrow Down ">ADICIONAR <img style="height: 30px;" src="../../assets/arowDown.svg"
                alt="Arrow Down "></button>



      




    </header>

    
    
    <!-- cabeçalho da lista de produtos -->
    <div class="cabeçalhoProdutos">
        <div id="plt">PLT</div>
        <div id="fornecedorCabeçalho" class="fornecedor">FORNECEDOR</div>
        <div id="quantidadeC"> QNT</div>
        <div id="vazioDiv"></div>
    </div>


    <div  id="containerList" class="containerList">
            <!-- aqui entra a lista dos intens no pedido -->
    </div>
   





<div id="containerValoresFinais"   class="containerValoresFinais">
    <div id="containerInternoValoresFinais"  class="containerInternoValoresFinais">
        <div id="" class="headValores">
            <p>N° TOTAL DE  CAIXAS</p>
            <p id="Ncaixas"></p>
        </div>
        <span class="barraMeio"></span>
        <div id="" class="headValores">
            <p>CAIXAS RESTANTES</p>
            <div class="CxDiv">
                <p id="CxRest">0</p> de
                <input onchange="Listar()" id="inputCxRest" type="number">
            </div>
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











<!-- 
lista o produto adicionado na lista do pedido -->
<script src="cadastro.js"></script>
<script src="apagar.js"></script>
<script src="listarProdutos.js"></script>










</html>



