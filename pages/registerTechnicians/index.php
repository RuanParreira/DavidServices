<!DOCTYPE html>
<html lang="pt-br">

<?php
require __DIR__ . '/../../src/backend/functions/geral.php';
require __DIR__ . '/../../src/backend/registerTechnicians/list.php';
require __DIR__ . '/../../src/includes/menu_state.php';
?>

<head>
    <?php require __DIR__ . '/../../src/includes/head.php'; ?>
    <title>Registrar Técnicos</title>
</head>

<body>
    <main class="<?= $mainPagesClass ?>">
        <?php include __DIR__ . '/../../src/includes/menu.php'; ?>
        <!-- Mensagem de Sucesso -->
        <?php include __DIR__ . '/../../src/includes/resultMessage.php'; ?>

        <!-- Conteudo Da Pagina -->
        <div class="cont-page">
            <div class="space-y-6 h-full">
                <!-- Titulo -->
                <div class="layer-titulo">
                    <i class="bi bi-people text-3xl"></i>
                    <h2>
                        Registrar Técnicos
                    </h2>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 py-6 px-[4%] lg:px-6">
                        <div class="flex items-center gap-3 mb-6">
                            <i class="bi bi-people text-blue-600 text-2xl"></i>
                            <h2 class="text-xl font-semibold text-gray-900">Novo Técnico</h2>
                        </div>
                        <form method="post" action="../../src/backend/registerTechnicians/register.php" class="space-y-4" autocomplete="off">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                    Nome Completo
                                </label>
                                <input type="text" name="name" id="name" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-colors" placeholder="Digite o nome completo" maxlength="100">
                            </div>
                            <div>
                                <label for="cpf" class="block text-sm font-medium text-gray-700 mb-2">
                                    CPF
                                </label>
                                <div class="relative">
                                    <i class="bi bi-person-vcard absolute left-3 top-1/2 transform -translate-y-1/2  text-gray-400 text-lg"></i>
                                    <input type="text" name="cpf" id="cpf" class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-colors" placeholder="Digite o CPF">
                                </div>
                            </div>
                            <div>
                                <label for="number" class="block text-sm font-medium text-gray-700 mb-2">
                                    Contato
                                </label>
                                <div class="relative">
                                    <i class="bi bi-telephone absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-lg"></i>
                                    <input type="text" name="number" id="number" class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-colors" placeholder="Telefone, WhatsApp">
                                </div>
                            </div>
                            <button type="submit" class="mt-1 mb-1 w-full bg-blue-600 text-white px-4 py-2.5 rounded-lg font-medium hover:bg-blue-700 transition-colors cursor-pointer">
                                Cadastrar Técnico
                            </button>
                        </form>
                    </div>
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 py-6 px-[4%] lg:px-6">
                        <div class="flex items-center mb-6">
                            <i class="bi bi-person text-blue-600 text-2xl"></i>
                            <h2 class="text-xl font-semibold text-gray-900">
                                Técnicos Cadastrados
                            </h2>
                        </div>
                        <!-- Campo de Busca dos Clientes -->
                        <form method="get" class="mb-6 flex items-center space-x-4" autocomplete="off">
                            <div class="relative w-full">
                                <i class="bi bi-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-lg"></i>
                                <input type="text" name="search" id="searchInput" class="input-search-client" placeholder="Buscar por nome ou CPF"
                                    value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>" maxlength="100">
                            </div>
                            <div class="flex space-x-2">
                                <?php if (!empty($search)) : ?>
                                    <div>
                                        <button type="button" id="clearSearchBtn" class="btn-limpar-busca">
                                            <i class="bi bi-trash text-xl"></i>
                                        </button>
                                    </div>
                                <?php endif; ?>
                                <button type="submit" class="btn-buscar">
                                    <i class="bi bi-search"></i>
                                    <span class="hidden lg:block">Buscar</span>
                                </button>
                            </div>
                        </form>
                        <div class="space-y-3 max-h-96 overflow-y-auto">
                            <?php if (empty($resultTechnicians)): ?>
                                <div class="text-center py-8">
                                    <i class="bi bi-people text-gray-400 mx-auto text-6xl"></i>
                                    <p class="text-gray-500 mt-3">Nenhum técnico cadastrado ainda</p>
                                </div>
                            <?php else: ?>
                                <?php foreach ($resultTechnicians as $technical): ?>
                                    <div class="cont-cards-client group">
                                        <div class="flex justify-between">
                                            <h3 class="font-semibold text-gray-900 mb-1">
                                                <?= htmlspecialchars($technical['name']); ?>
                                            </h3>
                                            <div class="flex space-x-2">
                                                <div>
                                                    <!-- Adicione um id ao botão de editar e um atributo data-id para identificar o cliente -->
                                                    <button
                                                        type="button"
                                                        class="cursor-pointer lg:opacity-0 lg:group-hover:opacity-100 transition-all text-blue-600 hover:text-blue-800 btn-edit-client"
                                                        data-id="<?= htmlspecialchars($technical['id']); ?>"
                                                        data-name="<?= htmlspecialchars($technical['name']); ?>"
                                                        data-number="<?= htmlspecialchars($technical['number']); ?>">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </button>
                                                </div>
                                                <form action="../../src/backend/registerTechnicians/delete.php" method="POST">
                                                    <input type="hidden" name="technical_id" value="<?= htmlspecialchars($technical['id']); ?>">
                                                    <button type="submit" class="cursor-pointer lg:opacity-0 lg:group-hover:opacity-100 transition-all text-red-600 hover:text-red-800" onclick="return confirm('Tem certeza que deseja deletar este cliente?');">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                        <p class="text-sm text-gray-600 mb-1">
                                            <?= htmlspecialchars(formatCpfCnpj($technical['cpf'])); ?>
                                        </p>
                                        <p class="text-sm text-gray-600">
                                            Contato: <?= htmlspecialchars(formatNumber($technical['number'])); ?>
                                        </p>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal de Edição -->
        <div id="editModal" class="hidden fixed inset-0 z-50 items-center justify-center">
            <!-- Overlay escuro -->
            <div id="editModalOverlay" class="absolute inset-0 bg-black opacity-80"></div>

            <!-- Caixa do modal (centrada) -->
            <div class="modal-content relative bg-white rounded-xl shadow-sm border border-gray-100 p-6 w-full max-w-lg mx-4">
                <button type="button" id="closeEditModal" class="absolute cursor-pointer top-3 right-3 text-gray-500 hover:text-gray-700">
                    <i class="bi bi-x-lg"></i>
                </button>

                <div class="flex items-center gap-3 mb-6">
                    <i class="bi bi-person-gear text-2xl text-blue-600"></i>
                    <h2 class="text-xl font-semibold text-gray-900">
                        Editar Técnico
                    </h2>
                </div>

                <form action="../../src/backend/registerTechnicians/update.php" method="post" class="space-y-4" autocomplete="off">
                    <input type="hidden" name="technical_id" id="editTechnicalId" value="">
                    <div>
                        <label for="edit_name" class="block text-sm font-medium text-gray-700 mb-2">
                            Nome Completo
                        </label>
                        <input id="edit_name" name="edit_name" type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-colors" value="" maxlength="100">
                    </div>
                    <div>
                        <label for="edit_number" class="block text-sm font-medium text-gray-700 mb-2">
                            Contato
                        </label>
                        <input id="edit_number" name="edit_number" type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-colors" value="">
                    </div>
                    <button type="submit" class="w-full cursor-pointer bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition-colors">
                        Salvar Alterações
                    </button>
                </form>
            </div>
        </div>
    </main>
    <script src="../../src/scripts/changeTechnicians.js"></script>
    <script src="../../src/scripts/formatTechnicians.js"></script>
    <?php include __DIR__ . '../../../src/includes/scripts.php' ?>
</body>

</html>