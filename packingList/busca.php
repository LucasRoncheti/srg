<?php
	//Incluir a conexão com banco de dados
    include '../generalPhp/conection.php';
	
	//Recuperar o valor da palavra
	$busca = $_POST['palavra'];
	
	//Pesquisar no banco de dados nome do curso referente a palavra digitada pelo usuário
	$sql = "SELECT * FROM listpack WHERE nome  LIKE '%$busca%'";
	$resultado_sql= mysqli_query($conn, $sql);


	
	
	if(mysqli_num_rows($resultado_sql) <= 0){
		echo '
			<div class="notFound">
				<img  class="notFoundImg" src="../assets/notFound.svg" alt="">
				<h3>PEDIDO NÃO ENCONTRADO</h3>
			</div>
		';
	}else{

		while($row_sql = mysqli_fetch_assoc($resultado_sql)){
			
			$dataFormatada = date('d/m/y', strtotime($row_sql['data_packingList']));
			echo ' <div class="containerDadosPedidos">';
			echo '     <div class="numberDate">';
			echo '         <div style="font-size:0.7em;" class="numeroPedido">N° Cont. ' . $row_sql['numero_container'] . ' </div>';
			echo '        <div class="dataPedido">Data ' . $dataFormatada . '</div>';
			echo '      </div>';
			echo '      <div class="dadosPedidos">';
			echo '          <div class="nomeClientePedido">' . $row_sql['nome'] . '</div>';
			echo '      </div>';
			echo '     <div class="apagarImprimir">';
			echo '<a href="../packingList/editar/editar.php?id=' . urlencode($row_sql['id']) . '&numero=' . urlencode($row_sql['id']) . '&cliente=' . urlencode($row_sql['nome']) . '&numero_container=' . urlencode($row_sql['numero_container']) . '"><img src="../assets/file_green.svg"></a>';
			echo '   <img style="cursor:pointer;" onclick="deletarPackingList('.$row_sql['id'].')" src="../assets/erase.svg">';
			echo '   <img style="cursor:pointer;" onclick="editarPackingList('.$row_sql['id'].',\''.$row_sql['nome'].'\','.$row_sql['numero_container'].','.$row_sql['data_packingList'].')" src="../assets/edit.svg">';
			echo '      </div>';
			echo '  </div>';
		}
	
	}
?>


