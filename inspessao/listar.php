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
$result_sql = "SELECT * FROM inspecoes ORDER BY id DESC LIMIT $inicio, $qnt_result_pg";
$resultado_sql = mysqli_query($conn, $result_sql);

//Verificar se encontrou resultado na tabela "sqls"
if(($resultado_sql) AND ($resultado_sql->num_rows != 0)){



    while ($row_sql = mysqli_fetch_assoc($resultado_sql)) {
        $dataFormatada = date('d/m/y', strtotime($row_sql['data_inspecao']));
        echo ' <div class="containerDadosPedidos">';
        echo '     <div class="numberDate">';
        echo '         <div style="font-size:0.7em;" class="numeroPedido">N° Cont. ' . $row_sql['numero_container'] . ' </div>';
        echo '        <div class="dataPedido">Data ' . $dataFormatada . '</div>';
        echo '      </div>';
        echo '      <div class="dadosPedidos">';
        echo '          <div class="nomeClientePedido">' . $row_sql['nome'] . '</div>';
        echo '      </div>';
        echo '     <div class="apagarImprimir">';
        echo '<a href="../inspessao/listarPedido/salvarInspessao.php?id=' . urlencode($row_sql['id']) . '&numero=' . urlencode($row_sql['id']) . '&cliente=' . urlencode($row_sql['nome']) . '&numero_container=' . urlencode($row_sql['numero_container']) . '"><img src="../assets/file_green.svg"></a>';
        echo '   <img style="cursor:pointer;" onclick="deletarInspecao('.$row_sql['id'].')" src="../assets/erase.svg">';
        echo '   <img style="cursor:pointer;" onclick="editarInspecao('.$row_sql['id'].',\''.$row_sql['nome'].'\','.$row_sql['numero_container'].','.$row_sql['data_inspecao'].')" src="../assets/edit.svg">';
        echo '      </div>';
        echo '  </div>';
    }







    //Paginação - Somar a quantidade de usuários
        $result_pg = "SELECT COUNT(id) AS num_result FROM inspecoes";
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




