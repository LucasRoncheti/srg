//alterar a versão do sistema 

    versao = '1.6.0'
    element = document.getElementById('data-footer')
    data = () =>  {

        //gera a data 
        gerarData  = new Date()
        //formata a data pra uma string 
        dataFormatada = gerarData.toLocaleString(undefined, { year: 'numeric', minimumIntegerDigits: 4 })
        //formata o texto que será usado no footer com todas as informações
        element.textContent = `V ${versao} |  ${dataFormatada}  © Lucas Roncheti CodeDesigner `
    }

    //chama função logo que a  página é carregada
    data()



   //  // função para validar o tamanho da tela 
   //  validador = 0

    
   //  window.addEventListener("resize", function() {

   //      let body = document.body
   //      // O código aqui será executado sempre que a janela for redimensionada.
   //      const bodyWidth = document.body.clientWidth;
   //      const bodyHeight = document.body.clientHeight;

   //      if(bodyWidth >= 768 ){
   //         body.innerHTML = "<div class='mensagem'><p> Este sistema não é otimizado para desktop<p><BR><p> Acesse por um smartphone ou tablet <p></div> "
           
           
   //         validador = 1
   //      }
   //      if(bodyWidth <= 768 && validador == 1 ){
   //         window.location.reload()
   //         validador = 0
           
   //      }
      
       
   //    });

   //    let verificarTamanhoTela = ()=>{

   //      let body = document.body
   //      // O código aqui será executado sempre que a janela for redimensionada.
   //      const bodyWidth = document.body.clientWidth;
   //      const bodyHeight = document.body.clientHeight;

   //      if(bodyWidth >= 768 ){
   //         body.innerHTML = "<div class='mensagem'><p> Este sistema não é otimizado para desktop<p><BR><p> Acesse por um smartphone  ou tablet<p></div> "
           
           
   //         validador = 1
   //      }
   //      if(bodyWidth <= 768 && validador == 1 ){
   //         window.location.reload()
   //         validador = 0
           
   //      }
      

   //    }


