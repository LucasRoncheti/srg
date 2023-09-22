
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
    $.post('./listar.php', dados , function(retorna){
        //seletor id no html
        $("#containerList").html(retorna);
    });

    }

   




