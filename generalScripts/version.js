//alterar a versão do sistema 

    versao = '1.0.0'
    element = document.getElementById('data-footer')
    data = () =>  {

        //gera a data 
        gerarData  = new Date()
        //formata a data pra uma string 
        dataFormatada = gerarData.toLocaleString(undefined, { year: 'numeric', minimumIntegerDigits: 4 })
        //formata o texto que será usado no footer com todas as informações
        element.textContent = `V ${versao} |  ${dataFormatada}  © Lucas Roncheti `
    }

    //chama função logo que a  página é carregada
    data()
