
// função aparece um aviso se apertar o botão antes de salvar 
let avisoSalvar = () => {
    if (confirm("Dados não salvos serão perdidos")) {
      window.location.href = '../cadastrodepedidos.php';
    }
    
  }
  

  let avisoSalvar2 = () => {
  //  alert("Dados não salvos serão perdidos")
  }