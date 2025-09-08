<!DOCTYPE html>
<html lang="pt-BR">
<?php
require __DIR__ . '/../../src/backend/functions/geral.php';
require __DIR__ . '/../../src/backend/functions/dashBoard.php';
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
                    <i class="bi bi-graph-up-arrow icons-titulo-default"></i>
                    <h2 class="text-3xl font-bold text-gray-900">
                        DashBoard
                    </h2>
                </div>
                <!-- Relatório de serviços -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- cards de informações -->
                    <!-- Não Começou -->
                    <div class="interface-cards-informacao">
                        <div class="conteudo-cards-informacao">
                            <div>
                                <p class="titulo-cards-informacao">
                                    Não Começou
                                </p>
                                <!-- Puxar com o banco de dados -->
                                <p class="numero-cards-informacao">
                                    <?= $total_nComecou ?>
                                </p>
                                <p class="pequena-descricao"">
                                    Serviços
                                </p>
                            </div>
                            <div class=" interface-icone-informacao bg-gray-100 ">
                                <i class=" bi bi-clock text-xl text-gray-600"></i>
                            </div>
                        </div>
                    </div>
                    <!-- Em Progresso -->
                    <div class="interface-cards-informacao">
                        <div class="conteudo-cards-informacao">
                            <div>
                                <p class="titulo-cards-informacao">
                                    Em Progresso
                                </p>
                                <!-- Puxar com o banco de dados -->
                                <p class="numero-cards-informacao">
                                    <?= $total_eProgresso ?>
                                </p>
                                <p class="pequena-descricao"">
                                    Serviços
                                </p>
                            </div>
                            <div class=" interface-icone-informacao bg-yellow-100">
                                    <i class="bi bi-play text-4xl text-yellow-500"></i>
                            </div>
                        </div>
                    </div>
                    <!-- Prontos  -->
                    <div class="interface-cards-informacao">
                        <div class="conteudo-cards-informacao">
                            <div>
                                <p class="titulo-cards-informacao">
                                    Prontos
                                </p>
                                <!-- Puxar com o banco de dados -->
                                <p class="numero-cards-informacao">
                                    <?= htmlspecialchars($total_prontos); ?>
                                </p>
                                <p class="pequena-descricao"">
                                    Serviços
                                </p>
                            </div>
                            <div class=" interface-icone-informacao bg-green-100">
                                    <i class="bi bi-check2-circle text-2xl text-green-500"></i>
                            </div>
                        </div>
                    </div>
                    <!-- Finalizados -->
                    <div class="interface-cards-informacao">
                        <div class="conteudo-cards-informacao">
                            <div>
                                <p class="titulo-cards-informacao">
                                    Finalizados
                                </p>
                                <!-- Puxar com o banco de dados -->
                                <p class="numero-cards-informacao">
                                    <?= htmlspecialchars($total_finalizados); ?>
                                </p>
                                <p class="pequena-descricao"">
                                    Serviços
                                </p>
                            </div>
                            <div class=" interface-icone-informacao bg-blue-100">
                                    <i class="bi bi-archive text-2xl text-blue-600"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Relatorio Total -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Total de Clientes -->
                    <div class="interface-cards-informacao">
                        <div class="conteudo-cards-informacao">
                            <div>
                                <p class="titulo-cards-informacao">
                                    Clientes Cadastrados
                                </p>
                                <!-- Puxar com o banco de dados -->
                                <p class="numero-cards-informacao">
                                    <?= htmlspecialchars($total_clientes); ?>
                                </p>
                                <p class="pequena-descricao"">
                                    Total de clientes no sistema
                                </p>
                            </div>
                            <div class=" interface-icone-informacao bg-purple-100 ">
                                <i class=" bi bi-person text-2xl text-purple-600"></i>
                            </div>
                        </div>
                    </div>
                    <!-- Total de Serviços -->
                    <div class="interface-cards-informacao">
                        <div class="conteudo-cards-informacao">
                            <div>
                                <p class="titulo-cards-informacao">
                                    Total de Serviços
                                </p>
                                <!-- Puxar com o banco de dados -->
                                <p class="numero-cards-informacao">
                                    <?= htmlspecialchars($total_servicos); ?>
                                </p>
                                <p class="pequena-descricao"">
                                    Serviços registrados no sistema
                                </p>
                            </div>
                            <div class=" interface-icone-informacao bg-zinc-100 ">
                                <i class=" bi bi-gear text-2xl text-zinc-600"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl h-[48%] shadow-sm border border-gray-100">
                    <div class="px-6 py-4 border-b border-gray-100">
                        <h2 class="text-2xl font-semibold text-gray-900">Ultimos Serviços</h2>
                        <p class="pequena-descricao">Os 5 serviços mais recentes cadastrados no sistema</p>
                    </div>
                    <div class="px-6 py-2 overflow-y-auto h-[13rem]">
                        <div class="space-y-4">
                            <!-- Puxar do banco de dados -->
                            <?php
                            if (empty($ultimos_servicos)) {
                                echo
                                "<div class='text-center py-8 mt-15'>
                                    <p class='text-gray-500'>Nenhum serviço cadastrado</p>
                                </div>";
                            }
                            foreach ($ultimos_servicos as $servicos): ?>
                                <div class="flex border border-gray-200 items-center justify-between px-4 p-2 rounded-lg">
                                    <div>
                                        <h3 class="font-semibold text-sm text-blue-600">
                                            <!-- Puxar no banco de dados -->
                                            <?= htmlspecialchars($servicos['client_name']); ?>
                                        </h3>
                                        <div class="flex items-center space-x-2">
                                            <p class="text-sm text-gray-600">
                                                <?= htmlspecialchars($servicos['equipment']); ?>
                                            </p>
                                            <span class="text-xl text-blue-600">-</span>
                                            <p class="text-sm text-gray-600">
                                                <?= htmlspecialchars($servicos['problem']); ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex flex-col text-center space-y-1">
                                        <span class="px-2 py-0.5 rounded-full text-xs font-medium text-blue-600 bg-blue-600/20">
                                            <?php
                                            if ($servicos['status'] == 1) {
                                                echo  "Não Começou";
                                            } elseif ($servicos['status'] == 2) {
                                                echo "Em Progresso";
                                            } elseif ($servicos['status'] == 3) {
                                                echo "Pronto";
                                            } elseif ($servicos['status'] == 4) {
                                                echo "Finalizado";
                                            }
                                            ?>
                                        </span>
                                        <span class="text-sm text-blue-600">
                                            <?= htmlspecialchars(date(CONF_DATE_BR, strtotime($servicos['date']))); ?>
                                        </span>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

</body>

</html>