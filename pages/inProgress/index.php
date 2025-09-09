<!DOCTYPE html>
<html lang="pt-br">
<?php
require __DIR__ . '/../../src/backend/functions/geral.php';
require __DIR__ . '/../../src/backend/functions/listServices.php';
?>

<head>
    <?php require __DIR__ . '/../../src/includes/head.php'; ?>
    <title>DashBoard</title>
</head>

<body>
    <main class="main-pages">
        <?php include __DIR__ . '/../../src/includes/menu.php'; ?>
        <!-- Mensagem de Sucesso -->
        <?php include __DIR__ . '/../../src/includes/successMessage.php'; ?>
        <div class="p-6 h-full">
            <div class="space-y-6 h-full">
                <!-- Titulo -->
                <div class="flex items-center">
                    <i class="bi bi-play icons-titulo-default text-4xl"></i>
                    <h2 class="text-3xl font-bold text-gray-900">
                        Serviços - Em Progresso
                    </h2>
                    <span class="ml-2 bg-yellow-100 text-yellow-600 px-3 py-1 rounded-full text-sm font-medium">
                        <?= htmlspecialchars($total_iniciados) . ' Serviços' ?>
                    </span>
                </div>
                <!-- Conteudo Da Pagina -->
                <?php if (empty($list_iniciados)): ?>
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-12 text-center">
                        <i class="bi bi-clock text-gray-400 mx-auto text-6xl"></i>
                        <h3 class="text-lg font-semibold text-gray-900 mt-4 mb-2">
                            Nenhum serviço pendente
                        </h3>
                        <p class="text-gray-500">
                            Todos os serviços foram iniciados ou você ainda não cadastrou nenhum serviço.
                        </p>
                    </div>
                <?php else: ?>
                    <!-- Listagem de Serviços que Não Começou -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <?php foreach ($list_iniciados as $services): ?>
                            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
                                <div class="flex items-start justify-between mb-4">
                                    <h3 class="text-xl font-bold text-gray-900">
                                        <?= htmlspecialchars($services['name']) ?>
                                    </h3>
                                    <span class="px-3 py-1 bg-yellow-100 text-yellow-600 rounded-full text-xs font-medium">
                                        Em Progresso
                                    </span>
                                </div>
                                <div class="space-y-4 ">
                                    <div>
                                        <div class="flex items-center gap-2 text-blue-600">
                                            <i class="bi bi-person-vcard text-sm"></i>
                                            <span class="text-sm font-medium">
                                                CPF: <?= htmlspecialchars($services['cpf_cnpj']) ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="flex items-center gap-2 text-blue-600">
                                            <i class="bi bi-laptop text-sm"></i>
                                            <span class="text-sm font-medium">
                                                <?= htmlspecialchars($services['equipment']) ?>
                                            </span>

                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2 text-blue-600">
                                        <i class="bi bi-telephone text-sm"></i>
                                        <span class="text-sm font-medium">
                                            Contato: <?= htmlspecialchars($services['number']) ?>
                                        </span>
                                    </div>
                                    <div>
                                        <div class="flex items-center gap-2 text-blue-600">
                                            <i class="bi bi-calendar text-xs"></i>
                                            <span class="text-sm font-medium">
                                                Data: <?= htmlspecialchars(date(CONF_DATE_BR, strtotime($services['date']))) ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <div class="flex items-start gap-2">
                                            <i class="bi bi-exclamation-circle
                                      text-blue-600 mt-0.5 flex-shrink-0 text-xs"></i>
                                            <div class="overflow-hidden">
                                                <p class="text-sm font-semibold text-gray-700">
                                                    Problema:
                                                </p>
                                                <p class="text-blue-600 text-sm mt-1">
                                                    <?= htmlspecialchars($services['problem']) ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <div class="flex items-center gap-2 mb-3">
                                            <i class="bi bi-chat-left-dots text-blue-600 text-xs"></i>
                                            <p class="text-sm font-semibold text-gray-700">
                                                Observações:
                                            </p>
                                        </div>
                                        <div class="bg-blue-50 p-3 rounded-lg border-l-4 border-blue-600 cursor-pointer hover:bg-blue-100 transition-colors group observation-toggle">
                                            <div class="flex items-center justify-between">
                                                <p class="text-blue-600 text-sm">
                                                    <?= htmlspecialchars($services['observation'] ?: 'Clique para adicionar uma observação...') ?>
                                                </p>
                                                <i class="bi bi-pencil-square text-blue-400 opacity-0 group-hover:opacity-100 transition-opacity text-xs"></i>
                                            </div>
                                        </div>
                                        <!-- Input de observação (inicialmente oculto) -->
                                        <form method="post" action="../../src/backend/inProgress/observation.php" class="hidden observation-input gap-2  w-full" autocomplete="off">
                                            <input type="hidden" name="id" value="<?= htmlspecialchars($services['id']) ?>">
                                            <input type="text" name="observation" class="w-full flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent text-sm" placeholder="Digite sua observação aqui..." value="<?= htmlspecialchars($services['observation']) ?>">
                                            <button class="px-3 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                                                <i class="bi bi-floppy"></i>
                                            </button>
                                        </form>
                                        <form method="post" action="../../src/backend/inProgress/proceed.php" class="flex justify-end mt-4">
                                            <input type="hidden" name="id" value="<?= htmlspecialchars($services['id']) ?>">
                                            <button type="submit" class="w-full cursor-pointer bg-green-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-green-700 transition-colors flex items-center justify-center gap-2">
                                                Finalizar Serviço
                                                <i class="bi bi-arrow-right"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </main>

</body>

<script src="../../src/scripts/successMessage.js"></script>
<script src="../../src/scripts/observation.js"></script>

</html>