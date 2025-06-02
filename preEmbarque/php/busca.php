<?php
//Incluir a conexão com banco de dados
include '../../generalPhp/conection.php';
if (!isset($_SESSION)) {
	session_start();
}

if (!isset($_SESSION['id'])) {
	die(header("Location: ../index.php"));
}


//Recuperar o valor da palavra
$busca = $_POST['palavra'];

//Pesquisar no banco de dados nome do curso referente a palavra digitada pelo usuário
$sql = "SELECT * FROM pre_embarque WHERE name  LIKE '%$busca%'";
$resultado_sql = mysqli_query($conn, $sql);




if (mysqli_num_rows($resultado_sql) <= 0) {
	echo '
<div class="flex flex-col items-center justify-center text-center my-12 text-gray-700 dark:text-gray-300">
  <img src="../assets/notFound.svg" alt="Não encontrado" class="w-24 h-24 mb-4" />
  <h3 class="text-lg font-semibold">PEDIDO NÃO ENCONTRADO</h3>
</div>

		
		';
} else {



	while ($row_sql = mysqli_fetch_assoc($resultado_sql)) :
		$dataFormatada = date('d/m/y', strtotime($row_sql['data']));
		$id = $row_sql['id'];
		$container = $row_sql['container'];
		$nome = $row_sql['name'];
		$dataOriginal = $row_sql['data'];
?>
		<div class="flex justify-between items-center bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-4 mb-4 shadow-sm">
			<div class="flex flex-col text-sm text-gray-700 dark:text-gray-300">
				<span class="text-xs">N° Cont. <?= htmlspecialchars($container) ?></span>
				<span>Data <?= $dataFormatada ?></span>
			</div>

			<div class="flex-1 text-center text-green-800 dark:text-green-400 font-semibold">
				<?= htmlspecialchars($nome) ?>
			</div>

			<div class="flex gap-3 items-center">
				<a title="Abrir" href="../inspessao/listarPedido/salvarInspessao.php?id=<?= urlencode($id) ?>&numero=<?= urlencode($id) ?>&cliente=<?= urlencode($nome) ?>&numero_container=<?= urlencode($container) ?>">
					<img src="../assets/file_green.svg" alt="Visualizar">
				</a>

				<img title="Deletar" src="../assets/erase.svg"
					alt="Apagar"
					class="cursor-pointer hover:opacity-75"
					onclick="deletar('<?= $id ?>')">

				<img title="Editar" src="../assets/edit.svg"
					alt="Editar"
					class="cursor-pointer hover:opacity-75"
					onclick="editarPreEmbarque('<?= $id ?>', '<?= addslashes($nome) ?>', '<?= addslashes($container) ?>', '<?= $dataOriginal ?>')">
			</div>
		</div>
<?php
	endwhile;
}
?>