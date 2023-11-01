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

			echo   ' <div class="containerDadosPedidos">';
			echo   '     <div class="numberDate">';
			echo   '         <div class="numeroPedido">N° ' . $row_sql['id'] . ' </div>';
			echo    '        <div class="dataPedido">' . $dataFormatada . '</div>';
			echo  '      </div>';
			echo  '      <div class="dadosPedidos">';
			echo  '          <div class="nomeClientePedido">' . $row_sql['cliente'] . '</div>';
			echo   '         <div class="valorTotalPedidoPedido">' . $row_sql['valor_total'] . '</div>';
			echo  '      </div>';
			echo   '     <div class="apagarImprimir">';
			echo   '          <a  href="print.php?id='. $row_sql['chaveAcesso'] .'">  <img src="../assets/print.svg" > </a>';
			echo   '          <a  href="editar/editar.php?id='. $row_sql['chaveAcesso'] .'">  <img src="../assets/edit.svg" > </a>';
			echo    '        <a  href="apagar.php?id='. $row_sql['chaveAcesso'] .'">  <img src="../assets/erase.svg" > </a>';
					
			echo  '      </div>';
			echo  '  </div>';
		}
	
		
		
	}
?>


