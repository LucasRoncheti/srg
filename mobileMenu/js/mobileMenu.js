

menuMobile = document.getElementById('mobileMenu')

condicional = 1
//função que abre o menu mobile 

openMenu = () => {
   if(condicional == 1){
    menuMobile.classList.add('openAnimation')
    menuMobile.classList.remove('closeAnimation')
    menuMobile.style.display='block'
    condicional = 0
   }else{
    menuMobile.classList.add('closeAnimation')
    menuMobile.classList.remove('openAnimation')
    condicional=1
    setTimeout(function(){
        menuMobile.style.display='none'
    },600)
   }
}