<?php

include '../../generalPhp/conection.php';

if(!isset($_SESSION)) {
    session_start();
}

if(!isset($_SESSION['id'])) {
   die( header("Location: ../../index.php"));
   
}



//paginação
$pagina = filter_input(INPUT_POST, 'pagina', FILTER_SANITIZE_NUMBER_INT);
$qnt_result_pg = filter_input(INPUT_POST, 'qnt_result_pg', FILTER_SANITIZE_NUMBER_INT);
//calcular o inicio visualização
$inicio = ($pagina * $qnt_result_pg) - $qnt_result_pg;

//consultar no banco de dados
$result_fornecedor = "SELECT * FROM fornecedores ORDER BY id DESC LIMIT $inicio, $qnt_result_pg";
$resultado_fornecedor = mysqli_query($conn, $result_fornecedor);

//Verificar se encontrou resultado na tabela "fornecedors"
if(($resultado_fornecedor) AND ($resultado_fornecedor->num_rows != 0)){
    echo '<table>';
    // Cabeçalho da tabela
    echo '<tr>
                <th>N°</th>
                <th>Nome</th>
                <th >EDIT.</th>
            </tr>'; 


	while($row_fornecedor = mysqli_fetch_assoc($resultado_fornecedor)){
		echo '<tr class=" tableRow">';
        echo '<td class = "numTable">' . $row_fornecedor['numero'] . '</td>';
        echo '<td class = "nameTable">' . $row_fornecedor['nome'] . '</td>';
        echo '<td class = "editTable"> <a  href="editarFornecedor.php?id='. $row_fornecedor['id'] .'">  <img src="../../assets/edit.svg" > </a>  
                                        <a  href="apagarFornecedor.php?id='. $row_fornecedor['id'] .'">  <img src="../../assets/erase.svg" > </a> 
                </td>';
        echo '</tr>';
	}

    
    echo '</table>';//tag que fecha  a tabela

   

        //Paginação - Somar a quantidade de usuários
        $result_pg = "SELECT COUNT(id) AS num_result FROM fornecedores";
        $resultado_pg = mysqli_query($conn, $result_pg);
        $row_pg = mysqli_fetch_assoc($resultado_pg);

        //Quantidade de pagina
        $quantidade_pg = ceil($row_pg['num_result'] / $qnt_result_pg);

        //Limitar os link antes depois
        $max_links = 2;
        echo "<div class ='divPagina'>";
        echo "<a href='#' onclick='carregarFornecedores(1, $qnt_result_pg)'>&lt;PRIMEIRA</a> ";

        for($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++){
            if($pag_ant >= 1){
                echo " <a href='#' onclick='carregarFornecedores($pag_ant, $qnt_result_pg)'>$pag_ant </a> ";
            }
        }

        echo " $pagina ";

        for ($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++) {
            if($pag_dep <= $quantidade_pg){
                echo " <a href='#' onclick='carregarFornecedores($pag_dep, $qnt_result_pg)'>$pag_dep</a> ";
            }
        }

        echo " <a href='#' onclick='carregarFornecedores($quantidade_pg, $qnt_result_pg)'>ÚLTIMA></a>";
        echo '</div>';
        }else{
            echo' <div class="notFound">
                        <img  class="notFoundImg" src="../../assets/notFound.svg" alt="">
                        <h3>NÃO HÁ REGISTROS </h3>
                    </div>';
        }




