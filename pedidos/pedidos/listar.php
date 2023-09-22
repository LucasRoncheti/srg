<?php

include '../../generalPhp/conection.php';



//paginação
$pagina = filter_input(INPUT_POST, 'pagina', FILTER_SANITIZE_NUMBER_INT);
$qnt_result_pg = filter_input(INPUT_POST, 'qnt_result_pg', FILTER_SANITIZE_NUMBER_INT);
//calcular o inicio visualização
$inicio = ($pagina * $qnt_result_pg) - $qnt_result_pg;

//consultar no banco de dados
$result_sql = "SELECT * FROM clientes ORDER BY id DESC LIMIT $inicio, $qnt_result_pg";
$resultado_sql = mysqli_query($conn, $result_sql);

//Verificar se encontrou resultado na tabela "sqls"
if(($resultado_sql) AND ($resultado_sql->num_rows != 0)){
    echo '<table>';
    // Cabeçalho da tabela
    echo '<tr>
                <th>N°</th>
                <th>NOME CLIENTE</th>
                
                <th >EDIT.</th>
            </tr>';


	while($row_sql = mysqli_fetch_assoc($resultado_sql)){
		echo '<tr class=" tableRow">';
        echo '<td class = "numTable">' . $row_sql['id'] . '</td>';
        echo '<td class = "nameTable">' . $row_sql['nome'] . '</td>';
        echo '<td class = "editTable"> <a  href="editar.php?id='. $row_sql['id'] .'">  <img src="../../assets/edit.svg" > </a>
                                        <a  href="apagar.php?id='. $row_sql['id'] .'">  <img src="../../assets/erase.svg" > </a>
                </td>';
        echo '</tr>';
	}

    

    echo '</table>';//tag que fecha  a tabela



        //Paginação - Somar a quantidade de usuários
        $result_pg = "SELECT COUNT(id) AS num_result FROM clientes";
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
            echo "<div class='alert alert-danger' role='alert'>Nenhum registro encontrado!</div>";
        }




