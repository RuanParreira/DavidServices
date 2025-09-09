<!DOCTYPE html>
<html lang="pt-br">
<?php
require __DIR__ . '/../../src/backend/functions/geral.php';
require __DIR__ . '/../../src/backend/notStart/listServices.php'
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
                    <i class="bi bi-clock icons-titulo-default text-2xl"></i>
                    <h2 class="text-3xl font-bold text-gray-900">
                        Serviços - Não Começou
                    </h2>
                    <span class="bg-gray-200 text-gray-600 px-3 py-1 rounded-full text-sm font-medium">
                        <?= htmlspecialchars($total_nComecou) . ' Serviços' ?>
                    </span>
                </div>
                <!-- Conteudo Da Pagina -->
                <!-- Mensagem Caso Não Haja Serviços que Não Começou -->

                <?php if (empty($list_nComecou)): ?>
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
                        <?php foreach ($list_nComecou as $services): ?>
                            <!-- Cards de Serviços que Não Começou -->
                            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
                                <div class="flex items-start justify-between mb-4">
                                    <h3 class="text-xl font-bold text-gray-900">
                                        <?= htmlspecialchars($services['name']) ?>
                                    </h3>
                                    <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-xs font-medium">
                                        Não Começou
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
                                            <div class="overflow-hidden ">
                                                <p class="text-sm font-medium text-gray-700">
                                                    Problema:
                                                </p>
                                                <p class="text-blue-600 text-sm mt-1">
                                                    <?= htmlspecialchars($services['problem']) ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex gap-3">
                                        <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg font-medium hover:bg-gray-200 transition-colors flex items-center justify-center gap-2 w-full">
                                            <i class="bi bi-eye"></i>
                                            Detalhes
                                        </button>
                                        <form action="../../src/backend/notStart/proceed.php" method="post" class="w-full">
                                            <input type="hidden" name="id" value="<?= htmlspecialchars($services['id']) ?>">
                                            <button type="submit" class="flex-1 bg-blue-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-blue-700 transition-colors flex items-center justify-center gap-2 w-full">
                                                Avançar
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

</html>