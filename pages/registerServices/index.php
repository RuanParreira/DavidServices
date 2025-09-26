<!DOCTYPE html>
<html lang="pt-br">
<?php
require __DIR__ . '/../../src/backend/functions/geral.php';
require __DIR__ . '/../../src/backend/registerServices/listAll.php';
require __DIR__ . '/../../src/includes/menu_state.php';
?>

<head>
    <?php require __DIR__ . '/../../src/includes/head.php'; ?>
    <title>DashBoard</title>
</head>

<body>
    <main class="<?= $mainPagesClass ?>">
        <?php include __DIR__ . '/../../src/includes/menu.php'; ?>
        <!-- Mensagem de Sucesso ou Erro-->
        <?php include __DIR__ . '/../../src/includes/resultMessage.php'; ?>

        <!-- Conteudo Da Pagina -->
        <div class="cont-page">
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
                        <?php if (empty($resultClients) && empty($resultTechnicians)): ?>
                            <div class="layer-nCadastro">
                                <i class="bi bi-exclamation-triangle"></i>
                                <p>
                                    É necessário cadastrar pelo menos um cliente e um técnico antes de criar um serviço.
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
                                            <input type="text" name="name" id="search-client" class="input-client-services" placeholder="Pesquisar cliente pelo nome, CPF ou número" maxlength="100">
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
                                    <input type="text" id="equipment" name="equipment" class="input-equipamento-services" placeholder="Ex: Notebook Dell, Smartphone Samsung..." autocomplete="off" maxlength="100">
                                </div>
                                <!-- Data do Serviço -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="technical" class="subtitulo-default-services">
                                            Técnico Responsável
                                        </label>
                                        <div class="relative">
                                            <i class="bi bi-people absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-lg"></i>
                                            <select name="id_technical" id="technical" class="w-full pl-8 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent">
                                                <option value="">Selecione um Técnico</option>
                                                <?php foreach ($resultTechnicians as $technical): ?>
                                                    <option value="<?= htmlspecialchars($technical['id']) ?>">
                                                        <?= htmlspecialchars(getFirstTwoNames($technical['name'])) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div>
                                        <label for="date" class="subtitulo-default-services ">
                                            Data
                                        </label>
                                        <input type="date" id="date" name="date" class="date-services" value="<?php echo htmlspecialchars(date('Y-m-d')); ?>">
                                    </div>
                                </div>
                                <!-- Problema Detectado -->
                                <div>
                                    <label for="problem" class="subtitulo-default-services ">
                                        Problema Detectado
                                    </label>
                                    <textarea rows="3" name="problem" id="problem" class="input-problem-services" placeholder="Descreva o problema reportado pelo cliente..." maxlength="255"></textarea>
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
    <script src="../../src/scripts/autoComplete.js"></script>
    <?php include __DIR__ . '../../../src/includes/scripts.php' ?>
</body>

</html>