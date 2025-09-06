<!DOCTYPE html>
<html lang="pt-br">
<?php
require __DIR__ . '/../../src/backend/functions/geral.php';
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
                <div class="flex items-center">
                    <i class="bi bi-play icons-titulo-default text-4xl"></i>
                    <h2 class="text-3xl font-bold text-gray-900">
                        Serviços - Em Progresso
                    </h2>
                </div>
                <!-- Conteudo Da Pagina -->
            </div>
        </div>
    </main>

</body>

</html>