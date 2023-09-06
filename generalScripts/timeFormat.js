
//esse script formata e atualiza a data e hora no sistema


const elementoDataHora = document.getElementById('data-hora')

function atualizarDataHora(){

        // cria o objeto data
        const dataAtual = new Date()
        //formata a hora e data
        const dataHoraFormatada = dataAtual.toLocaleString([], { hour: '2-digit', minute: '2-digit' })
       

        const diasDaSemana = ["Domingo", "Segunda-feira", "Terça-feira", "Quarta-feira", "Quinta-feira", "Sexta-feira", "Sábado"];
        const diaDaSemana = diasDaSemana[dataAtual.getDay()];

         //insere a data  formatada no html
         elementoDataHora.textContent=`${diaDaSemana} | ${dataHoraFormatada}`
}

atualizarDataHora()

setInterval(atualizarDataHora,3000)