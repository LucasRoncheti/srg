<?php
include '../generalPhp/conection.php';

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
        echo "NÃO HÁ REGISTROS ENTRE ESSAS DATAS";
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

                // Adicione os itens ao cliente como uma matriz associativa
                $clienteData = &$clientes[$chaveAcesso]; // Referência para o cliente
                $clienteData['itens'][] = array(
                    'id' => $row_sql['id'],
                    'produto' => $row_sql['produto']
                );
            }
        }

        // Iterar pelos clientes e exibir os resultados agrupados
        foreach ($clientes as $chaveAcesso => $clienteData) {
            echo '<div class="containerItensFiltro">';
            echo '<div class="cabeçalhoListaFiltro">';
            echo '<div>' . $clienteData['id'] . '</div>';
            echo '<div>' . date('d/m/Y', strtotime($clienteData['dataAtual'])) . '</div>';
            echo '<div>' . $clienteData['cliente'] . '</div>';
            echo '<div>70</div>';
            echo '<div><img src="../assets/fullscreen.svg" alt=""></div>';
            echo '</div>';

           echo '<div class="containerDiscItens">';
            
        
            foreach ($clienteData['itens'] as $item) {
                
                echo    '<div id="' . $chaveAcesso . '" class="discItens">';
                echo     '  <div class="divDiscItens">' . $item['produto'] . '</div>';
                echo       ' <div class="divDiscItens"> QNT:35</div>';
                echo        '<div class="divDiscItensValor">';
                echo            '<div>Valor Unit: R$ 100,00</div>';
                echo           ' <div>Valor Total: R$ 3.500,00</div>';
                echo       ' </div>';
                echo  '  </div>';
            }
          echo  '</div>';
        }
    }
} else {
    echo "Erro na preparação da consulta.";
}

// Feche a conexão com o banco de dados
$conn->close();
?>
