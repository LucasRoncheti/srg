<?php
	//Incluir a conexão com banco de dados
    include '../generalPhp/conection.php';
	if(!isset($_SESSION)) {
		session_start();
	}
	
	if(!isset($_SESSION['id'])) {
		die( header("Location: ../index.php"));
	   
	}
	
	
	//Recuperar o valor da palavra
	$busca = $_POST['palavra'];
	
	//Pesquisar no banco de dados nome do curso referente a palavra digitada pelo usuário
	$sql = "SELECT * FROM pedidoscadastro WHERE cliente  LIKE '%$busca%'";
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
			
			
			$dataFormatada = date('d/m/y', strtotime($row_sql['dataAtual']));

			echo ' <div class="containerDadosPedidos">';
			echo '     <div class="numberDate">';
			echo '         <div class="numeroPedido">N° ' . $row_sql['id'] . ' </div>';
			echo '        <div class="dataPedido">' . $dataFormatada . '</div>';
			echo '      </div>';
			echo '      <div class="dadosPedidos">';
			echo '          <div class="nomeClientePedido">' . $row_sql['cliente'] . '</div>';
			echo '         <div class="valorTotalPedidoPedido"> R$ ' . number_format($row_sql['valor_total'] / 100, 2, ",", ".") . '</div>';
			echo '      </div>';
			echo '     <div class="apagarImprimir">';
			echo '<a href="../inspessao/listarPedido/salvarInspessao.php?id=' . urlencode($row_sql['chaveAcesso']) . '&numero=' . urlencode($row_sql['id']) . '&cliente=' . urlencode($row_sql['cliente']) . '"><img src="../assets/file_green.svg"></a>';
			echo '      </div>';
			echo '  </div>';
		}
	
		
		
	}
?>


