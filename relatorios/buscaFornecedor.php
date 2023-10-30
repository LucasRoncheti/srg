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
	$sql = "SELECT * FROM fornecedores WHERE nome  LIKE '%$busca%'";
	$resultado_sql= mysqli_query($conn, $sql);
	
	if(mysqli_num_rows($resultado_sql) <= 0){
		echo '

		 <option value="Fornecedor não encontrado"> Fornecedor não encontrado </option>
		
		';
	}else{

		
		
		
	
	
		while($row_sql = mysqli_fetch_assoc($resultado_sql)){


			echo '<option  value="'. $row_sql['nome'] . '"> ' . $row_sql['nome'] . '</option>';

			
		}
	
		
	
		
		
	}
?>


