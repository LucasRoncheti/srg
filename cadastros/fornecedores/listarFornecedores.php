<?php

include '../../generalPhp/conection.php';

//consultar no banco de dados
$result_fornecedor = "SELECT * FROM fornecedores ORDER BY id DESC";
$resultado_fornecedor = mysqli_query($conn, $result_fornecedor);

//Verificar se encontrou resultado na tabela "fornecedors"
if(($resultado_fornecedor) AND ($resultado_fornecedor->num_rows != 0)){
    echo '<table>';
    // Cabeçalho da tabela
    echo '<tr>
                <th>N°</th>
                <th>Nome</th>
                <th>EDIT.</th>
            </tr>'; 


	while($row_fornecedor = mysqli_fetch_assoc($resultado_fornecedor)){
		echo '<tr>';
        echo '<td>' . $row_fornecedor['numero'] . '</td>';
        echo '<td>' . $row_fornecedor['nome'] . '</td>';
        echo '<td> <a  href="" id="'.$row_fornecedor['id'].'">  <img src="../../assets/edit.svg" > </a>  
                    <a href="" id="'.$row_fornecedor['id'].'">  <img src="../../assets/erase.svg" ></a>  
                </td>';
        echo '</tr>';
	}
    echo '</table>';//tag que fecha  a tabela
}else{
	echo "Nenhum usuário encontrado";
}

