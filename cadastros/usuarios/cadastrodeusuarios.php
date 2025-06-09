<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="robots" content="nofollow,noindex">
  <link rel="shortcut icon" href="../../assets/favicon.svg" type="image/x-icon">
  <title>Cadastro Usuários</title>

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      darkMode: 'class'
    }
  </script>
  <script src="../../onLoad/onLoad.js"></script>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <!-- Scripts e Estilos Gerais -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
</head>

<body class="bg-white text-gray-900 dark:bg-gray-900 dark:text-white" onload="onLoad()">
  <!-- Preloader -->
  <div id="preload" class="fixed inset-0 flex items-center justify-center bg-white dark:bg-gray-900 z-50">
    <div class="animate-spin rounded-full h-16 w-16 border-b-4 border-green-500"></div>
  </div>

  <!-- Header -->
  <header class="flex flex-col lg:flex-row justify-between items-start lg:items-center p-4 shadow-md">
    <div class="flex items-center gap-4 w-full lg:w-auto">
      <a href="../cadastros.php" class="text-white hover:underline flex items-center gap-2">
        <i class="fas fa-arrow-left"></i> Voltar
      </a>
     
    </div>

    <form id="cadastroForm" class="flex flex-col lg:flex-row gap-4 mt-4 lg:mt-0">
      <div class="flex flex-col">
        <label for="nome">USUÁRIO</label>
        <input id="nome" name="nome" placeholder="USUÁRIO" type="text" required class="input" />
      </div>
      <div class="flex flex-col">
        <label for="senha">SENHA</label>
        <input id="senha" name="senha" placeholder="SENHA" type="password" required class="input" />
      </div>
      <div class="flex flex-col">
        <label for="senha1">REPITA A SENHA</label>
        <input id="senha1" name="senha_confirmada" placeholder="REPITA A SENHA" type="password" required class="input" />
      </div>
      <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">SALVAR <i class="fas fa-save ml-2"></i></button>
    </form>
  </header>

  <!-- Busca -->
  <section class="p-4">
    <form method="POST" id="form-pesquisa" action="" class="mb-4">
      <input type="text" name="pesquisa" id="pesquisa" placeholder="Buscar" class="w-full p-2 border border-gray-300 rounded dark:bg-gray-800" />
    </form>

    <!-- Listagem -->
    <section id="containerList" class="grid gap-4"></section>
  </section>

  <!-- Footer -->
  <footer class="p-4 text-center border-t border-gray-300 dark:border-gray-700">
    <p id="data-footer"></p>
  </footer>

  <!-- Scripts Gerais -->
  <script src="../../generalScripts/toastify.js"></script>
  <script src="../../generalScripts/darkmode.js"></script>
  <script src="../../mobileMenu/js/mobileMenu.js"></script>
  <script src="../../generalScripts/version.js"></script>
  <script src="../../generalScripts/backPage.js"></script>
  <script src="cadastro.js"></script>
  <script src="listar.js"></script>
  <script src="busca.js"></script>
</body>

</html>
