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
        <div class="p-6 h-full">
            <div class="space-y-6 h-full">
                <!-- Titulo -->
                <div class="layer-titulo space-x-0">
                    <i class="bi bi-play text-4xl"></i>
                    <h2>
                        Serviços - Em Progresso
                    </h2>
                    <span class="bg-yellow-100 text-yellow-600">
                        <?= htmlspecialchars($total_iniciados) . ' Serviços' ?>
                    </span>
                </div>
                <!-- Conteudo Da Pagina -->
                <?php if (empty($list_iniciados)): ?>
                    <div class="layer-naoEncontrado">
                        <i class="bi bi-play-circle"></i>
                        <h3>
                            Nenhum serviço em progresso
                        </h3>
                        <p>
                            Todos os serviços foram iniciados ou você ainda não cadastrou nenhum serviço.
                        </p>
                    </div>
                <?php else: ?>
                    <!-- Listagem de Serviços que Não Começou -->
                    <div class="layer-default-cards">
                        <?php foreach ($list_iniciados as $services): ?>
                            <div class="card-default-conteudo">
                                <div class="layer-titulo-default-card">
                                    <h3>
                                        <?= htmlspecialchars($services['name']) ?>
                                    </h3>
                                    <span class="bg-yellow-100 text-yellow-600">
                                        Em Progresso
                                    </span>
                                </div>
                                <div class="space-y-4 ">
                                    <div>
                                        <div class="iten-default-card ">
                                            <i class="bi bi-person-vcard"></i>
                                            <span>
                                                CPF: <?= htmlspecialchars($services['cpf_cnpj']) ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="iten-default-card">
                                            <i class="bi bi-laptop"></i>
                                            <span>
                                                <?= htmlspecialchars($services['equipment']) ?>
                                            </span>

                                        </div>
                                    </div>
                                    <div class="iten-default-card">
                                        <i class="bi bi-telephone"></i>
                                        <span>
                                            Contato: <?= htmlspecialchars($services['number']) ?>
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
                                    <div class="mt-4">
                                        <div class="titulo-observacoes ">
                                            <i class="bi bi-chat-left-dots"></i>
                                            <p class="text-sm font-semibold">
                                                Observações:
                                            </p>
                                        </div>
                                        <div class="layer-observacoes observation-toggle group">
                                            <div class="cont-observacoes">
                                                <p>
                                                    <?= htmlspecialchars($services['observation'] ?: 'Clique para adicionar uma observação...') ?>
                                                </p>
                                                <i class="bi bi-pencil-square group-hover:opacity-100"></i>
                                            </div>
                                        </div>
                                        <!-- Input de observação (inicialmente oculto) -->
                                        <form method="post" action="../../src/backend/inProgress/observation.php" class="hidden observation-input gap-2 w-full" autocomplete="off">
                                            <input type="hidden" name="id" value="<?= htmlspecialchars($services['id']) ?>">
                                            <input type="text" name="observation" class="input-observacoes" placeholder="Digite sua observação aqui..." value="<?= htmlspecialchars($services['observation']) ?>">
                                            <button type="submit" class="btn-salvar-observacoes">
                                                <i class="bi bi-floppy"></i>
                                            </button>
                                        </form>
                                        <form method="post" action="../../src/backend/inProgress/proceed.php" class="flex justify-end mt-4">
                                            <input type="hidden" name="id" value="<?= htmlspecialchars($services['id']) ?>">
                                            <button type="submit" class="btn-finalizar-servico">
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

<script src="../../src/scripts/resultMessage.js"></script>
<script src="../../src/scripts/observation.js"></script>

</html>