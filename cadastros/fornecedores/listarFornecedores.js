
//jquery responsável por mostrar os fornecedores em lista 

var qnt_result_pg = 10; //quantidade de registro por página
var pagina = 1; //página inicial

$(document).ready(function () {
    carregarFornecedores(pagina, qnt_result_pg);
   
});

function carregarFornecedores(pagina, qnt_result_pg) {
    //varia´veis que serão enviadas pelo metodo post para o php 
    var dados = {
        pagina: pagina,
        qnt_result_pg: qnt_result_pg
    }
    $.post('./listarFornecedores.php', dados , function(retorna){
        //seletor id no html
        $("#containerList").html(retorna);
    });

    }

   




