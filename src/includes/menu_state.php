<?php
// Definir classe do main-pages baseada no estado do menu
$mainPagesClass = (isset($_SESSION['menuState']) && $_SESSION['menuState'] === 'fechado') ? 'main-pages-fechado' : 'main-pages';
