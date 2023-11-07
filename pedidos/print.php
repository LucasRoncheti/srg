<?php
include '../generalPhp/conection.php';
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['id'])) {
    die(header("Location: ../../index.php"));

}

// Check if 'id' parameter is provided in the URL
if (isset($_GET['id'])) {
    // Retrieve the 'id' value from the URL
    $id = $_GET['id'];

    // Create a SQL query to fetch the data for the specified 'id'
    $sql = "SELECT * FROM pedidos_dados WHERE chaveAcesso = '$id'";
    $result = mysqli_query($conn, $sql);

    $sql1 = "SELECT * FROM pedidoscadastro WHERE chaveAcesso ='$id'";
    $resultSql1 = mysqli_query($conn, $sql1);

    if ($resultSql1 && $resultSql1->num_rows != 0) {
        while ($row = mysqli_fetch_assoc($resultSql1)) {
            $valorTotalSalvoPedido = $row['valor_total'];
            $dataAtual = $row['dataAtual'];
            $idPedido = $row['id'];
        

        }
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
        <link rel="stylesheet" href="../pedidos/print.css">

        <link rel="shortcut icon" href="../assets/favicon.svg" type="image/x-icon">
        <title>Imprimir pedido</title>

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


    <body id="body" onload="onLoad()">


        <header>

            <div class="logoGinger">
                <img src="../assets/logoLogin.png" alt="">
            </div>

            <div class="dadosEmpresa">
                <p>REINHOLZ GINGER </p>
                <p></p>
            </div>
            
            <div class="dadosPedidos">
            <div><?php echo $idPedido ?></div>
            <div><?php echo $dataAtual ?></div>
            </div>
      

            

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


        <div class="containerList">

            <?php

            // Check if the query was successful and data was found
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



                }
            } else {
                echo 'Registro n�o encontrado!';
            }
} else {
    echo 'ID n�o fornecido na URL!';
}
?>

    </div>
    <div id="containerValoresFinais" class="containerValoresFinais">
        <div id="containerInternoValoresFinais" class="containerInternoValoresFinais">
            <div id="" class="headValores">
                <p>N&deg; CAIXAS</p>
                <p id="Ncaixas">
                    <?php echo $somaQuantidadeTotal ?>
                </p>
            </div>

            <div id="" class="headValores">
                <p>VALOR TOTAL</p>
                <p id="valorTotalPedido">R$
                    <?php echo number_format($valorTotalSalvoPedido / 100, 2, ",", "."); ?>
                </p>

            </div>
        </div>
    </div>



    <footer>
        <p id="data-footer"> </p>
    </footer>
</body>

<script src="../mobileMenu/js/mobileMenu.js"></script>

<script src="../generalScripts/version.js"></script>

<script src="../generalScripts/backPage.js"></script>



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