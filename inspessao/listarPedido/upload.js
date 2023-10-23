function enviarImagem(inputElement) {
    const id_item = inputElement.getAttribute('id');
    const file = inputElement.files[0];

    if (!file) {
        console.log('Nenhuma imagem selecionada.');
        return;
    }

    const formData = new FormData();
    formData.append('id_item', id_item);
    formData.append('imagem', file);

    fetch('upload.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            
            if (data.message) {
                alert('Mensagem do servidor: ' + data.message);
            }
        } else {
            alert('Erro ao enviar imagem: ' + (data.message || 'Mensagem não especificada'));
        }
    })
    .catch(error => {
        alert('Erro de rede: ' + error);
    });
}
