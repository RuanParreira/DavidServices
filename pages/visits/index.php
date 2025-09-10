<!DOCTYPE html>
<html lang="pt-br">
<?php
require __DIR__ . '/../../src/backend/functions/geral.php';
require __DIR__ . '/../../src/backend/visits/listVisits.php'
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
                                            placeholder="Pesquisar cliente pelo nome, CPF ou número">
                                    </div>
                                    <div id="suggestion-container"
                                        class="hidden suggestion-clients-services">
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label for="address" class="titulo-label-visits">
                                    Endereço
                                </label>
                                <textarea rows="3" name="address" id="address" class="textarea-form-visits"
                                    placeholder="Digite o endereço do cliente"></textarea>
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
                            <div class="flex space-x-2">
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
                                        <div class="border border-gray-200 rounded-lg p-4 py-2">
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
                                                        <input type="text" name="id" id="name" value="<?= htmlspecialchars($visit['id']); ?>" hidden>
                                                        <span class="text-btn-search-visits">Concluir</span>
                                                        <button type="submit" class="btn-search-visits group ">
                                                            <div class="efeito-btn-search-visits group-hover:bg-white">
                                                            </div>
                                                        </button>
                                                    </form>
                                                <?php endif; ?>
                                            </div>
                                            <div class="space-y-2">
                                                <div class="flex items-center gap-2">
                                                    <i class="bi bi-person text-blue-600"></i>
                                                    <p class="font-medium text-gray-900 text-sm">
                                                        <?= htmlspecialchars($visit['name']); ?> - <?= htmlspecialchars($visit['number']); ?>
                                                    </p>
                                                </div>
                                                <div class="flex items-center gap-2 text-sm text-gray-600">
                                                    <i class="bi bi-geo-alt"></i>
                                                    <span class="text-sm">Rua B, 125</span>
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
    </main>
    <script src="../../src/scripts/registerServices.js"></script>
    <script src="../../src/scripts/resultMessage.js"></script>
    <script src="../../src/scripts/checkVisits.js"></script>
</body>

</html>