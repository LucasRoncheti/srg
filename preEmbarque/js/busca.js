$(function(){
	//Pesquisar os cursos sem refresh na página
	$("#pesquisa").keyup(function(){
		
		var pesquisa = $(this).val();
		
		//Verificar se há algo digitado
		if(pesquisa != ''){
			var dados = {
				palavra : pesquisa
			}		
			$.post('./php/busca.php', dados, function(retorna){
				//Mostra dentro da ul os resultado obtidos 
				$("#containerList").html(retorna);
			});
		}else{
			$("#resultado").html('');
			listar(1,10)
		}		
	});
});