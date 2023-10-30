

function apagar(id){
    document.getElementById('preload').style.display = 'block';
    var dados ={
        id:id
    }

    $.post('./apagar.php',dados,function(retorna){
        $("#respostaPHP").html(retorna);
        Listar()
        document.getElementById('preload').style.display = 'none';
    })
}