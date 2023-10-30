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
	$fornecedores = $_POST['palavra'];
	
	//Pesquisar no banco de dados nome do curso referente a palavra digitada pelo usuário
	$fornecedores = "SELECT * FROM fornecedores WHERE nome  LIKE '%$fornecedores%'";
	$resultado_fornecedores = mysqli_query($conn, $fornecedores);
	
	if(mysqli_num_rows($resultado_fornecedores) <= 0){
		echo '
			<div class="notFound">
				<img  class="notFoundImg" src="../../assets/notFound.svg" alt="">
				<h3>FORNECEDOR NÃO ENCONTRADO</h3>
			</div>
		
		';
	}else{

		
		
			echo '<table>';
			// Cabeçalho da tabela
			echo '<tr>
						<th>N°</th>
						<th>Nome</th>
						<th >EDIT.</th>
					</tr>'; 
		
		
			while($row_fornecedor = mysqli_fetch_assoc($resultado_fornecedores)){
				echo '<tr class=" tableRow">';
				echo '<td>' . $row_fornecedor['numero'] . '</td>';
				echo '<td>' . $row_fornecedor['nome'] . '</td>';
				echo '<td class = "editTable"> <a  href="" id="'.$row_fornecedor['id'].'">  <img src="../../assets/edit.svg" > </a>  
							<a href="" id="'.$row_fornecedor['id'].'">  <img src="../../assets/erase.svg" ></a>  
						</td>';
				echo '</tr>';
			}
			echo '</table>';//tag que fecha  a tabela
		
		
	}
?>


