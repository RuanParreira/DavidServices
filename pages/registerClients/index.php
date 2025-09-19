<!DOCTYPE html>
<html lang="pt-br">
<?php
require __DIR__ . '/../../src/backend/functions/geral.php';
require __DIR__ . '/../../src/backend/registerClients/list.php';
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

        <!-- Conteudo Principal -->
        <div class="p-6 h-full">
            <div class="space-y-6 h-full">
                <!-- Titulo -->
                <div class="layer-titulo">
                    <i class="bi bi-person-plus text-3xl"></i>
                    <h2>
                        Registrar Clientes
                    </h2>
                </div>
                <div class="layer-form-register">
                    <!-- Formulario de Cadastros -->
                    <div class="form-register">
                        <div class="flex items-center gap-3 mb-6">
                            <i class="bi bi-person-plus text-2xl text-blue-600"></i>
                            <h2 class="text-xl font-semibold text-gray-900">
                                Novo Cliente
                            </h2>
                        </div>
                        <form action="../../src/backend/registerClients/register.php" method="post" class="space-y-4"
                            autocomplete="off">
                            <div>
                                <label for="name" class="subTitulo-default-client">
                                    Nome Completo
                                </label>
                                <input id="name" name="name" type="text" class="input-name-client" placeholder="Digite o nome completo" maxlength="100">
                            </div>
                            <div>
                                <label for="cpf_cnpj" class="subTitulo-default-client">
                                    CPF/CNPJ
                                </label>
                                <div class="relative">
                                    <i class="bi bi-person-vcard icon-default-client"></i>
                                    <input id="cpf_cnpj" name="cpf_cnpj" type="text" class="input-default-client" placeholder="Digite o CPF/CNPJ">
                                </div>
                            </div>
                            <div>
                                <label for="number" class="subTitulo-default-client">
                                    Contato
                                </label>
                                <div class="relative">
                                    <i class="bi bi-telephone icon-default-client"></i>
                                    <input id="number" name="number" type="text" class="input-default-client" placeholder="Telefone, WhatsApp">
                                </div>
                            </div>
                            <button type="submit" class="btn-enviar-client">
                                Cadastrar
                            </button>
                        </form>
                    </div>
                    <!-- Lista de Clientes Cadastrados -->
                    <div class="layer-lista-clients">
                        <div class="titulo-cards-client">
                            <i class="bi bi-person"></i>
                            <h2>
                                Clientes Cadastrados
                            </h2>
                        </div>
                        <!-- Campo de Busca dos Clientes -->
                        <form method="get" class="mb-6 flex items-center space-x-4" autocomplete="off">
                            <div class="relative w-full">
                                <i class="bi bi-search icon-search-client"></i>
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
                                    <span>Buscar</span>
                                </button>
                            </div>
                        </form>
                        <div class="layer-cards-client">
                            <!-- Lista de Clientes Cadastrados  -->
                            <?php if (empty($resultClients)): ?>
                                <div class="text-center py-8 flex flex-col">
                                    <i class="bi bi-person text-gray-500 text-6xl"></i>
                                    <p class="text-gray-500">Nenhum Cliente Cadastrado</p>
                                </div>
                            <?php else: ?>
                                <?php foreach ($resultClients as $client): ?>
                                    <div class="cont-cards-client group">
                                        <div class="flex justify-between">
                                            <h3 class="font-semibold text-gray-900 mb-1">
                                                <?= htmlspecialchars($client['name']); ?>
                                            </h3>
                                            <div class="flex space-x-2">
                                                <div>
                                                    <!-- Adicione um id ao botão de editar e um atributo data-id para identificar o cliente -->
                                                    <button
                                                        type="button"
                                                        class="cursor-pointer opacity-0 group-hover:opacity-100 transition-all text-blue-600 hover:text-blue-800 btn-edit-client"
                                                        data-id="<?= htmlspecialchars($client['id']); ?>"
                                                        data-name="<?= htmlspecialchars($client['name']); ?>"
                                                        data-number="<?= htmlspecialchars($client['number']); ?>">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </button>
                                                </div>
                                                <form action="../../src/backend/registerClients/delete.php" method="POST">
                                                    <input type="hidden" name="client_id" value="<?= htmlspecialchars($client['id']); ?>">
                                                    <button type="submit" class="cursor-pointer opacity-0 group-hover:opacity-100 transition-all text-red-600 hover:text-red-800" onclick="return confirm('Tem certeza que deseja deletar este cliente?');">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                        <p class="text-sm text-gray-600 mb-1">
                                            <?= htmlspecialchars(formatCpfCnpj($client['cpf_cnpj'])); ?>
                                        </p>
                                        <p class="text-sm text-gray-600">
                                            Contato: <?= htmlspecialchars(formatNumber($client['number'])); ?>
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
                        Editar Cliente
                    </h2>
                </div>

                <form action="../../src/backend/registerClients/update.php" method="post" class="space-y-4" autocomplete="off">
                    <input type="hidden" name="client_id" id="editClientId" value="">
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

    <script src="../../src/scripts/resultMessage.js"></script>
    <script src="../../src/scripts/changeUsers.js"></script>
    <script src="../../src/scripts/formatClient.js"></script>
</body>

</html>