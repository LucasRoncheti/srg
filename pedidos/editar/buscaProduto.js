$(function () {
    // Pesquisar os cursos sem refresh na página
    $("#pesquisaProduto").keyup(function () {
        var pesquisa = $(this).val();

        if (pesquisa !== '') {
            var dados = { palavra: pesquisa };

            $.post('buscaProduto.php', dados, function (retorna) {
                $("#produto").html(retorna);

                // Pega o valor do produto selecionado
                var selectedValue = $("#produto option:selected").val();

                if (selectedValue) {
                    var valorEmCentavos = parseInt(selectedValue, 10);

                    // Formata e preenche o input #valorUnit
                    var valorFormatado = (valorEmCentavos / 100).toFixed(2).replace(".", ",");
                    $("#valorUnit").val("R$ " + valorFormatado);
                } else {
                    $("#valorUnit").val("R$ 0,00");
                }

                calcularTotal();
            });
        } else {
            $("#produto").html('');
            $("#valorUnit").val('R$ 0,00');
            $("#valorTotal").html('R$ 0,00');
        }
    });
});

// Função para calcular o valor total
function calcularTotal() {
    let valorUnitRaw = $("#valorUnit").val();

    // Remove "R$ ", espaços e converte vírgula para ponto
    let valorUnitLimpo = valorUnitRaw.replace("R$", "").trim().replace(",", ".");
    let valorUnit = parseFloat(valorUnitLimpo);

    let quantidade = parseFloat($("#quantidade").val());

    if (!isNaN(valorUnit) && !isNaN(quantidade)) {
        let total = valorUnit * quantidade;
        let valorFormatado = total.toFixed(2).replace(".", ",");

        $("#valorTotal").html("R$ " + valorFormatado);
    } else {
        $("#valorTotal").html("R$ 0,00");
    }
}


// Função caso mude o select manualmente
function calcularMudancaSelect() {
    calcularTotal();

    var selectedValue = $("#produto option:selected").val();

    if (selectedValue) {
        var valorEmCentavos = parseInt(selectedValue, 10);
        var valorFormatado = (valorEmCentavos / 100).toFixed(2).replace(".", ",");

        $("#valorUnit").val("R$ " + valorFormatado);
    } else {
        $("#valorUnit").val("R$ 0,00");
    }
}



