$(function () {
    // Pesquisar os produtos sem refresh na página
    $("#pesquisaProduto").keyup(function () {
        var pesquisa = $(this).val();

        if (pesquisa !== '') {
            $.post('buscaProduto.php', { palavra: pesquisa }, function (retorna) {
                $("#produto").html(retorna);

                var selectedValue = $("#produto option:selected").val();

                if (selectedValue) {
                    var valorEmCentavos = parseInt(selectedValue, 10);
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

// Função para calcular o valor total com base no input editável
function calcularTotal() {
    var valorUnitRaw = $("#valorUnit").val();
    var valorUnitario = parseFloat(valorUnitRaw.replace("R$", "").replace(",", ".").trim());
    var quantidade = parseFloat($("#quantidade").val());

    if (!isNaN(valorUnitario) && !isNaN(quantidade)) {
        var total = valorUnitario * quantidade;
        var totalFormatado = total.toFixed(2).replace(".", ",");
        $("#valorTotal").html("R$ " + totalFormatado);
    } else {
        $("#valorTotal").html("R$ 0,00");
    }
}

// Atualiza ao mudar o select de produto
function calcularMudancaSelect() {
    var selectedValue = $("#produto option:selected").val();

    if (selectedValue) {
        var valorEmCentavos = parseInt(selectedValue, 10);
        var valorFormatado = (valorEmCentavos / 100).toFixed(2).replace(".", ",");
        $("#valorUnit").val("R$ " + valorFormatado);
    } else {
        $("#valorUnit").val("R$ 0,00");
    }

    calcularTotal();
}

// Atualiza valor total ao digitar no input manualmente
$("#valorUnit").on("input", function () {
    calcularTotal();
});
