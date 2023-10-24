
function apagarImagem(id) {
    document.getElementById('preload').style.display='block'
    const id_img = id; // id da imagem que foi clicada 
    const idD = id;
    const idToDelete = idD + "thumb"; // id para deletar a div 
    const pathHd = idD + "input" // id com o path em alta definição para ser apagado  
    const path = idD + "inputThumb" // id com o path em thumbnail  para ser apagado  

    const thumnailPath = document.getElementById(path).value
    const imagemAltaPath = document.getElementById(pathHd).value
   
    
    // Get the element by its ID
    var element = document.getElementById(idToDelete);

    const formData = new FormData();

    formData.append('id_image', id_img);
    formData.append('path', thumnailPath);
    formData.append('pathHD', imagemAltaPath);

    fetch('apagarImg.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            if (data.message) {
                console.log("Imagens apagadas");
                
                 element.parentNode.removeChild(element); 
                 document.getElementById('preload').style.display='none'
                
            } else {
                console.log("Não foi possível apagar a imagem");
            }
        }
    })
    .catch(error => {
        console.error("Error:", error);
    });
}

