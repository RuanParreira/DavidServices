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
                            <div class="card-default-conteudo">
                                <div class="layer-titulo-default-card">
                                    <h3>
                                        <?= htmlspecialchars($services['name']) ?>
                                    </h3>
                                    <span class="bg-gray-100 text-gray-600">
                                        Não Começou
                                    </span>
                                </div>
                                <div class="space-y-4 ">
                                    <div>
                                        <div class="iten-default-card">
                                            <i class="bi bi-laptop"></i>
                                            <span>
                                                <?= htmlspecialchars($services['equipment']) ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="iten-default-card">
                                            <i class="bi bi-person-vcard"></i>
                                            <span>
                                                <?= htmlspecialchars(formatCpfCnpj($services['cpf_cnpj'])); ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="iten-default-card">
                                        <i class="bi bi-telephone"></i>
                                        <span>
                                            Contato: <?= htmlspecialchars(formatNumber($services['number'])) ?>
                                        </span>
                                    </div>
                                    <div>
                                        <div class="iten-default-card">
                                            <i class="bi bi-calendar"></i>
                                            <span>
                                                Data: <?= htmlspecialchars(date(CONF_DATE_BR, strtotime($services['date']))) ?>
                                            </span>
                                        </div>
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
                                        <button class="btn-detalhes-card">
                                            <i class="bi bi-eye"></i>
                                            Detalhes
                                        </button>
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
    </main>
    <script src="../../src/scripts/resultMessage.js"></script>
</body>

</html>