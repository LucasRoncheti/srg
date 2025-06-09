<?php
include '../generalPhp/conection.php';
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['id'])) {
    die(header("Location: ../index.php"));
}

$data = json_decode(file_get_contents('php://input'), true);
$dataInicial = $data['dataInicial'];
$dataFinal = $data['dataFinal'];
$fornecedor = $data['fornecedor'];

$query = "SELECT * FROM pedidos_dados WHERE dataAtual BETWEEN ? AND ? AND fornecedor = ?";
$stmt = mysqli_stmt_init($conn);

if (mysqli_stmt_prepare($stmt, $query)) {
    mysqli_stmt_bind_param($stmt, "sss", $dataInicial, $dataFinal, $fornecedor);
    mysqli_stmt_execute($stmt);
    $resultado_sql = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($resultado_sql) <= 0) {
        echo '<div class="text-center mt-10 text-gray-500 dark:text-gray-300">'
           . '<img class="mx-auto w-24" src="../assets/notFound.svg" alt="Nenhum registro">'
           . '<h3 class="mt-4 font-semibold">NÃO HÁ REGISTROS ENTRE AS DATAS SELECIONADAS</h3>'
           . '</div>';
    } else {
        $clientes = [];
        while ($row_sql = mysqli_fetch_assoc($resultado_sql)) {
            $chaveAcesso = $row_sql['chaveAcesso'];
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
                    $cliente = "Cliente não encontrado";
                    $id = "-";
                    $data = "-";
                }

                if (!isset($clientes[$chaveAcesso])) {
                    $clientes[$chaveAcesso] = [
                        'cliente' => $cliente,
                        'id' => $id,
                        'dataAtual' => $data,
                        'itens' => []
                    ];
                }

                $clientes[$chaveAcesso]['itens'][] = [
                    'id' => $row_sql['id'],
                    'produto' => $row_sql['produto'],
                    'quantidade' => $row_sql['quantidade'],
                    'valorUnit' => $row_sql['valor_unit'],
                    'valorTotal' => $row_sql['valor_total'],
                    'dataRetirada' => $row_sql['data_retirada'],
                ];
            }
        }

        $somaQuantidadeTotalCaixas = 0;
        $valorTotalUnificado = 0;
        foreach ($clientes as $chaveAcesso => $clienteData) {
            $quantidadeTotal = 0;
            $valorTotalSomado = 0;
            foreach ($clienteData['itens'] as $soma) {
                $quantidadeTotal += $soma['quantidade'];
                $valorTotalSomado += $soma['valorTotal'];
            }
            $somaQuantidadeTotalCaixas += $quantidadeTotal;
            $valorTotalUnificado += $valorTotalSomado;

            echo '<div class="bg-white dark:bg-gray-800 rounded shadow p-4 mb-4">';
            echo '<div class="grid grid-cols-5 gap-2 font-semibold text-sm border-b pb-2">';
            echo '<div>' . $clienteData['id'] . '</div>';
            echo '<div>' . date('d/m/Y', strtotime($clienteData['dataAtual'])) . '</div>';
            echo '<div>' . date('d/m/Y', strtotime($clienteData['itens'][0]['dataRetirada'])) . '</div>';
            echo '<div>' . $quantidadeTotal . '</div>';
            echo '<div class="text-center cursor-pointer" onclick="trocarDisplay(' . $clienteData['id'] . ')">';
            echo '<img src="../assets/fullscreen.svg" class="mx-auto h-5">';
            echo '</div></div>';

            echo '<div id="' . $clienteData['id'] . '" class="hidden mt-2">';
            foreach ($clienteData['itens'] as $item) {
                echo '<div class="border-t pt-2 mt-2 text-sm">';
                echo '<div><strong>' . $item['produto'] . '</strong> (Qnt. ' . $item['quantidade'] . ')</div>';
                echo '<div>Valor Unit: R$ ' . number_format($item['valorUnit'] / 100, 2, ',', '.') . '</div>';
                echo '<div>Valor Total: R$ ' . number_format($item['valorTotal'] / 100, 2, ',', '.') . '</div>';
                echo '</div>';
            }
            echo '</div>';
            echo '</div>';
        }

        echo '<input class="hidden" id="nPedidos" type="hidden" value="' . count($clientes) . '">';
        echo '<input class="hidden" id="somaQuantidade" type="hidden" value="' . $somaQuantidadeTotalCaixas . '">';
        echo '<input class="hidden" id="valorTotalUnif" type="hidden" value="R$ ' . number_format($valorTotalUnificado / 100, 2, ',', '.') . '">';
    }
} else {
    echo "Erro na preparação da consulta.";
}
$conn->close();
?>
