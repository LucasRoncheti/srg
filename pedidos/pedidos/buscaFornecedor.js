$(function(){
	//Pesquisar os cursos sem refresh na página
	$("#pesquisaFornecedor").keyup(function(){
		
		var pesquisa = $(this).val();
		
		//Verificar se há algo digitado
		if(pesquisa != ''){
			var dados = {
				palavra : pesquisa
				
			}	
				
			$.post('buscaFornecedor.php', dados, function(retorna){
				//Mostra dentro da ul os resultado obtidos 
				$("#fornecedor").html(retorna);
			});
		}else{
			$("#fornecedor").html('');
			listar(1,10)
		}		
	});
});