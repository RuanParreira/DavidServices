<!DOCTYPE html>
<html lang="pt-br">
<?php
require __DIR__ . '/../../src/backend/functions/geral.php';
require __DIR__ . '/../../src/backend/visits/listAll.php';
require __DIR__ . '/../../src/includes/menu_state.php';
?>

<head>
    <?php require __DIR__ . '/../../src/includes/head.php'; ?>
    <title>DashBoard</title>
</head>

<body>
    <main class="<?= $mainPagesClass ?>">
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
                <div class="layer-conteudo-visits">
                    <div class="layer-form-visits">
                        <h2 class="titulo-form-visits">
                            Agendar Visita Técnica
                        </h2>
                        <form action="../../src/backend/visits/register.php" class="space-y-4" method="POST" autocomplete="off">
                            <div class="cont-form-visits ">
                                <div>
                                    <label for="date" class="titulo-label-visits">
                                        Data
                                    </label>
                                    <input type="date" name="date" id="date" class="input-form-visits" value="<?= date(htmlspecialchars('Y-m-d')); ?>">
                                </div>
                                <div>
                                    <label for="time" class="titulo-label-visits">
                                        Horário
                                    </label>
                                    <select name="time" id="time" class="input-form-visits">
                                        <option value="09:00">
                                            09:00
                                        </option>
                                        <option value="09:30">
                                            09:30
                                        </option>
                                        <option value="10:00">
                                            10:00
                                        </option>
                                        <option value="10:30">
                                            10:30
                                        </option>
                                        <option value="14:30">
                                            14:30
                                        </option>
                                        <option value="15:00">
                                            15:00
                                        </option>
                                        <option value="15:30">
                                            15:30
                                        </option>
                                        <option value="16:00">
                                            16:00
                                        </option>
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
                                        <input type="text" name="name" id="search-client" class="input-client-services"
                                            placeholder="Pesquisar cliente pelo nome, CPF ou número" maxlength="100">
                                    </div>
                                    <div id="suggestion-container"
                                        class="hidden suggestion-clients-services">
                                    </div>
                                </div>
                            </div>
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
                                <label for="address" class="titulo-label-visits">
                                    Endereço
                                </label>
                                <textarea rows="3" name="address" id="address" class="textarea-form-visits"
                                    placeholder="Digite o endereço do cliente" maxlength="255"></textarea>
                            </div>
                            <button type="submit" class="btn-submit-visits ">
                                Agendar Visita
                            </button>
                        </form>
                    </div>
                    <!-- Visitas Agendadas -->
                    <div class="layer-cont-search-visits">
                        <form class="mb-6" method="get" autocomplete="off">
                            <label for="search" class="titulo-label-visits">
                                Ver visitas do Dia
                            </label>
                            <div class="flex space-x-4">
                                <input type="date" name="search" id="search" class="input-search-visits"
                                    value="<?= isset($_GET['search']) && $_GET['search'] !== '' ? htmlspecialchars($_GET['search']) : date('Y-m-d') ?>">
                                <div class="flex space-x-2">
                                    <?php if (!empty($search)) : ?>
                                        <div>
                                            <button type="button" id="clearSearchVisit" class="btn-limpar-busca">
                                                <i class="bi bi-trash text-xl"></i>
                                            </button>
                                        </div>
                                    <?php endif; ?>
                                    <button type="submit" class="btn-buscar">
                                        <i class="bi bi-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                        <?php if (empty($list_Visits)): ?>
                            <div class="layer-nao-encontrado-visits">
                                <i class="bi bi-calendar"></i>
                                <p>
                                    Nenhuma visita agendada para este dia
                                </p>
                            </div>
                        <?php else: ?>
                            <div class="layer-cont-list-visits">
                                <div class="space-y-3">
                                    <?php foreach ($list_Visits as $visit): ?>
                                        <div class="border border-gray-200 hover:bg-gray-100 rounded-lg p-4 py-2 group/card">
                                            <div class="flex items-center justify-between mb-1">
                                                <div class="flex items-center gap-2">
                                                    <i class="bi bi-clock text-blue-600"></i>
                                                    <span class="font-semibold text-base text-gray-900">
                                                        <?= htmlspecialchars(date('H:i', strtotime($visit['time']))); ?>
                                                    </span>
                                                    <?php if ($visit['status'] == 1): ?>
                                                        <span class="status-visit bg-blue-100 text-blue-600">
                                                            Pendente
                                                        </span>
                                                    <?php elseif ($visit['status'] == 2): ?>
                                                        <span class="status-visit bg-green-100 text-green-600">
                                                            Concluído
                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                                <?php if ($visit['status'] == 1): ?>
                                                    <form method="post" action="../../src/backend/visits/proceed.php" class="flex space-x-2">
                                                        <input type="hidden" name="id" id="name" value="<?= htmlspecialchars($visit['id']); ?>">
                                                        <span class="text-btn-search-visits">Concluir</span>
                                                        <button type="submit" class="btn-search-visits group/button">
                                                            <div class="efeito-btn-search-visits group-hover/button:bg-white">
                                                            </div>
                                                        </button>
                                                    </form>
                                                <?php endif; ?>
                                            </div>
                                            <div class="space-y-1">
                                                <div class="flex items-center gap-2">
                                                    <i class="bi bi-person text-blue-600"></i>
                                                    <p class="font-medium text-gray-900 text-sm">
                                                        <?= htmlspecialchars($visit['name']); ?> - <?= htmlspecialchars(formatNumber($visit['number'])); ?>
                                                    </p>
                                                </div>
                                                <div class="flex items-center gap-2 text-gray-600">
                                                    <i class="bi bi-people text-blue-600"></i>
                                                    <p class="text-sm">
                                                        Técnico: <?= htmlspecialchars($visit['technical_name']); ?>
                                                    </p>
                                                </div>
                                                <div class="flex items-center justify-between text-sm text-gray-600">
                                                    <div class="flex space-x-3">
                                                        <i class="bi bi-geo-alt"></i>
                                                        <span class="text-sm">
                                                            <?= htmlspecialchars($visit['address']); ?>
                                                        </span>
                                                    </div>
                                                    <div class="flex space-x-2">
                                                        <!-- Botao para editar a visita -->
                                                        <button
                                                            type="button"
                                                            class="cursor-pointer opacity-0 group-hover/card:opacity-100 transition-all text-blue-600 hover:text-blue-800 btn-edit-visit"
                                                            data-id="<?= htmlspecialchars($visit['id']); ?>"
                                                            data-address="<?= htmlspecialchars($visit['address']); ?>"
                                                            data-technical-id="<?= htmlspecialchars($visit['id_technical']); ?>">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </button>
                                                        <!-- Botao para deletar a visita -->
                                                        <form action="../../src/backend/visits/delete.php" method="POST">
                                                            <input type="hidden" name="visit_id" value="<?= htmlspecialchars($visit['id']); ?>">
                                                            <button type="submit" class="cursor-pointer opacity-0 group-hover/card:opacity-100 transition-all text-red-600 hover:text-red-800" onclick="return confirm('Tem certeza que deseja cancelar esta visita?');">
                                                                <i class="bi bi-x-circle"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>
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
                        Editar Visita
                    </h2>
                </div>

                <form action="../../src/backend/visits/update.php" method="post" class="space-y-4" autocomplete="off">
                    <input type="hidden" name="visit_id" id="editVisitId" value="">
                    <div>
                        <label for="edit_address" class="block text-sm font-medium text-gray-700 mb-2">
                            Endereço
                        </label>
                        <textarea id="edit_address" name="address" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-colors" maxlength="255"></textarea>
                    </div>
                    <div>
                        <label for="edit_technical" class="block text-sm font-medium text-gray-700 mb-2">
                            Técnico Responsável
                        </label>
                        <div class="relative">
                            <i class="bi bi-people absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-lg"></i>
                            <select id="edit_technical" name="technician_id" class="w-full pl-8 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent">
                                <option value="">Selecione um Técnico</option>
                                <?php foreach ($resultTechnicians as $technical): ?>
                                    <option value="<?= htmlspecialchars($technical['id']) ?>">
                                        <?= htmlspecialchars(getFirstTwoNames($technical['name'])) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="w-full cursor-pointer bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition-colors">
                        Salvar Alterações
                    </button>
                </form>
            </div>
        </div>
    </main>
    <script src="../../src/scripts/autoComplete.js"></script>
    <script src="../../src/scripts/checkVisits.js"></script>
    <script src="../../src/scripts/changeVisits.js"></script>
    <?php include __DIR__ . '../../../src/includes/scripts.php' ?>
</body>

</html>