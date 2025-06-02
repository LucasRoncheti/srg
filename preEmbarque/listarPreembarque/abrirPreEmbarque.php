<?php
include '../../generalPhp/conection.php';

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['id'])) {
    die(header("Location: ../../index.php"));
}

if (isset($_GET['id']) && isset($_GET['nome'])) {
    $id = $_GET['id'];
    $nome = $_GET['nome'];

    $numero_container = $_GET['numero_container'];

    $stmt = $conn->prepare("SELECT * FROM pre_embarque WHERE uniqId = ?");
    $stmt->bind_param("s", $id);
    if (!$stmt->execute()) {
        die("Erro ao executar consulta: " . $stmt->error);
    }
    $result = $stmt->get_result();
} else {
    header("Location:../preEmbarque.php");
}
?>

<!DOCTYPE html>
<html lang="pt-br" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../assets/favicon.svg" type="image/x-icon">
    <meta name="robots" content="nofollow,noindex">

    <title>Pre Embarque</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class'
        }
    </script>

    <link rel="shortcut icon" href="../../assets/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="../../onLoad/onLoad.css">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

        <script src="../../generalScripts/darkmode.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
</head>

<body class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-100 min-h-screen" onload="onLoad()">

<div id="loader" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
  <div class="w-16 h-16 border-4 border-white border-t-transparent rounded-full animate-spin"></div>
</div>


    <!-- Preloader -->
    <div class="overflow white" id="preload">
        <div class="circle-line">
            <div class="circle-red"></div>
            <div class="circle-blue"></div>
            <div class="circle-green"></div>
            <div class="circle-yellow"></div>
        </div>
    </div>
    <!-- Header -->
    <header class="flex items-center justify-between p-4 bg-green-700 dark:bg-green-800 text-white">
        <a href="../preEmbarque.php">
            <img src="../../assets/backArrow.svg" alt="Voltar" class="w-6 h-6">
        </a>
        <div class="text-center flex-1">
            <h3 class="text-lg font-semibold"><?= $nome ?> </h3>
        </div>
        <div>
            <!-- <a href="../listarPedido/print/printInspessao.php?id=<?= $id ?>&numero=<?= $numero ?>&cliente=<?= $cliente ?>&numero_container=<?= $numero_container ?>">
                <img src="../../assets/print.svg" alt="Imprimir" class="w-6 ml-4">
            </a> -->
        </div>
    </header>

    <!-- Adicionar Imagens por Fornecedor -->
    <section class="p-4 flex flex-col items-center justify-center text-center">
        <form id="formPreEmbarque" action="submit" class=
        "flex flex-col space-y-4 w-full max-w-xl">
            <!-- Campos gerados dinamicamente -->


        <div class="flex justify-center w-full mt-4">
        <button
            type="submit"
            class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded">
            Enviar Dados
        </button>
        </div>

        </form>

    </section>





    <footer class="text-center py-4 text-sm text-gray-500 dark:text-gray-400">
        <p id="data-footer"></p>
    </footer>

    <script src="../../onLoad/onLoad.js"></script>
    <script src="../../mobileMenu/js/mobileMenu.js"></script>
    <script src="../../generalScripts/version.js"></script>
    <script src="../../generalScripts/backPage.js"></script>
    <script src="upload.js"></script>
    <script src="apagarImg.js"></script>
    <script src="abrirImgHD.js"></script>

    <script>
        function reload() {
            window.location.reload();
        }

        function teste(id) {
            document.getElementById(id).click();
        }

        function adicionarProdutor() {
            const chaveAcesso = document.getElementById('chaveAcesso').value;
            const fornecedor = document.getElementById('fornecedor').value;
            const imagem = document.getElementById('imagemFornecedor').files[0];

            if (!imagem) {
                alert("Você precisa tirar uma foto primeiro.");
                return;
            }

            const formData = new FormData();
            formData.append('chaveAcesso', chaveAcesso);
            formData.append('fornecedor', fornecedor);
            formData.append('imagem', imagem);

            fetch('adicionarProdutor.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    alert(data);
                    reload();
                })
                .catch(error => {
                    console.error('Erro:', error);
                });
        }

        function deleteProdutorInspecao(id) {
            const formData = new FormData();
            formData.append('idItem', id);

            fetch('deletarProdutorInspecao.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    console.log(data);
                    reload();
                })
                .catch(error => {
                    console.error('Erro:', error);
                });
        }
    </script>

    <script>
        const uniqId = "<?= $id ?>"; // vindo do PHP via GET

        const camposPreEmbarque = [{
                nome: "Número do container",
                tipo: "foto"
            },
            {
                nome: "Número do lacre definitivo",
                tipo: "foto"
            },
            {
                nome: "Número do lacre provisório",
                tipo: "foto"
            },
            {
                nome: "Número do termógrafo",
                tipo: "foto"
            },
            {
                nome: "Verificar se o termógrafo está ligado corretamente",
                tipo: "video"
            },
            {
                nome: "Inserir as horas após ligar o termógrafo",
                tipo: "escrito"
            },
            {
                nome: "Placa do veículo",
                tipo: "foto"
            },
            {
                nome: "Hora de chegada do motorista",
                tipo: "escrito"
            },
            {
                nome: "Hora de saída do motorista",
                tipo: "escrito"
            },
            {
                nome: "Verificar se há avarias",
                tipo: "video"
            },
            {
                nome: "Verificar obstruções no dreno do container",
                tipo: "video"
            },
            {
                nome: "Número de nota fiscal de saída da empresa",
                tipo: "foto"
            },
            {
                nome: "Número de pedido",
                tipo: "foto"
            },
        ];

        const form = document.getElementById("formPreEmbarque");

        // cria os campos inputs 
        camposPreEmbarque.forEach((campo, index) => {
            const wrapper = document.createElement("div");
            wrapper.className = "flex flex-col items-center gap-2 w-full";

            const label = document.createElement("label");
            label.textContent = campo.nome;
            label.className = "text-sm font-semibold text-center";

            const nomeCampo = document.createElement("input");
            nomeCampo.type = "hidden";
            nomeCampo.name = `campo_${index}_nome`;
            nomeCampo.value = campo.nome;
            wrapper.appendChild(nomeCampo);


            wrapper.appendChild(label);

            const preview = document.createElement("div");
            preview.className = "mt-2 w-full max-w-md";
            wrapper.appendChild(preview);


       


            if (campo.tipo === "escrito") {
                const input = document.createElement("input");
                input.name = `campo_${index}`;
                input.type = "text";
                input.className = "w-full max-w-md p-2 border rounded dark:bg-gray-800 dark:border-gray-600";
                wrapper.appendChild(input);
            } else {
                // Input padrão (galeria)
                const inputGaleria = document.createElement("input");
                inputGaleria.name = `campo_${index}_galeria`;
                inputGaleria.type = "file";
                inputGaleria.accept = campo.tipo === "foto" ? "image/*" : "video/*";
                inputGaleria.className =
                    "file:bg-gray-300 file:rounded file:px-4 file:py-2 text-sm text-gray-700 dark:text-gray-300";
                wrapper.appendChild(inputGaleria);

                // Input escondido (tirar da câmera)
                const inputCamera = document.createElement("input");
                inputCamera.name = `campo_${index}_camera`;
                inputCamera.type = "file";
                inputCamera.accept = campo.tipo === "foto" ? "image/*" : "video/*";
                inputCamera.capture = "environment";
                inputCamera.style.display = "none";
                inputCamera.id = `input_${index}_camera`;

                const botaoCamera = document.createElement("button");
                botaoCamera.type = "button";
                botaoCamera.className =
                    campo.tipo === "foto" ?
                    "bg-blue-600 hover:bg-blue-700 w-full max-w-md text-white px-4 py-2 rounded" :
                    "bg-purple-600 hover:bg-purple-700 w-full max-w-md text-white px-4 py-2 rounded";
                botaoCamera.textContent = campo.tipo === "foto" ? "Tirar Foto" : "Gravar Vídeo";
                botaoCamera.onclick = () => document.getElementById(`input_${index}_camera`).click();

                wrapper.appendChild(inputCamera);
                wrapper.appendChild(botaoCamera);

                     [inputGaleria, inputCamera].forEach((inputEl) => {
                inputEl.addEventListener("change", () => {
                    const file = inputEl.files?.[0];
                    if (!file) return;

                    preview.innerHTML = ""; // Limpa preview anterior

                    if (file.type.startsWith("image/")) {
                        const img = document.createElement("img");
                        img.src = URL.createObjectURL(file);
                        img.className = "w-full rounded border mt-2";
                        preview.appendChild(img);
                    } else if (file.type.startsWith("video/")) {
                        const video = document.createElement("video");
                        video.src = URL.createObjectURL(file);
                        video.controls = true;
                        video.className = "w-full rounded border mt-2";
                        preview.appendChild(video);
                    }
                });
            });
            }

            form.appendChild(wrapper);
        });


        form.addEventListener("submit", async function(e) {
            e.preventDefault();

            const formData = new FormData();
            formData.append("uniqId", uniqId);

            const inputs = form.querySelectorAll("input, textarea, select");

            for (let input of inputs) {
                const name = input.name;
                const type = input.type;
                const file = input.files?.[0];

                if (type === "file" && file) {
                    if (file.type.startsWith("image/")) {
                        const imagemRedimensionada = await redimensionarImagemComCanvas(file);
                        formData.append(name, imagemRedimensionada, `${uniqId}_${name}.jpg`);
                    } else if (file.type.startsWith("video/")) {
                        formData.append(name, file, `${uniqId}_${name}.mp4`);
                    }
                } else if (
                    type === "text" ||
                    input.tagName === "TEXTAREA" ||
                    input.tagName === "SELECT"
                ) {
                    formData.append(name, input.value);
                }

            }

            salvarImagens(formData);
        });


        async function redimensionarImagemComCanvas(file, largura = 600, qualidade = 0.8) {
            return new Promise((resolve) => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = new Image();
                    img.src = e.target.result;
                    img.onload = function() {
                        const canvas = document.createElement("canvas");

                        const aspectRatio = img.width / img.height;
                        canvas.width = largura;
                        canvas.height = largura / aspectRatio;

                        const ctx = canvas.getContext("2d");
                        ctx.drawImage(img, 0, 0, canvas.width, canvas.height);

                        canvas.toBlob((blob) => {
                            resolve(blob);
                        }, "image/jpeg", qualidade);
                    };
                };
                reader.readAsDataURL(file);
            });
        }
    </script>

    <script>
  async function salvarImagens(formData) {
    mostrarLoader(); // mostra o loader

    try {
        const response = await fetch("upload.php", {
            method: "POST",
            body: formData,
        });

        if (!response.ok) {
            throw new Error("Erro ao enviar dados.");
        }

        const data = await response.text();
        toastifyMessage("Pré-embarque salvo com sucesso!");
        form.reset();
        // Atualize ou recarregue dados conforme necessário
    } catch (error) {
        console.error(error);
        toastifyMessage("Falha ao enviar os dados.",'error');
    } finally {
        esconderLoader(); // esconde o loader
    }
}


        function mostrarLoader() {
    document.getElementById('loader').classList.remove('hidden');
}

function esconderLoader() {
    document.getElementById('loader').classList.add('hidden');
}

    </script>

        <script  src="../../generalScripts/toastify.js"></script>

        
</body>


</html>