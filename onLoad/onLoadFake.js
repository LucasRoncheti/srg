


//essa função  abre a página de  gerar pedidos novos 
onLoad = () => {
    var preloadElement = document.getElementById('preload'); // Obtém o elemento de pré-carregamento
    
    setTimeout(() => {
        preloadElement.style.display = 'none'; // Oculta o elemento após 1500 milissegundos (1,5 segundos)
        
        window.location.href='../pedidos/pedidos.php'
    }, 1500);
}

onLoad(); // Chama a função onLoad
