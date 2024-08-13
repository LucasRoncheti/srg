
//jquery responsável por mostrar os fornecedores em lista 

var qnt_result_pg = 10; //quantidade de registro por página
var pagina = 1; //página inicial

$(document).ready(function () {
    listar(pagina, qnt_result_pg);
   
});

function listar(pagina, qnt_result_pg) {
    //varia´veis que serão enviadas pelo metodo post para o php 
    
    var dados = {
        pagina: pagina,
        qnt_result_pg: qnt_result_pg
    }
    $.post('listar.php', dados , function(retorna){
        //seletor id no html
       
        $("#containerList").html(retorna);
        
    });

    }


    function salvarInspecao() {
        // Cria um objeto FormData com os dados do formulário
        var formData = $('.formCadastroInspecao').serialize();
    
        // Faz a requisição AJAX para salvar os dados
        $.ajax({
            type: 'POST',
            url: 'salvarInspecao.php',
            data: formData,
            success: function(response) {
                // Manipula a resposta do servidor
                alert('Inspeção salva com sucesso!');
                console.log(response);
            },
            error: function(xhr, status, error) {
                // Manipula erros
                console.error('Erro ao salvar inspeção:', error);
            }
        });
    }
   




