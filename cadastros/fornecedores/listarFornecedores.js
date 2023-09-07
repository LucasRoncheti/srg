
//jquery responsável por mostrar os fornecedores em lista 

function carregarFornecedores() {
    $.post('./listarFornecedores.php', function(retorna){
        //Subtitui o valor no seletor id="conteudo"
        $("#containerList").html(retorna);
        console.log('teste')
    });
};

// chama a função assim que o html for carregado 

carregarFornecedores()
