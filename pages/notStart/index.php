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
        <?php include __DIR__ . '/../../src/includes/resultMessage.php'; ?>

        <!-- Conteudo Da Pagina -->
        <div class="p-6 h-full">
            <div class="space-y-6 h-full">
                <!-- Titulo -->
                <div class="layer-titulo">
                    <i class="bi bi-clock"></i>
                    <h2>
                        Serviços - Não Começou
                    </h2>
                    <span class="bg-gray-200 text-gray-600">
                        <?= htmlspecialchars($total_nComecou) . ' Serviços' ?>
                    </span>
                </div>

                <!-- Mensagem Caso Não Haja Serviços que Não Começou -->
                <?php if (empty($list_nComecou)): ?>
                    <div class="layer-naoEncontrado">
                        <i class="bi bi-clock"></i>
                        <h3>
                            Nenhum serviço pendente
                        </h3>
                        <p>
                            Todos os serviços foram iniciados ou você ainda não cadastrou nenhum serviço.
                        </p>
                    </div>
                <?php else: ?>
                    <!-- Listagem de Serviços que Não Começou -->
                    <div class="layer-default-cards">
                        <?php foreach ($list_nComecou as $services): ?>
                            <!-- Cards de Serviços que Não Começou -->
                            <div class="card-default-conteudo group">
                                <div class="layer-titulo-default-card">
                                    <div class="flex items-center space-x-0.5">
                                        <h3>
                                            <?= htmlspecialchars($services['name']) ?>
                                        </h3>
                                        <i class="bi bi-dash text-gray-600"></i>
                                        <span class="bg-gray-100 text-gray-600">
                                            Não Começou
                                        </span>
                                    </div>
                                    <div class="flex space-x-2 items-center">
                                        <button
                                            type="button"
                                            class="cursor-pointer opacity-0 group-hover:opacity-100 transition-all text-blue-600 hover:text-blue-800 btn-edit-client"
                                            data-id="<?= htmlspecialchars($services['id']); ?>"
                                            data-status="<?= htmlspecialchars($services['status']); ?>"
                                            data-date="<?= htmlspecialchars($services['date']); ?>"
                                            data-technical="<?= htmlspecialchars($services['technician_id']); ?>"
                                            data-equipment="<?= htmlspecialchars($services['equipment']); ?>"
                                            data-problem="<?= htmlspecialchars($services['problem']); ?>">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <form action="../../src/backend/functions/deleteServices.php" method="POST">
                                            <input type="hidden" name="service_id" value="<?= htmlspecialchars($services['id']); ?>">
                                            <button type="submit" class="cursor-pointer opacity-0 group-hover:opacity-100 transition-all text-red-600 hover:text-red-800" onclick="return confirm('Tem certeza que deseja deletar este Serviço?');">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <div class="space-y-4 ">
                                    <div class="iten-default-card">
                                        <i class="bi bi-laptop"></i>
                                        <span>
                                            <?= htmlspecialchars($services['equipment']) ?>
                                        </span>
                                    </div>
                                    <div class="iten-default-card">
                                        <i class="bi bi-person-vcard"></i>
                                        <span>
                                            <?= htmlspecialchars(formatCpfCnpj($services['cpf_cnpj'])); ?>
                                        </span>
                                    </div>
                                    <div class="iten-default-card">
                                        <i class="bi bi-telephone"></i>
                                        <span>
                                            Contato: <?= htmlspecialchars(formatNumber($services['number'])) ?>
                                        </span>
                                    </div>
                                    <div class="iten-default-card">
                                        <i class="bi bi-calendar"></i>
                                        <span>
                                            Data: <?= htmlspecialchars(date(CONF_DATE_BR, strtotime($services['date']))) ?>
                                        </span>
                                    </div>
                                    <div class="iten-default-card">
                                        <i class="bi bi-people"></i>
                                        <span>
                                            Técnico: <?= htmlspecialchars($services['technician_name']) ?>
                                        </span>
                                    </div>
                                    <div class="mt-4">
                                        <div class="layer-problemDefault-card">
                                            <i class="bi bi-exclamation-circle"></i>
                                            <div class="overflow-hidden">
                                                <p class="titulo-problemDefault-card">
                                                    Problema:
                                                </p>
                                                <p class="desc-problemDefault-card">
                                                    <?= htmlspecialchars($services['problem']) ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex gap-3">
                                        <form action="../../src/backend/notStart/proceed.php" method="post" class="w-full">
                                            <input type="hidden" name="id" value="<?= htmlspecialchars($services['id']) ?>">
                                            <button type="submit" class="btn-avancar-card">
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
        <!-- Modal de Edição -->
        <div id="editModal" class="hidden fixed inset-0 z-50 items-center justify-center">
            <!-- Overlay escuro -->
            <div id="editModalOverlay" class="absolute inset-0 bg-black opacity-80"></div>

            <!-- Caixa do modal (centrada) -->
            <div class="modal-content relative bg-white rounded-xl shadow-sm border border-gray-100 p-6 w-full max-w-lg mx-4">
                <button type="button" id="closeEditModal" class="absolute cursor-pointer top-3 right-3 text-gray-500 hover:text-gray-700">
                    <i class="bi bi-x-lg"></i>
                </button>

                <div class="flex items-center gap-1 mb-6">
                    <i class="bi bi-gear text-2xl text-blue-600"></i>
                    <h2 class="text-xl font-semibold text-gray-900">
                        Editar Serviço
                    </h2>
                </div>

                <form action="../../src/backend/functions/updateServices.php" method="post" class="space-y-4" autocomplete="off">
                    <input type="hidden" name="service_id" id="editClientId" value="">
                    <div>
                        <label for="edit_equipment" class="block text-sm font-medium text-gray-700 mb-2">
                            Equipamento
                        </label>
                        <input id="edit_equipment" name="edit_equipment" type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-colors" value="" maxlength="100">
                    </div>
                    <div class="grid grid-cols-2 space-x-4">
                        <div class="h-full">
                            <label for="edit_date" class="block text-sm font-medium text-gray-700 mb-2">
                                Data
                            </label>
                            <div class="relative">
                                <i class="bi bi-calendar absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-lg"></i>
                                <input type="date" id="edit_date" name="edit_date" class="w-full pl-8 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-colors">
                            </div>
                        </div>
                        <div>
                            <label for="edit_status" class="block text-sm font-medium text-gray-700 mb-2">
                                Status
                            </label>
                            <div class="relative">
                                <i class="bi bi-archive absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-lg"></i>
                                <select name="edit_status" id="edit_status" class="w-full pl-8 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent">
                                    <option value="" class="text-gray-600">Selecione um Status</option>
                                    <option value="1">Não Começou</option>
                                    <option value="2">Em Progresso</option>
                                    <option value="3">Prontos</option>
                                    <option value="4">Finalizado</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label for="edit_technical" class="block text-sm font-medium text-gray-700 mb-2">
                            Técnico Responsável
                        </label>
                        <div class="relative">
                            <i class="bi bi-people absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-lg"></i>
                            <select id="edit_technical" name="technician_id" class="w-full pl-8 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent">
                                <option value="">Selecione um Técnico</option>
                                <?php foreach ($allTechnicians as $technician): ?>
                                    <option value="<?= htmlspecialchars($technician['id']) ?>">
                                        <?= htmlspecialchars($technician['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div>
                        <label for="edit_problem" class="block text-sm font-medium text-gray-700 mb-2">
                            Problema
                        </label>
                        <textarea id="edit_problem" name="edit_problem" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-colors" maxlength="255"></textarea>
                    </div>
                    <button type="submit" class="w-full cursor-pointer bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition-colors">
                        Salvar Alterações
                    </button>
                </form>
            </div>
        </div>
    </main>
    <script src="../../src/scripts/resultMessage.js"></script>
    <script src="../../src/scripts/changeServices.js"></script>
</body>

</html>