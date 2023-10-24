$(function(){
	//Pesquisar os cursos sem refresh na página
	$("#pesquisaCliente").keyup(function(){
		
		var pesquisa = $(this).val();
		
		//Verificar se há algo digitado
		if(pesquisa != ''){
			var dados = {
				palavra : pesquisa
			}		
			$.post('buscaCliente.php', dados, function(retorna){
				//Mostra dentro da ul os resultado obtidos 
				$("#select").html(retorna);
			});
		}else{
			$("#select").html('');
			listar(1,10)
		}		
	});
});