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
        <!-- Mensagem de Sucesso -->
        <?php include __DIR__ . '/../../src/includes/resultMessage.php'; ?>
        <div class="p-6 h-full">
            <div class="space-y-6 h-full">
                <!-- Titulo -->
                <div class="layer-titulo">
                    <i class="bi bi-calendar icons-titulo-default text-2xl"></i>
                    <h2 class="text-3xl font-bold text-gray-900">
                        Visitas Técnicas
                    </h2>
                </div>
                <!-- Conteudo Da Pagina -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <h2 class="text-xl font-semibold text-gray-900 mb-6">
                            Agendar Visita Técnica
                        </h2>
                        <form action="" class="space-y-4" autocomplete="off">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="" class="block text-sm font-medium text-gray-700 mb-2">
                                        Data
                                    </label>
                                    <input type="date" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent">
                                </div>
                                <div>
                                    <label for="" class="block text-sm font-medium text-gray-700 mb-2">
                                        Horário
                                    </label>
                                    <select name="" id="" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent">
                                        <option value="08:00">08:00</option>
                                        <option value="09:00">09:00</option>
                                        <option value="10:00">10:00</option>
                                        <option value="11:00">15:00</option>
                                        <option value="12:00">16:00</option>
                                    </select>
                                </div>
                            </div>
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
                            <div>
                                <label for="" class="block text-sm font-medium text-gray-700 mb-2">
                                    Endereço
                                </label>
                                <textarea rows="3" name="" id="" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent"></textarea>
                            </div>
                            <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-blue-700 transition-colors">
                                Agendar Visita
                            </button>
                        </form>
                    </div>
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <div class="mb-6">
                            <label for="" class="block text-sm font-medium text-gray-700 mb-2">
                                Ver visitas do Dia
                            </label>
                            <input type="date" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent">
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">
                            VIsitas de 09/06/2024
                        </h3>
                        <div class="space-y-3">
                            <div class="border border-gray-200 rounded-lg p-4">
                                <div class="flex items-center justify-between mb-1">
                                    <div class="flex items-center gap-2">
                                        <i class="bi bi-clock text-blue-600"></i>
                                        <span class="font-semibold text-lg text-gray-900">
                                            08:00
                                        </span>
                                        <span class="px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-600">
                                            Agendada
                                        </span>
                                    </div>
                                    <button class="w-6 h-6 rounded-full border-2 border-blue-600 flex items-center justify-center hover:bg-blue-600 transition-colors group">
                                        <div class="w-2 h-2 bg-blue-600 rounded-full opacity-0 group-hover:opacity-100 group-hover:bg-white transition-all">
                                        </div>
                                    </button>
                                </div>
                                <div class="space-y-2">
                                    <div class="flex items-center gap-2">
                                        <i class="bi bi-person text-blue-600"></i>
                                        <p class="font-medium text-gray-900">
                                            João da Silva
                                        </p>
                                    </div>
                                    <div class="flex items-center gap-2 text-sm text-gray-600">
                                        <i class="bi bi-geo-alt"></i>
                                        <span>Rua B, 125</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="../../src/scripts/registerServices.js"></script>
</body>

</html>