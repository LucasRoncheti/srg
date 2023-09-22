 $(function () {
     //Pesquisar os cursos sem refresh na página
     $("#pesquisaProduto").keyup(function () {
         var pesquisa = $(this).val();
         //Verificar se há algo digitado
         if (pesquisa != '') {
            var dados = {
                 palavra: pesquisa
             }

             $.post('buscaProduto.php', dados, function (retorna) {
                 //Mostra dentro da ul os resultado obtidos 
                 $("#produto").html(retorna);
               
               
              

                 // Aqui você pode pegar o valor selecionado e exibi-lo em uma div diferente
                 var selectedValue = $("#produto option:selected").val();
                 var valorStringUnit = selectedValue.toString()
               

                    if(valorStringUnit.length == 2){
                        $("#valorUnit").html("R$ 0,"+ valorStringUnit)
                    }

                    if(valorStringUnit.length >= 3){
                        totalFormatadoUnit  =  valorStringUnit /100
                        $("#valorUnit").html("R$" + totalFormatadoUnit.toFixed(2).replace(".",","))
                    }
                //  $("#valorUnit").html("R$"+selectedValue);

                 calcularTotal() 
                
                
             });
         } else {
             $("#produto").html('');
             $("#valorUnit").html('R$ 0,00');
             $("#valorTotal").html('R$ 0,00'); // Limpar a outra div se nada for digitado
             listar(1, 10)
         }
     });
});

// Função para calcular o valor total
function calcularTotal() {
    var selectedValue = parseFloat($("#produto option:selected").val());
    var quantidade = parseFloat($("#quantidade").val());

    var total = selectedValue * quantidade;
    var valorString = total.toString()

    if(valorString.length == 2){
        $("#valorTotal").html("R$ 0,"+ total)
    }

    if(valorString.length >= 3){
        totalFormatado  =  total /100
        $("#valorTotal").html("R$" + totalFormatado.toFixed(2).replace(".",","))
    }
    

}

function calcularMudançaSelect(){
    calcularTotal() 
    
    var selectedValue = $("#produto option:selected").val();
    var valorStringUnit = selectedValue.toString()

    if(valorStringUnit.length == 2){
        $("#valorUnit").html("R$ 0,"+ valorStringUnit)
    }

    if(valorStringUnit.length >= 3){
        totalFormatadoUnit  =  valorStringUnit /100
        $("#valorUnit").html("R$" + totalFormatadoUnit.toFixed(2).replace(".",","))
    }
}



