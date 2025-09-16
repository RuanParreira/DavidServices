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
                <div class="layer-titulo">
                    <i class="bi bi-check2-circle icons-titulo-default text-3xl"></i>
                    <h2>
                        Serviços - Prontos
                    </h2>
                    <span class="bg-green-100 text-green-600">
                        <?= htmlspecialchars($total_prontos) . ' Serviços' ?>
                    </span>
                </div>
                <!-- Conteudo Da Pagina -->
                <?php if (empty($list_prontos)): ?>
                    <div class="layer-naoEncontrado ">
                        <i class="bi bi-play-circle"></i>
                        <h3>
                            Nenhum serviço pronto
                        </h3>
                        <p>
                            Complete alguns serviços para vê-los aqui aguardando retirada.
                        </p>
                    </div>
                <?php else: ?>
                    <!-- Lista dos Serviços que Já Foram Finalizados -->
                    <div class="layer-default-cards">
                        <?php foreach ($list_prontos as $services): ?>
                            <div class="card-default-conteudo">
                                <div class="layer-titulo-default-card">
                                    <h3>
                                        <?= htmlspecialchars($services['name']) ?>
                                    </h3>
                                    <span class="bg-green-100 text-green-600">
                                        Pronto
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
                                        <div class="iten-default-card ">
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
                                    <div class="mt-4">
                                        <div class="titulo-observacoes ">
                                            <i class="bi bi-chat-left-dots"></i>
                                            <p class="text-sm font-semibold">
                                                Observações:
                                            </p>
                                        </div>
                                        <div class="layer-observacoes hover:bg-blue-50 cursor-auto">
                                            <div class="cont-observacoes">
                                                <p>
                                                    <?= htmlspecialchars($services['observation'] ?: '( Nenhuma observação )') ?>
                                                </p>
                                            </div>
                                        </div>
                                        <!-- Input de observação (inicialmente oculto) -->
                                        <form method="post" action="../../src/backend/ready/proceed.php" class="flex justify-end mt-4">
                                            <input type="hidden" name="id" value="<?= htmlspecialchars($services['id']) ?>">
                                            <button type="submit" class="btn-finalizar-servico">
                                                <i class="bi bi-archive"></i>
                                                Confirmar Retirada
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