<?php
include '../generalPhp/conection.php';
if(!isset($_SESSION)) {
    session_start();
}

if(!isset($_SESSION['id'])) {
    die( header("Location: ../index.php"));
   
}
// Receba os dados da solicitação AJAX
$data = json_decode(file_get_contents('php://input'), true);

$dataInicial = $data['dataInicial'];
$dataFinal = $data['dataFinal'];
$fornecedor = $data['fornecedor'];

// Consulte o banco de dados para obter resultados entre as datas e com o nome fornecedor
$query = "SELECT * FROM pedidos_dados WHERE dataAtual BETWEEN ? AND ? AND fornecedor = ?";
$stmt = mysqli_stmt_init($conn);

if (mysqli_stmt_prepare($stmt, $query)) {
    mysqli_stmt_bind_param($stmt, "sss", $dataInicial, $dataFinal, $fornecedor);
    mysqli_stmt_execute($stmt);
    $resultado_sql = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($resultado_sql) <= 0) {
        echo '
			<div class="notFound">
				<img  class="notFoundImg" src="../assets/notFound.svg" alt="">
				<h3 style="text-align:center;">NÃO HÁ REGISTROS ENTRE AS DATAS SELECIONADAS</h3>
			</div>
		
		';
    } else {
        $clientes = array();
      
        while ($row_sql = mysqli_fetch_assoc($resultado_sql)) {
            $chaveAcesso = $row_sql['chaveAcesso'];

            // Consulta para obter o nome do cliente
            $clienteQuery = "SELECT * FROM pedidoscadastro WHERE chaveAcesso = ?";
            $stmtCliente = mysqli_stmt_init($conn);

            if (mysqli_stmt_prepare($stmtCliente, $clienteQuery)) {
                mysqli_stmt_bind_param($stmtCliente, "s", $chaveAcesso);
                mysqli_stmt_execute($stmtCliente);
                $resultadoCliente = mysqli_stmt_get_result($stmtCliente);

                if ($rowCliente = mysqli_fetch_assoc($resultadoCliente)) {
                    $cliente = $rowCliente['cliente'];
                    $id = $rowCliente['id'];
                    $data = $rowCliente['dataAtual'];
                } else {
                    $cliente = "Nome do cliente não encontrado"; // mensagem de erro
                    $id = "ID não encontrado";
                    $data = "Data não encontrada";
                }

                // Verifique se o cliente já foi adicionado ao array de clientes
                if (!isset($clientes[$chaveAcesso])) {
                    $clientes[$chaveAcesso] = array(
                        'cliente' => $cliente,
                        'id' => $id,
                        'dataAtual' => $data,
                        'itens' => array()
                    );
                }

                // Adicione os itens ao array de itens
                $clientes[$chaveAcesso]['itens'][] = array(
                    'id' => $row_sql['id'],
                    'produto' => $row_sql['produto'],
                    'quantidade' => $row_sql['quantidade'],
                    'valorUnit' => $row_sql['valor_unit'],
                    'valorTotal' => $row_sql['valor_total'],
                    'dataRetirada' => $row_sql['data_retirada'],
                );
            }
        
        }
         //variável que contém a quandidade somada de caixas 
        $somaQuantidadeTotalCaixas = 0;
          //variável que contém o valor total das caixas 
        $valorTotalUnificado = 0;
        // Iterar pelos clientes e exibir os resultados agrupados
        foreach ($clientes as $chaveAcesso => $clienteData) {
           
            $quantidadeTotal=0;
            $valorTotalSomado = 0;
            foreach($clienteData['itens'] as $soma) {
                $quantidadeTotal += $soma['quantidade'];
                $valorTotalSomado+= $soma['valorTotal'];

            }
            $somaQuantidadeTotalCaixas += $quantidadeTotal;
            $valorTotalUnificado+=$valorTotalSomado;

           
            echo '<div class="containerItensFiltro">';
            echo '<div class="cabeçalhoListaFiltro">';
            echo '<div>' . $clienteData['id'] . '</div>';
            echo '<div style="font-size: 0.8em;"> ' . date('d/m/Y', strtotime($clienteData['dataAtual'])) . '</div>';
            echo '<div style="font-size: 0.8em;"> ' . date('d/m/Y', strtotime($clienteData['itens'][0]['dataRetirada'])) . '</div>';

            echo '<div>' . $quantidadeTotal . '</div>'; // Exibir a quantidade total
            echo '<div id="mostrarInfos" onclick="trocarDisplay('.$clienteData['id'].')"> <img src="../assets/fullscreen.svg" alt=""></div>';
            echo '</div>';

            echo '<div style="display: none;" id="'.$clienteData['id'].'" class="containerDiscItens">';

          
            
            
            foreach ($clienteData['itens'] as $item) {
                echo    '<div id="' . $chaveAcesso . '" class="discItens">';
                echo     '  <div class="divDiscItens">' . $item['produto'] . '</div>';
                echo       ' <div class="divDiscItens">Qnt. ' . $item['quantidade'] . '</div>';
                echo        '<div class="divDiscItensValor">';
                echo            '<div>Valor Unit: R$ ' . number_format($item['valorUnit'] / 100, 2, ',', ',')  . '</div>';
                echo           ' <div>Valor Total: R$ ' . number_format($item['valorTotal'] / 100, 2, ',', ',')  . '</div>';
                echo       ' </div>';
                echo  '  </div>';
                
            }

            echo  '</div>';
            echo '</div>';
        }
        // soma a quantidade de clientes listados 
        $numeroClientesListados =  count($clientes);
        echo'  <input class="inputHidden" id="nPedidos" type="hidden" value="'.$numeroClientesListados.'">';
        echo'  <input class="inputHidden" id="somaQuantidade" type="hidden" value="'.$somaQuantidadeTotalCaixas.'">';
        echo'  <input class="inputHidden" id="valorTotalUnif" type="hidden" value="R$ '.number_format($valorTotalUnificado /100,2,',','.').'">';
        
    }
   
} else {
    echo "Erro na preparação da consulta.";
}

// Feche a conexão com o banco de dados
$conn->close();
?>


