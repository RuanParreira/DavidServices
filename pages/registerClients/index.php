<!DOCTYPE html>
<html lang="pt-br">
<?php
require __DIR__ . '/../../src/backend/functions/geral.php';
?>

<head>
    <?php require __DIR__ . '/../../src/includes/head.php'; ?>
    <title>DashBoard</title>
</head>

<body>
    <main class="main-pages">
        <?php include __DIR__ . '/../../src/includes/menu.php'; ?>
        <div class="p-6 h-full">
            <div class="space-y-6 h-full">
                <!-- Titulo -->
                <div class="flex items-center gap-3">
                    <i class="bi bi-person-plus icons-titulo-default text-3xl"></i>
                    <h2 class="text-3xl font-bold text-gray-900">
                        Registrar Clientes
                    </h2>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Formulario de Cadastros -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <div class="flex items-center gap-3 mb-6">
                            <i class="bi bi-person-plus text-2xl text-blue-600"></i>
                            <h2 class="text-xl font-semibold text-gray-900">
                                Novo Cliente
                            </h2>
                        </div>
                        <form action="" class="space-y-4">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                    Nome Completo
                                </label>
                                <input id="name" name="name" type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-colors" placeholder="Digite o nome completo">
                            </div>
                            <div>
                                <label for="cpf_cnpj" class="block text-sm font-medium text-gray-700 mb-2">
                                    CPF
                                </label>
                                <div class="relative">
                                    <i class="bi bi-person-vcard absolute left-3 top-1/2 transform -translate-y-1/2  text-gray-400 text-lg"></i>
                                    <input id="cpf_cnpj" name="cpf_cnpj" type="text" class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-colors" placeholder="Digite o CPF/CNPJ">
                                </div>
                            </div>
                            <div>
                                <label for="contato" class="block text-sm font-medium text-gray-700 mb-2">
                                    Contato
                                </label>
                                <div class="relative">
                                    <i class="bi bi-telephone absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-lg"></i>
                                    <input id="contato" name="contato" type="text" class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-colors" placeholder="Telefone, WhatsApp">
                                </div>
                            </div>
                            <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-blue-700 transition-colors">
                                Cadastrar
                            </button>
                        </form>
                    </div>
                    <!-- Lista de Clientes Cadastrados -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <div class="flex items-center gap-3 mb-6">
                            <i class="bi bi-person text-2xl text-blue-600"></i>
                            <h2 class="text-xl font-semibold text-gray-900">
                                Clientes Cadastrados
                            </h2>
                        </div>
                        <div class="mb-6">
                            <div class="relative">
                                <i class="bi bi-search absolute left-3 top-1/2 transform -translate-y-1/2 text-lg text-gray-400"></i>
                                <input type="text" class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-colors" placeholder="Buscar por nome ou CPF">
                            </div>
                        </div>
                        <div class="space-y-3 max-h-96 overflow-y-auto">
                            <!-- Buscar no Banco de Dados  -->
                            <div class="border-2 border-gray-200 bg-gray-50 rounded-lg py-2 px-4 hover:bg-gray-100 transition-colors">
                                <h3 class="font-semibold text-gray-900 mb-1">
                                    nome
                                </h3>
                                <p class="text-sm text-gray-600 mb-1">
                                    CPF: 000.000.000-00
                                </p>
                                <p class="text-sm text-gray-600">
                                    Contato: (00) 00000-0000
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </main>
</body>

</html>