<!DOCTYPE html>
<html lang="pt-br">
<?php
require __DIR__ . '/../../src/backend/functions/geral.php';
require __DIR__ . '/../../src/backend/registerClients/listClients.php';
?>

<head>
    <?php require __DIR__ . '/../../src/includes/head.php'; ?>
    <title>DashBoard</title>
</head>

<body>
    <main class="main-pages">
        <?php include __DIR__ . '/../../src/includes/menu.php'; ?>
        <!-- Mensagem de Sucesso ou Erro-->
        <?php include __DIR__ . '/../../src/includes/resultMessage.php'; ?>

        <!-- Conteudo Da Pagina -->
        <div class="p-6 h-full">
            <div class="space-y-6 h-full">
                <!-- Titulo -->
                <div class="layer-titulo">
                    <i class="bi bi-clipboard-plus"></i>
                    <h2>
                        Cadastrar Serviço
                    </h2>
                </div>
                <!-- Conteudo Da Pagina -->
                <div class="flex justify-center">
                    <div class="layer-form-services ">
                        <h2 class="titulo-form-services ">
                            Novo Serviço
                        </h2>
                        <!-- Se não houver clientes cadastrados, não será possível cadastrar um serviço. -->
                        <?php if (empty($resultClients)): ?>
                            <div class="layer-nCadastro">
                                <i class="bi bi-exclamation-triangle"></i>
                                <p>
                                    É necessário cadastrar pelo menos um cliente antes de criar um serviço.
                                </p>
                            </div>
                        <?php else: ?>
                            <form action="../../src/backend/registerServices/register.php" class="space-y-4" method="POST" autocomplete="off">
                                <div>
                                    <label for="search-client" class="subtitulo-default-services ">
                                        Cliente
                                    </label>
                                    <!-- Pega o Cliente Com o AutoComplete -->
                                    <div class="relative">
                                        <div class="relative">
                                            <i class="bi bi-search icon-search-services"></i>
                                            <input type="text" name="name" id="search-client" class="input-client-services" placeholder="Pesquisar cliente pelo nome, CPF ou número">
                                        </div>
                                        <div id="suggestion-container"
                                            class="hidden suggestion-clients-services">
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="id_client" id="selected-client-id" value="ID_DO_CLIENTE">
                                <!-- Equipamento do cliente -->
                                <div>
                                    <label for="equipment" class="subtitulo-default-services ">
                                        Equipamento
                                    </label>
                                    <input type="text" id="equipment" name="equipment" class="input-equipamento-services" placeholder="Ex: Notebook Dell, Smartphone Samsung..." autocomplete="off">
                                </div>
                                <!-- Problema Detectado -->
                                <div>
                                    <label for="problem" class="subtitulo-default-services ">
                                        Problema Detectado
                                    </label>
                                    <textarea rows="3" name="problem" id="problem" class="input-problem-services" placeholder="Descreva o problema reportado pelo cliente..." /></textarea>
                                </div>
                                <!-- Data do Serviço -->
                                <div>
                                    <label for="" class="subtitulo-default-services ">
                                        Data
                                    </label>
                                    <input type="date" name="date" class="date-services" value="<?php echo htmlspecialchars(date('Y-m-d')); ?>">
                                </div>
                                <button type="submit" class="btn-enviar-services">
                                    Cadastrar Serviço
                                </button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="../../src/scripts/registerServices.js"></script>
    <script src="../../src/scripts/resultMessage.js"></script>
</body>

</html>