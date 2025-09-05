<?php
require __DIR__ . '/config/config.php';

try {
    $pdo = new PDO(
        'mysql:host=' . CONF_DB_HOST . ';dbname=' . CONF_DB_NAME,
        CONF_DB_USER,
        CONF_DB_PASS,
        [
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES " . CONF_DB_CHARSET
        ]
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    error_log($e->getMessage());
    die('Erro ao conectar ao banco de dados.');
}
