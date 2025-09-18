<?php
$currentPage = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
?>
<aside class="menu-lateral">
    <div class="p-4 border-b border-gray-300 flex items-center justify-between">
        <div class="flex items-center space-x-2">
            <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center">
                <img src="../../public/logo.jpg" alt="Logo da Empresa" class="object-cover rounded-full">
            </div>
            <h2 class="text-blue-600 text-2xl font-semibold">Davidcom</h2>
        </div>
    </div>
    <nav class="flex-1 p-2 space-y-1">
        <a href="../dashBoard" class="<?= ($currentPage == 'dashBoard') ? 'itens-menu-active' : 'itens-menu' ?>">
            <i class="bi bi-columns-gap icons-menu"></i>
            <span>Dashboard</span>
        </a>
        <a href="../registerClients" class="<?= ($currentPage == 'registerClients') ? 'itens-menu-active' : 'itens-menu' ?>">
            <i class="bi bi-person-plus icons-menu"></i>
            <span>Registrar Clientes</span>
        </a>
        <a href="../registerServices" class="<?= ($currentPage == 'registerServices') ? 'itens-menu-active' : 'itens-menu' ?>">
            <i class="bi bi-plus-circle icons-menu"></i>
            <span>Cadastrar Serviços</span>
        </a>
        <a href="../notStart" class="<?= ($currentPage == 'notStart') ? 'itens-menu-active' : 'itens-menu' ?>">
            <i class="bi bi-clock icons-menu"></i>
            <span>Não Começou</span>
        </a>
        <a href="../inProgress" class="<?= ($currentPage == 'inProgress') ? 'itens-menu-active' : 'itens-menu' ?>">
            <i class="bi bi-play-circle icons-menu"></i>
            <span>Em Progresso</span>
        </a>
        <a href="../ready" class="<?= ($currentPage == 'ready') ? 'itens-menu-active' : 'itens-menu' ?>">
            <i class="bi bi-check2-circle icons-menu"></i>
            <span>Prontos</span>
        </a>
        <a href="../finished" class="<?= ($currentPage == 'finished') ? 'itens-menu-active' : 'itens-menu' ?>">
            <i class="bi bi-archive icons-menu"></i>
            <span>Finalizados</span>
        </a>
        <a href="../visits" class="<?= ($currentPage == 'visits') ? 'itens-menu-active' : 'itens-menu' ?>">
            <i class="bi bi-calendar icons-menu"></i>
            <span>Visitas Técnicas</span>
        </a>
        <a href="../registerTechnicians" class="<?= ($currentPage == 'registerTechnicians') ? 'itens-menu-active' : 'itens-menu' ?>">
            <i class="bi bi-people icons-menu"></i>
            <span>Registar Técnicos</span>
        </a>
    </nav>
    <div class="flex flex-col gap-2 p-4 border-t border-gray-300 mt-auto">
        <a href="../../src/backend/auth/logout.php" class="btn-sair">
            <i class="bi bi-box-arrow-right text-lg "></i>
            <span class="text-base">Sair</span>
        </a>
    </div>
</aside>