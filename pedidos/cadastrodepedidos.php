<?php
    include '../generalPhp/conection.php';
    if(!isset($_SESSION)) {
        session_start();
    }
    if(!isset($_SESSION['id'])) {
        die( header("Location: ../index.php"));
    }
?>

<!DOCTYPE html>
<html lang="pt-br" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="nofollow,noindex">
    <link rel="shortcut icon" href="../assets/favicon.svg" type="image/x-icon">
    <title>Cadastro Pedidos</title>

    <!-- Tailwind CSS + Scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <script>
        tailwind.config = {
            darkMode: 'class'
        }
    </script>
    <!-- Toastify -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <!-- Extras -->
    <link rel="stylesheet" href="../onLoad/onLoad.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="../onLoad/onLoad.js"></script>
</head>

<body class="bg-white text-gray-900 dark:bg-gray-900 dark:text-white font-sans h-[100vh]" onload="onLoad()">
    <!-- Loader -->
    <div class="fixed inset-0 flex items-center justify-center bg-white dark:bg-gray-900 z-50" id="preload">
        <div class="animate-spin rounded-full h-16 w-16 border-b-4 border-green-500"></div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobileMenu" class="fixed bottom-0 md:top-0 md:right-0 w-full md:w-[20%] backdrop-blur-md h-[60%] md:h-full bg-white/90 dark:bg-gray-800/90 shadow-lg transform translate-y-full md:translate-x-full opacity-0 hidden z-50 transition duration-500">
        <button onclick="openMenu()" id="mobileMenuButtonClose" class="absolute top-4 right-4">
            <img src="../assets/x.svg" alt="Fechar menu" class="w-6 h-6">
        </button>
        <div class="p-6 space-y-4">
            <a href="../main.php" class="block font-bold text-gray-900 dark:text-white">INÍCIO</a>
            <a href="../cadastros/cadastros.php" class="block font-bold text-gray-900 dark:text-white">CADASTROS</a>
            <a href="../pedidos/cadastrodepedidos.php" class="block font-bold text-gray-900 dark:text-white">PEDIDOS</a>
            <a href="../relatorios/relatorios.php" class="block font-bold text-gray-900 dark:text-white">RELATÓRIOS</a>
            <a href="../inspessao/cadastro.php" class="block font-bold text-gray-900 dark:text-white">INSPEÇÃO</a>
            <a href="../packingList/cadastropackinglist.php" class="block font-bold text-gray-900 dark:text-white">PACKING LIST</a>
        </div>
    </div>

    <!-- Header -->
    <header class="bg-green-700 dark:bg-green-800 text-white flex items-center justify-between px-4 py-3 shadow sticky top-0 z-40">
        <div class="flex items-center gap-4">
            <a href="../main.php" class="hover:opacity-80 transition">
                <img src="../assets/backArrow.svg" alt="Voltar" class="w-6 h-6">
            </a>
            <h1 class="text-lg font-semibold">Cadastro Pedidos</h1>
        </div>
        <div class="flex items-center gap-4">
            <button onclick="toggleTheme()" title="Alternar tema" class="text-xl text-yellow-500 hover:text-yellow-400 transition">
                <i class="fas fa-circle-half-stroke"></i>
            </button>
            <button onclick="openMenu()" id="mobileMenuButton" class="hover:opacity-80 transition">
                <img src="../assets/menu_mobile.svg" alt="Menu" class="w-7 h-7">
            </button>
        </div>
    </header>

    <!-- Botão Novo Pedido e Campo de busca -->
    <section class="p-4 bg-white dark:bg-gray-800 rounded-md shadow-md mx-2 mt-4 space-y-4">
        <form id="cadastroForm">
            <a href="pedidos/cadastro.html">
                <div class="w-full text-center bg-green-600 hover:bg-green-700 transition text-white py-2 px-4 rounded cursor-pointer font-semibold">
                    NOVO PEDIDO +
                </div>
            </a>
        </form>
        <form method="POST" id="form-pesquisa">
            <input type="text" name="pesquisa" id="pesquisa" placeholder="Buscar"
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white rounded focus:outline-none focus:ring-2 focus:ring-green-600" />
        </form>
    </section>

    <!-- Lista -->
    <section id="containerList" class="p-4"></section>

    <!-- Rodapé -->
    <footer class="text-center py-6 text-sm text-gray-500 dark:text-gray-400">
        <p id="data-footer"></p>
    </footer>

    <!-- Scripts -->
    <script src="../generalScripts/toastify.js"></script>
    <script src="../generalScripts/darkmode.js"></script>
    <script src="../mobileMenu/js/mobileMenu.js"></script>
    <script src="../generalScripts/version.js"></script>
    <script src="../generalScripts/backPage.js"></script>
    <script src="listar.js"></script>
    <script src="../pedidos/busca.js"></script>
</body>
</html>
