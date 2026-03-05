<?php
// Restaurar estado do menu do cookie se não houver na sessão
if (!isset($_SESSION['menuState']) && isset($_COOKIE['menuState'])) {
    $_SESSION['menuState'] = $_COOKIE['menuState'];
}

// Definir classe do main-pages baseada no estado do menu
$mainPagesClass = (isset($_SESSION['menuState']) && $_SESSION['menuState'] === 'fechado') ? 'main-pages-fechado' : 'main-pages';
