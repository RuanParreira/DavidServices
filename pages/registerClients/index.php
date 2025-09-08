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
        <!-- Mensagem de Sucesso -->
        <?php if (!empty($_SESSION['success_message'])) : ?>
            <div id="successMessage" class="successMessage">
                <i class="bi bi-check2-circle text-blue-500 text-2xl"></i>
                <p class="text-gray-700 text-lg">
                    <?= $_SESSION['success_message'];
                    unset($_SESSION['success_message']); ?>
                </p>
            </div>
        <?php endif; ?>

        <div class="p-6 h-full">
            <div class="space-y-6 h-full">
                <!-- Titulo -->
                <div class="flex items-center gap-2">
                    <i class="bi bi-person-plus icons-titulo-default text-3xl"></i>
                    <h2 class="text-3xl font-bold text-gray-900">
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
                                <input id="name" name="name" type="text" class="input-name-client" placeholder="Digite o nome completo">
                            </div>
                            <div>
                                <label for="cpf_cnpj" class="subTitulo-default-client">
                                    CPF
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
                        <div class="flex items-center mb-6 space-x-1">
                            <i class="bi bi-person text-2xl text-blue-600"></i>
                            <h2 class="text-xl font-semibold text-gray-900">
                                Clientes Cadastrados
                            </h2>
                        </div>
                        <!-- Campo de Busca dos Clientes -->
                        <form method="get" class="mb-6 flex items-center space-x-4" autocomplete="off">
                            <div class="relative w-full">
                                <i class="bi bi-search icon-search-client"></i>
                                <input type="text" name="search" id="searchInput" class="input-search-client" placeholder="Buscar por nome ou CPF"
                                    value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
                            </div>
                            <div class="flex space-x-2">
                                <?php if (!empty($search)) : ?>
                                    <div>
                                        <button type="button" id="clearSearchBtn" class="flex items-center space-x-2
                                    text-red-600 cursor-pointer hover:text-red-700
                                     bg-red-600/10 px-4 h-full rounded-lg
                                    transition-colors">
                                            <i class="bi bi-trash text-xl"></i>
                                        </button>
                                    </div>
                                <?php endif; ?>
                                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg cursor-pointer hover:bg-blue-700 transition-colors space-x-2 flex items-center">
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
                                    <div class="cont-cards-client">
                                        <h3 class="font-semibold text-gray-900 mb-1">
                                            <?= htmlspecialchars($client['name']); ?>
                                        </h3>
                                        <p class="text-sm text-gray-600 mb-1">
                                            CPF: <?= htmlspecialchars($client['cpf_cnpj']); ?>
                                        </p>
                                        <p class="text-sm text-gray-600">
                                            Contato: <?= htmlspecialchars($client['number']); ?>
                                        </p>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
    </main>
    <script src="../../src/scripts/registeredUser.js"></script>
</body>

</html>