<?php
	//Incluir a conexão com banco de dados
    include '../../generalPhp/conection.php';

	if(!isset($_SESSION)) {
		session_start();
	}
	
	if(!isset($_SESSION['id'])) {
	   die( header("Location: ../../index.php"));
	   
	}
	
	//Recuperar o valor da palavra
	$busca = $_POST['palavra'];
	
	//Pesquisar no banco de dados nome do curso referente a palavra digitada pelo usuário
	$sql = "SELECT * FROM clientes WHERE nome  LIKE '%$busca%'";
	$resultado_sql= mysqli_query($conn, $sql);
	
	if(mysqli_num_rows($resultado_sql) <= 0){
		echo '
			<div class="notFound">
				<img  class="notFoundImg" src="../../assets/notFound.svg" alt="">
				<h3>PRODUTO NÃO ENCONTRADO</h3>
			</div>
		
		';
	}else{

		
		
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
		
		
	}
?>


