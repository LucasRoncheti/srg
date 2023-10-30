//jquery responsável por mostrar os fornecedores em lista 

// chama a função listar assim que carregar todo contúdo 
var chaveAcesso = document.getElementById('chaveAcesso').value
$(document).ready(function () {
    Listar();
    
   
});
// captura o valor da chave de acesso para retornar os valores 


function Listar() {
    var dados ={
        chaveAcesso : chaveAcesso
    }
    $.post('./listar.php',dados, function(retorna){
        //seletor id no html
        $("#containerList").html(retorna);
        
         // seleciona a div que terá o valor total de caixas
            var valorRecebidoPhp = document.getElementById("quantidadeTotal").value
            document.getElementById("Ncaixas").innerHTML = valorRecebidoPhp

            //atualiza a quantidade de caixas 
            var valorMaximoCaixas = document.getElementById("inputCxRest").value
            document.getElementById("CxRest").innerHTML = valorMaximoCaixas - valorRecebidoPhp

        
    });
   
    }

   