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
$result_sql = "SELECT * FROM produtos ORDER BY id DESC LIMIT $inicio, $qnt_result_pg";
$resultado_sql = mysqli_query($conn, $result_sql);

if(($resultado_sql) AND ($resultado_sql->num_rows != 0)){
    echo '<div class="w-full overflow-x-auto">';
    echo '<table class="min-w-full text-sm text-left border dark:border-gray-600">';
    
    // Cabeçalho da tabela
    echo '<thead class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white">';
    echo '<tr>
            <th class="px-4 py-2">N°</th>
            <th class="px-4 py-2">NOME PRODUTO</th>
            <th class="px-4 py-2">VALOR</th>
            <th class="px-4 py-2 text-center">AÇÕES</th>
          </tr>';
    echo '</thead><tbody class="bg-white dark:bg-gray-800">';

	while($row_sql = mysqli_fetch_assoc($resultado_sql)){
		echo '<tr class="border-b dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700">';
        echo '<td class="px-4 py-2 font-medium text-gray-900 dark:text-white">' . $row_sql['id'] . '</td>';
        echo '<td class="px-4 py-2">' . $row_sql['produto'] . '</td>';
        echo '<td class="px-4 py-2">R$ ' . number_format($row_sql['valor'] / 100 , 2,",",".") . '</td>';
        echo '<td class="px-4 py-2 flex justify-center gap-3">';
        echo '  <a href="editar.php?id=' . $row_sql['id'] . '"><img src="../../assets/edit.svg" class="w-5 h-5" alt="Editar"></a>';
        echo '  <a href="apagar.php?id=' . $row_sql['id'] . '"><img src="../../assets/erase.svg" class="w-5 h-5" alt="Apagar"></a>';
        echo '</td>';
        echo '</tr>';
	}
    
    echo '</tbody></table></div>';

    // Paginação
    $result_pg = "SELECT COUNT(id) AS num_result FROM produtos";
    $resultado_pg = mysqli_query($conn, $result_pg);
    $row_pg = mysqli_fetch_assoc($resultado_pg);
    $quantidade_pg = ceil($row_pg['num_result'] / $qnt_result_pg);
    $max_links = 2;

    echo "<div class='flex flex-wrap justify-center items-center gap-2 mt-4 text-sm text-gray-700 dark:text-gray-200'>";
    echo "<a href='#' onclick='listar(1, $qnt_result_pg)' class='px-2 py-1 bg-gray-300 dark:bg-gray-700 rounded hover:bg-gray-400'>&lt; PRIMEIRA</a>";

    for($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++){
        if($pag_ant >= 1){
            echo "<a href='#' onclick='listar($pag_ant, $qnt_result_pg)' class='px-2 py-1 hover:underline'>$pag_ant</a>";
        }
    }

    echo "<span class='font-bold px-2'>$pagina</span>";

    for ($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++) {
        if($pag_dep <= $quantidade_pg){
            echo "<a href='#' onclick='listar($pag_dep, $qnt_result_pg)' class='px-2 py-1 hover:underline'>$pag_dep</a>";
        }
    }

    echo "<a href='#' onclick='listar($quantidade_pg, $qnt_result_pg)' class='px-2 py-1 bg-gray-300 dark:bg-gray-700 rounded hover:bg-gray-400'>ÚLTIMA &gt;</a>";
    echo "</div>";

} else {
    echo '<div class="flex flex-col items-center justify-center mt-8 text-center text-gray-600 dark:text-gray-300">';
    echo '<img src="../../assets/notFound.svg" alt="Não encontrado" class="w-24 h-24 mb-4">';
    echo '<h3 class="text-lg font-semibold">NÃO HÁ REGISTROS</h3>';
    echo '</div>';
}




