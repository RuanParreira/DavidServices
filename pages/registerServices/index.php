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
        <div class="p-6 h-full">
            <div class="space-y-6 h-full">
                <!-- Titulo -->
                <div class="flex items-center gap-2">
                    <i class="bi bi-clipboard-plus icons-titulo-default text-
                    3xl"></i>
                    <h2 class="text-3xl font-bold text-gray-900">
                        Cadastrar Serviço
                    </h2>
                </div>
                <!-- Conteudo Da Pagina -->
                <div class="flex justify-center">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 max-w-2xl w-full">
                        <h2 class="text-xl font-semibold text-gray-900 mb-6">
                            Novo Serviço
                        </h2>
                        <!-- Se não houver clientes cadastrados, não será possível cadastrar um serviço. -->
                        <?php if (empty($resultClients)) {
                            echo
                            "<div class='bg-yellow-50 border border-yellow-200 rounded-lg p-4 flex items-center gap-3'>
                                <i class='bi bi-exclamation-triangle text-yellow-600 text-lg'></i>
                                <p class='text-yellow-800'>
                                    É necessário cadastrar pelo menos um cliente antes de criar um serviço.
                                </p>
                            </div>";
                        } ?>
                        <form action="../../src/backend/registerServices/register.php" class="space-y-4" method="GET">
                            <div>
                                <label for="search-client" class="block text-sm font-medium text-gray-700 mb-2">
                                    Cliente
                                </label>
                                <div class="relative">
                                    <div class="relative">
                                        <i class="bi bi-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                        <input type="text" name="name" id="search-client" class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent" placeholder="Pesquisar cliente pelo nome, CPF ou número" autocomplete="off">
                                    </div>
                                    <div id="suggestion-container"
                                        class="hidden absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-lg shadow-lg max-h-60 overflow-y-auto">
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="id_client" id="selected-client-id" value="ID_DO_CLIENTE">
                            <div>
                                <label for="equipment" class="block text-sm font-medium text-gray-700 mb-2">
                                    Equipamento
                                </label>
                                <input type="text" id="equipment" name="equipment" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 
                                focus:ring-blue-600 focus:border-transparent" placeholder="Ex: Notebook Dell, Smartphone Samsung..." autocomplete="off">
                            </div>
                            <div>
                                <label for="problem" class="block text-sm font-medium text-gray-700 mb-2">
                                    Problema Detectado
                                </label>
                                <textarea rows="3" name="problem" id="problem" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent" placeholder="Descreva o problema reportado pelo cliente..."> </textarea>
                            </div>
                            <div>
                                <label for="" class="block text-sm font-medium text-gray-700 mb-2">
                                    Data
                                </label>
                                <input type="date" name="date" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent" value="<?php echo htmlspecialchars(date('Y-m-d')); ?>">
                            </div>
                            <button type="submit" class="w-full cursor-pointer bg-blue-600 text-white px-6 py-2 rounded-lg font-medium hover:bg-blue-700 transition-colors">
                                Cadastrar Serviço
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="../../src/scripts/registerServices.js"></script>
</body>

</html>