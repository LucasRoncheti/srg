function enviarImagem(inputElement) {
    const id_item = inputElement.getAttribute('id');
    const file = inputElement.files[0];

    if (!file) {
        console.log('Nenhuma imagem selecionada.');
        return;
    }

    const maxWidth1 = 300; // Primeira largura máxima desejada
    const maxHeight1 = 300; // Primeira altura máxima desejada
    const quality1 = 0.2; // Primeira qualidade de imagem

    const maxWidth2 = 600; // Segunda largura máxima desejada
    const maxHeight2 = 600; // Segunda altura máxima desejada
    const quality2 = 0.8; // Segunda qualidade de imagem

    const reader = new FileReader();
    reader.onload = function(e) {
        const img = new Image();
        img.src = e.target.result;
        img.onload = function() {
            const canvas1 = document.createElement('canvas');
            const canvas2 = document.createElement('canvas');

            // Redimensionamento da primeira imagem
            const aspectRatio1 = img.width / img.height;
            canvas1.width = maxWidth1;
            canvas1.height = maxWidth1 / aspectRatio1;
            const ctx1 = canvas1.getContext('2d');
            ctx1.drawImage(img, 0, 0, canvas1.width, canvas1.height);

            // Redimensionamento da segunda imagem
            const aspectRatio2 = img.width / img.height;
            canvas2.width = maxWidth2;
            canvas2.height = maxWidth2 / aspectRatio2;
            const ctx2 = canvas2.getContext('2d');
            ctx2.drawImage(img, 0, 0, canvas2.width, canvas2.height);

            canvas1.toBlob(function(blob1) {
                canvas2.toBlob(function(blob2) {
                    const formData = new FormData();
                    formData.append('id_item', id_item);
                    formData.append('imagem1', blob1, 'redimensionada1.jpg');
                    formData.append('imagem2', blob2, 'redimensionada2.jpg');

                    fetch('upload.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.text())
                    .then(data => {
                    
                        console.log(data);
                        reload();
                    
                       
                    })
                    .catch(error => {
                        alert('Erro de rede: ' + error);
                        reload();
                    });
                }, 'image/jpeg', quality2);
            }, 'image/jpeg', quality1);
        };
    };

    reader.readAsDataURL(file);
}
