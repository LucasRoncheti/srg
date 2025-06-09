<?php

include '../generalPhp/conection.php';



if(!isset($_SESSION)) {
    session_start();
}

if(!isset($_SESSION['id'])) {
    die( header("Location: ../index.php"));
   
}


//paginação
$pagina = filter_input(INPUT_POST, 'pagina', FILTER_SANITIZE_NUMBER_INT);
$qnt_result_pg = filter_input(INPUT_POST, 'qnt_result_pg', FILTER_SANITIZE_NUMBER_INT);
//calcular o inicio visualização
$inicio = ($pagina * $qnt_result_pg) - $qnt_result_pg;

//consultar no banco de dados
$result_sql = "SELECT * FROM pedidoscadastro ORDER BY id DESC LIMIT $inicio, $qnt_result_pg";
$resultado_sql = mysqli_query($conn, $result_sql);

//Verificar se encontrou resultado na tabela "sqls"
if(($resultado_sql) AND ($resultado_sql->num_rows != 0)){
    



while($row_sql = mysqli_fetch_assoc($resultado_sql)){
    $dataFormatada = date('d/m/y', strtotime($row_sql['dataAtual']));
    $chaveAcesso = $row_sql['chaveAcesso'];

    $stmt = $conn->prepare('SELECT  SUM(valor_total) AS total FROM pedidos_dados WHERE chaveAcesso = ? ');
    $stmt->bind_param('s',$chaveAcesso);
    if($stmt->execute()){
        $result = $stmt->get_result();
        $row1 = $result->fetch_assoc();
        $somaTotalValor = $row1['total'] ?? 0;
    }

    echo '<div class="bg-white dark:bg-gray-800 border dark:border-gray-700 rounded-md p-4 mb-4 shadow hover:shadow-lg transition">';
    echo '    <div class="flex items-center justify-between text-sm text-gray-600 dark:text-gray-400 mb-2">';
    echo '        <div class="font-semibold text-black dark:text-white">Pedido Nº ' . $row_sql['id'] . '</div>';
    echo '        <div>' . $dataFormatada . '</div>';
    echo '    </div>';
    echo '    <div class="flex items-center justify-between mb-2">';
    echo '        <div class="text-lg font-medium text-black dark:text-white">' . $row_sql['cliente'] . '</div>';
    echo '        <div class="text-green-600 dark:text-green-400 font-semibold">R$ ' . number_format($somaTotalValor / 100, 2, ",", ".") . '</div>';
    echo '    </div>';
    echo '    <div class="flex gap-4 justify-end mt-2">';
    echo '        <a href="print.php?id=' . $row_sql['chaveAcesso'] . '" title="Imprimir">';
    echo '            <img src="../assets/print.svg" class="w-5 h-5 hover:opacity-80 transition">';
    echo '        </a>';
    echo '        <a href="editar/editar.php?id=' . $row_sql['chaveAcesso'] . '" title="Editar">';
    echo '            <img src="../assets/edit.svg" class="w-5 h-5 hover:opacity-80 transition">';
    echo '        </a>';
    echo '        <a href="apagar.php?id=' . $row_sql['chaveAcesso'] . '" title="Apagar">';
    echo '            <img src="../assets/erase.svg" class="w-5 h-5 hover:opacity-80 transition">';
    echo '        </a>';
    echo '    </div>';
    echo '</div>';
}


    

   



        //Paginação - Somar a quantidade de usuários
        $result_pg = "SELECT COUNT(id) AS num_result FROM pedidoscadastro";
        $resultado_pg = mysqli_query($conn, $result_pg);
        $row_pg = mysqli_fetch_assoc($resultado_pg);

        //Quantidade de pagina
        $quantidade_pg = ceil($row_pg['num_result'] / $qnt_result_pg);

        //Limitar os link antes depois
        $max_links = 2;
        echo "<div class ='divPagina'>";
        echo "<a href='#' onclick='listar(1, $qnt_result_pg)'>&lt;PRIMEIRA</a> ";

        for($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++){
            if($pag_ant >= 1){
                echo " <a href='#' onclick='listar($pag_ant, $qnt_result_pg)'>$pag_ant </a> ";
            }
        }

        echo " $pagina ";

        for ($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++) {
            if($pag_dep <= $quantidade_pg){
                echo " <a href='#' onclick='listar($pag_dep, $qnt_result_pg)'>$pag_dep</a> ";
            }
        }

        echo " <a href='#' onclick='listar($quantidade_pg, $qnt_result_pg)'>ÚLTIMA></a>";
        echo '</div>';
        }else{
            echo '
			<div class="notFound">
				<img  class="notFoundImg" src="../assets/notFound.svg" alt="">
				<h3>NENHUM PEDIDO SALVO</h3>
			</div>
		
		';
        }




