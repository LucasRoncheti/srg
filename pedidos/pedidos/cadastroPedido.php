<?php
include '../../generalPhp/conection.php';

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['id'])) {
    die(header("Location: ../../index.php"));

}

//variáveis que serão alocadas em outra tabela 
$cliente = "";
$valortotalPedido = 0;

// Receber os dados do JavaScript
$data = json_decode(file_get_contents("php://input"), true);
$itensEnviados = $data['itensEnviados'];

// Separar os dados do dicionário específico
$dadosEspecificos = null;

foreach ($itensEnviados as $key => $item) {
    if (isset($item['cliente']) && isset($item['dataAtual']) && isset($item['valortotalPedido'])) {
        $dadosEspecificos = $item;
        unset($itensEnviados[$key]); // Remover os dados do dicionário específico do array principal
        break;
    }
    
}

// Primeiro loop para inserir os itens principais na tabela pedidos_dados

foreach ($itensEnviados as $item) {
    if (isset($item['chaveAcesso']) || isset($item['produto'])|| isset($item['fornecedor'])) {
        $chaveAcesso = $item['chaveAcesso'];
        $fornecedorNumero = $item['fornecedorNumero'];
        $fornecedor = $item['fornecedor'];
        $produto = $item['produto'];
        $quantidade = $item['quantidade'];
        $valorTotal = $item['valorTotal'];
        $valorUnit = $item['valorUnit'];
        $dataAtual = $dadosEspecificos['dataAtual'];
        $dataRetirada = $item['dataRetirada'];

     

            $sql1 = "INSERT INTO pedidos_dados (chaveAcesso, fornecedor, fornecedorNumero, dataAtual, produto, valor_unit, valor_total, quantidade,data_retirada) VALUES ('$chaveAcesso', '$fornecedor', '$fornecedorNumero', '$dataAtual', '$produto', '$valorUnit', '$valorTotal', '$quantidade','$dataRetirada') ";

            if ($conn->query($sql1) !== TRUE) {
                echo '<div style="padding: 50% 10% 50% 10%; text-align: center; z-index: 999; position: absolute; top: 0; width: 100%; display: flex; flex-direction: column; justify-content: space-evenly; align-items: center; height: 100%; background-color: white;" id="pedidoCadastrado">';
                echo '<div class="teste">';
                echo '<h2> Erro no cadastro : pedidos_dados"" ! </h2>';
                echo '</div>';
                echo '<img style="max-width:200px" src="../../assets/delete.svg" alt="">';
                echo '<button onclick="deleteDiv()" style="min-width: 300px;">VOLTAR</button>';
                echo '</div>';
                echo ' </div>';
                break; // Para o loop se houver erro
            }
        

    } else {
        echo '<p  style="padding:5px;width:100%;height:30px;background-color: #E55933;text-align:center;">Sem dados!</p>';
    }

}

// Inserir os dados do dicionário específico em uma tabela separada
if ($dadosEspecificos) {
    $chaveAcesso = $item['chaveAcesso'];
    $cliente = $dadosEspecificos['cliente'];
    $dataAtual = $dadosEspecificos['dataAtual'];
    $valortotalPedido = $dadosEspecificos['valortotalPedido'];

    $sql2 = "INSERT INTO pedidoscadastro (cliente, dataAtual, valor_total, chaveAcesso) VALUES ('$cliente', '$dataAtual', '$valortotalPedido','$chaveAcesso')";


   if ($conn->query($sql2) === TRUE) {
    echo '<div class="fixed inset-0 z-50 flex flex-col items-center justify-center bg-white dark:bg-gray-900 text-center space-y-6 text-gray-900 dark:text-white">';
    echo '<h2 class="text-2xl font-semibold">Pedido cadastrado com sucesso!</h2>';
    echo '<img class="max-w-[200px]" src="../../assets/check.svg" alt="Sucesso">';
    echo '</div>';
} else {
    echo '<div class="fixed inset-0 z-50 flex flex-col items-center justify-center bg-white dark:bg-gray-900 text-center space-y-6 text-gray-900 dark:text-white">';
    echo '<h2 class="text-2xl font-semibold">Erro no cadastro: pedidos_cadastro!</h2>';
    echo '<img class="max-w-[200px]" src="../../assets/delete.svg" alt="Erro">';
    echo '<button onclick="respostaPhp()" class="min-w-[200px] bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-2 rounded shadow">VOLTAR</button>';
    echo '</div>';
}

}

// Fechar a conexão
$conn->close();
?>