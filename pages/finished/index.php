<!DOCTYPE html>
<html lang="pt-br">
<?php
require __DIR__ . '/../../src/backend/functions/geral.php';
require __DIR__ . '/../../src/backend/functions/listServices.php';
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
                    <i class="bi bi-archive icons-titulo-default text-2xl"></i>
                    <h2>
                        Serviços - Finalizados
                    </h2>
                    <span class="bg-green-100 text-green-600">
                        <?= htmlspecialchars($total_finalizados) . ' Serviços' ?>
                    </span>
                </div>
                <!-- Conteudo Da Pagina -->
                <div class="layer-page-finalizados">
                    <h2 class="titulo-busca-finalizados">
                        Filtros de Busca
                    </h2>
                    <!-- Campo de Busca dos Serviços -->
                    <form method="get" autocomplete="off" class="layer-search-finalizados ">
                        <div class="w-full">
                            <label for="search" class="titulo-search-finalizados">
                                Buscar por nome, CPF ou equipamento
                            </label>
                            <div class="relative">
                                <i class="bi bi-search icons-search-finalizados"></i>
                                <input type="text" name="search" id="search" class="input-search-finalizados" placeholder="Digite para buscar..."
                                    value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>" maxlength="100">
                            </div>
                        </div>
                        <div>
                            <label for="dataChegada" class="titulo-search-finalizados">
                                Data Chegada
                            </label>
                            <div class="relative">
                                <i class="bi bi-calendar icons-search-finalizados"></i>
                                <input type="date" name="dataChegada" id="dataChegada" class="input-search-finalizados"
                                    value="<?= isset($_GET['dataChegada']) ? htmlspecialchars($_GET['dataChegada']) : '' ?>">
                            </div>
                        </div>
                        <div>
                            <label for="dataEntregue" class="titulo-search-finalizados">
                                Data Entregue
                            </label>
                            <div class="relative">
                                <i class="bi bi-calendar icons-search-finalizados"></i>
                                <input type="date" name="dataEntregue" id="dataEntregue" class="input-search-finalizados"
                                    value="<?= isset($_GET['dataEntregue']) ? htmlspecialchars($_GET['dataEntregue']) : '' ?>">
                            </div>
                        </div>
                        <div class="flex items-end space-x-2">
                            <!-- Botao de Limpar a Busca -->
                            <?php if (!empty($_GET['search']) || !empty($_GET['dataChegada']) || !empty($_GET['dataEntregue'])): ?>
                                <button type="button" id="clearFinishedSearch" class="btn-limpar-busca h-10">
                                    <i class="bi bi-trash text-xl"></i>
                                </button>
                            <?php endif; ?>
                            <button type="submit" class="btn-buscar">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="layer-tabela-finalizados">
                    <div class="titulo-tabela-finalizados">
                        <h2>
                            Resultados
                        </h2>
                    </div>
                    <div class="overflow-x-auto">
                        <?php if (empty($list_finalizados)): ?>
                            <div class="titulo-naoEncontrado-finalizados">
                                <i class="bi bi-archive"></i>
                                <h3>
                                    Nenhum serviço finalizado
                                </h3>
                                <p>
                                    Complete alguns serviços para vê-los aqui.
                                </p>
                            </div>
                        <?php else: ?>
                            <table class="w-full">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="titulo-colunas">Cliente</th>
                                        <th class="titulo-colunas">Equipamento</th>
                                        <th class="titulo-colunas">Problema</th>
                                        <th class="titulo-colunas">Observação</th>
                                        <th class="titulo-colunas">Data Chegada</th>
                                        <th class="titulo-colunas">Data Entregue</th>
                                        <th class="titulo-colunas text-center">Ações</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    <?php foreach ($list_finalizados as $services): ?>
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6">
                                                <div>
                                                    <p class="text-sm font-medium text-gray-900">
                                                        <?= htmlspecialchars($services['name']) ?>
                                                    </p>
                                                    <p class="text-sm text-gray-500">
                                                        <?= htmlspecialchars(formatCpfCnpj($services['cpf_cnpj'], false)) ?>
                                                    </p>
                                                </div>
                                            </td>
                                            <td class="linhas-tabela">
                                                <?= htmlspecialchars($services['equipment']) ?>
                                            </td>
                                            <td class="linhas-tabela max-w-xs">
                                                <p class="truncate">
                                                    <?= htmlspecialchars($services['problem']) ?>
                                                </p>
                                            </td>
                                            <td class="linhas-tabela text-gray-500">
                                                <?= htmlspecialchars($services['observation']) ?: 'Nenhuma observação' ?>
                                            </td>
                                            <td class="linhas-tabela">
                                                <?= htmlspecialchars(date(CONF_DATE_BR, strtotime($services['date']))) ?>
                                            </td>
                                            <td class="linhas-tabela">
                                                <?= htmlspecialchars(date(CONF_DATE_BR, strtotime($services['updated_at']))) ?>
                                            </td>
                                            <td class="linhas-tabela text-center">
                                                <form action="../../src/backend/finished/delete.php" method="POST">
                                                    <input type="hidden" name="service_id" value="<?= htmlspecialchars($services['id']); ?>">
                                                    <button type="submit" class="cursor-pointer text-xl transition-all bg-red-100 py-1 px-2 rounded-md hover:bg-red-200 text-red-600 hover:text-red-700" onclick="return confirm('Tem certeza que deseja deletar este serviço?');">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include __DIR__ . '../../../src/includes/scripts.php' ?>
</body>

</html>