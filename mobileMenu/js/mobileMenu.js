

menuMobile = document.getElementById('mobileMenu')

let condicional = 1
//função que abre o menu mobile 



const openMenu = () => {
  if (condicional === 1) {
    menuMobile.classList.remove('hidden');
    menuMobile.classList.remove('opacity-0', 'translate-y-full', 'md:translate-x-full');
    menuMobile.classList.add('opacity-100', 'translate-y-0', 'md:translate-x-0', 'transition', 'duration-500', 'md:w-[30%]');
    condicional = 0;
  } else {
    menuMobile.classList.add('opacity-0', 'translate-y-full', 'md:translate-x-full');
    menuMobile.classList.remove('opacity-100', 'translate-y-0', 'md:translate-x-0');
    condicional = 1;

    setTimeout(() => {
      menuMobile.classList.add('hidden');
    }, 500);
  }
};



function mobileMenu(){
   const mobileMenu = document.getElementById('mobileMenu')

    mobileMenu.innerHTML  = 
    /*html*/
    `
    
      <button onclick="openMenu()" class="absolute top-4 right-4">
         <i class="fas fa-times w-6 h-6"></i>
        </button>
        <div class="mt-16 px-6 space-y-4">
            <a href="../main.php" class="block text-lg font-semibold text-gray-800 dark:text-gray-100">Início</a>
            <a href="../cadastros/cadastros.php" class="block text-lg font-semibold text-gray-800 dark:text-gray-100">Cadastros</a>
            <a href="../pedidos/cadastrodepedidos.php" class="block text-lg font-semibold text-gray-800 dark:text-gray-100">Pedidos</a>
            <a href="../relatorios/relatorios.php" class="block text-lg font-semibold text-gray-800 dark:text-gray-100">Relatórios</a>
            <a href="cadastro.php" class="block text-lg font-semibold text-gray-800 dark:text-gray-100">Pré Embarque</a>
            <a href="../packingList/cadastropackinglist.php" class="block text-lg font-semibold text-gray-800 dark:text-gray-100">Packing List</a>
        </div>
    `
}

mobileMenu()