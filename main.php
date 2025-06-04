<?php
    include 'generalPhp/conection.php';
    include 'protect.php';
?>

<!DOCTYPE html>
<html lang="pt-br" class="">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="robots" content="noindex, nofollow" />
      <link rel="shortcut icon" href="assets/favicon.svg" type="image/x-icon">
  <title>Sistema de Cadastros</title>

  <!-- Tailwind + Font Awesome -->
  <script src="https://cdn.tailwindcss.com"></script>
    <script>
    tailwind.config = {
        darkMode: 'class'
    }
    </script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />


  <!-- Script dark mode --> 
    <script src="generalScripts/darkmode.js"></script>
  <script src="onLoad/onLoad.js"></script>
</head>

<body class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-100 font-sans" onload="onLoad()">

  <!-- Preloader -->
  <div class="overflow white" id="preload">
    <div class="circle-line">
      <div class="circle-red">&nbsp;</div>
      <div class="circle-blue">&nbsp;</div>
      <div class="circle-green">&nbsp;</div>
      <div class="circle-yellow">&nbsp;</div>
    </div>
  </div>

  <!-- Cabeçalho -->
  <header class="bg-white dark:bg-gray-800 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 py-6 flex justify-between items-center">
      <div class="flex items-center gap-4">
        <img src="./assets/logoLogin.png" alt="Logo" class="w-14 h-11" />
        <div>
          <h1 class="text-xl font-semibold text-green-700 dark:text-green-400">Sistema de Cadastros e Relatórios</h1>
          <p id="data-hora" class="text-sm text-gray-500 dark:text-gray-400">Segunda-feira | 13:13</p>
        </div>
      </div>

      <div class="flex items-center gap-4">
        <!-- Botão tema -->
        <button onclick="toggleTheme()" title="Alternar tema" class="text-xl text-yellow-500 hover:text-yellow-400 transition">
          <i class="fas fa-circle-half-stroke"></i>
        </button>

        <!-- Botão sair -->
        <a href="logout.php" title="Sair" class="text-red-500 hover:text-red-600 text-xl">
          <i class="fas fa-sign-out-alt"></i>
        </a>
      </div>
    </div>
  </header>

  <!-- Conteúdo Principal -->
  <main class="max-w-7xl mx-auto px-4 py-12">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-6">
      <a href="cadastros/cadastros.php" class="bg-white dark:bg-gray-800 hover:bg-green-50 dark:hover:bg-green-900 border border-gray-200 dark:border-gray-700 rounded-xl shadow-sm p-6 flex flex-col items-center justify-center gap-4 transition-all duration-200">
        <img src="assets/categories/cadastro.svg" alt="Cadastro" class="w-8 h-8" />
        <span class="text-green-800 dark:text-green-400 font-semibold">CADASTROS</span>
      </a>

      <a href="pedidos/cadastrodepedidos.php" class="bg-white dark:bg-gray-800 hover:bg-green-50 dark:hover:bg-green-900 border border-gray-200 dark:border-gray-700 rounded-xl shadow-sm p-6 flex flex-col items-center justify-center gap-4 transition-all duration-200">
        <img src="assets/categories/pedidos.svg" alt="Pedidos" class="w-8 h-8" />
        <span class="text-green-800 dark:text-green-400 font-semibold">PEDIDOS</span>
      </a>

      <a href="relatorios/relatorios.php" class="bg-white dark:bg-gray-800 hover:bg-green-50 dark:hover:bg-green-900 border border-gray-200 dark:border-gray-700 rounded-xl shadow-sm p-6 flex flex-col items-center justify-center gap-4 transition-all duration-200">
        <img src="assets/categories/relatorios.svg" alt="Relatórios" class="w-8 h-8" />
        <span class="text-green-800 dark:text-green-400 font-semibold">RELATÓRIOS</span>
      </a>

      <a href="inspessao/cadastro.php" class="bg-white dark:bg-gray-800 hover:bg-green-50 dark:hover:bg-green-900 border border-gray-200 dark:border-gray-700 rounded-xl shadow-sm p-6 flex flex-col items-center justify-center gap-4 transition-all duration-200">
        <img src="assets/categories/inspessao.svg" alt="Inspeção" class="w-8 h-8" />
        <span class="text-green-800 dark:text-green-400 font-semibold">INSPEÇÃO</span>
      </a>

      <a href="preEmbarque/preEmbarque.php" class="bg-white dark:bg-gray-800 hover:bg-green-50 dark:hover:bg-green-900 border border-gray-200 dark:border-gray-700 rounded-xl shadow-sm p-6 flex flex-col items-center justify-center gap-4 transition-all duration-200">
        <img src="assets/categories/inspessao.svg" alt="Pré Embarque" class="w-8 h-8" />
        <span class="text-green-800 dark:text-green-400 font-semibold">PRÉ EMBARQUE</span>
      </a>

      <a href="packingList/cadastropackinglist.php" class="bg-white dark:bg-gray-800 hover:bg-green-50 dark:hover:bg-green-900 border border-gray-200 dark:border-gray-700 rounded-xl shadow-sm p-6 flex flex-col items-center justify-center gap-4 transition-all duration-200">
        <img src="assets/categories/packing_list.svg" alt="Packing List" class="w-8 h-8" />
        <span class="text-green-800 dark:text-green-400 font-semibold">PACKING LIST</span>
      </a>
    </div>
  </main>

  <!-- Rodapé -->
  <footer class="text-center py-4 text-sm text-gray-500 dark:text-gray-400 md:fixed md:bottom-0 md:left-1/2 md:-translate-x-1/2 w-full bg-gray-100 dark:bg-gray-900">
  
    <a target="_blank" href="https://www.lucasrd.site">
        <p id="data-footer"></p>
    </a>
  </footer>

  <!-- Scripts -->
  <script src="generalScripts/version.js"></script>
  <script src="generalScripts/timeFormat.js"></script>

</body>
</html>
