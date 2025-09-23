<?php
$currentPage = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// Verificar estado do menu na sessão
$menuClosed = isset($_SESSION['menuState']) && $_SESSION['menuState'] === 'fechado';
$menuClass = $menuClosed ? 'menu-lateral-fechado' : 'menu-lateral';
$titleClass = $menuClosed ? 'hidden' : '';
$iconClass = $menuClosed ? 'bi bi-list text-3xl' : 'bi bi-x text-3xl';
$linkActiveClass = $menuClosed ? 'itens-menu-active-fechado' : 'itens-menu-active';
$linkClass = $menuClosed ? 'itens-menu-fechado' : 'itens-menu';
$iconMenuClass = $menuClosed ? 'icons-menu-fechado' : 'icons-menu';
$spanClass = $menuClosed ? 'hidden' : '';
$btnSairClass = $menuClosed ? 'btn-sair-fechado' : 'btn-sair';
$layerBtnSairClass = $menuClosed ? 'layer-btn-sair-fechado' : 'layer-btn-sair';
?>

<aside class="<?= $menuClass ?>">
    <div class="layer-titulo-menu">
        <div class="flex items-center space-x-2 <?= $titleClass ?>">
            <div class="img-titulo-menu">
                <img src="../../public/logo.jpg" alt="Logo da Empresa" class="object-cover rounded-full">
            </div>
            <h2 class="titulo-menu">Davidcom</h2>
        </div>
        <button class="btn-fechar-menu">
            <i class="<?= $iconClass ?>"></i>
        </button>
    </div>
    <nav class="flex-1 p-2 space-y-1">
        <a href="../dashBoard" class="<?= ($currentPage == 'dashBoard') ? $linkActiveClass : $linkClass ?>">
            <i class="bi bi-columns-gap <?= $iconMenuClass ?>"></i>
            <span class="<?= $spanClass ?>">Dashboard</span>
        </a>
        <a href="../registerClients" class="<?= ($currentPage == 'registerClients') ? $linkActiveClass : $linkClass ?>">
            <i class="bi bi-person-plus <?= $iconMenuClass ?>"></i>
            <span class="<?= $spanClass ?>">Registrar Clientes</span>
        </a>
        <a href="../registerServices" class="<?= ($currentPage == 'registerServices') ? $linkActiveClass : $linkClass ?>">
            <i class="bi bi-plus-circle <?= $iconMenuClass ?>"></i>
            <span class="<?= $spanClass ?>">Cadastrar Serviços</span>
        </a>
        <a href="../notStart" class="<?= ($currentPage == 'notStart') ? $linkActiveClass : $linkClass ?>">
            <i class="bi bi-clock <?= $iconMenuClass ?>"></i>
            <span class="<?= $spanClass ?>">Não Começou</span>
        </a>
        <a href="../inProgress" class="<?= ($currentPage == 'inProgress') ? $linkActiveClass : $linkClass ?>">
            <i class="bi bi-play-circle <?= $iconMenuClass ?>"></i>
            <span class="<?= $spanClass ?>">Em Progresso</span>
        </a>
        <a href="../ready" class="<?= ($currentPage == 'ready') ? $linkActiveClass : $linkClass ?>">
            <i class="bi bi-check2-circle <?= $iconMenuClass ?>"></i>
            <span class="<?= $spanClass ?>">Prontos</span>
        </a>
        <a href="../finished" class="<?= ($currentPage == 'finished') ? $linkActiveClass : $linkClass ?>">
            <i class="bi bi-archive <?= $iconMenuClass ?>"></i>
            <span class="<?= $spanClass ?>">Finalizados</span>
        </a>
        <a href="../visits" class="<?= ($currentPage == 'visits') ? $linkActiveClass : $linkClass ?>">
            <i class="bi bi-calendar <?= $iconMenuClass ?>"></i>
            <span class="<?= $spanClass ?>">Visitas Técnicas</span>
        </a>
        <a href="../registerTechnicians" class="<?= ($currentPage == 'registerTechnicians') ? $linkActiveClass : $linkClass ?>">
            <i class="bi bi-people <?= $iconMenuClass ?>"></i>
            <span class="<?= $spanClass ?>">Registar Técnicos</span>
        </a>
    </nav>
    <div class="<?= $layerBtnSairClass ?>">
        <a href="../../src/backend/auth/logout.php" class="<?= $btnSairClass ?>">
            <i class="bi bi-box-arrow-right text-lg "></i>
            <span class="text-base <?= $spanClass ?>">Sair</span>
        </a>
    </div>
</aside>