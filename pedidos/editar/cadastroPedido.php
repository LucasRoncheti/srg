<?php
include '../../generalPhp/conection.php';
if(!isset($_SESSION)) {
    session_start();
}

if(!isset($_SESSION['id'])) {
    die( header("Location: ../../index.php"));
   
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
    if (isset($item['valortotalPedido'])) {
        $dadosEspecificos = $item;
        unset($itensEnviados[$key]); // Remover os dados do dicionário específico do array principal
        break;
    }
}

// Primeiro loop para inserir os itens principais na tabela pedidos_dados
foreach ($itensEnviados as $item) {
    
    if (isset($item['chaveAcesso']) || isset($item['produto'])|| isset($item['fornecedor'])) {
        $chaveAcesso = $item['chaveAcesso'];
        $fornecedor = $item['fornecedor'];
        $produto = $item['produto'];
        $quantidade = $item['quantidade'];
        $valorTotal = $item['valorTotal'];
        $valorUnit = $item['valorUnit'];
        $dataAtual = $item['dataAtual'];
        $fornecedorNumero = $item['fornecedorNumero'];
        var_dump($fornecedorNumero);

        


        $sql1 = "INSERT INTO pedidos_dados (chaveAcesso, fornecedor, fornecedorNumero, dataAtual, produto, valor_unit, valor_total, quantidade) VALUES ('$chaveAcesso', '$fornecedor', '$fornecedorNumero', '$dataAtual', '$produto', '$valorUnit', '$valorTotal', '$quantidade') ";

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
    
    $valortotalPedido = $dadosEspecificos['valortotalPedido'];

    $sql2 = "UPDATE pedidoscadastro SET valor_total='$valortotalPedido' WHERE chaveAcesso ='$chaveAcesso' ";


    if($conn->query($sql2)=== TRUE){
        echo '<div style="padding: 50% 10% 50% 10%; text-align: center; z-index: 999; position: absolute; top: 0; width: 100%; display: flex; flex-direction: column; justify-content: space-evenly; align-items: center; height: 100%; background-color: white;" class="pedidoCadastrado">';
        echo '<div class="teste">';
        echo '<h2> Pedido cadastrado com sucesso! </h2>';
        echo '</div>';
        echo '<img style="max-width:200px" src="../../assets/check.svg" alt="">';
        echo '</div>';
        echo ' </div>';
        
        
   
    }
    else {
        echo '<div style="padding: 50% 10% 50% 10%; text-align: center; z-index: 999; position: absolute; top: 0; width: 100%; display: flex; flex-direction: column; justify-content: space-evenly; align-items: center; height: 100%; background-color: white;" id="pedidoCadastrado">';
        echo '<div class="teste">';
        echo '<h2> Erro no cadastro : pedidos_cadastro"' . $conn->error . '" ! </h2>';
        echo '</div>';
        echo '<img style="max-width:200px" src="../../assets/delete.svg" alt="">';
        echo '<button onclick="(window.location.reload())" style="min-width: 300px;">VOLTAR</button>';
        echo '</div>';
        echo ' </div>'; 
    }
}

// Fechar a conexão
$conn->close();
?>
